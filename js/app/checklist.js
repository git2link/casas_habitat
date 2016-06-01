function sendRequest(url,data){
    return  $.ajax({
        url: "../../checklist/" + url, // "checklist/test/1",
		method: 'POST',
		data: data,
        error: function(jq,status,message) {
        //alert('Ajax Error . Status: ' + status + ' - Message: ' + message);
        },
        success: function(data) { 
        }
    });  
}

$('#btn_save_checklist').on('click', function(e){
	e.preventDefault();
	var data = $('#form_checklist').serialize();
	var getRequest = sendRequest('setchecklist', data);
	getRequest.success(function (data) {
		location.reload();
    });
});

$('.btn_upload').on('click', function(e){
	e.preventDefault();
	var name = $(this).attr('reference');
	$('#element').val('');
	$('#element').attr('name', name);
});


function uploadFileFunction(){
	var reader = new FileReader(),
    	file = $("#file_upload")[0];
    if (!file.files.length) {
		alert("Archivo no seleccionado");
		return false;
	}
	reader.onload = function () {
		var data = reader.result,
		base64 = data.replace(/^[^,]*,/, ""),
		info = {};
		$('#element').val( base64);
		var data = $('#form_upload').serialize();
		var getRequest = sendRequest('uploadfile', data);
		getRequest.success(function (data) {
			location.reload();
		});
	};
	reader.readAsDataURL(file.files[0]);
}

$('.a_file').on('click', function(e){
	var data = $(this).attr('data');
	$('#pdf_area_1').attr('data', data);
});