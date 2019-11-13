<?php
use Migrations\AbstractMigration;

class ChangeColumnIsSuccess extends AbstractMigration
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
        $table = $this->table('leave_applications')
            ->addColumn('leave_status', 'integer', [
                'after' => 'commutation',
                'limit' => 1,
                'null' => false,
                'default' => 0,
                'comment' => '1. forapproval, 2.approved, 3.cancelled, 4.disapproved'
            ])
            ->update();

        $table = $this->table('employee_information')
            ->changeColumn('salary', 'string', [
                'limit' => 255,
                'null' => true,
                'default' => null
            ])
            ->update();
    }
}
