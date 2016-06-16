<div class="page-header">
	<h1> Accesos <small> mantenimiento de registros </small> </h1>
</div>

<?= form_open('menu_perfil/search', array('class'=>'form-search')); ?>
	<?= form_input(array('type'=>'text', 'name'=>'buscar', 'id'=>'buscar', 'placeholder'=>'Buscar por Perfil...', 'class'=>'input-medium search-query')); ?>
	<?= form_button(array('type'=>'submit', 'content'=>'<i class="icon-search"> </i>', 'class'=>'btn')); ?>
	<?= anchor('menu_perfil/create', 'Agregar', array('class'=>'btn btn-primary')); ?>
<?= form_close(); ?>

<table class="table table-condensed table-bordered">
	<thead>
		<tr>
			<th> ID </th>
			<th> Menú </th>
			<th> Perfil </th>
			<th> Creado </th>
			<th> Modificado </th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($query as $registro): ?>
		<tr>
			<td> <?= anchor('menu_perfil/edit/'.$registro->id, $registro->id); ?> </td>
			<td> <?= $registro->menu_name ?> </td>
			<td> <?= $registro->perfil_name ?> </td>
			<td> <?= date("d/m/Y - H:i", strtotime($registro->fecha_hora_creacion)); ?> </td>
			<td> <?= date("d/m/Y - H:i", strtotime($registro->fecha_hora_modificacion)); ?> </td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
