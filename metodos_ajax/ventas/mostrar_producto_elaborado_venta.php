<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/ProductoElaborado.php';
require_once '../../clases/Ventas.php';



echo '<div class="row">';

                  $Funciones = new Funciones();
                  $texto_buscar = $Funciones->limpiarTexto($_REQUEST['texto_buscar']);

                  $ProductoElaborado = new ProductoElaborado();
                  $listadoProductoElaborado = $ProductoElaborado->obtenerProductoElaborado($texto_buscar," "); //$texto_buscar," where id_estado=1 or id_estado=2 "

                    while($filas = $listadoProductoElaborado->fetch_array()){


                        echo '

                        <style>

                           #imagen_producto_'.$filas['id_producto_elaborado'].'{
                           width: 100%;
                           height: 150px;
                           background-image: url("./imagenes/productos_elaborados/'.$filas['imagen'].'");
                           background-repeat: no-repeat;
                           background-size: cover;
                           }

                        </style>

                        <div class="card border-primary col-5 col-md-3" style="padding:0px; margin-left:5px; margin-top:5px;" >

                              <div  id="imagen_producto_'.$filas['id_producto_elaborado'].'">
                                  <div  style="align:bottom; background-color: rgba(0, 0, 0, 0.79); >
                                      <h5 id="columna_descripcion_'.$filas['id_producto_elaborado'].'" class="card-title text-white">'.$filas['descripcion'].'</h5>
                                      <h5  class="card-title text-white"> <span id="columna_valor_'.$filas['id_producto_elaborado'].'">$'.number_format($filas['valor'],0,",",".").'</span></h5>
                                  </div>
                              </div>

                              <div class="card-body" >
                                     Cantidad
                                     <div class="row">
                                        <input type="number" min="1" id="txt_cantidad_'.$filas['id_producto_elaborado'].'" class="form-control col-4" value="1">
                                        <button id="btn_agregar_'.$filas['id_producto_elaborado'].'" style="background-color:#0d7073; color:white;" type="button" class="btn btn-warning col-7" onclick="guardarDetalleVenta('.$filas['id_producto_elaborado'].','.$filas['valor'].')"> Agregar</button>
                                      </div>
                              </div>

                        </div>

                        ';

                    }
echo '</div>';


 ?>
 <!-- <td>Valor Unitario<input type="number" id="txt_valor_unitario_'.$filas['id_producto_elaborado'].'" class="form-control" value="0"></td> -->
 <!-- <h5 id="columna_valor_'.$filas['id_producto_elaborado'].'" class="card-title">$'.number_format($filas['valor'],0,",",".").'</h5> -->
