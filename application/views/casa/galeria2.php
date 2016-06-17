<div class="page-header">
    <h1> <?= $clave_interna ?> <small> <i class="fa fa-eye"></i> visita  </small> </h1> 
    <div class="pull-left table_functions_left">
        <a href="<?=base_url('actividades/visitas')?>" class="btn btn-danger btn-sm" title="Regresar">
            <i class="fa fa-arrow-left"></i>
        </a>
        <!--<a id="btn_modal_upload" data-toggle="modal" href="#modal_upload" class="btn btn-sm btn-secondary btn_upload" class="btn btn-success" title="Agregar imagen">
            <i class="fa fa-cloud-upload"></i>
        </a>-->
        <a id="btn_terminar_visita" data-toggle="modal" href="#modal_end" class="btn btn-sm btn-success btn_upload" class="btn btn-success" title="Concluir visita">
            <i class="fa fa-check-square-o"> Finalizar</i>
        </a>
    </div>
    <div class="pull-right table_functions_right">
    </div>
</div>
<div>
    <form id="form_3">
        <br>
        <label>Invadida</label>
        <select name="estatus_invadida_k" class="form-control casa_option">
            <option value="">Seleccione una opcion...</option>
            <option value="1">Si</option>
            <option value="2">No</option>
            <option value="3">Tal vez</option>
        </select>
        <br>
        <label>Llaves</label>
        <select name="llaves" class="form-control casa_option">
            <option value="">Seleccione una opcion...</option>
            <option value="1">Si</option>
            <option value="0">No</option>
        </select>
        <br>
        <label>Estatus para la venta</label>
        <select name="estatus_venta_k" class="form-control casa_option">
            <option value="">Seleccione una opcion...</option>
            <option value="1">disponible</option>
            <option value="2">disponible invadida</option>
            <option value="3">reservada</option>
        </select>
        <input name ="casa_k" value="<?= $casa_k ?>" hidden> 
    </form>
        
</div>

<div class="page-header">
    <div class="pull-left table_functions_left">
        <a id="btn_modal_upload" data-toggle="modal" href="#modal_upload" class="btn btn-sm btn-secondary btn_upload" class="btn btn-success" title="Agregar imagen">
            <i class="fa fa-cloud-upload"> Agregar imagen</i>
        </a>
    </div>
    <div class="pull-right table_functions_right">
    </div>
</div>

<br>

<div class="portlet">
    <div class="portlet-header">
        <h3>
            <i class="fa fa-cloud-upload"></i>
            Imagenes
        </h3>
    </div> <!-- /.portlet-header -->

        <form id="fileupload" action="php/index.php" method="POST" enctype="multipart/form-data" hidden>  
            <input type="hidden" value="<?= $casa_k ?>" name ="casa_k" id="casa_k">             
            <div align="right">
            </div>
        </form>
    <div>
        <br>
        <ul id="images" class="list-unstyled">
            <li>
                <?php foreach ($imagenes as $key => $value): ?>
                    <div class="col-lg-12">
                        <br>
                        <div class="col-lg-3">
                            <img height="70" width="80" src="http://sistemas2link.com/casas_habitat/server/casas/files/<?=$casa_k?>/<?=$imagenes[$key]['nombre']?>" alt="<?=$key?>">
                        </div>
                        <div class="col-lg-3">
                            <?=$imagenes[$key]['ubicacion']?>
                        </div>
                        <div class="col-lg-3">
                            <?=$imagenes[$key]['description']?>
                        </div>
                        <div class="col-lg-3" align="right">
                            <button class="btn btn-default dlt_file" reference="<?=$imagenes[$key]['galeria_k']?>"><i class="fa fa-trash-o"></i> Eliminar </button>
                        </div>
                    </div>
                <?php endforeach ?>
            </li>
        </ul>
    </div>
    <label style="color: white;">.</label>
</div> 

<script type="text/javascript">
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            alert('Geolocation is not supported by this browser.');
        }
    }
    
    function showPosition(position) {
        $('#latitud').val( position.coords.latitude );
        $('#longitud').val( position.coords.longitude );
    }
    
    $('#btn_modal_upload').on('click', function(e){
        e.preventDefault();
        getLocation();
    });
                
    window.Viewer;
    var viewer = new Viewer(document.getElementById('images'), {});

    $('.casa_option').each(function(i){
        var name = $(this).attr('name');
        <?php foreach ($visita_options[0] as $key => $value): ?>
            if ( name == '<?=$key?>' ) {
                $(this).val('<?=$value?>').change();
            }
        <?php endforeach ?>
    });
    
    $('.casa_option').on('change', function(e){
        e.preventDefault();
        var data = $('#form_3').serialize();
        pnotify_common('info');
        $.ajax({
            type: 'POST',
            url: "<?=base_url('casa/update_2')?>",
            data: data,
            success: function(data){
                if (data == 1) {
                    pnotify_common('success');
                    table_1.ajax.reload();
                }else{
                    pnotify_common('error');
                }
            },
            error: function(a, b, c){
                pnotify_common('error');
                console.log(a);
                console.log(b);
                console.log(c);
            }
        });
    });
</script>
