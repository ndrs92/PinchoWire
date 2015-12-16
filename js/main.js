//filtra la tabla de usuarios de administracion, de modo que 
//cada vez que se pulsa una tecla desaparezcan los campos que no
//contienen valores iguales al buscado. No es case sensitive
function filterAdminUsers(){
	var filtro = $('#filter').val();
	var $status = false;

	$(".row-to-filter").each(function(){
		$status = false;
		$(this).find(".data-to-filter").each(function(){
			if($(this).html().toLowerCase().indexOf(filtro.toLowerCase()) >= 0){
				$status = true;
			}
		});

		if($status == false){
			$(this).hide();
		}else{
			$(this).show();

		}


	});

}