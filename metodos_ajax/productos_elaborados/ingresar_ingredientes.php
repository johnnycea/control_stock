<?php
require_once '../../clases/Funciones.php';
require_once '../../clases/ProductoElaborado.php';
require_once '../../clases/Conexion.php';

$Funciones = new Funciones();

$id_ingrediente = $Funciones->limpiarTexto($_REQUEST['id_ingrediente']);
$id_producto_creado = $Funciones->limpiarTexto($_REQUEST['id_producto_creado']);
$cantidad_ingrediente = $Funciones->limpiarTexto($_REQUEST['cantidad_ingrediente']);

// echo "pe: ".$id_producto_creado;

$ProductoElaborado = new ProductoElaborado();
$ProductoElaborado->setIdProductoElaborado($id_producto_creado);
$ProductoElaborado->setIdIngrediente($id_ingrediente);
$ProductoElaborado->setCantidadIngrediente($cantidad_ingrediente);

  if($ProductoElaborado->guardarIngredientesProducto()){
     echo "1";
  }else{
     echo "2";
  }




?>
