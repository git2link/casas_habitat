
$(function () {

  $('.howler').click (function (e) {

    $.howl ({
      type: $(this).data ('type')
      , title: 'Exito!'
      , content: 'El interes de las casas se agrego satisfactoriamente.'
      , sticky: $(this).data ('sticky')
      , lifetime: 7500
      , iconCls: $(this).data ('icon')
    });

  });
    
});
