<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * LeaveApplications Controller
 *
 * @property \App\Model\Table\LeaveApplicationsTable $LeaveApplications
 *
 * @method \App\Model\Entity\LeaveApplication[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LeaveApplicationsController extends AppController
{
    /**
     * Initialize method
     *
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('EmployeeInformation');
        $this->loadModel('LeaveBalances');
        $this->loadModel('LeaveApplicationResponses');
    }

    /**
     * beforeFilter method
     *
     * @param Event $event CakePHP event
     * @return \Cake\Http\Response|null
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
            return $this->redirect('/');
        }

        $this->viewBuilder()->setLayout('main');
        $leaveApplications = $this->LeaveApplications->find('all', [
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
        //denies if role is not principal
        if ($this->Auth->user('role_id') != Configure::read('EMPLOYEES.ROLES.Principal')) {
            return $this->redirect('/');
        }

        $this->viewBuilder()->setLayout('main');
        $leaveApplicationResponseErrors = [];

        //get leave application information
        $leaveApplication = $this->LeaveApplications->get($id, [
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
        $earlier = new \DateTime($leaveApplication->leave_from);
        $later = new \DateTime($leaveApplication->leave_to);
        $diff = $later->diff($earlier)->format('%a') + 1;

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
            $leaveApplication = $this->LeaveApplications->newEntity($this->request->getData());
            if (date('Y-m-d', strtotime($leaveApplication->leave_from)) > date('Y-m-d', strtotime($leaveApplication->leave_to))) {
                $leaveApplication->setErrors(['leave_from' => ['dateCompare' => 'Leave from date must not be greater than leave to date']]);
            }

            if ($leaveApplication->hasErrors()) {
                $leaveApplicationErrors = $leaveApplication->errors();
                $this->Flash->error(__('The leave application could not be saved. Please, try again.'));
            } else {
                $leaveApplication->employee_id = $employeeId;
                $leaveApplication->leave_from = date('Y-m-d', strtotime($leaveApplication->leave_from));
                $leaveApplication->leave_to = date('Y-m-d', strtotime($leaveApplication->leave_to));
                $leaveApplication->leave_status = $leavesConfiguration['STATUS']['ForApproval'];

                if (in_array($leaveApplication->leave_type_id, [1, 2]) && $employeeInformation->is_als == 2) {
                    $leaveApplication->leave_type_id = $leavesConfiguration['NON_ALS_ID'];
                }

                if ($this->LeaveApplications->save($leaveApplication)) {
                    $this->Flash->success(__('The leave application has been saved.'));

                    return $this->redirect('/');
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
    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('main');

        //get leave application information
        $leaveApplication = $this->LeaveApplications->get($id, [
            'contain' => [
                'EmployeeInformation',
                'LeaveTypes',
                'LeaveCategories'
            ],
            'conditions' => [
                'employee_id' => $this->Auth->user('id')
            ]
        ]);

        //if status IN approved,disapproved,cancelled redirect to top page
        if (in_array($leaveApplication->leave_status, [2, 3, 4])) {
            return $this->redirect('/');
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
            $leaveApplication = $this->LeaveApplications->patchEntity($leaveApplication, $this->request->getData());
            if (date('Y-m-d', strtotime($leaveApplication->leave_from)) > date('Y-m-d', strtotime($leaveApplication->leave_to))) {
                $leaveApplication->setErrors(['leave_from' => ['dateCompare' => 'Leave from date must not be greater than leave to date']]);
            }

            if ($leaveApplication->hasErrors()) {
                $leaveApplicationErrors = $leaveApplication->errors();
                $this->Flash->error(__('The leave application could not be saved. Please, try again.'));
            } else {
                $leaveApplication->leave_from = date('Y-m-d', strtotime($leaveApplication->leave_from));
                $leaveApplication->leave_to = date('Y-m-d', strtotime($leaveApplication->leave_to));

                if (in_array($leaveApplication->leave_type_id, [1, 2]) && $leaveApplication->employee_information->is_als == 2) {
                    $leaveApplication->leave_type_id = $leavesConfiguration['NON_ALS_ID'];
                }

                if ($this->LeaveApplications->save($leaveApplication)) {
                    $this->Flash->success(__('The leave application has been saved.'));

                    return $this->redirect('/');
                }
                $this->Flash->error(__('The leave application could not be saved. Please, try again.'));
            }
        }

        $this->set(compact(
            'leaveApplication',
            'leaveBalance',
            'leaveTypes',
            'leaveCategories',
            'leaveApplicationErrors'
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
        $leaveApplication = $this->LeaveApplications->get($id);
        if ($this->LeaveApplications->delete($leaveApplication)) {
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
        if ($this->Auth->user('role_id') != Configure::read('EMPLOYEES.ROLES.Principal')) {
            return $this->redirect('/');
        }

        $leaveApplications = $this->LeaveApplications->find('all', [
            'contain' => [
                'EmployeeInformation' => ['JobPositions'],
                'LeaveApplicationResponses'
            ],
            'conditions' => [
                'LeaveApplications.leave_status IN' => [2, 4],
                'LeaveApplications.deleted' => 0
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
            //edit leave application status
            $editLeaveApplication = $this->LeaveApplications->get($this->request->getData('id'));
            $leaveStatus['LeaveApplications']['leave_status'] = Configure::read('LEAVES.STATUS.Cancelled');
            $saveData = $this->LeaveApplications->patchEntity($editLeaveApplication, $leaveStatus);

            //send response error if failed
            $responseError['message'] = 'The given data was invalid';

            if ($this->LeaveApplications->save($saveData)) {
                return $this->response->withStatus(200)
                    ->withStringBody(json_encode(['status' => true], JSON_UNESCAPED_UNICODE));
            }

            return $this->response->withStatus(422)
                ->withStringBody(json_encode($responseError, JSON_UNESCAPED_UNICODE));
        }
    }
}
