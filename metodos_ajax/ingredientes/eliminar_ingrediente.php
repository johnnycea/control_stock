<?php
require_once '../../clases/Funciones.php';
require_once '../../clases/Producto.php';

// echo "llega eliminarIngrediente";
$Funciones = new Funciones();

$id_ingrediente = $Funciones->limpiarNumeroEntero($_REQUEST['id_ingrediente']);


$Producto = new Producto();
$Producto->setIdProducto($id_ingrediente);

  if($Producto->eliminarIngrediente()){
     echo "1";
  }else{
     echo "2";
  }

?>
