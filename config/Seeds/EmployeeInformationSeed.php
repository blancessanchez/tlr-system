<?php
use Migrations\AbstractSeed;

/**
 * FavoriteBodyPart seed.
 */
class EmployeeInformationSeed extends AbstractSeed
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
                'role_id' => '1',
                'employee_no' => '1',
                'password' => '$2y$10$R31ZoCE2xvZywTL0CRkDtOe8KxdZqUsD5L9GIHSi477CzuniqwNLy',
                'last_name' => 'Admin',
                'first_name' => 'Blances',
                'middle_name' => 'Manguason',
                'gender' => 2,
                'job_position_id' => '2',
                'salary' => null,
                'address' => 'Taguig City',
                'mobile_no' => '09771005895',
                'email' => 'blancessanchez30@gmail.com',
                'hired_date' => null,
                'status' => '1',
                'is_als' => 1,
                'created' => $date->format('Y-m-d H:i:s'),
                'modified' => $date->format('Y-m-d H:i:s'),
                'deleted_date' => null,
                'deleted' => '0'
            ],
            [
                'id' => '2',
                'role_id' => '2',
                'employee_no' => '2',
                'password' => '$2y$10$R31ZoCE2xvZywTL0CRkDtOe8KxdZqUsD5L9GIHSi477CzuniqwNLy',
                'last_name' => 'Principal',
                'first_name' => 'Blances',
                'middle_name' => 'Manguason',
                'gender' => 2,
                'job_position_id' => '2',
                'salary' => null,
                'address' => 'Taguig City',
                'mobile_no' => '09771005895',
                'email' => 'blancessanchez30@gmail.com',
                'hired_date' => null,
                'status' => '1',
                'is_als' => 2,
                'created' => $date->format('Y-m-d H:i:s'),
                'modified' => $date->format('Y-m-d H:i:s'),
                'deleted_date' => null,
                'deleted' => '0'
            ],
            [
                'id' => '3',
                'role_id' => '3',
                'employee_no' => '3',
                'password' => '$2y$10$R31ZoCE2xvZywTL0CRkDtOe8KxdZqUsD5L9GIHSi477CzuniqwNLy',
                'last_name' => 'Female',
                'first_name' => 'Blances',
                'middle_name' => 'Manguason',
                'gender' => 2,
                'job_position_id' => '2',
                'salary' => null,
                'address' => 'Taguig City',
                'mobile_no' => '09771005895',
                'email' => 'blancessanchez30@gmail.com',
                'hired_date' => null,
                'status' => '1',
                'is_als' => 1,
                'created' => $date->format('Y-m-d H:i:s'),
                'modified' => $date->format('Y-m-d H:i:s'),
                'deleted_date' => null,
                'deleted' => '0'
            ],
            [
                'id' => '4',
                'role_id' => '3',
                'employee_no' => '4',
                'password' => '$2y$10$R31ZoCE2xvZywTL0CRkDtOe8KxdZqUsD5L9GIHSi477CzuniqwNLy',
                'last_name' => 'Male',
                'first_name' => 'Blances',
                'middle_name' => 'Manguason',
                'gender' => 1,
                'job_position_id' => '2',
                'salary' => null,
                'address' => 'Taguig City',
                'mobile_no' => '09771005895',
                'email' => 'blancessanchez30@gmail.com',
                'hired_date' => null,
                'status' => '1',
                'is_als' => 2,
                'created' => $date->format('Y-m-d H:i:s'),
                'modified' => $date->format('Y-m-d H:i:s'),
                'deleted_date' => null,
                'deleted' => '0'
            ]
        ];

        $table = $this->table('employee_information');
        $table->truncate();
        $table->insert($data)->save();
    }
}
