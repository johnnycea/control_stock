<?php
require_once '../../clases/Ventas.php';

   $Venta = new Ventas();
   $numero_venta;

   $consultaVenta = $Venta->consultarUltimaVentaPendiente();

    if($consultaVenta->num_rows>0){
        //recibe el id de esa venta
        $consultaVenta = $consultaVenta->fetch_array();
        $numero_venta = $consultaVenta['id_venta'];
    }
    else{
     $numero_venta = $Venta->crearVenta();
    }

echo $numero_venta;

?>
