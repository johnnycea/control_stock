<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Proveedor.php';


$Funciones = new Funciones();
$texto_buscar = $Funciones->limpiarTexto($_REQUEST['texto_buscar']);

$posicionGuion = strpos($texto_buscar,'-');
$soloRut = substr($texto_buscar,0,$posicionGuion);


$Proveedor = new Proveedor();
$Proveedor->setRutProveedor($soloRut);
$listadoProveedor = $Proveedor->obtenerProveedor(); //$texto_buscar," where id_estado=1 or id_estado=2 "


$proveedor_encontrado = array();

  while($filas = $listadoProveedor->fetch_array()){
     $proveedor_encontrado['razon_social'] = $filas['razon_social'];
     $proveedor_encontrado['telefono'] = $filas['telefono'];
     $proveedor_encontrado['giro'] = $filas['giro'];
     $proveedor_encontrado['correo'] = $filas['correo'];
     $proveedor_encontrado['direccion'] = $filas['direccion'];
  }


 echo json_encode($proveedor_encontrado);

 ?>
