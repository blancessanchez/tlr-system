<?php $this->assign('title', 'Edit Leave'); ?>
<?php if ($errorPage) : ?>
  <?= $this->element('404error') ?>
<?php else : ?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Edit Leave
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Edit Leave</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <?= $this->Flash->render(); ?>
    <h4>Remaining Leaves</h4>
    <?php foreach ($leaveBalance as $balance) : ?>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-default">
          <span class="info-box-icon">
            <?php if ($balance->leave_type->id == 6) : ?>
              <i class="fa fa-calendar-plus-o"></i>
            <?php elseif ($balance->leave_type->id == 1) : ?>
              <i class="fa fa-suitcase"></i>
            <?php elseif ($balance->leave_type->id == 2) : ?>
              <i class="fa fa-medkit"></i>
            <?php endif ?>
          </span>
          <div class="info-box-content">
            <span class="info-box-text"><?= ($balance->leave_type->description == 'ALS') ? 'Leaves' : $balance->leave_type->description ?></span>
            <span class="info-box-number"><?= $balance->balance ?> days</span>
          </div>
        </div>
      </div>
    <?php endforeach ?>
      <div class="row">
        <div class="col-md-12">
          <?= $this->Flash->render(); ?>
          <div class="box box-primary">
            <?= $this->Form->create('LeaveApplications', [
                'url' => [
                  'controller' => 'LeaveApplications',
                  'action' => 'edit',
                  'id' => $leaveApplication->id
                ]
            ]) ?>
              <div class="box-body">
                <div class="col-md-12">
                  <button type="button" class="btn btn-warning pull-right" id="btnCancelLeave">Cancel Leave</button>
                  <h2 class="page-header">
                    <i class="fa fa-user"></i> Employee Information
                  </h2>
                </div>
                <div class="col-md-12">
                  <div class="form-group col-md-4">
                    <label for="employee_id">Employee Name</label>
                    <?= $this->Form->control('LeaveApplications.id', [
                      'class' => 'form-control',
                      'label' => false,
                      'disabled' => 'disabled',
                      'type' => 'hidden',
                      'value' => $leaveApplication->id,
                      'id' => 'edit_leave_application_id'
                    ]); ?>
                    <p>
                      <?= 
                        h($leaveApplication->employee_information->last_name . ', ' .
                        $leaveApplication->employee_information->first_name . ' ' .
                        $leaveApplication->employee_information->middle_name)
                      ?>
                    </p>
                    <span class="help-block"><?= $this->Error->first(isset($leaveApplicationErrors['employee_id']) ? $leaveApplicationErrors['employee_id'] : null) ?></span>
                  </div>
                </div>
                <div class="col-md-12">
                  <h2 class="page-header">
                    <i class="fa fa-pencil-square-o"></i> Details of Application
                  </h2>
                </div>
                <div class="col-md-12">
                  <div class="form-group col-md-4 <?= isset($leaveApplicationErrors['leave_type_id']) ? 'has-error' : '' ?>">
                    <label for="leave_type_id">Type of Leave <span style="color:red">*</span></label>
                    <?= $this->Form->control('LeaveApplications.leave_type_id', [
                      'class' => 'form-control',
                      'id' => 'add_leave_type_id',
                      'label' => false,
                      'options' => $leaveTypes,
                      'type' => 'select',
                      'value' => $leaveApplication->leave_type_id
                    ]); ?>
                    <span class="help-block"><?= $this->Error->first(isset($leaveApplicationErrors['leave_type_id']) ? $leaveApplicationErrors['leave_type_id'] : null) ?></span>
                  </div>
                  <div class="form-group col-md-4 <?= isset($leaveApplicationErrors['leave_category_id']) ? 'has-error' : '' ?>">
                    <label for="leave_category" id="leave_category_id">Leave Category</label>
                    <?= $this->Form->control('LeaveApplications.leave_category_id', [
                      'class' => 'form-control',
                      'id' => 'add_leave_category_id',
                      'label' => false,
                      'options' => $leaveCategories,
                      'type' => 'select',
                      'value' => $leaveApplication->leave_category_id
                    ]); ?>
                    <span class="help-block"><?= $this->Error->first(isset($leaveApplicationErrors['leave_category_id']) ? $leaveApplicationErrors['leave_category_id'] : null) ?></span>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group col-md-4 <?= isset($leaveApplicationErrors['leave_from']) ? 'has-error' : '' ?>">
                    <label for="leave_from">From <span style="color:red">*</span></label>
                    <?= $this->Form->control('LeaveApplications.leave_from', [
                      'class' => 'form-control pull-right',
                      'id' => 'leave_from',
                      'label' => false,
                      'autocomplete' => 'off',
                      'value' => $leaveApplication->leave_from
                    ]); ?>
                    <span class="help-block"><?= $this->Error->first(isset($leaveApplicationErrors['leave_from']) ? $leaveApplicationErrors['leave_from'] : null) ?></span>
                  </div>
                  <div class="form-group col-md-4 <?= isset($leaveApplicationErrors['leave_to']) ? 'has-error' : '' ?>">
                    <label for="leave_to">To <span style="color:red">*</span></label>
                    <?= $this->Form->control('LeaveApplications.leave_to', [
                      'class' => 'form-control pull-right',
                      'id' => 'leave_to',
                      'label' => false,
                      'autocomplete' => 'off',
                      'value' => $leaveApplication->leave_to
                    ]); ?>
                    <span class="help-block"><?= $this->Error->first(isset($leaveApplicationErrors['leave_to']) ? $leaveApplicationErrors['leave_to'] : null) ?></span>
                  </div>
                  <div class="form-group col-md-4 <?= isset($leaveApplicationErrors['commutation']) ? 'has-error' : '' ?>">
                    <label for="commutation">Commutation</label>
                    <div class="radio">
                      <?= $this->Form->radio('LeaveApplications.commutation', 
                          [
                            ['value' => 1, 'text' => 'Requested'],
                            ['value' => 2, 'text' => 'Not Requested']
                          ],
                          [
                            'value' => $leaveApplication->commutation
                          ]
                        ); 
                      ?>
                    </div>
                    <span class="help-block"><?= $this->Error->first(isset($leaveApplicationErrors['commutation']) ? $leaveApplicationErrors['commutation'] : null) ?></span>
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
<?php endif ?>