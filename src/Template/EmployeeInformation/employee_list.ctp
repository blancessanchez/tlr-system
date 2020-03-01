<?php $this->assign('title', 'Employees List'); ?> 
<div class="content-wrapper">
  <section class="content-header">
    <br>
    <ol class="breadcrumb">
      <li>
        <a href="<?= $this->Url->build([
          'controller' => 'EmployeeInformation',
          'action' => 'home'
        ]);
        ?>"><i class="fa fa-dashboard"></i> Home</a>
      </li>
      <li class="active">Employees List</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <?= $this->Flash->render(); ?>
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Employees List</h3>
          </div>
          <div class="box-body">
            <table id="table_data" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Employee Number</th>
                <th>Name</th>
                <th>Job Position</th>
                <th>Status</th>
                <th>Action</th>
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
                      <a href="/employees/edit/<?= $employee->id?>" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                      <a href="/employees/view/<?= $employee->id?>" class="btn btn-default"><i class="fa fa-eye"></i></a>
                      <?= 
                        $this->Form->postLink(
                          '<button class="btn btn-danger">
                              <i class="fa fa-trash"></i>
                          </button>',
                          [
                            'controllers' => 'EmployeeInformation',
                            'action' => 'delete', $employee->id
                          ],
                          [
                            'escape' => false,
                            'confirm' => 'Are you sure you want to delete record?'
                          ]
                        );
                      ?>
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
