<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/ProductoElaborado.php';

// DESPUES
// Muestra los ingredientes seleccionados al producto final

              echo '<table class="table table-bordered table-info">
                <thead>
                  <th>Codigo</th>
                  <th>Descripcion</th>
                  <th>Valor</th>
                  <th>Estado</th>
                  <th></th>
                  <th></th>
                </thead>
                <tbody>';

                  $Funciones = new Funciones();
                  $texto_buscar = $Funciones->limpiarTexto($_REQUEST['texto_buscar']);

                  $ProductoElaborado = new ProductoElaborado();
                  $listadoProductoElaborado = $ProductoElaborado->obtenerProductoElaborado($texto_buscar," "); //$texto_buscar," where id_estado=1 or id_estado=2 "

                    while($filas = $listadoProductoElaborado->fetch_array()){

                          echo '<tr>
                                  <td><span id="columna_id_producto_elaborado_'.$filas['id_producto_elaborado'].'" >'.$filas['id_producto_elaborado'].'</span></td>
                                  <td><span id="columna_descripcion_'.$filas['id_producto_elaborado'].'" >'.$filas['descripcion'].'</span></td>
                                  <td><span id="columna_valor_'.$filas['id_producto_elaborado'].'" >'.$filas['valor'].'</span></td>
                                  <td><span id="columna_estado_'.$filas['id_producto_elaborado'].'" >'.$filas['estado_producto'].'</span></td>
                                  <td>
                                        <button onclick="cargarModificarProductoElaborado('.$filas['id_producto_elaborado'].')" data-target="#modal_modificar_producto_elaborado" data-toggle="modal" class="col-12 btn btn-warning "> <i class="fa fa-edit"></i> </button>
                                  </td>
                                  <td>
                                        <button onclick="eliminarProductoElaborado('.$filas['id_producto_elaborado'].')"  class="col-12 btn btn-danger "> <i class="fa fa-trash-alt"></i> </button>
                                  </td>
                               </tr>';
                    }

                    echo '
                     </tbody>
                  </table>';

  // <a href="./modificar_empresa.php?id_empresa='.$filas['id_empresa'].'" class="btn btn-outline-primary">Editar</a>


 ?>
