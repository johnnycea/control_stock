<?php
require_once '../../clases/Funciones.php';
require_once '../../clases/Ventas.php';
require_once '../../clases/ProductoElaborado.php';
require_once '../../clases/Conexion.php';
require_once '../../clases/Cliente.php';

$Funciones = new Funciones();

$id_venta = $Funciones->limpiarNumeroEntero($_REQUEST['id_venta']);
$tipo_venta = $Funciones->limpiarNumeroEntero($_REQUEST['select_tipo_venta']);
$medio_pago = $Funciones->limpiarNumeroEntero($_REQUEST['select_medio_pago']);
$tipo_entrega = $Funciones->limpiarNumeroEntero($_REQUEST['select_tipo_entrega']);

//buscar los productos de la venta
$Venta = new Ventas();
$Venta->setIdVenta($id_venta);
$productos_venta = $Venta->vistaDetalleVenta();


$ProductoElaborado = new ProductoElaborado();

$comprueba_agrega_correctamente;

@session_start();
$array_listado_ingredientes_producto = $_SESSION['listado_ingredientes_productos'];


//RECORRE LOS PRODUCTOS ELABORADOS DE LA VENTA, TOMADOS DESDE BASE DE DATOS
while($filas_productos = $productos_venta->fetch_array()){

   //BUSCA INGREDIENTES DEL PRODUCTO ELABORADO

   //PREGUNTAR SI EL PRODUCTO ELABORADO Y EL ID DETALLE VENTA ESTA EN EL ARRAY, ENTONCES LOS INGREDIENTES SE TOMAN DEL ARRAY
   //SI NO; LOS INGREDIENTES SE TOMAN DE BASE DE DATOS



   $producto_elaborado_encontrado_en_array =false;

   foreach($array_listado_ingredientes_producto as $ingrediente_array){

          if( ($ingrediente_array['id_producto_elaborado'] == $filas_productos['id_producto_elaborado']) and ( $ingrediente_array['id_detalle_venta']==$filas_productos['id_detalle_venta'] ) ){
               // echo 'HAY MODIFICACION DE INGREDIENTES PARA EL PRODUCTO ELABORADO: '.$filas_productos['id_producto_elaborado']." EN EL DEATLLE VENTA: ".$filas_productos['id_detalle_venta'];
                $producto_elaborado_encontrado_en_array=true;
              break;
          }
   }



   //RECIBE LOS INGREDIENTES DEL PRODUCTO ELABORADO
   $ingredientes_producto = array();

   if($producto_elaborado_encontrado_en_array){//si se ha encontrado el producto en el array; se tomaran los ingredientes del listado del array

     $ingredientes_producto = $_SESSION['listado_ingredientes_productos'];

     // echo "-------------------BUSCA INGREDIENTES EN EL ARRAY----------------------";
     // echo json_encode($ingredientes_producto);

   }else{//si no fuen encontrado en el array; se tomaran los ingredientes del producto desde base de datos

     $ProductoElaborado->setIdProductoElaborado($filas_productos['id_producto_elaborado']);
     $resultado_consulta = $ProductoElaborado->obtener_ingredientes_producto();
     while($filas_ingredientes_bd = $resultado_consulta->fetch_assoc()){
        $ingredientes_producto[] = $filas_ingredientes_bd;
     }

     // echo "-------------------BUSCA INGREDINETES EN BD-------------------";
     // echo json_encode($ingredientes_producto);

   }



   foreach($ingredientes_producto as $ingrediente_producto_elaborado){

       if( ($ingrediente_producto_elaborado['id_producto_elaborado']==$filas_productos['id_producto_elaborado'])  ){

            $Venta->setIdProductoElaborado($filas_productos['id_producto_elaborado']);
            $Venta->setIdDetalleVenta($filas_productos['id_detalle_venta']);

                $id_ingrediente = $ingrediente_producto_elaborado['id_producto'];
                $cantidad = $ingrediente_producto_elaborado['cantidad'];
                if($cantidad!=0){

                    if($Venta->registrarIngredienteVenta($id_ingrediente,$cantidad)){
                      $comprueba_agrega_correctamente = true;

                      // echo "AGREGA EL INGREDIENTE ".$id_ingrediente." CANTIDAD: ".$cantidad." en detalleventa: ".$filas_productos['id_detalle_venta'];
                    }else{
                      $comprueba_agrega_correctamente = false;
                    }

                }
        }

   }

}//fin del while que recoore los productos de la venta (detalle venta)


   
   if($comprueba_agrega_correctamente){



     $ingresa_cliente = false;

     //PREGUNTA SI AGREGA CLIENTE O NO
     if(isset($_REQUEST['chb_cliente'])){//ENTRA AQUI SI AGREGA CLIENTE
       // echo 'si agrega cliente';

           $txt_rut_cliente = $Funciones->limpiarTexto($_REQUEST['txt_rut_cliente']);
           $txt_nombre = $Funciones->limpiarTexto($_REQUEST['txt_nombre']);
           $txt_apellidos = $Funciones->limpiarTexto($_REQUEST['txt_apellidos']);
           $txt_calle = $Funciones->limpiarTexto($_REQUEST['txt_calle']);
           $txt_numero = $Funciones->limpiarTexto($_REQUEST['txt_numero']);
           $txt_observacion= $Funciones->limpiarTexto($_REQUEST['txt_observacion']);
           $txt_telefono = $Funciones->limpiarTexto($_REQUEST['txt_telefono']);
           $posicionGuion = strpos($txt_rut_cliente,'-');
           $soloRut = substr($txt_rut_cliente,0,$posicionGuion);
           $txt_dv = substr($txt_rut_cliente,$posicionGuion+1,$posicionGuion+2);

           $Cliente = new Cliente();
           $Cliente->setRutCliente($soloRut);
           $Cliente->setDv($txt_dv);
           $Cliente->setNombre($txt_nombre);
           $Cliente->setApellidos($txt_apellidos);
           $Cliente->setCalle($txt_calle);
           $Cliente->setNumeroCalle($txt_numero);
           $Cliente->setObservacion($txt_observacion);
           $Cliente->setTelefono($txt_telefono);

          $comprueba_cliente_existe = $Cliente->obtenerClienteRegistrados();
          if($comprueba_cliente_existe->num_rows>0){
            //SE DEBE ACTUALIZAR EL CLIENTE
            if($Cliente->modificarCliente()){
              $ingresa_cliente = true;
            }
          }else{
            //SE DEBE CREAR EL CLIENTE
            if($Cliente->crearCliente()){
              $ingresa_cliente = true;
            }
          }

     }else{//ENTRA AQUI CUANDO NO AGREGA CLIENTE
       $soloRut = "NULL";
       $ingresa_cliente = true;
       // echo 'no agrega cliente';
     }


        if($ingresa_cliente==true){
                  $Venta->setIdEstado(2);
                  $Venta->setTipoVenta($tipo_venta);
                  $Venta->setMedioPago($medio_pago);
                  $Venta->setTipoEntrega($tipo_entrega);
                  $Venta->setRutCliente($soloRut);

                  if($Venta->finalizarVenta()){
                                echo "1";

                  }else{
                    echo '4';//error al cambiar estado de venta
                  }
          }else{
            echo '3'; //error al agregar cliente
          }

   }else{//else no agrega productos correctamente
      echo '2';
   }




?>
