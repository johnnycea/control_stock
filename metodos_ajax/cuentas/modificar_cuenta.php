<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Usuario.php';
require_once '../../clases/Cuenta.php';

$Funciones = new Funciones();

$numero_cuenta = $Funciones->limpiarTexto($_REQUEST['txt_numero_cuenta']);
$nombre_cuenta = $Funciones->limpiarTexto($_REQUEST['txt_nombre_cuenta']);
$estado_cuenta = $Funciones->limpiarTexto($_REQUEST['cmb_estado']);

$Cuenta = new Cuenta();
$Cuenta->setCuenta($numero_cuenta);
$Cuenta->setNombre($nombre_cuenta);
$Cuenta->setEstado($estado_cuenta);


if($Cuenta->modificarCuenta()){
   echo "1";
}else{
   echo "2";
}
 ?>
