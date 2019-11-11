<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee $employee
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Employee'), ['action' => 'edit', $employee->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Employee'), ['action' => 'delete', $employee->id], ['confirm' => __('Are you sure you want to delete # {0}?', $employee->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Employees'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Employee'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Activity Logs'), ['controller' => 'ActivityLogs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Activity Log'), ['controller' => 'ActivityLogs', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Employee Information'), ['controller' => 'EmployeeInformation', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Employee Information'), ['controller' => 'EmployeeInformation', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Leave Applications'), ['controller' => 'LeaveApplications', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Leave Application'), ['controller' => 'LeaveApplications', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Leave Balances'), ['controller' => 'LeaveBalances', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Leave Balance'), ['controller' => 'LeaveBalances', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="employees view large-9 medium-8 columns content">
    <h3><?= h($employee->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Role') ?></th>
            <td><?= $employee->has('role') ? $this->Html->link($employee->role->title, ['controller' => 'Roles', 'action' => 'view', $employee->role->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Username') ?></th>
            <td><?= h($employee->username) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($employee->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($employee->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted') ?></th>
            <td><?= $this->Number->format($employee->deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($employee->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($employee->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted Date') ?></th>
            <td><?= h($employee->deleted_date) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Activity Logs') ?></h4>
        <?php if (!empty($employee->activity_logs)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Employee Id') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Deleted Date') ?></th>
                <th scope="col"><?= __('Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($employee->activity_logs as $activityLogs): ?>
            <tr>
                <td><?= h($activityLogs->id) ?></td>
                <td><?= h($activityLogs->employee_id) ?></td>
                <td><?= h($activityLogs->description) ?></td>
                <td><?= h($activityLogs->created) ?></td>
                <td><?= h($activityLogs->modified) ?></td>
                <td><?= h($activityLogs->deleted_date) ?></td>
                <td><?= h($activityLogs->deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ActivityLogs', 'action' => 'view', $activityLogs->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ActivityLogs', 'action' => 'edit', $activityLogs->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ActivityLogs', 'action' => 'delete', $activityLogs->id], ['confirm' => __('Are you sure you want to delete # {0}?', $activityLogs->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Employee Information') ?></h4>
        <?php if (!empty($employee->employee_information)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Employee Id') ?></th>
                <th scope="col"><?= __('Employee No') ?></th>
                <th scope="col"><?= __('Last Name') ?></th>
                <th scope="col"><?= __('First Name') ?></th>
                <th scope="col"><?= __('Middle Name') ?></th>
                <th scope="col"><?= __('Job Position Id') ?></th>
                <th scope="col"><?= __('Salary') ?></th>
                <th scope="col"><?= __('Address') ?></th>
                <th scope="col"><?= __('Mobile No') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Hired Date') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Deleted Date') ?></th>
                <th scope="col"><?= __('Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($employee->employee_information as $employeeInformation): ?>
            <tr>
                <td><?= h($employeeInformation->id) ?></td>
                <td><?= h($employeeInformation->employee_id) ?></td>
                <td><?= h($employeeInformation->employee_no) ?></td>
                <td><?= h($employeeInformation->last_name) ?></td>
                <td><?= h($employeeInformation->first_name) ?></td>
                <td><?= h($employeeInformation->middle_name) ?></td>
                <td><?= h($employeeInformation->job_position_id) ?></td>
                <td><?= h($employeeInformation->salary) ?></td>
                <td><?= h($employeeInformation->address) ?></td>
                <td><?= h($employeeInformation->mobile_no) ?></td>
                <td><?= h($employeeInformation->email) ?></td>
                <td><?= h($employeeInformation->hired_date) ?></td>
                <td><?= h($employeeInformation->status) ?></td>
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
    <div class="related">
        <h4><?= __('Related Leave Applications') ?></h4>
        <?php if (!empty($employee->leave_applications)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Employee Id') ?></th>
                <th scope="col"><?= __('Leave Type Id') ?></th>
                <th scope="col"><?= __('Leave Category Id') ?></th>
                <th scope="col"><?= __('Leave Description') ?></th>
                <th scope="col"><?= __('Applied For') ?></th>
                <th scope="col"><?= __('Inclusive Dates') ?></th>
                <th scope="col"><?= __('Commutation') ?></th>
                <th scope="col"><?= __('Is Success') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Deleted Date') ?></th>
                <th scope="col"><?= __('Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($employee->leave_applications as $leaveApplications): ?>
            <tr>
                <td><?= h($leaveApplications->id) ?></td>
                <td><?= h($leaveApplications->employee_id) ?></td>
                <td><?= h($leaveApplications->leave_type_id) ?></td>
                <td><?= h($leaveApplications->leave_category_id) ?></td>
                <td><?= h($leaveApplications->leave_description) ?></td>
                <td><?= h($leaveApplications->applied_for) ?></td>
                <td><?= h($leaveApplications->inclusive_dates) ?></td>
                <td><?= h($leaveApplications->commutation) ?></td>
                <td><?= h($leaveApplications->is_success) ?></td>
                <td><?= h($leaveApplications->created) ?></td>
                <td><?= h($leaveApplications->modified) ?></td>
                <td><?= h($leaveApplications->deleted_date) ?></td>
                <td><?= h($leaveApplications->deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'LeaveApplications', 'action' => 'view', $leaveApplications->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'LeaveApplications', 'action' => 'edit', $leaveApplications->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'LeaveApplications', 'action' => 'delete', $leaveApplications->id], ['confirm' => __('Are you sure you want to delete # {0}?', $leaveApplications->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Leave Balances') ?></h4>
        <?php if (!empty($employee->leave_balances)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Employee Id') ?></th>
                <th scope="col"><?= __('Balance') ?></th>
                <th scope="col"><?= __('Leave Type Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Deleted Date') ?></th>
                <th scope="col"><?= __('Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($employee->leave_balances as $leaveBalances): ?>
            <tr>
                <td><?= h($leaveBalances->id) ?></td>
                <td><?= h($leaveBalances->employee_id) ?></td>
                <td><?= h($leaveBalances->balance) ?></td>
                <td><?= h($leaveBalances->leave_type_id) ?></td>
                <td><?= h($leaveBalances->created) ?></td>
                <td><?= h($leaveBalances->modified) ?></td>
                <td><?= h($leaveBalances->deleted_date) ?></td>
                <td><?= h($leaveBalances->deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'LeaveBalances', 'action' => 'view', $leaveBalances->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'LeaveBalances', 'action' => 'edit', $leaveBalances->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'LeaveBalances', 'action' => 'delete', $leaveBalances->id], ['confirm' => __('Are you sure you want to delete # {0}?', $leaveBalances->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
