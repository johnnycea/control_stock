


function cargarInformacionProveedor(texto_buscar){

	$("#txt_razon_social_proveedor").val('Cargando...');
	$("#txt_direccion_proveedor").val('Cargando...');
	$("#txt_telefono_proveedor").val('Cargando...');
	$("#txt_giro_proveedor").val('Cargando...');
	$("#txt_correo_proveedor").val('Cargando...');

		$.ajax({
			url:"./metodos_ajax/proveedores/buscar_proveedores_factura.php?texto_buscar="+texto_buscar,
			method:"POST",
			dataType:"json",
			success:function(respuesta){

				 $("#txt_razon_social_proveedor").val(respuesta.razon_social);
				 $("#txt_direccion_proveedor").val(respuesta.direccion);
				 $("#txt_telefono_proveedor").val(respuesta.telefono);
				 $("#txt_giro_proveedor").val(respuesta.giro);
				 $("#txt_correo_proveedor").val(respuesta.correo);
			}
		});
}



function listarFacturas(texto_buscar){


		$.ajax({
			url:"./metodos_ajax/facturas/mostrar_listado_facturas.php?texto_buscar="+texto_buscar,
			method:"POST",
			success:function(respuesta){
				// alert(respuesta);
				 $("#contenedor_listado_facturas").html(respuesta);
			}
		});
}
function listarDetalleFacturas(){

   var id_factura = $("#txt_id_factura").val();

		$.ajax({
			url:"./metodos_ajax/facturas/mostrar_listado_detalle_facturas.php?id_factura="+id_factura,
			method:"POST",
			success:function(respuesta){
				// alert(respuesta);
				 $("#contenedor_listado_detalle_facturas").html(respuesta);
			}
		});
}


function guardarFactura(){

			$.ajax({
				url:"./metodos_ajax/facturas/ingresar_modificar_facturas.php",
				method:"POST",
				data: $("#formulario_modal_factura").serialize(),
				success:function(respuesta){
					  // alert(respuesta);

					 if(respuesta==1){
						 swal("Guardado","Los datos se han guardado correctamente.","success");
						 $("#modal_factura").modal('hide');
						 listarFacturas("");
					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
					 }
				}
			});
	}

function guardarProductoFactura(){

			$.ajax({
				url:"./metodos_ajax/productos/ingresar_modificar_productos.php",
				method:"POST",
				data: $("#formulario_detalle_factura_producto").serialize(),
				success:function(respuesta){
					  // alert(respuesta);

					 if(respuesta==1){
               guardarDetalleFactura();
					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
					 }
				}
			});
	}

function guardarDetalleFactura(){


var total_factura = $("#txt_total_factura").val();

			$.ajax({
				url:"./metodos_ajax/facturas/guardarDetalleProductoFactura.php?total_factura="+total_factura,
				method:"POST",
				data: $("#formulario_detalle_factura_producto").serialize(),
				success:function(respuesta){
					  // alert(respuesta);

					 if(respuesta==1){
						 swal("Guardado","Los datos se han guardado correctamente.","success");
             //actualizar tabla detalle factura
						 listarDetalleFacturas();
					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");

					 }else if(respuesta==3){
						 swal("El producto ya fue ingresado en esta factura","","info");
					 }
				}
			});
	}


function limpiarFormularioFactura(){
   $("#formulario_modal_factura")[0].reset();
	 $('#txt_id_factura').attr("readonly",false);
	 $("#formulario_modal_factura").attr("action","javascript:guardarFactura()");

}

function cargarDatosProducto(id_producto){

if(id_producto!=0 || id_producto!=""){

				$.ajax({
					url:"./metodos_ajax/productos/cargarDatosProducto.php?id_producto="+id_producto,
					method:"POST",
					dataType:"JSON",
					success:function(producto){
		    	// alert(producto);

						 $("#txt_descripcion_producto").val(producto.descripcion);
						 $("#txt_marca").val(producto.marca);
						 $("#select_unidad_medida").val(producto.unidad_medida);
						 $("#txt_stock_minimo").val(producto.stock_minimo);


					}
				});
}else{
	// alert("no");
}

}

