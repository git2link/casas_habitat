<div class="portlet">

        <div class="portlet-header">

          <h3>
            <i class="fa fa-usd"></i>
            Unidades de Valuación
          </h3>

        </div> <!-- /.portlet-header -->
        <div class="portlet-content">
            <?= form_open('unidad_valuacion/insert', array('name' => 'form' , 'autocomplete' => 'off')); ?>
            <?= my_validation_errors(validation_errors()); ?>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Empresa', 'empresa', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'empresa', 'id'=>'empresa', 'value'=>set_value('empresa'))); ?>
                    </div>

                    <div class="form-group">
                        <?= form_label('Nombre del Contacto', 'nombre', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'nombre', 'id'=>'nombre', 'value'=>set_value('nombre'))); ?>
                    </div>

                    <div class="form-group">
                        <?= form_label('Teléfono Oficina', 'telefono_oficina', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'telefono_oficina', 'id'=>'telefono_oficina', 'value'=>set_value('telefono_oficina'))); ?>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Teléfono Celular', 'telefono_celular', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'telefono_celular', 'id'=>'telefono_celular', 'value'=>set_value('telefono_celular'))); ?>
                    </div>

                    <div class="form-group">
                        <?= form_label('Correo', 'email', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'email', 'id'=>'email', 'value'=>set_value('email'))); ?>
                    </div>

                </div>

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Anticipo', 'anticipo', array('for'=>'text-input')); ?>
                        <div class="input-group">
                            <span class="input-group-addon">%</span>
                            <input class="form-control" name="anticipo" id="anticipo" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <?= form_label('Dias que da para pagar', 'dias_credito', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'number', 'name'=>'dias_credito', 'id'=>'dias_credito', 'value'=>set_value('dias_credito'))); ?>
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
            
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-actions">
                        <?= form_button(array('type'=>'button', 'content'=>'Aceptar', 'class'=>'btn btn-primary' , 'onclick' => 'form.submit()')); ?>
                        <?= anchor('unidad_valuacion/index', 'Cancelar', array('class'=>'btn')); ?>
                    </div>
            <?= form_close(); ?>
                </div>
            </div> <!-- /.row -->


        </div> <!-- /.portlet-content -->

      </div> <!-- /.portlet -->
