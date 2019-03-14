<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Proveedor.php';


  echo '
  <table class="table table-responsive table-sm table-striped table-hover">
     <thead class="thead-dark">
        <th></th>
        <th></th>
        <th>Rut</th>
        <th>Razón Social</th>
        <th>Dirección</th>
        <th>Teléfono</th>
        <th>Giro</th>
        <th>Correo</th>
     </thead>
     <tbody>';

       $Funciones = new Funciones();
       $texto_buscar = $Funciones->limpiarTexto($_REQUEST['texto_buscar']);

       $Proveedor = new Proveedor();
       $listadoProveedor = $Proveedor->obtenerProveedores($texto_buscar," "); //$texto_buscar," where id_estado=1 or id_estado=2 "

         while($filas = $listadoProveedor->fetch_array()){

               echo '<tr>

                       <td>
                             <button onclick="cargarInformacionModificarProveedor('.$filas['rut_proveedor'].')" data-target="#modal_proveedor" data-toggle="modal" class="col-12 btn btn-warning "> <i class="fa fa-edit"></i> </button>
                       </td>
                       <td>
                             <button onclick="eliminarProveedor('.$filas['rut_proveedor'].')"  class="col-12 btn btn-danger "> <i class="fa fa-trash-alt"></i> </button>
                       </td>
                       <td><span id="columna_rut_proveedor_'.$filas['rut_proveedor'].'" >'.$filas['rut_proveedor'].'-'.$filas['dv'].'</span></td>
                       <td><span id="columna_razon_social_'.$filas['rut_proveedor'].'" >'.$filas['razon_social'].'</span></td>
                       <td><span id="columna_telefono_'.$filas['rut_proveedor'].'" >'.$filas['telefono'].'</span></td>
                       <td><span id="columna_direccion_'.$filas['rut_proveedor'].'" >'.$filas['direccion'].'</span></td>
                       <td><span id="columna_giro_'.$filas['rut_proveedor'].'" >'.$filas['giro'].'</span></td>
                       <td><span id="columna_correo_'.$filas['rut_proveedor'].'" >'.$filas['correo'].'</span></td>

                    </tr>';
         }

    echo '
     </tbody>
  </table>';

  // <a href="./modificar_empresa.php?id_empresa='.$filas['id_empresa'].'" class="btn btn-outline-primary">Editar</a>


 ?>
