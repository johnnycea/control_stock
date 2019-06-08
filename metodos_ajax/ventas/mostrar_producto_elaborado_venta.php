<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/ProductoElaborado.php';


                  $Funciones = new Funciones();
                  $texto_buscar = $Funciones->limpiarTexto($_REQUEST['texto_buscar']);

                  $ProductoElaborado = new ProductoElaborado();
                  $listadoProductoElaborado = $ProductoElaborado->obtenerProductoElaborado($texto_buscar," "); //$texto_buscar," where id_estado=1 or id_estado=2 "

                    while($filas = $listadoProductoElaborado->fetch_array()){


                        echo '
                        <div class="container col-md-12">
                        <div class="card border-primary mb-3" style="max-width:10rem;" >
                          <img class="card-img-top" src="./imagenes/productos_elaborados/'.$filas['imagen'].'" alt="Card image cap">
                          <div class="card-body">
                            <h5 id="columna_descripcion_'.$filas['id_producto_elaborado'].'" class="card-title">'.$filas['descripcion'].'</h5>
                            <h5 id="columna_valor_'.$filas['id_producto_elaborado'].'" class="card-title">$'.number_format($filas['valor'],0,",",".").'</h5>
                            <br>
                            <button class="btn btn-success" onclick="guardarDetalleVenta('.$filas['id_producto_elaborado'].')">Agregar</button>
                          </div>
                        </div>
                        </div>
                        ';

                    }


 ?>
 <!-- <td>Cantidad<input type="number" id="txt_cantidad_'.$filas['id_producto_elaborado'].'" class="form-control" value="0">'.$filas['cantidad'].'</td> -->
