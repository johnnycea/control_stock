
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
