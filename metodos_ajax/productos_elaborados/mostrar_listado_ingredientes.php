<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Producto.php';
        // ANTES
        // Muestra los ingredientes para ser seleccionados al producto final

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
                  $texto_buscar = $Funciones->limpiarTexto($_REQUEST['texto_buscar']);
                  $id_creado = $Funciones->limpiarNumeroEntero($_REQUEST['id_creado']);

                  $ProductoIngrediente = new Producto();
                  $listadoIngredientes = $ProductoIngrediente->obtenerProductosParaIngredientes($texto_buscar); //$texto_buscar," where id_estado=1 or id_estado=2 "

                    while($filas = $listadoIngredientes->fetch_array()){

                          echo '<tr>
                                  <td><span id="_'.$filas['id_producto'].'" >'.$filas['id_producto'].'</span></td>
                                  <td>'.$filas['descripcion'].'</td>
                                  <td>'.$filas['unidad_medida'].'</td>
                                  <td><input type="number" id="txt_ingrediente_'.$filas['id_producto'].'" class="form-control" value="0"  ></td>
                                  <td><button onclick="agregarIngredienteProducto('.$filas['id_producto'].','.$id_creado.')" class="btn btn-warning btn-block">Agregar</button></td>
                               </tr>';
                    }

                    echo '
                     </tbody>
                  </table>';



 ?>
