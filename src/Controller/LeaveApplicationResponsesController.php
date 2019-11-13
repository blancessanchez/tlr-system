<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;

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
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('LeaveApplications');
        $this->loadModel('LeaveBalances');
        $this->loadModel('LeaveTypes');
        $this->loadModel('Terms');
    }

    /**
     * Index method
     *
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['LeaveApplications']
        ];
        $leaveApplicationResponses = $this->paginate($this->LeaveApplicationResponses);

        $this->set(compact('leaveApplicationResponses'));
    }

    /**
     * View method
     *
     */
    public function view($id = null)
    {
        $leaveApplicationResponse = $this->LeaveApplicationResponses->get($id, [
            'contain' => ['LeaveApplications']
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
            //new leave application response
            $leaveApplicationResponse = $this->LeaveApplicationResponses->newEntity($this->request->getData());

            //edit leave application status
            $editLeaveApplication = $this->LeaveApplications->get($this->request->getData('id'), [
                'contain' => [
                    'EmployeeInformation'
                ]
            ]);

            //checks if teacher is ALS or NOT
            $findLeaveType = null;
            if ($editLeaveApplication->employee_information->is_als === 1) {
                if ($editLeaveApplication->leave_type_id == 1) {
                    $findLeaveType = 1;
                } elseif ($editLeaveApplication->leave_type_id == 2) {
                    $findLeaveType = 2;
                } elseif ($editLeaveApplication->leave_type_id == 4) {
                    $findLeaveType = 4;
                } elseif ($editLeaveApplication->leave_type_id == 5) {
                    $findLeaveType = 5;
                }
            } elseif ($editLeaveApplication->employee_information->is_als === 2) {
                if ($editLeaveApplication->leave_type_id == 6) {
                    $findLeaveType = 6;
                } elseif ($editLeaveApplication->leave_type_id == 4) {
                    $findLeaveType = 4;
                } elseif ($editLeaveApplication->leave_type_id == 5) {
                    $findLeaveType = 5;
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
            $earlier = new \DateTime($editLeaveApplication->leave_from);
            $later = new \DateTime($editLeaveApplication->leave_to);
            $diff = $later->diff($earlier)->format('%a') + 1;

            $editLeaveBalance = $this->LeaveBalances->get($getLeaveBalance['id']);
            $leaveBalance['LeaveBalances']['balance'] = $getLeaveBalance['balance'];

            if ($this->request->getData('recommendation_type') == 0) {
                $leaveStatus['LeaveApplications']['leave_status'] = Configure::read('LEAVES.STATUS.Approved');
                $leaveBalance['LeaveBalances']['balance'] = $getLeaveBalance['balance'] - $diff;
            } elseif ($this->request->getData('recommendation_type') == 1) {
                if (empty($this->request->getData('recommendation_description'))) {
                    $leaveApplicationResponse->setErrors(['recommendation_description' => ['_required' => 'Disapproved description is required']]);
                }
                $leaveStatus['LeaveApplications']['leave_status'] = Configure::read('LEAVES.STATUS.Disapproved');
            }

            //send response error if failed
            $responseError = [
                'message' => 'The given data was invalid',
                'errors' => $leaveApplicationResponse->errors()
            ];

            $leaveApplicationResponse->application_id = $this->request->getData('id');
            if ($this->LeaveApplicationResponses->save($leaveApplicationResponse)) {
                $table = $this->LeaveApplications->patchEntity($editLeaveApplication, $leaveStatus);
                $tableBalance = $this->LeaveBalances->patchEntity($editLeaveBalance, $leaveBalance);

                //update record
                $this->LeaveApplications->save($table);
                $this->LeaveBalances->save($tableBalance);

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
        $leaveApplications = $this->LeaveApplicationResponses->LeaveApplications->find('list', ['limit' => 200]);
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
