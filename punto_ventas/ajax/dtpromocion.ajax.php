<?php
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

class dtPromocion{
	public function mostrardtProductos(){
		$item = null;
		$valor = null;

		$mostrar = ControladorProducto::ctrMostrarProducto($item,$valor);
		$datosJSON='{
					"data":[';
						for($i = 0; $i<count($mostrar);$i++){
						$botonAdd = "<div class='btn-group'><button class='btn btn-primary addProducto  recuperar' idProducto='".$mostrar[$i]["id"]."'>Agregar</button></div>";
							$datosJSON.='[
										"<td>'.$mostrar[$i]["codigo"].'</td>",
	 									"<td>'.$mostrar[$i]["descripcion"].'</td>",
	 									"<td>'.$botonAdd.'</td>"
										],';
						}
						$datosJSON = substr($datosJSON,0,-1);
						$datosJSON.=']	
					}';
		echo $datosJSON;
	}
}

$mostrar = new dtPromocion();
$mostrar -> mostrardtProductos();