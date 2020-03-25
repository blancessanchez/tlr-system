<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ServiceCreditHistory[]|\Cake\Collection\CollectionInterface $serviceCreditHistory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Service Credit History'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="serviceCreditHistory index large-9 medium-8 columns content">
    <h3><?= __('Service Credit History') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                <th scope="col"><?= $this->Paginator->sort('added_balance') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('deleted_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($serviceCreditHistory as $serviceCreditHistory): ?>
            <tr>
                <td><?= $this->Number->format($serviceCreditHistory->id) ?></td>
                <td><?= h($serviceCreditHistory->description) ?></td>
                <td><?= $this->Number->format($serviceCreditHistory->added_balance) ?></td>
                <td><?= h($serviceCreditHistory->created) ?></td>
                <td><?= h($serviceCreditHistory->modified) ?></td>
                <td><?= h($serviceCreditHistory->deleted_date) ?></td>
                <td><?= $this->Number->format($serviceCreditHistory->deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $serviceCreditHistory->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $serviceCreditHistory->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $serviceCreditHistory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $serviceCreditHistory->id)]) ?>
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
