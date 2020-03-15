<?php
use Migrations\AbstractMigration;

class ChangeEmployeeInformation extends AbstractMigration
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
            ->removeColumn('salary')
            ->removeColumn('hired_date')
            ->removeColumn('address')
            ->removeColumn('mobile_no')
            ->addColumn('name_extension', 'string', [
                'after' => 'middle_name',
                'limit' => 255,
                'null' => true
            ])
            ->addColumn('birth_date', 'date', [
                'after' => 'gender',
                'limit' => null,
                'null' => true
            ])
            ->addColumn('birth_place', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addColumn('civil_status', 'integer', [
                'limit' => 11,
                'null' => true,
                'comment' => '1. single, 2. widowed, 3. married, 4. separated, 5. others'
            ])
            ->addColumn('height', 'integer', [
                'limit' => 11,
                'null' => true,
                'comment' => 'in height'
            ])
            ->addColumn('weight', 'integer', [
                'limit' => 11,
                'null' => true,
                'comment' => 'in kg'
            ])
            ->addColumn('blood_type', 'string', [
                'limit' => 10,
                'null' => true
            ])
            ->addColumn('gsis_id_no', 'string', [
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('pagibig_id_no', 'string', [
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('philhealth_no', 'string', [
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('sss_no', 'string', [
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('tin_no', 'string', [
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('agency_employee_no', 'string', [
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('citizenship', 'integer', [
                'limit' => 11,
                'null' => true,
                'comment' => '1. filipino, 2. dual citizenship'
            ])
            ->addColumn('citizenship_dual', 'integer', [
                'limit' => 11,
                'null' => true,
                'comment' => '1. by birth, 2. by naturalization'
            ])
            ->addColumn('citizenship_country', 'integer', [
                'limit' => 11,
                'null' => true
            ])
            ->addColumn('residential_address', 'string', [
                'after' => 'job_position_id',
                'limit' => 255,
                'null' => true
            ])
            ->addColumn('residential_zipcode', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addColumn('permanent_address', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addColumn('permanent_zipcode', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addColumn('telephone_no', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addColumn('image', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addColumn('government_issued_id', 'string', [
                'limit' => 255,
                'null' => true,
                'comment' => 'for agreement'
            ])
            ->addColumn('id_no', 'string', [
                'limit' => 255,
                'null' => true,
                'comment' => 'for agreement'
            ])
            ->addColumn('place_of_issue', 'string', [
                'limit' => 255,
                'null' => true,
                'comment' => 'for agreement'
            ])
            ->addColumn('date_accomplished', 'date', [
                'limit' => 255,
                'null' => true
            ])
            ->changeColumn('gender', 'integer', [
                'null' => true,
            ])
            ->changeColumn('email', 'string', [
                'null' => true,
            ])
            ->update();
    }
}
