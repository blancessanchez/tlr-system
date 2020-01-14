<?php
use Migrations\AbstractSeed;

/**
 * HolidaysSeed
 */
class HolidaysSeed extends AbstractSeed
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
                'description' => 'New Year\'s Day',
                'holiday_date' => $date->format('Y') . '-01-01',
                'created' => $date->format('Y-m-d H:i:s'),
                'modified' => $date->format('Y-m-d H:i:s'),
                'deleted_date' => null,
                'deleted' => '0'
            ],
            [
                'id' => '2',
                'description' => 'Chinese Lunar New Year\'s Day',
                'holiday_date' => $date->format('Y') . '-01-25',
                'created' => $date->format('Y-m-d H:i:s'),
                'modified' => $date->format('Y-m-d H:i:s'),
                'deleted_date' => null,
                'deleted' => '0'
            ],
            [
                'id' => '3',
                'description' => 'People Power Anniversary',
                'holiday_date' => $date->format('Y') . '-02-25',
                'created' => $date->format('Y-m-d H:i:s'),
                'modified' => $date->format('Y-m-d H:i:s'),
                'deleted_date' => null,
                'deleted' => '0'
            ],
            [
                'id' => '4',
                'description' => 'The Day of Valor',
                'holiday_date' => $date->format('Y') . '-04-09',
                'created' => $date->format('Y-m-d H:i:s'),
                'modified' => $date->format('Y-m-d H:i:s'),
                'deleted_date' => null,
                'deleted' => '0'
            ],
            [
                'id' => '5',
                'description' => 'Eidul-Fitar',
                'holiday_date' => $date->format('Y') . '-05-24',
                'created' => $date->format('Y-m-d H:i:s'),
                'modified' => $date->format('Y-m-d H:i:s'),
                'deleted_date' => null,
                'deleted' => '0'
            ],
            [
                'id' => '6',
                'description' => 'Independence Day',
                'holiday_date' => $date->format('Y') . '-06-12',
                'created' => $date->format('Y-m-d H:i:s'),
                'modified' => $date->format('Y-m-d H:i:s'),
                'deleted_date' => null,
                'deleted' => '0'
            ],
            [
                'id' => '7',
                'description' => 'Eid al-Adha (Feast of the Sacrifice)',
                'holiday_date' => $date->format('Y') . '-07-31',
                'created' => $date->format('Y-m-d H:i:s'),
                'modified' => $date->format('Y-m-d H:i:s'),
                'deleted_date' => null,
                'deleted' => '0'
            ],
            [
                'id' => '8',
                'description' => 'Eid al-Adha Day 2',
                'holiday_date' => $date->format('Y') . '-08-01',
                'created' => $date->format('Y-m-d H:i:s'),
                'modified' => $date->format('Y-m-d H:i:s'),
                'deleted_date' => null,
                'deleted' => '0'
            ],
            [
                'id' => '9',
                'description' => 'Ninoy Aquino Day',
                'holiday_date' => $date->format('Y') . '-08-21',
                'created' => $date->format('Y-m-d H:i:s'),
                'modified' => $date->format('Y-m-d H:i:s'),
                'deleted_date' => null,
                'deleted' => '0'
            ],
            [
                'id' => '10',
                'description' => 'National Heroes Day',
                'holiday_date' => $date->format('Y') . '-08-31',
                'created' => $date->format('Y-m-d H:i:s'),
                'modified' => $date->format('Y-m-d H:i:s'),
                'deleted_date' => null,
                'deleted' => '0'
            ],
            [
                'id' => '11',
                'description' => 'All Saints\' Day',
                'holiday_date' => $date->format('Y') . '-11-01',
                'created' => $date->format('Y-m-d H:i:s'),
                'modified' => $date->format('Y-m-d H:i:s'),
                'deleted_date' => null,
                'deleted' => '0'
            ],
            [
                'id' => '12',
                'description' => 'All Souls\' Day',
                'holiday_date' => $date->format('Y') . '-11-02',
                'created' => $date->format('Y-m-d H:i:s'),
                'modified' => $date->format('Y-m-d H:i:s'),
                'deleted_date' => null,
                'deleted' => '0'
            ],
            [
                'id' => '13',
                'description' => 'Bonifacio Day',
                'holiday_date' => $date->format('Y') . '-11-30',
                'created' => $date->format('Y-m-d H:i:s'),
                'modified' => $date->format('Y-m-d H:i:s'),
                'deleted_date' => null,
                'deleted' => '0'
            ],
            [
                'id' => '14',
                'description' => 'Christmas Eve',
                'holiday_date' => $date->format('Y') . '-12-24',
                'created' => $date->format('Y-m-d H:i:s'),
                'modified' => $date->format('Y-m-d H:i:s'),
                'deleted_date' => null,
                'deleted' => '0'
            ],
            [
                'id' => '15',
                'description' => 'Christmas Day',
                'holiday_date' => $date->format('Y') . '-12-25',
                'created' => $date->format('Y-m-d H:i:s'),
                'modified' => $date->format('Y-m-d H:i:s'),
                'deleted_date' => null,
                'deleted' => '0'
            ],
            [
                'id' => '16',
                'description' => 'Rizal Day',
                'holiday_date' => $date->format('Y') . '-12-30',
                'created' => $date->format('Y-m-d H:i:s'),
                'modified' => $date->format('Y-m-d H:i:s'),
                'deleted_date' => null,
                'deleted' => '0'
            ],
            [
                'id' => '17',
                'description' => 'New Year\'s Eve',
                'holiday_date' => $date->format('Y') . '-12-31',
                'created' => $date->format('Y-m-d H:i:s'),
                'modified' => $date->format('Y-m-d H:i:s'),
                'deleted_date' => null,
                'deleted' => '0'
            ]
        ];

        $table = $this->table('holidays');
        $table->truncate();
        $table->insert($data)->save();
    }
}
