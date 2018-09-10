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
	 				echo '[
	 					"'.($i+1).'",
	 					"'.$productos[$i]["imagen"].'",
	 					"'.$productos[$i]["codigo"].'",
	 					"'.$productos[$i]["descripcion"].'",
	 					"'.$categorias["nombre"].'",
	 					"'.$productos[$i]["stock"].'",
	 					"$'.number_format($productos[$i]["precio_compra"],2).'",
	 					"$'.number_format($productos[$i]["precio_venta"],2).'",
	 					"'.$productos[$i]["fecha"].'",
	 					"'.$productos[$i]["id"].'" 
	 					],';

	 			}

	 			$item="id";
	 			$valor = $productos[count($productos)-1]["id_categoria"];

	 				$categorias = ControladorCategorias::ctrMostrarCategorias($item,$valor);
	 			echo'	[
	 					"'.count($productos).'",
	 					"'.$productos[count($productos)-1]["imagen"].'",
	 					"'.$productos[count($productos)-1]["codigo"].'",
	 					"'.$productos[count($productos)-1]["descripcion"].'",
	 					"'.$categorias["nombre"].'",
	 					"'.$productos[count($productos)-1]["stock"].'",
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