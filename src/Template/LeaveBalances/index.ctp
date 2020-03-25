<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LeaveBalance[]|\Cake\Collection\CollectionInterface $leaveBalances
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Leave Balance'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Employee Information'), ['controller' => 'EmployeeInformation', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Employee Information'), ['controller' => 'EmployeeInformation', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Terms'), ['controller' => 'Terms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Term'), ['controller' => 'Terms', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Leave Types'), ['controller' => 'LeaveTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Leave Type'), ['controller' => 'LeaveTypes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="leaveBalances index large-9 medium-8 columns content">
    <h3><?= __('Leave Balances') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('employee_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('term_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('balance') ?></th>
                <th scope="col"><?= $this->Paginator->sort('leave_type_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('deleted_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($leaveBalances as $leaveBalance): ?>
            <tr>
                <td><?= $this->Number->format($leaveBalance->id) ?></td>
                <td><?= $leaveBalance->has('employee_information') ? $this->Html->link($leaveBalance->employee_information->id, ['controller' => 'EmployeeInformation', 'action' => 'view', $leaveBalance->employee_information->id]) : '' ?></td>
                <td><?= $leaveBalance->has('term') ? $this->Html->link($leaveBalance->term->id, ['controller' => 'Terms', 'action' => 'view', $leaveBalance->term->id]) : '' ?></td>
                <td><?= $this->Number->format($leaveBalance->balance) ?></td>
                <td><?= $leaveBalance->has('leave_type') ? $this->Html->link($leaveBalance->leave_type->description, ['controller' => 'LeaveTypes', 'action' => 'view', $leaveBalance->leave_type->id]) : '' ?></td>
                <td><?= h($leaveBalance->created) ?></td>
                <td><?= h($leaveBalance->modified) ?></td>
                <td><?= h($leaveBalance->deleted_date) ?></td>
                <td><?= $this->Number->format($leaveBalance->deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $leaveBalance->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $leaveBalance->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $leaveBalance->id], ['confirm' => __('Are you sure you want to delete # {0}?', $leaveBalance->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
