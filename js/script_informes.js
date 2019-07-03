
function generarInforme(){
		$.ajax({
			url:"./metodos_ajax/informes/mostrar_informe.php?",
			data: $("#formulario_informe").serialize(),
			method:"POST",
			success:function(respuesta){
				 $("#contenedor_informe").html(respuesta);
			}
		});
}


function mostrarOcultarOpciones(select_tipo_informe){

   if(select_tipo_informe==1){
		 $("#contenedor_opciones_informe_detallado").addClass("d-none");
	 }else if(select_tipo_informe==2){
		 $("#contenedor_opciones_informe_detallado").removeClass("d-none");
	 }

}
