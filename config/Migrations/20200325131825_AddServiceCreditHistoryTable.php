<?php
use Migrations\AbstractMigration;

class AddServiceCreditHistoryTable extends AbstractMigration
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
        $table = $this->table('service_credit_history', [
                'collation' => 'utf8_general_ci'
            ])
            ->addColumn('description', 'string', [
                'limit' => 255,
                'null' => false
            ])
            ->addColumn('added_balance', 'integer', [
                'default' => '0',
                'limit' => 1,
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
