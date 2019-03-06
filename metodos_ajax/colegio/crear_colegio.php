<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Usuario.php';
require_once '../../clases/Colegio.php';

$Funciones = new Funciones();

$rbd_colegio = $Funciones->limpiarTexto($_REQUEST['txt_rbd_colegio']);
$nombre_colegio = $Funciones->limpiarTexto($_REQUEST['txt_nombre_colegio']);
$estado = $Funciones->limpiarTexto($_REQUEST['select_estado']);
$tipo_establecimiento = $Funciones->limpiarTexto($_REQUEST['cmb_tipo_establecimiento']);


$Colegio = new Colegio();
$Colegio->setColegio($rbd_colegio);
$Colegio->setNombre($nombre_colegio);
$Colegio->setEstado($estado);
$Colegio->setTipoEstablecimiento($tipo_establecimiento);


if($Colegio->crearColegio()){
   echo "1";
}else{
   echo "2";
}

 ?>
