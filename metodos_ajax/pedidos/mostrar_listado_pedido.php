<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Pedido.php';


  echo '
  <table class="table table-dark table-sm table-striped table-hover">
     <thead class="" align=center>

        <th>Número pedido</th>
        <th>Número venta</th>
        <th>Fecha</th>
        <th>Nombre cliente</th>
        <th>Dirección</th>
        <th>Observación</th>
        <th>Descripción estado</th>
        <th></th>
        <th></th>
     </thead>
     <tbody>';

       $Funciones = new Funciones();
       $texto_buscar = $Funciones->limpiarTexto($_REQUEST['texto_buscar']);

       $Pedido = new Pedido();
       $listadoPedidos = $Pedido->obtenerPedidos($texto_buscar); //$texto_buscar," where id_estado=1 or id_estado=2 "

         while($filas = $listadoPedidos->fetch_array()){

               echo '<tr>


                       <td><span class="d-none" id="columna_id_pedido_'.$filas['pedido'].'" >'.$filas['pedido'].'</span></td>
                       <td><span id="columna_id_venta_'.$filas['pedido'].'" >'.$filas['venta'].'</span></td>
                       <td><span id="columna_fecha_'.$filas['pedido'].'" >'.$filas['fecha'].'</span></td>
                       <td><span id="columna_nombre_'.$filas['pedido'].'" >'.$filas['nombre_cliente'].'</span></td>
                       <td><span id="columna_rut_direccion_'.$filas['pedido'].'" >'.$filas['direccion_cliente'].'</span></td>
                       <td><span id="columna_observacion_'.$filas['pedido'].'" >'.$filas['observacion_direccion'].'</span></td>
                       <span class="d-none" id="columna_id_estado_'.$filas['pedido'].'" >'.$filas['estado'].'</span>
                       <td><span id="columna_descripcion_'.$filas['pedido'].'" >'.$filas['descripcion_estado'].'</span></td>

                       <td>
                          <button onclick="cargarInformacionFactura('.$filas['pedido'].')" data-target="#modal_factura" data-toggle="modal"  class="col-12 btn btn-warning "> <i class="far fa-edit"></i> </button>
                       </td>


                    </tr>';
         }

    echo '
     </tbody>
  </table>';


 ?>
