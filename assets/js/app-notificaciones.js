$(document).ready(function () {
  $("#notificaciones").append("<li class='notification notification-unread'><a href='#'><div class='image'><img src='../../../assets/img/avatar2.png' alt='Avatar'></div><div class='notification-info'><div class='text'><span class='user-name'>Jessica Caruso</span> accepted your invitation to join the team.</div><span class='date'>2 min ago</span></div></a></li>");
  buscar_mensajes_chat();
})

// setInterval(function () {
//   buscar_mensajes_chat();
// }, 2000)

function buscar_mensajes_chat () {
  $.ajax({
    method: "POST",
    url: "../../../assets/php/app-notificaciones.php",
    dataType: "json",
    data: {"opcion": opcion = "buscarMensajesChat"},
  }).done( function ( data ) {
    console.log(data);
    $.gritter.add({
      title: data.contacto,
      text: 'Te ha enviado un mensaje de chat',
      image: '../../../assets/img/' + data.avatar,
      class_name: 'clean img-rounded',
      time: '',
    });
  }).fail( function ( info ) {

  });
}
