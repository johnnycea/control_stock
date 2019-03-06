<?php

require_once '../../clases/Movimiento.php';

$colegio = $_REQUEST['colegio'];
$subvencion = $_REQUEST['subvencion'];
$anio = getdate();
$anio = $anio['year'];

$Movimiento = new Movimiento();
$Movimiento->setColegio($colegio);
$Movimiento->setSubvencion($subvencion);

$resultado = $Movimiento->mostrarTotalesColegio($anio);
$filas = $resultado->fetch_array();

echo '
<table class="table table-bordered table-striped">
  <tbody>
    <tr>
      <td><label for="">Total Ingresos: </label></td>
      <td>'.number_format($filas['total_ingreso'], "0", ",", ".").'</td>
    </tr>
    <tr>
      <td><label for="">Total Gastos: </label></td>
      <td>'.number_format($filas['total_gasto'], "0", ",", ".").'</td>
    </tr>
  </tbody>
</table>
';



 ?>
