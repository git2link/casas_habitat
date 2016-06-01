<?= form_open('home/ingresar', array('class'=>'form account-form')); ?>
	<legend> Ingreso al Sistema </legend>

	<?= my_validation_errors(validation_errors()); ?>

	<div class="form-group">
		<?= form_label('Usuario', 'login', array('class'=>'placeholder-hidden' , 'for' => "login-username")); ?>
		<?= form_input(array('tabindex' => '1','class'=> 'form-control', 'type'=>'text', 'name'=>'login', 'id'=>'login', 'placeholder'=>'Usuario...', 'value'=>set_value('login'))); ?>
	</div>

	<div class="form-group">
		<?= form_label('Password', 'password', array('class'=>'control-label')); ?>
		<?= form_input(array('tabindex' => '2','class'=> 'form-control','type'=>'password', 'name'=>'password', 'id'=>'password', 'placeholder'=>'Contraseña...', 'value'=>set_value('password'))); ?>
	</div>

	<div class="form-group clearfix">
        <div class="pull-left">         
        	<label class="checkbox-inline">
            <input type="checkbox" class="" value="" tabindex="3">Recordarme
            </label>
        </div>

        <div class="pull-right">
        	<a href="#">Olvidaste tu password?</a>
        </div>
    </div> <!-- /.form-group -->

	<div class="form-group">
		<?= form_button(array('type'=>'submit', 'content'=>'Ingresar &nbsp; <i class="fa fa-play-circle"></i>', 'class'=>'btn btn-primary btn-block btn-lg')); ?>
	</div>
<?= form_close(); ?>
