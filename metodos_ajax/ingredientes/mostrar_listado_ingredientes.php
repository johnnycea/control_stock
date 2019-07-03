<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Producto.php';

              echo '<table class="table table table-dark">
                <thead>
                  <th>Codigo</th>
                  <th>Descripcion</th>
                  <th>Marca</th>
                  <th>U. medida</th>
                  <th>Stock Minimo</th>
                  <th></th>
                </thead>
                <tbody>';

                  $Funciones = new Funciones();
                  $texto_buscar = $Funciones->limpiarTexto($_REQUEST['texto_buscar']);
                  // $id_creado = $Funciones->limpiarNumeroEntero($_REQUEST['id_creado']);

                  $ProductoIngrediente = new Producto();
                  $listadoIngredientes = $ProductoIngrediente->obtenerProductosParaIngredientes($texto_buscar); //$texto_buscar," where id_estado=1 or id_estado=2 "

                    while($filas = $listadoIngredientes->fetch_array()){

                          echo '<tr>
                                  <td><span id="_'.$filas['id_producto'].'" >'.$filas['id_producto'].'</span></td>
                                  <td><span id="_'.$filas['id_producto'].'" >'.$filas['descripcion'].'</span></td>
                                  <td>'.$filas['marca'].'</span></td>
                                  <td>'.$filas['unidad_medida'].'</td>
                                  <td><span id="_'.$filas['id_producto'].'" >'.$filas['stock_minimo'].'</span></td>
                                  <td><button class="btn btn-warning col-6" onclick="cargarModificarProductoElaborado('.$filas['id_producto'].')" data-target="#modal_nuevo_producto_elaborado" data-toggle="modal" ><i class="far fa-edit"></i></button></td>
                                  <td><button class="btn btn-danger col-6" " onclick="eliminarProductoElaborado('.$filas['id_producto'].')" ><i class="fa fa-trash-alt"></i></button></td>
                               </tr>';
                    }

                    echo '
                     </tbody>
                  </table>';



 ?>
