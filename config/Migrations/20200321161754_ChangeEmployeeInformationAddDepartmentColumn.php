<?php
use Migrations\AbstractMigration;

class ChangeEmployeeInformationAddDepartmentColumn extends AbstractMigration
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
            ->addColumn('department_id', 'integer', [
                'limit' => 11,
                'null' => false,
                'after' => 'employee_no'
            ])
            ->update();
    }
}
