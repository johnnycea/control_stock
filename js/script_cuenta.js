listarCuenta();

function listarCuenta(){


		$.ajax({
			url:"./metodos_ajax/cuentas/mostrar_cuenta.php",
			method:"POST",
			success:function(respuesta){
				 $("#contenedor_listado_cuenta").html(respuesta);
			}
		});
}

function guardarCuenta(){

			$.ajax({
				url:"./metodos_ajax/cuentas/crear_cuenta.php",
				method:"POST",
				data: $("#formulario_modal_cuenta").serialize(),
				success:function(respuesta){
					  // alert(respuesta);

					 if(respuesta==1){
						 swal("Guardado","Los datos se han guardado correctamente.","success");
						 $("#modal_cuenta").modal('hide');
						 listarCuenta();
					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
					 }
				}
			});
	}


function limpiarFormularioCuenta(){
   $("#formulario_modal_cuenta")[0].reset();
	 $('#txt_numero_cuenta').attr("readonly",false);

	 $("#formulario_modal_cuenta").attr("action","javascript:guardarCuenta()");

}

function cargarDatosModificar(id){

  var numero_cuenta = $("#txt_numero_"+id).html();
  var nombre_cuenta = $("#txt_nombre_"+id).html();


	//carga la informacion recibida en el modal
	$('#txt_numero_cuenta').val(numero_cuenta);
	$('#txt_nombre_cuenta').val(nombre_cuenta);

  //pone el campo como no editable
	$('#txt_numero_cuenta').attr("readonly",true);

  //cambia la funcion que se ejecuta al enviar el formulario
	$("#formulario_modal_cuenta").attr("action","javascript:modificarCuenta()");

}


function modificarCuenta(){

			$.ajax({
				url:"./metodos_ajax/cuentas/modificar_cuenta.php",
				method:"POST",
				data: $("#formulario_modal_cuenta").serialize(),
				success:function(respuesta){
					 //alert(respuesta);

					 if(respuesta==1){
						 swal("Guardado","Los datos se han guardado correctamente.","success");
						 $("#modal_cuenta").modal('hide');
						 listarCuenta();
					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
				   }
				}
			});

}

function eliminarCuenta(id){

			$.ajax({
				url:"./metodos_ajax/cuentas/eliminar_cuenta.php?id="+id,
				method:"POST",
				success:function(respuesta){
					 alert(respuesta);
					 if(respuesta==1){
						 swal("Eliminado correctamente","Los datos se han guardado correctamente.","success");
						 listarCuenta();
					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
					 }
				}
			});

}
