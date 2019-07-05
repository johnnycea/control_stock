<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Ventas.php';


              echo '<table class="table table-bordered  table-dark table-sm">
                <thead class="thead-dark">
                  <th>Cod.</th>
                  <th>Descripcion</th>
                <!--  <th>Cantidad</th> -->
                  <th>Valor</th>
                <!-- <th>Total</th>  -->
                  <th style="width:30px;"></th>
                  <th style="width:30px;"></th>
                </thead>
                <tbody>';

                  $Funciones = new Funciones();

                  $id_venta = $Funciones->limpiarNumeroEntero($_REQUEST['id_venta']);
                 echo '<script> id_venta = '.$id_venta.'; </script>';

                  $Venta = new Ventas();
                  $Venta->setIdVenta($id_venta);
                  $listadoVenta = $Venta->vistaDetalleVenta(); //$texto_buscar," where id_estado=1 or id_estado=2 "


                  $total = 0;
                    while($filas = $listadoVenta->fetch_array()){

                          echo '<tr>

                                  <td><span id="_'.$filas['id_producto_elaborado'].'" >'.$filas['id_producto_elaborado'].'</span></td>
                                  <td><span id="_'.$filas['id_producto_elaborado'].'">'.$filas['descripcion'].'</span></td>
                                <!--  <td><span id="_" >'.$filas['cantidad'].'</span></td> -->
                                <!--  <td><span id="_" >$'.number_format($filas['valor_unitario'],0,",",".").'</span></td> -->
                                  <td><span id="_" >$'.number_format($filas['valor_total'],0,",",".").'</span></td>
                                  <td>
                                    <button class="btn btn-warning btn-block" data-toggle="modal" data-target="#modal_modificar_ingredientes_producto" onclick="obtenerIngredientesProducto('.$filas['id_producto_elaborado'].','.$filas['id_detalle_venta'].')" ><i class="fas fa-lemon"></i></button>
                                  </td>
                                  <td>
                                    <button class="btn btn-danger btn-block" onclick="eliminarProductoVenta('.$filas['id_detalle_venta'].')" ><i class="fas fa-trash-alt"></i></button></td>
                                  </td>
                                     </div>
                               </tr>';

                               $total += $filas['valor_total'];
                    }

                    echo '

                        <tr class="table-info text-dark">
                            <td colspan="4"><strong>Total a pagar</strong></td>
                            <td><strong>$'.number_format($total,0,',','.').'</strong></td>
                        </tr>

                     </tbody>
                  </table>';


                  echo '

                   <div class="container clearfix">';
                      if($total!=0){
                        echo '<button type="button" data-toggle="modal" data-target="#modal_finalizar_venta" class="btn btn-success col-12 col-md-4 btn-block"><i class="fas fa-check-circle"></i> CONFIRMAR COMPRA</button>';
                      }

                   echo '</div>


                  ';

 ?>
