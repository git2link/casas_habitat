function sendRequest(url,data){
    return  $.ajax({
        url: "../../" + url, // "checklist/test/1",
		method: 'POST',
		data: data,
        error: function(jq,status,message) {
        //alert('Ajax Error . Status: ' + status + ' - Message: ' + message);
        },
        success: function(data) { 
        }
    });  
}

function sendFileUrlData(url,data){
    return  $.ajax({
        type: "POST",
        url: "../../" + url,
        data:data,
        cache: false,
        contentType: false,
        processData: false,
        error: function(jq,status,message) {
        //alert('Ajax Error . Status: ' + status + ' - Message: ' + message);
        },
        success: function(data) { 

        }
    });  
}

function getBase64File(){
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
		$('#file_base64').val(data);
	};

}

