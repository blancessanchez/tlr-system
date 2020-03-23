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
  <?php if ($Auth->user('role_id') == $this->Configure->read('EMPLOYEES.ROLES.Principal') ||
    $Auth->user('role_id') == $this->Configure->read('EMPLOYEES.ROLES.HeadTeacher')) : ?>
    <li>
      <?= $this->Html->link(
        $this->Html->tag('i', '', ['class' => 'fa fa-circle-o']) .
        'Leaves List', [
          'controller' => 'Leaves',
          'action' => 'index'
        ],
        ['escape' => false]
      ); ?>
    </li>
    <li>
      <?= $this->Html->link(
        $this->Html->tag('i', '', ['class' => 'fa fa-circle-o']) .
        'Activity Logs', [
          'controller' => 'ActivityLogs',
          'action' => 'index'
        ],
        ['escape' => false]
      ); ?>
    </li>
  <?php elseif ($Auth->user('role_id') == $this->Configure->read('EMPLOYEES.ROLES.Admin')) : ?>
    <li>
      <?= $this->Html->link(
        $this->Html->tag('i', '', ['class' => 'fa fa-circle-o']) . 
        'Apply Leave', [
          'controller' => 'Leaves',
          'action' => 'add'
        ],
        ['escape' => false]
      ); ?>
    </li>
    <li>
      <?= $this->Html->link(
        $this->Html->tag('i', '', ['class' => 'fa fa-circle-o']) .
        'Leaves List', [
          'controller' => 'Leaves',
          'action' => 'index'
        ],
        ['escape' => false]
      ); ?>
    </li>
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
    <li class="treeview">
      <a href="#">
        <i class="fa fa-circle-o"></i> <span>Settings</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
        <ul class="treeview-menu">
          <li>
          <?= $this->Html->link(
            $this->Html->tag('i', '', ['class' => 'fa fa-circle-o']) . 
            'System Name', [
              'controller' => 'Configurations',
              'action' => 'edit'
            ],
            ['escape' => false]
          ); ?>
          </li>
          <li>
            <?= $this->Html->link(
              $this->Html->tag('i', '', ['class' => 'fa fa-circle-o']) . 
              'Job Positions', [
                'controller' => 'JobPositions',
                'action' => 'index'
              ],
              ['escape' => false]
            ); ?>
          </li>
          <li>
            <?= $this->Html->link(
              $this->Html->tag('i', '', ['class' => 'fa fa-circle-o']) . 
              'Departments', [
                'controller' => 'Departments',
                'action' => 'index'
              ],
              ['escape' => false]
            ); ?>
          </li>
        </ul>
    </li>
  <?php else : ?>
    <li>
      <?= $this->Html->link(
        $this->Html->tag('i', '', ['class' => 'fa fa-circle-o']) . 
        'Apply Leave', [
          'controller' => 'Leaves',
          'action' => 'add'
        ],
        ['escape' => false]
      ); ?>
    </li>
  <?php endif ?>
</ul>
