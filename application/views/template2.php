<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<html ng-app="myApp">
<head>
  <title>Casas Habitat</title>

  <meta charset="utf-8">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width">
  <link rel='shortcut icon' href="<?= base_url('../img/casa.png') ?>" type='image/png' />

  <!--<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,400,600,700">
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,300,700">-->
  <link rel="stylesheet" href="<?= base_url('../css/google/google_1.css') ?>">
  <link rel="stylesheet" href="<?= base_url('../css/google/google_2.css') ?>">
  <link rel="stylesheet" href="<?= base_url('../css/font-awesome.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('../js/libs/css/ui-lightness/jquery-ui-1.9.2.custom.min.css') ?>">
  <link href="<?= base_url('../css/bootstrap.min.css') ?>" rel="stylesheet" media="screen">

  <link rel="stylesheet" href="<?= base_url('../js/plugins/timepicker/bootstrap-timepicker.css') ?>">

    <!-- App CSS -->
  <link rel="stylesheet" href="<?= base_url('../css/target-admin.css') ?>">
  <link rel="stylesheet" href="<?= base_url('../css/custom.css') ?>">

  <link rel="stylesheet" href="<?= base_url('../js/plugins/icheck/skins/minimal/blue.css') ?>">

  <link rel="stylesheet" href="<?= base_url('../js/libs/css/ui-lightness/jquery-ui-1.9.2.custom.css') ?>">
  <link rel="stylesheet" href="<?= base_url('../js/plugins/magnific/magnific-popup.css') ?>">
  <link rel="stylesheet" href="<?= base_url('../css/demos/ui-notifications.css') ?>">


  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->
</head>

<body>

  <div class="navbar">

  <div class="container">

    <div class="navbar-header">

      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <i class="fa fa-cogs"></i>
      </button>

      <a class="navbar-brand navbar-brand-image" href="<?= base_url('home/index')?>">
        <img src="<?= base_url('../img/logo_final.png') ?>" alt="Casas Habitat" class="img-responsive">
      </a>

    </div> <!-- /.navbar-header -->

    <div class="navbar-collapse collapse">

      
      <ul class="nav navbar-nav noticebar navbar-left">

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-bell"></i>
            <span class="navbar-visible-collapsed">&nbsp;Notifications&nbsp;</span>
            <span class="badge">2</span>
          </a>

          <ul class="dropdown-menu noticebar-menu" role="menu">
            <li class="nav-header">
              <div class="pull-left">
                Notificaciones
              </div>

              <div class="pull-right">
                <a href="javascript:;">Marcar como leidas</a>
              </div>
            </li>

            <li>
              <a href="#" class="noticebar-item">
                <span class="noticebar-item-image">
                  <i class="fa fa-cloud-upload text-success"></i>
                </span>
                <span class="noticebar-item-body">
                  <strong class="noticebar-item-title">Nueva Casa</strong>
                  <span class="noticebar-item-text">El usuario Jonathan ha dado de alta la casa JA-101.</span>
                  <span class="noticebar-item-time"><i class="fa fa-clock-o"></i> Hace 1 día</span>
                </span>
              </a>
            </li>

            <li>
              <a href="#" class="noticebar-item">
                <span class="noticebar-item-image">
                  <i class="fa fa-ban text-danger"></i>
                </span>
                <span class="noticebar-item-body">
                  <strong class="noticebar-item-title">Retraso en trámite</strong>
                  <span class="noticebar-item-text">La casa NS-105 tiene un retraso en su tramite de CLG.</span>
                  <span class="noticebar-item-time"><i class="fa fa-clock-o"></i> Hace 2 días</span>
                </span>
              </a>
            </li>

            <li class="noticebar-menu-view-all">
              <a href="#">Ver todas las notificaciones</a>
            </li>
          </ul>
        </li>

      </ul>

      <ul class="nav navbar-nav navbar-right">     

        <li class="dropdown navbar-profile">
          <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">
            <img src="<?= base_url('../img/avatars/profile.jpg') ?>" class="navbar-profile-avatar" alt="">
            <span class="navbar-profile-label">almarazjair@gmail.com &nbsp;</span>
            <i class="fa fa-caret-down"></i>
          </a>

          <ul class="dropdown-menu" role="menu">

            <li>
              <a href="<?= base_url("cuenta_usuario")?>">
                <i class="fa fa-cogs"></i> 
                &nbsp;&nbsp;Configuraciones
              </a>
            </li>

            <li class="divider"></li>

            <li>
              <a href="<?= base_url('home/salir') ?>">
                <i class="fa fa-sign-out"></i> 
                &nbsp;&nbsp;Cerrar Sesión
              </a>
            </li>

          </ul>

        </li>

      </ul>

    </div> <!--/.navbar-collapse -->

  </div> <!-- /.container -->

