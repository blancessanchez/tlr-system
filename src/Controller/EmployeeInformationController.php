<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * EmployeeInformation Controller
 *
 * @property \App\Model\Table\EmployeeInformationTable $EmployeeInformation
 *
 * @method \App\Model\Entity\Employee[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmployeeInformationController extends AppController
{
    /**
     * Initialize method
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Leaves');
        $this->loadModel('LeaveBalances');
        $this->loadComponent('ActivityLog');
    }

    /**
     * beforeFilter method
     *
     * @param Event $event CakePHP event
     * @return void
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->Auth->allow(['index', 'logout']);
    }

    /**
     * Home method
     *
     * @return void
     */
    public function home()
    {
        $this->viewBuilder()->setLayout('main');
        $isAdmin = $this->Auth->user('role_id') == Configure::read('EMPLOYEES.ROLES.Admin') ? true : false;
        $currentTerm = TableRegistry::get('Terms')
            ->find('all', [
                'conditions' => [
                    'Terms.deleted' => 0
                ]
            ])
            ->first();

        // getting own leave application
        $leaveApplications = $this->Leaves->find('all', [
            'conditions' => [
                'employee_id' => $this->Auth->user('id')
            ],
            'contain' => [
                'EmployeeInformation'
            ]
        ]);

        // geting all options array
        $leaveTypes = TableRegistry::get('LeaveTypes')
            ->find('list', [
                'conditions' => [
                    'LeaveTypes.deleted' => 0
                ]
            ])
            ->toArray();

        // getting current leave balance
        $leaveBalance = TableRegistry::get('LeaveBalances')
            ->find('all', [
                'contain' => [
                    'LeaveTypes',
                    'Terms'
                ],
                'conditions' => [
                    'LeaveBalances.employee_id' => $this->Auth->user('id'),
                    'LeaveBalances.deleted' => 0,
                    'Terms.deleted' => 0
                ]
            ])
            ->toArray();

        $this->set(compact('isAdmin', 'currentTerm', 'leaveApplications', 'leaveTypes', 'leaveBalance'));
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->viewBuilder()->setLayout('login');
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);

                if ($this->ActivityLog->logginginActivityLog($user['id'], 'User login')) {
                    return $this->redirect($this->Auth->redirectUrl());
                }
                $this->Flash->error(__('Error saving login info in activity log.'));
            }
            $this->Flash->error(__('Invalid username or password, try again.'));
        }
    }

    /**
     * Employee list method
     * 
     * @return \Cake\Http\Response|null
     */
    public function employeeList()
    {
        //denies if role is not administrator
        if ($this->Auth->user('role_id') != Configure::read('EMPLOYEES.ROLES.Admin')) {
            return $this->redirect('/');
        }

        $this->viewBuilder()->setLayout('main');
        $employeeStatus = Configure::read('EMPLOYEES.EMPLOYEE_STATUS');
        $employees = $this->EmployeeInformation->find('all', [
            'contain' => [
                'JobPositions',
            ],
            'conditions' => [
                'EmployeeInformation.deleted' => 0
            ]
        ]);
        $this->set(compact('employees', 'employeeStatus'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        //denies if role is not administrator
        if ($this->Auth->user('role_id') != Configure::read('EMPLOYEES.ROLES.Admin')) {
            return $this->redirect('/');
        }

        $this->viewBuilder()->setLayout('main');
        $employeeErrors = [];
        $employeeStatus = Configure::read('EMPLOYEES.EMPLOYEE_STATUS');
        $jobPositions = TableRegistry::get('JobPositions')
            ->find('list', [
                'conditions' => [
                    'JobPositions.deleted' => 0
                ]
            ]);
        $roles = Configure::read('EMPLOYEES.ROLES_LIST');
        $departments = TableRegistry::get('Departments')
            ->find('list', [
                'conditions' => [
                    'Departments.deleted' => 0
                ]
            ]);

        if ($this->request->is('post')) {
            $employeeInformation = $this->EmployeeInformation->newEntity($this->request->getData());

            if ($employeeInformation->hasErrors()) {
                $employeeErrors = $employeeInformation->errors();
                $this->Flash->error(__('The employee could not be saved. Please, try again.'));
            } else {
                $employeeInformation->hired_date = date('Y-m-d', strtotime($employeeInformation->hired_date));
                if ($employeeInformation->hired_date == '1970-01-01') {
                    $employeeInformation->hired_date = null;
                }

                if (empty($employeeInformation->middle_name)) {
                    $employeeInformation->middle_name = null;
                }

                if (empty($employeeInformation->salary)) {
                    $employeeInformation->salary = null;
                }

                // check if employee number already exists
                $query = $this->EmployeeInformation->find('all', [
                    'conditions' => [
                        'EmployeeInformation.employee_no' => $employeeInformation->employee_no
                    ]
                ]);

                $checkIfEmployeeExists = $query->first();

                if (!empty($checkIfEmployeeExists)) {
                    $this->Flash->error(__('Employee number is already existing.'));
                }
                
                if ($this->EmployeeInformation->save($employeeInformation)) {
                    $currentTerm = TableRegistry::get('Terms')
                        ->find('all', [
                            'conditions' => [
                                'Terms.deleted' => 0
                            ]
                        ])
                        ->first();
                    
                    if (!empty($currentTerm)) {
                        $leaveBalance = [
                            'employee_id' => $employeeInformation->id,
                            'term_id' => $currentTerm['id'],
                            'balance' => 0,
                            'leave_type_id' => 0
                        ];
    
                        if ($employeeInformation->is_als == Configure::read('EMPLOYEES.ALS.False')) {
                            // Combo leave
                            $leaveBalance['balance'] = Configure::read('LEAVES.BALANCE.Combo');
                            $leaveBalance['leave_type_id'] = Configure::read('LEAVES.TYPE.Combo');
                            $leaveBalanceEntity = $this->LeaveBalances->newEntity();
                            $this->LeaveBalances->patchEntity($leaveBalanceEntity, $leaveBalance);
                            $this->LeaveBalances->save($leaveBalanceEntity);
                        } else {
                            // Vacation leave
                            $leaveBalance['balance'] = Configure::read('LEAVES.BALANCE.Vacation');
                            $leaveBalance['leave_type_id'] = Configure::read('LEAVES.TYPE.Vacation');
                            $leaveBalanceEntity = $this->LeaveBalances->newEntity();
                            $this->LeaveBalances->patchEntity($leaveBalanceEntity, $leaveBalance);
                            $this->LeaveBalances->save($leaveBalanceEntity);
    
                            // Sick leave
                            $leaveBalance['balance'] = Configure::read('LEAVES.BALANCE.Sick');
                            $leaveBalance['leave_type_id'] = Configure::read('LEAVES.TYPE.Sick');
                            $leaveBalanceEntity = $this->LeaveBalances->newEntity();
                            $this->LeaveBalances->patchEntity($leaveBalanceEntity, $leaveBalance);
                            $this->LeaveBalances->save($leaveBalanceEntity);
                        }
    
                        if ($employeeInformation->gender == Configure::read('EMPLOYEES.GENDER.Male')) {
                            // Paternity leave
                            $leaveBalance['balance'] = Configure::read('LEAVES.BALANCE.Paternity');
                            $leaveBalance['leave_type_id'] = Configure::read('LEAVES.TYPE.Paternity');
                            $leaveBalanceEntity = $this->LeaveBalances->newEntity();
                            $this->LeaveBalances->patchEntity($leaveBalanceEntity, $leaveBalance);
                            $this->LeaveBalances->save($leaveBalanceEntity);
                        } else {
                            // Maternity leave
                            $leaveBalance['balance'] = Configure::read('LEAVES.BALANCE.Maternity');
                            $leaveBalance['leave_type_id'] = Configure::read('LEAVES.TYPE.Maternity');
                            $leaveBalanceEntity = $this->LeaveBalances->newEntity();
                            $this->LeaveBalances->patchEntity($leaveBalanceEntity, $leaveBalance);
                            $this->LeaveBalances->save($leaveBalanceEntity);
                        }
                    }

                    $session = $this->getRequest()->getSession();
                    $this->ActivityLog->logginginActivityLog($session->read('Auth.User.id'), 'Add New Employee');
                    $this->Flash->success(__('The employee has been saved.'));

                    return $this->redirect(['action' => 'employeeList']);
                }
                $this->Flash->error(__('The employee could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('employeeStatus', 'jobPositions', 'roles', 'employeeErrors', 'departments'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        //denies if role is not administrator
        if ($this->Auth->user('role_id') != Configure::read('EMPLOYEES.ROLES.Admin')) {
            return $this->redirect('/');
        }

        $this->viewBuilder()->setLayout('main');
        $employeeErrors = [];
        $employeeStatus = Configure::read('EMPLOYEES.EMPLOYEE_STATUS');
        $jobPositions = TableRegistry::get('JobPositions')
            ->find('list', [
                'conditions' => [
                    'JobPositions.deleted' => 0
                ]
            ]);
        $roles = Configure::read('EMPLOYEES.ROLES_LIST');
        $departments = TableRegistry::get('Departments')
            ->find('list', [
                'conditions' => [
                    'Departments.deleted' => 0
                ]
            ]);

        $employee = $this->EmployeeInformation->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $employee = $this->EmployeeInformation->patchEntity($employee, $this->request->getData());
            if ($employee->hasErrors()) {
                $employeeErrors = $employee->errors();
                $this->Flash->error(__('The employee information could not be saved. Please, try again.'));
            } else {
                $employee->hired_date = date('Y-m-d', strtotime($employee->hired_date));
                if ($employee->hired_date == '1970-01-01') {
                    $employee->hired_date = null;
                }

                if (empty($employee->middle_name)) {
                    $employee->middle_name = null;
                }

                if (empty($employee->salary)) {
                    $employee->salary = null;
                }
                if ($this->EmployeeInformation->save($employee)) {
                    $this->Flash->success(__('The employee has been saved.'));

                    return $this->redirect(['action' => 'employeeList']);
                }
                $this->Flash->error(__('The employee could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('employee', 'employeeStatus', 'jobPositions', 'roles', 'employeeErrors', 'departments'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        // denies if role is not administrator
        if ($this->Auth->user('role_id') != Configure::read('EMPLOYEES.ROLES.Admin')) {
            return $this->redirect('/');
        }

        $this->request->allowMethod(['post', 'delete']);
        $employee = $this->EmployeeInformation->get($id);

        // update to deleted = 1
        $employee->deleted = 1;
        $employee->deleted_date = date('Y-m-d H:i:s');

        $employee = $this->EmployeeInformation->patchEntity($employee, $this->request->getData());
        // loging in activity log
        $session = $this->getRequest()->getSession();
        $this->ActivityLog->logginginActivityLog($session->read('Auth.User.id'), 'Deletion of employee information');
        if ($this->EmployeeInformation->save($employee)) {
            $this->Flash->success(__('The employee has been deleted.'));
        } else {
            $this->Flash->error(__('The employee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'employeeList']);
    }

    /**
     * Logout method
     *
     * @return Auth logoutRedirect
     */
    public function logout()
    {
        $session = $this->getRequest()->getSession();
        if ($this->ActivityLog->logginginActivityLog($session->read('Auth.User.id'), 'User logout')) {
            return $this->redirect($this->Auth->logout());
        }
        $this->Flash->error(__('Error saving login info in activity log.'));
    }

    /**
     * View method
     *
     * @param string|null $id Configuration id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->setLayout('main');
        $employee = $this->EmployeeInformation->find('all', [
            'contain' => [
                'ActivityLogs',
                'Leaves',
                'LeaveBalances'
            ],
            'conditions' => [
                'EmployeeInformation.id' => $id
            ]
        ])
        ->first();

        $jobPositions = TableRegistry::get('JobPositions')
            ->find('list', [
                'conditions' => [
                    'JobPositions.deleted' => 0
                ]
            ])
            ->toArray();
        
        $employeeStatus = Configure::read('EMPLOYEES.EMPLOYEE_STATUS');
        $roles = Configure::read('EMPLOYEES.ROLES_LIST');
        $departments = TableRegistry::get('Departments')
            ->find('list', [
                'conditions' => [
                    'Departments.deleted' => 0
                ]
            ])
            ->toArray();

        $this->set(compact('employee', 'jobPositions', 'employeeStatus', 'roles', 'departments'));
    }
}
