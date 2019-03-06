<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Movimiento.php';
require_once '../../clases/Subvencion.php';
require_once '../../clases/Colegio.php';


$anio = $_REQUEST['txt_anio'];
$subvencion = $_REQUEST['select_subvencion'];
$tipo_informe = $_REQUEST['select_tipo_informe'];
$colegio = $_REQUEST['select_colegio'];


//nombres
$lista_meses = array(
1 => "Enero",
2 => "Febrero",
3 => "Marzo",
4 => "Abril",
5 => "Mayo",
6 => "Junio",
7 => "Julio",
8 => "Agosto",
9 => "Septiembre",
10 => "Octubre",
11 => "Noviembre",
12 => "Diciembre");


//valores
$enero = array("mes"=> "0", "scvtf_normal" => "0", "scvtf_nivelacion" => "0", "sep_preferente" => "0", "sep_preferencial" => "0", "sep_concentracion" => "0", "sep_articulo_19" => "0", "sep_ajustes" => "0" );//primero
$febrero = array("mes"=> "0", "scvtf_normal" => "0", "scvtf_nivelacion" => "0", "sep_preferente" => "0", "sep_preferencial" => "0", "sep_concentracion" => "0", "sep_articulo_19" => "0", "sep_ajustes" => "0" );
$marzo = array("mes"=> "0", "scvtf_normal" => "0", "scvtf_nivelacion" => "0", "sep_preferente" => "0", "sep_preferencial" => "0", "sep_concentracion" => "0", "sep_articulo_19" => "0", "sep_ajustes" => "0" );
$abril = array("mes"=> "0", "scvtf_normal" => "0", "scvtf_nivelacion" => "0", "sep_preferente" => "0", "sep_preferencial" => "0", "sep_concentracion" => "0", "sep_articulo_19" => "0", "sep_ajustes" => "0" );
$mayo = array("mes"=> "0", "scvtf_normal" => "0", "scvtf_nivelacion" => "0", "sep_preferente" => "0", "sep_preferencial" => "0", "sep_concentracion" => "0", "sep_articulo_19" => "0", "sep_ajustes" => "0" );
$junio = array("mes"=> "0", "scvtf_normal" => "0", "scvtf_nivelacion" => "0", "sep_preferente" => "0", "sep_preferencial" => "0", "sep_concentracion" => "0", "sep_articulo_19" => "0", "sep_ajustes" => "0" );
$julio = array("mes"=> "0", "scvtf_normal" => "0", "scvtf_nivelacion" => "0", "sep_preferente" => "0", "sep_preferencial" => "0", "sep_concentracion" => "0", "sep_articulo_19" => "0", "sep_ajustes" => "0" );
$agosto = array("mes"=> "0", "scvtf_normal" => "0", "scvtf_nivelacion" => "0", "sep_preferente" => "0", "sep_preferencial" => "0", "sep_concentracion" => "0", "sep_articulo_19" => "0", "sep_ajustes" => "0" );
$septiembre = array("mes"=> "0", "scvtf_normal" => "0", "scvtf_nivelacion" => "0", "sep_preferente" => "0", "sep_preferencial" => "0", "sep_concentracion" => "0", "sep_articulo_19" => "0", "sep_ajustes" => "0" );
$octubre = array("mes"=> "0", "scvtf_normal" => "0", "scvtf_nivelacion" => "0", "sep_preferente" => "0", "sep_preferencial" => "0", "sep_concentracion" => "0", "sep_articulo_19" => "0", "sep_ajustes" => "0" );
$noviembre = array("mes"=> "0", "scvtf_normal" => "0", "scvtf_nivelacion" => "0", "sep_preferente" => "0", "sep_preferencial" => "0", "sep_concentracion" => "0", "sep_articulo_19" => "0", "sep_ajustes" => "0" );
$diciembre = array("mes"=> "0", "scvtf_normal" => "0", "scvtf_nivelacion" => "0", "sep_preferente" => "0", "sep_preferencial" => "0", "sep_concentracion" => "0", "sep_articulo_19" => "0", "sep_ajustes" => "0" );

$total = array("total_mes"=> "0", "total_scvtf_normal" => "0", "total_scvtf_nivelacion" => "0", "total_sep_preferente" => "0", "total_sep_preferencial" => "0", "total_sep_concentracion" => "0", "total_sep_articulo_19" => "0", "total_sep_ajustes" => "0" );//segundo



//TABLA DE INGRESOS

    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    //pone en colegio en 0 cuando el tipo de informe es tipo resumen
    // if($tipo_informe==1){ $colegio = "0"; }


