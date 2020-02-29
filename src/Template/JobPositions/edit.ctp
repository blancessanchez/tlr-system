<?php $this->assign('title', 'Job Position'); ?>
<div class="content-wrapper">
  <section class="content-header">
    <h1></h1><br>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
      <li><a href="#">Edit Job Positions</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <?= $this->Flash->render(); ?>
        <div class="box box-primary">
            <?= $this->Form->create('JobPositions', [
              'url' => [
                'controller' => 'JobPositions',
                'action' => 'edit',
                'id' => $jobPosition->id
              ]
            ]) ?>
            <div class="box-body">
              <div class="col-md-12">
                <h2 class="page-header">
                  <i class="fa fa-cog"></i> Job Position
                </h2>
              </div>
              <div class="col-md-12">
                <div class="form-group col-md-6 <?= isset($jobPositionErrors['title']) ? 'has-error' : '' ?>">
                  <label for="value">Job Position Title <span style="color:red">*</span></label>
                  <?= $this->Form->control('JobPositions.title', [
                    'class' => 'form-control',
                    'id' => 'value',
                    'label' => false,
                    'value' => $jobPosition->title
                  ]); ?>
                  <span class="help-block"><?= $this->Error->first(isset($jobPositionErrors['title']) ? $jobPositionErrors['title'] : null) ?></span>
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

