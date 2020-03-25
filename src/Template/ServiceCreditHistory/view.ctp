<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ServiceCreditHistory $serviceCreditHistory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Service Credit History'), ['action' => 'edit', $serviceCreditHistory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Service Credit History'), ['action' => 'delete', $serviceCreditHistory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $serviceCreditHistory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Service Credit History'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Service Credit History'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="serviceCreditHistory view large-9 medium-8 columns content">
    <h3><?= h($serviceCreditHistory->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($serviceCreditHistory->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($serviceCreditHistory->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Added Balance') ?></th>
            <td><?= $this->Number->format($serviceCreditHistory->current_balance) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted') ?></th>
            <td><?= $this->Number->format($serviceCreditHistory->deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($serviceCreditHistory->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($serviceCreditHistory->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted Date') ?></th>
            <td><?= h($serviceCreditHistory->deleted_date) ?></td>
        </tr>
    </table>
</div>
