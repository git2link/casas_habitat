
$('.context_menu tbody').on('click', function(e){
	e.preventDefault();
    var dta_table = table_1.row($('tr.selected')).data();
    if (dta_table != undefined) {
      $('.need_selection').attr('disabled', false);
    }else{
      $('.need_selection').attr('disabled', true);
    }
});	

$(document).ready( function(){
	$('.list-group').hide();

	$(document).on('click', function(e){
		$('.list-group').hide();
	});

	$(document).on('contextmenu', function(e){
		return false;
	});

	$('.context_menu tbody').on('contextmenu', 'tr', function(e){
		e.preventDefault();
		
		$('.DTTT_selected').removeClass('DTTT_selected');
		$('.selected').removeClass('selected');

		$(this).addClass('DTTT_selected selected');

		$('.list-group').css({
		    left:   e.clientX,
		    top:    e.clientY
		});
		$('.list-group').show("fold", 500);
	});

	$('.context_menu tbody').on('click', 'tr', function(e){
		e.preventDefault();
		$('.DTTT_selected').removeClass('DTTT_selected');
		$('.selected').removeClass('selected');
	});




});
	