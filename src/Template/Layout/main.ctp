<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= __($systemName->value . ' | ' . $this->fetch('title')) ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?= $this->Html->css([
      'adminlte/skins/_all-skins.min.css',
      'bootstrap/dist/css/bootstrap.min.css',
      'bootstrap-datepicker/css/bootstrap-datepicker.min.css',
      'bootstrap-daterangepicker/daterangepicker.css',
      'font-awesome/css/font-awesome.min.css',
      'ionicons/css/ionicons.min.css',
      'adminlte/AdminLTE.min.css',
      'bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
      'datatables.net-bs/css/dataTables.bootstrap.min.css',
      'main.css',
      'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic'
    ]);
  ?>
  <?= $this->Html->script(['jquery/jquery.min.js']); ?>
</head>
<body class="hold-transition skin-green sidebar-mini">
 <div class="wrapper">
    <header class="main-header">
      <a href="/home" class="logo">
        <span class="logo-mini">TLR</span>
        <span class="logo-lg"><?= $systemName->value ?></span>
      </a>
      <nav class="navbar navbar-static-top">
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="hidden-xs"><?= $Auth->user('last_name') . ', ' . $Auth->user('first_name') ?></span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-header">
                  <p>
                    <?= $Auth->user('last_name') . ', ' . $Auth->user('first_name') ?>
                  </p>
                </li>
                <li class="user-footer">
                  <div class="pull-left">
                    <!-- <a href="#" class="btn btn-default btn-flat">Profile</a> -->
                  </div>
                  <div class="pull-right">
                    <?= $this->Html->link(
                      'Log Out', [
                        'controller' => 'EmployeeInformation',
                        'action' => 'logout'
                      ],
                      ['class' => 'btn btn-default btn-flat']
                    ); ?>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <aside class="main-sidebar">
      <section class="sidebar">
        <div class="user-panel">
          <div class="pull-left image">
            <?= $this->Html->image('avatar.png', ['class' => 'img-circle']) ?>
          </div>
          <div class="pull-left info">
            <p><?= $Auth->user('last_name') . ', ' . $Auth->user('first_name') ?></p>
          </div>
        </div>
        <?= $this->element('navigation') ?>
      </section>
    </aside>

    <?= $this->fetch('content') ?>

    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0.0
      </div>
      <strong>Copyright &copy; 2019 <a href="#">PUP MIT</a>.</strong> All rights
      reserved.
    </footer>
  </div>

  <?= $this->Html->script([
      'jquery/jquery-ui/jquery-ui.min.js',
      'bootstrap/dist/js/bootstrap.min.js',
      'bootstrap-daterangepicker/daterangepicker.js',
      'bootstrap-datepicker/js/bootstrap-datepicker.min.js',
      'bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
      'jquery/jquery-slimscroll/jquery.slimscroll.min.js',
      'fastclick/lib/fastclick.js',
      'adminlte/adminlte.min.js',
      'adminlte/pages/dashboard.js',
      'adminlte/demo.js',
      'datatables.net/js/jquery.dataTables.min.js',
      'datatables.net-bs/js/dataTables.bootstrap.min.js',
      'moment/moment.min.js',
      'jquery/jquery-knob/jquery.knob.min.js',
      'main.js'
    ])
  ?>
</body>
</html>
