<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;

/**
 * ActivityLog component
 */
class ActivityLogComponent extends Component
{
    /**
     * Initialize method
     * 
     * @param array $config configurations
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->ActivityLog = TableRegistry::get('ActivityLogs');
    }

    /**
     * Logging in ActivityLog
     * 
     * @param int $employeeId employee id
     * @param string $description description of activity
     * @return bool
     */
    public function logginginActivityLog($employeeId, $description)
    {
        $toInsert['employee_id'] = $employeeId;
        $toInsert['description'] = $description;

        $entity = $this->ActivityLog->newEntity();
        $dataSave = $this->ActivityLog->patchEntity($entity, $toInsert);
        try {
            $this->ActivityLog->save($dataSave);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
