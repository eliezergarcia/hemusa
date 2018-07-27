var App = (function () {
  'use strict';

  App.pageCalendar = function( ){

    /* initialize the external events
    -----------------------------------------------------------------*/

    $('#external-events .fc-event').each(function() {

      // store data so the calendar knows to render an event upon drop
      $(this).data('event', {
        title: $.trim($(this).text()), // use the element's text as the event title
        stick: true // maintain when user navigates (see docs on the renderEvent method)
      });

      // make the event draggable using jQuery UI
      $(this).draggable({
        zIndex: 999,
        revert: true,      // will cause the event to go back to its
        revertDuration: 0  //  original position after the drag
      });

    });


    /* initialize the calendar
    -----------------------------------------------------------------*/
      $.ajax({
        method: "POST",
        url: "../calendario/listar.php",
        dataType: 'json',
      }).done( function( data ){
        console.log(data);
        $('#calendar').fullCalendar({
        header: {
          left: 'title',
          center: '',
          right: 'month,agendaWeek,agendaDay, today, prev,next',
        },
        drop: function() {
          // is the "remove after drop" checkbox checked?
          if ($('#drop-remove').is(':checked')) {
            // if so, remove the element from the "Draggable Events" list
            $(this).remove();
          }
        },
        defaultDate: new Date(),
        editable: true,
        eventLimit: true,
        droppable: true, // this allows things to be dropped onto the calendar
        events: data,
        dayClick: function(date, jsEvent, view) {
          $("#modalCrearEvento").modal("show");
          var dia = date.format("DD-MM-YYYY");
          $("#fechaInicio").val(dia);
          $("#fechaFin").val(dia);
        },
        eventClick: function(calEvent, jsEvent, view){
          var id = calEvent.id;
          var opcion = "buscarevento";
          $.ajax({
            method: "POST",
            url: "buscar.php",
            dataType: 'json',
            data: {"id": id, "opcion": opcion},
          }).done( function( data ){
            console.log(data);
            if (data.respuesta == "BIEN") {
              $("#modalEditarEvento").modal("show");
              $("#frmEditarEventoCalendario #idEvento").val(data.data.id);
              $("#frmEditarEventoCalendario #titulo").val(data.data.titulo);
              $("#frmEditarEventoCalendario #fechaInicio").val(data.data.fechaInicio);
              $("#frmEditarEventoCalendario #fechaFin").val(data.data.fechaFin);

              if (data.data.horaInicio != "00:00:00" && data.data.horaFin != "00:00:00") {
                $('input[name=checkTodoElDiaEditar]').prop('checked' , false);
                $('#frmEditarEventoCalendario input[name=horaInicio]').prop('disabled' , false);
                $('#frmEditarEventoCalendario input[name=horaFin]').prop('disabled' , false);
              }
              $("#frmEditarEventoCalendario #horaInicio").val(data.data.horaInicio);
              $("#frmEditarEventoCalendario #horaFin").val(data.data.horaFin);
              // $("#frmEditarEventoCalendario #repetir").val(data.data.repetir).change();
              // $("#frmEditarEventoCalendario #recordatorio").val(data.data.recordatorio).change();
              $("#frmEditarEventoCalendario #notas").val(data.data.notas);
            }else{
              mostrar_mensaje(data);
            }
          });
        }
      });
    });

  };

  return App;
})(App || {});
