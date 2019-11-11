<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu" data-widget="tree">
  <li class="header">MAIN NAVIGATION</li>
  <?php if ($Auth->user('role_id') == $this->Configure->read('EMPLOYEES.ROLES.Principal')) : ?>
    <li><a href="/"><i class="fa fa-circle-o"></i>Home</a></li>
    <li><a href="/leaves"><i class="fa fa-circle-o"></i>Leaves List</a></li>   
    <li><a href="/leaves/apply"><i class="fa fa-circle-o"></i>Apply Leave</a></li>
  <?php elseif ($Auth->user('role_id') == $this->Configure->read('EMPLOYEES.ROLES.Admin')) : ?>
    <li><a href="/"><i class="fa fa-circle-o"></i>Home</a></li>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-circle-o"></i> <span>Employees</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
        <ul class="treeview-menu">
          <li><a href="/employees"><i class="fa fa-circle-o"></i>Employee List</a></li>
          <li><a href="/employees/add"><i class="fa fa-circle-o"></i>Add New Employee</a></li>
        </ul>
    </li>
    <li><a href="/leaves/apply"><i class="fa fa-circle-o"></i>Apply Leave</a></li>
  <?php else : ?>
    <li><a href="/"><i class="fa fa-circle-o"></i>Home</a></li>
    <li><a href="/leaves/apply"><i class="fa fa-circle-o"></i>Apply Leave</a></li>
  <!-- <li><a href="#"><i class="fa fa-circle-o"></i> <span>Apply</span></a></li>
  <li><a href="#"><i class="fa fa-circle-o"></i> <span>Past Applications</span></a></li>
  <li><a href="#"><i class="fa fa-circle-o"></i> <span>Activity Log</span></a></li> -->
  <?php endif ?>

</ul>