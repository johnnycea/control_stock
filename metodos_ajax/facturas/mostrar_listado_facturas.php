<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Facturas.php';


  echo '
  <table class="table bg-white table-sm table-striped table-hover">
     <thead class="thead-dark" align=center>

        <th>N Factura</th>
        <th>Rut proveedor</th>
        <th>Número factura</th>
        <th>Fecha</th>
        <th width=170>Ver</th>
        <th></th>
     </thead>
     <tbody>';

       $Funciones = new Funciones();
       $texto_buscar = $Funciones->limpiarTexto($_REQUEST['texto_buscar']);

       $Facturas = new Facturas();
       $listadoFacturas = $Facturas->obtenerFacturas($texto_buscar," "); //$texto_buscar," where id_estado=1 or id_estado=2 "

         while($filas = $listadoFacturas->fetch_array()){

               echo '<tr>


                       <td><span id="columna_id_factura_'.$filas['id_factura'].'" >'.$filas['id_factura'].'</span></td>
                       <td><span id="columna_rut_proveedor_'.$filas['id_factura'].'" >'.$filas['rut_proveedor'].'</span></td>
                       <td><span id="columna_numero_factura_'.$filas['id_factura'].'" >'.$filas['numero_factura'].'</span></td>
                       <td><span id="columna_fecha_factura_'.$filas['id_factura'].'" >'.$filas['fecha_factura'].'</span></td>
                       <td>
                          <a href="./detalle_facturas.php?id_factura='.$filas['id_factura'].'" class="col-12 btn btn-warning "><i class="far fa-edit"></i></a>
                       </td>
                       <td>
                          <button onclick="eliminarFactura('.$filas['id_factura'].')"  class="col-12 btn btn-danger "> <i class="fa fa-trash-alt"></i> </button>
                       </td>
                    </tr>';
         }

    echo '
     </tbody>
  </table>';
//  <button onclick="cargarInformacionDetalleFactura('.$filas['id_factura'].')" class="col-12 btn btn-warning "> <i class="fa fa-edit"></i> </button>


  // <a href="./modificar_empresa.php?id_empresa='.$filas['id_empresa'].'" class="btn btn-outline-primary">Editar</a>


 ?>
