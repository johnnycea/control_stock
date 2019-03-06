function mostrarListadoMovimientos(texto_buscar){

		$.ajax({
			url:"./metodos_ajax/movimientos/mostrar_listado_movimientos.php?texto_buscar="+texto_buscar,
			method:"POST",
			success:function(respuesta){
				 $("#contenedor_registro_movimientos").html(respuesta);
			}
		});
}


function muestraTotalesColegioSubvencion(){
	// Ingresos y Gastos
 colegio = $("#select_colegio").val();
 subvencion = $("#select_subvencion").val();

 if(subvencion!=null){

	 $.ajax({
			url:"./metodos_ajax/movimientos/mostrar_totales_colegios.php?colegio="+colegio+"&subvencion="+subvencion,
		 method:"POST",
		 data: $("#formulario_modal_movimientos").serialize(),
		 success:function(respuesta){
         $("#contenedor_informacion_resumen").html(respuesta);
		 }
	 });

 }
}

function registrarModificarMovimiento(){


		$.ajax({
			url:"./metodos_ajax/movimientos/ingresar_modificar_movimiento.php",
			method:"POST",
      data: $("#formulario_modal_movimientos").serialize(),
			success:function(respuesta){
				 // alert(respuesta);
				 // console.log(respuesta);

           if(respuesta==1){
             swal("Guardado","Los datos se han guardado correctamente.","success");
						 limpiarFormulario();
             mostrarListadoMovimientos("");

           }else if(respuesta==3){//
						 swal("Guardado","Se registró, gasto del 10% correspondiente a administracion central","success");
						 limpiarFormulario();
						 mostrarListadoMovimientos("");

           }else if(respuesta==2){
             swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
           }
			}
		});
}

function cambiaSubvencion(){

// alert("cambia subvencion");

$subvencion= $("#select_subvencion").val();
$tipo_movimiento= $("#select_tipo_movimiento").val();

if($tipo_movimiento==1){//ENTRA CUANDO ES INGRESO

			 switch($subvencion){
			      case '3':
								$("#txt_monto").attr("readonly",true);
								//sep
								sumarCamposSep();
								$("#contenedor_campos_sep").removeClass("d-none");
								$("#contenedor_campos_Sc-vtf").addClass("d-none");
								break;
			      case '5':
								$("#txt_monto").attr("readonly",true);
						 	 //scvtf
						 	  $("#contenedor_campos_Sc-vtf").removeClass("d-none");
								$("#contenedor_campos_sep").addClass("d-none");
						    sumarCamposScvtf();
								break;
			      default:
								$("#txt_monto").removeAttr("readonly");
						 	 //scvtf
						 	  $("#contenedor_campos_Sc-vtf").addClass("d-none");
								$("#contenedor_campos_sep").addClass("d-none");

								break;
			 }

}else{//ENTRA CUANDO ES GASTO

		$("#txt_monto").removeAttr("readonly");
	 //scvtf
		$("#contenedor_campos_Sc-vtf").addClass("d-none");
		$("#contenedor_campos_sep").addClass("d-none");
}

muestraTotalesColegioSubvencion();

}


function valorCampoMonto(valor){
	var patron_reemplazo = /\./g ;
	valor=valor.replace(patron_reemplazo,'');
 $("#txt_monto").val(separadorMiles(valor));
}

function separadorMiles(num){

	if(!isNaN(num)){
	num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
	num = num.split('').reverse().join('').replace(/^[\.]/,'');
	return num;
}else{
	return num;
}

}

function sumarCamposSep(){

	//quita puntosa los valores
	var sep_preferente=document.getElementById('sep_preferente').value;
	var sep_preferencia=document.getElementById('sep_preferencia').value;
	var sep_concentracion=document.getElementById('sep_concentracion').value;
	var sep_articulo_19=document.getElementById('sep_articulo_19').value;
	var sep_ajustes=document.getElementById('sep_ajustes').value;

  //QUITAR PUNTOS
  var patron_reemplazo = /\./g ;

	var sep_preferente=sep_preferente.replace(patron_reemplazo,'');
	var sep_preferencia=sep_preferencia.replace(patron_reemplazo,'');
	var sep_concentracion=sep_concentracion.replace(patron_reemplazo,'');
	var sep_articulo_19=sep_articulo_19.replace(patron_reemplazo,'');
	var sep_ajustes=sep_ajustes.replace(patron_reemplazo,'');

	//Suma los campos
	var txt_monto= (Number(sep_preferente)+Number(sep_preferencia)+Number(sep_concentracion)+Number(sep_articulo_19)+Number(sep_ajustes));

  //formatea los campos con separador de miles
	// alert(separadorMiles(sep_preferente));

	document.getElementById('sep_preferente').value = separadorMiles(sep_preferente);
	document.getElementById('sep_preferencia').value = separadorMiles(sep_preferencia);
	document.getElementById('sep_concentracion').value = separadorMiles(sep_concentracion);
	document.getElementById('sep_articulo_19').value = separadorMiles(sep_articulo_19);
	document.getElementById('sep_ajustes').value = separadorMiles(sep_ajustes);

	document.getElementById('txt_monto').value=separadorMiles(txt_monto);

}
function sumarCamposScvtf(){

	var scvtf_normal=document.getElementById('scvtf_normal').value;
	var scvtf_nivelacion=document.getElementById('scvtf_nivelacion').value;

	var patron_reemplazo = /\./g ;
	var scvtf_normal=scvtf_normal.replace(patron_reemplazo,'');
	var scvtf_nivelacion=scvtf_nivelacion.replace(patron_reemplazo,'');

	var txt_monto= (Number(scvtf_normal)+Number(scvtf_nivelacion));

	document.getElementById('scvtf_normal').value = separadorMiles(scvtf_normal);
	document.getElementById('scvtf_nivelacion').value = separadorMiles(scvtf_nivelacion);

	document.getElementById('txt_monto').value=separadorMiles(txt_monto);

}

