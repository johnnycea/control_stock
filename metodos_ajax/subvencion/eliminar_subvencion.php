<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Usuario.php';
require_once '../../clases/Subvencion.php';

$Funciones = new Funciones();

$id_subvencion = $Funciones->limpiarTexto($_REQUEST['id']);

$Subvencion = new Subvencion();
$Subvencion->setIdSubvencion($id_subvencion);

if($Subvencion->eliminarSubvencion()){
   echo "1";
}else{
   echo "2";
}

 ?>
