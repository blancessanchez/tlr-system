<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ServiceCreditHistory $serviceCreditHistory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Service Credit History'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="serviceCreditHistory form large-9 medium-8 columns content">
    <?= $this->Form->create($serviceCreditHistory) ?>
    <fieldset>
        <legend><?= __('Add Service Credit History') ?></legend>
        <?php
            echo $this->Form->control('description');
            echo $this->Form->control('added_balance');
            echo $this->Form->control('deleted_date', ['empty' => true]);
            echo $this->Form->control('deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
