<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Categoria.php';

//
// $Marca = new Marca();
// $listado_marca = $Marca->obtenerMarca();


    echo '
    <table class="table table-responsive table-sm table-striped table-bordered table-hover">
       <thead>
           <th></th>
           <th></th>
           <th>Id</th>
           <th>Categoría</th>

       </thead>
       <tbody>';

       $Funciones = new Funciones();
       $texto_buscar = $Funciones->limpiarTexto($_REQUEST['texto_buscar']);

       $Categoria = new Categoria();
       $listadoCategorias = $Categoria->obtenerCategorias($texto_buscar," "); //$texto_buscar," where id_estado=1 or id_estado=2 "

         while($filas = $listadoCategorias->fetch_array()){

               echo '<tr>

                       <td>
                             <button onclick="cargarInformacionModificarCategoria('.$filas['id_categoria'].')" data-target="#modal_categoria" data-toggle="modal" class="col-12 btn btn-warning "> <i class="fa fa-edit"></i> </button>
                       </td>
                       <td>
                             <button onclick="eliminarCategoria('.$filas['id_categoria'].')"  class="col-12 btn btn-danger "> <i class="fa fa-trash-alt"></i> </button>
                       </td>
                       <td><span id="columna_id_categoria_'.$filas['id_categoria'].'" >'.$filas['id_categoria'].'</span></td>

                       <td><span id="columna_descripcion_categoria_'.$filas['id_categoria'].'" >'.$filas['descripcion_categoria'].'</span></td>

                    </tr>';
         }

    echo '
     </tbody>
  </table>';

  // <a href="./modificar_empresa.php?id_empresa='.$filas['id_empresa'].'" class="btn btn-outline-primary">Editar</a>
// <td><span id="columna_id_marca_'.$filas['id_marca'].'" >'.$filas['id_marca'].'</span></td>

 ?>
