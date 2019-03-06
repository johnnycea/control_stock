listarUsuarios();

function listarUsuarios(){


		$.ajax({
			url:"./metodos_ajax/usuarios/mostrar_usuarios.php",
			method:"POST",
			success:function(respuesta){
				 $("#contenedor_listado_usuarios").html(respuesta);
			}
		});
}

function guardarUsuario(){

	var clave1 = $("#txt_contrasenia_usuario").val();
	var clave2 = $("#txt_confirme_contrasenia_usuario").val();

  if(clave1==clave2){
			$.ajax({
				url:"./metodos_ajax/usuarios/crear_usuario.php",
				method:"POST",
				data: $("#formulario_modal_usuario").serialize(),
				success:function(respuesta){
					 // alert(respuesta);

					 if(respuesta==1){
						 swal("Guardado","Los datos se han guardado correctamente.","success");
						 $("#modal_usuario").modal('hide');
						 listarUsuarios();
					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
					 }
				}
			});
	}else{
		swal("Claves no coinciden","Verifique que la contraseña ingresada sea la misma en ambos campos.","warning");
	}
}

function limpiarFormularioUsuario(){
   $("#formulario_modal_usuario")[0].reset();
	 $('#txt_rut_usuario').attr("readonly",false);
   $('#txt_dv_usuario').attr("readonly",false);

   cargarFormularioClaves("nuevo");

	 $("#formulario_modal_usuario").attr("action","javascript:guardarUsuario()");

}

function cargarDatosModificar(id){

  var rut = $("#txt_rut_"+id).html();
  var dv = $("#txt_dv_"+id).html();
  var nombre = $("#txt_nombre_"+id).html();
  var correo = $("#txt_correo_"+id).html();
  var correo2 = $("#txt_correo2_"+id).html();
  var estado = $("#txt_estado_"+id).html();
  var privilegio = $("#txt_privilegio_"+id).html();
  var departamento = $("#txt_departamento_"+id).html();

	//carga la informacion recibida en el modal
	$('#txt_rut_usuario').val(rut);
	$('#txt_dv_usuario').val(dv);
	$('#txt_nombre_usuario').val(nombre);
	$('#txt_correo_usuario').val(correo);
	$('#txt_correo2_usuario').val(correo2);
	$('#select_estado_usuario').val(estado);
	$('#select_privilegio_usuario').val(privilegio);
	$('#txt_departamento_usuario').val(departamento);

	$('#txt_rut_usuario').attr("readonly",true);
	$('#txt_dv_usuario').attr("readonly",true);


	cargarFormularioClaves("nada");


	$("#formulario_modal_usuario").attr("action","javascript:modificarUsuario()");

}

function cargarFormularioClaves(tipo){
//nuevo
//modificar

			$.ajax({
				url:"./metodos_ajax/usuarios/formulario_claves.php?tipo="+tipo,
				method:"POST",
				data: $("#formulario_modal_usuario").serialize(),
				success:function(respuesta){
					 $("#formulario_claves").html(respuesta);
				}
			});

}

function modificarUsuario(){

if($("#txt_contrasenia_usuario").length>0){

    if($("#txt_contrasenia_usuario").val()!=$("#txt_confirme_contrasenia_usuario").val()){
		   	swal("Claves no coinciden","Verifique que la contraseña ingresada sea la misma en ambos campos.","warning");
        return false;
		}

}

			$.ajax({
				url:"./metodos_ajax/usuarios/modificar_usuario.php",
				method:"POST",
				data: $("#formulario_modal_usuario").serialize(),
				success:function(respuesta){
					 // alert(respuesta);

					 if(respuesta==1){
						 swal("Guardado","Los datos se han guardado correctamente.","success");
						 $("#modal_usuario").modal('hide');
						 listarUsuarios();
					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");

				   }else if(respuesta==3){
						 swal("Claves no coinciden","Verifique que la contraseña ingresada sea la misma en ambos campos.","warning");
					 }
				}
			});

}

function eliminarUsuario(id){

			$.ajax({
				url:"./metodos_ajax/usuarios/eliminar_usuario.php?id="+id,
				method:"POST",
				success:function(respuesta){
					 // alert(respuesta);
					 if(respuesta==1){
						 swal("Eliminado correctamente","Los datos se han guardado correctamente.","success");
						 listarUsuarios();
					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
					 }
				}
			});

}
