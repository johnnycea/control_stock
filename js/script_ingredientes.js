listarIngrediente("");

function listarIngrediente(texto){

		$.ajax({
			url:"./metodos_ajax/ingredientes/mostrar_listado_ingredientes.php?texto_buscar="+texto,
			method:"POST",
			success:function(respuesta){
				 // alert(respuesta);
				 $("#contenedor_ingredientes").html(respuesta);
			}
		});
}

function limpiarFormularioIngrediente(){
   $("#formulario_modal_ingrediente")[0].reset();
	 // $('#txt_id_subvencion').attr("readonly",false);
	 $("#formulario_modal_ingrediente").attr("action","javascript:guardarIngrediente()");

}

function guardarIngrediente(){
	alert("llega");

			$.ajax({
				url:"./metodos_ajax/ingredientes/ingresar_modificar_ingredientes.php",
				method:"POST",
				data: $("#formulario_modal_ingrediente").serialize(),
				success:function(respuesta){
					  alert(respuesta);

					 if(respuesta==1){
						 swal("Guardado","Los datos se han guardado correctamente.","success");
						 $("#modal_ingrediente").modal('hide');
						 listarIngrediente();
					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
					 }
				}
			});
	}




function eliminarIngrediente(id_ingrediente,id_producto_elaborado){

// alert("Ingrediente: "+id_ingrediente+" ProductoElaborado: "+id_producto_elaborado);
	swal({
	title: "¿Eliminar Ingrediente?",
	text: "",
	type: "warning",
	showCancelButton: true,
	confirmButtonColor: "#DD6B55",
	confirmButtonText: "Eliminar!",
	cancelButtonText: "Cancelar!",
	closeOnConfirm: false,
	closeOnCancel: false },
	function(isConfirm){
			if (isConfirm) {
			$.ajax({
				url:"./metodos_ajax/productos_elaborados/eliminar_ingrediente.php?id_ingrediente="+id_ingrediente+"&id_producto_elaborado="+id_producto_elaborado,
				method:"POST",
				success:function(respuesta){
					 // alert(respuesta);
					 if(respuesta==1){
						 swal("Eliminado correctamente","Los datos se han guardado correctamente.","success");
						 listarIngredientesSeleccionados(id_producto_elaborado);
					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
					 }
					}
				});
			} else {
					swal("Cancelado", "", "error");
			}
			});
			}
