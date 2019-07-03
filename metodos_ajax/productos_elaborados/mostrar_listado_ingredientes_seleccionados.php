<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/ProductoElaborado.php';


              echo '<table class="table table-bordered  table-dark table-sm">
                <thead class="thead-dark">

                  <th>Nombre</th>
                  <th>U. Med</th>
                  <th>Cantidad</th>
                  <th></th>
                </thead>
                <tbody>';

                  $Funciones = new Funciones();
                  $id_producto_elaborado = $Funciones->limpiarNumeroEntero($_REQUEST['id_producto_elaborado']);

                  $ProductoIngrediente = new ProductoElaborado();
                  $ProductoIngrediente->setIdProductoElaborado($id_producto_elaborado);
                  $listadoIngredientes = $ProductoIngrediente->obtener_ingredientes_producto();

                    while($filas = $listadoIngredientes->fetch_array()){

                          echo '<tr>
                                  <span class="d-none" id="id_producto_'.$filas['id_producto'].'" >'.$filas['id_producto'].'</span>

                                  <td>'.$filas['descripcion'].' '.$filas['marca'].'</td>
                                  <td>'.$filas['unidad_medida'].'</td>
                                  <td>'.$filas['cantidad'].'</td>
                                  <td><button onclick="eliminarIngrediente('.$filas['id_producto'].','.$id_producto_elaborado.')"  class="col-12 btn btn-danger "> <i class="fa fa-trash-alt"></i> </button>

                                  </td>
                               </tr>';
                            }
                            // DELETE FROM `daemmulc_stock`.`tb_ingredientes_producto_elaborado` WHERE (`id_producto_elaborado` = '64') and (`id_producto_ingrediente` = '3');


                    echo '
                     </tbody>
                  </table>';
 ?>
 <!-- <td><button onclick="agregarIngredienteProducto('.$filas['id_producto'].','.$id_creado.')" class="btn btn-warning btn-block">Agregar</button></td> -->