if($resultado_consulta = $Conexion->query("call procedimiento_informe(".$tipo_informe.",".$anio.",1,".$subvencion.",".$colegio.")")){

      while($filas= $resultado_consulta->fetch_array()){

           switch ($filas['mes']) {
             case '1':

                       $enero['mes']=number_format($filas['monto'],0,',','.');
                       //PARA SCVTF
                       $enero['scvtf_normal']=number_format($filas['scvtf_normal'],0,',','.');
                       $enero['scvtf_nivelacion']=number_format($filas['scvtf_nivelacion'],0,',','.');
                       //TOTAL SCVTF
                       $total['total_scvtf_normal'] += $filas['scvtf_normal'];
                       $total['total_scvtf_nivelacion']+=$filas['scvtf_nivelacion'];
                       //PARA SEP
                       $enero['sep_preferente'] = number_format($filas['sep_preferente'],0,',','.'); //tercero
                       $enero['sep_preferencial'] = number_format($filas['sep_preferencial'],0,',','.'); //tercero
                       $enero['sep_concentracion'] = number_format($filas['sep_concentracion'],0,',','.'); //tercero
                       $enero['sep_articulo_19'] = number_format($filas['sep_articulo_19'],0,',','.'); //tercero
                       $enero['sep_ajustes'] = number_format($filas['sep_ajustes'],0,',','.'); //tercero
                       //TOTALES SEP
                       $total['total_sep_preferente'] += $filas['sep_preferente'];
                       $total['total_sep_preferencial'] += $filas['sep_preferencial'];
                       $total['total_sep_concentracion'] += $filas['sep_concentracion'];
                       $total['total_sep_articulo_19'] += $filas['sep_articulo_19'];
                       $total['total_sep_ajustes'] += $filas['sep_ajustes'];
                       //TOTAL FINAL
                       $total['total_mes'] += $filas['monto'];
               break;
             case '2':
                       $febrero['mes']=number_format($filas['monto'],0,',','.');
                       //PARA SCVTF
                       $febrero['scvtf_normal']=number_format($filas['scvtf_normal'],0,',','.');
                       $febrero['scvtf_nivelacion']=number_format($filas['scvtf_nivelacion'],0,',','.');
                       //TOTAL SCVTF
                       $total['total_scvtf_normal'] += $filas['scvtf_normal'];
                       $total['total_scvtf_nivelacion']+=$filas['scvtf_nivelacion'];
                       //PARA SEP
                       $febrero['sep_preferente'] = number_format($filas['sep_preferente'],0,',','.');
                       $febrero['sep_preferencial'] = number_format($filas['sep_preferencial'],0,',','.');
                       $febrero['sep_concentracion'] = number_format($filas['sep_concentracion'],0,',','.');
                       $febrero['sep_articulo_19'] = number_format($filas['sep_articulo_19'],0,',','.');
                       $febrero['sep_ajustes'] = number_format($filas['sep_ajustes'],0,',','.');
                       //TOTALES
                       $total['total_sep_preferente'] += $filas['sep_preferente'];
                       $total['total_sep_preferencial'] += $filas['sep_preferencial'];
                       $total['total_sep_concentracion'] += $filas['sep_concentracion'];
                       $total['total_sep_articulo_19'] += $filas['sep_articulo_19'];
                       $total['total_sep_ajustes'] += $filas['sep_ajustes'];
                       //TOTAL FINAL
                       $total['total_mes'] += $filas['monto'];
               break;
             case '3': $marzo['mes']=number_format($filas['monto'],0,',','.');
                      //SCVTF
                       $marzo['scvtf_normal']=number_format($filas['scvtf_normal'],0,',','.');
                       $marzo['scvtf_nivelacion']=number_format($filas['scvtf_nivelacion'],0,',','.');
                       //TOTAL SCVTF
                       $total['total_scvtf_normal'] += $filas['scvtf_normal'];
                       $total['total_scvtf_nivelacion']+=$filas['scvtf_nivelacion'];
                       //PARA SEP
                       $marzo['sep_preferente'] = number_format($filas['sep_preferente'],0,',','.'); //tercero
                       $marzo['sep_preferencial'] = number_format($filas['sep_preferencial'],0,',','.'); //tercero
                       $marzo['sep_concentracion'] = number_format($filas['sep_concentracion'],0,',','.'); //tercero
                       $marzo['sep_articulo_19'] = number_format($filas['sep_articulo_19'],0,',','.'); //tercero
                       $marzo['sep_ajustes'] = number_format($filas['sep_ajustes'],0,',','.'); //tercero
                       //TOTALES
                       $total['total_sep_preferente'] += $filas['sep_preferente'];
                       $total['total_sep_preferencial'] += $filas['sep_preferencial'];
                       $total['total_sep_concentracion'] += $filas['sep_concentracion'];
                       $total['total_sep_articulo_19'] += $filas['sep_articulo_19'];
                       $total['total_sep_ajustes'] += $filas['sep_ajustes'];

                       $total['total_mes'] += $filas['monto'];
               break;
             case '4':
                       $abril['mes']=number_format($filas['monto'],0,',','.');
                       //PARA SCVTF
                       $abril['scvtf_normal']=number_format($filas['scvtf_normal'],0,',','.');
                       $abril['scvtf_nivelacion']=number_format($filas['scvtf_nivelacion'],0,',','.');
                       //TOTAL SCVTF
                       $total['total_scvtf_normal'] += $filas['scvtf_normal'];
                       $total['total_scvtf_nivelacion']+=$filas['scvtf_nivelacion'];
                       //PARA SEP
                       $abril['sep_preferente'] = number_format($filas['sep_preferente'],0,',','.'); //tercero
                       $abril['sep_preferencial'] = number_format($filas['sep_preferencial'],0,',','.'); //tercero
                       $abril['sep_concentracion'] = number_format($filas['sep_concentracion'],0,',','.'); //tercero
                       $abril['sep_articulo_19'] = number_format($filas['sep_articulo_19'],0,',','.'); //tercero
                       $abril['sep_ajustes'] = number_format($filas['sep_ajustes'],0,',','.'); //tercero
                       //TOTALES SEP
                       $total['total_sep_preferente'] += $filas['sep_preferente'];
                       $total['total_sep_preferencial'] += $filas['sep_preferencial'];
                       $total['total_sep_concentracion'] += $filas['sep_concentracion'];
                       $total['total_sep_articulo_19'] += $filas['sep_articulo_19'];
                       $total['total_sep_ajustes'] += $filas['sep_ajustes'];
                       //TOTAL FINAL
                       $total['total_mes'] += $filas['monto'];
               break;
             case '5':
                       $mayo['mes']=number_format($filas['monto'],0,',','.');
                       //PARA SCVTF
                       $mayo['scvtf_normal']=number_format($filas['scvtf_normal'],0,',','.');
                       $mayo['scvtf_nivelacion']=number_format($filas['scvtf_nivelacion'],0,',','.');
                       //TOTAL SCVTF
                       $total['total_scvtf_normal'] += $filas['scvtf_normal'];
                       $total['total_scvtf_nivelacion']+=$filas['scvtf_nivelacion'];
                       //PARA SEP
                       $mayo['sep_preferente'] = number_format($filas['sep_preferente'],0,',','.'); //tercero
                       $mayo['sep_preferencial'] = number_format($filas['sep_preferencial'],0,',','.'); //tercero
                       $mayo['sep_concentracion'] = number_format($filas['sep_concentracion'],0,',','.'); //tercero
                       $mayo['sep_articulo_19'] = number_format($filas['sep_articulo_19'],0,',','.'); //tercero
                       $mayo['sep_ajustes'] = number_format($filas['sep_ajustes'],0,',','.'); //tercero
                       //TOTALES SEP
                       $total['total_sep_preferente'] += $filas['sep_preferente'];
                       $total['total_sep_preferencial'] += $filas['sep_preferencial'];
                       $total['total_sep_concentracion'] += $filas['sep_concentracion'];
                       $total['total_sep_articulo_19'] += $filas['sep_articulo_19'];
                       $total['total_sep_ajustes'] += $filas['sep_ajustes'];
                       //TOTAL FINAL
                       $total['total_mes'] += $filas['monto'];
               break;
             case '6':
                       $junio['mes']=number_format($filas['monto'],0,',','.');
                       //PARA SCVTF
                       $junio['scvtf_normal']=number_format($filas['scvtf_normal'],0,',','.');
                       $junio['scvtf_nivelacion']=number_format($filas['scvtf_nivelacion'],0,',','.');
                       //TOTAL SCVTF
                       $total['total_scvtf_normal'] += $filas['scvtf_normal'];
                       $total['total_scvtf_nivelacion']+=$filas['scvtf_nivelacion'];
                       //PARA SEP
                       $junio['sep_preferente'] = number_format($filas['sep_preferente'],0,',','.'); //tercero
                       $junio['sep_preferencial'] = number_format($filas['sep_preferencial'],0,',','.'); //tercero
                       $junio['sep_concentracion'] = number_format($filas['sep_concentracion'],0,',','.'); //tercero
                       $junio['sep_articulo_19'] = number_format($filas['sep_articulo_19'],0,',','.'); //tercero
                       $junio['sep_ajustes'] = number_format($filas['sep_ajustes'],0,',','.'); //tercero
                       //TOTALES SEP
                       $total['total_sep_preferente'] += $filas['sep_preferente'];
                       $total['total_sep_preferencial'] += $filas['sep_preferencial'];
                       $total['total_sep_concentracion'] += $filas['sep_concentracion'];
                       $total['total_sep_articulo_19'] += $filas['sep_articulo_19'];
                       $total['total_sep_ajustes'] += $filas['sep_ajustes'];
                       //TOTAL FINAL
                       $total['total_mes'] += $filas['monto'];
               break;
             case '7':
                       $julio['mes']=number_format($filas['monto'],0,',','.');
                       //PARA SCVTF
                       $julio['scvtf_normal']=number_format($filas['scvtf_normal'],0,',','.');
                       $julio['scvtf_nivelacion']=number_format($filas['scvtf_nivelacion'],0,',','.');
                       //TOTAL SCVTF
                       $total['total_scvtf_normal'] += $filas['scvtf_normal'];
                       $total['total_scvtf_nivelacion']+=$filas['scvtf_nivelacion'];
                       //PARA SEP
                       $julio['sep_preferente'] = number_format($filas['sep_preferente'],0,',','.'); //tercero
                       $julio['sep_preferencial'] = number_format($filas['sep_preferencial'],0,',','.'); //tercero
                       $julio['sep_concentracion'] = number_format($filas['sep_concentracion'],0,',','.'); //tercero
                       $julio['sep_articulo_19'] = number_format($filas['sep_articulo_19'],0,',','.'); //tercero
                       $julio['sep_ajustes'] = number_format($filas['sep_ajustes'],0,',','.'); //tercero
                       //TOTALES SEP
                       $total['total_sep_preferente'] += $filas['sep_preferente'];
                       $total['total_sep_preferencial'] += $filas['sep_preferencial'];
                       $total['total_sep_concentracion'] += $filas['sep_concentracion'];
                       $total['total_sep_articulo_19'] += $filas['sep_articulo_19'];
                       $total['total_sep_ajustes'] += $filas['sep_ajustes'];
                       //TOTAL FINAL
                       $total['total_mes'] += $filas['monto'];
               break;
             case '8':
                       $agosto['mes']=number_format($filas['monto'],0,',','.');
                       //PARA SCVTF
                       $agosto['scvtf_normal']=number_format($filas['scvtf_normal'],0,',','.');
                       $agosto['scvtf_nivelacion']=number_format($filas['scvtf_nivelacion'],0,',','.');
                       //TOTAL SCVTF
                       $total['total_scvtf_normal'] += $filas['scvtf_normal'];
                       $total['total_scvtf_nivelacion']+=$filas['scvtf_nivelacion'];
                       //PARA SEP
                       $agosto['sep_preferente'] = number_format($filas['sep_preferente'],0,',','.'); //tercero
                       $agosto['sep_preferencial'] = number_format($filas['sep_preferencial'],0,',','.'); //tercero
                       $agosto['sep_concentracion'] = number_format($filas['sep_concentracion'],0,',','.'); //tercero
                       $agosto['sep_articulo_19'] = number_format($filas['sep_articulo_19'],0,',','.'); //tercero
                       $agosto['sep_ajustes'] = number_format($filas['sep_ajustes'],0,',','.'); //tercero
                       //TOTALES SEP
                       $total['total_sep_preferente'] += $filas['sep_preferente'];
                       $total['total_sep_preferencial'] += $filas['sep_preferencial'];
                       $total['total_sep_concentracion'] += $filas['sep_concentracion'];
                       $total['total_sep_articulo_19'] += $filas['sep_articulo_19'];
                       $total['total_sep_ajustes'] += $filas['sep_ajustes'];
                       //TOTAL FINAL
                       $total['total_mes'] += $filas['monto'];
               break;
             case '9':
                       $septiembre['mes']=number_format($filas['monto'],0,',','.');
                       //PARA SCVTF
                       $septiembre['scvtf_normal']=number_format($filas['scvtf_normal'],0,',','.');
                       $septiembre['scvtf_nivelacion']=number_format($filas['scvtf_nivelacion'],0,',','.');
                       //TOTAL SCVTF
                       $total['total_scvtf_normal'] += $filas['scvtf_normal'];
                       $total['total_scvtf_nivelacion']+=$filas['scvtf_nivelacion'];
                       //PARA SEP
                       $septiembre['sep_preferente'] = number_format($filas['sep_preferente'],0,',','.'); //tercero
                       $septiembre['sep_preferencial'] = number_format($filas['sep_preferencial'],0,',','.'); //tercero
                       $septiembre['sep_concentracion'] = number_format($filas['sep_concentracion'],0,',','.'); //tercero
                       $septiembre['sep_articulo_19'] = number_format($filas['sep_articulo_19'],0,',','.'); //tercero
                       $septiembre['sep_ajustes'] = number_format($filas['sep_ajustes'],0,',','.'); //tercero
                       //TOTALES SEP
                       $total['total_sep_preferente'] += $filas['sep_preferente'];
                       $total['total_sep_preferencial'] += $filas['sep_preferencial'];
                       $total['total_sep_concentracion'] += $filas['sep_concentracion'];
                       $total['total_sep_articulo_19'] += $filas['sep_articulo_19'];
                       $total['total_sep_ajustes'] += $filas['sep_ajustes'];
                       //TOTAL FINAL
                       $total['total_mes'] += $filas['monto'];
               break;
             case '10':
                       $octubre['mes']=number_format($filas['monto'],0,',','.');
                       //PARA SCVTF
                       $octubre['scvtf_normal']=number_format($filas['scvtf_normal'],0,',','.');
                       $octubre['scvtf_nivelacion']=number_format($filas['scvtf_nivelacion'],0,',','.');
                       //TOTAL SCVTF
                       $total['total_scvtf_normal'] += $filas['scvtf_normal'];
                       $total['total_scvtf_nivelacion']+=$filas['scvtf_nivelacion'];
                       //PARA SEP
                       $octubre['sep_preferente'] = number_format($filas['sep_preferente'],0,',','.'); //tercero
                       $octubre['sep_preferencial'] = number_format($filas['sep_preferencial'],0,',','.'); //tercero
                       $octubre['sep_concentracion'] = number_format($filas['sep_concentracion'],0,',','.'); //tercero
                       $octubre['sep_articulo_19'] = number_format($filas['sep_articulo_19'],0,',','.'); //tercero
                       $octubre['sep_ajustes'] = number_format($filas['sep_ajustes'],0,',','.'); //tercero
                       //TOTALES SEP
                       $total['total_sep_preferente'] += $filas['sep_preferente'];
                       $total['total_sep_preferencial'] += $filas['sep_preferencial'];
                       $total['total_sep_concentracion'] += $filas['sep_concentracion'];
                       $total['total_sep_articulo_19'] += $filas['sep_articulo_19'];
                       $total['total_sep_ajustes'] += $filas['sep_ajustes'];
                       //TOTAL FINAL
                       $total['total_mes'] += $filas['monto'];
               break;
             case '11':
                       $noviembre['mes']=number_format($filas['monto'],0,',','.');
                       //PARA SCVTF
                       $noviembre['scvtf_normal']=number_format($filas['scvtf_normal'],0,',','.');
                       $noviembre['scvtf_nivelacion']=number_format($filas['scvtf_nivelacion'],0,',','.');
                       //TOTAL SCVTF
                       $total['total_scvtf_normal'] += $filas['scvtf_normal'];
                       $total['total_scvtf_nivelacion']+=$filas['scvtf_nivelacion'];
                       //PARA SEP
                       $noviembre['sep_preferente'] = number_format($filas['sep_preferente'],0,',','.'); //tercero
                       $noviembre['sep_preferencial'] = number_format($filas['sep_preferencial'],0,',','.'); //tercero
                       $noviembre['sep_concentracion'] = number_format($filas['sep_concentracion'],0,',','.'); //tercero
                       $noviembre['sep_articulo_19'] = number_format($filas['sep_articulo_19'],0,',','.'); //tercero
                       $noviembre['sep_ajustes'] = number_format($filas['sep_ajustes'],0,',','.'); //tercero
                       //TOTALES SEP
                       $total['total_sep_preferente'] += $filas['sep_preferente'];
                       $total['total_sep_preferencial'] += $filas['sep_preferencial'];
                       $total['total_sep_concentracion'] += $filas['sep_concentracion'];
                       $total['total_sep_articulo_19'] += $filas['sep_articulo_19'];
                       $total['total_sep_ajustes'] += $filas['sep_ajustes'];
                       //TOTAL FINAL
                       $total['total_mes'] += $filas['monto'];
               break;
             case '12':
                       $diciembre['mes']=number_format($filas['monto'],0,',','.');
                       //PARA SCVTF
                       $diciembre['scvtf_normal']=number_format($filas['scvtf_normal'],0,',','.');
                       $diciembre['scvtf_nivelacion']=number_format($filas['scvtf_nivelacion'],0,',','.');
                       //TOTAL SCVTF
                       $total['total_scvtf_normal'] += $filas['scvtf_normal'];
                       $total['total_scvtf_nivelacion']+=$filas['scvtf_nivelacion'];
                       //PARA SEP
                       $diciembre['sep_preferente'] = number_format($filas['sep_preferente'],0,',','.'); //tercero
                       $diciembre['sep_preferencial'] = number_format($filas['sep_preferencial'],0,',','.'); //tercero
                       $diciembre['sep_concentracion'] = number_format($filas['sep_concentracion'],0,',','.'); //tercero
                       $diciembre['sep_articulo_19'] = number_format($filas['sep_articulo_19'],0,',','.'); //tercero
                       $diciembre['sep_ajustes'] = number_format($filas['sep_ajustes'],0,',','.'); //tercero
                       //TOTALES SEP
                       $total['total_sep_preferente'] += $filas['sep_preferente'];
                       $total['total_sep_preferencial'] += $filas['sep_preferencial'];
                       $total['total_sep_concentracion'] += $filas['sep_concentracion'];
                       $total['total_sep_articulo_19'] += $filas['sep_articulo_19'];
                       $total['total_sep_ajustes'] += $filas['sep_ajustes'];
                       //TOTAL FINAL
                       $total['total_mes'] += $filas['monto'];
               break;

           }
      }

     echo '
     <script>
     function generar_informe_descargable(){
       window.open("./metodos_ajax/informes/informe_descargable.php?txt_anio='.$anio.'&select_subvencion='.$subvencion.'&select_colegio='.$colegio.'&select_tipo_informe='.$tipo_informe.'", "Diseño Web", "width=400, height=200")
     }
     </script>

     ';

      echo '
         <div class="container">
             <button onclick="generar_informe_descargable()" class="btn btn-danger">DESCARGAR INFORME</button>
         </div>
      ';


     $Subvencion1 = new Subvencion();
     $Subvencion1->setIdSubvencion($subvencion);
     $Subvencion1 = $Subvencion1->consultarUnaSubvencion();
     $Subvencion1 = $Subvencion1->fetch_array();

     if($tipo_informe==1){//si es resumen

         echo '
         <table class="table table-bordered">
         <tr>
         <td><center><strong>INFORME RESUMEN SUBVENCION '.$Subvencion1['subvencion'].' '.$anio.' </strong></center></td>
         </tr>
         </table>
         ';

     }else if($tipo_informe==2){

         $Colegio1 = new Colegio();
         $Colegio1->setColegio($colegio);
         $Colegio1 = $Colegio1->consultarUnColegio();
         $Colegio1 = $Colegio1->fetch_array();

         echo '
         <table class="table table-bordered">
         <tr>
         <td><center><strong>SUBVENCION '.$Subvencion1['subvencion'].' '.$anio.' '.$Colegio1['nombre_colegio'].'</strong></center></td>
         </tr>
         </table>
         ';
     }


      echo '
        <table class="table table-bordered table_striped">

        <thead>
          <th>MES</th>';

              //cuando subvencion es sc-vtf
              if($subvencion==3){
                echo '<th>Preferente</th>';
                echo '<th>Preferencial</th>';
                echo '<th>Concentracion</th>';
                echo '<th>Articulo 19</th>';
                echo '<th>Ajustes</th>';
              }else if($subvencion==5){
                echo '<th>Subv. Normal</th>';
                echo '<th>Subv. Nivelación</th>';
              }

        echo '<th>Total</th>';


    echo '
       </thead>
        <tbody>';

       //CALCULA SALDO ANIO ANTERIOR

       $Movimiento_totales = new Movimiento();
       $Movimiento_totales->setSubvencion($subvencion);
       $anio_anterior = ($anio-1);

       if($tipo_informe==1){//si es resumen, pone colegio en 0
         $Movimiento_totales->setColegio("0");
       }else if($tipo_informe==2){
         $Movimiento_totales->setColegio($colegio);
       }

       $resultado = $Movimiento_totales->mostrarTotalesColegio($anio_anterior);
       $filas = $resultado->fetch_array();

       echo '
           <tr>
             <td><strong>Saldo año '.$anio_anterior.'</strong></td>
             <td>'.number_format($filas['total_saldo'], "0", ",", ".").'</td>
           </tr>
       ';


$total_ingresos= 0;

      echo '
           <tr>
              <td>Enero</td>';

              if($subvencion==3){
                //cuando subvencion es SEP
                echo '<td>'.$enero['sep_preferente'].'</td>';
                echo '<td>'.$enero['sep_preferencial'].'</td>';
                echo '<td>'.$enero['sep_concentracion'].'</td>';
                echo '<td>'.$enero['sep_articulo_19'].'</td>';
                echo '<td>'.$enero['sep_ajustes'].'</td>';

                echo '<td>'.$enero['mes'].'</td>';

              }else if($subvencion==5){
                //cuando subvencion es sc-vtf
                echo '<td>'.$enero['scvtf_normal'].'</td>';
                echo '<td>'.$enero['scvtf_nivelacion'].'</td>';
                echo '<td>'.($enero['scvtf_normal']+$enero['scvtf_nivelacion']).'</td>';
              }else{
                echo '<td>'.$enero['mes'].'</td>';
              }

      echo '</tr>
           <tr>
              <td>Febrero</td>';

              if($subvencion==3){
                //cuando subvencion es SEP
                echo '<td>'.$febrero['sep_preferente'].'</td>';
                echo '<td>'.$febrero['sep_preferencial'].'</td>';
                echo '<td>'.$febrero['sep_concentracion'].'</td>';
                echo '<td>'.$febrero['sep_articulo_19'].'</td>';
                echo '<td>'.$febrero['sep_ajustes'].'</td>';

                echo '<td>'.$febrero['mes'].'</td>';

              }else if($subvencion==5){
                //cuando subvencion es sc-vtf
                echo '<td>'.$febrero['scvtf_normal'].'</td>';
                echo '<td>'.$febrero['scvtf_nivelacion'].'</td>';
                echo '<td>'.($febrero['scvtf_normal']+$febrero['scvtf_nivelacion']).'</td>';
              }else{
                echo '<td>'.$febrero['mes'].'</td>';
              }

      echo '</tr>
           <tr>
              <td>Marzo</td>';

              if($subvencion==3){
                //cuando subvencion es SEP
                echo '<td>'.$marzo['sep_preferente'].'</td>';
                echo '<td>'.$marzo['sep_preferencial'].'</td>';
                echo '<td>'.$marzo['sep_concentracion'].'</td>';
                echo '<td>'.$marzo['sep_articulo_19'].'</td>';
                echo '<td>'.$marzo['sep_ajustes'].'</td>';

                echo '<td>'.$marzo['mes'].'</td>';

              }else if($subvencion==5){
                //cuando subvencion es sc-vtf
                echo '<td>'.$marzo['scvtf_normal'].'</td>';
                echo '<td>'.$marzo['scvtf_nivelacion'].'</td>';
                echo '<td>'.($marzo['scvtf_normal']+$marzo['scvtf_nivelacion']).'</td>';
              }else{
                echo '<td>'.$marzo['mes'].'</td>';
              }

      echo '</tr>
           <tr>
              <td>Abril</td>';

              if($subvencion==3){
                //cuando subvencion es SEP
                echo '<td>'.$abril['sep_preferente'].'</td>';
                echo '<td>'.$abril['sep_preferencial'].'</td>';
                echo '<td>'.$abril['sep_concentracion'].'</td>';
                echo '<td>'.$abril['sep_articulo_19'].'</td>';
                echo '<td>'.$abril['sep_ajustes'].'</td>';

                echo '<td>'.$abril['mes'].'</td>';

              }else if($subvencion==5){
                //cuando subvencion es sc-vtf
                echo '<td>'.$abril['scvtf_normal'].'</td>';
                echo '<td>'.$abril['scvtf_nivelacion'].'</td>';
                echo '<td>'.($abril['scvtf_normal']+$febrero['scvtf_nivelacion']).'</td>';
              }else{
                echo '<td>'.$abril['mes'].'</td>';
              }

      echo '
           </tr>
           <tr>
              <td>Mayo</td>';

              if($subvencion==3){
                //cuando subvencion es SEP
                echo '<td>'.$mayo['sep_preferente'].'</td>';
                echo '<td>'.$mayo['sep_preferencial'].'</td>';
                echo '<td>'.$mayo['sep_concentracion'].'</td>';
                echo '<td>'.$mayo['sep_articulo_19'].'</td>';
                echo '<td>'.$mayo['sep_ajustes'].'</td>';

                echo '<td>'.$mayo['mes'].'</td>';

              }else if($subvencion==5){
                //cuando subvencion es sc-vtf
                echo '<td>'.$mayo['scvtf_normal'].'</td>';
                echo '<td>'.$mayo['scvtf_nivelacion'].'</td>';
                echo '<td>'.($mayo['scvtf_normal']+$mayo['scvtf_nivelacion']).'</td>';
              }else{
                echo '<td>'.$mayo['mes'].'</td>';
              }

      echo '
           </tr>
           <tr>
              <td>Junio</td>';

              if($subvencion==3){
                //cuando subvencion es SEP
                echo '<td>'.$junio['sep_preferente'].'</td>';
                echo '<td>'.$junio['sep_preferencial'].'</td>';
                echo '<td>'.$junio['sep_concentracion'].'</td>';
                echo '<td>'.$junio['sep_articulo_19'].'</td>';
                echo '<td>'.$junio['sep_ajustes'].'</td>';

                echo '<td>'.$junio['mes'].'</td>';

              }else if($subvencion==5){
                //cuando subvencion es sc-vtf
                echo '<td>'.$junio['scvtf_normal'].'</td>';
                echo '<td>'.$junio['scvtf_nivelacion'].'</td>';
                echo '<td>'.($junio['scvtf_normal']+$junio['scvtf_nivelacion']).'</td>';
              }else{
                echo '<td>'.$junio['mes'].'</td>';
              }

      echo '
           </tr>
           <tr>
              <td>Julio</td>';

              if($subvencion==3){
                //cuando subvencion es SEP
                echo '<td>'.$julio['sep_preferente'].'</td>';
                echo '<td>'.$julio['sep_preferencial'].'</td>';
                echo '<td>'.$julio['sep_concentracion'].'</td>';
                echo '<td>'.$julio['sep_articulo_19'].'</td>';
                echo '<td>'.$julio['sep_ajustes'].'</td>';

                echo '<td>'.$julio['mes'].'</td>';

              }else if($subvencion==5){
                //cuando subvencion es sc-vtf
                echo '<td>'.$julio['scvtf_normal'].'</td>';
                echo '<td>'.$julio['scvtf_nivelacion'].'</td>';
                echo '<td>'.($julio['scvtf_normal']+$julio['scvtf_nivelacion']).'</td>';
              }else{
                echo '<td>'.$julio['mes'].'</td>';
              }

      echo '
           </tr>
           <tr>
              <td>Agosto</td>';

              if($subvencion==3){
                //cuando subvencion es SEP
                echo '<td>'.$agosto['sep_preferente'].'</td>';
                echo '<td>'.$agosto['sep_preferencial'].'</td>';
                echo '<td>'.$agosto['sep_concentracion'].'</td>';
                echo '<td>'.$agosto['sep_articulo_19'].'</td>';
                echo '<td>'.$agosto['sep_ajustes'].'</td>';

                echo '<td>'.$agosto['mes'].'</td>';

              }else if($subvencion==5){
                //cuando subvencion es sc-vtf
                echo '<td>'.$agosto['scvtf_normal'].'</td>';
                echo '<td>'.$agosto['scvtf_nivelacion'].'</td>';
                echo '<td>'.($agosto['scvtf_normal']+$agosto['scvtf_nivelacion']).'</td>';
              }else{
                echo '<td>'.$agosto['mes'].'</td>';
              }

      echo '
           </tr>
           <tr>
              <td>Septiembre</td>';

              if($subvencion==3){
                //cuando subvencion es SEP
                echo '<td>'.$septiembre['sep_preferente'].'</td>';
                echo '<td>'.$septiembre['sep_preferencial'].'</td>';
                echo '<td>'.$septiembre['sep_concentracion'].'</td>';
                echo '<td>'.$septiembre['sep_articulo_19'].'</td>';
                echo '<td>'.$septiembre['sep_ajustes'].'</td>';

                echo '<td>'.$septiembre['mes'].'</td>';

              }else if($subvencion==5){
                //cuando subvencion es sc-vtf
                echo '<td>'.$septiembre['scvtf_normal'].'</td>';
                echo '<td>'.$septiembre['scvtf_nivelacion'].'</td>';
                echo '<td>'.($septiembre['scvtf_normal']+$septiembre['scvtf_nivelacion']).'</td>';
              }else{
                echo '<td>'.$septiembre['mes'].'</td>';
              }

      echo '
           </tr>
           <tr>
              <td>Octubre</td>';

              if($subvencion==3){
                //cuando subvencion es SEP
                echo '<td>'.$octubre['sep_preferente'].'</td>';
                echo '<td>'.$octubre['sep_preferencial'].'</td>';
                echo '<td>'.$octubre['sep_concentracion'].'</td>';
                echo '<td>'.$octubre['sep_articulo_19'].'</td>';
                echo '<td>'.$octubre['sep_ajustes'].'</td>';

                echo '<td>'.$octubre['mes'].'</td>';

              }else if($subvencion==5){
                //cuando subvencion es sc-vtf
                echo '<td>'.$octubre['scvtf_normal'].'</td>';
                echo '<td>'.$octubre['scvtf_nivelacion'].'</td>';
                echo '<td>'.($octubre['scvtf_normal']+$octubre['scvtf_nivelacion']).'</td>';
              }else{
                echo '<td>'.$octubre['mes'].'</td>';
              }

      echo '
           </tr>
           <tr>
              <td>Noviembre</td>';

              if($subvencion==3){
                //cuando subvencion es SEP
                echo '<td>'.$noviembre['sep_preferente'].'</td>';
                echo '<td>'.$noviembre['sep_preferencial'].'</td>';
                echo '<td>'.$noviembre['sep_concentracion'].'</td>';
                echo '<td>'.$noviembre['sep_articulo_19'].'</td>';
                echo '<td>'.$noviembre['sep_ajustes'].'</td>';

                echo '<td>'.$noviembre['mes'].'</td>';

              }else if($subvencion==5){
                //cuando subvencion es sc-vtf
                echo '<td>'.$noviembre['scvtf_normal'].'</td>';
                echo '<td>'.$noviembre['scvtf_nivelacion'].'</td>';
                echo '<td>'.($noviembre['scvtf_normal']+$noviembre['scvtf_nivelacion']).'</td>';
              }else{
                echo '<td>'.$noviembre['mes'].'</td>';
              }

      echo '
           </tr>
           <tr>
              <td>Diciembre</td>';

              if($subvencion==3){
                //cuando subvencion es SEP
                echo '<td>'.$diciembre['sep_preferente'].'</td>';
                echo '<td>'.$diciembre['sep_preferencial'].'</td>';
                echo '<td>'.$diciembre['sep_concentracion'].'</td>';
                echo '<td>'.$diciembre['sep_articulo_19'].'</td>';
                echo '<td>'.$diciembre['sep_ajustes'].'</td>';

                echo '<td>'.$diciembre['mes'].'</td>';

              }else if($subvencion==5){
                //cuando subvencion es sc-vtf
                echo '<td>'.$diciembre['scvtf_normal'].'</td>';
                echo '<td>'.$diciembre['scvtf_nivelacion'].'</td>';
                echo '<td>'.($diciembre['scvtf_normal']+$diciembre['scvtf_nivelacion']).'</td>';
              }else{
                echo '<td>'.$diciembre['mes'].'</td>';
              }
      echo '
           </tr>

           <tr>
              <td><strong>Total Ingresos</strong></td>';

              if($subvencion==3){
                echo '<td>'.number_format($total['total_sep_preferente'], "0", ",","." ).'</td>';
                echo '<td>'.number_format($total['total_sep_preferencial'], "0", ",","." ).'</td>';
                echo '<td>'.number_format($total['total_sep_concentracion'], "0", ",","." ).'</td>';
                echo '<td>'.number_format($total['total_sep_articulo_19'], "0", ",","." ).'</td>';
                echo '<td>'.number_format($total['total_sep_ajustes'], "0", ",","." ).'</td>';

                $total_ingresos = ($total['total_sep_preferente']+$total['total_sep_preferencial']+$total['total_sep_concentracion']+$total['total_sep_articulo_19']+$total['total_sep_ajustes']);
                echo '<td>'.number_format($total_ingresos, "0", ",","." ).'</td>';

              }else if($subvencion==5){
                //cuando subvencion es sc-vtf
                // echo '<td>'.number_format($total['total_mes'], "0", ",","." ).'</td>';
                echo '<td>'.number_format($total['total_scvtf_normal'], "0", ",","." ).'</td>';
                echo '<td>'.number_format($total['total_scvtf_nivelacion'], "0", ",","." ).'</td>';

                $total_ingresos = ($total['total_scvtf_normal']+$total['total_scvtf_nivelacion']);
                echo '<td>'.number_format($total_ingresos, "0", ",","." ).'</td>';
              }else{
                $total_ingresos = $total['total_mes'];
                echo '<td>'.number_format($total_ingresos, "0", ",","." ).'</td>';
              }

      echo '
           </tr>
       </tbody>
      </table>';

    }else{
      echo "ERROR CON EL INFORME DE INGRESOS AMIGO";
    }


