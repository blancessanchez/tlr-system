<?php $this->assign('title', 'Home'); ?> 
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Home
    </h1>
    <ol class="breadcrumb">
      <li class="active">Home</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <?= $this->Flash->render(); ?>
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Employee List</h3>
          </div>
          <div class="box-body">
            <table id="employee_list" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Employee Number</th>
                <th>Name</th>
                <th>Job Position</th>
                <th>Status</th>
                <!-- <th>Action</th> -->
              </tr>
              </thead>
              <tbody>
                <?php foreach ($employees as $employee) : ?>
                  <tr>
                    <td><?= h($employee->employee_no) ?></td>
                    <td>
                      <?= h($employee->last_name . ', ' .
                            $employee->first_name . ' ' .
                            $employee->middle_name) ?>
                    </td>
                    <td><?= h($employee->job_position->title) ?></td>
                    <td><?= $employeeStatus[$employee->status] ?></td>
                    <td>
                      <!-- <button type="button" class="btn btn-default"><i class="fa fa-eye"></i></button>
                      <button type="button" class="btn btn-default"><i class="fa fa-pencil"></i></button>
                      <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button> -->
                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
  