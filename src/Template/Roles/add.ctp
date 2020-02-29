<?php $this->assign('title', 'Role'); ?>
<div class="content-wrapper">
  <section class="content-header">
    <h1></h1><br>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
      <li><a href="#">Add Role</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <?= $this->Flash->render(); ?>
        <div class="box box-primary">
            <?= $this->Form->create('Roles', [
              'url' => [
                'controller' => 'Roles',
                'action' => 'add'
              ]
            ]) ?>
            <div class="box-body">
              <div class="col-md-12">
                <h2 class="page-header">
                  <i class="fa fa-cog"></i> Roles
                </h2>
              </div>
              <div class="col-md-12">
                <div class="form-group col-md-6 <?= isset($roleErrors['title']) ? 'has-error' : '' ?>">
                  <label for="title">Roles Title <span style="color:red">*</span></label>
                  <?= $this->Form->control('Roles.title', [
                    'class' => 'form-control',
                    'id' => 'title',
                    'label' => false
                  ]); ?>
                  <span class="help-block"><?= $this->Error->first(isset($roleErrors['title']) ? $roleErrors['title'] : null) ?></span>
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
