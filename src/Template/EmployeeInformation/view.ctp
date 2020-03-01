<?php $this->assign('title', 'Employee Detail'); ?>
<?= $this->element('loading') ?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Employee Detail
    </h1>
  <ol class="breadcrumb">
    <li>
      <a href="<?= $this->Url->build([
        'controller' => 'EmployeeInformation',
        'action' => 'home'
      ]);
      ?>"><i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li>
      <a href="<?= $this->Url->build([
        'controller' => 'EmployeeInformation',
        'action' => 'employeeList'
      ]);
      ?>">
        <i class="fa fa-users"></i> Employee List
      </a>
    </li>
    <li class="active">View Employee</li>
  </ol>
  </section>
<!-- Main content -->
<section class="content">
    <div class="row">
      <div class="col-md-12">
        <?= $this->Flash->render(); ?>
        <div class="box box-primary">
          <div class="box-body">
            <div class="col-md-12">
              <h2 class="page-header">
                <i class="fa fa-user"></i> Employee Information
              </h2>
            </div>
            <div class="col-md-12">
              <div class="form-group col-md-4">
                <label for="employee_no">Employee Number</label>
                <?= $this->Form->control('', [
                  'class' => 'form-control',
                  'label' => false,
                  'value' => $employee->employee_no,
                  'disabled' => 'disabled'
                ]); ?>
              </div>
              <div class="form-group col-md-4">
                <label for="job_position">Job Position</label>
                <?= $this->Form->control('', [
                  'class' => 'form-control',
                  'id' => 'leave_category_id',
                  'label' => false,
                  'value' => !empty($employee->job_position_id) ? $jobPositions[$employee->job_position_id] : null,
                  'disabled' => 'disabled'
                ]); ?>
              </div>
              <div class="form-group col-md-4">
                <label for="is_als">Teacher type</label>
                <div class="radio">
                 <input type="hidden" name="is_als" value="0" />
                  <?= $this->Form->radio('EmployeeInformation.is_als', 
                      [
                        ['value' => 1, 'text' => 'ALS'],
                        ['value' => 2, 'text' => 'Non-ALS'],
                      ],
                      [
                        'value' => $employee->is_als,
                        'disabled' => 'disabled'
                      ]
                    ); 
                  ?>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group col-md-4">
                <label for="salary">Salary</label>
                <?= $this->Form->control('', [
                  'class' => 'form-control',
                  'label' => false,
                  'value' => h($employee->salary),
                  'disabled' => 'disabled'
                ]); ?>
              </div>
              <div class="form-group col-md-4">
                <label for="hired_date">Hired date</label>
                <?= $this->Form->control('', [
                  'class' => 'form-control',
                  'label' => false,
                  'value' => $employee->hired_date,
                  'disabled' => 'disabled'
                ]); ?>
              </div>
              <div class="form-group col-md-4">
                <label for="status">Status</label>
                <?= $this->Form->control('', [
                  'class' => 'form-control',
                  'label' => false,
                  'value' => $employeeStatus[$employee->status],
                  'disabled' => 'disabled'
                ]); ?>
              </div>
            </div>
            <div class="col-md-12">
              <h2 class="page-header">
                <i class="fa fa-sticky-note"></i> Basic Information
              </h2>
            </div>
            <div class="form-group col-md-12">
              <div class="form-group col-md-4">
                <label for="last_name">Last Name</label>
                <?= $this->Form->control('', [
                  'class' => 'form-control',
                  'label' => false,
                  'value' => h($employee->last_name),
                  'disabled' => 'disabled'
                ]); ?>
              </div>
              <div class="form-group col-md-4">
                <label for="first_name">First Name</label>
                <?= $this->Form->control('', [
                  'class' => 'form-control',
                  'label' => false,
                  'value' => h($employee->first_name),
                  'disabled' => 'disabled'
                ]); ?>
              </div>
              <div class="form-group col-md-4">
                <label for="middle_name">Middle Name</label>
                <?= $this->Form->control('', [
                  'class' => 'form-control',
                  'label' => false,
                  'value' => h($employee->middle_name),
                  'disabled' => 'disabled'
                ]); ?>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group col-md-4">
                <label for="address">Address</label>
                <?= $this->Form->control('', [
                  'class' => 'form-control',
                  'label' => false,
                  'value' => h($employee->address),
                  'disabled' => 'disabled'
                ]); ?>
              </div>
              <div class="form-group col-md-4">
                <label for="mobile_no">Mobile Number</label>
                <?= $this->Form->control('', [
                  'class' => 'form-control',
                  'label' => false,
                  'value' => h($employee->mobile_no),
                  'disabled' => 'disabled'
                ]); ?>
              </div>
              <div class="form-group col-md-4">
                <label for="email">Email Address</label>
                <?= $this->Form->control('', [
                  'class' => 'form-control',
                  'label' => false,
                  'value' => h($employee->email),
                  'disabled' => 'disabled'
                ]); ?>
              </div>
              <div class="form-group col-md-4">
                <label for="gender">Gender</label>
                <div class="radio">
                  <?= $this->Form->radio('EmployeeInformation.gender', 
                      [
                        ['value' => 1, 'text' => 'Male'],
                        ['value' => 2, 'text' => 'Female'],
                      ],
                      [
                        'value' => $employee->gender,
                        'disabled' => 'disabled'
                      ]
                    ); 
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
