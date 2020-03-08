<?php
use Migrations\AbstractMigration;

class AddEmployeeFamilyInformationTable extends AbstractMigration
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
        $table = $this->table('employee_family_information', [
                'collation' => 'utf8_general_ci'
            ])
            ->addColumn('employee_id', 'integer', [
                'limit' => 11,
                'null' => false
            ])
            ->addColumn('family_type_id', 'integer', [
                'limit' => 11,
                'null' => true,
                'comment' => '1. spouse, 2. father, 3. mother, 4. children'
            ])
            ->addColumn('last_name', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addColumn('first_name', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addColumn('middle_name', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addColumn('name_extension', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addColumn('occupation', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addColumn('employer_or_business_name', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addColumn('business_address', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addColumn('telephone_no', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addColumn('birth_date', 'string', [
                'limit' => 255,
                'null' => true,
                'comment' => 'for family_type_id = 4'
            ])
            ->addIndex(['id'])
            ->create();

        $table = $this->table('employee_education_information', [
                'collation' => 'utf8_general_ci'
            ])
            ->addColumn('employee_id', 'integer', [
                'limit' => 11,
                'null' => false
            ])
            ->addColumn('level_id', 'integer', [
                'limit' => 11,
                'null' => true,
                'comment' => '1. elementary, 2. secondary, 3. vocational/trade courses, 4. college, 5. graduate studies'
            ])
            ->addColumn('school_name', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addColumn('course_name', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addColumn('date_from', 'date', [
                'limit' => null,
                'null' => true
            ])
            ->addColumn('date_to', 'date', [
                'limit' => null,
                'null' => true
            ])
            ->addColumn('highest_units_earned', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addColumn('year_graduated', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addColumn('honors_received', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addIndex(['id'])
            ->create();

        $table = $this->table('employee_service_information', [
                'collation' => 'utf8_general_ci'
            ])
            ->addColumn('employee_id', 'integer', [
                'limit' => 11,
                'null' => false
            ])
            ->addColumn('service_type_id', 'integer', [
                'limit' => 11,
                'null' => true,
                'comment' => '1. career service, 2. RA 1080 (board/bar) under special laws, 3. CES, 4. CSEE, 5. barangay eligibility, 6. drivers license'
            ])
            ->addColumn('rating', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addColumn('examination_date', 'date', [
                'limit' => null,
                'null' => true
            ])
            ->addColumn('examination_place', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addColumn('license_number', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addColumn('license_validity', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addIndex(['id'])
            ->create();

        $table = $this->table('employee_work_experience_information', [
                'collation' => 'utf8_general_ci'
            ])
            ->addColumn('employee_id', 'integer', [
                'limit' => 11,
                'null' => false
            ])
            ->addColumn('date_from', 'date', [
                'limit' => null,
                'null' => true
            ])
            ->addColumn('date_to', 'date', [
                'limit' => null,
                'null' => true
            ])
            ->addColumn('position_title', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addColumn('company_name', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addColumn('monthly_salary', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addColumn('salary_grade', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addColumn('appointment_status', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addColumn('is_government_service', 'integer', [
                'limit' => 255,
                'null' => true,
                'comment' => '1. yes, 2. no'
            ])
            ->addIndex(['id'])
            ->create();

        $table = $this->table('employee_voluntary_information', [
                'collation' => 'utf8_general_ci'
            ])
            ->addColumn('employee_id', 'integer', [
                'limit' => 11,
                'null' => false
            ])
            ->addColumn('organization_name', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addColumn('date_from', 'date', [
                'limit' => null,
                'null' => true
            ])
            ->addColumn('date_to', 'date', [
                'limit' => null,
                'null' => true
            ])
            ->addColumn('no_of_hours', 'integer', [
                'limit' => 11,
                'null' => true
            ])
            ->addColumn('job_position', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addIndex(['id'])
            ->create();

        $table = $this->table('employee_training_information', [
                'collation' => 'utf8_general_ci'
            ])
            ->addColumn('employee_id', 'integer', [
                'limit' => 11,
                'null' => false
            ])
            ->addColumn('seminar_name', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addColumn('date_from', 'date', [
                'limit' => null,
                'null' => true
            ])
            ->addColumn('date_to', 'date', [
                'limit' => null,
                'null' => true
            ])
            ->addColumn('no_of_hours', 'integer', [
                'limit' => 11,
                'null' => true
            ])
            ->addColumn('ld_type_id', 'integer', [
                'limit' => 11,
                'null' => true,
                'comment' => '1. managerial, 2. supervisory, 3. technical, 4. etc'
            ])
            ->addColumn('conducted_by', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addIndex(['id'])
            ->create();

        $table = $this->table('employee_other_information', [
                'collation' => 'utf8_general_ci'
            ])
            ->addColumn('employee_id', 'integer', [
                'limit' => 11,
                'null' => false
            ])
            ->addColumn('special_skills', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addColumn('non_academic_distinctions', 'string', [
                'limit' => 11,
                'null' => true
            ])
            ->addColumn('membership_organization', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addIndex(['id'])
            ->create();

        $table = $this->table('employee_references_information', [
                'collation' => 'utf8_general_ci'
            ])
            ->addColumn('employee_id', 'integer', [
                'limit' => 11,
                'null' => false
            ])
            ->addColumn('name', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addColumn('address', 'string', [
                'limit' => 11,
                'null' => true
            ])
            ->addColumn('telephone_no', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addIndex(['id'])
            ->create();
        
        $table = $this->table('employee_question_information', [
                'collation' => 'utf8_general_ci'
            ])
            ->addColumn('employee_id', 'integer', [
                'limit' => 11,
                'null' => false
            ])
            ->addColumn('is_related_by_consanguinity_within_third_degree', 'integer', [
                'limit' => 11,
                'null' => false
            ])
            ->addColumn('is_related_by_consanguinity_within_fourth_degree', 'integer', [
                'limit' => 11,
                'null' => false
            ])
            ->addColumn('is_guilty', 'integer', [
                'limit' => 11,
                'null' => false
            ])
            ->addColumn('guilty_detail', 'string', [
                'limit' => 255,
                'null' => false
            ])
            ->addColumn('is_criminally_charged', 'integer', [
                'limit' => 11,
                'null' => false
            ])
            ->addColumn('criminally_charged_date_filed', 'date', [
                'limit' => null,
                'null' => false
            ])
            ->addColumn('criminally_charged_status_of_cases', 'string', [
                'limit' => 255,
                'null' => false
            ])
            ->addColumn('is_convicted', 'integer', [
                'limit' => 11,
                'null' => false
            ])
            ->addColumn('convicted_details', 'string', [
                'limit' => 255,
                'null' => false
            ])
            ->addColumn('is_separated_from_service', 'integer', [
                'limit' => 11,
                'null' => false
            ])
            ->addColumn('separated_from_service_detail', 'string', [
                'limit' => 255,
                'null' => false
            ])
            ->addColumn('is_candidate', 'integer', [
                'limit' => 11,
                'null' => false
            ])
            ->addColumn('is_candidate_detail', 'string', [
                'limit' => 255,
                'null' => false
            ])
            ->addColumn('is_resigned_from_government', 'integer', [
                'limit' => 11,
                'null' => false
            ])
            ->addColumn('resigned_from_government_detail', 'string', [
                'limit' => 255,
                'null' => false
            ])
            ->addColumn('is_an_immigrant', 'integer', [
                'limit' => 11,
                'null' => false
            ])
            ->addColumn('is_an_immigrant_detail', 'string', [
                'limit' => 255,
                'null' => false
            ])
            ->addColumn('is_member_of_indigenous_group', 'integer', [
                'limit' => 11,
                'null' => false
            ])
            ->addColumn('is_member_of_indigenous_group_detail', 'string', [
                'limit' => 255,
                'null' => false
            ])
            ->addColumn('is_person_with_disability', 'integer', [
                'limit' => 11,
                'null' => false
            ])
            ->addColumn('is_person_with_disability_detail', 'string', [
                'limit' => 255,
                'null' => false
            ])
            ->addColumn('is_solo_parent', 'integer', [
                'limit' => 11,
                'null' => false
            ])
            ->addColumn('is_solo_parent_detail', 'string', [
                'limit' => 255,
                'null' => false
            ])
            ->addIndex(['id'])
            ->create();
    }
}
