<?php 
class ControladorPlantilla{

	static public function ctrlPlantilla(){
		include "vistas/plantilla.php";
	}

	static public function controlRuta(){
		if (isset($_GET['ruta'])) {
			$route = $_GET["ruta"];
		}else {
			$route = "index";
		}
		$jaja = Conexion::mcontrolRuta($route);
		include $jaja;
	}
}