
    <div class="portlet">

        <div class="portlet-header">

          <h3>
            <i class="fa fa-home"></i>
            Propuesta
          </h3>

        </div> <!-- /.portlet-header -->

        <div class="portlet-content">

            <?= form_open('casa/insertpropuesta', array('name' => 'form' , 'autocomplete' => 'off') ); ?>
            <?= my_validation_errors(validation_errors()); ?>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Pago de Contado', 'pago_contado', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'pago_contado', 'id'=>'pago_contado', 'value'=>set_value('pago_contado'))); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Precio Pactado', 'precio_pactado', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'precio_pactado', 'id'=>'precio_pactado', 'value'=>set_value('precio_pactado'))); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Anticipo', 'anticipo', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'anticipo', 'id'=>'anticipo', 'value'=>set_value('anticipo'))); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Mensualidades', 'mensualidades', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'mensualidades', 'id'=>'mensualidades', 'value'=>set_value('mensualidades'))); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Comercialización', 'comercializacion', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'comercializacion', 'id'=>'comercializacion', 'value'=>set_value('comercializacion'))); ?>
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

      