<link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="../../../css/jquery-upload/jquery.fileupload.css">
<link rel="stylesheet" href="../../../css/jquery-upload/jquery.fileupload-ui.css">
<!-- CSS adjustments for browsers with JavaScript disabled -->
<noscript><link rel="stylesheet" href="../../../css/jquery-upload/jquery.fileupload-noscript.css"></noscript>
<noscript><link rel="stylesheet" href="../../../css/jquery-upload/jquery.fileupload-ui-noscript.css"></noscript>



<link rel="stylesheet" href="../../../js/plugins/magnific/magnific-popup.css">      
      <div class="portlet">

        <div class="portlet-header">

          <h3>
            <i class="fa fa-user"></i>
            Usuario
          </h3>

        </div> <!-- /.portlet-header -->
        <div class="portlet-content">
            <?= form_open('usuario/update', array('name' => 'form' , 'autocomplete' => 'off')); ?>
            <?= my_validation_errors(validation_errors()); ?>
            <?= form_hidden('id', $registro->id); ?>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Nombre', 'nombre', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'nombre', 'id'=>'nombre', 'value'=>$registro->nombre)); ?>
                    </div>

                    <div class="form-group">
                        <?= form_label('Apellido Paterno', 'apellido_paterno', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'apellido_paterno', 'id'=>'apellido_paterno', 'value'=>$registro->apellido_paterno)); ?>
                    </div>

                    <div class="form-group">
                        <?= form_label('Apellido Materno', 'apellido_materno', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'apellido_materno', 'id'=>'apellido_materno', 'value'=>$registro->apellido_materno)); ?>
                    </div>

                    <div class="form-group">
                        <?= form_label('Fecha de Nacimiento', 'fecha_nacimiento', array('for'=>'text-input')); ?>
                        <div id="dp-ex-1" class="input-group date" data-auto-close="true" data-date="1998-02-01" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
                            <input class="form-control" type="text" name="fecha_nacimiento" value= "<?= $registro->fecha_nacimiento ?>" >
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>

                </div>

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Nombre de Usuario', 'login', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'login', 'id'=>'login', 'value'=>$registro->login ) ); ?>
                    </div>

                    <div class="form-group">
                        <?= form_label('Fecha de Ingreso', 'fecha_ingreso', array('for'=>'text-input')); ?>
                        <div id="dp-ex-3" class="input-group date" data-auto-close="true" data-date="2016-02-01" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
                            <input class="form-control" type="text" name="fecha_ingreso" value="<?= $registro->fecha_ingreso ?>">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('NSS', 'nss', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'nss', 'id'=>'nss', 'value'=>$registro->nss)); ?>
                    </div>

                    <div class="form-group">
                        <?= form_label('RFC', 'rfc', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'rfc', 'id'=>'rfc', 'value'=>$registro->rfc )); ?>
                    </div>

                    <div class="form-group">
                        <?= form_label('CURP', 'curp', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'curp', 'id'=>'curp', 'value'=>$registro->curp)); ?>
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
            <hr>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Banco', 'banco', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'banco', 'id'=>'banco', 'value'=>$registro->banco )); ?>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Cuenta', 'cuenta', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'cuenta', 'id'=>'cuenta', 'value'=>$registro->cuenta)); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Clabe', 'clabe', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'clabe', 'id'=>'clabe', 'value'=>$registro->clabe )); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="form-group">
                        <?= form_label('Llamar en caso de emergencia a', 'nombre_emergencia', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'nombre_emergencia', 'id'=>'nombre_emergencia', 'value'=>$registro->nombre_emergencia )); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Teléfono de emergencia', 'telefono_emergencia', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'telefono_emergencia', 'id'=>'telefono_emergencia', 'value'=>$registro->telefono_emergencia )); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Correo electrónico', 'email', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'email', 'name'=>'email', 'id'=>'email', 'value'=>$registro->email )); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Correo electrónico de la empresa', 'email_empresa', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'email_empresa', 'id'=>'email_empresa', 'value'=>$registro->email_empresa )); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Celular', 'telefono_celular', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'telefono_celular', 'id'=>'telefono_celular', 'value'=>$registro->telefono_celular )); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Perfil', 'perfil_id', array('for'=>'select-input')); ?>
                        <?= form_dropdown('perfil_id', $perfiles, $registro->perfil_id , 'class="form-control"'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-actions">
                        <?= form_button(array('type'=>'button', 'content'=>'Aceptar', 'class'=>'btn btn-primary' , 'onclick' => 'form.submit()')); ?>
                        <?= anchor('usuario/index', 'Cancelar', array('class'=>'btn')); ?>
                        <?= anchor('usuario/delete/'.$registro->id, 'Eliminar', array('class'=>'btn btn-warning', 'onClick'=>"return confirm('¿Está Seguro?')")); ?>
                    </div>
            <?= form_close(); ?>
                </div>
            </div> <!-- /.row -->
        </div> <!-- /.portlet-content -->

    

      </div> <!-- /.portlet -->

