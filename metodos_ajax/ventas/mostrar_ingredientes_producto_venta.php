<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/ProductoElaborado.php';


@session_start();

$Funciones = new Funciones();
$id_producto_elaborado = $Funciones->limpiarNumeroEntero($_REQUEST['id_producto_elaborado']);

$array_listado_ingredientes_producto = $_SESSION['listado_ingredientes_productos'];


              echo '<table class="table table-bordered  table-dark table-sm">
                <thead class="thead-dark">

                  <th>Nombre</th>
                  <th>U. Med</th>
                  <th>Cantidad</th>
                  <th></th>
                  <th></th>
                </thead>
                <tbody>';




                //comprobar si ya se recibieron los ingredientes del para el id_producto_elaborado recibido
                $contador = 0;
                $ingredientes_ya_listados=false;

                 foreach($array_listado_ingredientes_producto as $ingrediente){
                   $contador++;

                       if($ingrediente['id_producto_elaborado']==$id_producto_elaborado){
                         $ingredientes_ya_listados=true;
                          break;
                       }
                 }

                 if($ingredientes_ya_listados==false){///pregunta si ya estaba listado en el array

                   echo "CARGA DESDE BD";

                       $ProductoIngrediente = new ProductoElaborado();
                       $ProductoIngrediente->setIdProductoElaborado($id_producto_elaborado);
                       $listadoIngredientes = $ProductoIngrediente->obtener_ingredientes_producto();

                       while($filas = $listadoIngredientes->fetch_assoc()){

                         $array_listado_ingredientes_producto[] = $filas;
                       }


                }else{
                  echo "CARGA DESDE ARRAY EN SESSION";
                }


                   //LISTA LOS INGREDIENTES, ALMACENADOS EN EL ARRAY
                  foreach($array_listado_ingredientes_producto as $ingrediente){

                    if($ingrediente['id_producto_elaborado']==$id_producto_elaborado){

                        echo '
                          <span class="d-none" id="id_producto_'.$ingrediente['id_producto'].'" >'.$ingrediente['id_producto'].'</span>

                        <tr>
                          <td>'.$ingrediente['id_producto_elaborado']."  ".$ingrediente['descripcion'].' '.$ingrediente['marca'].'</td>
                          <td>'.$ingrediente['unidad_medida'].'</td>
                          <td>'.$ingrediente['cantidad'].'</td>
                          <td><button type="button" onclick="modificarCantidadIngrediente(1,'.$ingrediente['id_producto'].','.$id_producto_elaborado.')"  class="col-12 btn btn-warning "> <i class="fa fa-plus"></i> </button></td>
                          <td><button type="button" onclick="modificarCantidadIngrediente(2,'.$ingrediente['id_producto'].','.$id_producto_elaborado.')"  class="col-12 btn btn-danger "><i class="fas fa-minus"></i> </button></td>
                        </tr>';
                    }


                  }


                    echo '
                     </tbody>
                  </table>';

      $_SESSION['listado_ingredientes_productos'] = $array_listado_ingredientes_producto;
 ?>