function cambiarTipoMovmiento(tipo){

 if(tipo==2){
	  $("#contenedor_tipo_gasto").removeClass("d-none");
	  $("#select_tipo_gasto").attr("required",true);
 }else{
	  $("#contenedor_tipo_gasto").addClass("d-none");
		$("#select_tipo_gasto").removeAttr("required");
 }
 cambiaSubvencion();

}


function limpiarFormulario(){
	 $("#formulario_modal_movimientos")[0].reset();
	 $("#txt_id_movimiento").val("");
}

function cargarInformacionModificarMovimientos(id){


	 var txt_numero_certificado = $("#columna_numero_certificado_"+id).html();
	 var txt_fecha_ingreso = $("#columna_fecha_ingreso_"+id).html();
	 var select_tipo_movimiento = $("#columna_id_tipo_movimiento_"+id).html();
	 var select_tipo_gasto = $("#columna_id_tipo_gasto_"+id).html();
	 var select_colegio = $("#columna_rbdcolegio_"+id).html();
	 var select_subvencion = $("#columna_id_subvencion_"+id).html();
	 var select_cuenta = $("#columna_id_numero_cuenta_"+id).html();
	 var select_estado = $("#columna_estado_mov_"+id).html();
	 var txt_descripcion = $("#columna_descripcion_"+id).html();
	 var txt_orden_compra = $("#columna_id_orden_compra_"+id).html();
	 var txt_monto = $("#columna_monto_"+id).html();
	 var sep_preferente = $("#columna_sep_preferente_"+id).html();
	 var sep_preferencia = $("#columna_sep_preferencial_"+id).html();
	 var sep_concentracion = $("#columna_sep_concentracion_"+id).html();
	 var sep_articulo_19 = $("#columna_sep_articulo_19_"+id).html();
	 var sep_ajustes = $("#columna_sep_ajustes_"+id).html();
	 var sep_total = $("#sep_total"+id).html();

	 if(select_tipo_movimiento==2){
		 $("#contenedor_tipo_gasto").removeClass("d-none");
		 $("#select_tipo_gasto").val(select_tipo_gasto);
	 }else{
		 $("#contenedor_tipo_gasto").addClass("d-none");
		 $("#select_tipo_gasto").val("");
	 }


	 if(select_subvencion==3){
		 $("#contenedor_campos_sep").removeClass("d-none");
	 }else{
		 $("#contenedor_campos_sep").addClass("d-none");
	 }
	 if(select_subvencion==5){
		$("#contenedor_campos_Sc-vtf").removeClass("d-none");
	 }else{
		$("#contenedor_campos_Sc-vtf").addClass("d-none");
	 }

	 $("#txt_id_movimiento").val(id);


	 $("#txt_numero_certificado").val(txt_numero_certificado);
	 $("#txt_fecha_ingreso").val(txt_fecha_ingreso);
	 $("#select_tipo_movimiento").val(select_tipo_movimiento);
	 $("#select_colegio").val(select_colegio);
	 $("#select_subvencion").val(select_subvencion);
	 $("#select_cuenta").val(select_cuenta);
	 $("#select_estado").val(select_estado);
	 $("#txt_descripcion").val(txt_descripcion);
	 $("#txt_orden_compra").val(txt_orden_compra);
	 $("#txt_monto").val(txt_monto);
	 $("#sep_preferente").val(sep_preferente);
	 $("#sep_preferencia").val(sep_preferencia);
	 $("#sep_concentracion").val(sep_concentracion);
	 $("#sep_articulo_19").val(sep_articulo_19);
	 $("#sep_ajustes").val(sep_ajustes);
	 $("#sep_total").val(sep_total);

	 $('html,body').animate({
     scrollTop: $("#contenedor_formulario_movimientos").offset().top
	 }, 1200);

   muestraTotalesColegioSubvencion();
}



function eliminarMovimientos(id){

	swal({
    title: "Desea eliminar registro?",
    text: "No podrá recuperar los datos.",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Si, eliminar!",
    cancelButtonText: "No, conservar",
    closeOnConfirm: false
  },
  function(){

			$.ajax({
				url:"./metodos_ajax/movimientos/eliminar_movimiento.php?id="+id,
				method:"POST",
				success:function(respuesta){
					 // alert(respuesta);

						 if(respuesta==1){
							 swal("Guardado","Los datos se han guardado correctamente.","success");
							 mostrarListadoMovimientos("");
						 }else if(respuesta==2){
							 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
						 }
				}
			});

  });


}
