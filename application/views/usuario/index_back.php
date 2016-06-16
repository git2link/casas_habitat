<div class="page-header">
	<h1> Usuarios <small> mantenimiento de registros </small> </h1>
	<div class="pull-left"><?= anchor('usuario/create', 'Agregar', array('class'=>'btn btn-primary')); ?> </div>
</div>
<br>


<div class="table-responsive">
<button id="test">
  test
</button>
  <table 
    class="table table-striped table-bordered table-hover table-highlight table-checkable" 
    data-provide="datatable" 
    data-display-rows="10"
    data-info="true"
    data-search="true"
    data-length-change="true"
    data-paginate="true"
  >
      <thead>
        <tr>
        <th data-filterable="false"> Acciones </th>
		<th data-filterable="true" data-sortable="true" data-direction="asc" > Nombre </th>
		<th data-filterable="true" data-sortable="true" > Login </th>
		<th data-filterable="true" data-sortable="true" > Email </th>
		<th data-filterable="true" class="hidden-xs hidden-sm" > Perfil </th>
		<th data-filterable="true" class="hidden-xs hidden-sm" > Creación </th>
        </tr>
      </thead>
      <tbody id="tbody_1">
      	<?php foreach ($query as $registro): ?>
			<tr>
				<td> <?= anchor('usuario/edit/'.$registro->id, '<i class="fa fa-edit"></i>' , array('class' => 'btn btn-secondary')); ?> </td>
				<td> <?= $registro->nombre." ".$registro->apellido_paterno." ".$registro->apellido_materno ?> </td>
				<td> <?= $registro->login ?> </td>
				<td> <?= $registro->email ?> </td>
				<td class="hidden-xs hidden-sm"> <?= $registro->perfil_name ?> </td>
				<td class="hidden-xs hidden-sm"> <?= date("Y-m-d - H:i:s", strtotime($registro->fecha_hora_creacion)); ?> </td>
			</tr>
		<?php endforeach; ?>
      </tbody>
    </table>
  </div>

  
