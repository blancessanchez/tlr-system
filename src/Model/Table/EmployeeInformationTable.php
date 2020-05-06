<?php
namespace App\Model\Table;

use Cake\Auth\DefaultPasswordHasher;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EmployeeInformation Model
 *
 * @property |\Cake\ORM\Association\BelongsTo $Roles
 * @property \App\Model\Table\JobPositionsTable|\Cake\ORM\Association\BelongsTo $JobPositions
 *
 * @method \App\Model\Entity\EmployeeInformation get($primaryKey, $options = [])
 * @method \App\Model\Entity\EmployeeInformation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EmployeeInformation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EmployeeInformation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EmployeeInformation saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EmployeeInformation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EmployeeInformation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EmployeeInformation findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EmployeeInformationTable extends Table
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

        $this->setTable('employee_information');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('ActivityLogs', [
            'foreignKey' => 'employee_id'
        ]);
        $this->hasMany('Leaves', [
            'foreignKey' => 'employee_id'
        ]);
        $this->hasMany('LeaveBalances', [
            'foreignKey' => 'employee_id'
        ]);
        $this->belongsTo('JobPositions', [
            'foreignKey' => 'job_position_id',
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
            ->integer('role_id')
            ->requirePresence('role_id', 'create')
            ->notEmptyString('role_id', 'Role must be not empty')
            ->add('role_id', 'custom', [
                'rule' => function ($value, $context) {
                    if ($context['data']['role_id'] == Configure::read('EMPLOYEES.ROLES.Principal')) {
                        $query = $this->find()->where([
                            'role_id' => $context['data']['role_id']
                        ])->first();
                        $isExistPrincipal = $query->toArray();
    
                        if (!empty($isExistPrincipal)) {
                            return false;
                        }
                        return true;
                    }
                    return true;
                },
                'message' => 'Principal already existing'
            ]);

        $validator
            ->integer('employee_no')
            ->requirePresence('employee_no', 'create')
            ->notEmptyString('employee_no', 'Employee Number must be not empty')
            ->add('employee_no', 'unique', [
                'rule'=> 'validateUnique',
                'provider' => 'table',
                'message' => 'Employee number already in use'
            ]);
        
        $validator
            ->integer('department_id')
            ->requirePresence('department_id', 'create')
            ->notEmptyString('department_id', 'Department must be not empty');

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmptyString('password', 'Password must be not empty');

        $validator
            ->scalar('confirm_password')
            ->maxLength('confirm_password', 255)
            ->requirePresence('confirm_password', 'create')
            ->notEmptyString('confirm_password', 'Confirm Password must be not empty')
            ->add('confirm_password', [
                'compare' => [
                    'rule' => ['compareWith', 'password']
                ]
            ]);
        
        $validator
            ->scalar('current_password')
            ->maxLength('current_password', 255)
            ->notEmptyString('current_password', 'Current Password must be not empty')
            ->add('current_password', 'custom', [
                'rule' => function ($value, $context) {
                    $query = $this->find()->where([
                        'id' => $context['data']['id']
                    ])->first();
                    $data = $query->toArray();

                    return (new DefaultPasswordHasher)->check($value, $data['password']);
                },
                'message' => 'Current password is incorrect'
            ]);

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 255)
            ->requirePresence('last_name', 'create')
            ->notEmptyString('last_name', 'Last Name must be not empty');

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 255)
            ->requirePresence('first_name', 'create')
            ->notEmptyString('first_name', 'First Name must be not empty');

        $validator
            ->scalar('middle_name')
            ->maxLength('middle_name', 255)
            ->allowEmptyString('middle_name');

        $validator
            ->integer('gender')
            ->allowEmptyString('gender');

        $validator
            ->email('email')
            ->allowEmptyString('email');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmptyString('status', 'Status must be not empty');

        $validator
            ->integer('is_als')
            ->requirePresence('is_als', 'create')
            ->notEmptyString('is_als', 'Type of teacher must be not empty');

        $validator
            ->dateTime('deleted_date')
            ->allowEmptyDateTime('deleted_date');

        $validator
            ->integer('deleted')
            ->allowEmptyString('deleted');

        $validator
            ->integer('job_position_id')
            ->requirePresence('job_position_id', 'create')
            ->notEmptyString('job_position_id', 'Job Position must be not empty');

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
        // $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['job_position_id'], 'JobPositions'));

        return $rules;
    }

    /**
     * Before save, it encrypts the inputted password
     *
     * @param Event $event CakePHP event
     * @return bool
     */
    public function beforeSave(Event $event)
    {
        $entity = $event->getData('entity');
        $hasher = new DefaultPasswordHasher();
        // Bcrypt the token so BasicAuthenticate can check
        // it during login.
        $entity->password = $hasher->hash($entity->password);

        return true;
    }
}
