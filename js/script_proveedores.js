listarProveedor("");




function listarProveedor(texto_buscar){


		$.ajax({
			url:"./metodos_ajax/proveedores/mostrar_listado_proveedores.php?texto_buscar="+texto_buscar,
			method:"POST",
			success:function(respuesta){
				// alert(respuesta);
				 $("#contenedor_listado_proveedores").html(respuesta);
			}
		});
}

function guardarProveedor(){

			$.ajax({
				url:"./metodos_ajax/proveedores/ingresar_modificar_proveedores.php",
				method:"POST",
				data: $("#formulario_modal_proveedor").serialize(),
				success:function(respuesta){
					  // alert(respuesta);

					 if(respuesta==1){
						 swal("Guardado","Los datos se han guardado correctamente.","success");
						 $("#modal_proveedor").modal('hide');
						 listarProveedor();
					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
					 }
				}
			});
	}


function limpiarFormularioProveedor(){
   $("#formulario_modal_colegio")[0].reset();
	 $('#txt_id_subvencion').attr("readonly",false);
	 $("#formulario_modal_colegio").attr("action","javascript:guardarProveedor()");

}

function cargarInformacionModificarProveedor(id){

  var txt_rut_proveedor = $("#columna_rut_proveedor_"+id).html();
	var txt_dv = $("#columna_dv_"+id).html();
  var txt_razon_social = $("#columna_razon_social_"+id).html();
	var txt_telefono = $("#columna_telefono_"+id).html();
  var txt_direccion = $("#columna_direccion_"+id).html();
  var txt_giro = $("#columna_giro_"+id).html();
  var txt_correo = $("#columna_correo_"+id).html();

	//carga la informacion recibida en el modal
	$('#txt_rut_proveedor').val(txt_rut_proveedor);
	$('#txt_dv').val(txt_dv);
	$('#txt_razon_social').val(txt_razon_social);
	$('#txt_direccion').val(txt_direccion);
	$('#txt_telefono').val(txt_telefono);
	$('#txt_giro').val(txt_giro);
	$('#txt_correo').val(txt_correo);


}


function modificarProveedor(){

			$.ajax({
				url:"./metodos_ajax/subvencion/modificar_subvencion.php",
				method:"POST",
				data: $("#formulario_modal_subvencion").serialize(),
				success:function(respuesta){
					 // alert(respuesta);

					 if(respuesta==1){
						 swal("Guardado","Los datos se han guardado correctamente.","success");
						 $("#modal_subvencion").modal('hide');
						 listarProveedor();
					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
				   }
				}
			});

}

function eliminarProveedor(id){

			$.ajax({
				url:"./metodos_ajax/proveedores/eliminar_proveedor.php?id="+id,
				method:"POST",
				success:function(respuesta){
					 // alert(respuesta);
					 if(respuesta==1){
						 swal("Eliminado correctamente","Los datos se han guardado correctamente.","success");
						 listarProveedor();
					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
					 }
				}
			});

}
