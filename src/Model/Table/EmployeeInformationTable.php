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

        $validator
            ->scalar('name_extension')
            ->maxLength('name_extension', 255)
            ->allowEmptyString('name_extension');

        $validator
            ->integer('gender')
            ->allowEmptyString('gender');

        $validator
            ->date('birth_date')
            ->allowEmptyDate('birth_date');
        
        $validator
            ->scalar('residential_address')
            ->maxLength('residential_address', 255)
            ->allowEmptyString('residential_address');
        
        $validator
            ->scalar('birth_place')
            ->maxLength('birth_place', 255)
            ->allowEmptyString('birth_place');

        $validator
            ->integer('civil_status')
            ->allowEmptyString('civil_status');
        
        $validator
            ->integer('height')
            ->allowEmptyString('height');
        
        $validator
            ->integer('weight')
            ->allowEmptyString('weight');

        $validator
            ->scalar('blood_type')
            ->maxLength('blood_type', 10)
            ->allowEmptyString('blood_type');
        
        $validator
            ->scalar('gsis_id_no')
            ->maxLength('gsis_id_no', 255)
            ->allowEmptyString('gsis_id_no');

        $validator
            ->scalar('pagibig_id_no')
            ->maxLength('pagibig_id_no', 255)
            ->allowEmptyString('pagibig_id_no');
        
        $validator
            ->scalar('philhealth_no')
            ->maxLength('philhealth_no', 255)
            ->allowEmptyString('philhealth_no');
        
        $validator
            ->scalar('sss_no')
            ->maxLength('sss_no', 255)
            ->allowEmptyString('sss_no');

        $validator
            ->scalar('tin_no')
            ->maxLength('tin_no', 255)
            ->allowEmptyString('tin_no');

        $validator
            ->scalar('agency_employee_no')
            ->maxLength('agency_employee_no', 255)
            ->allowEmptyString('agency_employee_no');

        $validator
            ->integer('citizenship')
            ->allowEmptyString('citizenship');

        $validator
            ->integer('citizenship_dual')
            ->allowEmptyString('citizenship_dual');

        $validator
            ->integer('citizenship_country')
            ->allowEmptyString('citizenship_country');

        $validator
            ->scalar('residential_zipcode')
            ->maxLength('residential_zipcode', 255)
            ->allowEmptyString('residential_zipcode');
        
        $validator
            ->scalar('permanent_address')
            ->maxLength('permanent_address', 255)
            ->allowEmptyString('permanent_address');

        $validator
            ->scalar('permanent_zipcode')
            ->maxLength('permanent_zipcode', 255)
            ->allowEmptyString('permanent_zipcode');

        $validator
            ->scalar('telephone_no')
            ->maxLength('telephone_no', 255)
            ->allowEmptyString('telephone_no');

        $validator
            ->scalar('image')
            ->maxLength('image', 255)
            ->allowEmptyString('image');

        $validator
            ->scalar('government_issued_id')
            ->maxLength('government_issued_id', 255)
            ->allowEmptyString('government_issued_id');

        $validator
            ->scalar('id_no')
            ->maxLength('id_no', 255)
            ->allowEmptyString('id_no');

        $validator
            ->scalar('place_of_issue')
            ->maxLength('place_of_issue', 255)
            ->allowEmptyString('place_of_issue');

        $validator
            ->date('date_accomplished')
            ->allowEmptyDate('date_accomplished');

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
