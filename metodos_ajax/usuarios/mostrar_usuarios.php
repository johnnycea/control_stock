<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Usuario.php';

$Usuario = new Usuario();
$listado_usuarios = $Usuario->listarUsuariosActivosInactivos();


    echo '
    <table class="table table-dark table-sm table-striped table-bordered table-hover">
       <thead>
           <!-- <th>Run</th> -->
           <th>Nombre</th>
           <th>Estado</th>
           <th>Tipo Usuario</th>
           <th>Correo</th>
           <th>Opciones</th>
       </thead>
       <tbody>';

          $contador = 1;
          while($filas = $listado_usuarios->fetch_array()){

           $clase="";
           if($filas['estado']==2){
             $clase="table-warning";
           }

           echo '<tr class="'.$clase.'">
                   <!-- <td>18273352-0</td> -->
                   <span class="d-none" id="txt_rut_'.$contador.'" >'.$filas['rut'].'</span>
                   <span class="d-none" id="txt_dv_'.$contador.'" >'.$filas['digito_verificador'].'</span>

                   <td class=""><span id="txt_nombre_'.$contador.'" >'.$filas['nombre'].'</span></td>
                   <td class=""><span                               >'.$filas['descripcion_estado'].'</span></td>
                   <td class=""><span                               >'.$filas['descripcion_tipo_usuario'].'</span></td>
                   <td class=""><span id="txt_correo_'.$contador.'" >'.$filas['correo'].'</span></td>

                   <span class="d-none" id="txt_estado_'.$contador.'" >'.$filas['estado'].'</span>
                   <span class="d-none" id="txt_privilegio_'.$contador.'" >'.$filas['tipo_usuario'].'</span>
                   <td class="">
                      <button onclick="cargarDatosModificar('.$contador.');" data-toggle="modal" data-target="#modal_usuario" type="button" class="btn btn-block btn-warning" name="button">Editar</button>
                      <button onclick="eliminarUsuario('.$filas['rut'].')" type="button" class="btn btn-block btn-danger" name="button">Eliminar</button>
                   </td>
                 </tr>';

            $contador++;

         }

       echo '</tbody>
    </table>';

 ?>