</div> <!-- /.navbar -->

  <div class="mainbar">

  <div class="container">

    <button type="button" class="btn mainbar-toggle" data-toggle="collapse" data-target=".mainbar-collapse">
      <i class="fa fa-bars"></i>
    </button>

    <div class="mainbar-collapse collapse">

      <ul class="nav navbar-nav mainbar-nav">

        <li class="">
          <a href="<?= base_url('usuario') ?>">
            <i class="fa fa-user"></i>
            Usuarios
          </a>
        </li>

        <li class="dropdown ">
          <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
            <i class="fa fa-users"></i>
            Personas
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="<?= base_url('cliente/personas/prospectos') ?>"> Prospectos</a></li>
            <li><a href="<?= base_url('cliente/personas/clientes') ?>"> Clientes</a></li>
          </ul>
        </li>

        <li class="dropdown ">
          <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
            <i class="fa fa-home"></i>
            Casas
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="<?= base_url('casa') ?>"> Prospectos</a></li>
            <li><a href="<?= base_url('casa/inventario_ventas') ?>"> Inventario-Ventas</a></li>
            <li><a href="#"> Vendidas </a></li>
          </ul>
        </li> 

        <li class="dropdown ">
          <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
            <i class="fa fa-th-large"></i>
            Servicios
            <span class="caret"></span>
          </a>

          <ul class="dropdown-menu">
            <li><a href="<?= base_url('servicio/comprar') ?>"> Comprar</a></li>
            <li><a href="<?= base_url('servicio/vender') ?>"> Vender</a></li>
            <li><a href="<?= base_url('servicio/remodelar') ?>"> Remodelar</a></li>
            <li><a href="<?= base_url('servicio/construir') ?>"> Construir</a></li>
            <li><a href="<?= base_url('servicio/mantenimiento') ?>"> Mantenimiento</a></li>
          </ul>
        </li>

        <li class="dropdown ">
          <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
            <i class="fa fa-book"></i>
            Actividades
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="<?= base_url('actividades/visitas') ?>"> Visitas</a></li>
          </ul>
        </li>

        <li class="">
          <a href="<?= base_url('proveedor') ?>">
            <i class="fa fa-wrench"></i>
            Proveedores
          </a>
        </li>

        <li class="">
          <a href="<?= base_url('avaluo') ?>">
            <i class="fa fa-usd"></i>
            Avaluos
          </a>
        </li>

        <!--<li class="dropdown ">
          <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
            <i class="fa fa-users"></i>
            Personas
            <span class="caret"></span>
          </a>

          <ul class="dropdown-menu">
            <li><a href="<?= base_url('cliente') ?>"> Prospectos</a></li>
            <li><a href="<?= base_url('cliente#/clientes') ?>"> Clientes</a></li>
          </ul>
        </li>-->

        <li class="dropdown ">
          <a href="#contact" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
            <i class="fa fa-th-large"></i>
            Reportes
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu" role="menu">
            <li class="dropdown-submenu">
              <a tabindex="-1" href="#"> 
              Ventas
              </a>

              <ul class="dropdown-menu">
                <li><a href="<?= base_url('reporte/venta') ?>">Actividades</a></li>
                <!--<li><a href="<?= base_url('reporte/#/compras') ?>"> Compras</a></li>
                <li><a href="<?= base_url('reporte/#/ventas') ?>"> Ventas</a></li>
                <li><a href="<?= base_url('reporte/#/estatus_remodelar') ?>"> Remodelacion</a></li>
                <li><a href="<?= base_url('reporte/#/estatus_construir') ?>"> Construccion</a></li>
                <li><a href="<?= base_url('reporte/#/estatus_mantenimiento') ?>"> Mantenimiento</a></li>-->
              </ul>
            </li>
          </ul>
        </li>  
        <li class="dropdown ">
          <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
            <i class="fa fa-cogs"></i> 
            Administrador
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="<?= base_url('configuracion/casa_paquete') ?>"> Casa - Paquetes</a></li>
          </ul>
        </li>    

      

    </div> <!-- /.navbar-collapse -->   

  </div> <!-- /.container --> 

</div> <!-- /.mainbar -->


<div class="container">

  <div class="content">

    <div class="content-container">

      

      <div class="content-header">
        <h2 class="content-header-title"><?= $titulo ?></h2>
        <?= $this->load->view($contenido) ?>
      </div> <!-- /.content-header -->

    </div> <!-- /.content-container -->
      
  </div> <!-- /.content -->

</div> <!-- /.container -->


<footer class="footer">

  <div class="container">

    <div class="row">

      <div class="col-sm-12"> 

        <hr>    

        <p>&copy; 2016 Casas Habitat.</p>

      </div> <!-- /.col -->

    </div> <!-- /.row -->

  </div> <!-- /.container -->
  
</footer>

  
  <script src="<?= base_url('../js/libs/jquery-1.10.1.min.js') ?>"></script>
  <script src="<?= base_url('../js/libs/jquery-ui-1.9.2.custom.min.js') ?>"></script>
  <script src="<?= base_url('../js/libs/bootstrap.min.js') ?>"></script>
  <!--[if lt IE 9]>
  <script src="./js/libs/excanvas.compiled.js"></script>
  <![endif]-->
  <!-- App JS -->
  <script src="<?= base_url('../js/target-admin.js') ?>"></script>
  <script src="<?= base_url('../js/plugins/datatables/jquery.dataTables.min.js') ?> "></script>
  <script src="<?= base_url('../js/plugins/datatables/DT_bootstrap.js') ?> "></script>
  <script src="<?= base_url('../js/plugins/tableCheckable/jquery.tableCheckable.js') ?>"></script>


  <script src="<?= base_url('../js/plugins/icheck/jquery.icheck.js') ?> "</script>
  <script src="<?= base_url('../js/plugins/select2/select2.js') ?> "</script>
  <script src="<?= base_url('../js/plugins/datepicker/bootstrap-datepicker.js') ?> "</script>
  <script src="<?= base_url('../js/plugins/timepicker/bootstrap-timepicker.js') ?> "</script>
  <script src="<?= base_url('../js/plugins/simplecolorpicker/jquery.simplecolorpicker.js') ?> "</script>
  <script src="<?= base_url('../js/plugins/autosize/jquery.autosize.min.js') ?> "</script>
  <script src="<?= base_url('../js/plugins/textarea-counter/jquery.textarea-counter.js') ?> "</script>
  <script src="<?= base_url('../js/plugins/fileupload/bootstrap-fileupload.js') ?> "</script>
  <?php
  if( !empty( $js ) )
  echo $js; 
  ?>

  <?php
  if( isset( $modal ) )
    echo $modal; 
  ?>


</body>
</html>
