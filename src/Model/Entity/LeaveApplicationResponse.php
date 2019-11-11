<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LeaveApplicationResponse Entity
 *
 * @property int $id
 * @property int $application_id
 * @property int $recommendation_type
 * @property string|null $recommendation_description
 * @property int $days_with_pay
 * @property int $days_without_pay
 * @property string|null $notes
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime|null $deleted_date
 * @property int|null $deleted
 *
 * @property \App\Model\Entity\Application $application
 */
class LeaveApplicationResponse extends Entity
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
        'application_id' => true,
        'recommendation_type' => true,
        'recommendation_description' => true,
        'created' => true,
        'modified' => true,
        'deleted_date' => true,
        'deleted' => true,
        'application' => true
    ];
}
