<?php
require_once '../../clases/Funciones.php';
require_once '../../clases/ProductoElaborado.php';


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

                        <div class="card border-primary col-5 col-md-2" style="padding:0px; margin-left:5px; margin-top:5px;" >

                              <div  id="imagen_producto_'.$filas['id_producto_elaborado'].'">
                                  <div  style="align:bottom; background-color: rgba(0, 0, 0, 0.79); >

                                      <h5 id="columna_descripcion_'.$filas['id_producto_elaborado'].'" class="card-title text-white">'.$filas['descripcion'].'</h5>
                                      <span id="columna_nombre_'.$filas['id_producto_elaborado'].'" class="d-none">'.$filas['descripcion'].'</span>
                                      <h5  class="card-title text-white"> <span >$'.number_format($filas['valor'],0,",",".").'</span></h5>


                                        <span class="d-none" id="columna_valor_'.$filas['id_producto_elaborado'].'">'.$filas['valor'].'</span></h5>
                                        <h5 class="d-none" id="columna_estado_'.$filas['id_producto_elaborado'].'" class="card-title">'.$filas['estado_producto'].'</h5>
                                  </div>
                              </div>

                              <div class="card-body" >
                                     <div class="row">
                                     <button class="btn btn-warning col-6" onclick="cargarModificarProductoElaborado('.$filas['id_producto_elaborado'].')" data-target="#modal_nuevo_producto_elaborado" data-toggle="modal"  color:white;" ><i class="far fa-edit"></i></button>
                                     <button class="btn btn-danger col-6"  style="font-size:15px; " onclick="eliminarProductoElaborado('.$filas['id_producto_elaborado'].')" ><i class="fa fa-trash-alt"></i></button>

                                      </div>
                              </div>

                        </div>

                        ';

                    }


 ?>
