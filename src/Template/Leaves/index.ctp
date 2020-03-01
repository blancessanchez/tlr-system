<?php $this->assign('title', 'Home'); ?> 
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Leaves List
    </h1>
    <ol class="breadcrumb">
      <li>
        <a href="<?= $this->Url->build([
          'controller' => 'EmployeeInformation',
          'action' => 'home'
        ]);
        ?>"><i class="fa fa-dashboard"></i> Home</a>
      </li>
      <li class="active">Leaves List</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <?= $this->Flash->render(); ?>
        <button type="button" class="btn btn-primary btn-md" id="btn-generate-report">
          Generate Report
        </button><br><br>
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Recent Applications</h3>
          </div>
          <div class="box-body">
            <table id="table_data" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Application ID</th>
                  <th>Employee Name</th>
                  <th>Application Type</th>
                  <th>Overview Date</th>
                  <th>Status</th>
                  <th class="actions"><?= __('Actions') ?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($leaveApplications as $leaveApplication) : ?>
                  <tr>
                    <td><?= $leaveApplication->id ?></td>
                    <td><?= h($leaveApplication->employee_information->last_name . ', ' .
                            $leaveApplication->employee_information->first_name . ' ' . 
                            $leaveApplication->employee_information->middle_name) ?></td>
                    <td><?= $leaveTypes[$leaveApplication->leave_type_id] ?></td>
                    <td><?= $leaveApplication->leave_from . ' - ' . $leaveApplication->leave_to ?></td>
                    <td>
                      <?php if ($leaveApplication->leave_status == $this->Configure->read('LEAVES.STATUS.ForApproval')) : ?>
                        <span class="badge bg-white">For Approval</span>
                      <?php elseif ($leaveApplication->leave_status == $this->Configure->read('LEAVES.STATUS.Approved')) :?>
                        <span class="badge bg-green">Approved</span>
                      <?php elseif ($leaveApplication->leave_status == $this->Configure->read('LEAVES.STATUS.Cancelled')) :?>
                        <span class="badge bg-yellow">Cancelled</span>
                      <?php elseif ($leaveApplication->leave_status == $this->Configure->read('LEAVES.STATUS.Disapproved')) :?>
                        <span class="badge bg-red">Disapproved</span>
                      <?php endif; ?>
                    </td>
                    <td class="actions">
                      <a href="/leaves/view/<?= $leaveApplication->id?>" class="btn btn-default"><i class="fa fa-eye"></i></a>
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
