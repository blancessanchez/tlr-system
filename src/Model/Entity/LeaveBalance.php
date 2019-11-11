<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LeaveBalance Entity
 *
 * @property int $id
 * @property int $employee_id
 * @property int $balance
 * @property int|null $leave_type_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime|null $deleted_date
 * @property int|null $deleted
 *
 * @property \App\Model\Entity\Employee $employee
 * @property \App\Model\Entity\LeaveType $leave_type
 */
class LeaveBalance extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'employee_id' => true,
        'balance' => true,
        'leave_type_id' => true,
        'created' => true,
        'modified' => true,
        'deleted_date' => true,
        'deleted' => true,
        'employee' => true,
        'leave_type' => true,
        'term_id' => true,
    ];
}
