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

	$("#promof_uno").val(fechaInicial);
	$("#promof_dos").val(fechaFinal);
  });
});

/*agregar producto de la tabla*/
$(".dtPromocion tbody").on("click",'button.addProducto',function(){
	
	var idProducto = $(this).attr("idProducto");

	$(this).removeClass("btn-primary addProducto");
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
			                '<input type="text" class="form-control PProducto" idProducto="'+idProducto+'" name="nuevoProductop" value="'+descripcion+'" readonly required>'+
		                '</div>'+
	           		 '</div>'+
	            '</div>'
	         )
		enlistarProducto();

		localStorage.removeItem("quitar");
		}

	})

});

/*Agregar producto de dispositivo*/
var contProducto = 0;
$(".btnAdd").click(function(){
	contProducto ++;

	var dato = new FormData();
	dato.append("traerProducto","ok");

	$.ajax({
		url:"ajax/productos.ajax.php",
		method:"POST",
		data:dato,
		cache:false,
		contentType:false,
		processData:false,
		dataType:"json",
		success:function(respuesta){
			console.log(respuesta);
			$(".Productos").append(
				'<div class="row" style="padding:5px 15px">'+
					'<div class="col-xs-6" style="padding-right:0px">'+
		             	'<div class="input-group">'+
			                '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitar" idProducto><i class="fa fa-times"></i></button></span>'+
			               '<select class="form-control PProducto" id="producto'+contProducto+'" idProducto name="nuevoProductop" required>'+

			                '<option>Selecciona un producto</option>'+
			                '</select>'+

		                '</div>'+
	           		 '</div>'+
	            '</div>'

	            );

			respuesta.forEach(funcionRe);
			function funcionRe(item,index){
				if(item.stock != 0){
					$("#producto"+contProducto).append(	
						'<option idProducto="'+item.id+'" value="'+item.descripcion+'">'+item.descripcion+'</option>'

						)
				}
			}
		}

	})
})

$(".form_promocion").on('change','select.PProducto',function(){
	var nombre = $(this).val();
	var pProducto = $(this).parent().parent().parent().children().children().children(".PProducto");

	var dato = new FormData();
	dato.append("nombreProducto",nombre);

	$.ajax({
		url:"ajax/productos.ajax.php",
      	method: "POST",
      	data: dato,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(res){
      		console.log(res);
      		$(pProducto).attr("idProducto", res["id"]);



      		//agrupar productos json
			enlistarProducto();
      	}

	})
})

/*lista los producto*/
function enlistarProducto(){
	var listadoPProductos = [];
	var descripcionPP = $(".PProducto");

	for (var i = 0; i < descripcionPP.length; i++) {
		listadoPProductos.push({
			"id":$(descripcionPP[i]).attr("idProducto"),
			"descripcion":$(descripcionPP[i]).val()
		});
		
	}
	$("#productos").val(JSON.stringify(listadoPProductos));
}

/*Cuando cargue la tabla y se navegue en ella*/
$(".dtPromocion").on('draw.dt',function(){
	if (localStorage.getItem("quitar") != null) {
		var listaridPP = JSON.parse(localStorage.getItem("quitar"));
			for (var i = 0; i < listaridPP.length; i++) {
				$("button.recuperar[idProducto = '"+listaridPP[i]["idProducto"]+"']").removeClass('btn-default');
				$("button.recuperar[idProducto = '"+listaridPP[i]["idProducto"]+"']").addClass('btn-primary addProducto');
			}
		}
})


/*quitar productos*/
var IdquitarProductos = [];
$(".form_promocion").on('click','button.quitar',function(){
	
	 $(this).parent().parent().parent().parent().remove();

	 var idProducto = $(this).attr("idProducto");

	if (localStorage.getItem("quitar") == null) {
		IdquitarProductos = [];
	}else {
		IdquitarProductos.concat(localStorage.getItem("quitar"));
	}

	IdquitarProductos.push({"idProducto":idProducto});
	console.log("quitar productos",IdquitarProductos);

	localStorage.setItem("quitar", JSON.stringify(IdquitarProductos));

	$("button.recuperar[idProducto = '"+idProducto+"']").removeClass('btn-default');
	$("button.recuperar[idProducto = '"+idProducto+"']").addClass('btn-primary addProducto');
	enlistarProducto();

})

function quitaroAgregarProducto(){
	var idProducto = $(".quitar");
	var btnT = $(".dtPromocion tbody button.addProducto");

	for (var i = 0; i < idProducto.length; i++) {
		var boton = $(idProducto[i]).attr("idProducto");

		for (var j = 0; j < btnT.length; j++) {
			if ($(btnT[j]).attr("idProducto") == boton) {
				$(btnT[j]).removeClass("btn-primary addProducto");
				$(btnT[j]).addClass("btn-default");
			}
		}
	}
}

$(".dtPromocion").on('draw.dt',function(){
	quitaroAgregarProducto();
});

/*Cuando cargue la tabla y se navegue en ella*/
$(".dtPromocion").on('draw.dt',function(){
	if (localStorage.getItem("quitar") != null) {
		var listaridPP = JSON.parse(localStorage.getItem("quitar"));
			for (var i = 0; i < listaridPP.length; i++) {
				$("button.recuperar[idProducto = '"+listaridPP[i]["idProducto"]+"']").removeClass('btn-default');
				$("button.recuperar[idProducto = '"+listaridPP[i]["idProducto"]+"']").addClass('btn-primary addProducto');
			}
		}
})

$(".tablas").on("click",".btnEditPromo",function(){
	var idPromo = $(this).attr("idPromo");
	window.location = "index.php?ruta=editar-promocion&idPromo="+idPromo;
});

$(".tablas").on("click",".btnDeletePromo",function(){
	
	var idPromo = $(this).attr("idPromo");
	console.log(idPromo)
	swal({
        title: '¿Está seguro de borrar la venta?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar venta!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=promociones&idPromo="+idPromo;
        }

  })
	
});
