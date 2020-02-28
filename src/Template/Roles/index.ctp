<?php $this->assign('title', 'Role'); ?> 
<div class="content-wrapper">
  <section class="content-header">
    <br>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
      <li><a href="#">Role</a></li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <?= $this->Flash->render(); ?>
        <button type="button" class="btn btn-primary btn-md" id="btn-add-role">
          Add Role
        </button><br><br>
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Roles</h3>
          </div>
          <div class="box-body">
            <table id="table_data" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Title</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                <?php foreach ($roles as $r) : ?>
                  <tr>
                    <td><?= h($r->title) ?></td>
                    <td class="actions">
                      <a href="/roles/edit/<?= $r->id?>" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                      <?= 
                        $this->Form->postLink(
                          '<button class="btn btn-danger">
                              <i class="fa fa-trash"></i>
                          </button>',
                          [
                            'controllers' => 'Roles',
                            'action' => 'delete', $r->id
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
