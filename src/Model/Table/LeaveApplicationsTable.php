<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LeaveApplications Model
 *
 * @property \App\Model\Table\EmployeeInformationTable|\Cake\ORM\Association\BelongsTo $EmployeeInformation
 * @property \App\Model\Table\LeaveTypesTable|\Cake\ORM\Association\BelongsTo $LeaveTypes
 * @property \App\Model\Table\LeaveCategoriesTable|\Cake\ORM\Association\BelongsTo $LeaveCategories
 *
 * @method \App\Model\Entity\LeaveApplication get($primaryKey, $options = [])
 * @method \App\Model\Entity\LeaveApplication newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\LeaveApplication[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LeaveApplication|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LeaveApplication saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LeaveApplication patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\LeaveApplication[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\LeaveApplication findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LeaveApplicationsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('leave_applications');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('EmployeeInformation', [
            'foreignKey' => 'employee_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('LeaveTypes', [
            'foreignKey' => 'leave_type_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('LeaveCategories', [
            'foreignKey' => 'leave_category_id'
        ]);
        $this->hasOne('LeaveApplicationResponses', [
            'foreignKey' => 'application_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('leave_description')
            ->maxLength('leave_description', 255)
            ->allowEmptyString('leave_description');

        $validator
            ->integer('applied_for')
            ->allowEmptyString('applied_for');
        
        $validator
            ->integer('leave_type_id')    
            ->requirePresence('leave_type_id', 'create')
            ->notEmptyString('leave_type_id', 'Leave type must not be empty');

        $validator
            ->scalar('leave_from', 'mdy')
            ->maxLength('leave_from', 255)
            ->requirePresence('leave_from', 'create')
            ->notEmptyString('leave_from', 'Leave from must not be empty');

        $validator
            ->scalar('leave_to', 'mdy')
            ->maxLength('leave_to', 255)
            ->requirePresence('leave_to', 'create')
            ->notEmptyString('leave_to', 'Leave to must not be empty');

        $validator
            ->integer('commutation')
            ->notEmptyString('commutation', 'Commutation must not be empty');

        $validator
            ->integer('is_success')
            ->allowEmptyString('is_success');

        $validator
            ->dateTime('deleted_date')
            ->allowEmptyDateTime('deleted_date');

        $validator
            ->integer('deleted')
            ->allowEmptyString('deleted');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['employee_id'], 'EmployeeInformation'));
        $rules->add($rules->existsIn(['leave_type_id'], 'LeaveTypes'));
        $rules->add($rules->existsIn(['leave_category_id'], 'LeaveCategories'));

        return $rules;
    }
}
