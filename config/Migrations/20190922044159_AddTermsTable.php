<?php
use Migrations\AbstractMigration;

class AddTermsTable extends AbstractMigration
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
        $table = $this->table('holidays', [
                'collation' => 'utf8_general_ci'
            ])
            ->addColumn('description', 'string', [
                'limit' => 255,
                'null' => false
            ])
            ->addColumn('holiday_date', 'date', [
                'limit' => null,
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

        $table = $this->table('terms', [
                'collation' => 'utf8_general_ci'
            ])
            ->addColumn('description', 'string', [
                'limit' => 255,
                'null' => false
            ])
            ->addColumn('academic_year', 'string', [
                'limit' => null,
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

        $table = $this->table('leave_balances', [
                'collation' => 'utf8_general_ci'
            ])
            ->addColumn('term_id', 'string', [
                'after' => 'employee_id',                
                'limit' => 255,
                'null' => false
            ])
            ->update();
    }
}
