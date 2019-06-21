<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Facturas.php';
require_once '../../clases/Ventas.php';


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



                        $cantidad_ingresos = $filas['stock'];
                        $cantidad_salidas;

                        $Venta = new Ventas();
                        $cantidad_salidas = $Venta->obtenerCantidadIngredienteVenta($filas['id_producto']);


                        $stock_total = ($cantidad_ingresos-$cantidad_salidas);

                        // echo 'cantidad entradas: '.$cantidad_ingresos;
                        // echo 'cantidad salidas: '.$cantidad_salidas;

                        $clase_stock = "bg-info";
                        if($stock_total < $filas['stock_minimo']){
                          $clase_stock = "bg-danger text-white";
                        }else{
                          $clase_stock = "bg-success text-white";
                        }

                        echo '<td class="'.$clase_stock.'">'.$stock_total.'</td>';

              echo '</tr>';


         }

    echo '
     </tbody>
  </table>';

 ?>
