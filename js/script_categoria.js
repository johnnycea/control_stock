listarCategoria("");

function listarCategoria(texto_buscar){


		$.ajax({
			url:"./metodos_ajax/categoria/mostrar_listado_categoria.php?texto_buscar="+texto_buscar,
			method:"POST",
			success:function(respuesta){
				// alert(respuesta);
				 $("#contenedor_listado_categoria").html(respuesta);
			}
		});
}

function guardarCategoria(){

			$.ajax({
				url:"./metodos_ajax/categoria/ingresar_modificar_categoria.php",
				method:"POST",
				data: $("#formulario_modal_categoria").serialize(),
				success:function(respuesta){
					  alert(respuesta);

					 if(respuesta==1){
						 swal("Guardado","Los datos se han guardado correctamente.","success");
						 $("#modal_categoria").modal('hide');
						 listarCategoria("");
					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
					 }
				}
			});
	}


function limpiarFormularioCategoria(){
   $("#formulario_modal_categoria")[0].reset();
	 $('#txt_id_categoria').attr("readonly",false);
	 $("#formulario_modal_categoria").attr("action","javascript:guardarCategoria()");

}

function cargarInformacionModificarMarca(id){

  // var txt_id_marca = $("#columna_id_marca_"+id).html();
	var txt_nombre_marca = $("#columna_nombre_marca_"+id).html();

	//carga la informacion recibida en el modal
 // $('#txt_id_marca').val(txt_id_marca);
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
					 alert(respuesta);
					 if(respuesta==1){
						 swal("Eliminado correctamente","Los datos se han guardado correctamente.","success");
						 listarMarca("");
					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
					 }
				}
			});

}
