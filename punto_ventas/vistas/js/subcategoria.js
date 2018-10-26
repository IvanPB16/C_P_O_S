/* Editar subcategorias */

$(document).on("click",".btnEditarSub",function(){
	 var idsc = $(this).attr("idsc");
	 var nom = $(this).attr("nombre");
	$("#editarSubCategoria").val(nom);
	$("#idsc").val(idsc);
	$("#modalEditSubCategorias").modal("toggle");
	$("#modalEditSubCategorias").modal("show");
})

$("#editarSubCategoria").change(function(){
	var sc =$("#editarSubCategoria").val();
	var sn = $("#idsc").val();
	
	$("#nuevoValor").val(sc);	
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