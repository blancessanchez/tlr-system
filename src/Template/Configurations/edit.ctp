<?php $this->assign('title', 'System Configuration'); ?>
<div class="content-wrapper">
  <section class="content-header">
    <h1></h1><br>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Settings</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <?= $this->Flash->render(); ?>
        <div class="box box-primary">
          <?= $this->Form->create('Configurations', [
              'url' => [
                'controller' => 'Configurations',
                'action' => 'edit'
              ]
          ]) ?>
            <div class="box-body">
              <div class="col-md-12">
                <h2 class="page-header">
                  <i class="fa fa-cog"></i> System Configuration
                </h2>
              </div>
              <div class="col-md-12">
                <div class="form-group col-md-6 <?= isset($configurationErrors['value']) ? 'has-error' : '' ?>">
                  <label for="value">System Name <span style="color:red">*</span></label>
                  <?= $this->Form->control('Configurations.id', [
                    'type' => 'hidden',
                    'label' => false,
                    'value' => $configuration->id
                  ]); ?>
                  <?= $this->Form->control('Configurations.value', [
                    'class' => 'form-control',
                    'id' => 'value',
                    'label' => false,
                    'value' => $configuration->value
                  ]); ?>
                  <span class="help-block"><?= $this->Error->first(isset($configurationErrors['value']) ? $configurationErrors['value'] : null) ?></span>
                </div>
              </div>
            </div>
            <div class="box-footer">
              <button type="button" class="btn btn-default" onclick="return Common.clearFormAll()">Clear</button>
              <button type="submit" class="btn btn-primary pull-right">Submit</button>
            </div>
          <?= $this->Form->end() ?>
        </div>
      </div>
    </div>
  </section>
</div>

