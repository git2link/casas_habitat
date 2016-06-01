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
  <link rel='shortcut icon' href="<?= base_url('../img/casa.png') ?>" type='image/png' />

  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,400,600,700">
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,300,700">
  <link rel="stylesheet" href="<?=base_url('../css/font-awesome.min.css')?>">
  <link rel="stylesheet" href="<?=base_url('../js/libs/css/ui-lightness/jquery-ui-1.9.2.custom.min.css')?>">
  <link rel="stylesheet" href="<?=base_url('../css/bootstrap.min.css')?>">

  <!-- Plugin CSS -->
  <link rel="stylesheet" href="<?=base_url('../js/plugins/morris/morris.css')?>">
  <link rel="stylesheet" href="<?=base_url('../js/plugins/icheck/skins/minimal/blue.css')?>">
  <link rel="stylesheet" href="<?=base_url('../js/plugins/select2/select2.css')?>">
  <link rel="stylesheet" href="<?=base_url('../js/plugins/fullcalendar/fullcalendar.css')?>">

  <!-- App CSS -->
  <link rel="stylesheet" href="<?=base_url('../css/target-admin.css')?>">
  <link rel="stylesheet" href="<?=base_url('../css/custom.css')?>">


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
            <li><a href="<?= base_url('casa/ofertas_pendientes') ?>"> Ofertas Pendientes </a></li>
            <!--<li><a href="#"> Vendidas </a></li>-->
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

      </ul>

    </div> <!-- /.navbar-collapse -->   

  </div> <!-- /.container --> 

</div> <!-- /.mainbar -->



