<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Usuario.php';

$Funciones = new Funciones();

$rut = $Funciones->limpiarNumeroEntero($_REQUEST['id']);

$Usuario = new Usuario();
$Usuario->setRun($rut);


if($Usuario->eliminarUsuario()){
   echo "1";
}else{
   echo "2";
}

 ?>
