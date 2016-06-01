<?= form_open('menu_perfil/update', array('class'=>'form-horizontal')); ?>
    <legend> Actualizar Registro </legend>

    <?= my_validation_errors(validation_errors()); ?>

    <div class="control-group">
        <?= form_label('ID', 'id', array('class'=>'control-label')); ?>
        <span class="uneditable-input"> <?= $registro->id; ?> </span>
        <?= form_hidden('id', $registro->id); ?>
    </div>

    <div class="control-group">
        <?= form_label('Menú', 'menu_id', array('class'=>'control-label')); ?>
        <?= form_dropdown('menu_id', $menus, $registro->menu_id); ?>
    </div>

    <div class="control-group">
        <?= form_label('Perfil', 'perfil_id', array('class'=>'control-label')); ?>
        <?= form_dropdown('perfil_id', $perfiles, $registro->perfil_id); ?>
    </div>

    <div class="control-group">
        <?= form_label('Creado', 'fecha_hora_creacion', array('class'=>'control-label')); ?>
        <span class="uneditable-input"> <?= date("d/m/Y - H:i", strtotime($registro->fecha_hora_creacion)); ?> </span>
        <?= form_hidden('fecha_hora_creacion', $registro->fecha_hora_creacion); ?>
    </div>

    <div class="control-group">
        <?= form_label('Modificado', 'fecha_hora_modificacion', array('class'=>'control-label')); ?>
        <span class="uneditable-input"> <?= date("d/m/Y - H:i", strtotime($registro->fecha_hora_modificacion)); ?> </span>
        <?= form_hidden('fecha_hora_modificacion', $registro->fecha_hora_modificacion); ?>
    </div>

    <div class="form-actions">
        <?= form_button(array('type'=>'submit', 'content'=>'Aceptar', 'class'=>'btn btn-primary')); ?>
        <?= anchor('menu_perfil/index', 'Cancelar', array('class'=>'btn')); ?>
        <?= anchor('menu_perfil/delete/'.$registro->id, 'Eliminar', array('class'=>'btn btn-warning', 'onClick'=>"return confirm('¿Está Seguro?')")); ?>
    </div>
<?= form_close(); ?>
