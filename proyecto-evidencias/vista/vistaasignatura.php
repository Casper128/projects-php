<?php
session_start();
if($_SESSION["usu"] == null){
header("location: ../index.html");	
}
else{
	if($_SESSION["niv"]!=2){
		header("Refresh: 10;location: menu.php");
        echo '<script language="javascript">alert("Bienvenido al menu del sistema de evidencias");</script>';
	}
}
error_reporting(0);
include("../control/configBd.php");
include '../modelo/Asignatura.php';
include '../control/ControlConexion.php';
include '../control/ControlAsignatura.php';


$id=$_POST['txtId'];
$nom=$_POST['txtNombre'];
$per=$_POST['txtPeriodo'];
$credito=$_POST['txtCredito'];
$hrsEst=$_POST['txtHrsEst'];
$progra=$_POST['txtPrograma'];
$bot=$_POST['btn'];

//objeto conexion para lista desplegable
$objConexion = new ControlConexion();
$objConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
$comandoSqlPrograma="SELECT * FROM programa";
$recordSetPrograma=$objConexion->ejecutarSelect($comandoSqlPrograma);


//objeto para listar
$objAsignatura= new Asignatura("","","","","","");
$objControlAsignaturas= new ControlAsignaturas($objAsignatura);
$mat=$objControlAsignaturas->listar();

switch ($bot) {
	case 'Guardar':
		$objAsignatura=new Asignatura($id,$nom,$per,$credito,$hrsEst,$progra);
		$objControlAsignaturas=new ControlAsignaturas($objAsignatura);
		$objControlAsignaturas->guardar();
        $mat=$objControlAsignaturas->listar();
		break;
	case 'Modificar':
		$objAsignatura=new Asignatura($id,$nom,$per,$credito,$hrsEst,$progra);
		$objControlAsignaturas=new ControlAsignaturas($objAsignatura);
		$objControlAsignaturas->modificar();
        $mat=$objControlAsignaturas->listar();
		break;	
	case 'Borrar':
		$objAsignatura=new Asignatura($id,"","","","","");
		$objControlAsignaturas=new ControlAsignaturas($objAsignatura);
		$objControlAsignaturas->borrar();
        $mat=$objControlAsignaturas->listar();
		break;
	case 'Consultar':
		$objAsignatura=new Asignatura($id,"","","","","");
		$objControlAsignaturas=new ControlAsignaturas($objAsignatura);
		$objAsignatura=$objControlAsignaturas->consultar();
		$id=$objAsignatura->getId();
		$nom=$objAsignatura->getNombre();
		$per=$objAsignatura->getPeriodo();
		$credito=$objAsignatura->getCredito();
		$hrsEst=$objAsignatura->getHrsEst();
        $mat=$objControlAsignaturas->listar();
		break;     
	default:
		// code...
		break;
}
echo "
<!DOCTYPE html>
<html>
<head>
	<title>Asignatura</title>
    <!-- Required meta tags -->
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <!-- Bootstrap CSS v5.0.2 -->
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css'
        integrity='sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC' crossorigin='anonymous'>
    <link rel='stylesheet' href='../css/global.css'>
    <!-- Libreria jquery -->
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
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
                            FORMULARIO DE REGISTRO DE ASIGNATURAS
                        </div>
                        <div class='card-body'>
                            <form method='post' action='vistaasignatura.php'>
                            <div class='row' id='rowId'>
									<div class='col-lg-0'>
										<input type='hidden' name='id' id='id'>
									</div>
                                    <div class='col'>
                                        <label class='form-label'>Id</label>
                                        <input class='form-control' type='text' name='txtId' value=$id>
                                    </div>
                                    <div class='col'>
                                        <label class='form-label'>Nombre</label>
                                        <input class='form-control' type='text' name='txtNombre' value=$nom>
                                    </div>
                                    <div class='col'>
                                        <label class='form-label'>Periodo</label>
                                        <input class='form-control' type='text' name='txtPeriodo' value=$per>
                                    </div>
                            </div>
                            <div class='row'>
                                    <div class='col' >
                                        <label class='form-label'>Creditos</label>
										<input class='form-control'type='text' name='txtCredito' value=$credito></td>
                                    </div>
                                    <div class='col' >
                                        <label class='form-label'>Horas Estudio Independiente</label>
                                        <input class='form-control' type='text' name='txtHrsEst' value=$hrsEst>
                                    </div>
                                    <div class='col'>
                                    <label class='form-label'>Programa</label>
                                    <select class='form-control'name='txtPrograma' value=$progra>
                                    <optgroup label='Seleccione'>";
                                    while ($registro = mysqli_fetch_array($recordSetPrograma)){
                                        echo"
                                        <option value=".$registro['IDPROGRAMA'].">".$registro['PROGRAMA']."</option>";
                                        }
                                        echo "</select>
                                    </div>
                            <div class='row' >
                                <div class='col-md-8 mt-4'>
                                    <button type='submit' name='btn' value='Guardar'class='btn btn-success'>Guardar</button>
                                    <button type='submit' name='btn' value='Consultar'class='btn btn-success'>Consultar</button>
                                    <button input type='submit' name='btn' value='Modificar' class='btn btn-danger'>Modificar</button>
                                    <button type='submit' name='btn' value='Borrar' class='btn btn-danger'>Eliminar</button>
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
                                    <th class='row-md-2'>Id</th>
                                    <th class='row-md-2'>Nombre</th>
                                    <th class='row-md-2'>Periodo</th>
                                    <th class='row-md-2'>Credito</th>
                                    <th class='row-md-2'>Horas de estudio independiente</th>
                                    <th class='row-md-2'>Programa</th>
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