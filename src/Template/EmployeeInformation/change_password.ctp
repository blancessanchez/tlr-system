<?php $this->assign('title', 'Change Password'); ?>
<div class="content-wrapper">
  <section class="content-header">
    <h1></h1><br>
    <ol class="breadcrumb">
      <li>
        <a href="<?= $this->Url->build([
          'controller' => 'EmployeeInformation',
          'action' => 'home'
        ]);
        ?>"><i class="fa fa-dashboard"></i> Home</a>
      </li>
      <li class="active">Change Password</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <?= $this->Flash->render(); ?>
        <div class="box box-primary">
            <?= $this->Form->create('EmployeeInformation', [
              'url' => [
                'controller' => 'EmployeeInformation',
                'action' => 'changePassword'
              ]
            ]) ?>
            <div class="box-body">
              <div class="col-md-12">
                <h2 class="page-header">
                  <i class="fa fa-key"></i> Change Password
                </h2>
              </div>
              <div class="col-md-12">
                <div class="form-group col-md-12 <?= isset($employeeErrors['current_password']) ? 'has-error' : '' ?>">
                  <label for="value">Current Password <span style="color:red">*</span></label>
                  <?= $this->Form->control('EmployeeInformation.current_password', [
                    'class' => 'form-control',
                    'id' => 'value',
                    'label' => false,
                    'type' => 'password'
                  ]); ?>
                  <span class="help-block"><?= $this->Error->first(isset($employeeErrors['current_password']) ? $employeeErrors['current_password'] : null) ?></span>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group col-md-12 <?= isset($employeeErrors['password']) ? 'has-error' : '' ?>">
                  <label for="value">New Password <span style="color:red">*</span></label>
                  <?= $this->Form->control('EmployeeInformation.password', [
                    'class' => 'form-control',
                    'id' => 'value',
                    'label' => false,
                    'type' => 'password'
                  ]); ?>
                  <span class="help-block"><?= $this->Error->first(isset($employeeErrors['password']) ? $employeeErrors['password'] : null) ?></span>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group col-md-12 <?= isset($employeeErrors['confirm_password']) ? 'has-error' : '' ?>">
                  <label for="value">Confirm Password <span style="color:red">*</span></label>
                  <?= $this->Form->control('EmployeeInformation.confirm_password', [
                    'class' => 'form-control',
                    'id' => 'value',
                    'label' => false,
                    'type' => 'password'
                  ]); ?>
                  <span class="help-block"><?= $this->Error->first(isset($employeeErrors['confirm_password']) ? $employeeErrors['confirm_password'] : null) ?></span>
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
