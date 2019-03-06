<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Subvencion.php';


$Subvencion = new Subvencion();
$listado_subvencion = $Subvencion->obtenerSubvencion();


    echo '
    <table class="table table-responsive table-sm table-striped table-bordered table-hover">
       <thead>
           <th>Id</th>
           <th>Subvencion</th>
           <th></th>
           <th></th>
       </thead>
       <tbody>';

          $contador = 1;
          while($filas = $listado_subvencion->fetch_array()){


           echo '<tr class="">
                   <td class=""><span id="txt_id_subvencion_'.$contador.'" >'.$filas['id_subvencion'].'</span></td>
                   <td class=""><span id="txt_subvencion_'.$contador.'" >'.$filas['subvencion'].'</span></td>

                   <td class="">
                      <button onclick="cargarDatosModificar('.$contador.');" data-toggle="modal" data-target="#modal_subvencion" type="button" class="btn btn-block btn-warning" name="button">Editar</button>
                   </td>
                   <td class="">
                      <button onclick="eliminarSubvencion('.$filas['id_subvencion'].')" type="button" class="btn btn-block btn-danger" name="button">Eliminar</button>
                   </td>
                 </tr>';

            $contador++;

         }

       echo '</tbody>
    </table>';

 ?>
