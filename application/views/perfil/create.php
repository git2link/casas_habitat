<?= form_open('perfil/insert', array('class'=>'form-horizontal')); ?>
	<legend> Crear Registro </legend>

	<?= my_validation_errors(validation_errors()); ?>

	<div class="control-group">
		<?= form_label('Nombre', 'name', array('class'=>'control-label')); ?>
		<?= form_input(array('type'=>'text', 'name'=>'name', 'id'=>'name', 'value'=>set_value('name'))); ?>
	</div>

	<div class="form-actions">
		<?= form_button(array('type'=>'submit', 'content'=>'Aceptar', 'class'=>'btn btn-primary')); ?>
		<?= anchor('perfil/index', 'Cancelar', array('class'=>'btn')); ?>
	</div>
<?= form_close(); ?>
