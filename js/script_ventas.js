// localStorage.productos_venta="";

function cargarInformacionCliente(texto_buscar){

	$("#txt_nombre").val('Cargando...');
	$("#txt_apellidos").val('Cargando...');
	$("#txt_calle").val('Cargando...');
	$("#txt_numero").val('Cargando...');
	$("#txt_observacion").val('Cargando...');
	$("#txt_telefono").val('Cargando...');

		$.ajax({
			url:"./metodos_ajax/clientes/buscar_cliente_ventas.php?texto_buscar="+texto_buscar,
			method:"POST",
			dataType:"json",
			success:function(respuesta){

				 $("#txt_nombre").val(respuesta.nombre);
				 $("#txt_apellidos").val(respuesta.apellidos);
				 $("#txt_calle").val(respuesta.calle);
				 $("#txt_numero").val(respuesta.numero_calle);
				 $("#txt_observacion").val(respuesta.observacion_direccion);
				 $("#txt_telefono").val(respuesta.telefono);
			}
		});
}

function listarProductosElaborados(){
var texto_buscar = $("#txt_texto_buscar_ingredientes").val();

		$.ajax({
			url:"./metodos_ajax/ventas/mostrar_producto_elaborado_venta.php?texto_buscar="+texto_buscar,
			method:"POST",
			success:function(respuesta){
				// alert(respuesta);
				 $("#contenedor_listado_productos_elaborados").html(respuesta);
			}
		});
}


function confirmarVenta(){

		var id_venta = $("#txt_id_venta").val();


		$.ajax({
			url:"./metodos_ajax/ventas/confirmar_venta.php?id_venta="+id_venta,
			method:"POST",
			data: $("#formulario_finalizar_venta").serialize(),
			success:function(respuesta){
				 alert(respuesta);
				 if(respuesta=="1"){
					 swal("Venta Finalizada","Los datos se han guardado correctamente.","success");
					 $("#modal_finalizar_venta").modal('hide');
					 //funcion que cree nueva ventas
					 //limpiar contenido de la pagina
				 }else{
					 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
				 }

			}
		});
}

function mostrarOcultarInformacionCliente(select_tipo_entrega){

// alert(select_tipo_entrega);

	if(select_tipo_entrega==2){
		$("#contenedor_informacion_cliente").removeClass("d-none");
		// alert("entra a domic");
	}else{
		$("#contenedor_informacion_cliente").addClass("d-none");
		// alert("entra a local");
	}

}


function listaVenta(){
	var id_venta = $("#txt_id_venta").val();

		$.ajax({
			url:"./metodos_ajax/ventas/mostrar_venta.php?id_venta="+id_venta,
			// url:"./metodos_ajax/ventas/mostrar_venta.php?",
			method:"POST",
			success:function(respuesta){
				// alert(respuesta);
				 $("#contenedor_listado_venta").html(respuesta);
			}
		});
}

function guardarDetalleVenta(id_producto,valor){
	var id_producto = id_producto;
	var id_venta = $("#txt_id_venta").val();
	var valor_unitario = valor;
	var txt_cantidad = $("#txt_cantidad_"+id_producto).val();
	var valor_total = valor_unitario*txt_cantidad;
	// alert(id_producto);
	// alert(id_venta);
	// alert(valor_unitario);
	// alert(txt_cantidad);
	// alert(valor_total);

			$.ajax({
				url:"./metodos_ajax/ventas/ingresar_productos_ventas.php?id_producto="+id_producto+"&id_venta="+id_venta+"&valor_unitario="+valor_unitario+"&txt_cantidad="+txt_cantidad+"&valor_total="+valor_total,
				method:"POST",
				success:function(respuesta){
					 // alert(respuesta);

					 if(respuesta==1){
						 swal("Guardado","Los datos se han guardado correctamente.","success");
						 listaVenta();
					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
					 }else{
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
					 }
				}
			});
}

function eliminarProductoVenta(id_producto,id_venta){

 // alert("ProductoElaborado: "+id_producto+" Venta: "+id_venta);
	swal({
	title: "¿Eliminar producto de la venta?",
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
				url:"./metodos_ajax/ventas/eliminar_producto_venta.php?id_producto="+id_producto+"&id_venta="+id_venta,
				method:"POST",
				success:function(respuesta){
					 // alert(respuesta);
					 if(respuesta==1){
						 swal("Eliminado correctamente","Los datos se han guardado correctamente.","success");
						 listaVenta();
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
