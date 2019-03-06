<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Usuario.php';
require_once '../../clases/Colegio.php';

$Funciones = new Funciones();

$rbd_colegio = $Funciones->limpiarTexto($_REQUEST['id']);

$Colegio = new Colegio();
$Colegio->setColegio($rbd_colegio);

if($Colegio->eliminarColegio()){
   echo "1";
}else{
   echo "2";
}

 ?>
