<?php
require_once '../../clases/Funciones.php';
require_once '../../clases/Producto.php';
require_once '../../clases/Conexion.php';

$Funciones = new Funciones();

$txt_codigo_producto = $Funciones->limpiarTexto($_REQUEST['txt_codigo_producto']);
$descripcion = $Funciones->limpiarTexto($_REQUEST['txt_descripcion_producto']);
$stock_minimo = $Funciones->limpiarTexto($_REQUEST['txt_stock_minimo']);
$unidad_medida = $Funciones->limpiarNumeroEntero($_REQUEST['select_unidad_medida']);
$id_marca = $Funciones->limpiarTexto($_REQUEST['txt_marca']);
$id_estado = $Funciones->limpiarTexto($_REQUEST['txt_id_estado']);


$Producto = new Producto();
$Producto->setIdProducto($txt_codigo_producto);
$Producto->setDescripcion($descripcion);
$Producto->setStockMinimo($stock_minimo);
$Producto->setIdUnidadMedida($unidad_medida);
$Producto->setMarca($id_marca);
$Producto->setIdEstado(1);

$consultaExisteProductos = $Producto->obtenerProducto();

if($consultaExisteProductos->num_rows==0){
//Si no devuelve nada, se debe crear nuevo producto
   if($Producto->crearProducto()){
      echo "1";
   }else{
      echo "2";
   }
}else{
//si deveulve filas, el producto existe en bd, por lo tato se modifca
  if($Producto->modificarIngrediente()){
    echo "1";
  }else{
    echo "2";
  }

}


?>
