<div class="page-header">
    <h1> <?= $clave_interna ?> <small> checklist </small> </h1> 
    <div class="pull-left table_functions_left">
        <a href="<?=base_url('servicio/vender')?>" class="btn btn-danger btn-sm" title="Regresar">
            <i class="fa fa-arrow-left"></i>
        </a>
        <button id="btn_save_checklist_0" class="btn btn-success btn-sm" title="Guardar cambios"> 
            <i class="fa fa-floppy-o "></i>
        </button>

  </div>
  <div class="pull-right table_functions_right">
  </div>
</div>
<br>
<link rel="stylesheet" href="../../../css/fileinput/fileinput.min.css">
    <form id="form_checklist">
        <div class="portlet">
            <div class="portlet-header">

              <h3>
                <i class="fa fa-home"></i>
                Checklist 
              </h3>

            </div> <!-- /.portlet-header -->

            <div class="portlet-content">

                <div class="row">

                <div class="col-md-3 col-sm-5">
              
                  <ul id="myTab" class="nav nav-pills nav-stacked">
                    <li class="active">
                        <a id="progress_bar_0" href="#checklist_0" data-toggle="tab">
                        </a>
                      </li>
                      <li class="">
                        <a id="progress_bar_1" href="#checklist_1" data-toggle="tab">
                        </a>
                      </li>
                      <li class="">
                        <a id="progress_bar_2" href="#checklist_2" data-toggle="tab">
                        </a>
                      </li>
                    </ul>
                </div> 

                <div class="col-md-9 col-sm-7">

                    <div id="myTabContent" class="tab-content stacked-content">
                        <div class="tab-pane fade in active" id="checklist_0">
                            <div class="form-group" >
                                <div class="col-md-12" >
                                    <label>Asesor</label>
                                    <select name="usuario_k" class="form-control" id="asesor">
                                        <option id="asesor_0" value="0">Seleccione una opcion</option>
                                        <?php foreach ($adviser as $key => $value): ?>
                                            <option id="asesor_<?= $value['id'] ?>" value="<?= $value['id'] ?>"><?= $value['name'] ?></option>    
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group" >
                                <div class="col-md-12" >
                                    <br>
                                    <label>Notaria</label>
                                    <select name="notaria_k" class="form-control" id="notaria">
                                        <option id="notaria_0" value="0">Seleccione una opcion</option>
                                        <?php foreach ($notaria as $key => $value): ?>
                                            <option id="notaria_<?= $value['notaria_k'] ?>" value="<?= $value['notaria_k'] ?>"><?= $value['nombre'] ?></option>    
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group" >
                                <div class="col-md-6" >
                                    <br>
                                    <label>Precio de compra final</label>
                                    <input id="precio_compra_final" name="precio_compra_final" class="form-control">
                                </div>
                                <div class="col-md-6" >
                                    <br>
                                    <label>Precio de venta final</label>
                                    <input  id="precio_venta_final" name="precio_venta_final" class="form-control">
                                </div>
                            </div>

                            <div class="form-group" >

                                <div class="col-md-4">
                                    <br>
                                    <label>Presupuesto Mejoras</label>
                                </div>
                                    
                                <div class="col-md-4">
                                    <br>
                                    <label class="radio-inline">
                                        <input type="radio" name="presupuesto_mejoras" area="checklist_0" value="1"> Si
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="presupuesto_mejoras" area="checklist_0" value="2" checked> No
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="presupuesto_mejoras" area="checklist_0" value="3"> N/A
                                    </label>
                                </div>
                                
                                <div class="col-md-4">
                                    <br>
                                    <a data-toggle="modal" href="#modal_description" class="btn btn-xs btn-secondary btn_description" reference="presupuesto_mejoras" title="Descripción"><i class="fa fa-align-justify"></i></a>
                                    <a data-toggle="modal" href="#modal_upload" class="btn btn-xs btn-success btn_upload_1" reference="presupuesto_mejoras"><i class="fa fa-upload" title="Cargar documento"></i></a>
                                    <!--<button class="btn btn-sm btn-default"><i class="fa fa-times"></i></button>-->
                                    <a data-toggle="modal" href="#modal_pdf" class="btn btn-sm btn-default a_file" reference="presupuesto_mejoras" disabled>Documento no cargado</a>
                                </div>    
                            </div>
                            
                            <div class="form-group" >

                                <div class="col-md-4">
                                    <br>
                                    <label>Revisión legal</label>
                                </div>
                                    
                                <div class="col-md-4">
                                    <br>
                                    <label class="radio-inline">
                                        <input type="radio" name="revision_legal" area="checklist_0" value="1"> Si
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="revision_legal" area="checklist_0" value="2" checked> No
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="revision_legal" area="checklist_0" value="3"> N/A
                                    </label>
                                </div>

                                <div class="col-md-4">
                                    <br>
                                    <a data-toggle="modal" href="#modal_description" class="btn btn-xs btn-secondary btn_description" reference="revision_legal" title="Descripción"><i class="fa fa-align-justify"></i></a>
                                    <a data-toggle="modal" href="#modal_upload" class="btn btn-xs btn-success btn_upload_1" reference="revision_legal"><i class="fa fa-upload" title="Cargar documento"></i></a>
                                    <!--<button class="btn btn-sm btn-default"><i class="fa fa-times"></i></button>-->
                                    <a data-toggle="modal" href="#modal_pdf" class="btn btn-sm btn-default a_file" reference="revision_legal" disabled>Documento no cargado</a>
                                </div>    
                            
                            </div>
                            
                            <div class="form-group" >

                                <div class="col-md-4">
                                    <br>
                                    <label>Contrato casas habitat</label>
                                </div>
                                    
                                <div class="col-md-4">
                                    <br>
                                    <label class="radio-inline">
                                        <input type="radio" name="contrato_casas_habitat" area="checklist_0" value="1"> Si
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="contrato_casas_habitat" area="checklist_0" value="2" checked> No
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="contrato_casas_habitat" area="checklist_0" value="3"> N/A
                                    </label>
                                </div>

                                
                                <div class="col-md-4">
                                    <br>
                                    <a data-toggle="modal" href="#modal_description" class="btn btn-xs btn-secondary btn_description" reference="contrato_casas_habitat" title="Descripción"><i class="fa fa-align-justify"></i></a>
                                    <a data-toggle="modal" href="#modal_upload" class="btn btn-xs btn-success btn_upload_1" reference="contrato_casas_habitat"><i class="fa fa-upload" title="Cargar documento"></i></a>
                                    <!--<button class="btn btn-sm btn-default"><i class="fa fa-times"></i></button>-->
                                    <a data-toggle="modal" href="#modal_pdf" class="btn btn-sm btn-default a_file" reference="contrato_casas_habitat" disabled>Documento no cargado</a>
                                </div>            
                            </div>

                            <div class="form-group" >                 
                                <div class="col-md-12" >
                                    <br>
                                    <label>Observaciones</label>
                                    <textarea id="observaciones" name="observaciones" class="form-control" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="form-group" >
                                <div class="col-md-12" >
                                    <br>
                                    <label>Reviso</label>
                                    <select name="usuario_modificacion" class="form-control" id="asesor">
                                        <?php if (count($user)>0): ?>
                                            <?php foreach ($user as $key => $value): ?>
                                                <option id="asesor_<?= $value['id'] ?>" value="<?= $value['id'] ?>"><?= $value['name'] ?></option>    
                                            <?php endforeach ?>
                                        <?php else: ?>
                                            <?php foreach ($currentuser as $key => $value): ?>
                                                <option id="asesor_<?= $value['id'] ?>" value="<?= $value['id'] ?>"><?= $value['name'] ?></option>    
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group" >
                                <div class="col-md-12" >
                                    <br>
                                    <label>Fecha</label>
                                    <input name="fecha_hora_modificacion" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" name="algo" id="checklist_1">

                            <div class="form-group" >
                                
                                <div class="col-md-4">
                                    <label>Hoja de presupuesto</label>
                                </div>
                                    
                                <div class="col-md-4">
                                    <label class="radio-inline">
                                        <input type="radio" name="hoja_presupuesto" area="checklist_1" value="1"> Si
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="hoja_presupuesto" area="checklist_1" value="2" checked> No
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="hoja_presupuesto" area="checklist_1" value="3"> N/A
                                    </label>
                                </div>

                                <div class="col-md-4">
                                    <a data-toggle="modal" href="#modal_description" class="btn btn-xs btn-secondary btn_description" reference="hoja_presupuesto" title="Descripción"><i class="fa fa-align-justify"></i></a>
                                    <a data-toggle="modal" href="#modal_upload" class="btn btn-xs btn-success btn_upload_2" reference="hoja_presupuesto"><i class="fa fa-upload" title="Cargar documento"></i></a>
                                    <!--<button class="btn btn-sm btn-default"><i class="fa fa-times"></i></button>-->
                                    <a data-toggle="modal" href="#modal_pdf" class="btn btn-sm btn-default a_file" reference="hoja_presupuesto" disabled>Documento no cargado</a>
                                </div>    
                            
                            </div>
                            
                            <div class="form-group" >
                                <div class="col-md-4">
                                    <br>
                                    <label>Carta propuesta</label>
                                </div>
                                    
                                <div class="col-md-4">
                                    <br>
                                    <label class="radio-inline">
                                        <input type="radio" name="carta_propuesta" area="checklist_1" value="1"> Si
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="carta_propuesta" area="checklist_1" value="2" checked> No
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="carta_propuesta" area="checklist_1" value="3"> N/A
                                    </label>
                                </div>
                            
                                <div class="col-md-4">
                                    <br>
                                    <a data-toggle="modal" href="#modal_description" class="btn btn-xs btn-secondary btn_description" reference="carta_propuesta" title="Descripción"><i class="fa fa-align-justify"></i></a>
                                    <a data-toggle="modal" href="#modal_upload" class="btn btn-xs btn-success btn_upload_2" reference="carta_propuesta"><i class="fa fa-upload" title="Cargar documento"></i></a>
                                    <!--<button class="btn btn-sm btn-default"><i class="fa fa-times"></i></button>-->
                                    <a data-toggle="modal" href="#modal_pdf" class="btn btn-sm btn-default a_file" reference="carta_propuesta" disabled>Documento no cargado</a>
                                </div>    
                            
                            </div>
                            
                            <div class="form-group" >
                                <div class="col-md-4">
                                    <br>
                                    <label>Título de propiedad</label>
                                </div>
                                    
                                <div class="col-md-4">
                                    <br>
                                    <label class="radio-inline">
                                        <input type="radio" name="titulo_propiedad" area="checklist_1" value="1"> Si
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="titulo_propiedad" area="checklist_1" value="2" checked> No
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="titulo_propiedad" area="checklist_1" value="3"> N/A
                                    </label>
                                </div>

                                <div class="col-md-4">
                                    <br>
                                    <a data-toggle="modal" href="#modal_description" class="btn btn-xs btn-secondary btn_description" reference="titulo_propiedad" title="Descripción"><i class="fa fa-align-justify"></i></a>
                                    <a data-toggle="modal" href="#modal_upload" class="btn btn-xs btn-success btn_upload_2" reference="titulo_propiedad"><i class="fa fa-upload" title="Cargar documento"></i></a>
                                    <!--<button class="btn btn-sm btn-default"><i class="fa fa-times"></i></button>-->
                                    <a data-toggle="modal" href="#modal_pdf" class="btn btn-sm btn-default a_file" reference="titulo_propiedad" disabled>Documento no cargado</a>
                                </div>    
                            
                            </div>
                            
                            <div class="form-group" >

                                <div class="col-md-4">
                                    <br>
                                    <label>Registro publico de la propiedad</label>
                                </div>
                                    
                                <div class="col-md-4">
                                    <br>
                                    <label class="radio-inline">
                                        <input type="radio" name="registro_publico" area="checklist_1" value="1"> Si
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="registro_publico" area="checklist_1" value="2" checked> No
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="registro_publico" area="checklist_1" value="3"> N/A
                                    </label>
                                </div>
                                
                                <div class="col-md-4">
                                    <br>
                                    <a data-toggle="modal" href="#modal_description" class="btn btn-xs btn-secondary btn_description" reference="registro_publico" title="Descripción"><i class="fa fa-align-justify"></i></a>
                                    <a data-toggle="modal" href="#modal_upload" class="btn btn-xs btn-success btn_upload_2" reference="registro_publico"><i class="fa fa-upload" title="Cargar documento"></i></a>
                                    <!--<button class="btn btn-sm btn-default"><i class="fa fa-times"></i></button>-->
                                    <a data-toggle="modal" href="#modal_pdf" class="btn btn-sm btn-default a_file" reference="registro_publico" disabled>Documento no cargado</a>
                                </div>    
                            
                            </div>
                            
                            <div class="form-group" >

                                <div class="col-md-4">
                                    <br>
                                    <label>Calculo ISR</label>
                                </div>
                                    
                                <div class="col-md-4">
                                    <br>
                                    <label class="radio-inline">
                                        <input type="radio" name="calculo_isr" area="checklist_1" value="1"> Si
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="calculo_isr" area="checklist_1" value="2" checked> No
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="calculo_isr" area="checklist_1" value="3"> N/A
                                    </label>
                                </div>

                                <div class="col-md-4">
                                    <br>
                                    <a data-toggle="modal" href="#modal_description" class="btn btn-xs btn-secondary btn_description" reference="calculo_isr" title="Descripción"><i class="fa fa-align-justify"></i></a>
                                    <a data-toggle="modal" href="#modal_upload" class="btn btn-xs btn-success btn_upload_2" reference="calculo_isr"><i class="fa fa-upload" title="Cargar documento"></i></a>
                                    <!--<button class="btn btn-sm btn-default"><i class="fa fa-times"></i></button>-->
                                    <a data-toggle="modal" href="#modal_pdf" class="btn btn-sm btn-default a_file" reference="calculo_isr" disabled>Documento no cargado</a>
                                </div>    
                            
                            </div>
                            
                            <div class="form-group" >

                                <div class="col-md-4">
                                    <br>
                                    <label>Poder notarial</label>
                                </div>
                                    
                                <div class="col-md-4">
                                    <br>
                                    <label class="radio-inline">
                                        <input type="radio" name="poder_notarial" area="checklist_1" value="1"> Si
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="poder_notarial" area="checklist_1" value="2" checked> No
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="poder_notarial" area="checklist_1" value="3"> N/A
                                    </label>
                                </div>
                                <div class="col-md-4">
                                    <br>
                                    <a data-toggle="modal" href="#modal_description" class="btn btn-xs btn-secondary btn_description" reference="poder_notarial" title="Descripción"><i class="fa fa-align-justify"></i></a>
                                    <a data-toggle="modal" href="#modal_upload" class="btn btn-xs btn-success btn_upload_2" reference="poder_notarial"><i class="fa fa-upload" title="Cargar documento"></i></a>
                                    <!--<button class="btn btn-sm btn-default"><i class="fa fa-times"></i></button>-->
                                    <a data-toggle="modal" href="#modal_pdf" class="btn btn-sm btn-default a_file" reference="poder_notarial" disabled>Documento no cargado</a>
                                </div>    
                            
                            </div>
                            
                            <div class="form-group" >

                                <div class="col-md-4">
                                    <br>
                                    <label>Cancelación de la hipoteca</label>
                                </div>
                                    
                                <div class="col-md-4">
                                    <br>
                                    <label class="radio-inline">
                                        <input type="radio" name="cancelacion_hipoteca" area="checklist_1" value="1"> Si
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="cancelacion_hipoteca" area="checklist_1" value="2" checked> No
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="cancelacion_hipoteca" area="checklist_1" value="3"> N/A
                                    </label>
                                </div>

                                <div class="col-md-4">
                                    <br>
                                    <a data-toggle="modal" href="#modal_description" class="btn btn-xs btn-secondary btn_description" reference="cancelacion_hipoteca" title="Descripción"><i class="fa fa-align-justify"></i></a>
                                    <a data-toggle="modal" href="#modal_upload" class="btn btn-xs btn-success btn_upload_2" reference="cancelacion_hipoteca"><i class="fa fa-upload" title="Cargar documento"></i></a>
                                    <!--<button class="btn btn-sm btn-default"><i class="fa fa-times"></i></button>-->
                                    <a data-toggle="modal" href="#modal_pdf" class="btn btn-sm btn-default a_file" reference="cancelacion_hipoteca" disabled>Documento no cargado</a>
                                </div>    
                            
                            </div>
                            
                            <div class="form-group" >

                                <div class="col-md-4">
                                    <br>
                                    <label>Adeudo hipoteca</label>
                                </div>
                                    
                                <div class="col-md-4">
                                    <br>
                                    <label class="radio-inline">
                                        <input type="radio" name="adeudo_hipoteca" area="checklist_1" value="1"> Si
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="adeudo_hipoteca" area="checklist_1" value="2" checked> No
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="adeudo_hipoteca" area="checklist_1" value="3"> N/A
                                    </label>
                                </div>
                                
                                <div class="col-md-4">
                                    <br>
                                    <a data-toggle="modal" href="#modal_description" class="btn btn-xs btn-secondary btn_description" reference="adeudo_hipoteca" title="Descripción"><i class="fa fa-align-justify"></i></a>
                                    <a data-toggle="modal" href="#modal_upload" class="btn btn-xs btn-success btn_upload_2" reference="adeudo_hipoteca"><i class="fa fa-upload" title="Cargar documento"></i></a>
                                    <!--<button class="btn btn-sm btn-default"><i class="fa fa-times"></i></button>-->
                                    <a data-toggle="modal" href="#modal_pdf" class="btn btn-sm btn-default a_file" reference="adeudo_hipoteca" disabled>Documento no cargado</a>
                                </div>    
                            
                            </div>
                            
                            <div class="form-group" >

                                <div class="col-md-4">
                                    <br>
                                    <label>Instrucion cancelación hipoteca</label>
                                </div>
                                    
                                <div class="col-md-4">
                                    <br>
                                    <label class="radio-inline">
                                        <input type="radio" name="instruccion_cancelacion_hipoteca" area="checklist_1" value="1"> Si
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="instruccion_cancelacion_hipoteca" area="checklist_1" value="2" checked> No
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="instruccion_cancelacion_hipoteca" area="checklist_1" value="3"> N/A
                                    </label>
                                </div>   
                                
                                <div class="col-md-4">
                                    <br>
                                    <a data-toggle="modal" href="#modal_description" class="btn btn-xs btn-secondary btn_description" reference="instruccion_cancelacion_hipoteca" title="Descripción"><i class="fa fa-align-justify"></i></a>
                                    <a data-toggle="modal" href="#modal_upload" class="btn btn-xs btn-success btn_upload_2" reference="instruccion_cancelacion_hipoteca"><i class="fa fa-upload" title="Cargar documento"></i></a>
                                    <!--<button class="btn btn-sm btn-default"><i class="fa fa-times"></i></button>-->
                                    <a data-toggle="modal" href="#modal_pdf" class="btn btn-sm btn-default a_file" reference="instruccion_cancelacion_hipoteca" disabled>Documento no cargado</a>
                                </div>    
                            
                            </div>
                            
                            <div class="form-group" >

                                <div class="col-md-4">
                                    <br>
                                    <label>Escritura adicional</label>
                                </div>
                                    
                                <div class="col-md-4">
                                    <br>
                                    <label class="radio-inline">
                                        <input type="radio" name="escritura_adicional" area="checklist_1" value="1"> Si
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="escritura_adicional" area="checklist_1" value="2" checked> No
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="escritura_adicional" area="checklist_1" value="3"> N/A
                                    </label>
                                </div>
                                
                                <div class="col-md-4">
                                    <br>
                                    <a data-toggle="modal" href="#modal_description" class="btn btn-xs btn-secondary btn_description" reference="escritura_adicional" title="Descripción"><i class="fa fa-align-justify"></i></a>
                                    <a data-toggle="modal" href="#modal_upload" class="btn btn-xs btn-success btn_upload_2" reference="escritura_adicional"><i class="fa fa-upload" title="Cargar documento"></i></a>
                                    <!--<button class="btn btn-sm btn-default"><i class="fa fa-times"></i></button>-->
                                    <a data-toggle="modal" href="#modal_pdf" class="btn btn-sm btn-default a_file" reference="escritura_adicional" disabled>Documento no cargado</a>
                                </div>    
                            
                            </div>

                            <div class="form-group" >

                                <div class="col-md-4">
                                    <br>
                                    <label>Boleta predio</label>
                                </div>
                                    
                                <div class="col-md-4">
                                    <br>
                                    <label class="radio-inline">
                                        <input type="radio" name="boleta_predio" area="checklist_1" value="1"> Si
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="boleta_predio" area="checklist_1" value="2" checked> No
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="boleta_predio" area="checklist_1" value="3"> N/A
                                    </label>
                                </div>
                                
                                <div class="col-md-4">
                                    <br>
                                    <a data-toggle="modal" href="#modal_description" class="btn btn-xs btn-secondary btn_description" reference="boleta_predio" title="Descripción"><i class="fa fa-align-justify"></i></a>
                                    <a data-toggle="modal" href="#modal_upload" class="btn btn-xs btn-success btn_upload_2" reference="boleta_predio"><i class="fa fa-upload" title="Cargar documento"></i></a>
                                    <!--<button class="btn btn-sm btn-default"><i class="fa fa-times"></i></button>-->
                                    <a data-toggle="modal" href="#modal_pdf" class="btn btn-sm btn-default a_file" reference="boleta_predio" disabled>Documento no cargado</a>
                                </div>    
                            
                            </div>
                            
                            <div class="form-group" >

                                <div class="col-md-4">
                                    <br>
                                    <label>Boleta agua</label>
                                </div>
                                    
                                <div class="col-md-4">
                                    <br>
                                    <label class="radio-inline">
                                        <input type="radio" name="boleta_agua" area="checklist_1" value="1"> Si
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="boleta_agua" area="checklist_1" value="2" checked> No
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="boleta_agua" area="checklist_1" value="3"> N/A
                                    </label>
                                </div>

                                <div class="col-md-4">
                                    <br>
                                    <a data-toggle="modal" href="#modal_description" class="btn btn-xs btn-secondary btn_description" reference="boleta_agua" title="Descripción"><i class="fa fa-align-justify"></i></a>
                                    <a data-toggle="modal" href="#modal_upload" class="btn btn-xs btn-success btn_upload_2" reference="boleta_agua"><i class="fa fa-upload" title="Cargar documento"></i></a>
                                    <!--<button class="btn btn-sm btn-default"><i class="fa fa-times"></i></button>-->
                                    <a data-toggle="modal" href="#modal_pdf" class="btn btn-sm btn-default a_file" reference="boleta_agua" disabled>Documento no cargado</a>
                                </div>    
                            
                            </div>
                            
                            <div class="form-group" >

                                <div class="col-md-4">
                                    <br>
                                    <label>Recibo luz</label>
                                </div>
                                    
                                <div class="col-md-4">
                                    <br>
                                    <label class="radio-inline">
                                        <input type="radio" name="recibo_luz" area="checklist_1" value="1"> Si
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="recibo_luz" area="checklist_1" value="2" checked> No
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="recibo_luz" area="checklist_1" value="3"> N/A
                                    </label>
                                </div>
                                
                                <div class="col-md-4">
                                    <br>
                                    <a data-toggle="modal" href="#modal_description" class="btn btn-xs btn-secondary btn_description" reference="recibo_luz" title="Descripción"><i class="fa fa-align-justify"></i></a>
                                    <a data-toggle="modal" href="#modal_upload" class="btn btn-xs btn-success btn_upload_2" reference="recibo_luz"><i class="fa fa-upload" title="Cargar documento"></i></a>
                                    <!--<button class="btn btn-sm btn-default"><i class="fa fa-times"></i></button>-->
                                    <a data-toggle="modal" href="#modal_pdf" class="btn btn-sm btn-default a_file" reference="recibo_luz" disabled>Documento no cargado</a>
                                </div>    
                            
                            </div>
                            
                            <div class="form-group" >

                                <div class="col-md-4">
                                    <br>
                                    <label>Otros</label>
                                </div>
                                    
                                <div class="col-md-4">
                                    <br>
                                    <label class="radio-inline">
                                        <input type="radio" name="otros" area="checklist_1" value="1"> Si
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="otros" area="checklist_1" value="2" checked> No
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="otros" area="checklist_1" value="3"> N/A
                                    </label>
                                </div>

                                <div class="col-md-4">
                                    <br>
                                    <a data-toggle="modal" href="#modal_description" class="btn btn-xs btn-secondary btn_description" reference="otros" title="Descripción"><i class="fa fa-align-justify"></i></a>
                                    <a data-toggle="modal" href="#modal_upload" class="btn btn-xs btn-success btn_upload_2" reference="otros"><i class="fa fa-upload" title="Cargar documento"></i></a>
                                    <!--<button class="btn btn-sm btn-default"><i class="fa fa-times"></i></button>-->
                                    <a data-toggle="modal" href="#modal_pdf" class="btn btn-sm btn-default a_file" reference="otros" disabled>Documento no cargado</a>
                                </div>    
                            
                            </div>
                        </div>  
                        <div class="tab-pane fade" id="checklist_2">
                         
                            <div class="form-group" >

                                <div class="col-md-4">
                                    <br>
                                    <label>Acta de nacimiento</label>
                                </div>
                                    
                                <div class="col-md-4">
                                    <br>
                                    <label class="radio-inline">
                                        <input type="radio" name="acta_nacimiento" area="checklist_2" value="1"> Si
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="acta_nacimiento" area="checklist_2" value="2" checked> No
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="acta_nacimiento" area="checklist_2" value="3"> N/A
                                    </label>
                                </div>
                                
                                <div class="col-md-4">
                                    <br>
                                    <a data-toggle="modal" href="#modal_description" class="btn btn-xs btn-secondary btn_description" reference="acta_nacimiento" title="Descripción"><i class="fa fa-align-justify"></i></a>
                                    <a data-toggle="modal" href="#modal_upload" class="btn btn-xs btn-success btn_upload_3" reference="acta_nacimiento"><i class="fa fa-upload" title="Cargar documento"></i></a>
                                    <!--<button class="btn btn-sm btn-default"><i class="fa fa-times"></i></button>-->
                                    <a data-toggle="modal" href="#modal_pdf" class="btn btn-sm btn-default a_file" reference="acta_nacimiento" disabled>Documento no cargado</a>
                                </div>    
                            
                            </div>
                            
                            <div class="form-group" >

                                <div class="col-md-4">
                                    <br>
                                    <label>INE</label>
                                </div>
                                    
                                <div class="col-md-4">
                                    <br>
                                    <label class="radio-inline">
                                        <input type="radio" name="ine" area="checklist_2" value="1"> Si
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="ine" area="checklist_2" value="2" checked> No
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="ine" area="checklist_2" value="3"> N/A
                                    </label>
                                </div>

                                <div class="col-md-4">
                                    <br>
                                    <a data-toggle="modal" href="#modal_description" class="btn btn-xs btn-secondary btn_description" reference="ine" title="Descripción"><i class="fa fa-align-justify"></i></a>
                                    <a data-toggle="modal" href="#modal_upload" class="btn btn-xs btn-success btn_upload_3" reference="ine"><i class="fa fa-upload" title="Cargar documento"></i></a>
                                    <!--<button class="btn btn-sm btn-default"><i class="fa fa-times"></i></button>-->
                                    <a data-toggle="modal" href="#modal_pdf" class="btn btn-sm btn-default a_file" reference="ine" disabled>Documento no cargado</a>
                                </div>    
                            
                            </div>
                            
                            <div class="form-group" >

                                <div class="col-md-4">
                                    <br>
                                    <label>CURP</label>
                                </div>
                                    
                                <div class="col-md-4">
                                    <br>
                                    <label class="radio-inline">
                                        <input type="radio" name="curp" area="checklist_2" value="1"> Si
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="curp" area="checklist_2" value="2" checked> No
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="curp" area="checklist_2" value="3"> N/A
                                    </label>
                                </div>
                                
                                <div class="col-md-4">
                                    <br>
                                    <a data-toggle="modal" href="#modal_description" class="btn btn-xs btn-secondary btn_description" reference="curp" title="Descripción"><i class="fa fa-align-justify"></i></a>
                                    <a data-toggle="modal" href="#modal_upload" class="btn btn-xs btn-success btn_upload_3" reference="curp"><i class="fa fa-upload" title="Cargar documento"></i></a>
                                    <!--<button class="btn btn-sm btn-default"><i class="fa fa-times"></i></button>-->
                                    <a data-toggle="modal" href="#modal_pdf" class="btn btn-sm btn-default a_file" reference="curp" disabled>Documento no cargado</a>
                                </div>    
                            
                            </div>
                            
                            <div class="form-group" >

                                <div class="col-md-4">
                                    <br>
                                    <label>RFC</label>
                                </div>
                                    
                                <div class="col-md-4">
                                    <br>
                                    <label class="radio-inline">
                                        <input type="radio" name="rfc" area="checklist_2" value="1"> Si
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="rfc" area="checklist_2" value="2" checked> No
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="rfc" area="checklist_2" value="3"> N/A
                                    </label>
                                </div>

                                <div class="col-md-4">
                                    <br>
                                    <a data-toggle="modal" href="#modal_description" class="btn btn-xs btn-secondary btn_description" reference="rfc" title="Descripción"><i class="fa fa-align-justify"></i></a>
                                    <a data-toggle="modal" href="#modal_upload" class="btn btn-xs btn-success btn_upload_3" reference="rfc"><i class="fa fa-upload" title="Cargar documento"></i></a>
                                    <!--<button class="btn btn-sm btn-default"><i class="fa fa-times"></i></button>-->
                                    <a data-toggle="modal" href="#modal_pdf" class="btn btn-sm btn-default a_file" reference="rfc" disabled>Documento no cargado</a>
                                </div>    
                            
                            </div>
                            
                            <div class="form-group" >

                                <div class="col-md-4">
                                    <br>
                                    <label>Acta de matrimonio</label>
                                </div>
                                    
                                <div class="col-md-4">
                                    <br>
                                    <label class="radio-inline">
                                        <input type="radio" name="acta_matrimonio" area="checklist_2" value="1"> Si
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="acta_matrimonio" area="checklist_2" value="2" checked> No
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="acta_matrimonio" area="checklist_2" value="3"> N/A
                                    </label>
                                </div>
                                
                                <div class="col-md-4">
                                    <br>
                                    <a data-toggle="modal" href="#modal_description" class="btn btn-xs btn-secondary btn_description" reference="acta_matrimonio" title="Descripción"><i class="fa fa-align-justify"></i></a>
                                    <a data-toggle="modal" href="#modal_upload" class="btn btn-xs btn-success btn_upload_3" reference="acta_matrimonio"><i class="fa fa-upload" title="Cargar documento"></i></a>
                                    <!--<button class="btn btn-sm btn-default"><i class="fa fa-times"></i></button>-->
                                    <a data-toggle="modal" href="#modal_pdf" class="btn btn-sm btn-default a_file" reference="acta_matrimonio" disabled>Documento no cargado</a>
                                </div>    
                            
                            </div>
                            
                            <div class="form-group" >

                                <div class="col-md-4">
                                    <br>
                                    <label>Generales de conyuge</label>
                                </div>
                                    
                                <div class="col-md-4">
                                    <br>
                                    <label class="radio-inline">
                                        <input type="radio" name="generales_conyuge" area="checklist_2" value="1"> Si
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="generales_conyuge" area="checklist_2" value="2" checked> No
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="generales_conyuge" area="checklist_2" value="3"> N/A
                                    </label>
                                </div>


                                <div class="col-md-4">
                                    <br>
                                    <a data-toggle="modal" href="#modal_description" class="btn btn-xs btn-secondary btn_description" reference="generales_conyuge" title="Descripción"><i class="fa fa-align-justify"></i></a>
                                    <a data-toggle="modal" href="#modal_upload" class="btn btn-xs btn-success btn_upload_3" reference="generales_conyuge"><i class="fa fa-upload" title="Cargar documento"></i></a>
                                    <!--<button class="btn btn-sm btn-default"><i class="fa fa-times"></i></button>-->
                                    <a data-toggle="modal" href="#modal_pdf" class="btn btn-sm btn-default a_file" reference="generales_conyuge" disableddisabled>Documento no cargado</a>
                                </div>    
                            
                            </div>
  
                        </div>
                    </div>

                </div> 

            </div> 

            </div>
        </div>
        <input name="casa_k" value="<?= $casa_k ?>" hidden>
        
    </form>

    <script type="text/javascript">
        var checklist_1 = 0;
        var checklist_2 = 0;
        var checklist_3 = 0;

        <?php foreach ($checklistfiles_habitat as $registro): ?>
            <?php foreach ($registro as $ind => $value): ?>
                $('#form_checklist input:radio').each(function(i){
                    var rd_value    =  $(this).val();
                    var rd_name     =  $(this).attr('name');
                    var chk_val     = '<?php if(isset($checklist[0][$ind])){ print $checklist[0][$ind];} ?>';
                    var desc_val    = '<?php if(isset($checklist_description[0][$ind])){ print $checklist_description[0][$ind];} ?>';
                    if( rd_name == '<?=$ind?>'){
                        if ( rd_value == chk_val ) {
                            if (desc_val.trim() != '') {
                                $('.btn_description').each(function(i){
                                    if ($(this).attr('reference') == rd_name) {
                                        $(this).attr('description', desc_val);
                                    }
                                });
                            }
                            $(this).prop( 'checked' , true );
                            if (chk_val == 1  && '<?=$value?>' != '') {
                                $('.a_file').each(function(i){
                                    if($(this).attr('reference') == rd_name){
                                        $(this).attr( "disabled", false );
                                        $(this).html( "Documento cargado");
                                    }
                                });
                                checklist_1 += 1;
                            }else if(chk_val == 3){
                                checklist_1 += 1;
                            }
                        }
                    }
                });
            <?php endforeach ?>
        <?php endforeach ?>
        
        <?php foreach ($checklistfiles_casa as $registro): ?>
            <?php foreach ($registro as $ind => $value): ?>
                 $('#form_checklist input:radio').each(function(i){
                    var rd_value    =  $(this).val();
                    var rd_name     =  $(this).attr('name');
                    var chk_val     = '<?php if(isset($checklist[0][$ind])){ print $checklist[0][$ind];} ?>';
                    var desc_val    = '<?php if(isset($checklist_description[0][$ind])){ print $checklist_description[0][$ind];} ?>';
                    if( rd_name == '<?=$ind?>'){
                        if ( rd_value == chk_val ) {
                            if (desc_val.trim() != '') {
                                $('.btn_description').each(function(i){
                                    if ($(this).attr('reference') == rd_name) {
                                        $(this).attr('description', desc_val);
                                    }
                                });
                            }
                            $(this).prop( 'checked' , true );
                            if (chk_val == 1  && '<?=$value?>' != '') {
                                $('.a_file').each(function(i){
                                    if($(this).attr('reference') == rd_name){
                                        $(this).attr( "disabled", false );
                                        $(this).html( "Documento cargado");
                                    }
                                });
                                checklist_2 += 1;
                            }else if(chk_val == 3){
                                checklist_2 += 1;
                            }
                        }
                    }
                });
            <?php endforeach ?>
        <?php endforeach ?>

        <?php foreach ($checklistfiles_personales as $registro): ?>
            <?php foreach ($registro as $ind => $value): ?>
                 $('#form_checklist input:radio').each(function(i){
                    var rd_value    =  $(this).val();
                    var rd_name     =  $(this).attr('name');
                    var chk_val     = '<?php if(isset($checklist[0][$ind])){ print $checklist[0][$ind];} ?>';
                    var desc_val    = '<?php if(isset($checklist_description[0][$ind])){ print $checklist_description[0][$ind];} ?>';
                    if( rd_name == '<?=$ind?>'){
                        if ( rd_value == chk_val ) {
                            if (desc_val.trim() != '') {
                                $('.btn_description').each(function(i){
                                    if ($(this).attr('reference') == rd_name) {
                                        $(this).attr('description', desc_val);
                                    }
                                });
                            }
                            $(this).prop( 'checked' , true );
                            if (chk_val == 1  && '<?=$value?>' != '') {
                                $('.a_file').each(function(i){
                                    if($(this).attr('reference') == rd_name){
                                        $(this).attr( "disabled", false );
                                        $(this).html( "Documento cargado");
                                    }
                                });
                                checklist_3 += 1;
                            }else if(chk_val == 3){
                                checklist_3 += 1;
                            }
                        }
                    }
                });
            <?php endforeach ?>
        <?php endforeach ?>

        checklist_1 = Math.trunc(checklist_1/3*100);
        checklist_2 = Math.trunc(checklist_2/14*100);
        checklist_3 = Math.trunc(checklist_3/7*100);

        $("#progress_bar_0").html( checklist_1 + '% Casas Habitat\n\
            <div class="progress-stat">\n\
                <div class="progress progress-striped active">\n\
                    <div class="progress-bar progress-bar-secondary" role="progressbar" aria-valuenow="' + checklist_1 + '" aria-valuemin="0" aria-valuemax="100" style="width: ' + checklist_1 + '%">\n\
                    </div>\n\
                </div>\n\
            </div>' );
        $("#progress_bar_1").html( checklist_2 + '% Documentación Casa\n\
            <div class="progress-stat">\n\
                <div class="progress progress-striped active">\n\
                    <div class="progress-bar progress-bar-secondary" role="progressbar" aria-valuenow="' + checklist_2 + '" aria-valuemin="0" aria-valuemax="100" style="width: ' + checklist_2 + '%">\n\
                    </div>\n\
                </div>\n\
            </div>' );
        $("#progress_bar_2").html( checklist_3 + '% Personales\n\
            <div class="progress-stat">\n\
                <div class="progress progress-striped active">\n\
                    <div class="progress-bar progress-bar-secondary" role="progressbar" aria-valuenow="' + checklist_3 + '" aria-valuemin="0" aria-valuemax="100" style="width: ' + checklist_3 + '%">\n\
                    </div>\n\
                </div>\n\
            </div>' );

        $('.btn_upload_1').on('click', function(e){
            e.preventDefault();
            var reference = $(this).attr('reference');
            $('.element').attr('name', reference);
            $('.table').val('habitat');
        });

        $('.btn_upload_2').on('click', function(e){
            e.preventDefault();
            var reference = $(this).attr('reference');
            $('.element').attr('name', reference);
            $('.table').val('casa');
        });

        $('.btn_upload_3').on('click', function(e){
            e.preventDefault();
            var reference = $(this).attr('reference');
            $('.element').attr('name', reference);
            $('.table').val('personales');
        });

        $('.btn_description').on('click', function(e){
            e.preventDefault();
            var reference   = $(this).attr('reference');
            var description = $(this).attr('description');
            $('.element').attr('name', reference);
            $('#div_description_text').show();
            $('#btn_addDescription').attr('disabled', false);
            $('#div_description_inpt').hide();
            $('#btn_saveDescription').attr('disabled', true);
            if (description != undefined) {
                $('#div_description_text').html(description);
                $('#inpt_description').val(description);
            }else{
                $('#div_description_text').html('');
                $('#inpt_description').val('');
            }

        });


        $('#btn_save_checklist_0').on('click', function(e){
            e.preventDefault();
            var data = $("#form_checklist").serialize();
            $.ajax({
                type: 'POST',
                url: "<?=base_url('checklist/setchecklist_2')?>",
                data: data,
                success: function(data){
                    alert(data);
                    if( data == 1 ){
                        location.reload(); 
                    }else{
                        console.log(data);
                    }
                },
                error: function(a, b, c){
                    console.log(a); console.log(b); console.log(c);
                }
            });
        });

    </script>

    
