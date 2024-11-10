<?php
session_start();
include '../modelo/Usuarios.php';
include '../control/ControlConexion.php';
include '../control/ControlUsuarios.php';
$usuDigitado=$_POST["txtUsuario"]; 
$conDigitada=$_POST["txtContrasena"];
$bot=$_POST["btnEnviar"];


$niv=0;

	if($bot="Enviar"){
		$objUsuarios=new Usuarios('',$usuDigitado,$conDigitada,$niv);
		$objControlUsuarios=new ControlUsuarios($objUsuarios);
		$objUsuarios=$objControlUsuarios->validarUsuario();
		if($objUsuarios->getNivelAcceso()!=0){
			$_SESSION["usu"]=$usuDigitado;
			$_SESSION["niv"]=$objUsuarios->getNivelAcceso();
			header('Location: menu.php');
		
	}
		else{
			
			header('Location: ../index.html');
			
		}
	}
?>

