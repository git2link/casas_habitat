<link rel="stylesheet" type="text/css" href="../../css/autocomplete.css"/>
<div class="portlet">

        <div class="portlet-header">

          <h3>
            <i class="fa fa-user"></i>
            Usuario
          </h3>

        </div> <!-- /.portlet-header -->
        <script type="text/ng-template" id="customTemplate.html">
            <a>
                <span bind-html-unsafe="match.label | typeaheadHighlight:query"></span>
                <i>({{match.model.codigo_postal}})</i>
            </a>
        </script>
        <div class="portlet-content">
            <?= form_open('usuario/insert', array('name' => 'form' , 'autocomplete' => 'off' , 'ng-controller'=>'autocompleteController')); ?>
            <?= my_validation_errors(validation_errors()); ?>
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
                        <?= form_label('Nombre de Usuario', 'login', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'login', 'id'=>'login', 'value'=>set_value('login'))); ?>
                    </div>

                    <div class="form-group">
                        <?= form_label('Contraseña', 'password', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'password', 'name'=>'password', 'id'=>'password', 'value'=>set_value('password'))); ?>
                    </div>

                    <div class="form-group">
                        <?= form_label('Fecha de Ingreso', 'fecha_ingreso', array('for'=>'text-input')); ?>
                        <div id="dp-ex-3" class="input-group date" data-auto-close="true" data-date="2016-02-01" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
                            <input class="form-control" type="text" name="fecha_ingreso">
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
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Código Postal', 'codigo_postal', array('for'=>'text-input')); ?>

                        <input type="text" ng-model="CodigosSelecccionados" placeholder="Buscar Codigo Postal" typeahead="c as c.codigo_postal for c in codigos_postales | filter:$viewValue | limitTo:10" typeahead-min-length='1' typeahead-on-select='onSelectPart($item, $model, $label)' typeahead-template-url="customTemplate.html" class="form-control" name="codigo_postal" id="codigo_postal">

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
                        <?= form_label('Banco', 'banco', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'banco', 'id'=>'banco', 'value'=>set_value('banco'))); ?>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Cuenta', 'cuenta', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'cuenta', 'id'=>'cuenta', 'value'=>set_value('cuenta'))); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Clabe', 'clabe', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'clabe', 'id'=>'clabe', 'value'=>set_value('clabe'))); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="form-group">
                        <?= form_label('Llamar en caso de emergencia a', 'nombre_emergencia', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'nombre_emergencia', 'id'=>'nombre_emergencia', 'value'=>set_value('nombre_emergencia'))); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Teléfono de emergencia', 'telefono_emergencia', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'telefono_emergencia', 'id'=>'telefono_emergencia', 'value'=>set_value('telefono_emergencia'))); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Correo electrónico', 'email', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'email', 'name'=>'email', 'id'=>'email', 'value'=>set_value('email'))); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Correo electrónico de la empresa', 'email_empresa', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'email_empresa', 'id'=>'email_empresa', 'value'=>set_value('email_empresa'))); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Celular', 'telefono_celular', array('for'=>'text-input')); ?>
                        <?= form_input(array('class' => 'form-control','type'=>'text', 'name'=>'telefono_celular', 'id'=>'telefono_celular', 'value'=>set_value('telefono_celular'))); ?>
                    </div>
                </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= form_label('Perfil', 'perfil_id', array('for'=>'select-input')); ?>
                        <?= form_dropdown('perfil_id', $perfiles, 0 , 'class="form-control"'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="form-actions">
                        <?= form_button(array('type'=>'button', 'content'=>'Aceptar', 'class'=>'btn btn-primary' , 'onclick' => 'form.submit()')); ?>
                        <?= anchor('usuario/index', 'Cancelar', array('class'=>'btn')); ?>
                    </div>
            <?= form_close(); ?>
                </div>
            </div> <!-- /.row -->


        </div> <!-- /.portlet-content -->

      </div> <!-- /.portlet -->
