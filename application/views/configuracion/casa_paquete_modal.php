<form id="form_1">
    <div id="modal_1" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title">Casa Tipo-Paquete</h3>
                </div>
                <div class="modal-body">
                    <div align="center">
                        <label>Tipo-Paquete</label>
                    </div>
                    <label>Tipo</label>
                    <input name="tipo" class="form-control">
                    <br>
                    <label>Paquete</label>
                    <input name="paquete" class="form-control">
                    <br>
                    <label>¿Requiere cliente?</label>
                    <select name="cliente" class="form-control">
                        <option value="0">No</option>
                        <option value="1">Si</option>
                    </select>
                    <br>
                    <label>Activo</label>
                    <select name="activo" class="form-control">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" id="submit_form_1" class="btn btn-default" >Continuar</button>
                </div>
            </div>
        </div>
    </div>
    <input class="action" hidden>
    <input id="paquete_casa_k" name="paquete_casa_k" hidden>
</form>

<script type="text/javascript">

    $('#submit_form_1').on('click', function(e){
        e.preventDefault();
        var action = $('.action').val();
        var data = $('#form_1').serialize();
        $.ajax({
            type: 'POST',
            url: "<?=base_url('configuracion')?>/" + action,
            data: data,
            success: function(data){
                alert(data);
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

