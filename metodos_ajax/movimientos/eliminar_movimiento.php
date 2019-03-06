<?php

require_once '../../clases/Funciones.php';
require_once '../../clases/Movimiento.php';

$Funciones = new Funciones();

$id_movimiento = $Funciones->limpiarNumeroEntero($_REQUEST['id']);


$Movimiento = new Movimiento();
$Movimiento->setIdMovimiento($id_movimiento);
$Movimiento->setEstado(3);


 if($Movimiento->eliminarMovimiento()){
   echo "1";
 }else{
   echo "2";
 }

 ?>
