<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * JobPositions Controller
 *
 * @property \App\Model\Table\JobPositionsTable $JobPositions
 *
 * @method \App\Model\Entity\JobPosition[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class JobPositionsController extends AppController
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

        $jobPositions = TableRegistry::get('JobPositions')
            ->find('all', [
                'conditions' => [
                    'JobPositions.deleted' => 0
                ]
            ])
            ->toArray();

        $this->set(compact('jobPositions'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->viewBuilder()->setLayout('main');
        $jobPositionErrors = [];
        $jobPosition = $this->JobPositions->newEntity();
        if ($this->request->is('post')) {
            $jobPosition = $this->JobPositions->patchEntity($jobPosition, $this->request->getData());
            if ($jobPosition->hasErrors()) {
                $jobPositionErrors = $jobPosition->errors();
                $this->Flash->error(__('The job position information could not be saved. Please, try again.'));
            } else {
                if ($this->JobPositions->save($jobPosition)) {
                    // loging in activity log
                    $session = $this->getRequest()->getSession();
                    $this->ActivityLog->logginginActivityLog($session->read('Auth.User.id'), 'Addition of Job Position');
                    $this->Flash->success(__('The job position has been saved.'));
    
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The job position information could not be saved. Please, try again.'));
            }
        }

        $this->set(compact('jobPosition', 'jobPositionErrors'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Job Position id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('main');
        $jobPositionErrors = [];
        $jobPosition = $this->JobPositions->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $jobPosition = $this->JobPositions->patchEntity($jobPosition, $this->request->getData());
            if ($jobPosition->hasErrors()) {
                $jobPositionErrors = $jobPosition->errors();
                $this->Flash->error(__('The job position information could not be saved. Please, try again.'));
            } else {
                if ($this->JobPositions->save($jobPosition)) {
                    // loging in activity log
                    $session = $this->getRequest()->getSession();
                    $this->ActivityLog->logginginActivityLog($session->read('Auth.User.id'), 'Edit of Job Position');
                    $this->Flash->success(__('The job position has been saved.'));
    
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The job position could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('jobPosition', 'jobPositionErrors'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Job Position id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $jobPosition = $this->JobPositions->get($id);

        // update to deleted = 1
        $jobPosition->deleted = 1;
        $jobPosition->deleted_date = date('Y-m-d H:i:s');

        $jobPosition = $this->JobPositions->patchEntity($jobPosition, $this->request->getData());
        // loging in activity log
        $session = $this->getRequest()->getSession();
        $this->ActivityLog->logginginActivityLog($session->read('Auth.User.id'), 'Deletion of job position');
        if ($this->JobPositions->save($jobPosition)) {
            $this->Flash->success(__('The job position has been deleted.'));

            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('The job position could not be saved. Please, try again.'));

        return $this->redirect(['action' => 'index']);
    }
}
