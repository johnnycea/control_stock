// localStorage.productos_venta="";
generarCodigoVenta();

function generarCodigoVenta(){
	$("#txt_id_venta").val("...");

		$.ajax({
			url:"./metodos_ajax/ventas/generarVenta.php",
			success:function(respuesta){
				 $("#txt_id_venta").val(respuesta);
				 listaVenta("");
			}
		});


}

function cambiarTipoEntrega(select_tipo_entrega){
		if(select_tipo_entrega==1){
			// mostrarOcultarInformacionCliente(false);
			$("#chb_cliente").attr("disabled",false);
			$("#chb_cliente").prop('checked',false);
			mostrarOcultarInformacionCliente(false);
			$("#contenedor_checkbox_cliente").removeClass('d-none');

		}else if(select_tipo_entrega==2){
			mostrarOcultarInformacionCliente(true);
			$("#chb_cliente").prop('checked',true);
			$("#contenedor_checkbox_cliente").addClass('d-none');

			// $("#chb_cliente").attr("disabled",true);
		}
}

function activarCheckboxCliente(){
		if($("#chb_cliente").prop('checked')){
			mostrarOcultarInformacionCliente(true);
		}else{
			mostrarOcultarInformacionCliente(false);
		}
}

function mostrarOcultarInformacionCliente(opcion){

	if(opcion==true){
		$("#contenedor_informacion_cliente").removeClass("d-none");
	}else if(opcion==false){
		$("#contenedor_informacion_cliente").addClass("d-none");
		textoCamposCliente('limpiar');
	}

}

function textoCamposCliente(opcion){
	if(opcion=="limpiar"){
		$("#txt_rut_cliente").val('');
		$("#txt_nombre").val('');
		$("#txt_apellidos").val('');
		$("#txt_calle").val('');
		$("#txt_numero").val('');
		$("#txt_observacion").val('');
		$("#txt_telefono").val('');

	}else if("cargando"){

		$("#txt_nombre").val('Cargando...');
		$("#txt_apellidos").val('Cargando...');
		$("#txt_calle").val('Cargando...');
		$("#txt_numero").val('Cargando...');
		$("#txt_observacion").val('Cargando...');
		$("#txt_telefono").val('Cargando...');
	}

}

