/* Editar categorias */
 
$(".btnEditarCategoria").click(function(){
	var idCategoria = $(this).attr("idCategoria");

	var datos = new FormData();

	datos.append("idCategoria",idCategoria);

	$.ajax({
		url: "ajax/categorias.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData:false,
		dataType:"json",
		success:function(respuesta){
			
			console.log(respuesta["id"]);
			$("#editarCategoria").val(respuesta["nombre"]);
			$("#idCategoria").val(respuesta["id"]);
			
		}

	})
})

/* Borrar categoría */

$(".btnBorrarCategoria").click(function(){
	var idCategoria = $(this).attr("idCategoria");

	swal({
			title:'¿Estas seguro de borrar la categoría?',
			text: "Si no lo está puede cancelar la acción",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3885d6',
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Borrar categoría'
		}).then((result)=>{
			if (result.value) {
				window.location = "index.php?ruta=categorias&idCategoria="+idCategoria;
			}
		})
	
})

/* Validar categoria */

$("#nuevaCategoria").change(function(){
	
	$(".alert").remove();

	var categoria = $(this).val();
	var datos = new FormData();

	datos.append("validarCategoria",categoria);

	$.ajax({
		url: "ajax/categorias.ajax.php",
		method:"POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){
			if (respuesta) {
		
				$("#nuevaCategoria").parent().after('<div class="alert alert-warning">La categoría ya existe en la base de datos.</div>');
				$("#nuevaCategoria").val("");
			}
		} 
	})

})