function cargarInformacionFactura(id){

	var txt_id_factura = id;
	var txt_rut_proveedor = $("#columna_rut_proveedor_"+id).html();
	// var txt_razon_social_proveedor = $("#columna_razon_social_"+id).html();
	// var txt_giro_proveedor = $("#columna_giro_proveedor_"+id).html();
	// var txt_direccion_proveedor = $("#columna_direccion_"+id).html();
	// var txt_telefono_proveedor = $("#columna_telefono_"+id).html();
	// var txt_correo_proveedor = $("#columna_correo_"+id).html();
	 var txt_numero_factura = $("#columna_numero_factura_"+id).html();
	 var txt_fecha_factura = $("#columna_fecha_factura_"+id).html();

	 $("#txt_id_factura").val(txt_id_factura);
	 $("#txt_rut_proveedor").val(txt_rut_proveedor);
	 // $("#txt_dv_proveedor").val(txt_dv_proveedor);
	 // $("#txt_razon_social_proveedor").val(txt_razon_social_proveedor);
	 // $("#txt_giro_proveedor").val(txt_giro_proveedor);
	 // $("#txt_direccion_proveedor").val(txt_direccion_proveedor);
	 // $("#txt_telefono_proveedor").val(txt_telefono_proveedor);
	 // $("#txt_correo_proveedor").val(txt_correo_proveedor);
	 $("#txt_numero_factura").val(txt_numero_factura);
	 $("#txt_fecha_factura").val(txt_fecha_factura);

	 cargarInformacionProveedor(txt_rut_proveedor);
	 }

function cargarInformacionModificarDetalleFactura(id){

	 var txt_codigo_producto = $("#columna_codigo_"+id).html();
	 var descripcion_producto = $("#columna_descripcion_"+id).html();

	 var marca = $("#columna_marca_"+id).html();
	 var unidad_medida = $("#columna_unidad_medida_"+id).html();

	 var txt_stock_minimo = $("#columna_txt_stock_minimo_"+id).html();

	 var txt_cantidad = $("#columna_cantidad_"+id).html();

	 var txt_valor_unitario = $("#columna_valor_"+id).html();

	 $("#txt_codigo_producto").val(txt_codigo_producto);
	 $("#txt_descripcion_producto").val(descripcion_producto);
	 $("#txt_marca").val(marca);
	 $("#txt_stock_minimo").val(txt_stock_minimo);
	 $("#txt_cantidad").val(txt_cantidad);
	 $("#txt_valor_unitario").val(txt_valor_unitario);

	 $("#select_unidad_medida").val(unidad_medida);

			 $('html,body').animate({
				 scrollTop: $("#formulario_detalle_factura_producto").offset().top
			}, 1200);
	 }

function modificarDetalleFactura(id){

			$.ajax({
				url:"./metodos_ajax/facturas/ingresar_modificar_detalle_facturas.php?id="+id,
				method:"POST",
				success:function(respuesta){
					 // alert(respuesta);
					 if(respuesta==1){
						 swal("Eliminado correctamente","Los datos se han guardado correctamente.","success");
						 listarProveedor();
					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
					 }
				}
			});
}

function eliminarDetalleFactura(id_producto,id_factura){

	var total_factura = $("#txt_total_factura").val();


			$.ajax({
				url:"./metodos_ajax/facturas/eliminar_detalle_facturas.php?id_producto="+id_producto+"&id_factura="+id_factura+"&total_factura="+total_factura,
				method:"POST",
				success:function(respuesta){
					 // alert(respuesta);
					 if(respuesta==1){
						 swal("Eliminado correctamente","Los datos se han guardado correctamente.","success");
						 listarDetalleFacturas("");
					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
					 }
				}
			});

}

function eliminarFactura(id_factura){

			$.ajax({
				url:"./metodos_ajax/facturas/eliminar_facturas.php?id_factura="+id_factura,
				method:"POST",
				success:function(respuesta){
					 // alert(respuesta);
					 if(respuesta==1){
						 swal("Eliminado correctamente","Los datos se han guardado correctamente.","success");
						 listarFacturas("");
					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
					 }
				}
			});

}
