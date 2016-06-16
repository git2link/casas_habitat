<form id="form_1">
    <div id="modal_1" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title">Proveedor</h3>
                </div>
                <div class="modal-body">
                    <div align="center">
                        <label>Datos generales</label>
                    </div>
                    <label>Proveedor</label>
                    <input name="empresa" class="form-control">
                    <br>
                    <label>Responsable</label>
                    <input name="nombre" class="form-control">
                    <br>
                    <div align="center">
                        <label>Dirección</label>
                    </div>
                    <br>
                    <label>Codigo Postal</label>
                    <input name="codigo_postal" id="codigo_postal" class="form-control">
                    <br>
                    <label>Estado</label>
                    <select name="estado_k" id="estado" class="form-control"></select>
                    <br>
                    <label>Municipio</label>
                    <select name="municipio_k" id="municipio" class="form-control"></select>
                    <br>
                    <label>Colonia</label>
                    <select name="colonia_k" id="colonia" class="form-control"></select>
                    <br>
                    <label>Calle</label>
                    <input name="calle_numero" class="form-control">
                    <br>
                    <label>Lote</label>
                    <input name="lote" class="form-control">
                    <br>
                    <div align="center">
                        <label>Contacto</label>
                    </div>
                    <br>
                    <label>Email</label>
                    <input name="email" class="form-control">
                    <br>
                    <label>Telefono ocficina</label>
                    <input name="telefono_oficina" class="form-control">
                    <br>
                    <label>Telefono celular</label>
                    <input name="telefono_celular" class="form-control">
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" id="submit_form_1" class="btn btn-default" >Continuar</button>
                </div>
            </div>
        </div>
    </div>
    <input class="action" hidden>
    <input id="proveedor_k" name="proveedor_k" hidden>
</form>

<script type="text/javascript">
    
    $('#codigo_postal').blur(function(){
     obtenerDirecciones($(this).val(), "<?=base_url('')?>");
    });
    $('#codigo_postal_casa').blur(function(){
     obtenerDireccionesCasa($('#codigo_postal_casa').val(), "<?=base_url('')?>");
    });

    $('#codigo_postal_edit').blur(function(){
     obtenerDireccionesEdit($('#codigo_postal_edit').val(), "<?=base_url('')?>");
    });
    $('#estado_k').change(function(){
        console.log('entro');
        obtenerMunicipios($('#estado_k').val(), "<?=base_url('')?>");
    });

    $('#submit_form_1').on('click', function(e){
        e.preventDefault();
        var action = $('.action').val();
        var data = $('#form_1').serialize();
        $.ajax({
            type: 'POST',
            url: "<?=base_url('proveedor')?>/" + action,
            data: data,
            success: function(data){
                table_1.ajax.reload();
            },
            error: function(a, b, c){
                console.log(a);
                console.log(b);
                console.log(c);
            }
        });

    });
     
</script>

