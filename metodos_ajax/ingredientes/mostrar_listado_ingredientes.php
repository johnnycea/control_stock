<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Producto.php';

              echo '<table class="table table-sm table-hover table-bordered table-dark">
                <thead>
                  <th>Codigo</th>
                  <th>Descripcion</th>
                  <th>Marca</th>
                  <th>U. medida</th>
                  <th>Stock Minimo</th>
                  <th></th>
                  <th></th>
                </thead>
                <tbody>';

                  $Funciones = new Funciones();
                  $texto_buscar = $Funciones->limpiarTexto($_REQUEST['texto_buscar']);
                  // $id_creado = $Funciones->limpiarNumeroEntero($_REQUEST['id_creado']);

                  $ProductoIngrediente = new Producto();
                  $listadoIngredientes = $ProductoIngrediente->obtenerProductos($texto_buscar); //$texto_buscar," where id_estado=1 or id_estado=2 "

                    while($filas = $listadoIngredientes->fetch_array()){

                          echo '<tr>
                                  <td><span id="columna_id_producto_'.$filas['id_producto'].'" >'.$filas['id_producto'].'</span></td>
                                  <td><span id="columna_descripcion_'.$filas['id_producto'].'" >'.$filas['descripcion'].'</span></td>
                                  <td><span id="columna_marca_'.$filas['id_producto'].'" >'.$filas['marca'].'</span></td>

                                    <span class="d-none" id="columna_id_unidad_'.$filas['id_producto'].'" >'.$filas['id_unidad_medida'].'</span>

                                  <td><span id="columna_unidad_'.$filas['id_producto'].'" >'.$filas['unidad_medida'].'</span></td>
                                  <td><span id="columna_stock_minimo'.$filas['id_producto'].'" >'.$filas['stock_minimo'].'</span></td>';


                                //       $editable = ($filas['editable'] == "0") ? "NO" : "SI";
                                // echo '<span class="d-none" id="columna_id_editable_'.$filas['id_producto'].'" >'.$filas['editable'].'</span>
                                //   <td><span id="columna_editable_'.$filas['id_producto'].'" >'.$editable.'</span></td>
                                //   <td><span id="columna_valor_extra_'.$filas['id_producto'].'" >$'.number_format($filas['valor_extra'],0,",",".").'</span></td>';


                            echo '<td><button class="btn btn-warning col-12 " onclick="cargarModificarIngrediente('.$filas['id_producto'].')" data-target="#modal_ingrediente" data-toggle="modal" ><i class="far fa-edit"></i></button></td>
                                  <td><button id="btn_eliminar_'.$filas['id_producto'].'" class="btn btn-danger col-12 " " onclick="eliminarIngrediente('.$filas['id_producto'].')" ><i class="fa fa-trash-alt"></i></button></td>
                               </tr>';
                    }

                    echo '
                     </tbody>
                  </table>';



 ?>
