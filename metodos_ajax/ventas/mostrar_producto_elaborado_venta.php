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

                        <div class="card border-primary col-2" style="padding:0px; margin-left:5px;" >
                      <!--    <img class="" id="imagen_producto_'.$filas['id_producto_elaborado'].'" src="./imagenes/productos_elaborados/'.$filas['imagen'].'" alt="Card image cap"> -->

<div  id="imagen_producto_'.$filas['id_producto_elaborado'].'">

    <div  style="align:bottom; background-color: rgba(0, 0, 0, 0.79); >
        <h5 id="columna_descripcion_'.$filas['id_producto_elaborado'].'" class="card-title text-white">'.$filas['descripcion'].'</h5>
        <h5  class="card-title text-white"> <span id="columna_valor_'.$filas['id_producto_elaborado'].'"> '.$filas['valor'].'</span></h5>
    </div>

</div>

                          <div class="card-body" >

                          <td>
                             Cantidad
                             <div class="row">
                                <input type="number" min="1" id="txt_cantidad_'.$filas['id_producto_elaborado'].'" class="form-control col-6" value="1">
                                <button style="background-color:rgb(122, 77, 51); color:white;" type="button" class="btn btn-warning col-6" onclick="guardarDetalleVenta('.$filas['id_producto_elaborado'].','.$filas['valor'].')">Agregar</button>
                              </div>
                          </td>

                          </div>
                        </div>

                        ';

                    }
echo '</div>';


 ?>
 <!-- <td>Valor Unitario<input type="number" id="txt_valor_unitario_'.$filas['id_producto_elaborado'].'" class="form-control" value="0"></td> -->
 <!-- <h5 id="columna_valor_'.$filas['id_producto_elaborado'].'" class="card-title">$'.number_format($filas['valor'],0,",",".").'</h5> -->