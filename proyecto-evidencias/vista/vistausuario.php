<?php
session_start();
if($_SESSION["usu"] == null){
header("location: ../index.html");	
}
else{
	if($_SESSION["niv"]!=1 ){
        echo '<script language="javascript">alert("Usted no tiene permisos para ingresar");</script>';
		header("location: menu.php");
        
	}
}
error_reporting(0);
include("../control/configBd.php");
include '../modelo/Usuarios.php';
include '../control/ControlConexion.php';
include '../control/ControlUsuarios.php';

$id=$_POST['txtId'];
$usu=$_POST['txtUsuario'];
$pass=$_POST['txtContrasena'];
$nivAcces=$_POST['txtNivAcces'];
$bot=$_POST['btn'];

//objeto para listar
$objUsuarios= new Usuarios("","","","");
$objControlUsuarios= new ControlUsuarios($objUsuarios);
$mat=$objControlUsuarios->listar();
switch ($bot) {
	case 'Guardar':
		$objUsuarios=new Usuarios($id,$usu,$pass,$nivAcces);
		$objControlUsuarios=new ControlUsuarios($objUsuarios);
		$objControlUsuarios->guardar();
		$mat=$objControlUsuarios->listar();
		break;
	case 'Modificar':
		$objUsuarios=new Usuarios($id,$usu,$pass,$nivAcces);
		$objControlUsuarios=new ControlUsuarios($objUsuarios);
		$objControlUsuarios->modificar();
		$mat=$objControlUsuarios->listar();
		break;	
	case 'Borrar':
		$objUsuarios=new Usuarios($id,"","","");
		$objControlUsuarios=new ControlUsuarios($objUsuarios);
		$objControlUsuarios->borrar();
		$mat=$objControlUsuarios->listar();
		break;
	case 'Consultar':
		$objUsuarios=new Usuarios($id,"","","");
		$objControlUsuarios=new ControlUsuarios($objUsuarios);
		$objUsuarios=$objControlUsuarios->consultar();
		$id=$objUsuarios->getId();
		$usu=$objUsuarios->getNomUsuario();
		$pass=$objUsuarios->getContrasena();
        $nivAcces=$objUsuarios->getNivelAcceso();
		$mat=$objControlUsuarios->listar();
		break;
	default:
		// code...
		break;
}
echo "<!DOCTYPE html>
<html>
<head>
	<title>Usuarios</title>
    <!-- Required meta tags -->
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <!-- Bootstrap CSS v5.0.2 -->
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css'
        integrity='sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC' crossorigin='anonymous'>
    <link rel='stylesheet' href='../css/global.css'>
</head>

<body >
<header id='Encabezado' class='navbar navbar-dark sticky-top bg-primary text-white flex-md-nowrap p-0 shadow'>
        <div >
			<h3><a href='menu.php'class='text-white' >🚀 SISEVID</a></h3>
        </div>
            <div class='row'>
                <div>
                    <a class='nav-link px-3 text-white' href='cerrarSesion.php' >Cerrar Sesión</a>
                </div>
            </div>
    </header>
    <div class='row'>
        <div id='BarraLateral'class=' col-lg-2 d-md-block bg-primary sidebar collapse '>
            <!-- CONTENIDO Y FORMA DE BARRA LATERAL -->
            <div class='row'>
                <nav id='MenuLateral'>
                <div class='col'>
                    <br>
                    <li><a class='nav-link text-white 'href='vistafacultad.php'>
                        <span data-feather='bar-chart-2'></span>
                            Facultad
                        </a>
                    </li>
                    <a class='nav-link text-white 'href='vistaprofesor.php'>
                        <span data-feather='bar-chart-2'></span>
                            Profesor
                        </a>
                    <a class='nav-link text-white 'href='vistaestudiante.php'>
                    <span data-feather='bar-chart-2'></span>
                            Estudiante
                    </a>
                    <a class='nav-link text-white 'href='vistaprograma.php'>
                    <span data-feather='bar-chart-2'></span>
                            Programa
                    </a>
                    <a class='nav-link text-white 'href='vistaevidencia.php'>
                    <span data-feather='bar-chart-2'></span>
                            Evidencia
                    </a>
                    <a class='nav-link text-white 'href='vistavinculacion.php'>
                    <span data-feather='bar-chart-2'></span>
                            Vinculacion
                    </a>
                    </div>
                    <a class='nav-link text-white 'href='vistaasignatura.php'>
                    <span data-feather='bar-chart-2'></span>
                            Asignatura
                    </a>
                    <a class='nav-link text-white 'href='vistausuario.php'>
                    <span data-feather='bar-chart-2'></span>
                            Usuarios
                    </a>
                    </div>
                </nav>
            </div>
        </div>
        <div id='contenido' class='col-md-12'>
        <main id='Formulario'class='col-md-9 ms-sm-auto col-lg-10 px-md-6'>
                <div>
                    <div class='card '>
                        <div class='card-header '>
                            FORMULARIO DE REGISTRO DE USUARIOS
                        </div>
                        <div class='card-body'>

                            <form method='post' action='vistausuario.php'>
							<div class='row' id='rowId'>
									<div class='col'>
                                    <label class='form-label'>Id Usuario</label>
                                    <input class='form-control' type='text' name='txtId' value=$id>
									</div>
                                    <div class='col'>
                                        <label class='form-label'>Usuario</label>
                                        <input class='form-control' type='text' name='txtUsuario' value=$usu>
                                    </div>
                                    <div class='col'>
                                    <label class='form-label'>Contrasena</label>
                                    <input class='form-control' type='password' name='txtContrasena' value=$pass>
                                    </div>
                                    <div class='col'>
                                        <label class='form-label'>Nivel Acceso</label>
                                        <input class='form-control' type='text' name='txtNivAcces' value=$nivAcces>
                                    </div>
                                </div>
                                <div class='row' >
                                        <div class='col-md-8 mt-4'>
                                            <button type='submit' name='btn' value='Guardar'class='btn btn-success'>Guardar</button>
											<button type='submit' name='btn' value='Consultar'class='btn btn-success'>Consultar</button>
                                            <button type='submit' name='btn' value='Modificar' class='btn btn-danger'>Modificar</button>
                                            <button type='submit' name='btn' value='Borrar' class='btn btn-danger'>Eliminar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>

                    </div>
                    <div class='row mt-2' id='divTabla'>
                        <div class='col-12'>
                            <table class='table table-striped '>
                                <thead class='table-active'>
                                    <th class='row-md-2'>Id</th>
                                    <th class='row-md-2'>Usuario</th>
                                    <th class='row-md-2'>Contrasena</th>
									<th class='row-md-2'>Nivel Acceso</th>
                                    </thead>
                                    ";									
                        echo "<tbody id='SalidaDatos'>";
                            for($i=0;$i<sizeof($mat);$i++) {
                            echo "<tr>
                                <td>".$mat[$i][0]."</td><td>".$mat[$i][1]."</td>
                                <td >".$mat[$i][2]."</td><td>".$mat[$i][3]."</td>
                                    </tr>";
                                        }
                            echo "</tbody>";
                            echo"
                                
                            </table>
                        </div>
                    </div>
                </div>
            </main>

        </div><!-- FIN DEL DIV CONTENIDO -->  
    </div><!-- FIN DEL ROW PRINCIPAL -->
    <script src='../js/Validacion.js'></script>

</html>";
?>