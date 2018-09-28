/*tabla dinamamica*/
 
var tabla_ventas = $(".tablaVentas").DataTable({
	"ajax":"ajax/dtventas.ajax.php",
	"columnDefs":[
				 {
				 	"targets":-2,
				 	"data":null,
				 	"defaultContent":'<div class="btn-group"><button class="btn btn-success limitestock" ></button></div>'
				 },
				 {
				 	"targets":-1,
				 	"data":null,
				 	"defaultContent":'<div class="btn-group"><button class="btn btn-primary agregarProducto recuperar" idProducto>Agregar</button></div>'
				 }
				],
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

}) 

/*activar boton*/

$(".tablaVentas").on('click','button.agregarProducto',function(){

	//se hace recorrido en sus filas saliendo al tr y tomar toda la linea data 
	var data = tabla_ventas.row($(this).parents('tr')).data();

	//para colocar al idProducto el indice 5
	$(this).attr("idProducto",data[4]);
})

function mostrarLimiteStock(){

	var limitestock = $(".limitestock");
	for(var i=0; i < limitestock.length;i++){

		var data = tabla_ventas.row($(limitestock[i]).parents('tr')).data();
	
		if (data[3] <= 10) {

			$(limitestock[i]).addClass("btn-success");
			$(limitestock[i]).html(data[3]);

		}else if(data[3] > 11 && data[3]  <= 15){

			$(limitestock[i]).addClass("btn-warning");
			$(limitestock[i]).html(data[3]);

		}else{

			$(limitestock[i]).addClass("btn-success");
			$(limitestock[i]).html(data[3]);
		}
	}
}


setTimeout(function(){
mostrarLimiteStock();
},300)

$(".dataTables_paginate").click(function(){

	mostrarLimiteStock();
})

$("input[aria-controls='DataTables_Table_0']").focus(function(){
	$(document).keyup(function(event){

		event.preventDefault();

		mostrarLimiteStock();
	})
})

/* Cargar imagenes con el filtro de cantidad */

$("select[name='DataTables_Table_0_length']").change(function(){
	mostrarLimiteStock();
})

/*cargar imagenes con ordenar*/

$(".sorting").click(function(){
	mostrarLimiteStock();
})

/*agregar productos desde tablas*/

$(".tablaVentas").on('click','button.agregarProducto',function(){

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
			var descripcion = respuesta["descripcion"];
			var stock = respuesta["stock"];
			var precio = respuesta["precio_venta"];

			$(".nuevoProducto").append(
				'<div class="row" style="padding:5px 15px">'+
					'<div class="col-xs-6" style="padding-right:0px">'+
		             	'<div class="input-group">'+
			                '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button></span>'+
			                '<input type="text" class="form-control" id="agregarProducto" name="agregarProducto" value="'+descripcion+'"  readonly required>'+
		                '</div>'+
	           		 '</div>'+

		           	'<div class="col-xs-3">'+
		                '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" required>'+
	            	'</div>'+
	                     
		            '<div class="col-xs-3 ingresoPrecio" style="padding-left: 0px">'+
		             	'<div class="input-group">'+
		                  	'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+               
		                    '<input type="number" min="1" class="form-control nuevoPrecioProducto" name="nuevoPrecioProducto" value="'+precio+'" precioReal="'+precio+'" required readonly>'+
						'</div>'+
		            '</div>'+
	            '</div>'
	            );
		}

	})


});
/*quitar productos*/

$(".formularioVenta").on('click','button.quitarProducto',function(){

	$(this).parent().parent().parent().parent().remove();

	var idProducto = $(this).attr("idProducto");

	$("button.recuperar[idProducto = '"+idProducto+"']").removeClass('btn-default');
	$("button.recuperar[idProducto = '"+idProducto+"']").addClass('btn-primary agregarProducto');


})

/*Agregado productos desde dispositios*/

$(".btnAgregarProducto").click(function(){
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
			$(".nuevoProducto").append(
				'<div class="row" style="padding:5px 15px">'+
					'<div class="col-xs-6" style="padding-right:0px">'+
		             	'<div class="input-group">'+
			                '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto><i class="fa fa-times"></i></button></span>'+
			               '<select class="form-control nuevaDescripcionProducto" idProducto name="nuevaDescripcionProducto" required>'+

			                '<option>Selecciona un producto</option>'+
			                '</select>'+

		                '</div>'+
	           		 '</div>'+

		           	'<div class="col-xs-3 ingresaCantidad">'+
		                '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock required>'+
	            	'</div>'+
	                     
		            '<div class="col-xs-3 ingresoPrecio" style="padding-left: 0px">'+
		             	'<div class="input-group">'+
		                  	'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+               
		                    '<input type="number" min="1" class="form-control nuevoPrecioProducto" name="nuevoPrecioProducto" precioReal readonly required>'+
						'</div>'+
		            '</div>'+
	            '</div>'
	            );
			respuesta.forEach(funcionFor);

			function funcionFor(item,index){
				$(".nuevaDescripcionProducto").append(	
					'<option idProducto="'+item.id+'" value="'+item.descripcion+'">'+item.descripcion+'</option>'
					)
			}

		}
	})
})

/*Selecionar producto*/
$(".formularioVenta").on("change","select.nuevaDescripcionProducto",function(){
	var nombreProducto = $(this).val();

	var nuevoPrecioProducto = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
	var nuevaCantidadProducto = $(this).parent().parent().parent().children(".ingresaCantidad").children(".nuevaCantidadProducto");
	console.log(nuevaCantidadProducto);
	

	var dato = new FormData();
	dato.append("nombreProducto",nombreProducto);
	$.ajax({
		url:"ajax/productos.ajax.php",
      	method: "POST",
      	data: dato,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(res){
      		$(nuevaCantidadProducto).attr("stock",res["stock"]);
      		$(nuevoPrecioProducto).val(res["precio_venta"]);
      		$(nuevoPrecioProducto).attr("precioReal",res["precio_venta"]);
      	}

	})


})

/*modificar cantidad producto*/

$(".formularioVenta").on("change","input.nuevaCantidadProducto",function(){

	//se ingresa al value del input nuevoPrecio
	var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
	//se multiplica el valor de la cantidad por el valor del precio
	var precioFinal = $(this).val() * precio.attr("precioReal");

	precio.val(precioFinal);

	if (Number($(this).val()) > Number($(this).attr("stock"))) {
		$(this).val(1); 
		swal({
			title:"La cantidad supera el Stock",
			text: "Solo hay en exitencia "+ $(this).attr("stock") + "unidades",
			type:"warning",
			confirmButtonText:"!Cerrar¡"
		});
	}
	
})