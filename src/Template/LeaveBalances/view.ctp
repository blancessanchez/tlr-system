<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LeaveBalance $leaveBalance
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Leave Balance'), ['action' => 'edit', $leaveBalance->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Leave Balance'), ['action' => 'delete', $leaveBalance->id], ['confirm' => __('Are you sure you want to delete # {0}?', $leaveBalance->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Leave Balances'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Leave Balance'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Employee Information'), ['controller' => 'EmployeeInformation', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Employee Information'), ['controller' => 'EmployeeInformation', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Terms'), ['controller' => 'Terms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Term'), ['controller' => 'Terms', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Leave Types'), ['controller' => 'LeaveTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Leave Type'), ['controller' => 'LeaveTypes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="leaveBalances view large-9 medium-8 columns content">
    <h3><?= h($leaveBalance->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Employee Information') ?></th>
            <td><?= $leaveBalance->has('employee_information') ? $this->Html->link($leaveBalance->employee_information->id, ['controller' => 'EmployeeInformation', 'action' => 'view', $leaveBalance->employee_information->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Term') ?></th>
            <td><?= $leaveBalance->has('term') ? $this->Html->link($leaveBalance->term->id, ['controller' => 'Terms', 'action' => 'view', $leaveBalance->term->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Leave Type') ?></th>
            <td><?= $leaveBalance->has('leave_type') ? $this->Html->link($leaveBalance->leave_type->description, ['controller' => 'LeaveTypes', 'action' => 'view', $leaveBalance->leave_type->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($leaveBalance->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Balance') ?></th>
            <td><?= $this->Number->format($leaveBalance->balance) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted') ?></th>
            <td><?= $this->Number->format($leaveBalance->deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($leaveBalance->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($leaveBalance->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted Date') ?></th>
            <td><?= h($leaveBalance->deleted_date) ?></td>
        </tr>
    </table>
</div>
