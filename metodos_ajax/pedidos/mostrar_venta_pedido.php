<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Ventas.php';


              echo '<table class="table table-bordered table-sm bg-white">
                <thead class="thead-dark">
                  <th>Producto</th>
                  <th>Descripcion</th>
                  <!-- <th>Cantidad</th> -->
                  <th>Valor</th>
                  <!-- <th>Total</th> -->
                </thead>
                <tbody>';

                  $Funciones = new Funciones();
                  // $texto_buscar = $Funciones->limpiarTexto($_REQUEST['texto_buscar']);
                 //  $id_producto = $_REQUEST['id_producto'];
                 // echo '<script> var id_producto = '.$id_producto.'; </script>';

                  $id_venta = $Funciones->limpiarNumeroEntero($_REQUEST['id_venta']);
                  $estado_listado_actual = $Funciones->limpiarNumeroEntero($_REQUEST['estado_listado_actual']);

                 echo '<script> id_venta = '.$id_venta.'; </script>';

                  // $id_venta = $Funciones->limpiarNumeroEntero($_REQUEST['id_venta']);
                  // $id_producto_elaborado = $Funciones->limpiarNumeroEntero($_REQUEST['id_producto_elaborado']);

                  $Venta = new Ventas();
                  $Venta->setIdVenta($id_venta);
                  // $Venta->setIdProductoElaborado($id_producto_elaborado);
                  $listadoVenta = $Venta->vistaDetalleVenta();


                  $total = 0;
                    while($filas = $listadoVenta->fetch_array()){



                      //inicio pregunta edicion de ingredientes
                      $descripcion = $filas['descripcion'];

                      $Conexion = new Conexion();
                      $Conexion = $Conexion->conectar();

                      $ingredientes_venta = $Conexion->query("SELECT * FROM vista_ingredientes_venta where id_detalle_venta=".$filas['id_detalle_venta']);

                      while($filas_ing = $ingredientes_venta->fetch_array()){

                        if($filas_ing['extra']!=0){
                            $descripcion = $descripcion.": ".$filas_ing['ingrediente']."".$filas_ing['marca']." X".$filas_ing['extra']."; ";
                        }

                      }

                      //fin de preguntar modificacion de ingredientes



                          echo '<tr>
                                  <td><span id="_'.$filas['id_producto_elaborado'].'" >'.$filas['id_producto_elaborado'].'</span></td>
                                  <td><span id="_'.$filas['id_producto_elaborado'].'">'.$descripcion.'</span></td>
                                <!-- <td><span id="_" >'.$filas['cantidad'].'</span></td> -->
                                  <td><span id="_" >$'.number_format($filas['valor_unitario'],0,",",".").'</span></td>
                                <!-- <td><span id="_" >$'.number_format($filas['valor_total'],0,",",".").'</span></td> -->
                                <!--  <td><button class="btn btn-danger" onclick="eliminarProductoVenta('.$filas['id_producto_elaborado'].', '.$filas['id_venta'].')" ><i class="fas fa-trash-alt"></i></button></td> -->
                               </tr>';

                               $total += $filas['valor_total'];
                    }

                    echo '

                        <tr class="table-info">
                            <td colspan="2"><strong>Total a pagar</strong></td>
                            <td><strong>$'.number_format($total,0,',','.').'</strong></td>
                        </tr>

                     </tbody>
                  </table>';

if($estado_listado_actual!=4){

    echo '
       <div class="container">
           <div class="row">
              <button type="submit"  class="btn btn-success btn-lg btn-block ">LISTO PARA LA ENTREGA</button>
           </div>
       </div>
    ';
}

 ?>
