<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Facturas.php';


  echo '
  <table class="table table-dark table-sm table-striped table-hover">
     <thead class="" align=center>


        <th>Factura</th>
        <th>Fecha</th>
        <th>Proveedor</th>
        <th>R.Social</th>
        <th>Direccion</th>
        <th>Telefono</th>
        <th>Total</th>
        <th></th>
        <th></th>
        <th></th>
     </thead>
     <tbody>';

       $Funciones = new Funciones();
       $texto_buscar = $Funciones->limpiarTexto($_REQUEST['texto_buscar']);

       $Facturas = new Facturas();
       $listadoFacturas = $Facturas->obtenerFacturas($texto_buscar," "); //$texto_buscar," where id_estado=1 or id_estado=2 "

         while($filas = $listadoFacturas->fetch_array()){

               echo '<tr>


                       <span class="d-none" id="columna_id_factura_'.$filas['id_factura'].'" >'.$filas['id_factura'].'</span>

                       <td><span id="columna_numero_factura_'.$filas['id_factura'].'" >'.$filas['numero_factura'].'</span></td>
                       <td><span id="columna_fecha_factura_'.$filas['id_factura'].'" >'.$filas['fecha_factura'].'</span></td>
                       <td><span id="columna_rut_proveedor_'.$filas['id_factura'].'" >'.$filas['rut_proveedor'].'-'.$filas['dv'].'</span></td>
                       <td><span id="columna_razon_social_'.$filas['id_factura'].'" >'.$filas['razon_social'].'</span></td>
                       <td><span id="columna_direccion_'.$filas['id_factura'].'" >'.$filas['direccion'].'</span></td>
                       <td><span id="columna_telefono_'.$filas['id_factura'].'" >'.$filas['telefono'].'</span></td>
                       <td><span id="columna_total_factura_'.$filas['id_factura'].'" >$'.number_format($filas['total_factura'],0,",",".").'</span></td>

                       <td>
                          <button onclick="cargarInformacionFactura('.$filas['id_factura'].')" data-target="#modal_factura" data-toggle="modal"  class="col-12 btn btn-warning "> <i class="far fa-edit"></i> </button>
                       </td>

                       <td>
                       <a href="./detalle_facturas.php?id_factura='.$filas['id_factura'].'" class="col-12 btn btn-info "><i class="fas fa-list"></i></a>
                       </td>

                       <td>
                          <button onclick="eliminarFactura('.$filas['id_factura'].')"  class="col-12 btn btn-danger "> <i class="fa fa-trash-alt"></i> </button>
                       </td>
                    </tr>';
         }

    echo '
     </tbody>
  </table>';


 ?>
