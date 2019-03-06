listarSubvencion();

function listarSubvencion(){


		$.ajax({
			url:"./metodos_ajax/subvencion/mostrar_subvencion.php",
			method:"POST",
			success:function(respuesta){
				 $("#contenedor_listado_subvencion").html(respuesta);
			}
		});
}

function guardarSubvencion(){

			$.ajax({
				url:"./metodos_ajax/subvencion/crear_subvencion.php",
				method:"POST",
				data: $("#formulario_modal_subvencion").serialize(),
				success:function(respuesta){
					  // alert(respuesta);

					 if(respuesta==1){
						 swal("Guardado","Los datos se han guardado correctamente.","success");
						 $("#modal_subvencion").modal('hide');
						 listarSubvencion();
					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
					 }
				}
			});
	}


function limpiarFormularioSubvencion(){
   $("#formulario_modal_colegio")[0].reset();
	 $('#txt_id_subvencion').attr("readonly",false);
	 $("#formulario_modal_colegio").attr("action","javascript:guardarSubvencion()");

}

function cargarDatosModificar(id){

  var txt_id_subvencion = $("#txt_id_subvencion_"+id).html();
  var txt_subvencion = $("#txt_subvencion_"+id).html();


	//carga la informacion recibida en el modal
	$('#txt_id_subvencion').val(txt_id_subvencion);
	$('#txt_subvencion').val(txt_subvencion);


  //cambia la funcion que se ejecuta al enviar el formulario
	$("#formulario_modal_subvencion").attr("action","javascript:modificarSubvencion()");

}


function modificarSubvencion(){

			$.ajax({
				url:"./metodos_ajax/subvencion/modificar_subvencion.php",
				method:"POST",
				data: $("#formulario_modal_subvencion").serialize(),
				success:function(respuesta){
					 // alert(respuesta);

					 if(respuesta==1){
						 swal("Guardado","Los datos se han guardado correctamente.","success");
						 $("#modal_subvencion").modal('hide');
						 listarSubvencion();
					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
				   }
				}
			});

}

function eliminarSubvencion(id){

			$.ajax({
				url:"./metodos_ajax/subvencion/eliminar_subvencion.php?id="+id,
				method:"POST",
				success:function(respuesta){
					 // alert(respuesta);
					 if(respuesta==1){
						 swal("Eliminado correctamente","Los datos se han guardado correctamente.","success");
						 listarSubvencion();
					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
					 }
				}
			});

}
