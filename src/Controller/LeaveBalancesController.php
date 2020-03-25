<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * LeaveBalances Controller
 *
 * @property \App\Model\Table\LeaveBalancesTable $LeaveBalances
 *
 * @method \App\Model\Entity\LeaveBalance[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LeaveBalancesController extends AppController
{
    /**
     * Initialize method
     * 
     * @return Response|null
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('ServiceCreditHistory');
        $this->loadComponent('ActivityLog');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['EmployeeInformation', 'Terms', 'LeaveTypes']
        ];
        $leaveBalances = $this->paginate($this->LeaveBalances);

        $this->set(compact('leaveBalances'));
    }

    /**
     * View method
     *
     * @param string|null $id Leave Balance id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $leaveBalance = $this->LeaveBalances->get($id, [
            'contain' => ['EmployeeInformation', 'Terms', 'LeaveTypes']
        ]);

        $this->set('leaveBalance', $leaveBalance);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $leaveBalance = $this->LeaveBalances->newEntity();
        if ($this->request->is('post')) {
            $leaveBalance = $this->LeaveBalances->patchEntity($leaveBalance, $this->request->getData());
            if ($this->LeaveBalances->save($leaveBalance)) {
                $this->Flash->success(__('The leave balance has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The leave balance could not be saved. Please, try again.'));
        }
        $employeeInformation = $this->LeaveBalances->EmployeeInformation->find('list', ['limit' => 200]);
        $terms = $this->LeaveBalances->Terms->find('list', ['limit' => 200]);
        $leaveTypes = $this->LeaveBalances->LeaveTypes->find('list', ['limit' => 200]);
        $this->set(compact('leaveBalance', 'employeeInformation', 'terms', 'leaveTypes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Leave Balance id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('main');
        $leaveBalance = $this->LeaveBalances->get($id, [
            'contain' => [
                'EmployeeInformation'
            ]
        ]);
        $leaveBalanceError = [];
        $serviceCreditHistoryError = [];
        $data = $this->request->getData();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $leaveBalance = $this->LeaveBalances->patchEntity($leaveBalance, $data['LeaveBalances']);
            $serviceCreditHistory = $this->ServiceCreditHistory->newEntity($data['ServiceCreditHistory']);
            if ($leaveBalance->hasErrors() || $serviceCreditHistory->hasErrors()) {
                $leaveBalanceError = $leaveBalance->errors();
                $serviceCreditHistoryError = $serviceCreditHistory->errors();
                $this->Flash->error(__('The service credit could not be saved. Please, try again.'));
            } else {
                $serviceCreditHistory->employee_id = $leaveBalance->employee_id;
                $serviceCreditHistory->leave_balance_id = $leaveBalance->id;
                $serviceCreditHistory->current_balance = $data['LeaveBalances']['balance'];
                if ($this->LeaveBalances->save($leaveBalance) && $this->ServiceCreditHistory->save($serviceCreditHistory)) {
                    $session = $this->getRequest()->getSession();
                    $this->ActivityLog->logginginActivityLog($session->read('Auth.User.id'),
                        'Modified Service Credit of Employee Number ' . $leaveBalance->employee_information->employee_no);
                    $this->Flash->success(__('The service credit has been saved.'));
    
                    return $this->redirect('/employees/view/' . $leaveBalance->employee_id);
                }
                $this->Flash->error(__('The service credit could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('leaveBalance', 'leaveBalanceError', 'serviceCreditHistoryError'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Leave Balance id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $leaveBalance = $this->LeaveBalances->get($id);
        if ($this->LeaveBalances->delete($leaveBalance)) {
            $this->Flash->success(__('The leave balance has been deleted.'));
        } else {
            $this->Flash->error(__('The leave balance could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
