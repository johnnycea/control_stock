<?php
@session_start();
require_once 'comun.php';
require_once './clases/Usuario.php';
require_once './clases/Proveedor.php';
require_once './clases/Facturas.php';
require_once './clases/Marca.php';
require_once './clases/UnidadMedida.php';
require_once './clases/Producto.php';
// require_once './clases/DetalleFacturas.php';
comprobarSession();
$usuario= new Usuario();
$usuario= $usuario->obtenerUsuarioActual();
?>

<!DOCTYPE html>
<html lang="en">
<head>

<style>


</style>
   <title>Facturas</title>
   <?php cargarHead(); ?>

  <script>
      $(document).ready(function(){

        var date_input=$('input[name="txt_fecha_ingreso"]'); //our date input has the name "date"
        var options={
          format: 'dd-mm-yyyy',
          todayHighlight: true,
          autoclose: true,
          language: 'es',
        };
        date_input.datepicker(options);

      })
    </script>
</head>
<body>




<?php


 $id_factura = $_REQUEST['id_factura'];
echo '<script> var id_factura = '.$id_factura.'; </script>';


 $factura_creada = new Facturas();
 $factura_creada->setIdFactura($id_factura);
 $respuesta = $factura_creada->obtenerFactura();

  $filas = $respuesta->fetch_array();

 ?>

      <?php cargarMenuPrincipal(); ?>

      <div class="container contenedor-principal" >


              <div class="container">
                 <div class=" row">
                     <!-- CONTENEDOR FACTURA -->
                     <div class="col-12 col-md-3">
                         <div class="card border-info">

                           <form id="formulario_detalle_factura" class="" action="javascript:guardarFactura()" method="post">

                             <div class="card-body">
                                   <div class="form-group col-12">

                                     <label for="title" class="control-label">Número factura:</label>
                                     <input type="text" required readonly class="form-control" name="txt_numero_factura" id="txt_numero_factura" value="<?php echo $filas['numero_factura']; ?>">
                                   </div>

                                   <div class="form-group col-12">
                                     <label for="title" class="control-label">Fecha de ingreso</label>
                                     <input value="<?php echo $filas['fecha_factura']; ?>" class="form-control" type="text" id="txt_fecha_ingreso" name="txt_fecha_ingreso" readonly placeholder="Dia/Mes/Año" >
                                   </div>

                                   <div class="form-group col-12">
                                     <label for="title" class="control-label">Rut proveedor:</label>

                                       <?php
                                         $Proveedor = new Proveedor();
                                         $Proveedor->setRutProveedor($filas['rut_proveedor']);
                                         $listaProveedor = $Proveedor->obtenerProveedor();

                                         $filas_proveedor = $listaProveedor->fetch_array();

                                         echo '<input type="text" value="'.$filas_proveedor['rut_proveedor'].'" required readonly class="form-control" name="txt_rut_proveedor" id="txt_rut_proveedor" >

                                               <label for="title" class="control-label">Razon Social:</label>
                                               <input type="text" value="'.$filas_proveedor['razon_social'].'" required readonly class="form-control" name="txt_rut_proveedor" id="txt_rut_proveedor" >';
                                       ?>
                                   </div>


                             </div>
                           </form>
                         </div>
                     </div>

                     <!-- CONTENEDOR PODUCTO -->
                     <div class="col-12 col-md-9">
                       <div class="card  border-info ">
                         <form id="formulario_detalle_factura_producto" class="" action="javascript:guardarProductoFactura()" method="post">


                           <div class="card-header bg-dark text-white">
                                 <center>AGREGAR PRODUCTO</center>
                           </div>
                           <div class="card-body">

                               <div class="row">

                                 <input type="hidden" name="txt_id_estado" id="txt_id_estado" value="1">
                                 <input type="hidden" name="txt_id_factura" id="txt_id_factura" value="<?php echo $id_factura; ?>">

                                 <div class="form-group col-md-3">
                                   <label for="title" class="control-label">Codigo Producto:</label>
                                   <input type="number" onkeyup="cargarDatosProducto(this.value);" required class="form-control" name="txt_codigo_producto" id="txt_codigo_producto" value="">
                                 </div>

                                 <div class="form-group col-md-5">
                                   <label for="title" class="control-label">Descripción:</label>
                                   <input type="text" required class="form-control" name="txt_descripcion_producto" id="txt_descripcion_producto" value="">
                                 </div>

                                 <div class="form-group col-md-4">
                                   <label for="title" class="control-label">Unidad medida:</label>
                                   <select required class="form-control" name="select_unidad_medida" id="select_unidad_medida" value="">
                                     <?php
                                     $UnidadMedida = new UnidadMedida();
                                     $listaUnidadMedida = $UnidadMedida->obtenerUnidadesMedida();

                                     while($filas = $listaUnidadMedida->fetch_array()){
                                       echo '<option value="'.$filas['id_unidad_medida'].'">'.$filas['descripcion'].'</option>';
                                     }
                                     ?>
                                   </select>
                                 </div>

                               </div>


                               <div class="row">

                                       <div class="form-group col-md-3">
                                         <label for="title" class="control-label">Marca:</label>
                                         <input type="text"  required class="form-control" name="txt_marca" id="txt_marca" value="">
                                       </div>

                                       <div class="form-group col-md-3">
                                         <label for="title" class="control-label">Stock Minimo:</label>
                                         <input type="number" required class="form-control" name="txt_stock_minimo" id="txt_stock_minimo" value="">
                                       </div>

                                       <div class="form-group col-md-3">
                                         <label for="title" class="control-label">Cantidad:</label>
                                         <input value="" required class="form-control" type="number" id="txt_cantidad" name="txt_cantidad">
                                       </div>

                                       <div class="form-group col-md-3">
                                         <label for="title" class="control-label">Valor Unitario:</label>
                                         <input type="number" required class="form-control" name="txt_valor_unitario" id="txt_valor_unitario" value="">
                                       </div>

                                 </div>

                               <div class="form-group" >
                                 <div class="col-12">
                                   <button class="btn btn-info btn-block" type="submit" name="button">Guardar</button>
                                 </div>

                               </div>

                            </div>


                         </form>
                       </div>
                     </div>
                     <!-- FIN DEL CARD PRODUCTOS -->

                 </div>
               </div>


               <br>
               <!-- CONTENEDOR LISTADO DETALLE FACTURA -->
               <div class="card border-info ">

                     <div class="card-header bg-dark text-white">
                           <center>PRODUCTOS AGREGADOS</center>
                     </div>
                     <div class="card-body">
                               <div class="form-group">
                                    <div id='contenedor_listado_detalle_facturas' class="table-responsive"></div>
                               </div>
                    </div>
               </div>

   </div>




<script type="text/javascript" src="./js/script_facturas.js"></script>
<script type="text/javascript">
  listarDetalleFacturas();
</script>
</body>
</html>
