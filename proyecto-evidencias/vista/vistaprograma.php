<?php
session_start();
if($_SESSION["usu"] == null){
header("location: ../index.html");	
}
else{
	if($_SESSION["niv"]!=2  ){
		header("location: menu.php");
	}
}
error_reporting(0);
include("../control/configBd.php");
include '../modelo/Programa.php';
include '../control/ControlConexion.php';
include '../control/ControlPrograma.php';

$id=$_POST['txtIdPrograma'];
$pro=$_POST['txtPrograma'];
$nivEdu=$_POST['txtNivEdu'];
$fac=$_POST['txtFacultad'];
$bot=$_POST['btn'];

//objeto para lista desplegable
$objConexion = new ControlConexion();
$objConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
$comandoSql="SELECT * FROM facultad";
$recordSet=$objConexion->ejecutarSelect($comandoSql);

//objeto para listar
$objPrograma= new Programa("","","","");
$objControlProgramas= new ControlProgramas($objPrograma);
$mat=$objControlProgramas->listar();
switch ($bot) {
	case 'Guardar':
		$objPrograma=new Programa($id,$pro,$nivEdu,$fac);
		$objControlProgramas=new ControlProgramas($objPrograma);
		$objControlProgramas->guardar();
		$mat=$objControlProgramas->listar();
		break;
	case 'Modificar':
		$objPrograma=new Programa($id,$pro,$nivEdu,$fac);
		$objControlProgramas=new ControlProgramas($objPrograma);
		$objControlProgramas->modificar();
		$mat=$objControlProgramas->listar();
		break;	
	case 'Borrar':
		$objPrograma=new Programa($id,"","","");
		$objControlProgramas=new ControlProgramas($objPrograma);
		$objControlProgramas->borrar();
		$mat=$objControlProgramas->listar();
		break;
	case 'Consultar':
		$objPrograma=new Programa($id,"","","");
		$objControlProgramas=new ControlProgramas($objPrograma);
		$objPrograma=$objControlProgramas->consultar();
		$id=$objPrograma->getId();
		$pro=$objPrograma->getPrograma();
		$nivEdu=$objPrograma->getNivelEducativo();
		$mat=$objControlProgramas->listar();
		break;
	default:
		// code...
		break;
}
echo "<!DOCTYPE html>
<html>
<head>
	<title>Programa</title>
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
                            FORMULARIO DE REGISTRO DE PROGRAMAS
                        </div>
                        <div class='card-body'>

                            <form method='post' action='vistaprograma.php'>
							<div class='row' id='rowId'>
									<div class='col-lg-0'>
										<input type='hidden' name='id' id='id'>
									</div>
                                    <div class='col'>
                                        <label class='form-label'>Id</label>
                                        <input class='form-control' type='text' name='txtIdPrograma' value=$id>
                                    </div>
                                    <div class='col'>
                                        <label class='form-label'>Programa</label>
                                        <input class='form-control' type='text' name='txtPrograma' value=$pro>
                                    </div>
                                    <div class='col'>
                                        <label class='form-label'>Nivel Educativo</label>
                                        <input class='form-control' type='text' name='txtNivEdu' value=$nivEdu>
                                    </div>
                                    <div class='col'>
                                    <label class='form-label'>Profesor</label>
                                    <select class='form-control'name='txtFacultad' value=$fac>
                                    <optgroup label='Seleccione'>";
                                        while ($registro = mysqli_fetch_array($recordSet)){
                                            echo"
                                            <option value=".$registro['IDFACULTAD'].">".$registro['FACULTAD']."</option>";
                                            }
                                            echo "</select>
                                    </div>
                                </div>
                                <div class='row' >
                                        <div class='col-md-8 mt-4'>
                                            <button type='submit' id='btn_guardar' name='btn' value='Guardar'class='btn btn-success'>Guardar</button>
											<button type='submit' name='btn' value='Consultar'class='btn btn-success'>Consultar</button>
                                            <button input type='submit' name='btn' value='Modificar' class='btn btn-danger'>Modificar</button>
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
                                    <th class='row-md-2'>Programa</th>
                                    <th class='row-md-2'>Nivel Educativo</th>
									<th class='row-md-2'>Facultad</th>
                                    </thead>
                                    ";									
                        echo "<tbody id='SalidaDatos'>";
                            for($i=0;$i<sizeof($mat);$i++) {
                            echo "<tr>
                                <td>".$mat[$i][0]."</td><td>".$mat[$i][1]."</td>
                                <td>".$mat[$i][2]."</td><td>".$mat[$i][3]."</td>
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