      <div>
        <h4 class="heading-inline">Estadísticas Semanales de Ventas
        &nbsp;&nbsp;<small>Para la semana del 1 de Febrero al 8 de Febrero, 2016</small>
        &nbsp;&nbsp;</h4>

        <div class="btn-group ">
          <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
          <i class="fa fa-clock-o"></i>  &nbsp;
            Cambiar Semana <span class="caret"></span>
          </button>
          
        </div>
      </div>

      <br>

      <div class="row">

        <div class="col-sm-6 col-md-4">
          <div class="row-stat">
            <p class="row-stat-label">Ingresos del Mes</p>
            <h3 class="row-stat-value">$2,451,295.00</h3>
            <span class="label label-success row-stat-badge">+17%</span>
          </div> <!-- /.row-stat -->
        </div> <!-- /.col -->

        <div class="col-sm-6 col-md-4">
          <div class="row-stat">
            <p class="row-stat-label">Total de Ventas</p>
            <h3 class="row-stat-value">13</h3>
            <span class="label label-success row-stat-badge">+26%</span>
          </div> <!-- /.row-stat -->
        </div> <!-- /.col -->

        <div class="col-sm-12 col-md-4">
          <div class="row-stat">
            <p class="row-stat-label">Compras por Concretar</p>
            <h3 class="row-stat-value">4</h3>
            <span class="label label-danger row-stat-badge">+5%</span>
          </div> <!-- /.row-stat -->
        </div> <!-- /.col -->
        
      </div> <!-- /.row -->

      <br>

          <div class="portlet">

            <div class="portlet-content panel-thread scrollable-panel div_news">
              <ul class="panel-lists" id="ul_news">
                <?php foreach ($news as $new): ?>
                  <li>
                    <?php 
                      if ($new->fecha<60){
                        $new->fecha = round($new->fecha) . ' min';
                      }elseif( ($new->fecha / 60) < 24){
                        $new->fecha =  round($new->fecha / 60);
                        $new->fecha = $new->fecha . ' hrs';
                      }else{
                        $new->fecha = round($new->fecha / 60 /24);
                        $new->fecha = $new->fecha . ' dias';
                      }
                    ?>
                    <img src="<?= $new->foto ?>" class="panel-list-avatar">
                    <div class="panel-list-content">
                        <span class="panel-list-time"><?=$new->fecha?></span>
                        <span class="panel-list-title" style="color: rgb(66, 139, 202);"><?=$new->empleado?></span>
                        <span class="panel-list-title"><?=$new->actividad?></span>
                    </div>
                  </li> 
                <?php endforeach ?>
              </ul>
            </div> <!-- /.portlet-content -->

          </div> <!-- /.portlet -->
<script type="text/javascript">
  var start = 0;
  var limit = 5;

  $('.div_news').bind('scroll', function(){
      if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight - 10){
        start = limit +1;
        limit = limit +5;
        var content = '';
        $.ajax({
            type: 'POST',
            url: "<?=base_url('home/get_news')?>",
            data: {start: start, limit: 5},
            success: function(data){
              $.each($.parseJSON(data), function(idx, val) {
                if ( val.fecha<60 ) {
                  val.fecha = Math.trunc(val.fecha) + ' min';
                }else if( (val.fecha / 60) < 24 ){
                  val.fecha = (val.fecha / 60);
                  val.fecha = Math.trunc(val.fecha) + ' hrs';
                }else{
                  val.fecha = (val.fecha / 60) / 24;
                  val.fecha = Math.trunc(val.fecha) + ' dias';
                }
                content = content + '<li>\n\
                    <img src="' + val.foto+ '" class="panel-list-avatar">\n\
                    <div class="panel-list-content">\n\
                        <span class="panel-list-time">' + val.fecha +'</span>\n\
                        <span class="panel-list-title" style="color: rgb(66, 139, 202);">' + val.empleado + '</span>\n\
                        <span class="panel-list-title">' + val.actividad + '</span>\n\
                    </div>\n\
                  </li>';
              });

              $('#ul_news').append(content);
            },
            error: function(a, b, c){
                alert(a.responseText);
                console.log(b);
                console.log(c);
            }
        });
        
      };
  });
</script>


