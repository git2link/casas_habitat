<?php $count_chk_1=0; $count_chk_2=0; $count_chk_3=0; ?>
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
                                                <?php if ($value['id'] == $checklist[0]['usuario_k']): ?>
                                                    <option id="asesor_<?= $value['id'] ?>" value="<?= $value['id'] ?>" selected><?= $value['name'] ?></option>    
                                                <?php else: ?>
                                                    <option id="asesor_<?= $value['id'] ?>" value="<?= $value['id'] ?>" ><?= $value['name'] ?></option>    
                                                <?php endif ?>
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
                                                <?php if ($value['notaria_k'] == $checklist[0]['notaria_k']): ?>
                                                    <option id="notaria_<?= $value['notaria_k'] ?>" value="<?= $value['notaria_k'] ?>" selected><?= $value['nombre'] ?></option>    
                                                <?php else: ?>
                                                    <option id="notaria_<?= $value['notaria_k'] ?>" value="<?= $value['notaria_k'] ?>"><?= $value['nombre'] ?></option>    
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group" >
                                    <div class="col-md-6" >
                                        <br>
                                        <label>Precio de compra final</label>
                                        <input id="precio_compra_final" name="precio_compra_final" class="form-control" value="<?=$checklist[0]['precio_compra_final']?>">
                                    </div>
                                    <div class="col-md-6" >
                                        <br>
                                        <label>Precio de venta final</label>
                                        <input  id="precio_venta_final" name="precio_venta_final" class="form-control" value="<?=$checklist[0]['precio_venta_final']?>">
                                    </div>
                                </div>
                                <?php foreach ($checklist as $registro): ?>
                                    <?php foreach ($registro as $ind => $value): ?>
                                        <?php if (isset($checklist_name[$ind]) && isset($checklistfiles_habitat[0]->$ind)): ?>
                                            <?php  
                                                $checked_1 = '';$checked_2 = '';$checked_3 = '';
                                                if ( $value == 1 ) {$checked_1 = 'checked'; $count_chk_1 =+ 1;}elseif( $value == 2 ){$checked_2 = 'checked';}elseif( $value == 3 ){$checked_3 = 'checked'; $count_chk_1 =+ 1;}
                                                $disabled = 'disabled';
                                                if ( $checked_1 == 'checked' ) {$disabled = ''; }
                                            ?>
                                            <div class="form-group" >
                                                <div class="col-md-4">
                                                    <br>
                                                    <label><?=$checklist_name[$ind]?></label>
                                                </div>
                                                <div class="col-md-4">
                                                    <br>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?=$ind?>" area="checklist_0" value="1" <?=$checked_1?>> Si
                                                    </label>                                          
                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?=$ind?>" area="checklist_0" value="3" <?=$checked_3?>> N/A
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?=$ind?>" area="checklist_0" value="2" <?=$checked_2?>> No
                                                    </label>
                                                </div>
                                                <div class="col-md-4">
                                                    <br>
                                                    <textarea id="txt_<?=$ind?>" hidden><?=$checklist_description[0][$ind]?></textarea>
                                                    <a data-toggle="modal" href="#modal_description" class="btn btn-xs btn-secondary btn_description" reference="<?=$ind?>" title="Descripción"><i class="fa fa-align-justify"></i></a>
                                                    <a data-toggle="modal" href="#modal_upload" class="btn btn-xs btn-success btn_upload_1" reference="<?=$ind?>"><i class="fa fa-upload" title="Cargar documento"></i></a>
                                                    <a href="#modal_pdf" class="btn btn-sm btn-default a_file" reference="<?=$ind?>" file="<?=$checklistfiles_habitat[0]->$ind?>" <?=$disabled?>>Documento no cargado</a>                                                    
                                                </div>    
                                            </div>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                <?php endforeach ?>


                                <div class="form-group" >                 
                                    <div class="col-md-12" >
                                        <br>
                                        <label>Observaciones</label>
                                        <textarea id="observaciones" name="observaciones" class="form-control" rows="3"><?=$checklist[0]['observaciones']?></textarea>
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
                                        <input name="fecha_hora_modificacion" class="form-control" value="<?=$checklist[0]['fecha_hora_modificacion']?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" name="algo" id="checklist_1">
                                <?php foreach ($checklist as $registro): ?>
                                    <?php foreach ($registro as $ind => $value): ?>
                                        <?php if (isset($checklist_name[$ind]) && isset($checklistfiles_casa[0]->$ind)): ?>
                                            <?php  
                                                $checked_1 = '';$checked_2 = '';$checked_3 = '';
                                                if ( $value == 1 ) {$checked_1 = 'checked'; $count_chk_2 =+ 1;}elseif( $value == 2 ){$checked_2 = 'checked';}elseif( $value == 3 ){$checked_3 = 'checked'; $count_chk_2 =+ 1;}
                                                $disabled = 'disabled';
                                                if ( $checked_1 == 'checked' ) {$disabled = ''; }
                                            ?>
                                            <div class="form-group" >
                                                <div class="col-md-4">
                                                    <br>
                                                    <label><?=$checklist_name[$ind]?></label>
                                                </div>
                                                <div class="col-md-4">
                                                    <br>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?=$ind?>" area="checklist_1" value="1" <?=$checked_1?>> Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?=$ind?>" area="checklist_1" value="3" <?=$checked_3?>> N/A
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?=$ind?>" area="checklist_1" value="2" <?=$checked_2?>> No
                                                    </label>
                                                </div>
                                                <div class="col-md-4">
                                                    <br>
                                                    <textarea id="txt_<?=$ind?>" hidden><?=$checklist_description[0][$ind]?></textarea>
                                                    <a data-toggle="modal" href="#modal_description" class="btn btn-xs btn-secondary btn_description" reference="<?=$ind?>" title="Descripción"><i class="fa fa-align-justify"></i></a>
                                                    <a data-toggle="modal" href="#modal_upload" class="btn btn-xs btn-success btn_upload_2" reference="<?=$ind?>"><i class="fa fa-upload" title="Cargar documento"></i></a>
                                                    <a href="#modal_pdf" class="btn btn-sm btn-default a_file" reference="<?=$ind?>" file="<?=$checklistfiles_casa[0]->$ind?>" <?=$disabled?>>Documento no cargado</a>
                                                </div>    
                                            </div>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                <?php endforeach ?>
                            </div>  
                            <div class="tab-pane fade" id="checklist_2">
                             
                                <?php foreach ($checklist as $registro): ?>
                                    <?php foreach ($registro as $ind => $value): ?>
                                        <?php if (isset($checklist_name[$ind]) && isset($checklistfiles_personales[0]->$ind)): ?>
                                            <?php  
                                                $checked_1 = '';$checked_2 = '';$checked_3 = '';
                                                if ( $value == 1 ) {$checked_1 = 'checked'; $count_chk_3 =+ 1;}elseif( $value == 2 ){$checked_2 = 'checked';}elseif( $value == 3 ){$checked_3 = 'checked'; $count_chk_3 =+ 1;}
                                                $disabled = 'disabled';
                                                if ( $checked_1 == 'checked' ) {$disabled = ''; }
                                            ?>
                                            <div class="form-group" >
                                                <div class="col-md-4">
                                                    <br>
                                                    <label><?=$checklist_name[$ind]?></label>
                                                </div>
                                                <div class="col-md-4">
                                                    <br>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?=$ind?>" area="checklist_2" value="1" <?=$checked_1?>> Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?=$ind?>" area="checklist_2" value="3" <?=$checked_3?>> N/A
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?=$ind?>" area="checklist_2" value="2" <?=$checked_2?>> No
                                                    </label>
                                                </div>
                                                <div class="col-md-4">
                                                    <br>
                                                    <textarea id="txt_<?=$ind?>" hidden><?=$checklist_description[0][$ind]?></textarea>
                                                    <a data-toggle="modal" href="#modal_description" class="btn btn-xs btn-secondary btn_description" reference="<?=$ind?>" title="Descripción"><i class="fa fa-align-justify"></i></a>
                                                    <a data-toggle="modal" href="#modal_upload" class="btn btn-xs btn-success btn_upload_3" reference="<?=$ind?>"><i class="fa fa-upload" title="Cargar documento"></i></a>
                                                    <a href="#modal_pdf" class="btn btn-sm btn-default a_file" reference="<?=$ind?>" file="<?=$checklistfiles_personales[0]->$ind?>" <?=$disabled?>>Documento no cargado</a>
                                                </div>    
                                            </div>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div> 
                </div> 
            </div>
        </div>
        <input name="casa_k" value="<?= $casa_k ?>" hidden>
        
    </form>

    <script type="text/javascript">
        var percent_chk_1 = Math.trunc(<?=$count_chk_1?>/3*100);
        var percent_chk_2 = Math.trunc(<?=$count_chk_2?>/3*100);
        var percent_chk_3 = Math.trunc(<?=$count_chk_3?>/3*100);

        $("#progress_bar_0").html( percent_chk_1 + '% Casas Habitat\n\
            <div class="progress-stat">\n\
                <div class="progress progress-striped active">\n\
                    <div class="progress-bar progress-bar-secondary" role="progressbar" aria-valuenow="' + percent_chk_1 + '" aria-valuemin="0" aria-valuemax="100" style="width: ' + percent_chk_1 + '%">\n\
                    </div>\n\
                </div>\n\
            </div>' );
        $("#progress_bar_1").html( percent_chk_2 + '% Documentación Casa\n\
            <div class="progress-stat">\n\
                <div class="progress progress-striped active">\n\
                    <div class="progress-bar progress-bar-secondary" role="progressbar" aria-valuenow="' + percent_chk_2 + '" aria-valuemin="0" aria-valuemax="100" style="width: ' + percent_chk_2 + '%">\n\
                    </div>\n\
                </div>\n\
            </div>' );
        $("#progress_bar_2").html( percent_chk_3 + '% Personales\n\
            <div class="progress-stat">\n\
                <div class="progress progress-striped active">\n\
                    <div class="progress-bar progress-bar-secondary" role="progressbar" aria-valuenow="' + percent_chk_3 + '" aria-valuemin="0" aria-valuemax="100" style="width: ' + percent_chk_3 + '%">\n\
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
            var description = $('#txt_' + reference).val();
            $('#div_description_text').html(description);
            $('#inpt_description').val(description);
            $('.element').attr('name', reference);

        });


        $('#btn_save_checklist_0').on('click', function(e){
            e.preventDefault();
            var data = $("#form_checklist").serialize();
            $.ajax({
                type: 'POST',
                url: "<?=base_url('checklist/setchecklist_2')?>",
                data: data,
                success: function(data){
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

        $('.a_file').on('click', function(e){
            e.preventDefault();
            var file = $(this).attr('file');
            var url = "<?=base_url('pdf_file/checklist')?>/" + '<?=$casa_k?>' + '/' +file;
            var popup = window.open(url, 'Cotización', 'height=' + (window.innerHeight) + ',width=' + (window.innerWidth * 0.75) + ',scrollbars=1');
            if (!popup.opener) {
                popup.opener = self
            };
            popup.focus();
        });


/*


*/
    </script>