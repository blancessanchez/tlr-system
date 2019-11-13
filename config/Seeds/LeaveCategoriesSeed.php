<?php
use Migrations\AbstractSeed;

/**
 * LeaveCategoriesSeed
 */
class LeaveCategoriesSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $date = new DateTime();
        $data = [
            [
                'id' => '1',
                'parent_leave_type_id' => 1,
                'description' => 'With in the Philippines',
                'created' => $date->format('Y-m-d H:i:s'),
                'modified' => $date->format('Y-m-d H:i:s'),
                'deleted_date' => null,
                'deleted' => '0'
            ],
            [
                'id' => '2',
                'parent_leave_type_id' => 1,
                'description' => 'Abroad',
                'created' => $date->format('Y-m-d H:i:s'),
                'modified' => $date->format('Y-m-d H:i:s'),
                'deleted_date' => null,
                'deleted' => '0'
            ],
            [
                'id' => '3',
                'parent_leave_type_id' => 2,
                'description' => 'In hospital',
                'created' => $date->format('Y-m-d H:i:s'),
                'modified' => $date->format('Y-m-d H:i:s'),
                'deleted_date' => null,
                'deleted' => '0'
            ],
            [
                'id' => '4',
                'parent_leave_type_id' => 2,
                'description' => 'Outpatient',
                'created' => $date->format('Y-m-d H:i:s'),
                'modified' => $date->format('Y-m-d H:i:s'),
                'deleted_date' => null,
                'deleted' => '0'
            ]
        ];

        $table = $this->table('leave_categories');
        $table->truncate();
        $table->insert($data)->save();
    }
}
