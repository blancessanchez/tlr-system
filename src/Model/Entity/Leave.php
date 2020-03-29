<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Leave Entity
 *
 * @property int $id
 * @property int $employee_id
 * @property int $leave_type_id
 * @property int|null $leave_category_id
 * @property string|null $leave_description
 * @property int|null $applied_for
 * @property string $leave_from
 * @property string $leave_to
 * @property int|null $commutation
 * @property int|null $deductible_to_service_credit
 * @property int|null $is_success
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime|null $deleted_date
 * @property int|null $deleted
 *
 * @property \App\Model\Entity\Employee $employee
 * @property \App\Model\Entity\LeaveType $leave_type
 * @property \App\Model\Entity\LeaveCategory $leave_category
 */
class Leave extends Entity
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
        'leave_type_id' => true,
        'leave_category_id' => true,
        'leave_description' => true,
        'applied_for' => true,
        'leave_from' => true,
        'leave_to' => true,
        'commutation' => true,
        'deductible_to_service_credit' => true,
        'is_success' => true,
        'leave_status' => true,
        'created' => true,
        'modified' => true,
        'deleted_date' => true,
        'deleted' => true,
        'employee' => true,
        'leave_type' => true,
        'leave_category' => true
    ];
}
