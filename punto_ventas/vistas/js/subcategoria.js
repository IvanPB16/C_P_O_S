/* Editar subcategorias */

$(".btnEditarSubCategoria").click(function(){

	var idSub = $(this).attr("idSub");
	var nombre = $("#ayuda").val();
	console.log(idSub);
	console.log(nombre);

	var datos = new FormData();

	datos.append("idSub",idSub);

	$.ajax({
		url: "ajax/subcategoria.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData:false,
		dataType:"json",
		success:function(respuesta){
			console.log("res",respuesta);
		}
	})
})

/*Borrar subcategoria*/
$(document).on("click",".btnEliminarSub",function(){
	var idSub = $(this).attr("idSub");
	swal({
			title:'¿Estas seguro de borrar la subcategoría?',
			text: "Si no lo está puede cancelar la acción",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3885d6',
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Borrar subcategoría'
		}).then((result)=>{
			if (result.value) {
				window.location = "index.php?ruta=subcategorias&idSub="+idSub;
			}
		})
})