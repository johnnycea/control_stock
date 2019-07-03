	<?php
	require_once '../../clases/Conexion.php';
	require_once '../../clases/Funciones.php';
	require_once '../../clases/Ventas.php';

			 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script type="text/javascript">
            function imprimir() {
                if (window.print) {
                    window.print();
                } else {
                    alert("La función de impresion no esta soportada por su navegador.");
                }
            }
        </script>
    </head>
    <body onload="imprimir();">
			<?php


			              echo '<table class="table table-bordered table-sm bg-white">
			                <thead class="thead-dark">
			                  <th>Producto</th>
			                  <th>Descripcion</th>
			                  <th>Cantidad</th>
			                  <th>Valor</th>
			                  <th>Total</th>
			                </thead>
			                <tbody>';

			                  $Funciones = new Funciones();

			                  $id_venta = $Funciones->limpiarNumeroEntero($_REQUEST['id_venta']);
			                 echo '<script> id_venta = '.$id_venta.'; </script>';

			                  $Venta = new Ventas();
			                  $Venta->setIdVenta($id_venta);
			                  $listadoVenta = $Venta->vistaDetalleVenta();

			                  $total = 0;
			                    while($filas = $listadoVenta->fetch_array()){

			                          echo '<tr>

			                                  <td><span id="_'.$filas['id_producto_elaborado'].'" >'.$filas['id_producto_elaborado'].'</span></td>
			                                  <td><span id="_'.$filas['id_producto_elaborado'].'">'.$filas['descripcion'].'</span></td>
			                                  <td><span id="_" >'.$filas['cantidad'].'</span></td>
			                                  <td><span id="_" >$'.number_format($filas['valor_unitario'],0,",",".").'</span></td>
			                                  <td><span id="_" >$'.number_format($filas['valor_total'],0,",",".").'</span></td>
			                                <!--  <td><button class="btn btn-danger" onclick="eliminarProductoVenta('.$filas['id_producto_elaborado'].', '.$filas['id_venta'].')" ><i class="fas fa-trash-alt"></i></button></td> -->
			                               </tr>';

			                               $total += $filas['valor_total'];
			                    }

			                    echo '
			                        <tr class="table-info">
			                            <td colspan="4"><strong>Total a pagar</strong></td>
			                            <td><strong>$'.number_format($total,0,',','.').'</strong></td>
			                        </tr>

			                     </tbody>
			                  </table>';

			echo '
			   <div class="container">
			       <div class="row">
			          <button type="submit"  class="btn btn-success btn-lg btn-block ">LISTO PARA LA ENTREGA</button>
			       </div>
			   </div>
			';

			// onclick="pedidoFinalizado('.$filas['id_venta'].')"
			 ?>

    </body>
</html>
