<?php $this->assign('title', 'Home'); ?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Home
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <?= $this->Flash->render() ?>
        <div class="callout callout-info" style="margin-bottom: 0!important;">
          <ul class="margin-bottom-none padding-left-lg">
            <li><b>Term Description:</b> <?= !empty($currentTerm->description) ? $currentTerm->description : '' ?></li>
            <li><b>Academic Year:</b> <?= !empty($currentTerm->academic_year) ? $currentTerm->academic_year : '' ?></li>
          </ul>
        </div><br>
        <?php if ($isAdmin) : ?>
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#confirmModal">
            Start New Term
          </button><br><br>

          <!-- Modal -->
          <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Confirm Action</h4>
                </div>
                <div class="modal-body">
                  <div class="box box-solid">
                    <div class="box-header with-border">
                      <h3 class="box-title">Starting a new term will result in the following:</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <ul>
                        <li>Unused leaves will no longer be credited</li>
                        <li>Leave balances will be replenished</li>
                      </ul>
                    </div>
                    <!-- /.box-body -->
                  </div>
                  Do you wish to continue?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                  <button type="button" class="btn btn-primary" data-dismiss="modal" id="btn-confirm">Yes</button>
                </div>
              </div>
            </div>
          </div>
          <!-- Modal -->
          <div class="modal fade" id="inputModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Enter New Term Details</h4>
                </div>
                <div class="modal-body">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="description">Description</label>
                      <input class="form-control" id="description" placeholder="School year 2019-2020">
                    </div>
                    <div class="form-group">
                      <label for="academicYear">Academic Year</label>
                      <input class="form-control" id="academicYear" placeholder="2019-2020">
                    </div>
                    <!-- <div class="form-group">
                      <label for="password">Your Password (for security purposes)</label>
                      <input class="form-control" id="password" type="password" placeholder="Password">
                    </div>
                    <p class="text-red" id="inputError"></p> -->
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" id="btn-submit">Submit</button>
                </div>
              </div>
            </div>
          </div>
        <?php endif; ?>
        <h3>Remaining Leaves</h3>
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
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">My Leave Applications</h3>
              </div>
              <div class="box-body">
                <table id="leaves_list" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Application ID</th>
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
                          <?php if ($leaveApplication->leave_status == $this->Configure->read('LEAVES.STATUS.ForApproval')) : ?>
                            <a href="/leaves/edit/<?= $leaveApplication->id?>" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                            <!-- <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button> -->
                          <?php endif ?>
                        </td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    $('#btn-confirm').on('click', function() {
      $('#inputModal').modal('show');
    });

    $('#btn-submit').on('click', function() {
      $.ajax({
          type: 'POST',
          url: '/terms/add',
          data: {
            description: $('#description').val(),
            academic_year: $('#academicYear').val(),
            password: $('#password').val()
          },
          dataType: 'json',
          beforeSend: function (xhr) {
              xhr.setRequestHeader('X-CSRF-Token', <?= json_encode($this->request->getParam('_csrfToken')); ?>);
              $('#btn-submit').prop('disabled','disabled');
          }
      }).done(function(res) {
        if (res.status = true) {
          location.reload();
        }
      }).fail(function(res) {
        if (res.status == 422) {
          let mainResponse = $.parseJSON(res.responseText);
          $('#inputError').text(mainResponse.responseText)
          $('#btn-submit').removeAttr('disabled');
        }
      });
    });
  });
</script>