echo "<br />";

    //TABLA DE GASTOS

if($tipo_informe==2){

    $total_gastos = 0;

    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    if($resultado_consulta = $Conexion->query("call procedimiento_informe(".$tipo_informe.",".$anio.",2,".$subvencion.",".$colegio.")")){

    echo '
      <table class="table table-bordered ">
       <thead>
           <th>Descripción</th>
           <th>Ord. compra</th>
           <th>Fecha</th>
           <th>Monto</th>
       </thead>
       <tbody>
    ';
      while($filas= $resultado_consulta->fetch_array()){

        $fecha=date_create($filas['fecha_ingreso']);
        $fecha= date_format($fecha, 'd/m/Y');

        $total_gastos += $filas['monto'];

        echo '<tr>
                 <td>'.$filas['descripcion'].'</td>
                 <td>'.$filas['orden_compra'].'</td>
                 <td>'.$fecha.'</td>
                 <td>'.number_format($filas['monto'],0,',','.').'</td>
             </tr>';

      }

    echo '
            <tr>
              <td colspan="3"><strong>Total Gastos</strong></td>
              <td>'.number_format($total_gastos,0,",",".").'</td>
            </tr>
       </tbody>
     </table>';


    }else{
      echo "ERROR CON EL INFORME DE GASTOS AMIGO";
    }

//TABLA DE SALDO
    echo '
      <table class="table table-bordered">
        <tr>
          <td colspan="4"><center><strong>SALDO</strong></center></td>
          <td colspan="1"><center><strong>'.number_format(($total_ingresos-$total_gastos),0,",",".").'</strong></center></td>
        </tr>
      </table>
    ';



}else if($tipo_informe==1){

  // echo "el tipo de informe es RESUMEN";


  $Conexion = new Conexion();
  $Conexion = $Conexion->conectar();

  $SaldoArrastre = 0;
  $Ingresos = 0;
  $GastoSueldos = 0;
  $GastoBienes = 0;
  $TotalGastos = 0;
  $SaldoActual = 0;

  echo '
    <table class="table table-bordered ">
     <thead>
         <th>Establecimiento</th>
         <th>Saldo Arrastre</th>
         <th>Ingresos</th>
         <th>Gasto Sueldos</th>
         <th>Gasto Bienes y servicios</th>
         <th>Total Gastos</th>
         <th>Saldo Actual</th>
     </thead>
     <tbody>
  ';

  $condiciones="";
  if($subvencion==5){
      $condiciones = " where tipo_establecimiento = 2";
  }else{
      $condiciones = " where tipo_establecimiento = 1";
  }

  $resultado_consulta = $Conexion->query("select * from tb_colegios ".$condiciones);

  while($filas_colegio= $resultado_consulta->fetch_array()){

      echo '
      <tr>
          <td>'.$filas_colegio['nombre_colegio'].'</td>';
          $Conexion2 = new Conexion();
          $Conexion2 = $Conexion2->conectar();

          $resultados_por_colegio = $Conexion2->query("call procedimiento_informe(".$tipo_informe.",".$anio.",0,".$subvencion.",'".$filas_colegio['rbd_colegio']."')");

           if($filas_resumenes = $resultados_por_colegio->fetch_array()){

             echo '<td>'.number_format($filas_resumenes['saldo_arrastre'],0,",",".").'</td>';
             echo '<td>'.number_format($filas_resumenes['total_ingresos'],0,",",".").'</td>';
             echo '<td>'.number_format($filas_resumenes['gastos_sueldos'],0,",",".").'</td>';
             echo '<td>'.number_format($filas_resumenes['gastos_bienes'],0,",",".").'</td>';
             echo '<td>'.number_format($filas_resumenes['total_gastos'],0,",",".").'</td>';
             echo '<td>'.number_format($filas_resumenes['saldo_actual'],0,",",".").'</td>';

             $SaldoArrastre += $filas_resumenes['saldo_arrastre'];
             $Ingresos += $filas_resumenes['total_ingresos'];
             $GastoSueldos += $filas_resumenes['gastos_sueldos'];
             $GastoBienes += $filas_resumenes['gastos_bienes'];
             $TotalGastos += $filas_resumenes['total_gastos'];
             $SaldoActual += $filas_resumenes['saldo_actual'];
          }

      echo '
      </tr>
      ';

  }

  echo '<tr>
           <td>Totales</td>
           <td>'.number_format($SaldoArrastre,0,",",".").'</td>
           <td>'.number_format($Ingresos,0,",",".").'</td>
           <td>'.number_format($GastoSueldos,0,",",".").'</td>
           <td>'.number_format($GastoBienes,0,",",".").'</td>
           <td>'.number_format($TotalGastos,0,",",".").'</td>
           <td>'.number_format($SaldoActual,0,",",".").'</td>
        </tr>';



  echo '
     </tbody>
   </table>';



   //TABLA DE SALDO
       echo '
         <table class="table table-bordered">
           <tr>
             <td colspan="4"><center><strong>SALDO</strong></center></td>
             <td colspan="1"><center><strong>'.number_format($SaldoActual,0,",",".").'</strong></center></td>
           </tr>
         </table>
       ';

}




 ?>
