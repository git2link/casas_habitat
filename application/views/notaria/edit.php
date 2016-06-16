      <div class="portlet">

        <div class="portlet-header">

          <h3>
            <i class="fa fa-gavel"></i>
            Notaria
          </h3>

        </div> <!-- /.portlet-header -->
        <div class="portlet-content">
            <?= form_open('notaria/update', array('name' => 'form' , 'autocomplete' => 'off')); ?>
            <?= my_validation_errors(validation_errors()); ?>
            <?= form_hidden('notaria_k', $registro->notaria_k); ?>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Nombre de la Notaria', 'nombre', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'nombre', 'id'=>'nombre', 'value'=>$registro->nombre)); ?>
                    </div>

                    <div class="form-group">
                        <?= form_label('Nombre del Notario', 'notario_nombre', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'notario_nombre', 'id'=>'notario_nombre', 'value'=>$registro->notario_nombre )); ?>
                    </div>

                    <div class="form-group">
                        <?= form_label('Contacto', 'contacto', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'contacto', 'id'=>'contacto', 'value'=>$registro->contacto )); ?>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Telefono', 'telefono', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'telefono', 'id'=>'telefono', 'value'=>$registro->telefono )); ?>
                    </div>

                    <div class="form-group">
                        <?= form_label('Correo', 'email', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'email', 'id'=>'email', 'value'=>$registro->email)); ?>
                    </div>

                </div>

            </div>
            <hr>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Código Postal', 'codigo_postal', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'codigo_postal', 'id'=>'codigo_postal_edit', 'value'=>$registro->codigo_postal)); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                    <?php
                    $est = array();
                    foreach($estado as $esta ){
                        $est[$esta->estado_k] = $esta->nombre;
                    } 
                    ?>
                        <?= form_label('Estado', 'estado', array('for'=>'select-input')); ?>
                        <?= form_dropdown('estado_k', $est, $registro->estado_k , 'class="form-control" id="estado"'); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                    <?php
                    $mun = array();
                    foreach($municipio as $muni ){
                        $mun[$muni->municipio_k] = $muni->nombre;
                    } 
                    ?>
                        <?= form_label('Municipio', 'municipio', array('for'=>'select-input')); ?>
                        <?= form_dropdown('municipio_k', $mun, $registro->municipio_k , 'class="form-control" id="municipio" '); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                    <?php
                    $col = array();
                    foreach($colonias as $colonia ){
                        $col[$colonia->colonia_k] = $colonia->nombre;
                    } ?>
                        <?= form_label('Colonia', 'colonia', array('for'=>'select-input')); ?>
                        <?= form_dropdown('colonia_k', $col, $registro->colonia_k , 'class="form-control" id= "colonia"'); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Calle', 'calle_numero', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'calle_numero', 'id'=>'calle_numero', 'value'=>$registro->calle_numero )); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Lote', 'lote', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'lote', 'id'=>'lote', 'value'=>$registro->lote )); ?>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-actions">
                        <?= form_button(array('type'=>'button', 'content'=>'Aceptar', 'class'=>'btn btn-primary' , 'onclick' => 'form.submit()')); ?>
                        <?= anchor('notaria/index', 'Cancelar', array('class'=>'btn')); ?>
                        <?= anchor('notaria/delete/'.$registro->notaria_k, 'Eliminar', array('class'=>'btn btn-warning', 'onClick'=>"return confirm('¿Está Seguro?')")); ?>
                    </div>
            <?= form_close(); ?>
                </div>
            </div> <!-- /.row -->


        </div> <!-- /.portlet-content -->

      </div> <!-- /.portlet -->

