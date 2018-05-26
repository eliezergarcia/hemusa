var timer = 0;
var timer2 = 0;

// Se muestra la lista de contactos del chat
  function listar_contactos () {
    timer2 = setInterval(function () {
      var opcion = "listarcontactos";
      $.ajax({
        method: "POST",
        url: "../../../assets/php/app-chat.php",
        dataType: "json",
        data: {"opcion": opcion}
      }).done( function( data ){
        console.log(data);
        var usuarios = data.usuarios;
        $("#lista-contactos").empty();
        $("#lista-reciente").empty();
        for(var i=0;i<usuarios.length;i = i+1){
          if (usuarios[i].reciente == "no") {
            $("#lista-contactos").append("<div class='user' id='"+ usuarios[i].id +"' onClick='mostrar_mensajes("+ usuarios[i].id +")'><a href='#'><img src='../../../assets/img/"+ usuarios[i].avatar +"' alt='Avatar'><div class='user-data2'><span class='status'></span><span class='name contacto-chat'>"+ usuarios[i].nombre + " " + usuarios[i].apellidos +"</span></div></a></div>");
          }else{
            $("#lista-reciente").append("<div class='user' id='"+ usuarios[i].id +"' onClick='mostrar_mensajes("+ usuarios[i].id +")'><a href='#'><img src='../../../assets/img/"+ usuarios[i].avatar +"' alt='Avatar'><div class='user-data2'><span class='status'></span><span class='name contacto-chat'>"+ usuarios[i].nombre + " " + usuarios[i].apellidos +"</span><span class='message'>"+ usuarios[i].reciente +"</span></div></a></div>");
          }
        };
      });
    }, 2000);
  }

  listar_contactos();
  setTimeout(function (){
    clearInterval(timer2);
  }, 3500);

  $("#listar-contactos-chat").on("click", function () {
    // clearInterval(timer2);
    listar_contactos();
  });

// Se muestran los mensajes del contacto que se dio click
  function mostrar_mensajes (idcontacto) {
    clearInterval(timer2);
    $("#idcontacto").val(idcontacto);
    var opcion = "buscarmensajes";
    $.ajax({
      method: "POST",
      url: "../../../assets/php/app-chat.php",
      dataType: "json",
      data: {"opcion": opcion, "idcontacto": idcontacto}
    }).done( function( data ){
      console.log(data);
      var mensajes = data.mensajes;
      console.log(mensajes);
      $("#lista_contactos").empty();
      $("#contacto-title").empty();
      $("#contacto-title").append("<div class='user'><img src='../../../assets/img/"+ data.contacto[0].avatar +"' alt='Avatar'><h2>"+ data.contacto[0].nombre + " " + data.contacto[0].apellidos +"</h2><span>Active 1h ago</span></div><span class='icon return mdi mdi-chevron-left'></span>");

      $("#mensajes-chat").empty();
      if(mensajes == 0){
        $("#tab1").addClass("chat-opened");
      }else{
        $("#tab1").addClass("chat-opened");
        for(var i=0;i<mensajes.length;i = i+1){
          if (mensajes[i].idcontacto == idcontacto) {
            $("#mensajes-chat").append("<li class='self'><div class='msg'>"+ mensajes[i].mensaje +"</div></li>");
          }else{
            $("#mensajes-chat").append("<li class='friend'><div class='msg'>"+ mensajes[i].mensaje +"</div></li>");
          }
        };
      }
    });

    timer = setInterval(function () {
      actualizar_mensajes(idcontacto);
    }, 2000);
  }

// Se actualizan los mensajes del chat que se encuentra abierto
  function actualizar_mensajes (idcontacto){
    // console.log(idcontacto);
    var opcion = "buscarmensajes";
    $.ajax({
      method: "POST",
      url: "../../../assets/php/app-chat.php",
      dataType: "json",
      data: {"opcion": opcion, "idcontacto": idcontacto}
    }).done( function( data ){
      console.log(data);
      var mensajes = data.mensajes;
      console.log(mensajes);
      if(mensajes == 0){
      }else{
        for(var i=0;i<mensajes.length;i = i+1){
          if(mensajes[i].leido == "no"){
            if (mensajes[i].idcontacto == idcontacto) {
              $("#chat-messages").animate({ scrollTop: $('#chat-messages')[0].scrollHeight}, 1000);
            }else{
              $("#mensajes-chat").append("<li class='friend'><div class='msg'>"+ mensajes[i].mensaje +"</div></li>");
              $("#chat-messages").animate({ scrollTop: $('#chat-messages')[0].scrollHeight}, 1000);
            }
          }
        };
      }
    });
  }

// Se guardan los mensajes enviados
  $("#enviarmensaje").on("click", function(){
    var mensaje = document.getElementById("mensajeusuario").value;
    var idcontacto = $("#idcontacto").val();
    $("#mensajes-chat").append("<li class='self'><div class='msg'>"+ mensaje +"</div></li>");
    if(mensaje == ""){
      alert("Escriba un mensaje para enviar.");
    }else{
      var opcion = "guardarmensaje";
      $.ajax({
        method: "POST",
        url: "../../../assets/php/app-chat.php",
        dataType: "json",
        data: {"opcion": opcion, "idcontacto": idcontacto, "mensaje": mensaje}
      }).done( function( data ){
        $("#mensajeusuario").val("");
      });
    }
  });

// Se muetra la lista de contactos nuevamente
  $("#contacto-title").on("click", "span.return", function(){
    $("#tab1").removeClass("chat-opened");
    listar_contactos();
    clearInterval(timer);
  });


  $("#lista-reciente").on("click", "div.user", function(){
    var idcontacto = $(this).attr('id');
    var opcion = "buscarmensajes";
    $.ajax({
      method: "POST",
      url: "../../../assets/php/app-chat.php",
      dataType: "json",
      data: {"opcion": opcion, "idcontacto": idcontacto}
    }).done( function( data ){
      console.log(data);
      var mensajes = data.mensajes;
      console.log(mensajes);
      $("#contacto-title").empty();
      $("#contacto-title").append("<div class='user'><img src='../../../assets/img/"+ data.contacto[0].avatar +"' alt='Avatar'><h2>"+ data.contacto[0].nombre + " " + data.contacto[0].apellidos +"</h2><span>Active 1h ago</span></div><span class='icon return mdi mdi-chevron-left'></span>");

      $("#mensajes-chat").empty();
      if(mensajes == 0){
        $("#tab1").addClass("chat-opened");
      }else{
        $("#tab1").addClass("chat-opened");
        for(var i=0;i<mensajes.length;i = i+1){
          if (mensajes[i].idcontacto == idcontacto) {
            $("#mensajes-chat").append("<li class='self'><div class='msg'>"+ mensajes[i].mensaje +"</div></li>");
          }else{
            $("#mensajes-chat").append("<li class='friend'><div class='msg'>"+ mensajes[i].mensaje +"</div></li>");
          }
        };
      }
    });
    $("#idcontacto").val(idcontacto);
  });
