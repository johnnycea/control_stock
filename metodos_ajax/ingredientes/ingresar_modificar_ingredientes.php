<?php
require_once '../../clases/Funciones.php';
require_once '../../clases/Producto.php';
require_once '../../clases/Conexion.php';

$Funciones = new Funciones();

$txt_codigo_producto = $Funciones->limpiarTexto($_REQUEST['txt_codigo_producto']);
$descripcion = $Funciones->limpiarTexto($_REQUEST['txt_descripcion']);
$stock_minimo = $Funciones->limpiarTexto($_REQUEST['txt_stock_minimo']);
$id_marca = $Funciones->limpiarTexto($_REQUEST['txt_marca']);
$id_estado = $Funciones->limpiarTexto($_REQUEST['cmb_estado']);
$unidad_medida = $Funciones->limpiarNumeroEntero($_REQUEST['cmb_unidad_medida']);

$select_editable = $Funciones->limpiarNumeroEntero($_REQUEST['select_editable']);
$valor_extra = $Funciones->limpiarNumeroEntero($_REQUEST['txt_valor_extra']);


$Producto = new Producto();
$Producto->setIdProducto($txt_codigo_producto);
$Producto->setDescripcion($descripcion);
$Producto->setStockMinimo($stock_minimo);
$Producto->setIdUnidadMedida($unidad_medida);
$Producto->setMarca($id_marca);
$Producto->setIdEstado(1);

$valor_extra = ($select_editable=="0") ? 0 : $valor_extra;

$Producto->setEditable($select_editable);
$Producto->setValorExtra($valor_extra);

$consultaExisteProductos = $Producto->obtenerProducto();
//
if($consultaExisteProductos->num_rows==0){
//Si no devuelve nada, se debe crear nuevo producto
   if($Producto->crearIngrediente()){
      echo "1";
   }else{
      echo "2";
   }
}
else{
// si deveulve filas, el producto existe en bd, por lo tato se modifca
  if($Producto->modificarIngrediente()){
    echo "1";
  }else{
    echo "2";
  }

}


?>
