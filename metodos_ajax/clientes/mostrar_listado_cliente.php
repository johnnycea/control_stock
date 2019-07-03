<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Cliente.php';

              echo '
              <table class="table table-dark table-sm table-striped table-bordered table-hover">
                <thead>
                  <th>Rut</th>
                  <th>Dv</th>
                  <th>Nombre</th>
                  <th>Apellidos</th>
                  <th>Calle</th>
                  <th>Número calle</th>
                  <th>Observación</th>
                  <th>Teléfono</th>
                  <th></th>
                </thead>
                <tbody>';

                  $Funciones = new Funciones();
                  $texto_buscar = $Funciones->limpiarTexto($_REQUEST['texto_buscar']);
                  // $id_creado = $Funciones->limpiarNumeroEntero($_REQUEST['id_creado']);

                  $Clientes = new Cliente();
                  $listadoCliente = $Clientes->obtenerClientes($texto_buscar); //$texto_buscar," where id_estado=1 or id_estado=2 "

                    while($filas = $listadoCliente->fetch_array()){

                          echo '<tr>
                                  <td><span id="txt_rut_'.$filas['rut_cliente'].'" >'.$filas['rut_cliente'].'</span></td>
                                  <td><span id="txt_dv_'.$filas['rut_cliente'].'" >'.$filas['dv'].'</span></td>
                                  <td><span id="txt_nombre_'.$filas['rut_cliente'].'" >'.$filas['nombre'].'</span></td>
                                  <td><span id="txt_apellidos_'.$filas['rut_cliente'].'" >'.$filas['apellidos'].'</span></td>
                                  <td><span id="txt_calle_'.$filas['rut_cliente'].'" >'.$filas['calle'].'</span></td>
                                  <td><span id="txt_numero_calle_'.$filas['rut_cliente'].'" >'.$filas['numero_calle'].'</span></td>
                                  <td><span id="txt_observacion_'.$filas['rut_cliente'].'" >'.$filas['observacion_direccion'].'</span></td>
                                  <td><span id="txt_telefono_'.$filas['rut_cliente'].'" >'.$filas['telefono'].'</span></td>

                                  <td><button class="btn btn-warning btn-block" onclick="cargarInformacionClientes('.$filas['rut_cliente'].')" data-target="#modal_cliente" data-toggle="modal"  ><i class="far fa-edit"></i></button></td>
                                  <td><button class="btn btn-danger btn-block" onclick="eliminarCliente('.$filas['rut_cliente'].')" ><i class="fa fa-trash-alt"></i></button></td>
                               </tr>';
                    }

                    echo '
                     </tbody>
                  </table>';



 ?>
