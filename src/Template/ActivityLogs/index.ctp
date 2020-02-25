<?php $this->assign('title', 'Activity Log'); ?> 
<div class="content-wrapper">
  <section class="content-header">
    <br>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Activity Logs</a></li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <?= $this->Flash->render(); ?>
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Activity Logs</h3>
          </div>
          <div class="box-body">
            <table id="table_data" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Id</th>
                <th>Employee Name</th>
                <th>Activity</th>
              </tr>
              </thead>
              <tbody>
                <?php foreach ($activityLogs as $log) : ?>
                  <tr>
                    <td><?= h($log->id) ?></td>
                    <td>
                      <?= h($log->employee_information->last_name . ', ' .
                        $log->employee_information->first_name . ' ' .
                        $log->employee_information->middle_name) ?>
                    </td>
                    <td><?= h($log->description) ?></td>
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