<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Facturas.php';


  echo '
  <table class="table table-dark table-bordered  table-sm table-striped table-hover">
     <thead class="" align=center>

        <th>Codigo</th>
        <th>Descripcion</th>
        <th>Unidad medida</th>
        <th>Stock minimo</th>
        <th>Stock</th>

     </thead>
     <tbody>';


       $Facturas = new Facturas();
       $listadoFacturas = $Facturas->mostrarStockIngresos(); //$texto_buscar," where id_estado=1 or id_estado=2 "

         while($filas = $listadoFacturas->fetch_array()){

               echo '<tr>
                        <td>'.$filas['id_producto'].'</td>
                        <td>'.$filas['descripcion'].' '.$filas['marca'].'</td>
                        <td>'.$filas['unidad_medida'].'</td>
                        <td>'.$filas['stock_minimo'].'</td>';

                      $clase_stock = "bg-info";
                      if($filas['stock'] < $filas['stock_minimo']){
                        $clase_stock = "bg-danger text-white";
                      }else{
                        $clase_stock = "bg-success text-white";

                      }

                        echo '<td class="'.$clase_stock.'">'.$filas['stock'].'</td>';

              echo '</tr>';


         }

    echo '
     </tbody>
  </table>';

 ?>
