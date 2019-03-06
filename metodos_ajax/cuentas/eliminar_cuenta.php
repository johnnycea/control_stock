<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Usuario.php';
require_once '../../clases/Cuenta.php';

$Funciones = new Funciones();

$numero_cuenta = $Funciones->limpiarTexto($_REQUEST['id']);

$Cuenta = new Cuenta();
$Cuenta->setCuenta($numero_cuenta);

if($Cuenta->eliminarCuenta()){
   echo "1";
}else{
   echo "2";
}

 ?>
