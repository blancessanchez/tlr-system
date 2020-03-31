<?php $this->assign('title', 'View Leave'); ?>
<?= $this->element('loading') ?>

<div class="content-wrapper">
  <section class="content-header">
  <h1>
    Leave Detail
  </h1>
  <ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Leaves List</a></li>
    <li class="active">View Leave</li>
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
        <div class="box box-primary">
          <div class="box-body">
            <div class="col-md-12">
              <h2 class="page-header">
                <i class="fa fa-user"></i> Employee Information
              </h2>
            </div>
            <div class="col-md-12">
              <div class="form-group col-md-4">
                <label for="employee_id">Employee Name</label>
                <?= $this->Form->control('', [
                  'class' => 'form-control',
                  'id' => 'employee_name',
                  'label' => false,
                  'disabled' => 'disabled',
                  'value' => h($leaveApplication->employee_information->last_name . ', ' .
                                $leaveApplication->employee_information->first_name . ' ' .
                                $leaveApplication->employee_information->middle_name)
                ]); ?>
              </div>
            </div>
            <div class="col-md-12">
              <h2 class="page-header">
                <i class="fa fa-pencil-square-o"></i> Details of Application
              </h2>
            </div>
            <div class="col-md-12">
              <div class="form-group col-md-4">
                <label for="leave_type_id">Type of Leave</label>
                <?= $this->Form->control('', [
                  'class' => 'form-control',
                  'id' => 'leave_type_id',
                  'label' => false,
                  'value' => $leaveTypes[$leaveApplication->leave_type_id],
                  'disabled' => 'disabled'
                ]); ?>
              </div>
              <div class="form-group col-md-4">
                <label for="leave_category" id="leave_category_id">Leave Category</label>
                <?= $this->Form->control('', [
                  'class' => 'form-control',
                  'id' => 'leave_category_id',
                  'label' => false,
                  'value' => !empty($leaveApplication->leave_category_id) ? $leaveCategories[$leaveApplication->leave_category_id] : null,
                  'disabled' => 'disabled'
                ]); ?>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group col-md-4">
                <label for="applied_for">Applied for</label>
                <?= $this->Form->control('Leaves.applied_for', [
                  'class' => 'form-control',
                  'id' => 'applied_for',
                  'label' => false,
                  'value' => ($diff > 1) ? $diff . ' days' : $diff . ' day',
                  'disabled' => 'disabled'
                ]); ?>
              </div>
              <div class="form-group col-md-4">
                <label for="leave_from">From</label>
                <?= $this->Form->control('Leaves.leave_from', [
                  'class' => 'form-control pull-right',
                  'id' => 'leave_from',
                  'label' => false,
                  'autocomplete' => 'off',
                  'value' => $leaveApplication->leave_from,
                  'disabled' => 'disabled'
                ]); ?>
              </div>
              <div class="form-group col-md-4">
                <label for="leave_to">To</label>
                <?= $this->Form->control('Leaves.leave_to', [
                  'class' => 'form-control pull-right',
                  'id' => 'leave_to',
                  'label' => false,
                  'autocomplete' => 'off',
                  'value' => $leaveApplication->leave_to,
                  'disabled' => 'disabled'
                ]); ?>
              </div>
            </div>
            <div class="form-group col-md-12">
              <div class="form-group col-md-4">
                <label for="commutation">Commutation</label>
                <div class="radio">
                  <?= $this->Form->radio('Leaves.commutation', 
                      [
                        ['value' => 1, 'text' => 'Requested'],
                        ['value' => 2, 'text' => 'Not Requested'],
                      ],
                      [
                        'value' => $leaveApplication->commutation,
                        'disabled' => 'disabled'
                      ]
                    ); 
                  ?>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <h2 class="page-header">
                <i class="fa fa-info"></i> Details on Action of Application
              </h2>
            </div>
            <?php if (empty($leaveResponse) && (($currentUser != $this->Configure->read('EMPLOYEES.ROLES.Teacher')) &&
              $leaveApplication->leave_status != $this->Configure->read('LEAVES.STATUS.Cancelled'))) : ?>
              <?= $this->Form->create('LeaveApplicationResponses', [
                'url' => [
                  'controller' => 'LeaveApplicationResponses',
                  'action' => 'add'
                ]
              ]) ?>
                <?= $this->Form->control('LeaveApplicationResponses.application_id', [
                  'class' => 'form-control',
                  'id' => 'leave_application_id',
                  'label' => false,
                  'type' => 'hidden',
                  'value' => $leaveApplication->id
                ]); ?>
                <div class="form-group col-md-12">
                  <div class="form-group col-md-4 <?= isset($leaveApplicationResponseErrors['recommendation_type']) ? 'has-error' : '' ?>">
                    <label for="recommendation_type">Recommendation</label>
                    <div class="radio">
                      <?= $this->Form->radio('LeaveApplicationResponses.recommendation_type', 
                          [
                            'Approval',
                            'Disapproval due to'
                          ]
                        ); 
                      ?>
                    </div>
                    <span class="help-block"><?= $this->Error->first(isset($leaveApplicationResponseErrors['recommendation_type']) ? $leaveApplicationResponseErrors['recommendation_type'] : null) ?></span>
                  </div>
                  <div class="form-group col-md-8 <?= isset($leaveApplicationResponseErrors['notes']) ? 'has-error' : '' ?>">
                    <label id="lblDisapproved" for="notes">Disappproved due to</label>
                    <?= $this->Form->control('LeaveApplicationResponses.recommendation_description', [
                      'class' => 'form-control',
                      'id' => 'recommendation_description',
                      'label' => false,
                      'type' => 'hidden'
                    ]); ?>
                    <label id="error_recommendation_description" class="error_label"></label>
                  </div>
                </div>
                <?php if (($currentUser == $this->Configure->read('EMPLOYEES.ROLES.Admin') ||
                  $currentUser == $this->Configure->read('EMPLOYEES.ROLES.Principal')) &&
                  $leaveApplication->commutation == $this->Configure->read('LEAVE_APPLICATION.COMMUTATION.Requested')) : ?>
                  <div class="form-group col-md-12">
                    <div class="form-group col-md-4">
                      <label id="lblDisapproved" for="notes">Deductible to Service Credit</label>
                      <?= $this->Form->control('Leaves.deductible_to_service_credit', [
                        'class' => 'form-control',
                        'id' => 'deductible_to_service_credit',
                        'label' => false,
                        'type' => 'number',
                        'value' => $leaveApplication->deductible_to_service_credit,
                        'disabled' => $currentUser == $this->Configure->read('EMPLOYEES.ROLES.Principal') ? 'disabled' : 'false'
                      ]); ?>
                      <label id="error_deductible_to_service_credit" class="error_label"></label>
                    </div>
                  </div>
                <?php endif ?>
                <div class="box-footer">
                  <button type="button" class="btn btn-default">Clear</button>
                  <button type="button" id="btnApplicationResponse" class="btn btn-primary pull-right">Submit</button>
                </div>
              <?= $this->Form->end() ?>
            <?php elseif ($leaveApplication->leave_status == $this->Configure->read('LEAVES.STATUS.Cancelled')) : ?>
              <div class="form-group col-md-12">
                <div class="callout callout-warning" style="margin-bottom: 0!important;">
                  <h4><i class="fa fa-info"></i> Note:</h4>
                  Leave was cancelled by applicant
                </div>
              </div>
            <?php elseif ($leaveApplication->leave_status == $this->Configure->read('LEAVES.STATUS.Approved')) : ?>
              <div class="form-group col-md-12">
                <div class="callout callout-success" style="margin-bottom: 0!important;">
                  <h4><i class="fa fa-info"></i> Note:</h4>
                  Leave was approved by principal
                </div>
              </div>
            <?php elseif ($leaveApplication->leave_status == $this->Configure->read('LEAVES.STATUS.ApprovedByHeadTeacher')) : ?>
              <div class="form-group col-md-12">
                <div class="callout callout-success" style="margin-bottom: 0!important;">
                  <h4><i class="fa fa-info"></i> Note:</h4>
                  Leave was approved by head teacher
                </div>
              </div>
            <?php elseif ($leaveApplication->leave_status == $this->Configure->read('LEAVES.STATUS.ApprovedByAdmin')) : ?>
              <div class="form-group col-md-12">
                <div class="callout callout-success" style="margin-bottom: 0!important;">
                  <h4><i class="fa fa-info"></i> Note:</h4>
                  Leave was approved by admin
                </div>
              </div>
            <?php else : ?>
              <div class="form-group col-md-12">
                <div class="form-group col-md-4">
                  <label for="recommendation_type">Recommendation</label>
                  <div class="radio">
                    <?= $this->Form->radio('LeaveApplicationResponses.recommendation_type', 
                        [
                          'Approval',
                          'Disapproval due to'
                        ],
                        [
                          'value' => $leaveResponse->recommendation_type,
                          'disabled' => 'disabled'
                        ]
                      ); 
                    ?>
                  </div>
                </div>
                <div class="form-group col-md-8">
                  <label for="notes" id="lblDisapprovedView">Disappproved due to</label>
                  <?= $this->Form->control('LeaveApplicationResponses.recommendation_description', [
                    'class' => 'form-control',
                    'id' => 'recommendation_description_disabled',
                    'label' => false,
                    'value' => $leaveResponse->recommendation_description,
                    'disabled' => 'disabled'
                  ]); ?>
                </div>
              </div>
            <?php endif ?>
            <?php if ($leaveApplication->commutation == $this->Configure->read('LEAVE_APPLICATION.COMMUTATION.Requested') &&
              $currentUser == $this->Configure->read('EMPLOYEES.ROLES.Teacher')) : ?>
              <div class="form-group col-md-12">
                <div class="form-group col-md-4">
                  <label for="notes">Deductible to Service Credit</label>
                  <?= $this->Form->control('Leaves.deductible_to_service_credit', [
                    'class' => 'form-control',
                    'id' => 'deductible_to_service_credit',
                    'label' => false,
                    'type' => 'number',
                    'value' => $leaveApplication->deductible_to_service_credit,
                    'disabled' => 'disabled'
                  ]); ?>
                  <label id="error_deductible_to_service_credit" class="error_label"></label>
                </div>
              </div>
            <?php endif ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
