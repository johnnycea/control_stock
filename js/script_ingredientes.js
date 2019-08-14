listarIngrediente("");

function cambiarSelectEditable(valor){
	switch(valor){
		case "0":
        $("#contenedor_valor_extra").addClass("d-none");
        $("#txt_valor_extra").attr("required",false);
			break;

		case "1":
				$("#contenedor_valor_extra").removeClass("d-none");
				$("#txt_valor_extra").attr("required",true);

			break;

	 default:
	}

}

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

	 $('#txt_codigo_producto').attr("readonly",false);
	 $('#select_editable').change();

}

function cargarModificarIngrediente(id){

  var txt_id_ingrediente = $("#columna_id_producto_"+id).html();
	var txt_descripcion = $("#columna_descripcion_"+id).html();
	var txt_marca = $("#columna_marca_"+id).html();
	var txt_unidad = $("#columna_id_unidad_"+id).html();
	var txt_stock_minimo = $("#columna_stock_minimo"+id).html();
	var txt_editable = $("#columna_id_editable_"+id).html();
	var txt_valor_extra = $("#columna_valor_extra_"+id).html();

	//carga la informacion recibida en el modal
  $('#txt_codigo_producto').val(txt_id_ingrediente);
	$('#txt_descripcion').val(txt_descripcion);
	$('#txt_marca').val(txt_marca);
	$('#cmb_unidad_medida').val(txt_unidad);
	$('#txt_stock_minimo').val(txt_stock_minimo);
	$('#select_editable').val(txt_editable);
	$('#select_editable').change();
	$('#txt_valor_extra').val(txt_valor_extra);

	$('#txt_codigo_producto').attr("readonly",true);

}



function guardarIngrediente(){

	botonCargando($("#btn_guardar_ingrediente"),1);

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

					 botonCargando($("#btn_guardar_ingrediente"),2);


				}
			});
	}




function eliminarIngrediente(id_ingrediente){

	botonCargando($("#btn_eliminar_"+id_ingrediente),1);

			$.ajax({
				url:"./metodos_ajax/ingredientes/eliminar_ingrediente.php?id_ingrediente="+id_ingrediente,
				method:"POST",
				success:function(respuesta){
							 // alert(respuesta);
							 if(respuesta==1){
								 swal("Guardado correctamente","Los datos se han guardado correctamente.","success");
								 listarIngrediente("");

							 }else if(respuesta==2){
								 swal("No permitido","El insumo ha sido utilizado en un producto u ocurrió un erro.","info");
							 }

							 botonCargando($("#btn_eliminar_"+id_ingrediente),2);
					}


				});

	}
