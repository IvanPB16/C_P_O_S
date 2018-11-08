<?php 
   
class ControladorVentas{ 
	static public function ctrMostrarVentas($item,$valor){
		$tabla = "venta";

		$respuesta = ModeloVentas::mdlMostrarVentas($tabla,$item,$valor);

		return $respuesta;
	}

	static public function ctrCrearVenta(){
		if (isset($_POST["nuevaVenta"])) {
			/*Actualizar las compras del cliente y reducir el stock */
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
						    "metodo_pago" => $_POST["listaMetodoPago"],
						    "idVendedor" => $_POST["idVendedor"],
						    "idCliente" => $_POST["seleccionarCliente"]
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

			/*verificar productos editados*/
			if ($_POST["listaProductos"] == "") {

				$listaProductos = $traerVenta["producto"];
				$cambioProducto = false;
			}else{
				$listaProductos = $_POST["listaProductos"];
				$cambioProducto = true;
			}

			if ($cambioProducto) {
				
				$productos = json_decode($traerVenta["producto"],true);

				foreach ($productos as $key => $value) {
					$tablaProductos = "producto";

					$item = "id";
					$valor = $value["id"];

					$traerProducto = ModeloProducto::mdlMostrarProducto($tablaProductos,$item,$valor);

					$item1a = "stock";
					$valor1a = $value["cantidad"] + $traerProducto["stock"];

					$nuevoStock = ModeloProducto::MdlActualizarProducto($tablaProductos,$item1a,$valor1a,$valor);
				}



				/*Actualizar las compras del cliente y reducir el stock y alimentar las ventas de los productos*/
				$listarProductos2 = json_decode($listaProductos,true);

				foreach ($listarProductos2 as $key => $value) {
					$tablaProductos2 = "producto";
					$item2 = "id";
					$valor2 = $value["id"];

					$traerProducto2 = ModeloProducto::mdlMostrarProducto($tablaProductos2,$item2,$valor2);

					$item1a2 = "stock";
					$valor1a2 = $value["stock"];
					$modificarStock2 = ModeloProducto::MdlActualizarProducto($tablaProductos2,$item1a2,$valor1a2,$valor2);
				}
			}
			/*guardar cambios de la compra*/
			
			$data =  array( "codigo" => $_POST["editarVenta"],
						    "productos" => $listaProductos,
						    "impuesto" => $_POST["nuevoPrecioImpuesto"],
	 					    "neto" => $_POST["nuevoPrecioNeto"],
						    "total" => $_POST["totalVenta"],
						    "metodo_pago" => $_POST["listaMetodoPago"],
						    "idVendedor" => $_POST["idVendedor"],
						    "idCliente" => $_POST["seleccionarCliente"]
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

	static public function ctrsumaTotalVentas(){
		$tabla="venta";
		$respuesta = ModeloVentas::mdlSumaTotalVentas($tabla);
		return $respuesta;
	}

	static public function ctrRangoFechaVentas($fechaInicial,$fechaFinal){

		$tabla="venta";
		$resultado = ModeloVentas::mdlRangoFechaVenta($tabla,$fechaInicial,$fechaFinal);

		return $resultado;
	}

	static public function ctrDescargarReporte(){
		$tabla = "venta";

		if (isset($_GET["fechaInicial"])&& isset($_GET["fechaFinal"])) {

			$venta = ModeloVentas::mdlRangoFechaVenta($tabla,$_GET["fechaInicial"],$_GET["fechaFinal"]);	
		}else{
			$item = null;
			$valor = null;
			$venta = ModeloVentas::mdlMostrarVentas($tabla,$item,$valor);
		}

		/*Crear el archivo de Excel*/
		#se le coloca el nombre al archivo
		$Name = $_GET["reporte"].'.xls';
		header('Expires:0');
		header('Cache-Control: private');
		header("Content-type:application/vnd.ms-excel");
		header("Cache-Control: cache,must-revalidate");
		header('Content-Description: File Transfer');
		header('Last-Modified:'.date('D,d M Y H:i:s'));
		header("Pragma: public");
		header('Content-Disposition: filename="'.$Name.'"');
		header("Content-Transfer-Encoding:binary");

		echo utf8_decode("<table border='0'>
							<tr>
								<td style='font-weight:bold; border:1px solid #eee;'>Código</td>
								<td style='font-weight:bold; border:1px solid #eee;'>Vendedor</td>
								<td style='font-weight:bold; border:1px solid #eee;'>Cantidad</td>
								<td style='font-weight:bold; border:1px solid #eee;'>Productos</td>
								<td style='font-weight:bold; border:1px solid #eee;'>Impusto</td>
								<td style='font-weight:bold; border:1px solid #eee;'>Subtotal</td>
								<td style='font-weight:bold; border:1px solid #eee;'>Total</td>
								<td style='font-weight:bold; border:1px solid #eee;'>Forma de pago</td>
								<td style='font-weight:bold; border:1px solid #eee;'>Fecha</td>
							</tr>");

						foreach ($venta as $row => $item) {
							$vendedor = ControladorUsuarios::ctrMostrarUsuario("id",$item["id_vendedor"]);
						echo utf8_decode("<tr>
										<td style='border:1px solid #eee'>".$item["codigo_venta"]."</td>
									   	<td style='border:1px solid #eee'>".$vendedor["nombre"]."</td>
									   	<td style='border:1px solid #eee'>");

						$productos = json_decode($item["producto"],true);

						foreach ($productos as $key => $valueProductos) {
							echo utf8_decode($valueProductos["cantidad"]."<br>");
						}

							echo utf8_decode("</td>
										<td style='border:1px solid #eee'>");
						foreach ($productos as $key => $valueProductos) {
							echo utf8_decode($valueProductos["descripcion"]."<br>");
						}
						echo utf8_decode("</td>
										<td style='border:1px solid #eee'>$".number_format($item["impuesto"],2)."</td>
										<td style='border:1px solid #eee'>$".number_format($item["subtotal"],2)."</td>
										<td style='border:1px solid #eee'>$".number_format($item["total"],2)."</td>
										<td style='border:1px solid #eee'>".$item["metodo_pago"]."</td>
										<td style='border:1px solid #eee'>".substr($item["fecha"],0,10)."</td>

										</tr>");

							
						}
						echo "</table>";
	}

} 
 