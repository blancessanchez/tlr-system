<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;

/**
 * Configurations Controller
 *
 * @property \App\Model\Table\ConfigurationsTable $Configurations
 *
 * @method \App\Model\Entity\Configuration[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ConfigurationsController extends AppController
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
        $this->paginate = [];
        $configurations = $this->paginate($this->Configurations);

        $this->set(compact('configurations'));
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
        $configuration = $this->Configurations->get($id);

        $this->set('configuration', $configuration);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $configuration = $this->Configurations->newEntity();
        if ($this->request->is('post')) {
            $configuration = $this->Configurations->patchEntity($configuration, $this->request->getData());
            if ($this->Configurations->save($configuration)) {
                $this->Flash->success(__('The configuration has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The configuration could not be saved. Please, try again.'));
        }
        $this->set(compact('configuration'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Configuration id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit()
    {
        $this->viewBuilder()->setLayout('main');
        $configurationErrors = [];
        $configuration = $this->Configurations->find('all', [
            'conditions' => [
                'Configurations.id' => 1,
                'Configurations.deleted' => 0
            ]
        ])
        ->first();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $configuration = $this->Configurations->patchEntity($configuration, $this->request->getData());
            if ($configuration->hasErrors()) {
                $configurationErrors = $configuration->errors();
                $this->Flash->error(__('The configuration could not be saved. Please, try again.'));
            } else {
                if ($this->Configurations->save($configuration)) {
                    $this->Flash->success(__('The configuration has been saved.'));
    
                    return $this->redirect('/home');
                }
                $this->Flash->error(__('The configuration could not be saved. Please, try again.'));
            }
        }

        $this->set(compact('configuration', 'configurationErrors'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Configuration id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $configuration = $this->Configurations->get($id);
        if ($this->Configurations->delete($configuration)) {
            $this->Flash->success(__('The configuration has been deleted.'));
        } else {
            $this->Flash->error(__('The configuration could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
