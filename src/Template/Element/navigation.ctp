<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu" data-widget="tree">
  <li class="header">MAIN NAVIGATION</li>
  <li>
    <?= $this->Html->link(
      $this->Html->tag('i', '', ['class' => 'fa fa-circle-o']) . 
      'Home', [
        'controller' => 'EmployeeInformation',
        'action' => 'home'
      ],
      ['escape' => false]
    ); ?>
  </li>
  <?php if ($Auth->user('role_id') == $this->Configure->read('EMPLOYEES.ROLES.Principal')) : ?>
    <li>
      <?= $this->Html->link(
        $this->Html->tag('i', '', ['class' => 'fa fa-circle-o']) .
        'Leaves List', [
          'controller' => 'LeaveApplications',
          'action' => 'index'
        ],
        ['escape' => false]
      ); ?>
    </li>
  <?php elseif ($Auth->user('role_id') == $this->Configure->read('EMPLOYEES.ROLES.Admin')) : ?>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-circle-o"></i> <span>Employees</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
        <ul class="treeview-menu">
          <li>
            <?= $this->Html->link(
              $this->Html->tag('i', '', ['class' => 'fa fa-circle-o']) . 
              'Employee List', [
                'controller' => 'EmployeeInformation',
                'action' => 'employeeList'
              ],
              ['escape' => false]
            ); ?>
          </li>
          <li>
            <?= $this->Html->link(
              $this->Html->tag('i', '', ['class' => 'fa fa-circle-o']) . 
              'Add New Employee', [
                'controller' => 'EmployeeInformation',
                'action' => 'add'
              ],
              ['escape' => false]
            ); ?>
          </li>
        </ul>
    </li>
  <!-- <li><a href="#"><i class="fa fa-circle-o"></i> <span>Apply</span></a></li>
  <li><a href="#"><i class="fa fa-circle-o"></i> <span>Past Applications</span></a></li>
  <li><a href="#"><i class="fa fa-circle-o"></i> <span>Activity Log</span></a></li> -->
  <?php endif ?>
  <li>
    <?= $this->Html->link(
      $this->Html->tag('i', '', ['class' => 'fa fa-circle-o']) . 
      'Apply Leave', [
        'controller' => 'LeaveApplications',
        'action' => 'add'
      ],
      ['escape' => false]
    ); ?>
  </li>
</ul>
