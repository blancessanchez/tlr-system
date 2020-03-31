<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LeaveApplicationResponses Model
 *
 * @property \App\Model\Table\ApplicationsTable|\Cake\ORM\Association\BelongsTo $Applications
 *
 * @method \App\Model\Entity\LeaveApplicationResponse get($primaryKey, $options = [])
 * @method \App\Model\Entity\LeaveApplicationResponse newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\LeaveApplicationResponse[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LeaveApplicationResponse|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LeaveApplicationResponse saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LeaveApplicationResponse patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\LeaveApplicationResponse[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\LeaveApplicationResponse findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LeaveApplicationResponsesTable extends Table
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

        $this->setTable('leave_application_responses');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Leaves', [
            'foreignKey' => 'application_id',
            'joinType' => 'INNER'
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
            ->integer('recommendation_type')
            ->requirePresence('recommendation_type', 'create')
            ->notEmptyString('recommendation_type');

        $validator
            ->scalar('recommendation_description')
            ->maxLength('recommendation_description', 255)
            ->allowEmptyString('recommendation_description');

        $validator
            ->scalar('recommendation_description_by_admin')
            ->maxLength('recommendation_description_by_admin', 255)
            ->allowEmptyString('recommendation_description_by_admin');

        $validator
            ->scalar('recommendation_description_by_head_teacher')
            ->maxLength('recommendation_description_by_head_teacher', 255)
            ->allowEmptyString('recommendation_description_by_head_teacher');

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
        $rules->add($rules->existsIn(['application_id'], 'Leaves'));

        return $rules;
    }
}