<div class="container">

  <div class="content">

    <div class="content-container">

      

      <div>
        <h4 class="heading-inline">Estadísticas Semanales de Ventas
        &nbsp;&nbsp;<small>Para la semana del 1 de Febrero al 8 de Febrero, 2016</small>
        &nbsp;&nbsp;</h4>

        <div class="btn-group ">
          <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
          <i class="fa fa-clock-o"></i>  &nbsp;
            Cambiar Semana <span class="caret"></span>
          </button>
          
        </div>
      </div>

      <br>

      <div class="row">

        <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label">Ingresos del día</p>
            <h3 class="row-stat-value">$430,564.00</h3>
            <span class="label label-success row-stat-badge">+43%</span>
          </div> <!-- /.row-stat -->
        </div> <!-- /.col -->

        <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label">Ingresos del Mes</p>
            <h3 class="row-stat-value">$2,451,295.00</h3>
            <span class="label label-success row-stat-badge">+17%</span>
          </div> <!-- /.row-stat -->
        </div> <!-- /.col -->

        <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label">Total de Ventas</p>
            <h3 class="row-stat-value">13</h3>
            <span class="label label-success row-stat-badge">+26%</span>
          </div> <!-- /.row-stat -->
        </div> <!-- /.col -->

        <div class="col-sm-6 col-md-3">
          <div class="row-stat">
            <p class="row-stat-label">Compras por Concretar</p>
            <h3 class="row-stat-value">4</h3>
            <span class="label label-danger row-stat-badge">+5%</span>
          </div> <!-- /.row-stat -->
        </div> <!-- /.col -->
        
      </div> <!-- /.row -->


      <br>



      <div class="row">

        <div class="col-md-8">

          <div class="portlet">

            <div class="portlet-header">

              <h3>
                <i class="fa fa-bar-chart-o"></i>
                Ventas por Vendedor
              </h3>

            </div> <!-- /.portlet-header -->

            <div class="portlet-content">

              <div class="pull-left">
                <div class="btn-group" data-toggle="buttons">
                  <label class="btn btn-sm btn-default">
                    <input type="radio" name="options" id="option1"> Día
                  </label>
                  <label class="btn btn-sm btn-default">
                    <input type="radio" name="options" id="option2"> Semana
                  </label>
                  <label class="btn btn-sm btn-default active">
                    <input type="radio" name="options" id="option3"> Mes
                  </label>
                </div>

                &nbsp;

                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
                    Fecha Personalizada
                    <span class="caret"></span>
                  </button>
                  
                </div>                
              </div> <!-- /.pull-left -->

              

              <div class="clear"></div>

              <hr />


              <div id="area-chart" class="chart-holder"></div> <!-- /#area-chart -->


            </div> <!-- /.portlet-content -->

          </div> <!-- /.portlet -->
         


          <div class="portlet">

            <div class="portlet-header">

              <h3>
                <i class="fa fa-file-text-o"></i>
                Actividades
              </h3>

            </div> <!-- /.portlet-header -->

            <div class="portlet-content panel-thread scrollable-panel">

              <ul class="panel-lists">

                <li>
                  <img src="<?= base_url('../img/avatars/avatar-1-md.jpg') ?>" alt="Avatar" class="panel-list-avatar">
                  <div class="panel-list-content">
                      <span class="panel-list-time">20 mins</span>
                      <a href="#" class="panel-list-title">Juan Carlos ha dado de alta una nueva casa.</a>
                      <span class="panel-list-meta"><a href="#">Ver detalles</a></span>
                  </div>
                </li>

                <li>
                  <img src="<?= base_url('../img/avatars/avatar-2-md.jpg') ?>" alt="Avatar" class="panel-list-avatar">
                  <div class="panel-list-content">
                      <span class="panel-list-time">2 horas </span>
                      <a href="#" class="panel-list-title">Ana ha cambiado el estatus de  la casa SA-203 a vendida</a>
                      <span class="panel-list-meta"><a href="#">Ver detalles</a></span>
                  </div>
                </li>

                <li>
                  <img src="<?= base_url('../img/avatars/profile.jpg') ?>" alt="Avatar" class="panel-list-avatar">
                  <div class="panel-list-content">
                      <span class="panel-list-time">3 horas</span>
                      <a href="#" class="panel-list-title">Cesar dio de alta un cliente para compra de una casa.</a>
                      <span class="panel-list-meta"><a href="#">Ver detalles</a></span>
                  </div>
                </li>

                <li>
                  <img src="<?= base_url('../img/avatars/avatar-2-md.jpg') ?>" alt="Avatar" class="panel-list-avatar">
                  <div class="panel-list-content">
                      <span class="panel-list-time">3 horas </span>
                      <a href="#" class="panel-list-title">Ana cancelo compra de la casa UJ-103</a>
                      <span class="panel-list-meta"><a href="#">Ver detalles</a></span>
                  </div>
                </li>

                
                                        
              </ul>


            </div> <!-- /.portlet-content -->

          </div> <!-- /.portlet -->


        </div> <!-- /.col -->



        <div class="col-md-4">

          <div class="portlet">

            <div class="portlet-header">

              <h3>
                <i class="fa fa-bar-chart-o"></i>
                ¿De dónde provienen nuestras casas?
              </h3>

            </div> <!-- /.portlet-header -->

            <div class="portlet-content">

              <div id="donut-chart" class="chart-holder-225"></div>
                  

            </div> <!-- /.portlet-content -->

          </div> <!-- /.portlet -->

              

          <div class="portlet">

            <div class="portlet-header">

              <h3>
                <i class="fa fa-compass"></i>
                Tráfico de la Red
              </h3>

            </div> <!-- /.portlet-header -->

            <div class="portlet-content">

              <div class="progress-stat">
                  
                <div class="progress-stat-label">
                  % Desde Computadora
                </div> <!-- /.stat-label -->
                
                <div class="progress-stat-value">
                  77.7%
                </div> <!-- /.stat-value -->
                
                <div class="progress progress-striped active">
                  <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 77%">
                    <span class="sr-only">77.74%</span>
                  </div>
                </div> <!-- /.progress -->
                
              </div> <!-- /.progress-stat -->


              <div class="progress-stat">
                  
                <div class="progress-stat-label">
                  % Desde mobiles
                </div> <!-- /.stat-label -->
                
                <div class="progress-stat-value">
                  22.3%
                </div> <!-- /.stat-value -->
                
                <div class="progress progress-striped active">
                  <div class="progress-bar progress-bar-tertiary" role="progressbar" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100" style="width: 22%">
                    <span class="sr-only">22% </span>
                  </div>
                </div> <!-- /.progress -->
                
              </div> <!-- /.progress-stat -->

            </div> <!-- /.portlet-content -->

          </div> <!-- /.portlet -->


        </div> <!-- /.col -->

      </div> <!-- /.row -->

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
  
  <!-- Plugin JS -->
<script src="<?= base_url('../js/plugins/icheck/jquery.icheck.js') ?>"></script>
<script src="<?= base_url('../js/plugins/select2/select2.js') ?>"></script>
<script src="<?= base_url('../js/libs/raphael-2.1.2.min.js') ?>"></script>
<script src="<?= base_url('../js/plugins/sparkline/jquery.sparkline.min.js') ?>"></script>
<script src="<?= base_url('../js/plugins/nicescroll/jquery.nicescroll.min.js') ?>"></script>
<script src="<?= base_url('../js/plugins/fullcalendar/fullcalendar.min.js') ?>"></script>

<script src="<?= base_url('../js/target-admin.js') ?>"></script>
<script src="<?= base_url('../js/plugins/morris/morris.min.js') ?>"></script>
<script src="<?= base_url('../js/demos/dashboard.js') ?>"></script>
<script src="<?= base_url('../js/demos/calendar.js') ?>"></script>
<script src="<?= base_url('../js/demos/charts/morris/area.js') ?>"></script>
<script src="<?= base_url('../js/demos/charts/morris/donut.js') ?>"></script>

  


  
</body>
</html>