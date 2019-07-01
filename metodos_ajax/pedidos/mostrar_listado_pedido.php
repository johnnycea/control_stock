<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Pedido.php';

              echo '
              <table class="table table-dark table-sm table-striped table-bordered table-hover">
                <thead>
                  <th>Codigo pedido</th>
                  <th>Codigo venta</th>
                  <th>Rut Cliente</th>
                  <th>Estado</th>
                  <th>Repartidor</th>
                  <th></th>
                </thead>
                <tbody>';

                  $Funciones = new Funciones();
                  $texto_buscar = $Funciones->limpiarTexto($_REQUEST['texto_buscar']);
                  // $id_creado = $Funciones->limpiarNumeroEntero($_REQUEST['id_creado']);

                  $PedidoVenta = new Pedido();
                  $listadoPedido = $PedidoVenta->obtenerPedidos($texto_buscar); //$texto_buscar," where id_estado=1 or id_estado=2 "

                    while($filas = $listadoPedido->fetch_array()){

                          echo '<tr>
                                  <td><span id="_'.$filas['id_pedido'].'" >'.$filas['id_pedido'].'</span></td>
                                  <td><span id="_'.$filas['id_pedido'].'" >'.$filas['id_venta'].'</span></td>
                                  <td>'.$filas['rut_cliente'].'</td>
                                  <td>'.$filas['estado_pedido'].'</td>
                                  <td>'.$filas['id_usuario_repartidor'].'</span></td>
                                  <td><button class="btn btn-warning col-6" onclick="cargarModificarProductoElaborado('.$filas['id_producto'].')" data-target="#modal_nuevo_producto_elaborado" data-toggle="modal" style="font-size:15px; background-color:rgb(139, 95, 69); color:white;" ><i class="far fa-edit"></i></button></td>
                                  <td><button class="btn btn-danger col-6"  style="font-size:15px; " onclick="eliminarProductoElaborado('.$filas['id_producto'].')" ><i class="fa fa-trash-alt"></i></button></td>
                               </tr>';
                    }

                    echo '
                     </tbody>
                  </table>';



 ?>
