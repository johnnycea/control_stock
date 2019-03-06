listarColegio();

function listarColegio(){


		$.ajax({
			url:"./metodos_ajax/colegio/mostrar_colegio.php",
			method:"POST",
			success:function(respuesta){
				 $("#contenedor_listado_colegios").html(respuesta);
			}
		});
}

function guardarColegio(){

			$.ajax({
				url:"./metodos_ajax/colegio/crear_colegio.php",
				method:"POST",
				data: $("#formulario_modal_colegio").serialize(),
				success:function(respuesta){
					  // alert(respuesta);

					 if(respuesta==1){
						 swal("Guardado","Los datos se han guardado correctamente.","success");
						 $("#modal_colegio").modal('hide');
						 listarColegio();
					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
					 }
				}
			});
	}


function limpiarFormularioColegio(){
   $("#formulario_modal_colegio")[0].reset();
	 $('#txt_rbd_colegio').attr("readonly",false);

	 $("#formulario_modal_colegio").attr("action","javascript:guardarColegio()");

}

function cargarDatosModificar(id){

  var rbd_colegio = $("#txt_rbd_"+id).html();
  var nombre_colegio = $("#txt_nombre_"+id).html();


	//carga la informacion recibida en el modal
	$('#txt_rbd_colegio').val(rbd_colegio);
	$('#txt_nombre_colegio').val(nombre_colegio);

  //pone el campo como no editable
	$('#txt_rbd_colegio').attr("readonly",true);

  //cambia la funcion que se ejecuta al enviar el formulario
	$("#formulario_modal_colegio").attr("action","javascript:modificarColegio()");

}


function modificarColegio(){

			$.ajax({
				url:"./metodos_ajax/colegio/modificar_colegio.php",
				method:"POST",
				data: $("#formulario_modal_colegio").serialize(),
				success:function(respuesta){
					  // alert(respuesta);

					 if(respuesta==1){
						 swal("Guardado","Los datos se han guardado correctamente.","success");
						 $("#modal_colegio").modal('hide');
						 listarColegio();
					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
				   }
				}
			});

}

function eliminarColegio(id){
			$.ajax({
				url:"./metodos_ajax/colegio/eliminar_colegio.php?id="+id,
				method:"POST",
				success:function(respuesta){
					 // alert(respuesta);
					 if(respuesta==1){
						 swal("Eliminado correctamente","Los datos se han guardado correctamente.","success");
						 listarColegio();
					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
					 }
				}
			});

}
