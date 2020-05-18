<?php
use Migrations\AbstractMigration;

class AddCivilStatusOthers extends AbstractMigration
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
            ->addColumn('civil_status_others', 'string', [
                'null' => true,
                'default' => null,
                'comment' => 'required if chosen civil_status type 4',
                'after' => 'civil_status'
            ])
            ->addColumn('mobile_no', 'integer', [
                'limit' => 50,
                'null' => true,
                'default' => null,
                'after' => 'telephone_no'
            ])
            ->update();
    }
}
