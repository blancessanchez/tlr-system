<?php
use Migrations\AbstractMigration;

class AddDisapprovedColumnsToLeaveApplicationResponsesTable extends AbstractMigration
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
        $table = $this->table('leave_application_responses')
            ->addColumn('recommendation_description_by_head_teacher', 'string', [
                'null' => true,
                'default' => null,
                'comment' => 'required, if disapproval was checked in recommendation_type (7b)',
                'after' => 'recommendation_description'
            ])
            ->addColumn('recommendation_description_by_admin', 'string', [
                'null' => true,
                'default' => null,
                'comment' => 'required, if disapproval was checked in recommendation_type (7b)',
                'after' => 'recommendation_description'
            ])
            ->update();
    }
}
