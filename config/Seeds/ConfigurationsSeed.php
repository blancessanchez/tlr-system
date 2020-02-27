<?php
use Migrations\AbstractSeed;

/**
 * ConfigurationsSeed
 */
class ConfigurationsSeed extends AbstractSeed
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
                'type_id' => '1',
                'value' => 'Test System',
                'created' => $date->format('Y-m-d H:i:s'),
                'modified' => $date->format('Y-m-d H:i:s'),
                'deleted_date' => null,
                'deleted' => '0'
            ]
        ];

        $table = $this->table('configurations');
        $table->truncate();
        $table->insert($data)->save();
    }
}
