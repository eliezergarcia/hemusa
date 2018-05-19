var App = (function () {
  'use strict';
  App.chat = function( ){
    $("#listar-contactos-chat").on("click", function(){
      var opcion = "listarcontactos";
      $.ajax({
        method: "POST",
        url: "../../../assets/php/app-chat.php",
        dataType: "json",
        data: {"opcion": opcion}
      }).done( function( data ){
        console.log(data);
        var usuarios = data.usuarios;
        $("#lista_contactos").empty();
        $("#lista-reciente").empty();
        for(var i=0;i<usuarios.length;i = i+1){
          if (usuarios[i].reciente == "no") {
            $("#lista-contactos").append("<div class='user' id='"+ usuarios[i].id +"'><a href='#'><img src='../../../assets/img/avatar4.png' alt='Avatar'><div class='user-data2'><span class='status'></span><span class='name contacto-chat'>"+ usuarios[i].nombre + " " + usuarios[i].apellidos +"</span></div></a></div>");
          }else{
            $("#lista-reciente").append("<div class='user' id='"+ usuarios[i].id +"'><a href='#'><img src='../../../assets/img/avatar4.png' alt='Avatar'><div class='user-data2'><span class='status'></span><span class='name contacto-chat'>"+ usuarios[i].nombre + " " + usuarios[i].apellidos +"</span><span class='message'>"+ usuarios[i].reciente +"</span></div></a></div>");
          }
        };
      });
    });

    $("#lista-contactos").on("click", "div.user", function(){
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
        $("#lista_contactos").empty();
        $("#lista-reciente").empty();
        $("#contacto-title").empty();
        $("#contacto-title").append("<div class='user'><img src='../../../assets/img/avatar2.png' alt='Avatar'><h2>"+ data.contacto[0].nombre + " " + data.contacto[0].apellidos +"</h2><span>Active 1h ago</span></div><span class='icon return mdi mdi-chevron-left'></span>");

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
        $("#contacto-title").append("<div class='user'><img src='../../../assets/img/avatar2.png' alt='Avatar'><h2>"+ data.contacto[0].nombre + " " + data.contacto[0].apellidos +"</h2><span>Active 1h ago</span></div><span class='icon return mdi mdi-chevron-left'></span>");

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

    var actualizarmensajes = function(idcontacto){
      // var idcontacto = $("#lista-contactos div.user").attr('id');
      console.log(idcontacto);
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
        // $("#contacto-title").empty();
        // $("#contacto-title").append("<div class='user'><img src='../../../assets/img/avatar2.png' alt='Avatar'><h2>"+ data.contacto[0].nombre + " " + data.contacto[0].apellidos +"</h2><span>Active 1h ago</span></div><span class='icon return mdi mdi-chevron-left'></span>");

        $("#mensajes-chat").empty();
        if(mensajes == 0){
          // $("#tab1").addClass("chat-opened");
        }else{
          // $("#tab1").addClass("chat-opened");
          for(var i=0;i<mensajes.length;i = i+1){
            if (mensajes[i].idcontacto == idcontacto) {
              $("#mensajes-chat").append("<li class='self'><div class='msg'>"+ mensajes[i].mensaje +"</div></li>");
            }else{
              $("#mensajes-chat").append("<li class='friend'><div class='msg'>"+ mensajes[i].mensaje +"</div></li>");
            }
          };
        }
      });
    }

    $("#contacto-title").on("click", "span.return", function(){
      $("#tab1").removeClass("chat-opened");
      $.ajax({
        method: "POST",
        url: "../../../assets/php/app-chat.php",
        dataType: "json",
        data: {"opcion": opcion}
      }).done( function( data ){
        console.log(data);
        var usuarios = data.usuarios;
        $("#lista_contactos").empty();
        $("#lista-reciente").empty();
        for(var i=0;i<usuarios.length;i = i+1){
          if (usuarios[i].reciente == "no") {
            $("#lista-contactos").append("<div class='user' id='"+ usuarios[i].id +"'><a href='#'><img src='../../../assets/img/avatar4.png' alt='Avatar'><div class='user-data2'><span class='status'></span><span class='name contacto-chat'>"+ usuarios[i].nombre + " " + usuarios[i].apellidos +"</span></div></a></div>");
          }else{
            $("#lista-reciente").append("<div class='user' id='"+ usuarios[i].id +"'><a href='#'><img src='../../../assets/img/avatar4.png' alt='Avatar'><div class='user-data2'><span class='status'></span><span class='name contacto-chat'>"+ usuarios[i].nombre + " " + usuarios[i].apellidos +"</span><span class='message'>"+ usuarios[i].reciente +"</span></div></a></div>");
          }
        };
      });
    });
  };

  return App;
})(App || {});
