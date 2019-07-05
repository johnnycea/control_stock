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

function cargarModificarIngrediente(id){

  var txt_id_ingrediente = $("#columna_id_producto_"+id).html();
	var txt_descripcion = $("#columna_descripcion_"+id).html();
	var txt_marca = $("#columna_marca_"+id).html();
	var txt_unidad = $("#columna_unidad_"+id).html();
	var txt_stock_minimo = $("#columna_stock_minimo"+id).html();

	//carga la informacion recibida en el modal
  $('#txt_codigo_producto').val(txt_id_ingrediente);
	$('#txt_descripcion').val(txt_descripcion);
	$('#txt_marca').val(txt_marca);
	$('#txt_unidad').val(txt_unidad);
	$('#txt_stock_minimo').val(txt_stock_minimo);
}

function guardarIngrediente(){
	// alert("llega");

			$.ajax({
				url:"./metodos_ajax/ingredientes/ingresar_modificar_ingredientes.php",
				method:"POST",
				data: $("#formulario_modal_ingrediente").serialize(),
				success:function(respuesta){
					  // alert(respuesta);

					 if(respuesta==1){
						 swal("Guardado","Los datos se han guardado correctamente.","success");
						 $("#modal_ingrediente").modal('hide');
						 listarIngrediente("");
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
