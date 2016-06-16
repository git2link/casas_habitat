
    <div class="portlet">

        <div class="portlet-header">

          <h3>
            <i class="fa fa-home"></i>
            Casa
          </h3>

        </div> <!-- /.portlet-header -->

        <div class="portlet-content">

            <?= form_open('casa/insert', array('name' => 'form' , 'autocomplete' => 'off') ); ?>
            <?= my_validation_errors(validation_errors()); ?>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Estatus para la Venta', 'estatus_venta_k', array('for'=>'select-input')); ?>
                        <?= form_dropdown('estatus_venta_k', $estatus_venta, 0 , 'class="form-control"'); ?>
                    </div>
                    <div class="form-group">
                        <?= form_label('Credito Anterior', 'credito_anterior', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'credito_anterior', 'id'=>'credito_anterior', 'value'=>set_value('credito_anterior'))); ?>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

                    <div class="form-group">
                        <?= form_label('Tipo', 'tipo_casa_k', array('for'=>'select-input')); ?>
                        <?= form_dropdown('tipo_casa_k', $tipo_casa, 0 , 'class="form-control"'); ?>
                    </div>
                    <div class="form-group">
                        <?= form_label('Paquete', 'paquete_casa_k', array('for'=>'select-input')); ?>
                        <?= form_dropdown('paquete_casa_k', $paquete_casa, 0 , 'class="form-control"'); ?>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <?= form_label('Antecedentes', 'antecedentes', array('for'=>'text-input')); ?>
                        <?= form_textarea(array('class' => 'form-control','type'=>'text', 'name'=>'antecedentes', 'id'=>'antecedentes', 'rows' => '3', 'value'=>set_value('antecedentes'))); ?>
                    </div>
                </div>
            </div>
                
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

                    <div class="form-group">
                        <?= form_label('Código Postal', 'codigo_postal', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'codigo_postal', 'id'=>'codigo_postal', 'value'=>set_value('codigo_postal'))); ?>
                    </div>

                    <div class="form-group">
                        <?= form_label('Estado', 'estado', array('for'=>'text-input')); ?>
                        <select name="estado_k" id="estado" value="<?= set_value('estado'); ?>" class="form-control">
                        </select>
                    </div>
                    

                    <div class="form-group">
                        <?= form_label('Municipio', 'municipio', array('for'=>'text-input')); ?>
                        <select name="municipio_k" id="municipio" value="<?= set_value('municipio'); ?>" class="form-control">
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

                    <div class="form-group">
                        <?= form_label('Colonia', 'colonia', array('for'=>'text-input')); ?>
                        <select name="colonia_k" id="colonia" value="<?= set_value('colonia'); ?>" class="form-control">
                        </select>
                    </div>

                    <div class="form-group">
                        <?= form_label('Calle', 'calle_numero', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'calle_numero', 'id'=>'calle_numero', 'value'=>set_value('calle_numero'))); ?>
                    </div>

                    <div class="form-group">
                        <?= form_label('Lote', 'lote', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'lote', 'id'=>'lote', 'value'=>set_value('lote'))); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Manzana', 'manzana', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'manzana', 'id'=>'manzana', 'value'=>set_value('manzana'))); ?>
                    </div>
                    
                    <div class="form-group">
                        <?= form_label('¿Esta Invadida?', 'estatus_invadida_k', array('for'=>'select-input')); ?>
                        <?= form_dropdown('estatus_invadida_k', $estatus_invadida, 0 , 'class="form-control"'); ?>
                    </div>

                    <div class="form-group">
                        <?= form_label('Tipo de Vivienda', 'tipo_vivienda_k', array('for'=>'select-input')); ?>
                        <?= form_dropdown('tipo_vivienda_k', $tipo_vivienda, 0 , 'class="form-control"'); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

                    <div class="form-group">
                        <?= form_label('Pisos/Nivel', 'pisos_nivel', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'pisos_nivel', 'id'=>'pisos_nivel', 'value'=>set_value('pisos_nivel'))); ?>
                    </div>

                    <div class="form-group">
                        <?= form_label('M2 Terreno', 'm2_terreno', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'m2_terreno', 'id'=>'m2_terreno', 'value'=>set_value('m2_terreno'))); ?>
                    </div>

                    <div class="form-group">
                        <?= form_label('M2 Construccion', 'm2_construccion', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'m2_construccion', 'id'=>'m2_construccion', 'value'=>set_value('m2_construccion'))); ?>
                    </div>

                    <div class="form-group">
                        <?= form_label('Recamaras', 'recamaras', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'recamaras', 'id'=>'recamaras', 'value'=>set_value('recamaras'))); ?>
                    </div>

                </div>

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    

                    <div class="form-group">
                        <?= form_label('Baños', 'banios', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'banios', 'id'=>'banios', 'value'=>set_value('banios'))); ?>
                    </div>

                    <div class="form-group">
                        <?= form_label('Estacionamiento', 'estacionamiento', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'number', 'name'=>'estacionamiento', 'id'=>'estacionamiento', 'value'=>set_value('estacionamiento'))); ?>
                    </div>

                    <div class="form-group">
                        <?= form_label('Precio de Venta', 'precio_venta', array('for'=>'text-input')); ?>
                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input class="form-control" name="precio_venta" id="precio_venta" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <?= form_label('Comisión de Venta', 'comision_venta', array('for'=>'text-input')); ?>
                        <div class="input-group">
                            <span class="input-group-addon">%</span>
                            <input class="form-control" name="comision_venta" id="comision_venta" type="text">
                        </div>
                    </div>

                </div>

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

                    <div class="form-group">
                        <?= form_label('Costo', 'costo', array('for'=>'text-input')); ?>
                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input class="form-control" name="costo" id="costo" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <?= form_label('Apartado', 'apartado', array('for'=>'text-input')); ?>
                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input class="form-control" name="apartado" id="apartado" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <?= form_label('Vendedor', 'id', array('for'=>'select-input')); ?>
                        <?= form_dropdown('usuario_k', $usuarios, 0 , 'class="form-control"'); ?>
                    </div>

                    <div class="form-group">
                        <?= form_label('¿Tiene Llaves?', 'llaves', array('for'=>'select-input')); ?>
                        <?= form_dropdown('llaves', $llaves, 0 , 'class="form-control"'); ?>
                    </div>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

                    <div class="form-group">
                        <?= form_label('Observaciones', 'observaciones', array('for'=>'text-input')); ?>
                        <?= form_textarea(array('class' => 'form-control','type'=>'text', 'name'=>'observaciones', 'id'=>'observaciones', 'rows' => '3', 'value'=>set_value('observaciones'))); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="form-actions">
                        <?= form_button(array('type'=>'button', 'content'=>'Aceptar', 'class'=>'btn btn-primary', 'onclick' => 'form.submit()')); ?>
                        <?= anchor('casa/index', 'Cancelar', array('class'=>'btn')); ?>
                    </div>
                    <?= form_close(); ?>
                </div>

            </div> <!-- /.row -->


        </div> <!-- /.portlet-content -->

      </div> <!-- /.portlet -->

      