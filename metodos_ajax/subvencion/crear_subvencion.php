<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Usuario.php';
require_once '../../clases/Subvencion.php';

$Funciones = new Funciones();

// $numero_cuenta = $Funciones->limpiarNumeroEntero($_REQUEST['txt_numero_cuenta']);
$subvencion = $Funciones->limpiarTexto($_REQUEST['txt_subvencion']);

$Subvencion = new Subvencion();
$Subvencion->setSubvencion($subvencion);
// $Subvencion->setIdSubvencion($numero_cuenta);

if($Subvencion->crearSubvencion()){
   echo "1";
}else{
   echo "2";
}

 ?>
