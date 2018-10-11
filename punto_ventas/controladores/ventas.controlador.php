<?php 
 
class ControladorVentas{ 
	static public function ctrMostrarVentas($item,$valor){
		$tabla = "venta";

		$respuesta = ModeloVentas::mdlMostrarVentas($tabla,$item,$valor);

		return $respuesta;
	}

	static public function ctrCrearVenta(){
		if (isset($_POST["nuevaVenta"])) {
			/*Actualizar las compras del cliente y reducir el stock y alimentar las ventas de los productos*/
			$listarProductos = json_decode($_POST["listaProductos"],true);

			foreach ($listarProductos as $key => $value) {
				
				$tablaProductos = "producto";
				$item = "id";
				$valor = $value["id"];

				$traerProducto = ModeloProducto::mdlMostrarProducto($tablaProductos,$item,$valor);

				$item1a = "stock";
				$valor1a = $value["stock"];
				$modificarStock = ModeloProducto::MdlActualizarProducto($tablaProductos,$item1a,$valor1a,$valor);
			}
			/*guardar compra*/
			$tabla = "venta";

			$data =  array( "codigo" => $_POST["nuevaVenta"],
						    "productos" => $_POST["listaProductos"],
						    "impuesto" => $_POST["nuevoPrecioImpuesto"],
	 					    "neto" => $_POST["nuevoPrecioNeto"],
						    "total" => $_POST["totalVenta"],
						    "metodo_pago" => $_POST["nuevoMetodoPago"],
						    "idVendedor" => $_POST["idVendedor"]
							);

			$enviar = ModeloVentas::mdlAgregarVentas($tabla,$data);
				if ($enviar == "ok") {
					echo '<script>
							localStorage.removeItem("rango");
							swal({
								type: "success",
								title:"venta realziada",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: true
								}).then((result)=>{
									if(result.value){
									window.location = "ventas";
									}
								})
						  </script>';
				}
		}
	}

	static public function ctrEditarVenta(){
		if (isset($_POST["editarVenta"])) {
			/*Formatear tabla de productos*/
			$tabla = "venta";

			$item = "codigo_venta";
			$valor = $_POST["editarVenta"];

			$traerVenta = ModeloVentas::mdlMostrarVentas($tabla,$item,$valor);

			$productos = json_decode($traerVenta["producto"],true);

			var_dump($productos);
			foreach ($productos as $key => $value) {
				$tablaProductos = "producto";

				$item = "id";
				$valor = $value["id"];

				$traerProducto = ModeloProducto::mdlMostrarProducto($tablaProductos,$item,$valor);

				$item1a = "stock";
				$valor1a = $value["cantidad"] + $traerProducto["stock"];

				$modificarStock = ModeloProducto::MdlActualizarProducto($tablaProductos,$item1a,$valor1a,$valor);
			}



			/*Actualizar las compras del cliente y reducir el stock y alimentar las ventas de los productos*/
			$listarProductos2 = json_decode($_POST["listaProductos"],true);

			foreach ($listarProductos2 as $key => $value) {
				
				
				$item2 = "id";
				$valor2 = $value["id"];

				$traerProducto2 = ModeloProducto::mdlMostrarProducto($tablaProductos,$item,$valor);

				$item1a2 = "stock";
				$valor1a2 = $value["stock"];
				$modificarStock = ModeloProducto::MdlActualizarProducto($tablaProductos,$item1a,$valor1a,$valor);
			}
			/*guardar cambios de la compra*/
			
			$data =  array( "codigo" => $_POST["editarVenta"],
						    "productos" => $_POST["listaProductos"],
						    "impuesto" => $_POST["nuevoPrecioImpuesto"],
	 					    "neto" => $_POST["nuevoPrecioNeto"],
						    "total" => $_POST["totalVenta"],
						    "metodo_pago" => $_POST["nuevoMetodoPago"],
						    "idVendedor" => $_POST["idVendedor"]
							);

			$enviar = ModeloVentas::mdlEditarVentas($tabla,$data);
				if ($enviar == "ok") {
					echo '<script>
							localStorage.removeItem("rango");
							swal({
								type: "success",
								title:"venta ha sido editada",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: true
								}).then((result)=>{
									if(result.value){
									window.location = "ventas";
									}
								})
						  </script>';
				}
		}
	}

	static public function ctrEliminarVenta(){
	if (isset($_GET["idVenta"])) {
			$tabla = "venta";

			$item ="id";
			$valor = $_GET["idVenta"];

			$traerVenta = ModeloVentas::mdlMostrarVentas($tabla,$item,$valor);

			$productos = json_decode($traerVenta["producto"],true);

			foreach ($productos as $key => $value) {
				$tablaProductos = "producto";

				$item = "id";
				$valor = $value["id"];

				$traerProducto = ModeloProducto::mdlMostrarProducto($tablaProductos,$item,$valor);

				$item1a = "stock";
				$valor1a = $value["cantidad"] + $traerProducto["stock"];

				$modificarStock = ModeloProducto::MdlActualizarProducto($tablaProductos,$item1a,$valor1a,$valor);
			}

			$respuesta = ModeloVentas::mdlEliminarVenta($tabla,$_GET["idVenta"]);

			if ($respuesta == "ok") {
					echo '<script>
							swal({
								type: "success",
								title:"venta eliminada",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: true
								}).then((result)=>{
									if(result.value){
									window.location = "ventas";
									}
								})
						  </script>';
				}


		}	
	}
} 
 