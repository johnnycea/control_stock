<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Facturas.php';
require_once '../../clases/Ventas.php';

$funciones = new Funciones();

$tipo_informe = $funciones->limpiarNumeroEntero($_REQUEST['select_tipo_informe']);
$fecha_inicio = $funciones->limpiarTexto($_REQUEST['txt_fecha_inicio']);
$fecha_fin = $funciones->limpiarTexto($_REQUEST['txt_fecha_fin']);


if($tipo_informe==1){//

}else if($tipo_informe==2){//

}


 ?>
