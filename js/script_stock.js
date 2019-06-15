listarStockIngresos();

function listarStockIngresos(){

		$.ajax({
			url:"./metodos_ajax/stock/mostrar_stock.php?",
			method:"POST",
			success:function(respuesta){
				// alert(respuesta);
				 $("#contenedor_stock_ingresos").html(respuesta);
			}
		});
}
