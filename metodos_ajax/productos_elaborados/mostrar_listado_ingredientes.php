<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Producto.php';
        // ANTES
        // Muestra los ingredientes para ser seleccionados al producto final

              echo '<table class="table table-bordered table-dark table-sm ">
                <thead class="thead-dark">

                  <th>Nombre</th>
                  <th>U.Medida</th>
                  <th>Cantidad</th>
                  <th>Editable</th>
                  <th>Valor.extra</th>
                  <th></th>
                </thead>
                <tbody>';

                  $Funciones = new Funciones();
                  $texto_buscar = $Funciones->limpiarTexto($_REQUEST['texto_buscar']);
                  $id_creado = $Funciones->limpiarNumeroEntero($_REQUEST['id_creado']);

                  $ProductoIngrediente = new Producto();
                  $listadoIngredientes = $ProductoIngrediente->obtenerProductosParaIngredientes($texto_buscar); //$texto_buscar," where id_estado=1 or id_estado=2 "

                    while($filas = $listadoIngredientes->fetch_array()){

                          echo '<tr>
                                   <span class="d-none" id="_'.$filas['id_producto'].'" >'.$filas['id_producto'].'</span>

                                  <td>'.$filas['descripcion'].' '.$filas['marca'].'</td>
                                  <td>'.$filas['unidad_medida'].'</td>
                                  <td><input type="number" id="txt_ingrediente_'.$filas['id_producto'].'" class="form-control" value="0"  ></td>
                                  <td>
                                         <select class="form-control " id="select_editable_'.$filas['id_producto'].'">
                                            <option value="0">No</option>
                                            <option value="1">Si</option>
                                         </select>
                                  </td>
                                  <td><input type="number" id="txt_valor_extra_'.$filas['id_producto'].'" class="form-control" value="0" > </td>
                                  <td><input type="button" onclick="agregarIngredienteProducto('.$filas['id_producto'].','.$id_creado.')" class="btn btn-warning btn-block" value="Agregar"></td>
                               </tr>';
                    }

                    echo '
                     </tbody>
                  </table>';



 ?>
