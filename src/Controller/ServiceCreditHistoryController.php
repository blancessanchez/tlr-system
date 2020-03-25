<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ServiceCreditHistory Controller
 *
 * @property \App\Model\Table\ServiceCreditHistoryTable $ServiceCreditHistory
 *
 * @method \App\Model\Entity\ServiceCreditHistory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ServiceCreditHistoryController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $serviceCreditHistory = $this->paginate($this->ServiceCreditHistory);

        $this->set(compact('serviceCreditHistory'));
    }

    /**
     * View method
     *
     * @param string|null $id Service Credit History id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $serviceCreditHistory = $this->ServiceCreditHistory->get($id, [
            'contain' => []
        ]);

        $this->set('serviceCreditHistory', $serviceCreditHistory);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $serviceCreditHistory = $this->ServiceCreditHistory->newEntity();
        if ($this->request->is('post')) {
            $serviceCreditHistory = $this->ServiceCreditHistory->patchEntity($serviceCreditHistory, $this->request->getData());
            if ($this->ServiceCreditHistory->save($serviceCreditHistory)) {
                $this->Flash->success(__('The service credit history has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The service credit history could not be saved. Please, try again.'));
        }
        $this->set(compact('serviceCreditHistory'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Service Credit History id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $serviceCreditHistory = $this->ServiceCreditHistory->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $serviceCreditHistory = $this->ServiceCreditHistory->patchEntity($serviceCreditHistory, $this->request->getData());
            if ($this->ServiceCreditHistory->save($serviceCreditHistory)) {
                $this->Flash->success(__('The service credit history has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The service credit history could not be saved. Please, try again.'));
        }
        $this->set(compact('serviceCreditHistory'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Service Credit History id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $serviceCreditHistory = $this->ServiceCreditHistory->get($id);
        if ($this->ServiceCreditHistory->delete($serviceCreditHistory)) {
            $this->Flash->success(__('The service credit history has been deleted.'));
        } else {
            $this->Flash->error(__('The service credit history could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * History method
     *
     * @return \Cake\Http\Response|null
     */
    public function history($id = null)
    {
        $this->viewBuilder()->setLayout('main');
        $serviceCreditHistory = $this->ServiceCreditHistory->find('all', [
            'conditions' => [
                'ServiceCreditHistory.employee_id' => $id,
                'ServiceCreditHistory.deleted' => 0
            ]
        ]);
        // pr($serviceCreditHistory);die;

        $this->set(compact('serviceCreditHistory'));
    }
}
