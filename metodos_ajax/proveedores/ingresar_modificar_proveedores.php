<?php
require_once '../../clases/Funciones.php';
require_once '../../clases/Proveedor.php';
require_once '../../clases/Conexion.php';

$Funciones = new Funciones();

$rut_proveedor = $Funciones->limpiarTexto($_REQUEST['txt_rut_proveedor']);
$razon_social = $Funciones->limpiarTexto($_REQUEST['txt_razon_social']);
$direccion = $Funciones->limpiarTexto($_REQUEST['txt_direccion']);
$telefono = $Funciones->limpiarNumeroEntero($_REQUEST['txt_telefono']);
$giro = $Funciones->limpiarTexto($_REQUEST['txt_giro']);
$correo = $Funciones->limpiarTexto($_REQUEST['txt_correo']);

// 1827352-0

//quita el guion al rut
$posicionGuion = strpos($rut_proveedor,'-');
$soloDigitoVerificador = substr($rut_proveedor,$posicionGuion+1,$posicionGuion+1);
$soloRunConPuntos = substr($rut_proveedor,0,$posicionGuion);
$soloRun=str_replace(".", "", $soloRunConPuntos);
// echo "solo rut: ".$soloRun." dv ".$soloDigitoVerificador;

$Proveedor = new Proveedor();
$Proveedor->setRutProveedor($soloRun);
$Proveedor->setDv($soloDigitoVerificador);
$Proveedor->setRazon_social($razon_social);
$Proveedor->setDireccion($direccion);
$Proveedor->setTelefono($telefono);
$Proveedor->setGiro($giro);
$Proveedor->setCorreo($correo);


$consultaExisteProveedor = $Proveedor->obtenerProveedor();

if($consultaExisteProveedor->num_rows==0){
//Si no devuelve nada, se debe crear nuevo proveedor
   if($Proveedor->crearProveedor()){
      echo "1";
   }else{
     echo "2";
   }
}else{
//si deveulve filas, el proveedore existe en bd, por lo tato se modifca
  if($Proveedor->modificarProveedor()){
    echo "1";
  }else{
    echo "2";
  }

}


?>
