<div class="portlet">

        <div class="portlet-header">

          <h3>
            <i class="fa fa-user"></i>
            Cliente
          </h3>

        </div> <!-- /.portlet-header -->
        <div class="portlet-content">
            <?= form_open('usuario/insert', array('name' => 'form' , 'autocomplete' => 'off')); ?>
            <?= my_validation_errors(validation_errors()); ?>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Casa', 'casa_k', array('for'=>'select-input')); ?>
                        <?= form_dropdown('casa_k', $casas, 0 , 'class="form-control"'); ?>
                    </div>                    
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Nombre', 'nombre', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'nombre', 'id'=>'nombre', 'value'=>set_value('nombre'))); ?>
                    </div>

                    <div class="form-group">
                        <?= form_label('Apellido Paterno', 'apellido_paterno', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'apellido_paterno', 'id'=>'apellido_paterno', 'value'=>set_value('apellido_paterno'))); ?>
                    </div>

                    <div class="form-group">
                        <?= form_label('Apellido Materno', 'apellido_materno', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'apellido_materno', 'id'=>'apellido_materno', 'value'=>set_value('apellido_materno'))); ?>
                    </div>

                    <div class="form-group">
                        <?= form_label('Fecha de Nacimiento', 'fecha_nacimiento', array('for'=>'text-input')); ?>
                        <div id="dp-ex-1" class="input-group date" data-auto-close="true" data-date="1998-02-01" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
                            <input class="form-control" type="text" name="fecha_nacimiento">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    

                </div>

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('NSS', 'nss', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'nss', 'id'=>'nss', 'value'=>set_value('nss'))); ?>
                    </div>

                    <div class="form-group">
                        <?= form_label('RFC', 'rfc', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'rfc', 'id'=>'rfc', 'value'=>set_value('rfc'))); ?>
                    </div>

                    <div class="form-group">
                        <?= form_label('CURP', 'curp', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'curp', 'id'=>'curp', 'value'=>set_value('curp'))); ?>
                    </div>

                    <div class="form-group">
                        <?= form_label('# INE', 'no_ife', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'no_ife', 'id'=>'no_ife', 'value'=>set_value('no_ife'))); ?>
                    </div>

                </div>

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Email', 'email', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'email', 'id'=>'email', 'value'=>set_value('email'))); ?>
                    </div>

                    <div class="form-group">
                        <?= form_label('Salario Mensual', 'salario_mensual', array('for'=>'text-input')); ?>
                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input class="form-control" name="salario_mensual" id="salario_mensual" type="text">
                        </div>
                    </div>

                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Código Postal', 'codigo_postal', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'codigo_postal', 'id'=>'codigo_postal', 'value'=>set_value('codigo_postal'))); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Estado', 'estado', array('for'=>'text-input')); ?>
                        <select name="estado_k" id="estado" value="<?= set_value('estado'); ?>" class="form-control">
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Municipio', 'municipio', array('for'=>'text-input')); ?>
                        <select name="municipio_k" id="municipio" value="<?= set_value('municipio'); ?>" class="form-control">
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Colonia', 'colonia', array('for'=>'text-input')); ?>
                        <select name="colonia_k" id="colonia" value="<?= set_value('colonia'); ?>" class="form-control">
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Calle', 'calle_numero', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'calle_numero', 'id'=>'calle_numero', 'value'=>set_value('calle_numero'))); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Lote', 'lote', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'lote', 'id'=>'lote', 'value'=>set_value('lote'))); ?>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Teléfono de Casa', 'telefono_casa', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'telefono_casa', 'id'=>'telefono_casa', 'value'=>set_value('telefono_casa'))); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Teléfono de Trabajo', 'telefono_trabajo', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'telefono_trabajo', 'id'=>'telefono_trabajo', 'value'=>set_value('telefono_trabajo'))); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Celular', 'telefono_celular', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'telefono_celular', 'id'=>'telefono_celular', 'value'=>set_value('telefono_celular'))); ?>
                    </div>
                </div>
                   
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Estado Civil', 'estado_civil_k', array('for'=>'select-input')); ?>
                        <?= form_dropdown('estado_civil_k', $estado_civil, 0 , 'class="form-control"'); ?>
                    </div>                    
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Nombre', 'nombre', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'nombre', 'id'=>'nombre', 'value'=>set_value('nombre'))); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-actions">
                        <?= form_button(array('type'=>'button', 'content'=>'Aceptar', 'class'=>'btn btn-primary' , 'onclick' => 'form.submit()')); ?>
                        <?= anchor('cliente/index', 'Cancelar', array('class'=>'btn')); ?>
                    </div>
            <?= form_close(); ?>
                </div>
            </div> <!-- /.row -->


        </div> <!-- /.portlet-content -->

      </div> <!-- /.portlet -->
