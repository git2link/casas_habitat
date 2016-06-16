<div class="page-header">
	<h1> Proveedores <small> mantenimiento de registros </small> </h1>
	<div class="pull-left"><?= anchor('proveedor/create', 'Agregar', array('class'=>'btn btn-primary')); ?> </div>
</div>
<br>
<div class="table-responsive">

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
			<th data-sortable="false"> Acciones </th>
			<th data-filterable="true" data-sortable="true" > Empresa </th>
			<th data-filterable="true" data-sortable="true" > Nombre </th>
			<th data-filterable="true" data-sortable="true" > Email </th>
			<th data-filterable="true" data-sortable="true" > Teléfono Oficina </th>
			<th data-filterable="true" data-sortable="true" > Teléfono Celular </th>
			<th data-filterable="true" data-sortable="true" data-direction="desc"> Creación </th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($query as $registro): ?>
		<tr>
			<td> <?= anchor('proveedor/edit/'.$registro->proveedor_k, '<i class="fa fa-edit"></i>' , array('class' => 'btn btn-secondary')); ?> </td>
			<td> <?= $registro->empresa ?> </td>
			<td> <?= $registro->nombre ?> </td>
			<td> <?= $registro->email ?> </td>			
			<td> <?= $registro->telefono_oficina ?> </td>
			<td> <?= $registro->telefono_celular ?> </td>
			<td> <?= date("Y-m-d - H:i:s", strtotime($registro->fecha_hora_creacion)); ?> </td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
</div>