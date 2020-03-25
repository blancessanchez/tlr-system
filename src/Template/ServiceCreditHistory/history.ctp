<?php $this->assign('title', 'Service Credit History'); ?> 
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
    <li>
      <a href="<?= $this->Url->build([
        'controller' => 'EmployeeInformation',
        'action' => 'employeeList'
      ]);
      ?>"><i class="fa fa-briefcase"></i> Employees List</a>
    </li>
    <li class="active">Edit Service Credit</a></li>
    <li class="active">Service Credit History</a></li>
  </ol>
  </section>

  <section class="content">
  <div class="row">
    <div class="col-md-12">
    <?= $this->Flash->render(); ?>
    <div class="box">
      <div class="box-header">
      <h3 class="box-title">Service Credit History</h3>
      </div>
      <div class="box-body">
      <table id="table_data" class="table table-bordered table-striped">
        <thead>
        <tr>
        <th>Id</th>
        <th>Description</th>
        <th>Current Balance</th>
        <th>Date</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($serviceCreditHistory as $historyLog) : ?>
          <tr>
          <td><?= h($historyLog->id) ?></td>
          <td><?= h($historyLog->description) ?></td>
          <td><?= h($historyLog->current_balance) ?></td>
          <td><?= date('Y-m-d H:i:s', strtotime($historyLog->created)) ?></td>
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
