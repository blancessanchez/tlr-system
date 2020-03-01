<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * Leave component
 */
class LeaveComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * Getting all date in range
     * 
     * @param date $start date_from leave
     * @param date $end date_to leave
     * @param date format
     * 
     * @return array
     */
    public function getDatesFromRange($start, $end, $format = 'Y-m-d')
    {
        // Declare an empty array 
        $dateArray = [];

        // Use strtotime function 
        $dateFrom = strtotime($start); 
        $dateTo = strtotime($end); 
        
        // Use for loop to store dates into array 
        // 86400 sec = 24 hrs = 60*60*24 = 1 day 
        for ($currentDate = $dateFrom; $currentDate <= $dateTo; $currentDate += (86400)) 
        {
            $weekDay = date('w', $currentDate);
            if ($weekDay == 0 || $weekDay == 6) {
                
            } else {
                $date = date('Y-m-d', $currentDate); 
                $dateArray[] = $date;
            }
        }

        return count($dateArray);
    }
}
