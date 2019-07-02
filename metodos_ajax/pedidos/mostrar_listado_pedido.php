<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Venta.php';


  echo '
  <table class="table table-dark table-sm table-striped table-hover">
     <thead class="" align=center>

        <th>Venta</th>
        <th>Fecha</th>
        <th>Nombre cliente</th>
        <th>Dirección</th>
        <th>Observación</th>
        <th>Descripción estado</th>
        <th>Ver</th>
        <th>Eliminar</th>
     </thead>
     <tbody>';

       $Funciones = new Funciones();
       $texto_buscar = $Funciones->limpiarTexto($_REQUEST['texto_buscar']);

       $Venta = new Venta();
       $listadoVentas = $Venta->listadoPedidos($texto_buscar); //$texto_buscar," where id_estado=1 or id_estado=2 "

         while($filas = $listadoVentas->fetch_array()){

               echo '<tr>



                       <td><span id="columna_id_venta_'.$filas['venta'].'" >'.$filas['venta'].'</span></td>
                       <td><span id="columna_fecha_'.$filas['venta'].'" >'.$filas['fecha'].'</span></td>
                       <td><span id="columna_rut_'.$filas['venta'].'" >'.$filas['rut'].'</span></td>
                       <td><span id="columna_nombre_'.$filas['venta'].'" >'.$filas['nombre_cliente'].'</span></td>
                       <td><span id="columna_direccion_'.$filas['venta'].'" >'.$filas['direccion_cliente'].'</span></td>
                       <td><span id="columna_observacion_'.$filas['venta'].'" >'.$filas['observacion_direccion'].'</span></td>
                       <span class="d-none" id="columna_id_estado_'.$filas['venta'].'" >'.$filas['estado'].'</span>
                       <td><span id="columna_descripcion_'.$filas['venta'].'" >'.$filas['descripcion_estado'].'</span></td>

                       <td>
                          <button onclick="cargarInformacion('.$filas['venta'].')" data-target="#modal_pedido" data-toggle="modal"  class="col-12 btn btn-warning "> <i class="far fa-edit"></i> </button>
                       </td>


                    </tr>';
         }

    echo '
     </tbody>
  </table>';


 ?>
