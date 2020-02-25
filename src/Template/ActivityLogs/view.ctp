<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ActivityLog $activityLog
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Activity Log'), ['action' => 'edit', $activityLog->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Activity Log'), ['action' => 'delete', $activityLog->id], ['confirm' => __('Are you sure you want to delete # {0}?', $activityLog->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Activity Logs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Activity Log'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Employee Information'), ['controller' => 'EmployeeInformation', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Employee Information'), ['controller' => 'EmployeeInformation', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="activityLogs view large-9 medium-8 columns content">
    <h3><?= h($activityLog->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Employee Information') ?></th>
            <td><?= $activityLog->has('employee_information') ? $this->Html->link($activityLog->employee_information->id, ['controller' => 'EmployeeInformation', 'action' => 'view', $activityLog->employee_information->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($activityLog->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($activityLog->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted') ?></th>
            <td><?= $this->Number->format($activityLog->deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($activityLog->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($activityLog->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted Date') ?></th>
            <td><?= h($activityLog->deleted_date) ?></td>
        </tr>
    </table>
</div>
