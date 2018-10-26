<?php  
 
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";
 
class TablaProductos{

	 public function mostrarTabla(){

	 	$item = null;
	 	$valor = null;

	 	$productos = ControladorProducto::ctrMostrarProducto($item,$valor);

	 	echo '{
	 			"data":[';
	 			#i es igual a 0, i debe ser menor que el arreglo productos menos 1 e i se incrementa en 1
	 			for($i = 0; $i<count($productos)-1;$i++){

	 				$item="id";
	 				$valor = $productos[$i]["id_categoria"];

	 				$categorias = ControladorCategorias::ctrMostrarCategorias($item,$valor);
	 				if ($productos[$i]["stock"] <= 10) {
	 					$stock = "<button class='btn btn-danger'>".$productos[$i]["stock"]."</button>";
	 				}else if ($productos[$i]["stock"] > 10 && $productos[$i]["stock"] <= 15) {
	 					$stock = "<button class='btn btn-warning'>".$productos[$i]["stock"]."</button>";
	 				}else{
	 					$stock = "<button class='btn btn-success'>".$productos[$i]["stock"]."</button>";
	 				}
	 				echo '[
	 					"'.($i+1).'",
	 					"'.$productos[$i]["imagen"].'",
	 					"'.$productos[$i]["codigo"].'",
	 					"'.$productos[$i]["descripcion"].'",
	 					"'.$categorias["nombre"].'",
	 					"'.$stock.'",
	 					"$'.number_format($productos[$i]["precio_compra"],2).'",
	 					"$'.number_format($productos[$i]["precio_venta"],2).'",
	 					"'.$productos[$i]["fecha"].'",
	 					"'.$productos[$i]["id"].'" 
	 					],';

	 			}

	 			$item="id";
	 			$valor = $productos[count($productos)-1]["id_categoria"];

	 				$categorias = ControladorCategorias::ctrMostrarCategorias($item,$valor);

	 				if ($productos[count($productos)-1]["stock"] <= 10) {
	 					$stock = "<button class='btn btn-danger'>".$productos[count($productos)-1]["stock"]."</button>";
	 				}else if ($productos[count($productos)-1]["stock"] > 10 && $productos[$i]["stock"] <= 15) {
	 					$stock = "<button class='btn btn-warning'>".$productos[count($productos)-1]["stock"]."</button>";
	 				}else{
	 					$stock = "<button class='btn btn-success'>".$productos[count($productos)-1]["stock"]."</button>";
	 				}

	 			echo'	[
	 					"'.count($productos).'",
	 					"'.$productos[count($productos)-1]["imagen"].'",
	 					"'.$productos[count($productos)-1]["codigo"].'",
	 					"'.$productos[count($productos)-1]["descripcion"].'",
	 					"'.$categorias["nombre"].'",
	 					"'.$stock.'",
	 					"$'.number_format($productos[count($productos)-1]["precio_compra"],2).'",
	 					"$'.number_format($productos[count($productos)-1]["precio_venta"],2).'",
	 					"'.$productos[count($productos)-1]["fecha"].'",
	 					"'.$productos[count($productos)-1]["id"].'" 
	 					]
	 				]

	 		}';
	 }

}  


$activar = new TablaProductos();
$activar -> mostrarTabla();