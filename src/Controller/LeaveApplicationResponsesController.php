<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Composer\Config;

/**
 * LeaveApplicationResponses Controller
 *
 * @property \App\Model\Table\LeaveApplicationResponsesTable $LeaveApplicationResponses
 *
 * @method \App\Model\Entity\LeaveApplicationResponse[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LeaveApplicationResponsesController extends AppController
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
        $this->loadModel('LeaveTypes');
        $this->loadModel('Terms');
        $this->loadComponent('ActivityLog');
        $this->loadComponent('Leave');
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Leaves']
        ];
        $leaveApplicationResponses = $this->paginate($this->LeaveApplicationResponses);

        $this->set(compact('leaveApplicationResponses'));
    }

    /**
     * View method
     *
     * @param int $id leave id
     * @return void
     */
    public function view($id = null)
    {
        $leaveApplicationResponse = $this->LeaveApplicationResponses->get($id, [
            'contain' => ['Leaves']
        ]);

        $this->set('leaveApplicationResponse', $leaveApplicationResponse);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $leaveApplicationErrors = [];
        if ($this->request->is('post')) {
            // check current user 
            $currentUser = $this->Auth->user('role_id');

            // get data
            $getData = $this->request->getData();

            //new leave application response
            $leaveApplicationResponse = $this->LeaveApplicationResponses->newEntity($getData['LeaveApplicationResponses']);

            //edit leave application status
            $editLeaveApplication = $this->Leaves->get($this->request->getData('id'), [
                'contain' => [
                    'EmployeeInformation'
                ]
            ]);

            //checks if teacher is ALS or NOT
            $findLeaveType = null;
            if ($editLeaveApplication->employee_information->is_als === Configure::read('EMPLOYEES.ALS.True')) {
                if ($editLeaveApplication->leave_type_id == Configure::read('LEAVES.TYPE.Vacation')) {
                    $findLeaveType = Configure::read('LEAVES.TYPE.Vacation');
                } elseif ($editLeaveApplication->leave_type_id == Configure::read('LEAVES.TYPE.Sick')) {
                    $findLeaveType = Configure::read('LEAVES.TYPE.Sick');
                } elseif ($editLeaveApplication->leave_type_id == Configure::read('LEAVES.TYPE.Maternity')) {
                    $findLeaveType = Configure::read('LEAVES.TYPE.Maternity');
                } elseif ($editLeaveApplication->leave_type_id == Configure::read('LEAVES.TYPE.Paternity')) {
                    $findLeaveType = Configure::read('LEAVES.TYPE.Paternity');
                }
            } else {
                if ($editLeaveApplication->leave_type_id == Configure::read('LEAVES.TYPE.Combo')) {
                    $findLeaveType = Configure::read('LEAVES.TYPE.Combo');
                } elseif ($editLeaveApplication->leave_type_id == Configure::read('LEAVES.TYPE.Maternity')) {
                    $findLeaveType = Configure::read('LEAVES.TYPE.Maternity');
                } elseif ($editLeaveApplication->leave_type_id == Configure::read('LEAVES.TYPE.Paternity')) {
                    $findLeaveType = Configure::read('LEAVES.TYPE.Paternity');
                }
            }

            $getLeaveBalance = $this->LeaveBalances->find('all', [
                'contain' => [
                    'LeaveTypes',
                    'Terms'
                ],
                'conditions' => [
                        'LeaveBalances.employee_id' => $editLeaveApplication->employee_id,
                        'LeaveBalances.leave_type_id' => $findLeaveType,
                        'LeaveBalances.deleted' => 0,
                        'Terms.deleted' => 0
                    ]
                ])
                ->first()
                ->toArray();

            //get days
            $diff = $this->Leave->getDatesFromRange($editLeaveApplication->leave_from, $editLeaveApplication->leave_to);            

            $editLeaveBalance = $this->LeaveBalances->get($getLeaveBalance['id']);
            $leaveBalance['LeaveBalances']['balance'] = $getLeaveBalance['balance'];
            if ($getData['LeaveApplicationResponses']['recommendation_type'] == Configure::read('LEAVE_APPLICATION.RECOMMENDATION_TYPE.Approved')) {
                if ($currentUser == Configure::read('EMPLOYEES.ROLES.Principal')) {
                    $leaveStatus['Leaves']['leave_status'] = Configure::read('LEAVES.STATUS.Approved');
                    if ($diff < $getLeaveBalance['balance']) {
                        $leaveBalance['LeaveBalances']['balance'] = $getLeaveBalance['balance'] - $diff;
                    } else {
                        $leaveBalance['LeaveBalances']['balance'] = $getLeaveBalance['balance'] - $getLeaveBalance['balance'];
                    }
                    if (!empty($getData['Leaves']['deductible_to_service_credit'])) {
                        $getServiceCreditLeaveBalance = $this->LeaveBalances->find('all', [
                            'contain' => [
                                'LeaveTypes',
                                'Terms'
                            ],
                            'conditions' => [
                                    'LeaveBalances.employee_id' => $editLeaveApplication->employee_id,
                                    'LeaveBalances.leave_type_id' => Configure::read('LEAVES.TYPE.ServiceCredit'),
                                    'LeaveBalances.deleted' => 0,
                                    'Terms.deleted' => 0
                                ]
                            ])
                            ->first()
                            ->toArray();
                        $editServiceCreditLeaveBalance = $this->LeaveBalances->get($getServiceCreditLeaveBalance['id']);    
                        $leaveServiceCreditBalance['LeaveBalances']['balance'] = $getServiceCreditLeaveBalance['balance'] - $getData['Leaves']['deductible_to_service_credit'];
                    }
                } else if ($currentUser == Configure::read('EMPLOYEES.ROLES.Admin')) {
                    $leaveStatus['Leaves']['leave_status'] = Configure::read('LEAVES.STATUS.ApprovedByAdmin');
                    if (!empty($getData['Leaves']['deductible_to_service_credit'])) {
                        $leaveStatus['Leaves']['deductible_to_service_credit'] = $getData['Leaves']['deductible_to_service_credit'];
                    }
                } else if ($currentUser == Configure::read('EMPLOYEES.ROLES.HeadTeacher')) {
                    $leaveStatus['Leaves']['leave_status'] = Configure::read('LEAVES.STATUS.ApprovedByHeadTeacher');
                }
            } else {
                if (empty($this->request->getData('recommendation_description'))) {
                    $leaveApplicationResponse->setErrors(['recommendation_description' => ['_required' => 'Disapproved description is required']]);
                }
                if ($currentUser == Configure::read('EMPLOYEES.ROLES.Principal')) {
                    $leaveApplicationResponse->recommendation_description = $getData['LeaveApplicationResponses']['recommendation_description'];
                    $leaveStatus['Leaves']['leave_status'] = Configure::read('LEAVES.STATUS.Disapproved');
                } else if ($currentUser == Configure::read('EMPLOYEES.ROLES.Admin')) {
                    $leaveApplicationResponse->recommendation_description_by_admin = $getData['LeaveApplicationResponses']['recommendation_description'];
                    $leaveApplicationResponse->recommendation_description = null;
                    $leaveStatus['Leaves']['leave_status'] = Configure::read('LEAVES.STATUS.DisapprovedByAdmin');
                } else if ($currentUser == Configure::read('EMPLOYEES.ROLES.HeadTeacher')) {
                    $leaveApplicationResponse->recommendation_description_by_head_teacher = $getData['LeaveApplicationResponses']['recommendation_description'];
                    $leaveApplicationResponse->recommendation_description = null;
                    $leaveStatus['Leaves']['leave_status'] = Configure::read('LEAVES.STATUS.DisapprovedByHeadTeacher');
                }
            }

            //send response error if failed
            $responseError = [
                'message' => 'The given data was invalid',
                'errors' => $leaveApplicationResponse->errors()
            ];

            $leaveApplicationResponse->application_id = $this->request->getData('id');
            // pr($leaveApplicationResponse);die;
            $session = $this->getRequest()->getSession();
            $this->ActivityLog->logginginActivityLog($session->read('Auth.User.id'), 'Responded to Leave Application');

            if ($this->LeaveApplicationResponses->save($leaveApplicationResponse)) {
                $table = $this->Leaves->patchEntity($editLeaveApplication, $leaveStatus);
                $tableBalance = $this->LeaveBalances->patchEntity($editLeaveBalance, $leaveBalance);

                //update record
                $this->Leaves->save($table);
                $this->LeaveBalances->save($tableBalance);

                if (!empty($getData['Leaves']['deductible_to_service_credit'])) {
                    $tableServiceCreditBalance = $this->LeaveBalances->patchEntity($editServiceCreditLeaveBalance, $leaveServiceCreditBalance);
                    $this->LeaveBalances->save($tableServiceCreditBalance);
                }

                $this->Flash->success(__('The leave application response has been saved.'));

                return $this->response->withStatus(200)
                    ->withStringBody(json_encode(['status' => true], JSON_UNESCAPED_UNICODE));
            }

            return $this->response->withStatus(422)
                ->withStringBody(json_encode($responseError, JSON_UNESCAPED_UNICODE));
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Leave Application Response id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $leaveApplicationResponse = $this->LeaveApplicationResponses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $leaveApplicationResponse = $this->LeaveApplicationResponses->patchEntity($leaveApplicationResponse, $this->request->getData());
            if ($this->LeaveApplicationResponses->save($leaveApplicationResponse)) {
                $this->Flash->success(__('The leave application response has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The leave application response could not be saved. Please, try again.'));
        }
        $leaveApplications = $this->LeaveApplicationResponses->Leaves->find('list', ['limit' => 200]);
        $this->set(compact('leaveApplicationResponse', 'leaveApplications'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Leave Application Response id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $leaveApplicationResponse = $this->LeaveApplicationResponses->get($id);
        if ($this->LeaveApplicationResponses->delete($leaveApplicationResponse)) {
            $this->Flash->success(__('The leave application response has been deleted.'));
        } else {
            $this->Flash->error(__('The leave application response could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
