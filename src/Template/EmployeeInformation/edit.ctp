<?php $this->assign('title', 'Edit Employee'); ?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Edit Employee
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
      <li class="active">Edit Employee</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <?= $this->Flash->render(); ?>
          <div class="box box-default">
            <?= $this->Form->create('EmployeeInformation', [
                'url' => [
                  'controller' => 'EmployeeInformation',
                  'action' => 'edit',
                  'id' => $employee->id
                ]
            ]) ?>
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">Personal Information</a></li>
                  <!-- <li><a href="#tab_2" data-toggle="tab">Work Experience</a></li>
                  <li><a href="#tab_3" data-toggle="tab">Learning and Development</a></li>
                  <li><a href="#tab_4" data-toggle="tab">References</a></li> -->
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    <div class="box-body">
                      <div class="col-md-12">
                        <h2 class="page-header">
                          Personal Information
                        </h2>
                      </div>
                      <div class="form-group col-md-12">
                        <div class="form-group col-md-12 <?= isset($employeeErrors['last_name']) ? 'has-error' : '' ?>">
                          <label for="last_name">Surname <span style="color:red">*</span></label>
                          <?= $this->Form->control('EmployeeInformation.last_name', [
                            'class' => 'form-control',
                            'id' => 'last_name',
                            'label' => false,
                            'value' => $employee->last_name
                          ]); ?>
                          <span class="help-block"><?= $this->Error->first(isset($employeeErrors['last_name']) ? $employeeErrors['last_name'] : null) ?></span>
                        </div>
                      </div>
                      <div class="form-group col-md-12">
                        <div class="form-group col-md-8 <?= isset($employeeErrors['first_name']) ? 'has-error' : '' ?>">
                          <label for="first_name">First Name <span style="color:red">*</span></label>
                          <?= $this->Form->control('EmployeeInformation.first_name', [
                            'class' => 'form-control',
                            'id' => 'first_name',
                            'label' => false,
                            'value' => $employee->first_name
                          ]); ?>
                          <span class="help-block"><?= $this->Error->first(isset($employeeErrors['first_name']) ? $employeeErrors['first_name'] : null) ?></span>
                        </div>
                        <div class="form-group col-md-4 <?= isset($employeeErrors['name_extension']) ? 'has-error' : '' ?>">
                          <label for="name_extension">Name Extension (Jr., Sr.)</label>
                          <?= $this->Form->control('EmployeeInformation.name_extension', [
                            'class' => 'form-control',
                            'id' => 'name_extension',
                            'label' => false,
                            'value' => $employee->name_extension
                          ]); ?>
                          <span class="help-block"><?= $this->Error->first(isset($employeeErrors['name_extension']) ? $employeeErrors['name_extension'] : null) ?></span>
                        </div>
                      </div>
                      <div class="form-group col-md-12">
                        <div class="form-group col-md-12 <?= isset($employeeErrors['middle_name']) ? 'has-error' : '' ?>">
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
                      <div class="form-group col-md-12">
                        <div class="form-group col-md-3 <?= isset($employeeErrors['birth_date']) ? 'has-error' : '' ?>">
                          <label for="birth_date">Date of Birth</label>
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <?= $this->Form->control('EmployeeInformation.birth_date', [
                              'class' => 'form-control pull-right',
                              'id' => 'birth_date',
                              'label' => false,
                              'value' => !empty($employee->birth_date) ? date('m/d/Y', strtotime($employee->birth_date)) : null
                            ]); ?>
                            <span class="help-block"><?= $this->Error->first(isset($employeeErrors['birth_date']) ? $employeeErrors['birth_date'] : null) ?></span>
                          </div>
                        </div>
                        <div class="form-group col-md-3 <?= isset($employeeErrors['birth_place']) ? 'has-error' : '' ?>">
                          <label for="birth_place">Place of Birth</label>
                          <?= $this->Form->control('EmployeeInformation.birth_place', [
                            'class' => 'form-control',
                            'id' => 'birth_place',
                            'label' => false,
                            'value' => $employee->birth_place
                          ]); ?>
                          <span class="help-block"><?= $this->Error->first(isset($employeeErrors['birth_place']) ? $employeeErrors['birth_place'] : null) ?></span>
                        </div>
                        <div class="form-group col-md-3 <?= isset($employeeErrors['gender']) ? 'has-error' : '' ?>">
                          <label for="gender">Gender</label>
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
                        <div class="form-group col-md-3 <?= isset($employeeErrors['blood_type']) ? 'has-error' : '' ?>">
                          <label for="blood_type">Blood Type</label>
                          <?= $this->Form->control('EmployeeInformation.blood_type', [
                            'class' => 'form-control',
                            'id' => 'blood_type',
                            'label' => false,
                            'value' => $employee->blood_type
                          ]); ?>
                          <span class="help-block"><?= $this->Error->first(isset($employeeErrors['gsis_id_no']) ? $employeeErrors['gsis_id_no'] : null) ?></span>
                        </div>
                      </div>
                      <div class="form-group col-md-12">
                        <div class="form-group col-md-3 <?= isset($employeeErrors['height']) ? 'has-error' : '' ?>">
                          <label for="height">Height</label>
                          <div class="input-group date">
                            <?= $this->Form->control('EmployeeInformation.height', [
                              'class' => 'form-control',
                              'id' => 'height',
                              'label' => false,
                              'value' => $employee->height
                            ]); ?>
                            <div class="input-group-addon">
                              m
                            </div>
                            <span class="help-block"><?= $this->Error->first(isset($employeeErrors['height']) ? $employeeErrors['height'] : null) ?></span>
                          </div>
                        </div>
                        <div class="form-group col-md-3 <?= isset($employeeErrors['weight']) ? 'has-error' : '' ?>">
                          <label for="weight">Weight</label>
                          <div class="input-group date">
                            <?= $this->Form->control('EmployeeInformation.weight', [
                              'class' => 'form-control',
                              'id' => 'weight',
                              'label' => false,
                              'value' => $employee->weight
                            ]); ?>
                            <div class="input-group-addon">
                              kg
                            </div>
                            <span class="help-block"><?= $this->Error->first(isset($employeeErrors['weight']) ? $employeeErrors['weight'] : null) ?></span>
                          </div>
                        </div>
                        <div class="form-group col-md-3 <?= isset($employeeErrors['civil_status']) ? 'has-error' : '' ?>">
                            <label for="civil_status">Civil Status</label>
                            <?= $this->Form->control('EmployeeInformation.civil_status', [
                              'empty' => '---',
                              'class' => 'form-control',
                              'id' => 'civil_status',
                              'label' => false,
                              'options' => $civilStatus,
                              'type' => 'select',
                              'value' => $employee->civil_status
                          ]); ?>
                          <span class="help-block"><?= $this->Error->first(isset($employeeErrors['civil_status']) ? $employeeErrors['civil_status'] : null) ?></span>
                        </div>
                        <div class="form-group col-md-3 <?= isset($employeeErrors['civil_status_others']) ? 'has-error' : '' ?>">
                          <label id="lblCivilStatusOthers" style="display:none">Others</label>
                          <?= $this->Form->control('EmployeeInformation.civil_status_others', [
                            'class' => 'form-control',
                            'id' => 'civil_status_others',
                            'label' => false,
                            'type' => 'hidden'
                          ]); ?>
                          <span class="help-block"><?= $this->Error->first(isset($employeeErrors['civil_status_others']) ? $employeeErrors['civil_status_others'] : null) ?></span>
                        </div>
                      </div>
                      <div class="form-group col-md-12">
                        <div class="form-group col-md-3 <?= isset($employeeErrors['gsis_id_no']) ? 'has-error' : '' ?>">
                          <label for="gsis_id_no">GSIS ID No.</label>
                          <?= $this->Form->control('EmployeeInformation.gsis_id_no', [
                            'class' => 'form-control',
                            'id' => 'gsis_id_no',
                            'label' => false,
                            'value' => $employee->gsis_id_no
                          ]); ?>
                          <span class="help-block"><?= $this->Error->first(isset($employeeErrors['gsis_id_no']) ? $employeeErrors['gsis_id_no'] : null) ?></span>
                        </div>
                        <div class="form-group col-md-3 <?= isset($employeeErrors['pagibig_id_no']) ? 'has-error' : '' ?>">
                          <label for="blood_type">PAGIBIG ID No.</label>
                          <?= $this->Form->control('EmployeeInformation.pagibig_id_no', [
                            'class' => 'form-control',
                            'id' => 'pagibig_id_no',
                            'label' => false,
                            'value' => $employee->pagibig_id_no
                          ]); ?>
                          <span class="help-block"><?= $this->Error->first(isset($employeeErrors['pagibig_id_no']) ? $employeeErrors['pagibig_id_no'] : null) ?></span>
                        </div>
                        <div class="form-group col-md-3 <?= isset($employeeErrors['philhealth_no']) ? 'has-error' : '' ?>">
                          <label for="blood_type">Philhealth No.</label>
                          <?= $this->Form->control('EmployeeInformation.philhealth_no', [
                            'class' => 'form-control',
                            'id' => 'philhealth_no',
                            'label' => false,
                            'value' => $employee->philhealth_no
                          ]); ?>
                          <span class="help-block"><?= $this->Error->first(isset($employeeErrors['philhealth_no']) ? $employeeErrors['philhealth_no'] : null) ?></span>
                        </div>
                        <div class="form-group col-md-3 <?= isset($employeeErrors['sss_no']) ? 'has-error' : '' ?>">
                          <label for="sss_no">SSS No.</label>
                          <?= $this->Form->control('EmployeeInformation.sss_no', [
                            'class' => 'form-control',
                            'id' => 'sss_no',
                            'label' => false,
                            'value' => $employee->sss_no
                          ]); ?>
                          <span class="help-block"><?= $this->Error->first(isset($employeeErrors['sss_no']) ? $employeeErrors['sss_no'] : null) ?></span>
                        </div>
                      </div>
                      <div class="form-group col-md-12">
                        <div class="form-group col-md-3 <?= isset($employeeErrors['tin_no']) ? 'has-error' : '' ?>">
                          <label for="tin_no">TIN No.</label>
                          <?= $this->Form->control('EmployeeInformation.tin_no', [
                            'class' => 'form-control',
                            'id' => 'tin_no',
                            'label' => false,
                            'value' => $employee->tin_no
                          ]); ?>
                          <span class="help-block"><?= $this->Error->first(isset($employeeErrors['agency_employee_no']) ? $employeeErrors['agency_employee_no'] : null) ?></span>
                        </div>
                        <div class="form-group col-md-3 <?= isset($employeeErrors['civil_status']) ? 'has-error' : '' ?>">
                            <label for="citizenship">Citizenship</label>
                            <?= $this->Form->control('EmployeeInformation.citizenship', [
                              'empty' => '---',
                              'class' => 'form-control',
                              'id' => 'citizenship',
                              'label' => false,
                              'options' => $citizenship,
                              'type' => 'select',
                              'value' => $employee->citizenship
                            ]); ?>
                          <span class="help-block"><?= $this->Error->first(isset($employeeErrors['citizenship']) ? $employeeErrors['citizenship'] : null) ?></span>
                        </div>
                        <div class="form-group col-md-3 <?= isset($employeeErrors['citizenship_dual']) ? 'has-error' : '' ?>">
                          <label id="lblCitizenshipDual" style="display:none">Citizenship Dual Type</label>
                            <?= $this->Form->control('EmployeeInformation.citizenship_dual', [
                              'empty' => '---',
                              'class' => 'form-control',
                              'id' => 'citizenship_dual',
                              'label' => false,
                              'options' => $citizenshipDual,
                              'type' => 'select',
                              'style' => 'display:none',
                              'value' => $employee->citizenship_dual
                            ]); ?>
                          <span class="help-block"><?= $this->Error->first(isset($employeeErrors['citizenship_dual']) ? $employeeErrors['citizenship_dual'] : null) ?></span>
                        </div>
                        <div class="form-group col-md-3 <?= isset($employeeErrors['citizenship_country']) ? 'has-error' : '' ?>">
                          <label id="lblCitizenshipCountry" style="display:none">Pls. indicate country</label>
                            <?= $this->Form->control('EmployeeInformation.citizenship_country', [
                              'empty' => '---',
                              'class' => 'form-control',
                              'id' => 'citizenship_country',
                              'label' => false,
                              'options' => $citizenshipCountry,
                              'type' => 'select',
                              'style' => 'display:none',
                              'value' => $employee->citizenship_country
                            ]); ?>
                          <span class="help-block"><?= $this->Error->first(isset($employeeErrors['citizenship_country']) ? $employeeErrors['citizenship_country'] : null) ?></span>
                        </div>
                      </div>
                      <div class="form-group col-md-12">
                        <div class="form-group col-md-3 <?= isset($employeeErrors['agency_employee_no']) ? 'has-error' : '' ?>">
                          <label for="agency_employee_no">Agency Employee No.</label>
                          <?= $this->Form->control('EmployeeInformation.agency_employee_no', [
                            'class' => 'form-control',
                            'id' => 'agency_employee_no',
                            'label' => false,
                            'value' => $employee->agency_employee_no
                          ]); ?>
                          <span class="help-block"><?= $this->Error->first(isset($employeeErrors['agency_employee_no']) ? $employeeErrors['agency_employee_no'] : null) ?></span>
                        </div>
                        <div class="form-group col-md-3 <?= isset($employeeErrors['telephone_no']) ? 'has-error' : '' ?>">
                          <label for="telephone_no">Telephone No.</label>
                          <?= $this->Form->control('EmployeeInformation.telephone_no', [
                            'class' => 'form-control',
                            'id' => 'telephone_no',
                            'label' => false,
                            'value' => $employee->telephone_no
                          ]); ?>
                          <span class="help-block"><?= $this->Error->first(isset($employeeErrors['telephone_no']) ? $employeeErrors['telephone_no'] : null) ?></span>
                        </div>
                        <div class="form-group col-md-3 <?= isset($employeeErrors['mobile_no']) ? 'has-error' : '' ?>">
                          <label for="mobile_no">Mobile No.</label>
                          <?= $this->Form->control('EmployeeInformation.mobile_no', [
                            'class' => 'form-control',
                            'id' => 'mobile_no',
                            'label' => false,
                            'value' => $employee->mobile_no
                          ]); ?>
                          <span class="help-block"><?= $this->Error->first(isset($employeeErrors['mobile_no']) ? $employeeErrors['mobile_no'] : null) ?></span>
                        </div>
                        <div class="form-group col-md-3 <?= isset($employeeErrors['email']) ? 'has-error' : '' ?>">
                          <label for="email">Email Address (if any)</label>
                          <?= $this->Form->control('EmployeeInformation.email', [
                            'class' => 'form-control',
                            'id' => 'email',
                            'label' => false,
                            'type' => 'email',
                            'value' => $employee->email
                          ]); ?>
                          <span class="help-block"><?= $this->Error->first(isset($employeeErrors['email']) ? $employeeErrors['email'] : null) ?></span>
                        </div>
                      </div>
                      <div class="form-group col-md-12">
                        <div class="form-group col-md-9 <?= isset($employeeErrors['residential_address']) ? 'has-error' : '' ?>">
                          <label for="residential_address">Residential Address</label>
                          <?= $this->Form->control('EmployeeInformation.residential_address', [
                            'class' => 'form-control',
                            'id' => 'residential_address',
                            'label' => false,
                            'value' => $employee->residential_address
                          ]); ?>
                          <span class="help-block"><?= $this->Error->first(isset($employeeErrors['residential_address']) ? $employeeErrors['residential_address'] : null) ?></span>
                        </div>
                        <div class="form-group col-md-3 <?= isset($employeeErrors['residential_zipcode']) ? 'has-error' : '' ?>">
                          <label for="residential_zipcode">Zip Code</label>
                          <?= $this->Form->control('EmployeeInformation.residential_zipcode', [
                            'class' => 'form-control',
                            'id' => 'residential_zipcode',
                            'label' => false,
                            'value' => $employee->residential_zipcode
                          ]); ?>
                          <span class="help-block"><?= $this->Error->first(isset($employeeErrors['residential_zipcode']) ? $employeeErrors['residential_zipcode'] : null) ?></span>
                        </div>
                      </div>
                      <div class="form-group col-md-12">
                        <div class="form-group col-md-9 <?= isset($employeeErrors['permanent_address']) ? 'has-error' : '' ?>">
                          <label for="permanent_address">Permanent Address</label>
                          <?= $this->Form->control('EmployeeInformation.permanent_address', [
                            'class' => 'form-control',
                            'id' => 'permanent_address',
                            'label' => false,
                            'value' => $employee->permanent_address
                          ]); ?>
                          <span class="help-block"><?= $this->Error->first(isset($employeeErrors['permanent_address']) ? $employeeErrors['permanent_address'] : null) ?></span>
                        </div>
                        <div class="form-group col-md-3 <?= isset($employeeErrors['permanent_zipcode']) ? 'has-error' : '' ?>">
                          <label for="permanent_zipcode">Zip Code</label>
                          <?= $this->Form->control('EmployeeInformation.permanent_zipcode', [
                            'class' => 'form-control',
                            'id' => 'permanent_zipcode',
                            'label' => false,
                            'value' => $employee->permanent_zipcode
                          ]); ?>
                          <span class="help-block"><?= $this->Error->first(isset($employeeErrors['permanent_zipcode']) ? $employeeErrors['permanent_zipcode'] : null) ?></span>
                        </div>
                      </div>
                      <!-- <div class="col-md-12">
                        <h2 class="page-header">
                          Family Background
                        </h2>
                      </div> -->
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                  <!-- <div class="tab-pane" id="tab_2">
                    The European languages are members of the same family. Their separate existence is a myth.
                    For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                    in their grammar, their pronunciation and their most common words. Everyone realizes why a
                    new common language would be desirable: one could refuse to pay expensive translators. To
                    achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                    words. If several languages coalesce, the grammar of the resulting language is more simple
                    and regular than that of the individual languages.
                  </div> -->
                  <!-- /.tab-pane -->
                  <!-- <div class="tab-pane" id="tab_3">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                    when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                    It has survived not only five centuries, but also the leap into electronic typesetting,
                    remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                    sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                    like Aldus PageMaker including versions of Lorem Ipsum.
                  </div> -->
                  <!-- /.tab-pane -->
                  <!-- <div class="tab-pane" id="tab_4">
                    Tab 4444444
                  </div> -->
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div>
              <!-- nav-tabs-custom -->
              <div class="box-footer-tab">
                <button type="button" class="btn btn-default" onclick="return Common.clearFormAll()">Clear</button>
                <button type="submit" class="btn btn-primary pull-right">Submit</button>
              </div>
          <?= $this->Form->end() ?>
        </div>
      </div>
    </div>
  </section>
</div>
