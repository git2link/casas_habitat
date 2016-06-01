
    <div class="portlet">

        <div class="portlet-header">

          <h3>
            <i class="fa fa-usd"></i>
            Avaluo
          </h3>

        </div> <!-- /.portlet-header -->

        <div class="portlet-content">

            <?= form_open('avaluo/insert',!array('name' => 'form' , 'autocomplete' => 'off') ); ?>
            <?= my_validation_errors(validation_errors()); ?>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Casa', 'casa_k', array('for'=>'select-input')); ?>
                        <?= form_dropdown('casa_k', $casas, 0 , 'class="form-control"'); ?>
                    </div>
                    <div class="form-group">
                        <?= form_label('Unidad de Valuación', 'unidad_valuacion_k', array('for'=>'select-input')); ?>
                        <?= form_dropdown('unidad_valuacion_k', $unidades_valuacion, 0 , 'class="form-control"'); ?>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

                    <div class="form-group">
                        <?= form_label('Fecha de Solicitud', 'fecha_solicitud', array('for'=>'text-input')); ?>
                        <div id="dp-ex-1" class="input-group date" data-auto-close="true" data-date="<?= date('Y-m-d')?>" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
                            <input class="form-control" type="text" name="fecha_solicitud">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <?= form_label('Fecha Entrega de Avaluo', 'fecha_entrega_avaluo', array('for'=>'text-input')); ?>
                        <div id="dp-ex-2" class="input-group date" data-auto-close="true" data-date="<?= date('Y-m-d')?>" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
                            <input class="form-control" type="text" name="fecha_entrega_avaluo">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Costo', 'costo_avaluo',!array('for'=>'text-input')); ?>
                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input class="form-control" name="costo_avaluo" id="costo_avaluo" type="text">
                        </div>
                    </div>
                </div>

            </div>
            <hr>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Base', 'base', array('for'=>'text-input')); ?>
                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input class="form-control" name="base" id="base" type="text">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Hipotetico', 'hipotetico', array('for'=>'text-input')); ?>
                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input class="form-control" name="hipotetico" id="hipotetico" type="text">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Final', 'final', array('for'=>'text-input')); ?>
                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input class="form-control" name="final" id="final" type="text">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Facturado', 'facturado', array('for'=>'select-input')); ?>
                        <?= form_dropdown('facturado', $sino, 0 , 'class="form-control"'); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Pagado', 'pagado', array('for'=>'select-input')); ?>
                        <?= form_dropdown('pagado', $sino, 0 , 'class="form-control"'); ?>
                    </div>
                </div>
            </div>
                
            
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="form-actions">
                        <?= form_button(array('type'=>'button', 'content'=>'Aceptar', 'class'=>'btn btn-primary', 'ooclick' => 'form.submit()')); ?>
                        <?= anchor('avaluo/index/', 'Cancelar', array('class'=>'btn')); ?>
                    </div>
                    <?= form_close(); ?>
                </div>

            </div> <!-- /.row -->


        </div> <!-- /.portlet-content -->

      </div> <!-- /.portlet -->

      