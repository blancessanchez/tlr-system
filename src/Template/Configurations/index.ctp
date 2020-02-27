<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Configuration[]|\Cake\Collection\CollectionInterface $configurations
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Configuration'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="configurations index large-9 medium-8 columns content">
    <h3><?= __('Configurations') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('value') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('deleted_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($configurations as $configuration): ?>
            <tr>
                <td><?= $this->Number->format($configuration->id) ?></td>
                <td><?= h($configuration->type_id) ?></td>
                <td><?= h($configuration->value) ?></td>
                <td><?= h($configuration->created) ?></td>
                <td><?= h($configuration->modified) ?></td>
                <td><?= h($configuration->deleted_date) ?></td>
                <td><?= $this->Number->format($configuration->deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $configuration->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $configuration->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $configuration->id], ['confirm' => __('Are you sure you want to delete # {0}?', $configuration->id)]) ?>
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
