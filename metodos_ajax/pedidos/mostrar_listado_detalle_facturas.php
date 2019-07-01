<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Facturas.php';
require_once '../../clases/Producto.php';


  echo '
  <table class="table  table-dark table-sm table-striped table-hover">
     <thead class="thead-dark" align=center>

        <th>Codigo</th>
        <th>Descripción</th>
        <th>Marca</th>
        <th>Cantidad</th>
        <th>Unidad medida</th>
        <th>Valor</th>
        <th ></th>
        <th></th>
     </thead>
     <tbody>';

       $Funciones = new Funciones();
       $id_factura = $Funciones->limpiarNumeroEntero($_REQUEST['id_factura']);

       $Facturas = new Facturas();
       $Facturas->setIdFactura($id_factura);
       $listadoDetalleFacturas = $Facturas->vistaDetalleFactura(); //$texto_buscar," where id_estado=1 or id_estado=2 "

         while($filas = $listadoDetalleFacturas->fetch_array()){

               echo '<tr>


                       <td><span id="columna_codigo_'.$filas['codigo'].'" >'.$filas['codigo'].'</span></td>
                       <td><span id="columna_descripcion_'.$filas['codigo'].'" >'.$filas['descripcion'].'</span></td>

                       <span class="d-none" id="columna_txt_stock_minimo_'.$filas['codigo'].'" >'.$filas['stock_minimo'].'</span>
                       <span class="d-none" id="columna_unidad_medida_'.$filas['codigo'].'" >'.$filas['id_unidad_medida'].'</span>

                       <td><span id="columna_marca_'.$filas['codigo'].'" >'.$filas['marca'].'</span></td>

                       <td><span id="columna_cantidad_'.$filas['codigo'].'" >'.$filas['cantidad'].'</span></td>
                       <td><span id="columna_unidad_medida_'.$filas['codigo'].'" >'.$filas['unidad_medida'].'</span></td>
                       <td><span id="columna_valor_'.$filas['codigo'].'" >'.$filas['valor'].'</span></td>
                       <td>
                       <button onclick="cargarInformacionModificarDetalleFactura('.$filas['codigo'].')" class="col-12 btn btn-warning "> <i class="fa fa-edit"></i> </button>
                       </td>
                       <td>
                          <button type="button" onclick="eliminarDetalleFactura('.$filas['codigo'].','.$id_factura.')" class="col-12 btn btn-danger "> <i class="fa fa-trash-alt"></i> </button>
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
