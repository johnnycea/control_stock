<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Facturas.php';
require_once '../../clases/Producto.php';


  echo '
  <table class="table table-responsive table-sm table-striped table-hover">
     <thead class="thead-dark" align=center>

        <th>Codigo Producto</th>
        <th>Descripción</th>
        <th>Marca</th>
        <th>Categoria</th>
        <th>Cantidad</th>
        <th>Valor</th>
        <th width=170>Ver</th>
        <th></th>
     </thead>
     <tbody>';

       $Funciones = new Funciones();
       $id_factura = $Funciones->limpiarNumeroEntero($_REQUEST['id_factura']);

       $Facturas = new Facturas();
       $Facturas->setIdFactura($id_factura);
       $listadoFacturas = $Facturas->vistaDetalleFactura(); //$texto_buscar," where id_estado=1 or id_estado=2 "

         while($filas = $listadoFacturas->fetch_array()){

               echo '<tr>


                       <td><span id="columna_id_factura_'.$filas['id_producto'].'" >'.$filas['id_producto'].'</span></td>
                       <td><span id="columna_rut_proveedor_'.$filas['descripcion'].'" >'.$filas['descripcion'].'</span></td>
                       <td><span id="columna_numero_factura_'.$filas['nombre_marca'].'" >'.$filas['nombre_marca'].'</span></td>
                       <td><span id="columna_fecha_factura_'.$filas['cantidad'].'" >'.$filas['cantidad'].'</span></td>
                       <td><span id="columna_fecha_factura_'.$filas['valor'].'" >'.$filas['valor'].'</span></td>
                       <td>
                          <a href="./detalle_facturas.php?id_factura='.$filas['id_factura'].'" class="col-12 btn btn-warning ">Editar</a>
                       </td>
                       <td>
                          <button onclick="eliminarFactura('.$filas['id_factura'].')"  class="col-12 btn btn-danger "> <i class="fa fa-trash-alt"></i> </button>
                       </td>
                    </tr>';
         }

    echo '
     </tbody>
  </table>';
  // ENVIA LOS DATOS AL SCRIPT CORRESPONDIENTE
//  <button onclick="cargarInformacionDetalleFactura('.$filas['id_factura'].')" class="col-12 btn btn-warning "> <i class="fa fa-edit"></i> </button>

  // REDIRECCIONA
  // <a href="./modificar_empresa.php?id_empresa='.$filas['id_empresa'].'" class="btn btn-outline-primary">Editar</a>


 ?>
