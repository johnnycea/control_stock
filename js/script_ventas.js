// localStorage.productos_venta="";
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

function guardarDetalleVenta(){


}
