var mostrar_mensaje = function( mensaje ){
	if( mensaje.respuesta == "BIEN" ){
		$.gritter.add({
    	title: 'Correcto!',
    	text: mensaje.informacion,
    	class_name: 'color success'
  	});
	}else if( mensaje.respuesta == "ERROR"){
		$.gritter.add({
      title: 'Error!',
      text: mensaje.informacion,
      class_name: 'color danger'
    });
	}else if( mensaje.respuesta == "EXISTE" ){
		$.gritter.add({
    	title: 'Advertencia!',
    	text: mensaje.informacion,
    	class_name: 'color warning'
  	});
	}else if( mensaje.respuesta == "VACIO" ){
		$.gritter.add({
    	title: 'Advertencia!',
    	text: mensaje.informacion,
    	class_name: 'color warning'
  	});
	}else if( informacion.respuesta == "OPCION_VACIA"){
		$.gritter.add({
    	title: 'Advertencia!',
    	text: mensaje.informacion,
    	class_name: 'color warning'
  	});
	}
}