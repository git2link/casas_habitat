<div class="pull-right">
Cliente : <?= $datos_usuario->nombre ." ".$datos_usuario->apellido_paterno." ".$datos_usuario->apellido_materno?>
</div>
<input type="hidden" value="<?= $usuario_k ?>" id="usuario_k"></input>
<link rel="stylesheet" href="../../../css/custom.css" type="text/css" />
<div class="row">

  <div class="col-md-12">
                
    <ul id="myTab1" class="nav nav-tabs">

      <li class="dropdown">
        <a href="#" id="myTabDrop1" class="dropdown-toggle">Comprar <b class="caret"></b>
        </a>

        <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
          <li><a href="#/casas_sin_interes" tabindex="-1" data-toggle="tab">Todas las Casas</a></li>
          <li><a href="#/casas_con_interes" tabindex="-1" data-toggle="tab">Casas de Interes</a></li>
        </ul>
      </li>

      <li>
        <a href="#/vender" data-toggle="tab">Vender</a>
      </li>
    </ul>
    <div class="pull-right">
    </div>
    <div class="tab-content">
    	<div ng-view="" id="ng-view">
		</div>
    </div>
  </div>
</div>	

