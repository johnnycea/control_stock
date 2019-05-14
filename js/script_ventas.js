// localStorage.productos_venta="";

alert(localStorage.productos_venta);



function guardarProductoVenta(){


  var codigo = $("#txt_codigo_agregar_producto").val();
  var cantidad = $("#txt_cantidad_agregar_producto").val();

 producto = "codigo:"+codigo+" cantidad: "+cantidad;


localStorage.productos_venta = localStorage.productos_venta+"; "+producto;

}
