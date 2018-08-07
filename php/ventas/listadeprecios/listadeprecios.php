<?php
	require_once('../../conexion.php'); // Llamada a connect.php para establecer conexión con la BD
	require_once('../../sesion.php'); // Llamada a sesion.php para validar si hay sesión inciada
	error_reporting(0);

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Lista de precios</title>
	<?php include('../../enlacescss.php'); ?>
</head>
<body>

	<?php include('../../header.php'); ?>
		<div class="be-content">
          	<div class="page-head">
              	<h2 class="page-head-title" style="font-size: 30px;"><b>Lista de precios</b></h2>
              	<nav aria-label="breadcrumb" role="navigation">
	                <ol class="breadcrumb page-head-nav">
	                    <li class="breadcrumb-item"><a href="#">Ventas</a></li>
	                    <li class="breadcrumb-item"><a href="#">Lista de precios</a></li>
	                </ol>
              	</nav>
          	</div>
          	<div class="main-content container-fluid">
              	<div class="row full-calendar">
                	<div class="col-lg-12">
                    	<div class="card card-fullcalendar">
                      		<div class="card-body">
														<div class="row table-filters-container">
						                  <div class="col-12">
						                    <div class="row align-items-end">
						                      <div class="col-3 table-filters"><span class="table-filter-title">Filtro</span>
						                        <div class="filter-container">
																			<form>
						                            <div class="row align-items-end">
						                              <div class="col-6">
																						<label class="control-label">Palabra:</label>
																						<input id="palabraBusca" name="palabraBusca" type="text" class="form-control form-control-sm"  autofocus required>
						                              </div>
						                              <div class="col-4">
																						<label class="control-label">Marca:</label>
																						<input id="marcaBuscar" class="awesomplete form-control form-control-sm" list="mylist" />
																						<datalist id="mylist">
																							<?php
																					        	include("../../conexion.php");
																						        $result = mysqli_query($conexion_usuarios, "SELECT marca FROM marcadeherramientas ORDER BY marca");
																								// echo '<select id="marcaBuscar" name="marcaBuscar" class="form-control">';
																								while ($row = mysqli_fetch_array($result)) {
																									echo '<option value="'.$row['marca'].'">'.$row['marca'].'</option>';
																									}
																								echo '<option value="todo" selected="selected">Todo</option>';
																								echo '</select>';
																							?>
																						</datalist>
						                              </div>
																					<div class="col-2">
																						<button id="btn_listar_precios" class="btn btn-lg btn-primary"><i class="fas fa-search fa-sm"></i> Buscar</button>
																					</div>
						                            </div>
						                          </form>
						                        </div>
						                      </div>
																	<div class="col-3 table-filters"><span class="table-filter-title"></span>
						                        <div class="filter-container">
																			<form>
						                            <div class="row align-items-end">
																					<div class="col-2">
																						<button class="btn btn-lg btn-success" style="margin-left: 10px;" data-toggle='modal' data-target='#modalAgregarHerramienta'><i class="fas fa-wrench fa-sm"></i> Agregar herramienta</button>
																					</div>
						                            </div>
						                          </form>
						                        </div>
						                      </div>
																</div>
						                  </div>
														</div>

													<!-- Tabla Lista de precios -->
														<table id="dt_precios" class="table table-striped table-hover display compact" cellspacing="0" width="100%">
															<thead>
																<tr>
																	<th>Marca</th>
																	<th>Modelo</th>
																	<th>Descripción</th>
																	<th>Precio lista</th>
																	<th>Precio IVA</th>
																	<th>Almacen</th>
																	<th>Moneda</th>
																	<th>Clase</th>
																	<th>IGI</th>
																	<th>Estándar</th>
																	<th>Unidad</th>
																	<th>Clave SAT</th>
																	<th>Pág. Catálogo</th>
																	<th>Sec. Catálogo</th>
																	<th>IVA</th>
																	<th>Mes Promoción</th>
																	<th>Desc.</th>
																	<th>Editar</th>
																</tr>
															</thead>
														</table>
                      		</div>
                    	</div>
                	</div>
            	</div>
      		</div>
    	</div>

		<!-- Modal Informacion Herramienta -->
			<form action="" method="POST">
				<div class="modal fade colored-header colored-header-primary" id="modalInformacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
			  		<div class="modal-dialog modal-lg" role="document">
			    		<div class="modal-content">
			      			<div class="modal-header">
			        			<h4 class="modal-title" id="exampleModalLabel"><b>Información de herramienta</b></h4>
			        			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          				<span aria-hidden="true">&times;</span>
			        			</button>
			      			</div>
			      			<div class="modal-body row">
		        				<input type="hidden" class="form-control" name="idproducto" id="idproducto">
										<input type="hidden" class="form-control" name="opcion" id="opcion" value="editarproducto">
		        				<div class="form-group col-6">
		        					<label for="">Marca <font color="#FF4136">*</font></label>
		        					<input type="text" class="form-control form-control-sm" name="marca" id="marca" required="">
		        				</div>
		        				<div class="form-group col-6">
		        					<label for="">Modelo <font color="#FF4136">*</font></label>
		        					<input type="text" class="form-control form-control-sm" name="modelo" id="modelo" required="">
		        				</div>
										<div class="form-group col-6">
		        					<label for="">Costo <font color="#FF4136">*</font></label>
		        					<input type="text" class="form-control form-control-sm" name="costo" id="costo" required="">
		        				</div>
		        				<div class="form-group col-6">
		        					<label for="">IGI <font color="#FF4136">*</font></label>
		        					<input type="text" class="form-control form-control-sm" name="igi" id="igi" required="">
		        				</div>
		        				<div class="form-group col-12">
		        					<label for="">Descripción <font color="#FF4136">*</font></label>
		        					<input type="text" class="form-control form-control-sm" name="descripcion" id="descripcion" required="">
		        				</div>
										<div class="form-group col-4">
		        					<label for="">Stock <font color="#FF4136">*</font></label>
		        					<input type="text" class="form-control form-control-sm" name="stock" id="stock" required="">
		        				</div>
		        				<div class="form-group col-4">
		        					<label for="">Clase <font color="#FF4136">*</font></label>
											<select class="form-control form-control-sm" name="clase" id="clase" required>
												<option value="A">A</option>
												<option value="E">E</option>
												<option value="D">D</option>
											</select>
		        				</div>
										<div class="form-group col-4">
		        					<label for="">Moneda <font color="#FF4136">*</font></label>
											<select class="form-control form-control-sm" name="moneda" id="moneda" required>
												<option value="mxn">MXN</option>
												<option value="usd">USD</option>
											</select>
		        				</div>
		        				<div class="form-group col-6">
											<label for="">Unidad <font color="#FF4136">*</font></label>
		        					<select class="form-control form-control-sm" name="unidad" id="unidad" required>
												<option>PIEZA</option>
												<option>PAR</option>
												<option>KIT</option>
												<option>CAJA</option>
												<option>CONJUNTO</option>
												<option>TARIFA</option>
												<option>UNIDAD DE SERVICIO</option>
												<option>BLOQUE</option>
												<option>LITRO</option>
												<option>GALÓN</option>
												<option>PAQUETE</option>
												<option>ELEMENTO</option>
												<option>GRAMO</option>
												<option>KILOGRAMO</option>
												<option>CENTRIMETRO CUADRADO</option>
												<option>PULGADA</option>
												<option>METRO</option>
												<option>METRO CUADRADO</option>
												<option>METRO CUBICO</option>
												<option>PIE</option>
												<option>YARDA</option>
												<option>MILLA</option>
												<option>VARIEDAD</option>
											</select>
		        				</div>
										<div class="form-group col-6">
		        					<label for="">Clave SAT <font color="#FF4136">*</font></label>
		        					<input type="text" class="form-control form-control-sm" name="claveSat" id="claveSat" required="">
		        				</div>
										<div class="form-group col-4">
		        					<label for="">Estándar </label>
		        					<input type="text" class="form-control form-control-sm" name="estandar" id="estandar">
		        				</div>
										<div class="form-group col-4">
		        					<label for="">Página de catálogo </label>
		        					<input type="text" class="form-control form-control-sm" name="paginaCatalogo" id="paginaCatalogo">
		        				</div>
										<div class="form-group col-4">
		        					<label for="">Sección de catálogo </label>
		        					<input type="text" class="form-control form-control-sm" name="seccionCatalogo" id="seccionCatalogo">
		        				</div>
										<div class="form-group col-6">
		        					<label for="">Código de barras </label>
		        					<input type="text" class="form-control form-control-sm" name="codigoBarras" id="codigoBarras">
		        				</div>
										<div class="form-group col-6">
		        					<label for="">Mes de promoción </label>
											<select class="form-control form-control-sm" name="mesPromocion" id="mesPromocion">
												<option value=""></option>
												<option>Enero</option>
												<option>Febrero</option>
												<option>Marzo</option>
												<option>Abril</option>
												<option>Mayo</option>
												<option>Junio</option>
												<option>Julio</option>
												<option>Agosto</option>
												<option>Septiembre</option>
												<option>Octubre</option>
												<option>Noviembre</option>
												<option>Diciembre</option>
											</select>
		        				</div>
			      			</div>
			      			<div class="modal-footer invoice-footer">
			        			<button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cancelar</button>
			        			<button type="submit" class="btn btn-lg btn-primary">Guardar</button>
			        			</form>
			      			</div>
			    		</div>
			  		</div>
				</div>
			</form>

		<!-- Modal Agregar Herramienta -->
			<form action="" id="frmAgregarHerramienta" method="POST">
				<div class="modal fade colored-header colored-header-success" id="modalAgregarHerramienta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
			  		<div class="modal-dialog modal-lg" role="document">
			    		<div class="modal-content">
			      			<div class="modal-header">
			        			<h4 class="modal-title" id="exampleModalLabel"><b>Nueva herramienta</b></h4>
			        			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          				<span aria-hidden="true">&times;</span>
			        			</button>
			      			</div>
			      			<div class="modal-body row">
		        				<input type="hidden" class="form-control" name="idproducto" id="idproducto">
										<input type="hidden" class="form-control" name="opcion" id="opcion" value="agregarherramienta">
		        				<div class="form-group col-6">
		        					<label for="">Marca <font color="#FF4136">*</font></label>
		        					<input type="text" class="form-control form-control-sm" name="marca" id="marcaAgregar" required="">
		        				</div>
		        				<div class="form-group col-6">
		        					<label for="">Modelo <font color="#FF4136">*</font></label>
		        					<input type="text" class="form-control form-control-sm" name="modelo" id="modelo" required="">
		        				</div>
										<div class="form-group col-6">
		        					<label for="">Costo <font color="#FF4136">*</font></label>
		        					<input type="text" class="form-control form-control-sm" name="costo" id="costo" required="">
		        				</div>
		        				<div class="form-group col-6">
		        					<label for="">IGI <font color="#FF4136">*</font></label>
		        					<input type="text" class="form-control form-control-sm" name="igi" id="igi" required="">
		        				</div>
		        				<div class="form-group col-12">
		        					<label for="">Descripción <font color="#FF4136">*</font></label>
		        					<input type="text" class="form-control form-control-sm" name="descripcion" id="descripcion" required="">
		        				</div>
										<div class="form-group col-4">
		        					<label for="">Stock <font color="#FF4136">*</font></label>
		        					<input type="text" class="form-control form-control-sm" name="stock" id="stock" required="">
		        				</div>
		        				<div class="form-group col-4">
		        					<label for="">Clase <font color="#FF4136">*</font></label>
											<select class="form-control form-control-sm" name="clase" id="clase" required>
												<option value="A">A</option>
												<option value="E">E</option>
												<option value="D">D</option>
											</select>
		        				</div>
										<div class="form-group col-4">
		        					<label for="">Moneda <font color="#FF4136">*</font></label>
											<select class="form-control form-control-sm" name="moneda" id="moneda" required>
												<option value="mxn">MXN</option>
												<option value="usd">USD</option>
											</select>
		        				</div>
		        				<div class="form-group col-6">
											<label for="">Unidad <font color="#FF4136">*</font></label>
		        					<select class="form-control form-control-sm" name="unidad" id="unidad" required>
												<option>PIEZA</option>
												<option>PAR</option>
												<option>KIT</option>
												<option>CAJA</option>
												<option>CONJUNTO</option>
												<option>TARIFA</option>
												<option>UNIDAD DE SERVICIO</option>
												<option>BLOQUE</option>
												<option>LITRO</option>
												<option>GALÓN</option>
												<option>PAQUETE</option>
												<option>ELEMENTO</option>
												<option>GRAMO</option>
												<option>KILOGRAMO</option>
												<option>CENTRIMETRO CUADRADO</option>
												<option>PULGADA</option>
												<option>METRO</option>
												<option>METRO CUADRADO</option>
												<option>METRO CUBICO</option>
												<option>PIE</option>
												<option>YARDA</option>
												<option>MILLA</option>
												<option>VARIEDAD</option>
											</select>
		        				</div>
										<div class="form-group col-6">
		        					<label for="">Clave SAT <font color="#FF4136">*</font></label>
		        					<input type="text" class="form-control form-control-sm" name="claveSat" id="claveSat" required="">
		        				</div>
										<div class="form-group col-4">
		        					<label for="">Estándar </label>
		        					<input type="text" class="form-control form-control-sm" name="estandar" id="estandar">
		        				</div>
										<div class="form-group col-4">
		        					<label for="">Página de catálogo </label>
		        					<input type="text" class="form-control form-control-sm" name="paginaCatalogo" id="paginaCatalogo">
		        				</div>
										<div class="form-group col-4">
		        					<label for="">Sección de catálogo </label>
		        					<input type="text" class="form-control form-control-sm" name="seccionCatalogo" id="seccionCatalogo">
		        				</div>
										<div class="form-group col-6">
		        					<label for="">Código de barras </label>
		        					<input type="text" class="form-control form-control-sm" name="codigoBarras" id="codigoBarras">
		        				</div>
										<div class="form-group col-6">
		        					<label for="">Mes de promoción </label>
											<select class="form-control form-control-sm" name="mesPromocion" id="mesPromocion">
												<option value=""></option>
												<option>Enero</option>
												<option>Febrero</option>
												<option>Marzo</option>
												<option>Abril</option>
												<option>Mayo</option>
												<option>Junio</option>
												<option>Julio</option>
												<option>Agosto</option>
												<option>Septiembre</option>
												<option>Octubre</option>
												<option>Noviembre</option>
												<option>Diciembre</option>
											</select>
		        				</div>
			      			</div>
			      			<div class="modal-footer invoice-footer">
			        			<button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cancelar</button>
			        			<button type="submit" class="btn btn-lg btn-success">Guardar</button>
			        			</form>
			      			</div>
			    		</div>
			  		</div>
				</div>
			</form>

	<header>
	<?php include('../../enlacesjs.php'); ?>
	<script>
		$(document).ready(function(){
			App.init();
			App.megaMenu();
  		App.pageCalendar();
  		App.formElements();
  		App.uiNotifications();
			nav_active();
			prettyPrint();
			guardar();
		});

		function nav_active () {
			$(".nav-item").removeClass("open section-active");
      $("#ventas-menu").addClass("open section-active");

      $(".nav-link").removeClass("active");
			$("#listaprecios-menu").addClass("active");
    }

		$("#btn_listar_precios").on("click", function(){
			listar();
		});

		var listar = function(){
			var palabraBusca = $("#palabraBusca").val(),
				marcaBuscar = $("#marcaBuscar").val();
			if (marcaBuscar == "") {
				marcaBuscar = "todo";
			}
			var table = $("#dt_precios").DataTable({
				"destroy": true,
				"DeferRender": true,
				"scrollX": true,
				"autoWidth": false,
				"ajax":{
					"method":"POST",
					"url":"listar.php",
					"data": {
						"palabraBusca": palabraBusca,
						"marcaBuscar": marcaBuscar
					}
				},
				"columns":[
					{"data":"marca"},
					{"data":"modelo"},
					{"data":"descripcion"},
					{"data":"precioLista"},
					{"data":"precioIVA"},
					{"data":"almacen"},
					{"data":"moneda"},
					{"data":"clase"},
					{"data":"igi"},
					{"data":"estandar"},
					{"data":"unidad"},
					{"data":"clavesat"},
					{"data":"pagcatalogo"},
					{"data":"seccatalogo"},
					{"data":"iva"},
					{"data":"mespromocion"},
					{"data":"descuento"},
					{"defaultContent": "<div class='invoice-footer'><button class='editar btn btn-space btn-lg btn-primary' data-toggle='modal' data-target='#modalInformacion'><i class='fas fa-edit fa-sm' aria-hidden='true'></i></button></div>"}
				],
				"columnDefs": [
					{ "width": "6%", "targets": 0 },
					{ "width": "6%", "targets": 1 },
					{ "width": "8%", "targets": 3 },
					{ "width": "8%", "targets": 4 },
					{ "width": "5%", "targets": 5 },
					{ "width": "5%", "targets": 6 },
					{ "width": "5%", "targets": 7 },
					{ "width": "5%", "targets": 8 },
					{ "width": "6%", "targets": 9 },
					{ "width": "6%", "targets": 10 },
					{ "visible": false, "targets": 11 },
					{ "visible": false, "targets": 12 },
					{ "visible": false, "targets": 13 },
					{ "width": "5%", "targets": 14 },
					{ "visible": false, "targets": 15 },
					{ "width": "5%", "targets": 16 },
				],
        "lengthChange": false,
				 "pageLength": 30,
				"language": idioma_espanol,
				"dom":
    			"<'row be-datatable-header'<'col-sm-6'B><'col-sm-6 text-right'f>>" +
    			"<'row be-datatable-body'<'col-sm-12'tr>>" +
    			"<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>",
				"createdRow": function ( row, data, index ) {
					console.log(data.clase);
					if ( data.clase == "E" ) {
							$('td', row).eq(0).addClass('table-text-claseE');
							$('td', row).eq(1).addClass('table-text-claseE');
							$('td', row).eq(2).addClass('table-text-claseE');
							$('td', row).eq(3).addClass('table-text-claseE');
							$('td', row).eq(4).addClass('table-text-claseE');
							$('td', row).eq(5).addClass('table-text-claseE');
							$('td', row).eq(6).addClass('table-text-claseE');
							$('td', row).eq(7).addClass('table-text-claseE');
							$('td', row).eq(8).addClass('table-text-claseE');
							$('td', row).eq(9).addClass('table-text-claseE');
							$('td', row).eq(10).addClass('table-text-claseE');
							$('td', row).eq(11).addClass('table-text-claseE');
							$('td', row).eq(12).addClass('table-text-claseE');
							$('td', row).eq(13).addClass('table-text-claseE');
							$('td', row).eq(14).addClass('table-text-claseE');
							$('td', row).eq(15).addClass('table-text-claseE');
							$('td', row).eq(16).addClass('table-text-claseE');
					}
					if ( data.clase == "D" ) {
							$('td', row).eq(0).addClass('table-text-claseD');
							$('td', row).eq(1).addClass('table-text-claseD');
							$('td', row).eq(2).addClass('table-text-claseD');
							$('td', row).eq(3).addClass('table-text-claseD');
							$('td', row).eq(4).addClass('table-text-claseD');
							$('td', row).eq(5).addClass('table-text-claseD');
							$('td', row).eq(6).addClass('table-text-claseD');
							$('td', row).eq(7).addClass('table-text-claseD');
							$('td', row).eq(8).addClass('table-text-claseD');
							$('td', row).eq(9).addClass('table-text-claseD');
							$('td', row).eq(10).addClass('table-text-claseD');
							$('td', row).eq(11).addClass('table-text-claseD');
							$('td', row).eq(12).addClass('table-text-claseD');
							$('td', row).eq(13).addClass('table-text-claseD');
							$('td', row).eq(14).addClass('table-text-claseD');
							$('td', row).eq(15).addClass('table-text-claseD');
							$('td', row).eq(16).addClass('table-text-claseD');
					}
				},
				"buttons":[
					{
						extend: 'colvis',
						columns: ':not(.noVis)',
						text: '<i class="fas fa-columns fa-sm"></i> Columnas',
						"className": "btn btn-lg btn-space btn-secondary",
					},
		            {
		            extend: 'collection',
		            text: '<i class="fas fa-table fa-sm"></i> Exportar tabla',
		            "className": "btn btn-lg btn-space btn-secondary",
		            buttons: [
		                {
		                  extend:    'excelHtml5',
		                  text:      '<i class="fas fa-file-excel fa-lg"></i> Excel',
		                  // "className": "btn btn-lg btn-space btn-secondary",
		                  exportOptions: {
		                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
		                  }
		                },
		                {
		                  extend: 'csv',
		                  text: '<i class="fas fa-file-alt fa-lg"></i> Csv',
		                  // "className": "btn btn-lg btn-space btn-secondary",
		                  exportOptions: {
		                          columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
		                  }
		                },
		                {
		                  extend:    'pdfHtml5',
		                  text:      '<i class="fas fa-file-pdf fa-lg"></i> Pdf',
		                  download: 'open',
		                  // "className": "btn btn-lg btn-space btn-secondary",
		                  exportOptions: {
		                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
		                  }
		                },
		                {
		                  extend: 'print',
		                  text: '<i class="fas fa-print fa-lg"></i> Imprimir',
		                  header: 'false',
		                  exportOptions: {
		                          columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
		                  },
		                  orientation: 'landscape',
		                  pageSize: 'LEGAL'
		                }
		            ]
		          }
				]
			});

			obtener_data_herramienta("#dt_precios tbody", table);
		}

		var guardar = function(){
			$("form").on("submit", function(e){
				e.preventDefault();
				$(".modal").modal("hide");
				var frm = $(this).serialize();
				console.log(frm);
				$.ajax({
					method: "POST",
					url: "guardar.php",
					data: frm
				}).done( function( info ){
					var json_info = JSON.parse( info );
					mostrar_mensaje(json_info);
					$('#dt_precios').DataTable().ajax.reload();
					document.getElementById("frmAgregarHerramienta").reset();
				});
			});
		}

		var obtener_data_herramienta = function(tbody, table){
			$('#dt_precios tbody').off('click');
			$(tbody).on("click", "button.editar", function(){
				var data = table.row( $(this).parents("tr") ).data();
				console.log(data);
				$("#idproducto").val(data.idproducto);
				$("#marca").val(data.marca);
				$("#modelo").val(data.modelo);
				$("#costo").val(data.costo);
				$("#igi").val(data.igi);
				$("#descripcion").val(data.descripcion);
				$("#stock").val(data.almacen);
				$("#clase").val(data.clase).change();
				$("#moneda").val((data.moneda).toLowerCase()).change();
				$("#unidad").val(data.unidad);
				$("#claveSat").val(data.clavesat);
				$("#estandar").val(data.estandar);
				$("#paginaCatalogo").val(data.pagcatalogo);
				$("#seccionCatalogo").val(data.seccatalogo);
				$("#codigoBarras").val(data.codigobarras);
				$("#mesPromocion").val(data.mespromocion).change();
			});
		}

		$('#modalAgregarHerramienta').on('shown.bs.modal', function () {
			var opcion = "marcas";
			$.ajax({
				method: "POST",
				url: "buscar.php",
				dataType: "json",
				data: {"opcion": opcion},
				success : function(data) {
					var marcas = data;
					console.log(marcas);
					var input = document.getElementById("marcaAgregar");
					var awesomplete = new Awesomplete(input);
					awesomplete.list = marcas;
					$("#frmAgregarHerramienta #marcaAgregar").focus();
				}
			});
		})
	</script>
	<script type="text/javascript" src="<?php echo $ruta; ?>php/js/idioma_espanol.js"></script>
	<script type="text/javascript" src="<?php echo $ruta; ?>php/js/mensajes_cambios.js"></script>
</body>
</html>
