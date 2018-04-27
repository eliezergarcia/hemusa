var buscar_oc_pendientes = function(){
    $.ajax({
		method: "POST",
		url: "../buscar_oc_pendientes.php",
		dataType: 'json',
	}).done( function( data ){
		console.log("data");
		ocpendientes = document.getElementById('ocpendientes');
        ocpendientes.setAttribute('data-badge', data.respuesta);
	});	
}