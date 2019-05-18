listarProductosElaborados("");

function listarProductosElaborados(texto_buscar){


		$.ajax({
			url:"./metodos_ajax/productos_elaborados/mostrar_listado_producto_elaborado.php?texto_buscar="+texto_buscar,
			method:"POST",
			success:function(respuesta){
				// alert(respuesta);
				 $("#contenedor_listado_productos_elaborados").html(respuesta);
			}
		});
}

function listarIngredientesSeleccionados(id_producto_elaborado){


		$.ajax({
			url:"./metodos_ajax/productos_elaborados/mostrar_listado_ingredientes_seleccionados.php?id_producto_elaborado="+id_producto_elaborado,
			method:"POST",
			success:function(respuesta){
				// alert(respuesta);
				 $("#contenedor_ingredientes_seleccionando").html(respuesta);
				 $("#contenedor_buscar_ingredientes").html("");
				 $("#txt_texto_buscar_ingredientes").val("");

			}
		});
}

function buscarIngredientes(){

var texto_buscar = $("#txt_texto_buscar_ingredientes").val();
var id_producto_creado = $("#txt_id_producto_elaborado_creado").val();

		$.ajax({
			url:"./metodos_ajax/productos_elaborados/mostrar_listado_ingredientes.php?texto_buscar="+texto_buscar+"&id_creado="+id_producto_creado,
			method:"POST",
			success:function(respuesta){
				// alert(respuesta);
				 $("#contenedor_buscar_ingredientes").html(respuesta);
			}
		});
}

function guardarProductoElaborado(){


	$("#btn_boton_guardar").val("Guardando . . .");
	$("#btn_boton_guardar").removeClass("btn-info");
	$("#btn_boton_guardar").addClass("btn-success");
	$("#btn_boton_guardar").attr("disabled",true);


			$.ajax({
				url:"./metodos_ajax/productos_elaborados/ingresar_productos_elaborados.php",
				method:"POST",
				data: $("#formulario_modal_producto_elaborado").serialize(),
				success:function(respuesta){
					  // alert(respuesta);

					 if(isNaN(respuesta)){
						  swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
					 }else{
						 // $("#modal_producto_elaborado").modal('close');
						 // swal("Guardado","Seleccione los ingredientes del producto creado.","success");

						 $("#contenedor_buscador_ingredientes").removeClass("d-none");
						 $("#txt_id_producto_elaborado_creado").val(respuesta);
						 $("#btn_boton_guardar").val("PRODUCTO CREADO");
						 listarProductosElaborados("");
					 }
				}
			});
	}


function agregarIngredienteProducto(id_ingrediente,id_producto_creado){

	var cantidad_ingrediente = $("#txt_ingrediente_"+id_ingrediente).val();


  // alert("id del ingrediente es: "+id_ingrediente+" id producto creado es: "+id_producto_creado+" cantidad: "+cantidad_ingrediente);

	if(cantidad_ingrediente!="" && cantidad_ingrediente>0){

		$.ajax({
			url:"./metodos_ajax/productos_elaborados/ingresar_ingredientes.php?cantidad_ingrediente="+cantidad_ingrediente+"&id_producto_creado="+id_producto_creado+"&id_ingrediente="+id_ingrediente,
			method:"POST",
			success:function(respuesta){
				// alert(respuesta);
						 if(respuesta=="1"){
							  swal("Guardado","Guardado correctamente.","success");
								listarIngredientesSeleccionados(id_producto_creado);
						 }else{
							 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
						 }
			}
		});

	}


	}


// function limpiarFormularioProveedor(){
//    $("#formulario_modal_colegio")[0].reset();
// 	 $('#txt_id_subvencion').attr("readonly",false);
// 	 $("#formulario_modal_colegio").attr("action","javascript:guardarProveedor()");
//
// }

function cargarInformacionModificarProveedor(id){

  var txt_rut_proveedor = $("#columna_id_producto_elaborado_"+id).html();
	var txt_dv = $("#columna_descripcion_"+id).html();
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

function eliminarProductoElaborado(id){
	swal({
	title: "¿Eliminar Producto?",
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
				url:"./metodos_ajax/productos_elaborados/eliminar_producto_elaborado.php?id="+id,
				method:"POST",
				success:function(respuesta){
					 // alert(respuesta);
					 if(respuesta==1){
						 swal("Eliminado correctamente","Los datos se han guardado correctamente.","success");
						 listarProductosElaborados("");
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
