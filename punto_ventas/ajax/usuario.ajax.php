<?php 
	require_once "../controladores/usuarios.controlador.php"; 
	require_once "../modelos/usuarios.modelo.php";
	   
class AjaxUsuario{
	public $idUsuario;
	public $activarUsuario;
	public $activarId;
	public $validarUsuario;

	public function AjaxEditarUsuario(){

		$item = "id";
		$valor = $this->idUsuario;

		$respuesta = ControladorUsuarios::ctrMostrarUsuario($item, $valor);

		echo json_encode($respuesta);
	}

	public function AjaxActivarUsuario(){

		$tabla = "usuarios";

		$item1 = "estado";
		$valor1 = $this->activarUsuario;

		$item2 = "id";
		$valor2 = $this->activarId;

		$respuesta =  ModeloUsuarios::MdlActualizarUsuario($tabla,$item1,$valor1,$item2,$valor2);
	}


	public function AjaxValidarUsuario(){

		$item = "usuario";
		$valor = $this->validarUsuario;

		$respuesta = ControladorUsuarios::ctrMostrarUsuario($item, $valor);

		echo json_encode($respuesta);
	}

}

//editar usuario

if (isset($_POST["idUsuario"])) {
	$editar = new AjaxUsuario();
	$editar -> idUsuario = $_POST["idUsuario"];
	$editar -> AjaxEditarUsuario();
}

//Activar usuario
if (isset($_POST["activarUsuario"])) {
	$activarUsuario = new AjaxUsuario();
	$activarUsuario -> activarUsuario = $_POST["activarUsuario"];
	$activarUsuario -> activarId = $_POST["activarId"];
	$activarUsuario -> AjaxActivarUsuario();
}

//Validar no repetir usuario

if (isset($_POST["validarUsuario"])) {
	$valUsuario = new AjaxUsuario();
	$valUsuario -> validarUsuario = $_POST["validarUsuario"];
	$valUsuario -> AjaxValidarUsuario();
}