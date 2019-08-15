<?php
require_once '../../clases/Funciones.php';
require_once '../../clases/Producto.php';
require_once '../../clases/Conexion.php';

$Funciones = new Funciones();

$id_producto_creado = $Funciones->limpiarTexto($_REQUEST['id_producto_creado']);

$id_ingrediente = $Funciones->limpiarTexto($_REQUEST['id_ingrediente']);
$cantidad_ingrediente = $Funciones->limpiarTexto($_REQUEST['cantidad_ingrediente']);
$editable = $Funciones->limpiarNumeroEntero($_REQUEST['select_editable']);
$valor_extra = $Funciones->limpiarTexto($_REQUEST['valor_extra']);


$Producto = new Producto();
$Producto->setIdProducto($id_ingrediente);
$Producto->setCantidad($cantidad_ingrediente);
$Producto->setEditable($editable);
$Producto->setValorExtra($valor_extra);

  if($Producto->guardarIngredientesProductoElaborado($id_producto_creado)){
     echo "1";
  }else{
     echo "2";
  }




?>
