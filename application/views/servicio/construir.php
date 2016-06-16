
    <div class="portlet">

        <div class="portlet-header">

          <h3>
            <i class="fa fa-home"></i>
            Prospecto para Construir
          </h3>

        </div> <!-- /.portlet-header -->

        <?= form_open('servicio/createconstruir', array('name' => 'form' , 'autocomplete' => 'off') ); ?>
            <?= my_validation_errors(validation_errors()); ?>
        <div class="portlet-content">
            
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Presupuesto', 'presupuesto', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'presupuesto', 'id'=>'presupuesto', 'value'=>set_value('presupuesto'))); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Forma de pago', 'forma_pago_k', array('for'=>'select-input')); ?>
                        <?= form_dropdown('forma_pago_k', $forma_pago, 0 , 'class="form-control"'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Código Postal', 'codigo_postal', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'codigo_postal', 'id'=>'codigo_postal_casa', 'value'=>set_value('codigo_postal'))); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Estado', 'estado', array('for'=>'text-input')); ?>
                        <select name="estado_k" id="estado_casa" value="<?= set_value('estado'); ?>" class="form-control">
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Municipio', 'municipio', array('for'=>'text-input')); ?>
                        <select name="municipio_k" id="municipio_casa" value="<?= set_value('municipio'); ?>" class="form-control">
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Colonia', 'colonia', array('for'=>'text-input')); ?>
                        <select name="colonia_k" id="colonia_casa" value="<?= set_value('colonia'); ?>" class="form-control">
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
            
            
        </div> <!-- /.portlet-content -->

        <div class="portlet-header">
          <h3>
            <i class="fa fa-home"></i>
            Datos Personales
          </h3>
        </div>

        <div class="portlet-content">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Nombre', 'nombre', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'nombre', 'id'=>'nombre', 'value'=>set_value('nombre'))); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Apellido Paterno', 'apellido_paterno', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'apellido_paterno', 'id'=>'apellido_paterno', 'value'=>set_value('apellido_paterno'))); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Apellido Materno', 'apellido_materno', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'apellido_materno', 'id'=>'apellido_materno', 'value'=>set_value('apellido_materno'))); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
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
                        <?= form_label('Lugar de Nacimiento', 'estado_nacimiento_k', array('for'=>'select-input')); ?>
                        <?= form_dropdown('estado_nacimiento_k', $estados, 0 , 'class="form-control" id="estado_nacimiento_k"'); ?>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Sexo', 'sexo', array('for'=>'select-input')); ?>
                        <?= form_dropdown('sexo', $sexo, 0 , 'class="form-control" id="sexo"'); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('RFC', 'rfc', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'rfc', 'id'=>'rfc', 'value'=>set_value('rfc'))); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('CURP', 'curp', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'curp', 'id'=>'curp', 'value'=>set_value('curp'))); ?>
                    </div>
                </div>

            </div>

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

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Teléfono de Casa', 'telefono_casa', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'telefono_casa', 'id'=>'telefono_casa', 'value'=>set_value('telefono_casa'))); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Teléfono de Recados', 'telefono_recados', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'telefono_recados', 'id'=>'telefono_recados', 'value'=>set_value('telefono_recados'))); ?>
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
                        <?= form_label('Facebook', 'fb', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'fb', 'id'=>'fb', 'value'=>set_value('fb'))); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Twitter', 'twitter', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'twitter', 'id'=>'twitter', 'value'=>set_value('twitter'))); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Email', 'email', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'email', 'id'=>'email', 'value'=>set_value('email'))); ?>
                    </div>
                </div>
                   
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Empresa', 'empresa', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'empresa', 'id'=>'empresa', 'value'=>set_value('empresa'))); ?>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="form-actions">
                        <?= form_button(array('type'=>'button', 'content'=>'Aceptar', 'class'=>'btn btn-primary', 'onclick' => 'form.submit()')); ?>
                        <?= anchor('home/index', 'Cancelar', array('class'=>'btn')); ?>
                    </div>
                    <?= form_close(); ?>
                </div>

            </div> <!-- /.row -->
        </div>

      </div> <!-- /.portlet -->

      