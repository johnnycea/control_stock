<?php
require_once '../../clases/Funciones.php';
require_once '../../clases/Facturas.php';
require_once '../../clases/Conexion.php';

$Funciones = new Funciones();

$txt_id_factura = $Funciones->limpiarTexto($_REQUEST['txt_id_factura']);
$select_proveedor = $Funciones->limpiarTexto($_REQUEST['select_proveedor']);
$txt_numero_factura = $Funciones->limpiarTexto($_REQUEST['txt_numero_factura']);
$txt_fecha_factura = $Funciones->limpiarNumeroEntero($_REQUEST['txt_fecha_factura']);


$Factura = new Facturas();
$Factura->setIdFactura($txt_id_factura);
$Factura->setRutProveedor($select_proveedor);
$Factura->setNumeroFactura($txt_numero_factura);
$Factura->setFecha($txt_fecha_factura);



if($txt_id_factura=="" || $txt_id_factura==" "){
//Si no tiene id de factura se debe crear nuevo factura
   if($Factura->crearFactura()){
      echo "1";
   }else{
     echo "2";
   }
}else{
//si tiene id se modifca
  if($Factura->modificarFactura()){
    echo "1";
  }else{
    echo "2";
  }

}


?>
