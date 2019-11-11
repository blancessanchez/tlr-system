<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EmployeeInformation Entity
 *
 * @property int $id
 * @property int $role_id
 * @property int $employee_no
 * @property string $password
 * @property string $last_name
 * @property string $first_name
 * @property string $middle_name
 * @property int $job_position_id
 * @property string|null $salary
 * @property string $address
 * @property string $mobile_no
 * @property string $email
 * @property \Cake\I18n\FrozenDate|null $hired_date
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime|null $deleted_date
 * @property int|null $deleted
 *
 * @property \App\Model\Entity\Employee $employee
 * @property \App\Model\Entity\JobPosition $job_position
 */
class EmployeeInformation extends Entity
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
        'role_id' => true,
        'employee_no' => true,
        'password' => true,
        'last_name' => true,
        'first_name' => true,
        'middle_name' => true,
        'gender' => true,
        'job_position_id' => true,
        'salary' => true,
        'address' => true,
        'mobile_no' => true,
        'email' => true,
        'hired_date' => true,
        'status' => true,
        'is_als' => true,
        'created' => true,
        'modified' => true,
        'deleted_date' => true,
        'deleted' => true,
        'employee' => true,
        'job_position' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
}
