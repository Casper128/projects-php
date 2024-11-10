<?php
session_start();

if ($_SESSION["usu"] == null) {
    header("location: ../../services/index.php");
    exit;
}

echo 'entro';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    // Incluir los archivos necesarios
    include("../../controller/configBd.php");
    include '../../model/citas.php';
    include '../../controller/ControlConexion.php';
    include '../../controller/ControlCitas.php';

    // Crear una instancia del controlador de citas
    $objCitas = new citas($id, "", "", "", "", "");
    $objControlCitas = new ControlCitas($objCitas);

    // Borrar el registro
    $objControlCitas->borrar();

    // Redireccionar a la página principal u otra ubicación después de la eliminación
    header("Location: index.php");
    exit;
} else {
    // Si no se proporcionó un ID válido, redireccionar a una página de error o a otra ubicación según corresponda
    header("Location: error.php");
    exit;
}
?>
