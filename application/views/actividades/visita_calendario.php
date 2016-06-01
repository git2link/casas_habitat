<div id='calendar'></div>
<div id="div-dialog" title="Terminar Cita de Presentación">
    <div align="center">
        <br>
        <h5 id="hd-message"></h5>
    </div> 
</div>
<script type="text/javascript">
    $('#calendar').fullCalendar({
        aspectRatio: 2,
        header: {
            left: 'prev, next',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        defaultDate: $.now(),
        buttonIcons: false, // show the prev/next text
        weekNumbers: false,
        lang: 'es',
        timezone: 'America/Mexico_City',
        editable: false,
        durationEditable: false,
        color: 'yellow',
        textColor: 'black',
        eventLimit: true,
        events: {
            url: "<?=base_url('actividades/get_calendar')?>",
            type: 'GET',
            data: {
                json:           'Calendar',
                active:         '',
                id:             '',
                parameters:     'true',
                data:           'false'
            },
            error: function() {
                alert('ocurrio un error');
            }
        },
        eventRender: function(event, element) {
            if(event.estatus=='1'){
                element.css('background-color', 'rgb(92, 184, 92)');
                element.css('border-color', 'rgb(92, 184, 92)');
            }else if(event.estatus=='0'){
                element.css('background-color', '#5CB85C;');
                element.css('border-color', '#5CB85C;');
            }       
        },

        loading: function(bool) {
            //$('#loading').toggle(bool);
        },
        dayClick: function(date, jsEvent, view) {},
        eventClick: function(event, jsEvent, view) {
            calendar_click(event);
            //setCalendarEvent(calEvent, jsEvent, view);
            //setCalendarButtonsEvent(calEvent, jsEvent, view);
            
        }
    });

function calendar_click(e){
    var fecha =  new Date(e.start).toISOString().slice(0, 10);
    
    new PNotify({
        title: e.title,
        text: '<b>Realiza visita:</b> <br>' + e.empleado + '<br><b>Fecha:</b> <br>' + fecha + '<br><b>Cliente:</b> <br>' + e.cliente + '<br><b>Direccion:</b> <br>' + e.direccion,
        type: 'warning'
    });

    if (e.estatus == 0) {
        var appointmentDiv = '  <div class="col-md-12"><br>\n\
                                    <ol class="breadcrumb" style="background-color: rgb(58, 135, 173); color: white;">'+e.title+' - '+e.cliente+' - Visita pendiente</ol>\n\
                                </div>\n\
                                <br>\n\
                                <div class="col-md-6"><br>\n\
                                    <a href="' + "<?=base_url('actividades/visita')?>" + '/' + e.visita +'" class="form-control btn btn-xm btn-success">Atender visita <i class="fa fa-check-circle-o"></i></a>\n\
                                </div>\n\
                                <div class="col-md-6"><br>\n\
                                    <button class="form-control btn btn-xm btn-danger">Visita no atendida <i class="fa fa-times-circle-o"></i></button>\n\
                                </div>';
    }else if (e.estatus == 1){
        var appointmentDiv = '  <div class="col-md-12"><br>\n\
                                    <ol class="breadcrumb" style="background-color: rgb(92, 184, 92); color: white;">'+e.title+' - '+e.cliente+' - Visita realizada</ol>\n\
                                </div>';
    }

    $('#hd-message').html(appointmentDiv);
}
  
</script>