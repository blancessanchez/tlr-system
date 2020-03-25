<?php $this->assign('title', 'Service Credit'); ?>
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
      <li><a href="<?= $this->Url->build([
          'controller' => 'EmployeeInformation',
          'action' => 'employeeList'
        ]);
      ?>"><i class="fa fa-briefcase"></i>
        Employees List</a>
      </li>
      <li class="active">Edit Service Credit</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <?= $this->Flash->render(); ?>
        <button type="button" class="btn btn-primary btn-md" onclick="location.href='/service_credit/history/' + '<?= $leaveBalance->employee_id ?>'">
          Service Credit History
        </button><br><br>
        <div class="box box-primary">
            <?= $this->Form->create('LeaveBalances', [
              'url' => [
                'controller' => 'LeaveBalances',
                'action' => 'edit',
                'id' => $leaveBalance->id
              ]
            ]) ?>
            <div class="box-body">
              <div class="col-md-12">
                <h2 class="page-header">
                  <i class="fa fa-cog"></i> Service Credit
                </h2>
              </div>
              <div class="col-md-6">
                <div class="form-group col-md-12 <?= isset($leaveBalanceError['balance']) ? 'has-error' : '' ?>">
                  <label for="value">Service Credit Balance <span style="color:red">*</span></label>
                  <?= $this->Form->control('LeaveBalances.balance', [
                    'class' => 'form-control',
                    'id' => 'value',
                    'label' => false,
                    'value' => $leaveBalance->balance
                  ]); ?>
                  <span class="help-block"><?= $this->Error->first(isset($leaveBalanceError['balance']) ? $leaveBalanceError['balance'] : null) ?></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group col-md-12 <?= isset($serviceCreditHistoryError['description']) ? 'has-error' : '' ?>">
                  <label for="value">Service Credit Description<span style="color:red">*</span></label>
                  <?= $this->Form->control('ServiceCreditHistory.description', [
                    'class' => 'form-control',
                    'id' => 'value',
                    'label' => false
                  ]); ?>
                  <span class="help-block"><?= $this->Error->first(isset($serviceCreditHistoryError['description']) ? $serviceCreditHistoryError['description'] : null) ?></span>
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

