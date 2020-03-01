<?php $this->assign('title', 'Edit Employee'); ?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Edit Employee
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Employee List</a></li>
      <li><a href="#">Edit New Employee</a></li>
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
                'action' => 'edit',
                'id' => $employee->id
              ]
          ]) ?>
            <div class="box-body">
              <div class="col-md-12">
                <h2 class="page-header">
                  <i class="fa fa-user"></i> Employee Information
                </h2>
              </div>
              <div class="col-md-12">
                <div class="form-group col-md-4 <?= isset($employeeErrors['employee_no']) ? 'has-error' : '' ?>">
                  <label for="employee_no">Employee Number <span style="color:red">*</span></label>
                  <?= $this->Form->control('EmployeeInformation.employee_no', [
                    'class' => 'form-control',
                    'id' => 'employee_no',
                    'label' => false,
                    'value' => $employee->employee_no
                  ]); ?>
                  <span class="help-block"><?= $this->Error->first(isset($employeeErrors['employee_no']) ? $employeeErrors['employee_no'] : null) ?></span>
                </div>
                <div class="form-group col-md-4 <?= isset($employeeErrors['job_position_id']) ? 'has-error' : '' ?>">
                  <label for="job_position">Job Position <span style="color:red">*</span></label>
                  <?= $this->Form->control('EmployeeInformation.job_position_id', [
                    'class' => 'form-control',
                    'id' => 'job_position',
                    'label' => false,
                    'options' => $jobPositions,
                    'type' => 'select',
                    'value' => $employee->job_position_id
                  ]); ?>
                  <span class="help-block"><?= $this->Error->first(isset($employeeErrors['job_position_id']) ? $employeeErrors['job_position_id'] : null) ?></span>
                </div>
                <div class="form-group col-md-4 <?= isset($employeeErrors['is_als']) ? 'has-error' : '' ?>">
                  <label for="is_als">Teacher type <span style="color:red">*</span></label>
                  <div class="radio">
                    <?= $this->Form->radio('EmployeeInformation.is_als', 
                        [
                          ['value' => 1, 'text' => 'ALS'],
                          ['value' => 2, 'text' => 'Non-ALS'],
                        ],
                        [
                          'value' => $employee->is_als
                        ]
                      ); 
                    ?>
                  </div>
                  <span class="help-block"><?= $this->Error->first(isset($employeeErrors['is_als']) ? $employeeErrors['is_als'] : null) ?></span>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group col-md-4 <?= isset($employeeErrors['salary']) ? 'has-error' : '' ?>">
                  <label for="salary">Salary</label>
                  <?= $this->Form->control('EmployeeInformation.salary', [
                    'class' => 'form-control',
                    'id' => 'salary',
                    'label' => false,
                    'value' => $employee->salary
                  ]); ?>
                  <span class="help-block"><?= $this->Error->first(isset($employeeErrors['salary']) ? $employeeErrors['salary'] : null) ?></span>
                </div>
                <div class="form-group col-md-4 <?= isset($employeeErrors['hired_date']) ? 'has-error' : '' ?>">
                  <label for="hired_date">Hired date</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <?= $this->Form->control('EmployeeInformation.hired_date', [
                      'class' => 'form-control pull-right',
                      'id' => 'hired_date',
                      'label' => false,
                      'value' => $employee->hired_date
                    ]); ?>
                    <span class="help-block"><?= $this->Error->first(isset($employeeErrors['hired_date']) ? $employeeErrors['hired_date'] : null) ?></span>
                  </div>
                </div>
                <div class="form-group col-md-4 <?= isset($employeeErrors['status']) ? 'has-error' : '' ?>">
                  <label for="status">Status <span style="color:red">*</span></label>
                  <?= $this->Form->control('EmployeeInformation.status', [
                    'class' => 'form-control',
                    'id' => 'status',
                    'label' => false,
                    'options' => $employeeStatus,
                    'type' => 'select',
                    'value' => $employee->status
                  ]); ?>
                  <span class="help-block"><?= $this->Error->first(isset($employeeErrors['status']) ? $employeeErrors['status'] : null) ?></span>
                </div>
              </div>
              <div class="col-md-12">
                <h2 class="page-header">
                  <i class="fa fa-sticky-note"></i> Basic Information
                </h2>
              </div>
              <div class="form-group col-md-12">
                <div class="form-group col-md-4 <?= isset($employeeErrors['last_name']) ? 'has-error' : '' ?>">
                  <label for="last_name">Last Name <span style="color:red">*</span></label>
                  <?= $this->Form->control('EmployeeInformation.last_name', [
                    'class' => 'form-control',
                    'id' => 'last_name',
                    'label' => false,
                    'value' => $employee->last_name
                  ]); ?>
                  <span class="help-block"><?= $this->Error->first(isset($employeeErrors['last_name']) ? $employeeErrors['last_name'] : null) ?></span>
                </div>
                <div class="form-group col-md-4 <?= isset($employeeErrors['first_name']) ? 'has-error' : '' ?>">
                  <label for="first_name">First Name <span style="color:red">*</span></label>
                  <?= $this->Form->control('EmployeeInformation.first_name', [
                    'class' => 'form-control',
                    'id' => 'first_name',
                    'label' => false,
                    'value' => $employee->first_name
                  ]); ?>
                  <span class="help-block"><?= $this->Error->first(isset($employeeErrors['first_name']) ? $employeeErrors['first_name'] : null) ?></span>
                </div>
                <div class="form-group col-md-4 <?= isset($employeeErrors['middle_name']) ? 'has-error' : '' ?>">
                  <label for="middle_name">Middle Name</label>
                  <?= $this->Form->control('EmployeeInformation.middle_name', [
                    'class' => 'form-control',
                    'id' => 'middle_name',
                    'label' => false,
                    'value' => $employee->middle_name
                  ]); ?>
                  <span class="help-block"><?= $this->Error->first(isset($employeeErrors['middle_name']) ? $employeeErrors['middle_name'] : null) ?></span>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group col-md-4 <?= isset($employeeErrors['address']) ? 'has-error' : '' ?>">
                  <label for="address">Address <span style="color:red">*</span></label>
                  <?= $this->Form->control('EmployeeInformation.address', [
                    'class' => 'form-control',
                    'id' => 'address',
                    'label' => false,
                    'value' => $employee->address
                  ]); ?>
                  <span class="help-block"><?= $this->Error->first(isset($employeeErrors['address']) ? $employeeErrors['address'] : null) ?></span>
                </div>
                <div class="form-group col-md-4 <?= isset($employeeErrors['mobile_no']) ? 'has-error' : '' ?>">
                  <label for="mobile_no">Mobile Number <span style="color:red">*</span></label>
                  <?= $this->Form->control('EmployeeInformation.mobile_no', [
                    'class' => 'form-control',
                    'id' => 'mobile_no',
                    'label' => false,
                    'type' => 'number',
                    'value' => $employee->mobile_no
                  ]); ?>
                  <span class="help-block"><?= $this->Error->first(isset($employeeErrors['mobile_no']) ? $employeeErrors['mobile_no'] : null) ?></span>
                </div>
                <div class="form-group col-md-4 <?= isset($employeeErrors['email']) ? 'has-error' : '' ?>">
                  <label for="email">Email Address <span style="color:red">*</span></label>
                  <?= $this->Form->control('EmployeeInformation.email', [
                    'class' => 'form-control',
                    'id' => 'email',
                    'label' => false,
                    'type' => 'email',
                    'value' => $employee->email
                  ]); ?>
                  <span class="help-block"><?= $this->Error->first(isset($employeeErrors['email']) ? $employeeErrors['email'] : null) ?></span>
                </div>
                <div class="form-group col-md-4 <?= isset($employeeErrors['gender']) ? 'has-error' : '' ?>">
                  <label for="gender">Gender <span style="color:red">*</span></label>
                  <div class="radio">
                    <?= $this->Form->radio('EmployeeInformation.gender', 
                        [
                          ['value' => 1, 'text' => 'Male'],
                          ['value' => 2, 'text' => 'Female']
                        ],
                        [
                        'value' => $employee->gender
                        ]
                      ); 
                    ?>
                  </div>
                  <span class="help-block"><?= $this->Error->first(isset($employeeErrors['gender']) ? $employeeErrors['gender'] : null) ?></span>
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
