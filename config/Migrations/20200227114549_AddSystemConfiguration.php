<?php
use Migrations\AbstractMigration;

class AddSystemConfiguration extends AbstractMigration
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
        $table = $this->table('configurations', [
            'collation' => 'utf8_general_ci'
        ])
        ->addColumn('type_id', 'string', [
            'limit' => 255,
            'null' => false,
            'comment' => '1. system name, 2. system image'
        ])
        ->addColumn('value', 'string', [
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
    }
}
