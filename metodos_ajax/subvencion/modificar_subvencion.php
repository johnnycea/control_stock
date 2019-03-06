<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Usuario.php';
require_once '../../clases/Subvencion.php';

$Funciones = new Funciones();

$id_subvencion = $Funciones->limpiarNumeroEntero($_REQUEST['txt_id_subvencion']);
$subvencion = $Funciones->limpiarTexto($_REQUEST['txt_subvencion']);

$Subvencion = new Subvencion();
$Subvencion->setIdSubvencion($id_subvencion);
$Subvencion->setSubvencion($subvencion);

if($Subvencion->modificarSubvencion()){
   echo "1";
}else{
   echo "2";
}

 ?>
