<?php
use Migrations\AbstractMigration;

class InitialMigration extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('activity_logs', [
                'collation' => 'utf8_general_ci'
            ])
            ->addColumn('employee_id', 'integer', [
                'limit' => 11,
                'null' => false
            ])
            ->addColumn('description', 'string', [
                'limit' => 255,
                'null' => false
            ])
            ->addColumn('created', 'datetime', [
                'limit' => null,
                'null' => false
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => null,
                'null' => false
            ])
            ->addColumn('deleted_date', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true
            ])
            ->addColumn('deleted', 'integer', [
                'default' => '0',
                'limit' => 1,
                'null' => true
            ])
            ->addIndex(['id'])
            ->create();

        $table = $this->table('leaves', [
                'collation' => 'utf8_general_ci'
            ])
            ->addColumn('employee_id', 'integer', [
                'limit' => 11,
                'null' => false
            ])
            ->addColumn('leave_type_id', 'integer', [
                'limit' => 11,
                'null' => false,
                'comment' => '1. vacation, 2. to seek employment, 3. sick, 4. maternity, 5. others'
            ])
            ->addColumn('leave_category_id', 'integer', [
                'limit' => 11,
                'null' => true,
                'default' => null,
                'comment' => 'based on leave_categories table'
            ])
            ->addColumn('leave_description', 'string', [
                'null' => true,
                'default' => null
            ])
            ->addColumn('applied_for', 'integer', [
                'limit' => 11,
                'null' => true,
                'comment' => 'number of days'
            ])
            ->addColumn('leave_from', 'string', [
                'limit' => 255,
                'null' => false
            ])
            ->addColumn('leave_to', 'string', [
                'limit' => 255,
                'null' => false
            ])
            ->addColumn('commutation', 'integer', [
                'limit' => 1,
                'null' => true,
                'comment' => '1. requested, 2. not requested'
            ])
            ->addColumn('created', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false
            ])
            ->addColumn('modified', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false
            ])
            ->addColumn('deleted_date', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true
            ])
            ->addColumn('deleted', 'integer', [
                'default' => '0',
                'limit' => 1,
                'null' => true
            ])
            ->addIndex(['id'])
            ->create();

        $table = $this->table('leave_application_responses', [
                'collation' => 'utf8_general_ci'
            ])
            ->addColumn('application_id', 'integer', [
                'limit' => 11,
                'null' => false
            ])
            ->addColumn('recommendation_type', 'integer', [
                'limit' => 11,
                'null' => false,
                'comment' => '1. approval, 2. disapproval (7b)'
            ])
            ->addColumn('recommendation_description', 'string', [
                'null' => true,
                'default' => null,
                'comment' => 'required, if disapproval was checked in recommendation_type (7b)'
            ])
            ->addColumn('created', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false
            ])
            ->addColumn('modified', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false
            ])
            ->addColumn('deleted_date', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true
            ])
            ->addColumn('deleted', 'integer', [
                'default' => '0',
                'limit' => 1,
                'null' => true
            ])
            ->addIndex(['id'])
            ->create();

        $table = $this->table('leave_categories', [
                'collation' => 'utf8_general_ci'
            ])
            ->addColumn('parent_leave_type_id', 'integer', [
                'limit' => 11,
                'null' => true,
                'default' => null,
                'comment' => 'Occurs only when selected'
            ])
            ->addColumn('description', 'string', [
                'limit' => 255,
                'null' => false,
                'comment' => '1. with in the philippines, 2. abroad, 3. in hospital 4. out patient'
            ])
            ->addColumn('created', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false
            ])
            ->addColumn('modified', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false
            ])
            ->addColumn('deleted_date', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true
            ])
            ->addColumn('deleted', 'integer', [
                'default' => '0',
                'limit' => 1,
                'null' => true
            ])
            ->addIndex(['id'])
            ->create();

        $table = $this->table('employee_information', [
                'collation' => 'utf8_general_ci'
            ])
            ->addColumn('role_id', 'integer', [
                'limit' => 11,
                'null' => false
            ])
            ->addColumn('employee_no', 'integer', [
                'limit' => 11,
                'null' => false
            ])
            ->addColumn('password', 'string', [
                'limit' => 255,
                'null' => false
            ])
            ->addColumn('last_name', 'string', [
                'limit' => 255,
                'null' => false
            ])
            ->addColumn('first_name', 'string', [
                'limit' => 255,
                'null' => false
            ])
            ->addColumn('middle_name', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addColumn('job_position_id', 'integer', [
                'limit' => 11,
                'null' => false
            ])
            ->addColumn('salary', 'string', [
                'limit' => 255,
                'null' => true,
                'default' => null
            ])
            ->addColumn('address', 'string', [
                'limit' => 255,
                'null' => false
            ])
            ->addColumn('mobile_no', 'string', [
                'limit' => 255,
                'null' => false
            ])
            ->addColumn('email', 'string', [
                'limit' => 255,
                'null' => false
            ])
            ->addColumn('hired_date', 'date', [
                'limit' => null,
                'null' => true
            ])
            ->addColumn('status', 'integer', [
                'limit' => 1,
                'null' => false,
                'comment' => '1. licensed/regular, 2. unlicensed'
            ])
            ->addColumn('created', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false
            ])
            ->addColumn('modified', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false
            ])
            ->addColumn('deleted_date', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true
            ])
            ->addColumn('deleted', 'integer', [
                'default' => '0',
                'limit' => 1,
                'null' => true
            ])
            ->addIndex(['id'])
            ->create();

        $table = $this->table('leave_balances', [
                'collation' => 'utf8_general_ci'
            ])
            ->addColumn('employee_id', 'integer', [
                'limit' => 11,
                'null' => false
            ])
            ->addColumn('balance', 'integer', [
                'limit' => 11,
                'null' => false
            ])
            ->addColumn('leave_type_id', 'integer', [
                'limit' => 11,
                'null' => true,
                'comment' => '1. vacation, 2. sick, 3.combo(leave,sick)'
            ])
            ->addColumn('created', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false
            ])
            ->addColumn('modified', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false
            ])
            ->addColumn('deleted_date', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true
            ])
            ->addColumn('deleted', 'integer', [
                'default' => '0',
                'limit' => 1,
                'null' => true
            ])
            ->addIndex(['id'])
            ->create();

        $table = $this->table('leave_types', [
                'collation' => 'utf8_general_ci'
            ])
            ->addColumn('description', 'string', [
                'limit' => 255,
                'null' => false
            ])
            ->addColumn('days_applicable', 'integer', [
                'limit' => 11,
                'null' => false
            ])
            ->addColumn('created', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false
            ])
            ->addColumn('modified', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false
            ])
            ->addColumn('deleted_date', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true
            ])
            ->addColumn('deleted', 'integer', [
                'default' => '0',
                'limit' => 1,
                'null' => true
            ])
            ->addIndex(['id'])
            ->create();

        $table = $this->table('job_positions', [
                'collation' => 'utf8_general_ci'
            ])
            ->addColumn('title', 'string', [
                'limit' => 255,
                'null' => false
            ])
            ->addColumn('created', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false
            ])
            ->addColumn('modified', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false
            ])
            ->addColumn('deleted_date', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true
            ])
            ->addColumn('deleted', 'integer', [
                'default' => '0',
                'limit' => 1,
                'null' => true
            ])
            ->addIndex(['id'])
            ->create();

        $table = $this->table('roles', [
                'collation' => 'utf8_general_ci'
            ])
            ->addColumn('title', 'string', [
                'limit' => 255,
                'null' => false,
                'comment' => 'Admin, Principal, Teacher'
            ])
            ->addColumn('description', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addColumn('created', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false
            ])
            ->addColumn('modified', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false
            ])
            ->addColumn('deleted_date', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true
            ])
            ->addColumn('deleted', 'integer', [
                'default' => '0',
                'limit' => 1,
                'null' => true
            ])
            ->addIndex(['id'])
            ->create();
    }
}
