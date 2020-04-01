<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;

/**
 * ActivityLogs Controller
 *
 * @property \App\Model\Table\ActivityLogsTable $ActivityLogs
 *
 * @method \App\Model\Entity\ActivityLog[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ActivityLogsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        //denies if role is not principal or admin
        if ($this->Auth->user('role_id') != Configure::read('EMPLOYEES.ROLES.Admin') &&
            $this->Auth->user('role_id') != Configure::read('EMPLOYEES.ROLES.Principal')) {
            return $this->redirect('/home');
        }

        $this->viewBuilder()->setLayout('main');
        $activityLogs = $this->ActivityLogs->find('all', [
            'contain' => [
                'EmployeeInformation'
            ],
            'conditions' => [
                'ActivityLogs.deleted' => 0,
                'EmployeeInformation.deleted' => 0
            ]
        ]);

        $this->set(compact('activityLogs'));
    }

    /**
     * View method
     *
     * @param string|null $id Activity Log id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $activityLog = $this->ActivityLogs->get($id, [
            'contain' => ['EmployeeInformation'],
        ]);

        $this->set('activityLog', $activityLog);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $activityLog = $this->ActivityLogs->newEntity();
        if ($this->request->is('post')) {
            $activityLog = $this->ActivityLogs->patchEntity($activityLog, $this->request->getData());
            if ($this->ActivityLogs->save($activityLog)) {
                $this->Flash->success(__('The activity log has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The activity log could not be saved. Please, try again.'));
        }
        $employeeInformation = $this->ActivityLogs->EmployeeInformation->find('list', ['limit' => 200]);
        $this->set(compact('activityLog', 'employeeInformation'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Activity Log id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $activityLog = $this->ActivityLogs->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $activityLog = $this->ActivityLogs->patchEntity($activityLog, $this->request->getData());
            if ($this->ActivityLogs->save($activityLog)) {
                $this->Flash->success(__('The activity log has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The activity log could not be saved. Please, try again.'));
        }
        $employeeInformation = $this->ActivityLogs->EmployeeInformation->find('list', ['limit' => 200]);
        $this->set(compact('activityLog', 'employeeInformation'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Activity Log id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $activityLog = $this->ActivityLogs->get($id);
        if ($this->ActivityLogs->delete($activityLog)) {
            $this->Flash->success(__('The activity log has been deleted.'));
        } else {
            $this->Flash->error(__('The activity log could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
