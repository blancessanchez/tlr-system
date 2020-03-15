<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Leaves Controller
 *
 * @property \App\Model\Table\LeavesTable $Leaves
 *
 * @method \App\Model\Entity\Leave[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LeavesController extends AppController
{
    /**
     * Initialize method
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('EmployeeInformation');
        $this->loadModel('LeaveBalances');
        $this->loadModel('LeaveApplicationResponses');
        $this->loadComponent('ActivityLog');
        $this->loadComponent('Leave');
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

        $this->Auth->allow(['login', 'logout']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        //denies if role is not principal
        if ($this->Auth->user('role_id') != Configure::read('EMPLOYEES.ROLES.Principal')) {
            return $this->redirect('/home');
        }

        $this->viewBuilder()->setLayout('main');
        $leaveApplications = $this->Leaves->find('all', [
            'contain' => [
                'EmployeeInformation'
            ],
            'conditions' => [
                'EmployeeInformation.deleted' => 0
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

        $this->set(compact('leaveApplications', 'leaveTypes'));
    }

    /**
     * View method
     *
     * @param string|null $id Leave Application id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->setLayout('main');
        $leaveApplicationResponseErrors = [];

        //get leave application information
        $leaveApplication = $this->Leaves->get($id, [
            'contain' => [
                'EmployeeInformation',
                'LeaveTypes',
                'LeaveCategories'
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

        $leaveCategories = TableRegistry::get('LeaveCategories')
            ->find('list', [
                'conditions' => [
                    'LeaveCategories.deleted' => 0
                ]
            ])
            ->toArray();

        //find response in LeaveResponse
        $leaveResponse = $this->LeaveApplicationResponses->find('all', [
                'conditions' => [
                    'LeaveApplicationResponses.application_id' => $id,
                    'LeaveApplicationResponses.deleted' => 0,
                ]
            ])
            ->first();

        if ($leaveApplication->leave_status == 3) {
            $leaveResponse = 'cancelled';
        } elseif ($leaveApplication->leave_status == 2) {
            $leaveResponse = 'approved';
        }

        //getting current leave balance
        $leaveBalance = TableRegistry::get('LeaveBalances')
            ->find('all', [
                'contain' => [
                    'LeaveTypes',
                    'Terms'
                ],
                'conditions' => [
                    'LeaveBalances.employee_id' => $leaveApplication->employee_id,
                    'LeaveBalances.deleted' => 0,
                    'Terms.deleted' => 0
                ]
            ])
            ->toArray();

        //get applied for (get days)
        $diff = $this->Leave->getDatesFromRange($leaveApplication->leave_from, $leaveApplication->leave_to);

        $this->set(compact(
            'leaveApplication',
            'employeeBalance',
            'leaveTypes',
            'leaveCategories',
            'leaveApplicationResponseErrors',
            'leaveResponse',
            'diff',
            'leaveBalance'
        ));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        //denies if role is principal
        if ($this->Auth->user('role_id') == Configure::read('EMPLOYEES.ROLES.Principal')) {
            return $this->redirect('/home');
        }

        $this->viewBuilder()->setLayout('main');
        $employeeId = $this->Auth->user('id');
        $leaveApplicationErrors = [];
        $leavesConfiguration = Configure::read('LEAVES');

        // Always exclude NON ALS leave type
        $excludeLeaveTypeId = [$leavesConfiguration['NON_ALS_ID']];

        // Filter leave type by gender
        if ($this->Auth->user('gender') == 1) {
            $excludeLeaveTypeId[] = $leavesConfiguration['MATERNITY_ID'];
        } else {
            $excludeLeaveTypeId[] = $leavesConfiguration['PATERNITY_ID'];
        }

        //geting all options
        $leaveTypes = TableRegistry::get('LeaveTypes')
            ->find('list', [
                'conditions' => [
                    'LeaveTypes.id NOT IN' => $excludeLeaveTypeId,
                    'LeaveTypes.deleted' => 0
                ]
            ]);
        $leaveCategories = TableRegistry::get('LeaveCategories')
            ->find('list', [
                'conditions' => [
                    'LeaveCategories.deleted' => 0
                ]
            ]);

        //getting employee information
        $getAllEmployee = $this->EmployeeInformation->find('all', [
            'conditions' => [
                'id' => $employeeId
            ]
        ]);
        $employeeInformation = $getAllEmployee->first();

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

        if ($this->request->is('post')) {
            $leaveApplication = $this->Leaves->newEntity($this->request->getData());
            if (date('Y-m-d', strtotime($leaveApplication->leave_from)) > date('Y-m-d', strtotime($leaveApplication->leave_to))) {
                $leaveApplication->setErrors(['leave_from' => ['dateCompare' => 'Leave from date must not be greater than leave to date']]);
            }

            if (empty($leaveBalance)) {
                $this->Flash->error(__('The leave application could not be proceed. Please contact the administrator to start term first.'));
            } else if ($leaveApplication->hasErrors()) {
                $leaveApplicationErrors = $leaveApplication->errors();
                $this->Flash->error(__('The leave application could not be saved. Please, try again.'));
            } else {
                $leaveApplication->employee_id = $employeeId;
                $leaveApplication->leave_from = date('Y-m-d', strtotime($leaveApplication->leave_from));
                $leaveApplication->leave_to = date('Y-m-d', strtotime($leaveApplication->leave_to));
                $leaveApplication->leave_status = $leavesConfiguration['STATUS']['ForApproval'];

                if (in_array($leaveApplication->leave_type_id, [Configure::read('LEAVES.TYPE.Vacation'), Configure::read('LEAVES.TYPE.Sick')]) && $employeeInformation->is_als == Configure::read('EMPLOYEES.ALS.False')) {
                    $leaveApplication->leave_type_id = $leavesConfiguration['NON_ALS_ID'];
                }

                if ($this->Leaves->save($leaveApplication)) {
                    $session = $this->getRequest()->getSession();
                    $this->ActivityLog->logginginActivityLog($session->read('Auth.User.id'), 'Apply Leave');
                    $this->Flash->success(__('The leave application has been saved.'));

                    return $this->redirect('/home');
                }
                $this->Flash->error(__('The leave application could not be saved. Please, try again.'));
            }
        }
        $this->set(compact(
            'leaveTypes',
            'leaveCategories',
            'employeeInformation',
            'leaveBalance',
            'leaveApplicationErrors'
        ));
    }

    /**
     * Edit method
     *
     * @param string|null $id Leave Application id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit()
    {
        $getId = null;
        $this->viewBuilder()->setLayout('main');
        $errorPage = false;

        //if leave application id is empty return error page
        if (!isset($this->request->params['id'])) {
            $errorPage = true;
        } else {
            $getId = $this->request->params['id'];
        }

        //get leave application information
        $leaveApplication = $this->Leaves->find('all', [
            'contain' => [
                'EmployeeInformation',
                'LeaveTypes',
                'LeaveCategories'
            ],
            'conditions' => [
                'Leaves.id' => $getId,
                'Leaves.employee_id' => $this->Auth->user('id')
            ]
        ])->first();

        if (empty($leaveApplication)) {
            $errorPage = true;
        }

        //if status IN approved,disapproved,cancelled redirect to top page
        if (!empty($leaveApplication) && in_array($leaveApplication->leave_status, [2, 3, 4])) {
            return $this->redirect('/home');
        }

        $leaveApplicationErrors = [];
        $leavesConfiguration = Configure::read('LEAVES');

        // Always exclude NON ALS leave type
        $excludeLeaveTypeId = [$leavesConfiguration['NON_ALS_ID']];

        // Filter leave type by gender
        if ($this->Auth->user('gender') == 1) {
            $excludeLeaveTypeId[] = $leavesConfiguration['MATERNITY_ID'];
        } else {
            $excludeLeaveTypeId[] = $leavesConfiguration['PATERNITY_ID'];
        }

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

        //geting all options array
        $leaveTypes = TableRegistry::get('LeaveTypes')
            ->find('list', [
                'conditions' => [
                    'LeaveTypes.id NOT IN' => $excludeLeaveTypeId,
                    'LeaveTypes.deleted' => 0
                ]
            ]);

        $leaveCategories = TableRegistry::get('LeaveCategories')
            ->find('list', [
                'conditions' => [
                    'LeaveCategories.deleted' => 0
                ]
            ])
            ->toArray();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $leaveApplication = $this->Leaves->patchEntity($leaveApplication, $this->request->getData());
            if (date('Y-m-d', strtotime($leaveApplication->leave_from)) > date('Y-m-d', strtotime($leaveApplication->leave_to))) {
                $leaveApplication->setErrors(['leave_from' => ['dateCompare' => 'Leave from date must not be greater than leave to date']]);
            }

            if ($leaveApplication->hasErrors()) {
                $leaveApplicationErrors = $leaveApplication->errors();
                $this->Flash->error(__('The leave application could not be saved. Please, try again.'));
            } else {
                $leaveApplication->leave_from = date('Y-m-d', strtotime($leaveApplication->leave_from));
                $leaveApplication->leave_to = date('Y-m-d', strtotime($leaveApplication->leave_to));

                if (in_array($leaveApplication->leave_type_id, [Configure::read('LEAVES.TYPE.Vacation'), Configure::read('LEAVES.TYPE.Sick')]) && $leaveApplication->employee_information->is_als == Configure::read('EMPLOYEES.ALS.False')) {
                    $leaveApplication->leave_type_id = $leavesConfiguration['NON_ALS_ID'];
                }

                if ($this->Leaves->save($leaveApplication)) {
                    $session = $this->getRequest()->getSession();
                    $this->ActivityLog->logginginActivityLog($session->read('Auth.User.id'), 'Edit Leave');
                    $this->Flash->success(__('The leave application has been saved.'));

                    return $this->redirect('/home');
                }
                $this->Flash->error(__('The leave application could not be saved. Please, try again.'));
            }
        }

        $this->set(compact(
            'leaveApplication',
            'leaveBalance',
            'leaveTypes',
            'leaveCategories',
            'leaveApplicationErrors',
            'errorPage'
        ));
    }

    /**
     * Delete method
     *
     * @param string|null $id Leave Application id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $leaveApplication = $this->Leaves->get($id);
        if ($this->Leaves->delete($leaveApplication)) {
            $this->Flash->success(__('The leave application has been deleted.'));
        } else {
            $this->Flash->error(__('The leave application could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Generate report method
     * @return Render view
     */
    public function generateReport()
    {
        //denies if role is not principal
        if ($this->Auth->user('role_id') != Configure::read('EMPLOYEES.ROLES.Admin')) {
            return $this->redirect('/home');
        }

        $leaveApplications = $this->Leaves->find('all', [
            'contain' => [
                'EmployeeInformation' => ['JobPositions'],
                'LeaveApplicationResponses'
            ],
            'conditions' => [
                'Leaves.leave_status IN' => [2, 4],
                'Leaves.deleted' => 0
            ]
        ])->toArray();
        $this->viewBuilder()->layout(false);
        $this->set(compact('leaveApplications'));
    }

    /**
     * Cancel leave application
     *
     * @param int $id leave application id
     * @return Json $response
     */
    public function cancel($id = null)
    {
        if ($this->request->is('post')) {
            // edit leave application status
            $editLeaveApplication = $this->Leaves->get($this->request->getData('id'));
            $leaveStatus['Leaves']['leave_status'] = Configure::read('LEAVES.STATUS.Cancelled');
            $saveData = $this->Leaves->patchEntity($editLeaveApplication, $leaveStatus);

            // send response error if failed
            $responseError['message'] = 'The given data was invalid';

            // log in activity log
            $session = $this->getRequest()->getSession();
            $this->ActivityLog->logginginActivityLog($session->read('Auth.User.id'), 'Cancel Leave');

            if ($this->Leaves->save($saveData)) {
                return $this->response->withStatus(200)
                    ->withStringBody(json_encode(['status' => true], JSON_UNESCAPED_UNICODE));
            }

            return $this->response->withStatus(422)
                ->withStringBody(json_encode($responseError, JSON_UNESCAPED_UNICODE));
        }
    }
}
