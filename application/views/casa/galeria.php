<link rel="stylesheet" href="../../../js/plugins/fileupload/bootstrap-fileupload.css">
<link rel="stylesheet" href="../../../js/plugins/magnific/magnific-popup.css">

<div class="portlet">
  <div class="portlet-header">

    <h3>
      <i class="fa fa-cloud-upload"></i>
      Subir Imagen
    </h3>

  </div> <!-- /.portlet-header -->

  <div class="portlet-content">

    <div class="row">
      <div class="col-sm-4">
        <?=form_open_multipart(base_url()."upload/do_upload/".$casa_k )?>

          <div class="fileupload fileupload-new" data-provides="fileupload">
            <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;"></div>
            <div>
              <span class="btn btn-default btn-file"><span class="fileupload-new">Seleccionar Imagen</span><span class="fileupload-exists">Cambiar</span><input type="file" name="userfile" /></span>
              <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remover</a>
            </div>
          </div>
          <input type="submit" value="Subir imágenes" />
        <?=form_close()?>
      </div> <!-- /.col -->
                                          
        </div> <!-- /.col -->

    </div> <!-- /.row -->
    <h4 class="heading">Galería</h4>
      <div class="row">

        <?php foreach ($imagenes as $imagen): ?>
        <div class="col-md-3 col-sm-6">
          <div class="thumbnail">
            <div class="thumbnail-view">
              <a href="<?= base_url('../uploads/'.$imagen->nombre ) ?>" class="thumbnail-view-hover ui-lightbox"></a>
              <img src="<?= base_url('../uploads/thumbs/'.$imagen->thumb) ?>" style="width: 100%" alt="Gallery Image" />
            </div>
          </div> <!-- /.thumbnail -->       

        </div> <!-- /.col -->
        <?php endforeach; ?>
      </div>         

  </div> <!-- /.portlet-content -->

</div> <!-- /.portlet -->