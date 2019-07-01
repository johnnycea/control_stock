<?php
require_once '../../clases/Funciones.php';
require_once '../../clases/Ventas.php';
require_once '../../clases/ProductoElaborado.php';
require_once '../../clases/Conexion.php';
require_once '../../clases/Cliente.php';
require_once '../../clases/Pedido.php';

$Funciones = new Funciones();

$id_venta = $Funciones->limpiarNumeroEntero($_REQUEST['id_venta']);
$tipo_venta = $Funciones->limpiarNumeroEntero($_REQUEST['select_tipo_venta']);
$medio_pago = $Funciones->limpiarNumeroEntero($_REQUEST['select_medio_pago']);

//buscar los productos de la venta
$Venta = new Ventas();
$Venta->setIdVenta($id_venta);
$productos_venta = $Venta->vistaDetalleVenta();


$ProductoElaborado = new ProductoElaborado();

$comprueba_agrega_correctamente;

while($filas_productos = $productos_venta->fetch_array()){

   //BUSCA INGREDIENTES DEL PRODUCTO ELABORADO
   $ProductoElaborado->setIdProductoElaborado($filas_productos['id_producto_elaborado']);
   $ingredientes_producto = $ProductoElaborado->obtener_ingredientes_producto();

   // echo "el prdoucto ".$filas_productos['descripcion']." tiene los siguientes ingredientes </br>";
   while($filas_ingredientes = $ingredientes_producto->fetch_array()){

        $Venta->setIdProductoElaborado($filas_productos['id_producto_elaborado']);
        // echo "ingrediente: ".$filas_ingredientes['descripcion']." cantidad: ".$filas_ingredientes['cantidad']." ".$filas_ingredientes['unidad_medida'];

           for($i = 0; $i<$filas_productos['cantidad']; $i++){
                if($Venta->registrarIngredienteVenta($filas_ingredientes['id_producto'],$filas_ingredientes['cantidad'])){
                     $comprueba_agrega_correctamente = true;
                }else{
                     $comprueba_agrega_correctamente = false;
                }
           }

   }


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
       $ingresa_cliente = true;
       $soloRut = "NULL";
       // echo 'no agrega cliente';
     }


        if($ingresa_cliente==true){
                  $Venta->setIdEstado(2);
                  $Venta->setTipoVenta($tipo_venta);
                  $Venta->setMedioPago($medio_pago);
                  $Venta->setRutCliente($soloRut);

                  if($Venta->finalizarVenta()){
                     // echo '1';
                           //preguntar si la entrega es a domicilio: hay quehacer el insert a la tabla tb_pedidos, una vez agragado devuelve echo 1
                            $select_tipo_entrega = $_REQUEST['select_tipo_entrega'];

                            if($select_tipo_entrega=="2"){
                              //instancia clase pedido y setea sus parametrso

                              $Pedido = new Pedido();
                              $Pedido->setIdVenta($id_venta);
                              $Pedido->setIdRepartidor("NULL");

                                  if($Pedido->crearPedido()){
                                     echo "1";

                                  }else{
                                    echo '5';//error al crear pedido
                                  }

                            }else{
                                echo "1";
                            }//si es en local se devuelve echo 1

                  }else{
                    echo '4';//error al cambiar estado de venta
                  }
          }else{
            echo '3'; //error al agregar cliente
          }

   }else{//else no agrega productos correctamente
      echo '2';
   }

}


?>
