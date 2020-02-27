<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= __($systemName->value . ' | ' . $this->fetch('title')) ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- CSRF Token -->
  <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
  <?= $this->Html->css([
      'bootstrap/dist/css/bootstrap.min.css',
      'font-awesome/css/font-awesome.min.css',
      'ionicons/css/ionicons.min.css',
      'adminlte/AdminLTE.min.css',
      'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic'
    ]);
  ?>
</head>
<body class="hold-transition login-page">
  <?= $this->fetch('content') ?>

  <?= $this->Html->script([
      'jquery/jquery.min.js',
      'bootstrap/dist/js/bootstrap.min.js'
    ])
  ?>

<style>
  /* Chrome, Safari, Edge, Opera */
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  /* Firefox */
  input[type=number] {
    -moz-appearance:textfield;
  }
</style>
</body>
</html>
