<div class="page-header">
	<h1> Avaluos <small> mantenimiento de registros </small> </h1> 
	<div class="pull-left"><?= anchor('avaluo/create', 'Agregar', array('class'=>'btn btn-primary')); ?> </div>
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
			<th data-filterable="false"> Acciones </th>
			<th data-filterable="true" data-sortable="true"> Clave Interna </th>
			<th data-filterable="true" data-sortable="true"> Unidad Valuacion </th>
			<th data-filterable="true" data-sortable="true"> Costo </th>
			<th data-filterable="true" data-sortable="true"> Fecha Entrega </th>
			<th data-filterable="true" data-sortable="true"> Base </th>
			<th data-filterable="true" data-sortable="true"> Hipotetico </th>
			<th data-filterable="true" data-sortable="true"> Final </th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($query as $registro): ?>
		<tr>
			<td> <?= anchor('avaluo/edit/'.$registro->avaluo_k, '<i class="fa fa-edit"></i>' , array('class' => 'btn btn-secondary')); ?> </td>
			<td> <?= $registro->clave_interna ?> </td>
			<td> <?= $registro->empresa ?> </td>
			<td> <?= $registro->costo_avaluo ?> </td>
			<td> <?= $registro->fecha_entrega_avaluo ?> </td>
			<td> <?= $registro->base ?> </td>
			<td> <?= $registro->hipotetico ?> </td>
			<td> <?= $registro->final ?> </td>
			
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
</div>