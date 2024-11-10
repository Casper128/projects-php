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
include '../modelo/Profesor.php';
include '../control/ControlConexion.php';
include '../control/ControlProfesores.php';

$id=$_POST['txtCedula'];
$nom=$_POST['txtNombre'];
$titu=$_POST['txtTitulo'];
$email=$_POST['txtCorreo'];
$vinc=$_POST['txtVinculacion'];
$bot=$_POST['btn'];

$objConexion = new ControlConexion();
$objConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
$comandoSql="SELECT * FROM vinculacion";
$recordSet=$objConexion->ejecutarSelect($comandoSql);


$objProfesor= new Profesor("","","","","");
$objControlProfesores= new ControlProfesores($objProfesor);
$mat=$objControlProfesores->listar();
switch ($bot) {
	case 'Guardar':
		$objProfesor=new Profesor($id,$nom,$titu,$email,$vinc);
		$objControlProfesores=new ControlProfesores($objProfesor);
		$objControlProfesores->guardar();
		$mat=$objControlProfesores->listar();
		break;
	case 'Modificar':
		$objProfesor=new Profesor($id,$nom,$titu,$email,$vinc);
		$objControlProfesores=new ControlProfesores($objProfesor);
		$objControlProfesores->modificar();
		$mat=$objControlProfesores->listar();
		break;	
	case 'Borrar':
		$objProfesor=new Profesor($id,"","","","","");
		$objControlProfesores=new ControlProfesores($objProfesor);
		$objControlProfesores->borrar();
		$mat=$objControlProfesores->listar();
		break;
	case 'Consultar':
		$objProfesor=new Profesor($id,"","","","","");
		$objControlProfesores=new ControlProfesores($objProfesor);
		$objProfesor=$objControlProfesores->consultar();
		$id=$objProfesor->getCedula();
		$nom=$objProfesor->getNombre();
		$titu=$objProfesor->getTitulo();
		$email=$objProfesor->getEmail();
        $vinc=$objProfesor->getIdVinculacion();
		$mat=$objControlProfesores->listar();
		break;
	case 'Listar':
		$objProfesor= new Profesor("","","","","");
		$objControlProfesores= new ControlProfesores($objProfesor);
		$mat=$objControlProfesores->listar();
		break;
	default:
		// code...
		break;
}
echo "
<!DOCTYPE html>
<html>
<head>
	<title>Profesor</title>
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
                            FORMULARIO DE REGISTRO DE PROFESORES
                        </div>
                        <div class='card-body'>

                            <form method='post' action='vistaprofesor.php'>
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
                                        <label class='form-label'>Titulo</label>
                                        <input class='form-control' type='text' name='txtTitulo' value=$titu>
                                    </div>
                                    <div class=row>
                                        <div class='col' >
                                            <label class='form-label'>Correo</label>
                                            <input class='form-control' type='email' name='txtCorreo' value=$email>
                                        </div>
                                        <div class='col'>
                                            <label class='form-label'>Vinculacion</label>
                                            <select class='form-control'name='txtVinculacion' value=$vinc>
                                            <optgroup label='Seleccione'>";
                                            while ($registro = mysqli_fetch_array($recordSet)){
                                                echo"
                                                <option value=".$registro['IDVINCULACION'].">".$registro['VINCULACION']."</option>";
                                            }
                                            echo "</select>
                                        </div>
                                    </div>
                                        <div class='row' >
                                        <div class='col-md-8 mt-4'>
                                            <button type='submit' name='btn' value='Guardar'class='btn btn-success'>Guardar</button>
											<button type='submit' name='btn' value='Consultar'class='btn btn-success'>Consultar</button>
                                            <button input type='submit' name='btn' value='Modificar' class='btn btn-danger'>Modificar</button>
                                            <button type='submit' name='btn' value='Borrar' class='btn btn-danger'>Eliminar</button>
                                            <button type='submit' name='btn' value='Listar' class='btn btn-danger'>Listar</button>
                                        </div>
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
                                    <th class='row-md-2'>Titulo</th>
                                    <th class='row-md-2'>Correo</th>
									<th class='row-md-2'>Tipo Vinculacion</th>
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
            </main>

        </div><!-- FIN DEL DIV CONTENIDO -->  
    </div><!-- FIN DEL ROW PRINCIPAL -->
    <script src='../js/Validacion.js'></script>
</html>";
?>