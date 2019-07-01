<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/UnidadMedida.php';

//
// $Marca = new Marca();
// $listado_marca = $Marca->obtenerMarca();


    echo '
      <table class="table table-dark table-sm table-striped table-bordered table-hover">
       <thead>

           <th>Id</th>
           <th>Descripción</th>
           <th width="100"></th>

       </thead>
       <tbody>';

       $Funciones = new Funciones();
       $texto_buscar = $Funciones->limpiarTexto($_REQUEST['texto_buscar']);

       $Unidad_Medida = new UnidadMedida();
       $listadoUnidadMedida = $Unidad_Medida->obtenerUnidadesMedida($texto_buscar); //$texto_buscar," where id_estado=1 or id_estado=2 "

         while($filas = $listadoUnidadMedida->fetch_array()){

               echo '<tr>


                       <td><span id="columna_id_unidad_'.$filas['id_unidad_medida'].'" >'.$filas['id_unidad_medida'].'</span></td>

                       <td><span id="columna_descripcion_'.$filas['id_unidad_medida'].'" >'.$filas['descripcion'].'</span></td>
                       <td>
                          <div class="container">
                          <div class="row">
                            <button onclick="cargarInformacionModificarUnidad('.$filas['id_unidad_medida'].')" data-target="#modal_unidad" data-toggle="modal" class=" col-6 btn btn-warning "> <i class="fa fa-edit"></i> </button>

                            <button onclick="eliminarUnidad_medida('.$filas['id_unidad_medida'].')"  class="col-6 btn btn-danger "> <i class="fa fa-trash-alt"></i> </button>
                          </div>
                          </div>

                       </td>

                    </tr>';
         }

    echo '
     </tbody>
  </table>';

  // <a href="./modificar_empresa.php?id_empresa='.$filas['id_empresa'].'" class="btn btn-outline-primary">Editar</a>
// <td><span id="columna_id_marca_'.$filas['id_marca'].'" >'.$filas['id_marca'].'</span></td>

 ?>
