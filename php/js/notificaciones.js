var buscar_oc_pendientes = function(){
	var opcion = "buscarocpendientes";
	// console.log(opcion);
    $.ajax({
        method: "POST",
        url: "buscarnotificaciones.php",
		dataType: 'json',
		data: {"opcion": opcion},
    }).done( function( data ){
        // console.log(data);
        ocpendientes = document.getElementById('ocpendientes');
        ocpendientes.setAttribute('data-badge', data.respuesta);
    });	
}

function verproveedor(){
	var proveedor = $("#proveedoressinoc").val();
	window.location="../compras/proveedores/verContacto.php?id="+proveedor;
}

function verproveedor2(){
	var proveedor = $("#proveedoressinoc").val();
	window.location="../../compras/proveedores/verContacto.php?id="+proveedor;
}

$('#modalOCPendientes').on('show.bs.modal', function (e) {
	var opcion = "proveedoressinoc";
  	$.ajax({
		method: "POST",
		url: "buscarnotificaciones.php",
		dataType: 'json',
		data: {"opcion": opcion},
	}).done( function( data ){
		console.log(data);
		if (data != "") {
			var proveedores = data;
			$('#proveedoressinoc').empty();
			$("#proveedoressinoc").append("<option>Selecciona...</option>");		
			for(var i=0;i<proveedores.length;i=i+2){ 
	   	 		$("#proveedoressinoc").append("<option value="+ proveedores[i] +">" + proveedores[i+1] + "</option>");
			};
		}else{
			$("#proveedoressinoc").append("<option>No hay proveedores</option>");		
		}
	});	
})