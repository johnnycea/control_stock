<?php
require_once '../../clases/Funciones.php';
require_once '../../clases/Ventas.php';
require_once '../../clases/Conexion.php';

$Funciones = new Funciones();

$txt_codigo_producto = $Funciones->limpiarTexto($_REQUEST['txt_codigo_producto']);
$descripcion = $Funciones->limpiarTexto($_REQUEST['txt_descripcion_producto']);
$stock_minimo = $Funciones->limpiarTexto($_REQUEST['txt_stock_minimo']);
$id_categoria = $Funciones->limpiarNumeroEntero($_REQUEST['select_categoria']);
$cantidad_ingrediente = $Funciones->limpiarTexto($_REQUEST['cantidad_ingrediente']);
$id_estado = $Funciones->limpiarTexto($_REQUEST['txt_id_estado']);


$Ventas = new Ventas();
$Ventas->setIdProducto($txt_codigo_producto);
$Ventas->setDescripcion($descripcion);
$Ventas->setStockMinimo($stock_minimo);
$Ventas->setIdCategoria($id_categoria);
$Ventas->setCantidad($cantidad_ingrediente);
$Ventas->setIdEstado(1);

$consultaExisteProductos = $Producto->obtenerProducto();

if($consultaExisteProductos->num_rows==0){
//Si no devuelve nada, se debe crear nuevo producto
   if($Ventas->guardarDetalleVenta()){
      echo "1";
   }else{
      echo "2";
   }
}else{
//si deveulve filas, el producto existe en bd, por lo tato se modifca
  if($Ventas->modificarProducto()){
    echo "1";
  }else{
    echo "2";
  }

}


?>
