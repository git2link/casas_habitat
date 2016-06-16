<?= form_open('menu_perfil/insert', array('class'=>'form-horizontal')); ?>
    <legend> Crear Registro </legend>

    <?= my_validation_errors(validation_errors()); ?>

    <div class="control-group">
        <?= form_label('Menú', 'menu_id', array('class'=>'control-label')); ?>
        <?= form_dropdown('menu_id', $menus, 0); ?>
    </div>

    <div class="control-group">
        <?= form_label('Perfil', 'perfil_id', array('class'=>'control-label')); ?>
        <?= form_dropdown('perfil_id', $perfiles, 0); ?>
    </div>

    <div class="form-actions">
        <?= form_button(array('type'=>'submit', 'content'=>'Aceptar', 'class'=>'btn btn-primary')); ?>
        <?= anchor('menu_perfil/index', 'Cancelar', array('class'=>'btn')); ?>
    </div>
<?= form_close(); ?>
