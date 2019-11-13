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
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('LeaveApplications');
        $this->loadModel('LeaveBalances');
    }

    /**
     * beforeFilter method
     *
     * @param Event $event CakePHP event
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->Auth->allow(['login', 'logout']);
    }

    /**
     * Home method
     *
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

        //getting own leave application
        $leaveApplications = $this->LeaveApplications->find('all', [
            'conditions' => [
                'employee_id' => $this->Auth->user('id')
            ],
            'contain' => [
                'EmployeeInformation'
            ]
        ]);

        //geting all options array
        $leaveTypes = TableRegistry::get('LeaveTypes')
            ->find('list', [
                'conditions' => [
                    'LeaveTypes.deleted' => 0
                ]
            ])
            ->toArray();

        //getting current leave balance
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
     * Login method
     *
     * @return \Cake\Http\Response|null
     */
    public function login()
    {
        $this->viewBuilder()->setLayout('login');
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);

                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
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
                'Roles'
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
        $roles = TableRegistry::get('Roles')
            ->find('list', [
                'conditions' => [
                    'Roles.deleted' => 0
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

                // if (empty($employeeInformation->middle_name)) {
                //     $employeeInformation->middle_name = null;
                // }
                if ($this->EmployeeInformation->save($employeeInformation)) {
                    $currentTerm = TableRegistry::get('Terms')
                        ->find('all', [
                            'conditions' => [
                                'Terms.deleted' => 0
                            ]
                        ])
                        ->first();

                    $leaveBalance = [
                        'employee_id' => $employeeInformation->id,
                        'term_id' => $currentTerm['id'],
                        'balance' => 0,
                        'leave_type_id' => 0
                    ];

                    if ($employeeInformation->is_als == 1) {
                        // Vacation leave
                        $leaveBalance['balance'] = 15;
                        $leaveBalance['leave_type_id'] = 1;
                        $leaveBalanceEntity = $this->LeaveBalances->newEntity();
                        $this->LeaveBalances->patchEntity($leaveBalanceEntity, $leaveBalance);
                        $this->LeaveBalances->save($leaveBalanceEntity);

                        // Sick leave
                        $leaveBalance['balance'] = 15;
                        $leaveBalance['leave_type_id'] = 2;
                        $leaveBalanceEntity = $this->LeaveBalances->newEntity();
                        $this->LeaveBalances->patchEntity($leaveBalanceEntity, $leaveBalance);
                        $this->LeaveBalances->save($leaveBalanceEntity);
                    } elseif ($employeeInformation->is_als == 2) {
                        // Combo leave
                        $leaveBalance['balance'] = 15;
                        $leaveBalance['leave_type_id'] = 6;
                        $leaveBalanceEntity = $this->LeaveBalances->newEntity();
                        $this->LeaveBalances->patchEntity($leaveBalanceEntity, $leaveBalance);
                        $this->LeaveBalances->save($leaveBalanceEntity);
                    }

                    if ($employeeInformation->gender == 1) {
                        // Paternity leave
                        $leaveBalance['balance'] = 7;
                        $leaveBalance['leave_type_id'] = 5;
                        $leaveBalanceEntity = $this->LeaveBalances->newEntity();
                        $this->LeaveBalances->patchEntity($leaveBalanceEntity, $leaveBalance);
                        $this->LeaveBalances->save($leaveBalanceEntity);
                    } else {
                        // Maternity leave
                        $leaveBalance['balance'] = 103;
                        $leaveBalance['leave_type_id'] = 4;
                        $leaveBalanceEntity = $this->LeaveBalances->newEntity();
                        $this->LeaveBalances->patchEntity($leaveBalanceEntity, $leaveBalance);
                        $this->LeaveBalances->save($leaveBalanceEntity);
                    }
                    $this->Flash->success(__('The employee has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The employee could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('employeeStatus', 'jobPositions', 'roles', 'employeeErrors'));
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
        $employeeStatus = Configure::read('EMPLOYEES.EMPLOYEE_STATUS');
        $jobPositions = TableRegistry::get('JobPositions')
            ->find('list', [
                'conditions' => [
                    'JobPositions.deleted' => 0
                ]
            ]);
        $roles = TableRegistry::get('Roles')
            ->find('list', [
                'conditions' => [
                    'Roles.deleted' => 0
                ]
            ]);
        // $jobPositions = $this->JobPosition->find('all');
        // $employee = $this->Employees->get($id, [
        //     'contain' => []
        // ]);
        // if ($this->request->is(['patch', 'post', 'put'])) {
        //     $employee = $this->Employees->patchEntity($employee, $this->request->getData());
        //     if ($this->Employees->save($employee)) {
        //         $this->Flash->success(__('The employee has been saved.'));

        //         return $this->redirect(['action' => 'index']);
        //     }
        //     $this->Flash->error(__('The employee could not be saved. Please, try again.'));
        // }
        // $roles = $this->Employees->Roles->find('list', ['limit' => 200]);
        $this->set(compact('employeeStatus', 'jobPositions', 'roles'));
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
        //denies if role is not administrator
        if ($this->Auth->user('role_id') != Configure::read('EMPLOYEES.ROLES.Admin')) {
            return $this->redirect('/');
        }

        $this->request->allowMethod(['post', 'delete']);
        $employee = $this->EmployeeInformation->get($id);
        if ($this->EmployeeInformation->delete($employee)) {
            $this->Flash->success(__('The employee has been deleted.'));
        } else {
            $this->Flash->error(__('The employee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Logout method
     *
     * @return Auth logoutRedirect
     */
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
}
