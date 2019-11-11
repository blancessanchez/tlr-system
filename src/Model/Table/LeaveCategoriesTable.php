<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LeaveCategories Model
 *
 * @property |\Cake\ORM\Association\BelongsTo $ParentLeaveTypes
 * @property \App\Model\Table\LeaveApplicationsTable|\Cake\ORM\Association\HasMany $LeaveApplications
 *
 * @method \App\Model\Entity\LeaveCategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\LeaveCategory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\LeaveCategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LeaveCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LeaveCategory saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LeaveCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\LeaveCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\LeaveCategory findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LeaveCategoriesTable extends Table
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

        $this->setTable('leave_categories');
        $this->setDisplayField('description');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('LeaveTypes', [
            'foreignKey' => 'parent_leave_type_id'
        ]);
        $this->hasMany('LeaveApplications', [
            'foreignKey' => 'leave_category_id'
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
            ->scalar('description')
            ->maxLength('description', 255)
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

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
        $rules->add($rules->existsIn(['parent_leave_type_id'], 'LeaveTypes'));

        return $rules;
    }
}
