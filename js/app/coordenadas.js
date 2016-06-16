
//VARIABLES GENERALES
//declaras fuera del ready de jquery
var nuevos_marcadores = [];
var marcadores_bd= [];
var mapa = null; //VARIABLE GENERAL PARA EL MAPA
//FUNCION PARA QUITAR MARCADORES DE MAPA
function limpiar_marcadores(lista)
{
    for(i in lista)
    {
        //QUITAR MARCADOR DEL MAPA
        lista[i].setMap(null);
    }
}
$(document).on("ready", function(){
    
    //VARIABLE DE FORMULARIO
    var formulario = $("#formulario");
    
    var punto = new google.maps.LatLng(19.4147924,-99.1625976);
    var config = {
        zoom:5,
        center:punto,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    mapa = new google.maps.Map( $("#mapa")[0], config );

    google.maps.event.addListener(mapa, "click", function(event){
       var coordenadas = event.latLng.toString();
       
       coordenadas = coordenadas.replace("(", "");
       coordenadas = coordenadas.replace(")", "");
       
       var lista = coordenadas.split(",");
       
       var direccion = new google.maps.LatLng(lista[0], lista[1]);
       //PASAR LA INFORMACI�N AL FORMULARIO
       formulario.find("input[name='coordenadasx']").val(lista[0]);
       formulario.find("input[name='coordenadasy']").val(lista[1]);
       
       
       var marcador = new google.maps.Marker({
           //titulo:prompt("Titulo del marcador?"),
           position:direccion,
           map: mapa, 
           animation:google.maps.Animation.DROP,
           draggable:true
       });


      //marcador.setIcon('male-2.png');
       //ALMACENAR UN MARCADOR EN EL ARRAY nuevos_marcadores
       nuevos_marcadores.push(marcador);
       
       google.maps.event.addListener(marcador, "click", function(){

       });
       
       //BORRAR MARCADORES NUEVOS
       limpiar_marcadores(nuevos_marcadores);
       marcador.setMap(mapa);
    });
    $("#btn_grabar").on("click", function(){
        //INSTANCIAR EL FORMULARIO
        var f = $("#formulario");
        //VALIDAR CAMPO CX
        if(f.find("input[name='coordenadasx']").val().trim()=="")
        {
            alert("Falta Coordenada X");
            return false;
        }
        //VALIDAR CAMPO CY
        if(f.find("input[name='coordenadasy']").val().trim()=="")
        {
            alert("Falta Coordenada Y");
            return false;
        }
        //FIN VALIDACIONES
        
        if(f.hasClass("busy"))
        {
            //Cuando se haga clic en el boton grabar
            //se le marcar� con una clase 'busy' indicando
            //que ya se ha presionado, y no permitir que se
            //realiCe la misma operaci�n hasta que esta termine
            //SI TIENE LA CLASE BUSY, YA NO HARA NADA
            return false;
        }
        //SI NO TIENE LA CLASE BUSY, SE LA PONDREMOS AHORA
        f.addClass("busy");
        //Y CUANDO QUITAR LA CLASE BUSY?
        //CUANDO SE TERMINE DE PROCESAR ESTA SOLICITUD
        //ES DECIR EN EL EVENTO COMPLETE
        
        var loader_grabar = $("#loader_grabar");
       $.ajax({
           type:"POST",
           url:"iajax.php",
           dataType:"JSON",
           data:f.serialize()+"&tipo=grabar",
           success:function(data){
               if(data.estado=="ok")
                {
                    loader_grabar.removeClass("label-warning").addClass("label-success")
                    .text("Grabado OK").delay(4000).slideUp();
                    listar();
                }
                else
                {
                    alert(data.mensaje);
                }
               
               
           },
           beforeSend:function(){
               //Notificar al usuario mientras que se procesa su solicitud
               loader_grabar.removeClass("label-success").addClass("label label-warning")
               .text("Procesando...").slideDown();
           },
           complete:function(){
               //QUITAR LA CLASE BUSY
               f.removeClass("busy");
               f[0].reset();
               //[0] jquery trabaja con array de elementos javascript no
               //asi que se debe especificar cual elemento se har� reset
               //capricho de javascript
               //AHORA PERMITIR� OTRA VEZ QUE SE REALICE LA ACCION
               //Notificar que se ha terminado de procesar
               
           }
       });
       return false;
    });
});