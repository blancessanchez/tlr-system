<?php $this->assign('title', 'Departments'); ?> 
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
      <li class="active">Departments</a></li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <?= $this->Flash->render(); ?>
        <button type="button" class="btn btn-primary btn-md" id="btn-add-department">
          Add Department
        </button><br><br>
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Departments</h3>
          </div>
          <div class="box-body">
            <table id="table_data" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Name</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                <?php foreach ($departments as $department) : ?>
                  <tr>
                    <td><?= h($department->name) ?></td>
                    <td class="actions">
                      <a href="/departments/edit/<?= $department->id?>" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                      <?= 
                        $this->Form->postLink(
                          '<button class="btn btn-danger">
                              <i class="fa fa-trash"></i>
                          </button>',
                          [
                            'controllers' => 'Departments',
                            'action' => 'delete', $department->id
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
