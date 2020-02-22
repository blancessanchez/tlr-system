<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LeaveType Entity
 *
 * @property int $id
 * @property string $description
 * @property int $days_applicable
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime|null $deleted_date
 * @property int|null $deleted
 *
 * @property \App\Model\Entity\LeaveApplication[] $leaves
 * @property \App\Model\Entity\LeaveBalance[] $leave_balances
 */
class LeaveType extends Entity
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
        'description' => true,
        'days_applicable' => true,
        'created' => true,
        'modified' => true,
        'deleted_date' => true,
        'deleted' => true,
        'leaves' => true,
        'leave_balances' => true
    ];
}
