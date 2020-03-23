<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Departments Controller
 *
 * @property \App\Model\Table\DepartmentsTable $Departments
 *
 * @method \App\Model\Entity\Department[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DepartmentsController extends AppController
{
    /**
     * Initialize method
     * 
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('ActivityLog');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->viewBuilder()->setLayout('main');

        $departments = TableRegistry::get('Departments')
            ->find('all', [
                'conditions' => [
                    'Departments.deleted' => 0
                ]
            ])
            ->toArray();

        $this->set(compact('departments'));
    }

    /**
     * View method
     *
     * @param string|null $id Department id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $department = $this->Departments->get($id, [
            'contain' => ['EmployeeInformation']
        ]);

        $this->set('department', $department);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->viewBuilder()->setLayout('main');
        $departmentErrors = [];
        $department = $this->Departments->newEntity();
        if ($this->request->is('post')) {
            $department = $this->Departments->patchEntity($department, $this->request->getData());
            if ($department->hasErrors()) {
                $departmentErrors = $department->errors();
                $this->Flash->error(__('The department information could not be saved. Please, try again.'));
            } else {
                if ($this->Departments->save($department)) {
                    // logging in activity log
                    $session = $this->getRequest()->getSession();
                    $this->ActivityLog->logginginActivityLog($session->read('Auth.User.id'), 'Addition of Deparment Information');
                    $this->Flash->success(__('The department has been saved.'));
    
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The department could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('department', 'departmentErrors'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Department id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('main');
        $departmentErrors = [];
        $department = $this->Departments->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $department = $this->Departments->patchEntity($department, $this->request->getData());
            if ($department->hasErrors()) {
                $departmentErrors = $department->errors();
                $this->Flash->error(__('The department information could not be saved. Please, try again.'));
            } else {
                if ($this->Departments->save($department)) {
                    // logging in activity log
                    $session = $this->getRequest()->getSession();
                    $this->ActivityLog->logginginActivityLog($session->read('Auth.User.id'), 'Edit of department information');
                    $this->Flash->success(__('The department has been saved.'));
    
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The department could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('department', 'departmentErrors'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Department id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $department = $this->Departments->get($id);

        // update to deleted = 1
        $department->deleted = 1;
        $department->deleted_date = date('Y-m-d H:i:s');

        $department = $this->Departments->patchEntity($department, $this->request->getData());
        // logging in activity log
        $session = $this->getRequest()->getSession();
        $this->ActivityLog->logginginActivityLog($session->read('Auth.User.id'), 'Delete department information');
        if ($this->Departments->save($department)) {
            $this->Flash->success(__('The department has been deleted.'));

            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('The department could not be deleted. Please, try again.'));

        return $this->redirect(['action' => 'index']);
    }
}
