<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ActivityLog $activityLog
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Activity Logs'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Employee Information'), ['controller' => 'EmployeeInformation', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Employee Information'), ['controller' => 'EmployeeInformation', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="activityLogs form large-9 medium-8 columns content">
    <?= $this->Form->create($activityLog) ?>
    <fieldset>
        <legend><?= __('Add Activity Log') ?></legend>
        <?php
            echo $this->Form->control('employee_id', ['options' => $employeeInformation]);
            echo $this->Form->control('description');
            echo $this->Form->control('deleted_date', ['empty' => true]);
            echo $this->Form->control('deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
