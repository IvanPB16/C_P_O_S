<?php 
class Conexion{
	static public function conectar(){
	
			 $link = new PDO("mysql:host=localhost;dbname=compuactual","Ivan","")
			$link->exec("set names utf8");

			return $link;

	}

	static public function mcontrolRuta($route){
		    if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok" ) {
			    //echo '<div class="wrapper">';
			    include "vistas/modulos/cabezote.php";
			    include "vistas/modulos/menu_lateral.php";
			   
			   if ($route != null) {
			      if ($route == "inicio" ||
			          $route == "salir" ||
			          $route == "usuarios" ||
			          $route == "categorias" ||
			          $route == "subcategorias" ||
			          $route == "productos" ||
			          $route == "ventas" ||
			          $route == "crear-venta" ||
			          $route == "editar-venta" ||
			          $route == "clientes" ||
			          $route == "proveedores" ||
			          $route == "promociones" ||
			          $route == "crear-promocion" ||
			          $route == "editar-promocion" ||
			          $route == "orden" ||
			          $route == "ordenes" ||
			          $route == "editar-orden"||
			          $route == "reporte"
			          ) {
			         $valor = "vistas/modulos/".$route.".php";
			      }else{
			        $valor = "vistas/modulos/pagina404.php";
			      }
			    }else{
			       $valor = "vistas/modulos/inicio.php";
			    }
			   
			   
			   // echo '</div>';  
			    } else{
			         $valor = "vistas/modulos/login.php";  
			    }
			    return $valor;
	}

}
