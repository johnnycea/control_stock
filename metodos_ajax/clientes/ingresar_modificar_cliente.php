<?php
require_once '../../clases/Funciones.php';
require_once '../../clases/Cliente.php';
require_once '../../clases/Conexion.php';

$Funciones = new Funciones();

$txt_rut_cliente = $Funciones->limpiarTexto($_REQUEST['txt_rut_cliente']);
$txt_dv = $Funciones->limpiarTexto($_REQUEST['txt_dv']);
$txt_nombre = $Funciones->limpiarTexto($_REQUEST['txt_nombre']);
$txt_apellidos = $Funciones->limpiarTexto($_REQUEST['txt_apellidos']);
$txt_calle = $Funciones->limpiarTexto($_REQUEST['txt_calle']);
$txt_numero = $Funciones->limpiarTexto($_REQUEST['txt_numero']);
$txt_observacion= $Funciones->limpiarNumeroEntero($_REQUEST['txt_observacion']);
$txt_telefono = $Funciones->limpiarNumeroEntero($_REQUEST['txt_telefono']);


$Cliente = new Cliente();
$Cliente->setRutCliente($txt_rut_cliente);
$Cliente->setDv($txt_dv);
$Cliente->setNombre($txt_nombre);
$Cliente->setApellidos($txt_apellidos);
$Cliente->setCalle($txt_calle);
$Cliente->setNumeroCalle($txt_numero);
$Cliente->setObservacion($txt_observacion);
$Cliente->setTelefono($txt_telefono);

$consultaExisteCliente = $Cliente->obtenerClienteRegistrados();
//
if($consultaExisteCliente->num_rows==0){
//Si no devuelve nada, se debe crear nuevo producto
   if($Cliente->crearCliente()){
      echo "1";
   }else{
      echo "2";
   }
}
else{
//si deveulve filas, el producto existe en bd, por lo tato se modifca
  if($Cliente->modificarCliente()){
    echo "1";
  }else{
    echo "2";
  }

 }


?>
