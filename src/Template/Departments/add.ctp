<?php $this->assign('title', 'Departments'); ?>
<div class="content-wrapper">
  <section class="content-header">
	<h1></h1><br>
	<ol class="breadcrumb">
	  <li>
		<a href="<?= $this->Url->build([
		  'controller' => 'EmployeeInformation',
		  'action' => 'home'
		]);
		?>"><i class="fa fa-dashboard"></i> Home</a>
	  </li>
	  <li><a href="<?= $this->Url->build([
		  'controller' => 'Departments',
		  'action' => 'index'
		]);
	  ?>"><i class="fa fa-briefcase"></i>
		Departments List</a>
	  </li>
	  <li class="active">Add Department</a></li>
	</ol>
  </section>

  <!-- Main content -->
  <section class="content">
	<div class="row">
	  <div class="col-md-12">
		<?= $this->Flash->render(); ?>
		<div class="box box-primary">
			<?= $this->Form->create('Departments', [
			  'url' => [
				'controller' => 'Departments',
				'action' => 'add'
			  ]
			]) ?>
			<div class="box-body">
			  <div class="col-md-12">
				<h2 class="page-header">
				  <i class="fa fa-cog"></i> Department
				</h2>
			  </div>
			  <div class="col-md-12">
				<div class="form-group col-md-12 <?= isset($departmentErrors['name']) ? 'has-error' : '' ?>">
				  <label for="value">Department Name <span style="color:red">*</span></label>
				  <?= $this->Form->control('Departments.name', [
					'class' => 'form-control',
					'id' => 'value',
					'label' => false
				  ]); ?>
				  <span class="help-block"><?= $this->Error->first(isset($departmentErrors['name']) ? $departmentErrors['name'] : null) ?></span>
				</div>
			  </div>
			</div>
			<div class="box-footer">
			  <button type="button" class="btn btn-default" onclick="return Common.clearFormAll()">Clear</button>
			  <button type="submit" class="btn btn-primary pull-right">Submit</button>
			</div>
		  <?= $this->Form->end() ?>
		</div>
	  </div>
	</div>
  </section>
</div>
