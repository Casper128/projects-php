<?php
session_start();
include '../../model/clientes.php';
include '../../controller/ControlConexion.php';
include '../../controller/ControlUsuarios.php';
$usuDigitado=$_POST["txtUsuario"]; 
$conDigitada=$_POST["txtPassword"];
$bot=$_POST["btnEnviar"];
	if($bot="Enviar"){
		$objUsuarios=new clientes($usuDigitado,$conDigitada,"","");
		$objControlUsuarios=new ControlUsuarios($objUsuarios);
		$array=$objControlUsuarios->validarUsuario();
		if($array[2]== 1){
			$_SESSION["id"]=$array[0];
			$_SESSION["usu"]=$array[1];
			$_SESSION["admin"]= $array[2];
			$_SESSION["name"]= $array[3];
			header('Location: ../../admin/view/index.php');
		}
		else if($array[2]== 0){
			$_SESSION["id"]=$array[0];
			$_SESSION["usu"]=$array[1];
			$_SESSION["admin"]= $array[2];
			$_SESSION["name"]= $array[3];
			header('Location: ../../view/cliente/index.php');
		}
	}
?>

