<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Facturas.php';
require_once '../../clases/Ventas.php';

$funciones = new Funciones();

$tipo_informe = $funciones->limpiarNumeroEntero($_REQUEST['select_tipo_informe']);
$fecha_inicio = $funciones->limpiarTexto($_REQUEST['txt_fecha_inicio']);
$fecha_fin = $funciones->limpiarTexto($_REQUEST['txt_fecha_fin']);


// echo 'tipo: '.$tipo_informe." inicio: ".$fecha_inicio." fin: ".$fecha_fin;

//CONSULTAR TOTAL DE Facturas

//CONSULTAR TOTAL

 ?>
