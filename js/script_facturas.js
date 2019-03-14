

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


function guardarFactura(){

			$.ajax({
				url:"./metodos_ajax/facturas/ingresar_modificar_facturas.php",
				method:"POST",
				data: $("#formulario_modal_factura").serialize(),
				success:function(respuesta){
					  alert(respuesta);

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
					  alert(respuesta);

					 if(respuesta==1){
               guardarDetalleFactura();
					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
					 }
				}
			});
	}

function guardarDetalleFactura(){

			$.ajax({
				url:"./metodos_ajax/factura/guardarDetalleProductoFactura.php",
				method:"POST",
				data: $("#formulario_detalle_factura_producto").serialize(),
				success:function(respuesta){
					  alert(respuesta);

					 if(respuesta==1){
						 swal("Guardado","Los datos se han guardado correctamente.","success");
             //actualizar tabla detalle factura

					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
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

	$.ajax({
		url:"./metodos_ajax/productos/cargarDatosProducto.php?id_producto="+id_producto,
		method:"POST",
		dataType:"JSON",
		success:function(producto){

       // alert(producto.descripcion);

			 $("#txt_descripcion_producto").val(producto.descripcion);
			 $("#select_marca").val(producto.marca);
			 $("#select_categoria").val(producto.categoria);

		}
	});

}



function modificarProveedor(){

			$.ajax({
				url:"./metodos_ajax/subvencion/modificar_subvencion.php",
				method:"POST",
				data: $("#formulario_modal_subvencion").serialize(),
				success:function(respuesta){
					 // alert(respuesta);

					 if(respuesta==1){
						 swal("Guardado","Los datos se han guardado correctamente.","success");
						 $("#modal_subvencion").modal('hide');
						 listarProveedor();
					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
				   }
				}
			});

}

function eliminarProveedor(id){

			$.ajax({
				url:"./metodos_ajax/proveedores/eliminar_proveedor.php?id="+id,
				method:"POST",
				success:function(respuesta){
					 alert(respuesta);
					 if(respuesta==1){
						 swal("Eliminado correctamente","Los datos se han guardado correctamente.","success");
						 listarProveedor();
					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
					 }
				}
			});

}
