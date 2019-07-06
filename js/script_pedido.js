// listarPedido("");
var estado_listado_actual;

function listarPedido(estado_venta){

   estado_listado_actual = estado_venta;

		$.ajax({
			url:"./metodos_ajax/pedidos/mostrar_listado_pedido.php?estado_venta="+estado_venta,
			method:"POST",
			success:function(respuesta){
				 $("#contenedor_listado_pedido").html(respuesta);
			}
		});
}

function cambiarEstadoPedido(){

 var id_venta = $("#txt_id_venta").val();
 var tipo_entrega = $("#txt_tipo_entrega").val();

		$.ajax({
			url:"./metodos_ajax/pedidos/cambiar_estado_pedido.php?tipo_entrega="+tipo_entrega+"&id_venta="+id_venta+"&estado_actual="+estado_listado_actual,
			method:"POST",
			success:function(respuesta){
				// alert(respuesta);

				if(respuesta==1){
					swal("Guardado","Los datos se han guardado correctamente.","success");
					listarPedido(estado_listado_actual);
				}else if(respuesta==2){
					swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
				}

			}
		});
}


function listaVenta(venta){
// alert(venta);
		$.ajax({
			url:"./metodos_ajax/pedidos/mostrar_venta_pedido.php?id_venta="+venta+"&estado_listado_actual="+estado_listado_actual,
			method:"POST",
			success:function(respuesta){
				// alert(respuesta);
				 $("#contenedor_listado_venta").html(respuesta);
			}
		});
}


function cargarInformacion(venta, tipo_entrega){

  var txt_rut_cliente = $("#columna_rut_"+venta).html();

	//carga la informacion recibida en el modal
 $('#txt_tipo_entrega').val(tipo_entrega);
 $('#txt_id_venta').val(venta);

 $('#txt_rut_cliente').val(txt_rut_cliente);
 cargarInformacionCliente(txt_rut_cliente);

 listaVenta(venta);
}

function cargarInformacionCliente(texto_buscar){

		$.ajax({
			url:"./metodos_ajax/clientes/buscar_cliente_ventas.php?texto_buscar="+texto_buscar,
			method:"POST",
			dataType:"json",
			success:function(respuesta){

				 $("#txt_nombre").val(respuesta.nombre);
				 $("#txt_apellidos").val(respuesta.apellidos);
				 $("#txt_calle").val(respuesta.calle);
				 $("#txt_numero").val(respuesta.numero_calle);
				 $("#txt_observacion").val(respuesta.observacion_direccion);
				 $("#txt_telefono").val(respuesta.telefono);
			}
		});
}

function cargarInformacionVentaPedido(texto_buscar){

		$.ajax({
			url:"./metodos_ajax/pedidos/buscar_pedido_ventas.php?texto_buscar="+texto_buscar,
			method:"POST",
			dataType:"json",
			success:function(respuesta){

				 $("#id_producto").val(respuesta.id_producto);
				 $("#valor_unitario").val(respuesta.valor_unitario);
				 $("#cantidad").val(respuesta.cantidad);
				 $("#valor_total").val(respuesta.valor_total);
			}
		});
}


function limpiarFormularioUnidadMedida(){
   $("#formulario_modal_unidad_medida")[0].reset();
	 $('#txt_id_unidad_medida').attr("readonly",false);
	 $("#formulario_modal_unidad_medida").attr("action","javascript:guardarUnidadMedida()");

}


function pedidoFinalizado(id){


			$.ajax({
				url:"./metodos_ajax/pedidos/cambiar_estado_finalizado.php?id="+id,
				method:"POST",
				success:function(respuesta){
					 // alert(respuesta);
					 if(respuesta==1){
						 swal("Venta concretada","Los datos se han guardado correctamente.","success");
						 // listarUnidadMedida("");
					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
					 }
				}
			});

}


// function modificarProveedor(){
//
// 			$.ajax({
// 				url:"./metodos_ajax/marcas/modificar_subvencion.php",
// 				method:"POST",
// 				data: $("#formulario_modal_subvencion").serialize(),
// 				success:function(respuesta){
// 					 // alert(respuesta);
//
// 					 if(respuesta==1){
// 						 swal("Guardado","Los datos se han guardado correctamente.","success");
// 						 $("#modal_subvencion").modal('hide');
// 						 listarProveedor();
// 					 }else if(respuesta==2){
// 						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
// 				   }
// 				}
// 			});
//
// }
