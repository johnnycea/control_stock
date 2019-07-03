<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';


$funciones = new Funciones();

$tipo_informe = $funciones->limpiarNumeroEntero($_REQUEST['select_tipo_informe']);
$fecha_inicio = $funciones->limpiarTexto($_REQUEST['txt_fecha_inicio']);
$fecha_fin = $funciones->limpiarTexto($_REQUEST['txt_fecha_fin']);
$tipo_venta = $funciones->limpiarTexto($_REQUEST['select_tipo_venta']);
$medio_pago = $funciones->limpiarTexto($_REQUEST['select_medio_pago']);



$Conexion = new Conexion();
$Conexion = $Conexion->conectar();


if($tipo_informe==1){//informe general

     $consulta = "call informe_resumen('".$fecha_inicio."','".$fecha_fin."');";
     $resultado_consulta = $Conexion->query($consulta);

     if($filas = $resultado_consulta->fetch_array()){

       echo '

       <div class="container">
           <div class="row">


               <div class="col-md-4">
                 <div class="card text-dark bg-white">
                      <div class="card-header text-white bg-info ">
                        <center><h4>Ventas</h4></center>
                      </div>
                      <div class="card-body">
                        <center>
                         <h5>Cantidad ventas: '.$filas['cantidad_ventas'].'</h5>
                         <h1>$'.number_format($filas['ingresos'],0,",",".").'</h1>
                       </center>
                      </div>
                 </div>
               </div>

               <div class="col-md-4">
                 <div class="card text-dark bg-white">
                      <div class="card-header text-black bg-warning ">
                        <center><h4>Facturas</h4></center>
                      </div>
                      <div class="card-body">
                        <center>
                        <h5>Cantidad facturas: '.$filas['cantidad_facturas'].'</h5>
                        <h1>$'.number_format($filas['gastos'],0,",",".").'</h1>
                       </center>
                      </div>
                 </div>
               </div>

               <div class="col-md-4">
                 <div class="card text-dark bg-white">
                      <div class="card-header text-white bg-success ">
                        <center><h4>Saldo</h4></center>
                      </div>
                      <div class="card-body">
                        <center>
                        <h5>&nbsp</h5>
                        <h1>$'.number_format($filas['saldo'],0,",",".").'</h1>
                       </center>
                      </div>
                 </div>
               </div>


           </div>
       </div>

       ';

     }

}else if($tipo_informe==2){//


$total_ventas = 0;
$cantidad_ventas = 0;
    echo '

   <div><hr/></div>
   <h3>Detalle ventas</h3>
   <div><hr/></div>

    <div class="table-responsive">
         <table class="table table-bordered table-stripped ">

            <thead class="text-white bg-info ">
               <th>Cod. Venta</th>
               <th>Fecha</th>
               <th>Tipo</th>
               <th>Medio Pago</th>
               <th>Total</th>
            </thead>
            <tbody>';

            $condicion_tipo_venta = "";
            $condicion_medio_pago = "";

            if($tipo_venta!=""){
               $condicion_tipo_venta = " (tipo_venta = ".$tipo_venta.") ";
            }


            if($medio_pago!=""){
               $condicion_medio_pago = $condicion_medio_pago." (id_medio_pago = ".$medio_pago.") and ";
            }else{

              if($tipo_venta!=""){
                $condicion_tipo_venta = $condicion_tipo_venta." and ";
              }

            }

            $consulta_ventas = "select * from vista_listado_ventas
                                where
                                ".$condicion_tipo_venta."
                                ".$condicion_medio_pago."
                                ( date(fecha) between '".$fecha_inicio."' and '".$fecha_fin."' ) ;";

// echo $consulta_ventas;

            $resultado_consulta_ventas = $Conexion->query($consulta_ventas);

            while($filas = $resultado_consulta_ventas->fetch_array()){

              $cantidad_ventas++;

               if($filas['tipo_venta']==1 or $filas['tipo_venta']==2){//SOLO SUMA AL TOTAL LAS VENTAS QUE NO SEAN POR CORTESIA
                  $total_ventas += $filas['total_venta'];
               }

              echo '
                    <tr>
                      <td>'.$filas['id_venta'].'</td>
                      <td>'.$filas['fecha'].'</td>
                      <td>'.$filas['descripcion_tipo_venta'].'</td>
                      <td>'.$filas['descripcion_medio_pago'].'</td>
                      <td>$'.number_format($filas['total_venta'],0,",",".").'</td>
                    </tr>';
              }


        echo '
              <tr>
                 <td colspan="4">Total Ventas</td>
                 <td>$'.number_format($total_ventas,0,",",".").'</td>
              </tr>

            </tbody>
         </table>
    </div>
    ';

    ///tabla detalle ingresos


$total_facturas=0;
$cantidad_facturas=0;

    echo '

   <div><hr/></div>
   <h3>Detalle facturas</h3>
   <div><hr/></div>

    <div class="table-responsive">
         <table class="table table-bordered table-stripped ">

            <thead class="text-white bg-info ">
               <th>Num. Factura</th>
               <th>Fecha</th>
               <th>Total</th>
            </thead>
            <tbody>';


          $consulta_facturas = "select * from vista_listado_facturas where fecha_factura between '".$fecha_inicio."' and '".$fecha_fin."' ;";

            $resultado_consulta_facturas = $Conexion->query($consulta_facturas);

            while($filas_facturas = $resultado_consulta_facturas->fetch_array()){

              $cantidad_facturas++;
               $total_facturas += $filas_facturas['total_factura'];

              echo '
                    <tr>
                      <td>'.$filas_facturas['id_factura'].'</td>
                      <td>'.$filas_facturas['fecha_factura'].'</td>
                      <td>$'.number_format($filas_facturas['total_factura'],0,",",".").'</td>
                    </tr>';
              }


        echo '
              <tr>
                 <td colspan="2">Total Gastos Facuras</td>
                 <td>$'.number_format($total_facturas,0,",",".").'</td>
              </tr>

            </tbody>
         </table>
    </div>
    ';




    echo '

   <div><hr/></div>
   <h3>Saldo</h3>
   <div><hr/></div>

    <div class="table-responsive">
         <table class="table table-bordered table-stripped ">

            <thead class="text-white bg-info ">
               <th>Ventas</th>
               <th>Facturas</th>
               <th>Saldo</th>
            </thead>
            <tbody>

                    <tr>
                      <td>Cantidad Ventas: '.$cantidad_ventas.'</td>
                      <td>Cantidad Facturas: '.$cantidad_facturas.'</td>
                    </tr>

                    <tr>
                      <td>$'.number_format($total_ventas,0,",",".").'</td>
                      <td>$'.number_format($total_facturas,0,",",".").'</td>
                      <td>$'.number_format(($total_ventas-$total_facturas),0,",",".").'</td>
                    </tr>


            </tbody>
         </table>
    </div>
    ';


}


 ?>
