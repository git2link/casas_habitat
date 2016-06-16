<div class="page-header">
	<h1> Casas <small> inventario de ventas  </small> </h1> 
</div>
<br>

<?php 
	if ( ($this->session->userdata('perfil_id')) == PERFIL_ADMINISTRADOR ){
?>
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
			<th data-filterable="false"> Vender </th>
			<th data-filterable="true" data-sortable="true"> Tipo </th>
			<th data-filterable="true" data-sortable="true"> Paquete </th>
			<th data-filterable="true" data-sortable="true"> Clave Interna </th>
			<th data-filterable="true" data-sortable="true"> Dirección </th>
			<th data-filterable="true" data-sortable="true" data-direction="desc"> Creación </th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($query as $registro): ?>
		<tr>
			<td> <?= 
				anchor('casa/vender/'.$registro->casa_k, '<i class="fa fa-usd"></i>' , array('class' => 'btn btn-secondary')); 
				?> 
			</td>
			<td> <?= $registro->descripcion_tipo_casa ?> </td>
			<td> <?= $registro->descripcion_paquete_casa ?> </td>
			<td> <?= $registro->clave_interna ?> </td>
			<td> <?= $registro->calle_numero." ".$registro->lote." , Manzana ".$registro->manzana." ,  ".$registro->colonia." ".$registro->municipio." ".$registro->estado ?> </td>
			<td> <?= date("Y-m-d - H:i:s", strtotime($registro->fecha_hora_creacion)); ?> </td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
</div>
<?php
} 
	if ( ($this->session->userdata('perfil_id')) == PERFIL_ASESOR ){
?>
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
			<th data-filterable="false"> Vender </th>
			<th data-filterable="true" data-sortable="true"> Dirección </th>
			<th data-filterable="true" data-sortable="true"> Precio de Venta </th>
			<th data-filterable="true" data-sortable="true"> Pisos/Nivel </th>
			<th data-filterable="true" data-sortable="true"> Recamaras </th>
			<th data-filterable="true" data-sortable="true" data-direction="desc"> Baños </th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($query as $registro): ?>
		<tr>
			<td> <?= 
				anchor('casa/vender/'.$registro->casa_k, '<i class="fa fa-usd"></i>' , array('class' => 'btn btn-secondary')); 
				?> 
			</td>
			<td> <?= $registro->calle_numero." ".$registro->lote." , Manzana ".$registro->manzana." ,  ".$registro->colonia." ".$registro->municipio." ".$registro->estado ?> </td>
			<td> <?= $registro->precio_venta ?> </td>
			<td> <?= $registro->pisos_nivel ?> </td>
			<td> <?= $registro->recamaras ?> </td>
			<td> <?= $registro->banios ?> </td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
</div>
<?php
} 
?>