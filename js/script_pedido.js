listarPedido("");

function listarPedido(texto_buscar){


		$.ajax({
			url:"./metodos_ajax/pedidos/mostrar_listado_pedido.php?texto_buscar="+texto_buscar,
			method:"POST",
			success:function(respuesta){
				 // alert(respuesta);
				 $("#contenedor_listado_pedido").html(respuesta);
			}
		});
}

function cargarInformacion(id){

  var txt_rut_cliente = $("#columna_rut_"+id).html();

	//carga la informacion recibida en el modal
 $('#txt_rut_cliente').val(txt_rut_cliente);
 cargarInformacionCliente(txt_rut_cliente);
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


function limpiarFormularioUnidadMedida(){
   $("#formulario_modal_unidad_medida")[0].reset();
	 $('#txt_id_unidad_medida').attr("readonly",false);
	 $("#formulario_modal_unidad_medida").attr("action","javascript:guardarUnidadMedida()");

}


function eliminarUnidad_medida(id){

			$.ajax({
				url:"./metodos_ajax/unidadMedida/eliminar_unidad_medida.php?id="+id,
				method:"POST",
				success:function(respuesta){
					 alert(respuesta);
					 if(respuesta==1){
						 swal("Eliminado correctamente","Los datos se han guardado correctamente.","success");
						 listarUnidadMedida("");
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
