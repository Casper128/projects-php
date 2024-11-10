<?php

session_start();
include("../../controller/configBd.php");
include '../../model/clientes.php';
include '../../controller/ControlConexion.php';
include '../../controller/ControlUsuarios.php';

$usuario = $_POST['txtUsuario'];
$password = $_POST['txtPassword'];
$bot = $_POST['btn'];

//objeto conexion para lista desplegable
$objConexion = new ControlConexion();
$objConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat']);

$response ; // Inicializar el array de respuesta

switch ($bot) {
    case 'Modificar':
        $objUsuario = new clientes($usuario, $password, "","");
        $objControlUsuarios = new ControlUsuarios($objUsuario);
        $resultado = $objControlUsuarios->modificarClave();
        if ($resultado) {
            $_SESSION["success"] = true;
            header('Location: ../index.php');
        } else {
            $_SESSION["success"] = false;
            header('Location: ../register.php');
        }
        break;
    default:
        break;
}