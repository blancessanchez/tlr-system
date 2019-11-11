<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * JobPositions Model
 *
 * @property \App\Model\Table\EmployeeInformationTable|\Cake\ORM\Association\HasMany $EmployeeInformation
 *
 * @method \App\Model\Entity\JobPosition get($primaryKey, $options = [])
 * @method \App\Model\Entity\JobPosition newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\JobPosition[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\JobPosition|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\JobPosition saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\JobPosition patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\JobPosition[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\JobPosition findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class JobPositionsTable extends Table
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

        $this->setTable('job_positions');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('EmployeeInformation', [
            'foreignKey' => 'job_position_id'
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
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->dateTime('deleted_date')
            ->allowEmptyDateTime('deleted_date');

        $validator
            ->integer('deleted')
            ->allowEmptyString('deleted');

        return $validator;
    }
}
