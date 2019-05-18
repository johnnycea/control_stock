<?php
require_once '../../clases/Funciones.php';
require_once '../../clases/ProductoElaborado.php';
require_once '../../clases/Conexion.php';

$Funciones = new Funciones();

$txt_descripcion = $Funciones->limpiarTexto($_REQUEST['txt_descripcion']);
$txt_valor = $Funciones->limpiarTexto($_REQUEST['txt_valor']);
$select_estado = $Funciones->limpiarTexto($_REQUEST['select_estado']);


$ProductoElaborado = new ProductoElaborado();
$ProductoElaborado->setDescripcion($txt_descripcion);
$ProductoElaborado->setValor($txt_valor);
$ProductoElaborado->setEstado($select_estado);

  if($id_creado = $ProductoElaborado->crearProductoElaborado()){
     echo $id_creado;
  }else{
     echo "error";
  }




?>
