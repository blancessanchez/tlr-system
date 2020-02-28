<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Roles Controller
 *
 * @property \App\Model\Table\RolesTable $Roles
 *
 * @method \App\Model\Entity\Role[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RolesController extends AppController
{
    /**
     * Initialize method
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->viewBuilder()->setLayout('main');

        $roles = TableRegistry::get('Roles')
            ->find('all', [
                'conditions' => [
                    'Roles.deleted' => 0
                ],
                'order' => [
                    'Roles.id ASC'
                ]
            ])
            ->toArray();

        $this->set(compact('roles'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->viewBuilder()->setLayout('main');
        $roleErrors = [];
        $role = $this->Roles->newEntity();
        if ($this->request->is('post')) {
            $role = $this->Roles->patchEntity($role, $this->request->getData());
            if ($role->hasErrors()) {
                $roleErrors = $role->errors();
                $this->Flash->error(__('The role could not be saved. Please, try again.'));
            } else {
                if ($this->Roles->save($role)) {
                    $this->Flash->success(__('The role has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The role could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('role', 'roleErrors'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('main');
        $roleErrors = [];
        $role = $this->Roles->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $role = $this->Roles->patchEntity($role, $this->request->getData());
            if ($role->hasErrors()) {
                $roleErrors = $role->errors();
                $this->Flash->error(__('The role could not be saved. Please, try again.'));
            } else {
                if ($this->Roles->save($role)) {
                    $this->Flash->success(__('The role has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The role could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('role', 'roleErrors'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $role = $this->Roles->get($id);

        // update to deleted = 1
        $role->deleted = 1;
        $role->deleted_date = date('Y-m-d H:i:s');

        $role = $this->Roles->patchEntity($role, $this->request->getData());

        if ($this->Roles->save($role)) {
            $this->Flash->success(__('The role has been deleted.'));

            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('The role could not be deleted. Please, try again.'));
    }
}
