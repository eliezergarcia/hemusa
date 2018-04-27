$(buscar_contactos());

function buscar_contactos(consulta){
	$.ajax({
		url: 'App/buscar.php',
		type: 'POST',
		dataType: 'html',
		data: {consulta: consulta},
	})	
	.done(function(respuesta){
		$('#datos').html(respuesta);
	})
	.fail(function(){
		console.log("error");
	})
}	

$(document).on('keyup','#caja_busqueda', function(){
	var valor = $(this).val();
	if(valor != ""){
		buscar_contactos(valor);
	}else{
		buscar_contactos();
	}
});