function cargarInformacionCliente(texto_buscar){

if(texto_buscar!=""){
	textoCamposCliente('cargando');
}else{
	textoCamposCliente('limpiar');
}

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



function obtenerIngredientesProducto(id_producto_elaborado,id_detalle_venta){

	$("#contenedor_ingredientes_producto").html("<center>Cargando...</center>");


		$.ajax({
			url:"./metodos_ajax/ventas/mostrar_ingredientes_producto_venta.php?id_producto_elaborado="+id_producto_elaborado+"&id_detalle_venta="+id_detalle_venta,
			method:"POST",
			success:function(respuesta){
				 $("#contenedor_ingredientes_producto").html(respuesta);
			}
		});
}

function modificarCantidadIngrediente(accion,ingrediente,id_producto_elaborado,id_detalle_venta){
	//accion= 1:sumar / 2:restar

		$.ajax({
			url:"./metodos_ajax/ventas/cambiar_ingredientes_producto_venta.php?id_producto_elaborado="+id_producto_elaborado+"&id_ingrediente="+ingrediente+"&accion="+accion+"&id_detalle_venta="+id_detalle_venta,
			method:"POST",
			success:function(respuesta){
				 obtenerIngredientesProducto(id_producto_elaborado,id_detalle_venta);
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
		var rut_cliente = $("#txt_rut_cliente").val();
		var nombre = $("#txt_nombre").val();
		var apellidos = $("#txt_apellidos").val();
		var calle = $("#txt_calle").val();
		var numero = $("#txt_numero").val();
		var observacion = $("#txt_observacion").val();
		var telefono = $("#txt_telefono").val();


   //Cargando
	 $("#btn_boton_guardar").attr("disabled",true);
	 $("#btn_boton_guardar").val("Cargando...");
	 $("#btn_boton_guardar").removeClass("btn-success");
	 $("#btn_boton_guardar").addClass("btn-danger");


		$.ajax({
			url:"./metodos_ajax/ventas/confirmar_venta.php?id_venta="+id_venta,
			method:"POST",
			data: $("#formulario_finalizar_venta").serialize(),
			success:function(respuesta){
				 // alert(respuesta);
				 if(respuesta=="1"){
					 generarCodigoVenta();
					 $("#txt_texto_buscar_ingredientes").val("");
           listarProductosElaborados();

					 swal("Venta Finalizada","Los datos se han guardado correctamente.","success");
					 $("#modal_finalizar_venta").modal('hide');
					 //funcion que cree nueva ventas
					 //limpiar contenido de la pagina
					 imprimeComprobante(id_venta,rut_cliente,nombre,apellidos,calle,numero,observacion,telefono);

					 //Cargando
					$("#btn_boton_guardar").attr("disabled",false);
					$("#btn_boton_guardar").val("CONFIRMAR");
					$("#btn_boton_guardar").removeClass("btn-danger");
					$("#btn_boton_guardar").addClass("btn-success");

				 }else{
					 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
				 }

			}
		});
}
function imprimeComprobante(id_venta,rut_cliente,nombre,apellidos,calle,numero,observacion,telefono) {
	// alert(nombre);
	// alert(apellidos);
		 window.open("./metodos_ajax/ventas/imprimir_comprobante_venta.php?id_venta="+id_venta+"&rut_cliente="+rut_cliente+"&nombre="+nombre+"&apellidos="+apellidos+"&calle="+calle+"&numero="+numero+"&observacion="+observacion+"&telefono="+telefono, "Impimir Boucher" , "width=800,height=600,scrollbars=YES");
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

function guardarDetalleVenta(id_producto,valor,boton){
	var id_producto = id_producto;
	var id_venta = $("#txt_id_venta").val();
	var valor_unitario = valor;
	var txt_cantidad = $("#txt_cantidad_"+id_producto).val();
	// var valor_total = valor_unitario*txt_cantidad;
	// alert(id_producto);
	// alert(id_venta);
	// alert(valor_unitario);
	// alert(txt_cantidad);
	// alert(valor_total);

    var boton = $("#btn_agregar_"+id_producto);
	  boton.html("Cargando...");
	  boton.attr("disabled",true);

			$.ajax({
				url:"./metodos_ajax/ventas/ingresar_productos_ventas.php?id_producto="+id_producto+"&id_venta="+id_venta+"&valor_unitario="+valor_unitario+"&txt_cantidad="+txt_cantidad,
				method:"POST",
				success:function(respuesta){
					 // alert(respuesta);

					 if(respuesta==1){
						 // swal("Guardado","Los datos se han guardado correctamente.","success");
						 listaVenta();
						 $("#btn_agregar_"+id_producto).html('<i class="fas fa-plus"></i> Agregar');
						 boton.attr("disabled",false);
						 $('html,body').animate({
							    scrollTop: $("#contenedor_listado_productos_elaborados").offset().top
							}, 1000);



					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
					 }else{
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
					 }
				}
			});
}

function eliminarProductoVenta(id_detalle_venta){

 // alert("ProductoElaborado: "+id_producto+" Venta: "+id_venta);
	// swal({
	// title: "Quitar producto de la venta?",
	// text: "",
	// type: "warning",
	// showCancelButton: true,
	// confirmButtonColor: "#DD6B55",
	// confirmButtonText: "Eliminar!",
	// cancelButtonText: "Cancelar!",
	// closeOnConfirm: false,
	// closeOnCancel: false },
	// function(isConfirm){
	// 		if (isConfirm) {
			$.ajax({
				url:"./metodos_ajax/ventas/eliminar_producto_venta.php?id_detalle_venta="+id_detalle_venta,
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
			// } else {
			// 		swal("Cancelado", "", "error");
			// }
			// });
			}
