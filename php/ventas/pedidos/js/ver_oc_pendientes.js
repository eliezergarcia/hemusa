$('#modalOCPendientes').on('show.bs.modal', function (e) {
	var opcion = "proveedoressinoc";
  	$.ajax({
		method: "POST",
		url: "../buscar.php",
		dataType: 'json',
		data: {"opcion": opcion},
	}).done( function( data ){
		console.log(data);
		console.log(data);
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