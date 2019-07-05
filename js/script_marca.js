listarMarca("");

function listarMarca(texto_buscar){


		$.ajax({
			url:"./metodos_ajax/marcas/mostrar_listado_marca.php?texto_buscar="+texto_buscar,
			method:"POST",
			success:function(respuesta){
				// alert(respuesta);
				 $("#contenedor_listado_marca").html(respuesta);
			}
		});
}

function guardarMarca(){

			$.ajax({
				url:"./metodos_ajax/marcas/ingresar_modificar_marca.php",
				method:"POST",
				data: $("#formulario_modal_marca").serialize(),
				success:function(respuesta){
					  // alert(respuesta);

					 if(respuesta==1){
						 swal("Guardado","Los datos se han guardado correctamente.","success");
						 $("#modal_marca").modal('hide');
						 listarMarca("");
					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
					 }
				}
			});
	}


function limpiarFormularioMarca(){
   $("#formulario_modal_marca")[0].reset();
	 $('#txt_id_marca').attr("readonly",false);
	 $("#formulario_modal_marca").attr("action","javascript:guardarMarca()");

}

function cargarInformacionModificarMarca(id){

  var txt_id_marca = $("#columna_id_marca_"+id).html();
	var txt_nombre_marca = $("#columna_nombre_marca_"+id).html();

	//carga la informacion recibida en el modal
 $('#txt_id_marca').val(txt_id_marca);
	$('#txt_nombre_marca').val(txt_nombre_marca);
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

function eliminarMarca(id){

			$.ajax({
				url:"./metodos_ajax/marcas/eliminar_marca.php?id="+id,
				method:"POST",
				success:function(respuesta){
					 // alert(respuesta);
					 if(respuesta==1){
						 swal("Eliminado correctamente","Los datos se han guardado correctamente.","success");
						 listarMarca("");
					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
					 }
				}
			});

}
