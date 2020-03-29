<?php
use Migrations\AbstractMigration;

class AddDeductibleToServiceCreditColumnToLeavesTable extends AbstractMigration
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
        $table = $this->table('leaves')
            ->addColumn('deductible_to_service_credit', 'integer', [
                'limit' => 11,
                'null' => true,
                'after' => 'leave_status'
            ])
            ->update();
    }
}
