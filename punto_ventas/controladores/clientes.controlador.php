<?php 

class ControladorCliente{

	static public function ctrAgregarCliente(){

		if (isset($_POST["nuevoCliente"])) {
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCliente"]) &&
			   preg_match('/^[0-9]+$/', $_POST["nuevoNumeroCliente"]) &&	
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoRFC"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["nuevoEmail"]) && 
			   preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoTelefono"])){

			   $tabla="cliente";
			   
			   $data = array("nombre"=> $_POST["nuevoCliente"],
			   				 "numero"=> $_POST["nuevoNumeroCliente"],
			   				 "rfc"=> $_POST["nuevoRFC"],
			   				 "correo"=> $_POST["nuevoEmail"],
			   				 "telefono"=> $_POST["nuevoTelefono"]);

			   $res = ModeloCliente::mdlAgregarCliente($tabla,$data);

			   if ($res == "ok") {
			   		echo '<script>
						swal({
							type:"success",
							title:"¡Cliente agregado correctamente!",
							showConfirmButton: true,
							confirmButtonText:"Cerrar",
							closeOnConfirm: false
							}).then((res)=>{
								if(res.value){
									window.location = "clientes";
								}
							});
					 </script>';	
			   }
			}else{
				echo '<script>
						swal({
							type:"error",
							title:"¡La información de algún campo es incorrecta!",
							showConfirmButton: true,
							confirmButtonText:"Cerrar",
							closeOnConfirm: false
							}).then((res)=>{
								if(res.value){
									window.location = "clientes";
								}
							});
					 </script>';
			}
		}
	}

	static public function ctrMostrarCliente($item,$valor){
		
		$tabla = "cliente";

		$res = ModeloCliente::mdlMostrarCliente($tabla,$item,$valor);

		return $res;
	}

	static public function ctrEditarCliente(){
		if (isset($_POST["editarCliente"])) {

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCliente"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarNumeroCliente"]) &&	
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarRFC"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["editarEmail"]) && 
			   preg_match('/^[()\-0-9 ]+$/', $_POST["editarTelefono"])){

			   $tabla="cliente";
			   
			   $data = array("id" => $_POST["IdCliente"],
			   				 "nombre"=> $_POST["editarCliente"],
			   				 "numero"=> $_POST["editarNumeroCliente"],
			   				 "rfc"=> $_POST["editarRFC"],
			   				 "correo"=> $_POST["editarEmail"],
			   				 "telefono"=> $_POST["editarTelefono"]
			   				);


			   $res = ModeloCliente::mdlEditarCliente($tabla,$data);
 			
			   if ($res == "ok") {
			   		echo '<script>
						swal({
							type:"success",
							title:"¡Cliente agregado correctamente!",
							showConfirmButton: true,
							confirmButtonText:"Cerrar",
							closeOnConfirm: false
							}).then((res)=>{
								if(res.value){
									window.location = "clientes";
								}
							});
					 </script>';	
			   }
			}else{
				echo '<script>
						swal({
							type:"error",
							title:"¡La información de algún campo es incorrecta!",
							showConfirmButton: true,
							confirmButtonText:"Cerrar",
							closeOnConfirm: false
							}).then((res)=>{
								if(res.value){
									window.location = "clientes";
								}
							});
					 </script>';
			}
		}	
	}

	static public function ctrEliminarCliente(){
		if (isset($_GET["idCliente"])) {
			
			$tabla = "cliente";
			$data = $_GET["idCliente"];

			$enviar = ModeloCliente::mdlEliminarCliente($tabla,$data);

			if ($enviar == "ok") {
				echo '<script>
						swal({
							type:"success",
							title:"¡Cliente eliminado correctamente!",
							showConfirmButton: true,
							confirmButtonText:"Cerrar",
							closeOnConfirm: false
							}).then((res)=>{
								if(res.value){
									window.location = "clientes";
								}
							});
					 </script>';
			}
		}
	}
}

