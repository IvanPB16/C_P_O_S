$(".dtPromocion").DataTable({
	"ajax":"ajax/dtpromocion.ajax.php",
	"deferRender":true,
	"retrieve":true,
	"processing":true,
	"language":{
						 "sProcessing":     "Procesando...",
						"sLengthMenu":     "Mostrar _MENU_ registros",
						"sZeroRecords":    "No se encontraron resultados",
						"sEmptyTable":     "Ningún dato disponible en esta tabla",
						"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
						"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
						"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
						"sInfoPostFix":    "",
						"sSearch":         "Buscar:",
						"sUrl":            "",
						"sInfoThousands":  ",",
						"sLoadingRecords": "Cargando...",
						"oPaginate": {
						"sFirst":    "Primero",
						"sLast":     "Último",
						"sNext":     "Siguiente",
						"sPrevious": "Anterior"
						},
						"oAria": {
							"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
							"sSortDescending": ": Activar para ordenar la columna de manera descendente"
						}

	}
});

$(function() {
  $('input[name="daterange"]').daterangepicker({
    opens: 'right',
    startDate: moment(),
    endDate  : moment()
  }, function(start, end, label) {
    var fechaInicial = start.format("YYYY-MM-DD");
	  
	var fechaFinal = end.format("YYYY-MM-DD");

	console.log(fechaInicial);
	console.log(fechaFinal);
  });
});

$("#ayuda").on('click','input:checkbox:checked',function(){
	// var id = $(this).val();
	// console.log(id);
	seleccionar(this.form,'check[]');

})

function seleccionar(f,valor){
	var todos = [];
	for (var i = 0, total = f[valor].length; i < total ; i++) {
		if (f[valor].checked) {
			todos[todos.length] = f[valor][i].value;
			return todos.join(".");
		}
	}
	console.log(todos);
}

/*agregar producto de la tabla*/
$(".dtPromocion tbody").on("click",'button.addProducto',function(){
	
	var idProducto = $(this).attr("idProducto");

	$(this).removeClass("btn-primary agregarProducto");
	$(this).addClass("btn-default");

	var dato = new FormData();

	dato.append("idProducto",idProducto);

	$.ajax({
		url:"ajax/productos.ajax.php",
		method:"POST",
		data:dato,
		cache:false,
		contentType:false,
		processData:false,
		dataType:"json",
		success:function(respuesta){
			var codigo = respuesta["codigo"];
			var descripcion = respuesta["descripcion"];
		

		$(".Productos").append(
				'<div class="row" style="padding:5px 15px">'+
					'<div class="col-xs-6" style="padding-right:0px">'+
					   	'<div class="input-group">'+
			                '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitar" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button></span>'+
			                '<input type="text" class="form-control " idProducto="'+idProducto+'" name="" value="'+descripcion+'" readonly required>'+
		                '</div>'+
	           		 '</div>'+
	            '</div>'
	            )
		}

	})

});

$("#ayuda").on('click','button.quitar',function(){
	//se elimna las etiquetas
	$(this).parent().parent().parent().parent().parent().remove();
	//capturamos el id del producto
	var idProducto = $(this).attr("idProducto");

	/*Almacenar el id de producto a quitar*/
	// if (localStorage.getItem("quitarProducto") == null) {
	// 	idQuitarProducto = [];
	// }else{
	// 	idQuitarProducto.concat(localStorage.getItem("quitarProducto"))
	// }
	// idQuitarProducto.push({"idProducto":idProducto});

	// localStorage.setItem("quitarProducto",JSON.stringify(idQuitarProducto));

	//recuperamos el boton
	$("button.recuperar[idProducto = '"+idProducto+"']").removeClass('btn-default');
	$("button.recuperar[idProducto = '"+idProducto+"']").addClass('btn-primary agregarProducto');
	
})