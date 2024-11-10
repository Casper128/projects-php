<?php
session_start();
if($_SESSION["usu"] == null){
header("location: ../index.html");	
}
else{
	if($_SESSION["niv"]!=2 ){
		header("location: menu.php");
	}
}
error_reporting(0);
include("../control/configBd.php");
include '../modelo/Estudiante.php';
include '../control/ControlConexion.php';
include '../control/ControlEstudiantes.php';

$id=$_POST['txtCedula'];
$nom=$_POST['txtNombre'];
$est=$_POST['txtEstrato'];
$icfes=$_POST['txtICFES'];
$ingre=$_POST['txtIngreso'];
$email=$_POST['txtCorreo'];
$bot=$_POST['btn'];
$objEstudiante= new Estudiante("","","","","",0);
        $objControlEstudiantes= new ControlEstudiantes($objEstudiante);
        $mat=$objControlEstudiantes->listar();
switch ($bot) {
	case 'Guardar':
		$objEstudiante=new Estudiante($id,$nom,$est,$icfes,$ingre,$email);
		$objControlEstudiantes=new ControlEstudiantes($objEstudiante);
		$objControlEstudiantes->guardar();
        $mat=$objControlEstudiantes->listar();
		break;
	case 'Modificar':
		$objEstudiante=new Estudiante($id,$nom,$est,$icfes,$ingre,$email);
		$objControlEstudiantes=new ControlEstudiantes($objEstudiante);
		$objControlEstudiantes->modificar();
        $mat=$objControlEstudiantes->listar();
		break;	
	case 'Borrar':
		$objEstudiante=new Estudiante($id,"","","","","");
		$objControlEstudiantes=new ControlEstudiantes($objEstudiante);
		$objControlEstudiantes->borrar();
        $mat=$objControlEstudiantes->listar();
		break;
	case 'Consultar':
		$objEstudiante=new Estudiante($id,"","","","","");
		$objControlEstudiantes=new ControlEstudiantes($objEstudiante);
		$objEstudiante=$objControlEstudiantes->consultar();
		$id=$objEstudiante->getCedula();
		$nom=$objEstudiante->getNombre();
		$est=$objEstudiante->getEstrato();
		$icfes=$objEstudiante->getIcfes();
		$ingre=$objEstudiante->getIngreso();
		$email=$objEstudiante->getEmail();
        $mat=$objControlEstudiantes->listar();
		break;
    case 'Modal':
        $objEstudiante= new Estudiante("","","","","",0);
        $objControlEstudiantes= new ControlEstudiantes($objEstudiante);
        $mat=$objControlEstudiantes->listar();
        break;      
	default:
		// code...
		break;
}
echo "
<!DOCTYPE html>
<html>
<head>
	<title>Estudiante</title>
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
                            FORMULARIO DE REGISTRO DE ESTUDIANTES
                        </div>
                        <div class='card-body'>

                            <form method='post' action='vistaEstudiante.php'>
									<div class='row' id='rowId'>
									<div class='col-lg-0'>
										<input type='hidden' name='id' id='id'>
									</div>
                                    <div class='col'>
                                        <label class='form-label'>Cedula</label>
                                        <input class='form-control' type='text' name='txtCedula' value=$id>
                                    </div>
                                    <div class='col'>
                                        <label class='form-label'>Nombre</label>
                                        <input class='form-control' type='text' name='txtNombre' value=$nom>
                                    </div>
                                    <div class='col'>
                                        <label class='form-label'>Estrato</label>
                                        <input class='form-control' type='text' name='txtEstrato' value=$est>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col' >
                                        <label class='form-label'>Lugar en el ICFES</label>
										<input class='form-control'type='text' name='txtICFES' value=$icfes></td>

                                    </div>
                                    <div class='col' >
                                        <label class='form-label'>Fecha Ingreso</label>
                                        <input id='fecha' class='form-control' type='date' name='txtIngreso' value=$ingre>
                                    </div>
									<div class='col' >
                                        <label class='form-label'>Correo</label>
                                        <input class='form-control' type='email' name='txtCorreo' value=$email>
                                    </div>

                                    <div class='row' >
                                        <div class='col-md-8 mt-4'>
                                            <button type='submit' name='btn' value='Guardar'class='btn btn-success'>Guardar</button>
											<button type='submit' name='btn' value='Consultar'class='btn btn-success'>Consultar</button>
                                            <button type='submit' name='btn' value='Modificar' class='btn btn-danger'>Modificar</button>
                                            <button type='submit' name='btn' value='Borrar' class='btn btn-danger'>Eliminar</button>
                                            <button type='submit' name='btn' value='Listar' class='btn btn-danger'>Modal</button>
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
                                    <th class='row-md-2'>Cedula</th>
                                    <th class='row-md-2'>Nombre</th>
                                    <th class='row-md-2'>Estrato</th>
                                    <th class='row-md-2'>ICFES</th>
                                    <th class='row-md-2'>Fecha Ingreso</th>
                                    <th class='row-md-2'>Correo</th>
                                    </thead>
                                    ";									
                        echo "<tbody id='SalidaDatos'>";
                            for($i=0;$i<sizeof($mat);$i++) {
                            echo "<tr>
                                <td>".$mat[$i][0]."</td><td>".$mat[$i][1]."</td>
                                <td>".$mat[$i][2]."</td><td>".$mat[$i][3]."</td>
                                <td>".$mat[$i][4]."</td><td>".$mat[$i][5]."</td>
                                    </tr>";
                                        }
                            echo "</tbody>";
                            echo"
                                
                            </table>
                        </div>
                    </div>
                </div>
                <div class='modal' id='modal1'>
                    <div class='modal-dialog'>
                        <header class='modal-header'>
                        <button class='close-modal' aria-label='close modal' data-close>✕</button>
                        </header>
                        <section class='modal-content'>...</section>
                        <footer class='modal-footer'>...</footer>
                    </div>
                </div>
            </main>

        </div><!-- FIN DEL DIV CONTENIDO -->  
    </div><!-- FIN DEL ROW PRINCIPAL -->
    <script src='../js/Validacion.js'></script>
</html>";
?>