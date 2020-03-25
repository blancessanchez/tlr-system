<?php $this->assign('title', 'Employee Detail'); ?>
<?= $this->element('loading') ?>

<div class="content-wrapper">
  <section class="content-header">
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
    <h4>Leave Balances Information</h4>
    <?= $this->Flash->render(); ?>
      <?php foreach ($employee->leave_balances as $balance) : ?>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-default">
            <span class="info-box-icon">
              <?php if ($balance->leave_type_id == $this->Configure->read('LEAVES.TYPE.Combo')) : ?>
                <i class="fa fa-calendar-plus-o"></i>
              <?php elseif ($balance->leave_type_id == $this->Configure->read('LEAVES.TYPE.Vacation')) : ?>
                <i class="fa fa-suitcase"></i>
              <?php elseif ($balance->leave_type_id == $this->Configure->read('LEAVES.TYPE.Sick')) : ?>
                <i class="fa fa-medkit"></i>
              <?php elseif ($balance->leave_type_id == $this->Configure->read('LEAVES.TYPE.ServiceCredit')) : ?>
                <i class="fa fa-star"></i>
              <?php endif ?>
            </span>
            <div class="info-box-content">
              <span class="info-box-text"><?= ($balance->leave_type->description == 'ALS') ? 'Leaves' : $balance->leave_type->description ?></span>
              <!-- Check balance if is less than 2, which is one for use of word day/days -->
              <span class="info-box-number"><?= ($balance->balance < 2 ? $balance->balance . ' day' : $balance->balance . ' days') ?></span>
              <?php if ($balance->leave_type_id == $this->Configure->read('LEAVES.TYPE.ServiceCredit') && $isAdmin) : ?>
                <button type="button" class="btn btn-default btn-sm" id="btn-edit-service-credit" onclick="location.href='/service_credit/edit/' + '<?= $balance->id ?>'">
                  <i class="fa fa-pencil"></i>  Edit service credit
                </button>
              <?php endif ?>
            </div>
          </div>
        </div>
      <?php endforeach ?>
  </section>
<!-- Main content -->
<section class="content">
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
                  'id' => 'job_position_id',
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
                  'value' => !empty($employee->hired_date) ? date('m/d/Y', strtotime($employee->hired_date)) : null,
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
              <div class="form-group col-md-4">
                <label for="job_position">Department</label>
                <?= $this->Form->control('', [
                  'class' => 'form-control',
                  'id' => 'department_id',
                  'label' => false,
                  'value' => !empty($employee->department_id) ? $departments[$employee->department_id] : null,
                  'disabled' => 'disabled'
                ]); ?>
              </div>
              <div class="form-group col-md-4">
                <label for="job_position">Role</label>
                <?= $this->Form->control('', [
                  'class' => 'form-control',
                  'id' => 'role_id',
                  'label' => false,
                  'value' => !empty($employee->role_id) ? $roles[$employee->role_id] : null,
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
