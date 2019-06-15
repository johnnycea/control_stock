listarIngrediente();
function listarIngrediente(){
	var texto_buscar = $("#txt_texto_buscar_ingredientes").val();

		$.ajax({
			url:"./metodos_ajax/ingredientes/mostrar_listado_ingredientes.php?texto_buscar="+texto_buscar,
			method:"POST",
			success:function(respuesta){
				 alert(respuesta);
				 $("#contenedor_ingredientes").html(respuesta);
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
							 listarIngredientesSeleccionados(id_producto_creado);
							  swal("Guardado","Guardado correctamente.","success");
						 }else{
							 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
						 }
			}
		});

	}else{
		swal("Ingrese cantidad","Ingrese cantidad del ingrediente","info");

	}

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
