<?php $this->assign('title', 'Login'); ?>
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><?= $this->Configure->read('system_name') ?></a>
  </div>
  <?= $this->Flash->render() ?>
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
      <?= $this->Form->create('EmployeeInformation', [
          'class' => 'form',
          'autocomplete' => 'off',
          'novalidate' => true
        ]);
      ?>
      <div class="form-group has-feedback">
        <?= $this->Form->control('employee_no', [
            'label' => false,
            'type' => 'text',
            'required' => false,
            'div' => false,
            'placeholder' => 'Employee Number',
            'class' => 'form-control'
          ]);
        ?>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <?= $this->Form->control('password', array(
            'label' => false,
            'type' => 'password',
            'required' => false,
            'div' => false,
            'placeholder' => 'Password',
            'class' => 'form-control'
          ));
        ?>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>
    <?= $this->Form->end() ?><br>
    <!-- <a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a> -->
  </div>
</div>
