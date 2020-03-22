<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Department $department
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Department'), ['action' => 'edit', $department->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Department'), ['action' => 'delete', $department->id], ['confirm' => __('Are you sure you want to delete # {0}?', $department->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Departments'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Department'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Employee Information'), ['controller' => 'EmployeeInformation', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Employee Information'), ['controller' => 'EmployeeInformation', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="departments view large-9 medium-8 columns content">
    <h3><?= h($department->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($department->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($department->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted') ?></th>
            <td><?= $this->Number->format($department->deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($department->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($department->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted Date') ?></th>
            <td><?= h($department->deleted_date) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Employee Information') ?></h4>
        <?php if (!empty($department->employee_information)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Role Id') ?></th>
                <th scope="col"><?= __('Employee No') ?></th>
                <th scope="col"><?= __('Department Id') ?></th>
                <th scope="col"><?= __('Password') ?></th>
                <th scope="col"><?= __('Last Name') ?></th>
                <th scope="col"><?= __('First Name') ?></th>
                <th scope="col"><?= __('Middle Name') ?></th>
                <th scope="col"><?= __('Name Extension') ?></th>
                <th scope="col"><?= __('Gender') ?></th>
                <th scope="col"><?= __('Birth Date') ?></th>
                <th scope="col"><?= __('Job Position Id') ?></th>
                <th scope="col"><?= __('Residential Address') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Is Als') ?></th>
                <th scope="col"><?= __('Birth Place') ?></th>
                <th scope="col"><?= __('Civil Status') ?></th>
                <th scope="col"><?= __('Height') ?></th>
                <th scope="col"><?= __('Weight') ?></th>
                <th scope="col"><?= __('Blood Type') ?></th>
                <th scope="col"><?= __('Gsis Id No') ?></th>
                <th scope="col"><?= __('Pagibig Id No') ?></th>
                <th scope="col"><?= __('Philhealth No') ?></th>
                <th scope="col"><?= __('Sss No') ?></th>
                <th scope="col"><?= __('Tin No') ?></th>
                <th scope="col"><?= __('Agency Employee No') ?></th>
                <th scope="col"><?= __('Citizenship') ?></th>
                <th scope="col"><?= __('Citizenship Dual') ?></th>
                <th scope="col"><?= __('Citizenship Country') ?></th>
                <th scope="col"><?= __('Residential Zipcode') ?></th>
                <th scope="col"><?= __('Permanent Address') ?></th>
                <th scope="col"><?= __('Permanent Zipcode') ?></th>
                <th scope="col"><?= __('Telephone No') ?></th>
                <th scope="col"><?= __('Image') ?></th>
                <th scope="col"><?= __('Government Issued Id') ?></th>
                <th scope="col"><?= __('Id No') ?></th>
                <th scope="col"><?= __('Place Of Issue') ?></th>
                <th scope="col"><?= __('Date Accomplished') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Deleted Date') ?></th>
                <th scope="col"><?= __('Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($department->employee_information as $employeeInformation): ?>
            <tr>
                <td><?= h($employeeInformation->id) ?></td>
                <td><?= h($employeeInformation->role_id) ?></td>
                <td><?= h($employeeInformation->employee_no) ?></td>
                <td><?= h($employeeInformation->department_id) ?></td>
                <td><?= h($employeeInformation->password) ?></td>
                <td><?= h($employeeInformation->last_name) ?></td>
                <td><?= h($employeeInformation->first_name) ?></td>
                <td><?= h($employeeInformation->middle_name) ?></td>
                <td><?= h($employeeInformation->name_extension) ?></td>
                <td><?= h($employeeInformation->gender) ?></td>
                <td><?= h($employeeInformation->birth_date) ?></td>
                <td><?= h($employeeInformation->job_position_id) ?></td>
                <td><?= h($employeeInformation->residential_address) ?></td>
                <td><?= h($employeeInformation->email) ?></td>
                <td><?= h($employeeInformation->status) ?></td>
                <td><?= h($employeeInformation->is_als) ?></td>
                <td><?= h($employeeInformation->birth_place) ?></td>
                <td><?= h($employeeInformation->civil_status) ?></td>
                <td><?= h($employeeInformation->height) ?></td>
                <td><?= h($employeeInformation->weight) ?></td>
                <td><?= h($employeeInformation->blood_type) ?></td>
                <td><?= h($employeeInformation->gsis_id_no) ?></td>
                <td><?= h($employeeInformation->pagibig_id_no) ?></td>
                <td><?= h($employeeInformation->philhealth_no) ?></td>
                <td><?= h($employeeInformation->sss_no) ?></td>
                <td><?= h($employeeInformation->tin_no) ?></td>
                <td><?= h($employeeInformation->agency_employee_no) ?></td>
                <td><?= h($employeeInformation->citizenship) ?></td>
                <td><?= h($employeeInformation->citizenship_dual) ?></td>
                <td><?= h($employeeInformation->citizenship_country) ?></td>
                <td><?= h($employeeInformation->residential_zipcode) ?></td>
                <td><?= h($employeeInformation->permanent_address) ?></td>
                <td><?= h($employeeInformation->permanent_zipcode) ?></td>
                <td><?= h($employeeInformation->telephone_no) ?></td>
                <td><?= h($employeeInformation->image) ?></td>
                <td><?= h($employeeInformation->government_issued_id) ?></td>
                <td><?= h($employeeInformation->id_no) ?></td>
                <td><?= h($employeeInformation->place_of_issue) ?></td>
                <td><?= h($employeeInformation->date_accomplished) ?></td>
                <td><?= h($employeeInformation->created) ?></td>
                <td><?= h($employeeInformation->modified) ?></td>
                <td><?= h($employeeInformation->deleted_date) ?></td>
                <td><?= h($employeeInformation->deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'EmployeeInformation', 'action' => 'view', $employeeInformation->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'EmployeeInformation', 'action' => 'edit', $employeeInformation->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'EmployeeInformation', 'action' => 'delete', $employeeInformation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $employeeInformation->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
