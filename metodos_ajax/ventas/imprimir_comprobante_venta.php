<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Ventas.php';
require_once '../../clases/Cliente.php';
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Boucher</title>
</head>
<body>

<?php

  $rut_cliente = $_REQUEST['rut_cliente'];
  $nombre = $_REQUEST['nombre'];
  $apellidos = $_REQUEST['apellidos'];
  $calle = $_REQUEST['calle'];
  $numero = $_REQUEST['numero'];
  $observacion = $_REQUEST['observacion'];
  $telefono = $_REQUEST['telefono'];

  $id_venta = $_REQUEST['id_venta'];


?>


  <h1>Comprobante Pedido <?php echo $id_venta; ?></h1>

  <p>----------------------------</p>
  <h1>Cliente</h1>
  <label for="">Rut Cliente: </label>
  <label for=""><?php echo $rut_cliente; ?> </label>
  <br>
  <label for="">Nombre: </label>
  <label for=""><?php echo $nombre; ?> </label>
  <label for=""><?php echo $apellidos; ?> </label>
  <br>
  <label for="">Teléfono: </label>
  <label for=""><?php echo $telefono; ?> </label>
  <br>
  <label for="">Dirección: </label>
  <label for=""><?php echo $calle; ?> </label>
  <label for=""><?php echo $numero; ?> </label>
  <br>
  <label for="">Observación del hogar: </label>
  <label for=""><?php echo $observacion; ?> </label>


  <!-- <div id="contenedor_listado_cliente"></div> -->
  <div id="contenedor_listado_venta"></div>


</body>
<script type="text/javascript" src="../../js/jquery-3.1.0.min.js"></script>

<script type="text/javascript">

function listaVentaComprobante(venta){
// alert(venta);
		$.ajax({
			url:"../../metodos_ajax/ventas/detalle_venta_comprobante.php?id_venta="+venta,
			method:"POST",
			success:function(respuesta){
				// alert(respuesta);
				 $("#contenedor_listado_venta").html(respuesta);
         printHTML();
			}
		});
}
// function listarCliente(rut_cliente){
// 		$.ajax({
// 			url:"../../metodos_ajax/clientes/mostrar_listado_cliente.php?rut_cliente="+rut_cliente,
// 			method:"POST",
// 			success:function(respuesta){
// 				// alert(respuesta);
// 				 $("#contenedor_listado_cliente").html(respuesta);
// 			}
// 		});
// }

listaVentaComprobante(<?php echo $id_venta; ?>);
// listarCliente(<?php //echo $rut_cliente; ?>);




function printHTML() {
  if (window.print) {
    window.print();
  }
}



</script>
</html>
