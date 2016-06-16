<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <title>Casas Habitat</title>

  <meta charset="utf-8">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width">

  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,400,600,700">
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,300,700">
  <link rel="stylesheet" href="<?= base_url('../css/font-awesome.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('../js/libs/css/ui-lightness/jquery-ui-1.9.2.custom.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('../css/bootstrap.min.css') ?>">

    <!-- App CSS -->
  <link rel="stylesheet" href="<?= base_url('../css/target-admin.css') ?>">
  <link rel="stylesheet" href="<?= base_url('../css/custom.css') ?>">


  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->
</head>

<body class="account-bg">

<div class="account-wrapper">

    <div class="account-body">

      <h3 class="account-body-title">Bienvenido.</h3>

      <h5 class="account-body-subtitle">Ingresa tus datos para accesar.</h5>
      <?= $this->load->view($contenido) ?>

    </div> <!-- /.account-body -->

  </div> <!-- /.account-wrapper -->



        

  <script src="<?= base_url('../js/libs/jquery-1.10.1.min.js') ?>"></script>
  <script src="<?= base_url('../js/libs/jquery-ui-1.9.2.custom.min.js') ?>"></script>
  <script src="<?= base_url('../js/libs/bootstrap.min.js') ?>"></script>

  <!--[if lt IE 9]>
  <script src="./js/libs/excanvas.compiled.js"></script>
  <![endif]-->
  <!-- App JS -->
  <script src="<?= base_url('../js/target-admin.js') ?>"></script>
  
  <!-- Plugin JS -->
  <script src="<?= base_url('../js/target-account.js') ?>"></script>

  


  

</body>
</html>
