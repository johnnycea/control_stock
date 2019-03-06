<?php
require_once '../../clases/Funciones.php';
require_once '../../clases/Movimiento.php';
require_once '../../clases/Conexion.php';

$Funciones = new Funciones();

$fecha_ingreso = $Funciones->limpiarTexto($_REQUEST['txt_fecha_ingreso']);
$fecha_ingreso = date_create($fecha_ingreso);
$fecha_ingreso = date_format($fecha_ingreso, 'Y-m-d');

$tipo_movimiento = $Funciones->limpiarNumeroEntero($_REQUEST['select_tipo_movimiento']);

if(isset($_REQUEST['select_tipo_gasto'])){
  $tipo_gasto = $Funciones->limpiarTexto($_REQUEST['select_tipo_gasto']);
}else{
  $tipo_gasto="NULL";
}

$colegio = $Funciones->limpiarNumeroEntero($_REQUEST['select_colegio']);
$subvencion = $Funciones->limpiarNumeroEntero($_REQUEST['select_subvencion']);
$cuenta = $Funciones->limpiarNumeroEntero($_REQUEST['select_cuenta']);
$estado = $Funciones->limpiarNumeroEntero($_REQUEST['select_estado']);

$descripcion = $Funciones->limpiarTexto($_REQUEST['txt_descripcion']);
$orden_compra = $Funciones->limpiarTexto($_REQUEST['txt_orden_compra']);
$monto = $Funciones->limpiarNumeroEntero($_REQUEST['txt_monto']);
//campos sep
$sep_preferente = $Funciones->limpiarNumeroEntero($_REQUEST['sep_preferente']);
$sep_preferencia = $Funciones->limpiarNumeroEntero($_REQUEST['sep_preferencia']);
$sep_concentracion = $Funciones->limpiarNumeroEntero($_REQUEST['sep_concentracion']);
$sep_articulo_19 = $Funciones->limpiarNumeroEntero($_REQUEST['sep_articulo_19']);
$sep_ajustes = $Funciones->limpiarNumeroEntero($_REQUEST['sep_ajustes']);
// $sep_total = $Funciones->limpiarNumeroEntero($_REQUEST['sep_total']);
//campos scvtf
$scvtf_normal = $Funciones->limpiarNumeroEntero($_REQUEST['scvtf_normal']);
$scvtf_nivelacion = $Funciones->limpiarNumeroEntero($_REQUEST['scvtf_nivelacion']);


$Movimiento = new Movimiento();
$Movimiento->setTipoMovimiento($tipo_movimiento);
$Movimiento->setTipoGasto($tipo_gasto);
$Movimiento->setColegio($colegio);
$Movimiento->setSubvencion($subvencion);
$Movimiento->setCuentaPresupuesto($cuenta);
$Movimiento->setEstado($estado);
$Movimiento->setDescripcion($descripcion);
$Movimiento->setFechaIngreso($fecha_ingreso);
$Movimiento->setOrdenCompra($orden_compra);
$Movimiento->setMonto($monto);
$Movimiento->setSepPreferente($sep_preferente);
$Movimiento->setSepPreferencial($sep_preferencia);
$Movimiento->setSepConcentracion($sep_concentracion);
$Movimiento->setSepArticulo19($sep_articulo_19);
$Movimiento->setSepAjustes($sep_ajustes);
// $Movimiento->setSepTotal($sep_total);
$Movimiento->setScvtfNormal($scvtf_normal);
$Movimiento->setScvtfNivelacion($scvtf_nivelacion);

//recibe el id de correspondencia, en caso que se desea modificar
$_id_movimiento;

if($_REQUEST['txt_id_movimiento']!=""){
// echo "modificar o";

  $_id_movimiento = $Funciones->limpiarNumeroEntero($_REQUEST['txt_id_movimiento']);
  $Movimiento->setIdMovimiento($_id_movimiento);

    if($Movimiento->modificarMovimiento()){
      echo "1";
    }else{
      echo "2";
    }

}else{
  // echo "nuevo o";
  $numero_certificado=1;


  $anio_ingreso=date_create($fecha_ingreso);
  $anio_ingreso= date_format($anio_ingreso,"Y");

  $conexion = new Conexion();
  $conexion = $conexion->conectar();

  $consulta_numero ="select m.numero_certificado from tb_movimientos m
                     where m.numero_certificado = (select max(numero_certificado) from tb_movimientos where year(fecha_ingreso)=".$anio_ingreso.");";

  // echo $consulta_numero;
  $resultado_numero = $conexion->query($consulta_numero);

  while($filas_numero = $resultado_numero->fetch_array()){
        $numero_certificado = $filas_numero['numero_certificado'];
        $numero_certificado++;
  }
   // echo "numero de certifixacdo es_ :".$numero_certificado;

  $Movimiento->setNumeroCertificado($numero_certificado);

    if($Movimiento->ingresarMovimiento()){

             if($subvencion==3){//si es subvencion SEP, agrega un gasto del 10% para la administracion central

               $MovimientoGastoSep = new Movimiento();
               $MovimientoGastoSep->setTipoMovimiento(2);
               $MovimientoGastoSep->setTipoGasto(1);
               $MovimientoGastoSep->setColegio($colegio);
               $MovimientoGastoSep->setSubvencion($subvencion);
               $MovimientoGastoSep->setCuentaPresupuesto($cuenta);
               $MovimientoGastoSep->setEstado($estado);
               $MovimientoGastoSep->setDescripcion("DESCUENTO 10% ADMINISTRACION CENTRAL");
               $MovimientoGastoSep->setFechaIngreso($fecha_ingreso);
               $MovimientoGastoSep->setOrdenCompra($orden_compra);
               $MovimientoGastoSep->setMonto((($monto*10)/100));
               $MovimientoGastoSep->setSepPreferente("0");
               $MovimientoGastoSep->setSepPreferencial("0");
               $MovimientoGastoSep->setSepConcentracion("0");
               $MovimientoGastoSep->setSepArticulo19("0");
               $MovimientoGastoSep->setSepAjustes("0");;
               $MovimientoGastoSep->setScvtfNormal("0");
               $MovimientoGastoSep->setScvtfNivelacion("0");

               $numero_certificado=1;
               $anio_ingreso=date_create($fecha_ingreso);
               $anio_ingreso= date_format($anio_ingreso,"Y");

               $conexion_2 = new Conexion();
               $conexion_2 = $conexion_2->conectar();

               $consulta_numero ="select m.numero_certificado from tb_movimientos m
                                  where m.numero_certificado = (select max(numero_certificado) from tb_movimientos where year(fecha_ingreso)=".$anio_ingreso.");";

               // echo $consulta_numero;
               $resultado_numero = $conexion->query($consulta_numero);

               while($filas_numero = $resultado_numero->fetch_array()){
                     $numero_certificado = $filas_numero['numero_certificado'];
                     $numero_certificado++;
               }


               $MovimientoGastoSep->setNumeroCertificado($numero_certificado);

                if($MovimientoGastoSep->ingresarMovimiento()){
                   echo "3";
                }else{
                  echo "2";
                }

             }else{
               echo "1";
             }

    }else{
      echo "2";
    }

}



 ?>
