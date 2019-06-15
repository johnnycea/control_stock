<?php
require_once '../../clases/Funciones.php';
require_once '../../clases/Facturas.php';
require_once '../../clases/Conexion.php';
require_once '../../clases/Proveedor.php';

$Funciones = new Funciones();

$txt_id_factura = $Funciones->limpiarTexto($_REQUEST['txt_id_factura']);
$txt_numero_factura = $Funciones->limpiarTexto($_REQUEST['txt_numero_factura']);
$txt_fecha_factura = $Funciones->limpiarNumeroEntero($_REQUEST['txt_fecha_factura']);

$rut_proveedor = $Funciones->limpiarTexto($_REQUEST['txt_rut_proveedor']);
$razon_social_proveedor = $Funciones->limpiarTexto($_REQUEST['txt_razon_social_proveedor']);
$giro_proveedor = $Funciones->limpiarTexto($_REQUEST['txt_giro_proveedor']);
$direccion_proveedor = $Funciones->limpiarTexto($_REQUEST['txt_direccion_proveedor']);
$telefono_proveedor = $Funciones->limpiarTexto($_REQUEST['txt_telefono_proveedor']);
$correo_proveedor = $Funciones->limpiarTexto($_REQUEST['txt_correo_proveedor']);
$posicionGuion = strpos($rut_proveedor,'-');
$soloRut = substr($rut_proveedor,0,$posicionGuion);
$digito_verificador = substr($rut_proveedor,$posicionGuion+1,$posicionGuion+2);


$Proveedor = new Proveedor();
$Proveedor->setRutProveedor($soloRut);
$Proveedor->setDV($digito_verificador);
$Proveedor->setRazon_social($razon_social_proveedor);
$Proveedor->setGiro($giro_proveedor);
$Proveedor->setDireccion($direccion_proveedor);
$Proveedor->setTelefono($telefono_proveedor);
$Proveedor->setCorreo($correo_proveedor);

$ingresa_proveedor = false;
$comprueba_proveedor_existe = $Proveedor->obtenerProveedor();
if($comprueba_proveedor_existe->num_rows>0){
//SE DEBE ACTUALIZAR EL PROVEEDOR

  if($Proveedor->modificarProveedor()){
    $ingresa_proveedor = true;
  }

}else{
  //SE DEBE CREAR EL PROVEEDOR
  if($Proveedor->crearProveedor()){
    $ingresa_proveedor = true;
  }

}




if($ingresa_proveedor==true){

    $Factura = new Facturas();
    $Factura->setIdFactura($txt_id_factura);
    $Factura->setRutProveedor($rut_proveedor);
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

}else{
  echo "3"; //ERROR AL INGRESAR PROVEEDOR
}




?>
