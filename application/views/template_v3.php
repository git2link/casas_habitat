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

<!-- Stylesheets -->
    
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
    <link rel="stylesheet" href="<?= base_url('../js/plugins/select2/select2.css') ?>">
    <link rel="stylesheet" href="<?= base_url('../js/plugins/datepicker/datepicker.css') ?>">
    <link rel="stylesheet" href="<?= base_url('../js/plugins/simplecolorpicker/jquery.simplecolorpicker.css') ?>">
    <link rel="stylesheet" href="<?= base_url('../js/plugins/timepicker/bootstrap-timepicker.css') ?>">

    <link rel="stylesheet" href="<?= base_url('../js/libs/css/ui-lightness/jquery-ui-1.9.2.custom.css') ?>">
    <link rel="stylesheet" href="<?= base_url('../js/plugins/magnific/magnific-popup.css') ?>">
    <link rel="stylesheet" href="<?= base_url('../css/demos/ui-notifications.css') ?>">
    <link rel="stylesheet" href="<?= base_url('../css/demos/ui-notifications.css') ?>">


    <!--Datatables-->
    <link rel="stylesheet" href="<?= base_url('../css/datatables/jquery.dataTables.min.css"') ?>">
    <link rel="stylesheet" href="<?= base_url('../css/datatables/dataTables.responsive.css') ?>">
    <link rel="stylesheet" href="<?= base_url('../css/datatables/dataTables.tableTools.min.css') ?>">

    <!--Pnotify-->
    <link rel="stylesheet" href="<?= base_url('../css/pnotify/pnotify.custom.min.css') ?>">

    <?php
    if( !empty( $css_plugins ) )
      print $css_plugins; 
    ?>

<!-- javascript Plugins-->  

    <script src="<?= base_url('../js/libs/jquery-1.10.1.min.js') ?>"></script>
    <script src="<?= base_url('../js/libs/jquery-ui-1.9.2.custom.min.js') ?>"></script>
    <script src="<?= base_url('../js/libs/bootstrap.min.js') ?>"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?= base_url('../js/oss_maxcdn/html5shiv.js') ?>"></script>
    <script src="<?= base_url('../js/oss_maxcdn/respond.min.js') ?>"></script>
    <![endif]-->

    <!--[if lt IE 9]>
    <script src="./js/libs/excanvas.compiled.js"></script>
    <![endif]-->
    
    <!-- App JS -->
    <script src="<?= base_url('../js/target-admin.js') ?>"></script>
    <script src="<?= base_url('../js/plugins/tableCheckable/jquery.tableCheckable.js') ?>"></script>


    <script src="<?= base_url('../js/plugins/icheck/jquery.icheck.js') ?> "</script>
    <script src="<?= base_url('../js/plugins/select2/select2.js') ?> "</script>
    <script src="<?= base_url('../js/plugins/datepicker/bootstrap-datepicker.js') ?> "</script>
    <script src="<?= base_url('../js/plugins/timepicker/bootstrap-timepicker.js') ?> "</script>
    <script src="<?= base_url('../js/plugins/simplecolorpicker/jquery.simplecolorpicker.js') ?> "</script>
    <script src="<?= base_url('../js/plugins/autosize/jquery.autosize.min.js') ?> "</script>
    <script src="<?= base_url('../js/plugins/textarea-counter/jquery.textarea-counter.js') ?> "</script>
    <script src="<?= base_url('../js/plugins/fileupload/bootstrap-fileupload.js') ?> "</script>
    <script src="<?= base_url('../js/plugins/nicescroll/jquery.nicescroll.min.js') ?>"></script>

    <!--Datatables-->
    <script src="<?= base_url('../js/datatables/jquery.dataTables.min.js') ?> "></script>
    <script src="<?= base_url('../js/datatables/dataTables.responsive.min.js') ?> "></script>
    <script src="<?= base_url('../js/datatables/dataTables.tableTools.js') ?> "></script>

    <!--Pnotify-->
    <script src="<?= base_url('../js/pnotify/pnotify.custom.min.js') ?> "></script>

    <?php
    if( !empty( $js_plugins ) )
      print $js_plugins; 
    ?>
    <style type="text/css">
      th.prev{ display: inline;}
      th.next{ display: inline;}
    </style>

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
            <img src="<?= $foto ?>" class="navbar-profile-avatar" alt="">
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
            <li><a href="<?= base_url('cliente') ?>"> Clientes</a></li>
          </ul>
        </li>-->
        <li class="dropdown ">
          <a href="#contact" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
            <i class="fa fa-bar-chart-o"></i>
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
          <a href="#contact" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
            <i class="fa fa-cogs"></i>
            Administrador
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu" role="menu">
            <li class="dropdown-submenu">
              <a tabindex="-1" href="#"> 
              Catalogos
              </a>

              <ul class="dropdown-menu">
                <li><a href="<?= base_url('configuracion/casa_paquete') ?>"> Casa - Paquetes</a></li>
                <li><a href="<?= base_url('configuracion/direcciones') ?>"> Direcciones</a></li>
                <li><a href="<?= base_url('configuracion/forma_pago') ?>"> Formas de Pago</a></li>
                <li><a href="<?= base_url('configuracion/estatus_venta') ?>"> Estatus para la Venta</a></li>
                <li><a href="<?= base_url('configuracion/procedencia_prospectos') ?>"> Procedencia de Prospectos</a></li>
                <li><a href="<?= base_url('configuracion/puestos') ?>"> Puestos</a></li>
                <li><a href="<?= base_url('configuracion/sucursales') ?>"> Sucursales</a></li>
              </ul>
            </li>
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

<?php if (isset($modal)): ?>
  <?= $this->load->view($modal) ?>
<?php endif ?>

<?php
  if( isset( $js ) )
  print $js; 
?>


<script type="text/javascript">
  $('.date').attr('data-date-format','yyyy-mm-dd');
  $('.date').attr('data-date-autoclose','true');
  $('.date').datepicker();
  $('.date').on('focus', function(e){
    e.preventDefault();
    $('div.datepicker.datepicker-dropdown.dropdown-menu').css('z-index', '1060');
  });
                   
  function pnotify_common(type){
    if (type == 'success') {
      new PNotify({
          title: 'Petición registrada',
          type: type
      });
    }else if(type == 'info'){
      new PNotify({
          title: 'Espere un momento',
          type: type
      });
    }else if(type == 'error'){
      new PNotify({
          title: 'Ocurrio un error',
          text: 'Contacte al administrador',
          type: type
      });
    }
      
  }
  function pnotify_basic(title, text, type){
    new PNotify({
        title: title,
        text: text,
        type: type
    });

  }

</script>
</body>
</html>
