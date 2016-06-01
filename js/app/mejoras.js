    var iIput =0;
    $('#test').on('click', function(e){
      iIput=iIput+1;
      e.preventDefault();
      $('#tbody_1').append('<tr>\n\
        <td>  </td>\n\
        <!--<td>  </td>-->\n\
        <td><input class="form-control" name="nombre_'+iIput+'"></input></td>\n\
        <td>  </td>\n\
        <td>  </td>\n\
      </tr>');
    });
    $('.tr_remove').on('click', function(e){
        e.preventDefault();
        var reference = $(this).attr('reference');
        $("#"+reference).remove();
      });


 