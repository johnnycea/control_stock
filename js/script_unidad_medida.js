listarUnidadMedida("");

function listarUnidadMedida(texto_buscar){


		$.ajax({
			url:"./metodos_ajax/unidadMedida/mostrar_listado_unidad_medida.php?texto_buscar="+texto_buscar,
			method:"POST",
			success:function(respuesta){
				// alert(respuesta);
				 $("#contenedor_listado_unidad_medida").html(respuesta);
			}
		});
}

function guardarUnidadMedida(){

			$.ajax({
				url:"./metodos_ajax/unidadMedida/ingresar_modificar_unidad_medida.php",
				method:"POST",
				data: $("#formulario_modal_unidad_medida").serialize(),
				success:function(respuesta){
					  // alert(respuesta);
					 if(respuesta==1){
						 swal("Guardado","Los datos se han guardado correctamente.","success");
						 $("#modal_unidad").modal('hide');
						 listarUnidadMedida("");
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

function cargarInformacionModificarUnidad(id){

  var txt_id_unidad_medida = $("#columna_id_unidad_"+id).html();
	var txt_descripcion = $("#columna_descripcion_"+id).html();

	//carga la informacion recibida en el modal
 $('#txt_id_unidad_medida').val(txt_id_unidad_medida);
	$('#txt_descripcion').val(txt_descripcion);
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
