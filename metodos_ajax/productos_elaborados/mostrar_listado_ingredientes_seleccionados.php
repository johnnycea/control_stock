<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/ProductoElaborado.php';


              echo '<table class="table table-bordered table-info">
                <thead>
                  <th>Codigo</th>
                  <th>Descripcion</th>
                  <th>U. medida</th>
                  <th>Cantidad</th>
                  <th></th>
                </thead>
                <tbody>';

                  $Funciones = new Funciones();
                  $id_producto_elaborado = $Funciones->limpiarNumeroEntero($_REQUEST['id_producto_elaborado']);

                  $ProductoIngrediente = new ProductoElaborado();
                  $ProductoIngrediente->setIdProductoElaborado($id_producto_elaborado);
                  $listadoIngredientes = $ProductoIngrediente->obtener_ingredientes_producto(); //$texto_buscar," where id_estado=1 or id_estado=2 "

                    while($filas = $listadoIngredientes->fetch_array()){

                          echo '<tr>
                                  <td>'.$filas['id_producto'].'</td>
                                  <td>'.$filas['descripcion'].'</td>
                                  <td>'.$filas['unidad_medida'].'</td>
                                  <td>'.$filas['cantidad'].'</td>
                                  <td></td>
                               </tr>';
                    }

                    echo '
                     </tbody>
                  </table>';



 ?>
