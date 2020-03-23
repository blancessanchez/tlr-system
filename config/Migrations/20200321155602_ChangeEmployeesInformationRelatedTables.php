<?php
use Migrations\AbstractMigration;

class ChangeEmployeesInformationRelatedTables extends AbstractMigration
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
        $table = $this->table('employee_information')
            ->removeColumn('created')
            ->removeColumn('modified')
            ->removeColumn('deleted_date')
            ->removeColumn('deleted')
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
            ->update();

        $table = $this->table('employee_education_information')
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
            ->update();

        $table = $this->table('employee_family_information')
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
            ->update();

        $table = $this->table('employee_other_information')
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
            ->update();

        $table = $this->table('employee_question_information')
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
            ->update();

        $table = $this->table('employee_references_information')
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
            ->update();

        $table = $this->table('employee_service_information')
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
            ->update();

        $table = $this->table('employee_training_information')
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
            ->update();

        $table = $this->table('employee_voluntary_information')
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
            ->update();

        $table = $this->table('employee_work_experience_information')
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
            ->update();
    }
}
