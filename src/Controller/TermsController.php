<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;

/**
 * Terms Controller
 *
 * @property \App\Model\Table\TermsTable $Terms
 *
 * @method \App\Model\Entity\Term[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TermsController extends AppController
{
    /**
     * Initialize method
     *
     * @return null
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Terms');
        $this->loadModel('LeaveApplications');
        $this->loadModel('LeaveBalances');
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $data = $this->request->getData();

            $currentTerm = TableRegistry::get('Terms')
                ->find('all', [
                    'conditions' => [
                        'Terms.deleted' => 0
                    ]
                ])
                ->first();

            if ($currentTerm) {
                $this->LeaveBalances->query()
                    ->update()
                    ->set([
                        'deleted' => 1,
                        'deleted_date' => date('Y-m-d H:i:s')
                    ])
                    ->where([
                        'term_id' => $currentTerm->id,
                        'deleted' => 0
                    ])
                    ->execute();

                $this->Terms->query()
                    ->update()
                    ->set(['deleted' => 1])
                    ->where(['deleted' => 0])
                    ->execute();
            }

            $term = $this->Terms->newEntity([
                'description' => $data['description'],
                'academic_year' => $data['academic_year']
            ]);

            $term = $this->Terms->save($term);

            $allEmployeeInformations = TableRegistry::get('EmployeeInformation')
                ->find('all', [
                    'conditions' => [
                        'EmployeeInformation.deleted' => 0
                    ]
                ])
                ->toArray();

            foreach ($allEmployeeInformations as $employee) {
                $leaveBalance = [
                    'employee_id' => $employee->id,
                    'term_id' => $term->id,
                    'balance' => 0,
                    'leave_type_id' => 0
                ];

                if ($employee->is_als == 2) {
                    // Combo leave
                    $leaveBalance['balance'] = 15;
                    $leaveBalance['leave_type_id'] = 6;
                    $leaveBalanceEntity = $this->LeaveBalances->newEntity();
                    $this->LeaveBalances->patchEntity($leaveBalanceEntity, $leaveBalance);
                    $this->LeaveBalances->save($leaveBalanceEntity);
                } else {
                    // Vacation leave
                    $leaveBalance['balance'] = 15;
                    $leaveBalance['leave_type_id'] = 1;
                    $leaveBalanceEntity = $this->LeaveBalances->newEntity();
                    $this->LeaveBalances->patchEntity($leaveBalanceEntity, $leaveBalance);
                    $this->LeaveBalances->save($leaveBalanceEntity);

                    // Sick leave
                    $leaveBalance['balance'] = 15;
                    $leaveBalance['leave_type_id'] = 2;
                    $leaveBalanceEntity = $this->LeaveBalances->newEntity();
                    $this->LeaveBalances->patchEntity($leaveBalanceEntity, $leaveBalance);
                    $this->LeaveBalances->save($leaveBalanceEntity);
                }

                if ($employee->gender == 1) {
                    // Paternity leave
                    $leaveBalance['balance'] = 7;
                    $leaveBalance['leave_type_id'] = 5;
                    $leaveBalanceEntity = $this->LeaveBalances->newEntity();
                    $this->LeaveBalances->patchEntity($leaveBalanceEntity, $leaveBalance);
                    $this->LeaveBalances->save($leaveBalanceEntity);
                } else {
                    // Maternity leave
                    $leaveBalance['balance'] = 103;
                    $leaveBalance['leave_type_id'] = 4;
                    $leaveBalanceEntity = $this->LeaveBalances->newEntity();
                    $this->LeaveBalances->patchEntity($leaveBalanceEntity, $leaveBalance);
                    $this->LeaveBalances->save($leaveBalanceEntity);
                }
            }

            return $this->response->withStatus(200)
                    ->withStringBody(json_encode(['status' => true], JSON_UNESCAPED_UNICODE));
        }
    }
}
