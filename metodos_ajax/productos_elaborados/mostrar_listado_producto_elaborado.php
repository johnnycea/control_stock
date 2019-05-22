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
                        <div class="card border-primary mb-3 " style="max-width: 18rem;" >
                          <img class="card-img-top" src="./imagenes/productos_elaborados/'.$filas['imagen'].'" alt="Card image cap">
                          <div class="card-body">
                            <h5 class="card-title">'.$filas['descripcion'].'</h5>

                            <button class="btn btn-warning " onclick="cargarModificarProductoElaborado('.$filas['id_producto_elaborado'].')" data-target="#modal_modificar_producto_elaborado" data-toggle="modal">Editar</button>
                            <button class="btn btn-danger "  onclick="eliminarProductoElaborado('.$filas['id_producto_elaborado'].')" >Eliminar</button>

                          </div>
                        </div>
                        ';

                    }


 ?>
