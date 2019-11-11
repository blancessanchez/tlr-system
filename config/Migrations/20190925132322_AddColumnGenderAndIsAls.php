<?php
use Migrations\AbstractMigration;

class AddColumnGenderAndIsAls extends AbstractMigration
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
            ->addColumn('gender', 'integer', [
                'after' => 'middle_name',
                'limit' => 1,
                'null' => false,
                'comment' => '1. male, 2. female'
            ])
            ->addColumn('is_als', 'integer', [
                'after' => 'status',
                'limit' => 1,
                'null' => false,
                'comment' => '1. ALS, 2. non-ALS'
            ])
            ->update();
    }
}
