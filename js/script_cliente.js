listarCliente("");

function listarCliente(texto_buscar){


		$.ajax({
			url:"./metodos_ajax/clientes/mostrar_listado_cliente.php?texto_buscar="+texto_buscar,
			method:"POST",
			success:function(respuesta){
				// alert(respuesta);
				 $("#contenedor_listado_cliente").html(respuesta);
			}
		});
}

function crearCliente(){

			$.ajax({
				url:"./metodos_ajax/clientes/ingresar_modificar_cliente.php",
				method:"POST",
				data: $("#formulario_modal_cliente").serialize(),
				success:function(respuesta){
					  // alert(respuesta);
					 if(respuesta==1){
						 swal("Guardado","Los datos se han guardado correctamente.","success");
						 $("#modal_cliente").modal('hide');
						 listarCliente("");
					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
					 }
				}
			});
	}


function limpiarFormularioUnidadMedida(){
   $("#formulario_modal_unidad_medida")[0].reset();
	 $('#txt_id_unidad_medida').attr("readonly",false);
	 $("#formulario_modal_unidad_medida").attr("action","javascript:guardarUnidadMedida()");

}

function cargarInformacionClientes(id){

  var txt_rut = $("#txt_rut_"+id).html();
  var txt_dv = $("#txt_dv_"+id).html();
	var txt_nombre = $("#txt_nombre_"+id).html();
	var txt_apellidos = $("#txt_apellidos_"+id).html();
	var txt_calle = $("#txt_calle_"+id).html();
	var txt_numero = $("#txt_numero_calle_"+id).html();
	var txt_observacion = $("#txt_observacion_"+id).html();
	var txt_telefono = $("#txt_telefono_"+id).html();

	//carga la informacion recibida en el modal
 $('#txt_rut_cliente').val(txt_rut);
 $('#txt_dv').val(txt_dv);
	$('#txt_nombre').val(txt_nombre);
	$('#txt_apellidos').val(txt_apellidos);
	$('#txt_calle').val(txt_calle);
	$('#txt_numero').val(txt_numero);
	$('#txt_observacion').val(txt_observacion);
	$('#txt_telefono').val(txt_telefono);
}

function eliminarCliente(id){

			$.ajax({
				url:"./metodos_ajax/clientes/eliminar_cliente.php?id="+id,
				method:"POST",
				success:function(respuesta){
					 // alert(respuesta);
					 if(respuesta==1){
						 swal("Eliminado correctamente","Los datos se han guardado correctamente.","success");
						 listarCliente("");
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
