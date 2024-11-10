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
include '../modelo/Evidencia.php';
include '../control/ControlConexion.php';
include '../control/ControlEvidencias.php';
//variables de tabla evidencia
$id=$_POST['txtIdEvidencia'];
$tip=$_POST['txtTipEvidencia'];
$cap=$_POST['txtCapitulo'];
$bot=$_POST['btn'];

//Cargar archivo
$evi = $_FILES["txtEvidencia"]["name"];
$file_tmp = $_FILES["txtEvidencia"]["tmp_name"];
$desc-$_POST["desc"];
$route= "../uploads/".$evi;

move_uploaded_file($file_tmp,$route);


//consulta para listas desplegables
$objConexion = new ControlConexion();
$objConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
$comandoSql="SELECT * FROM profesor";
$recordSet=$objConexion->ejecutarSelect($comandoSql);
$comandoSqlAlumno="SELECT * FROM estudiante";
$recordSetAlumno=$objConexion->ejecutarSelect($comandoSqlAlumno);
$comandoSqlcapitulo="SELECT * FROM capitulo";
$recordSetcapitulo=$objConexion->ejecutarSelect($comandoSqlcapitulo);
$comandoSqlevidencia="SELECT * FROM evidencia";
$recordSetevidencia=$objConexion->ejecutarSelect($comandoSqlevidencia);


//Tablar Evidencias_Estudiantes
//Variables Evidencias_Estudiantes
function Alum_Evidencia($case,$id){
        $alum=$_POST['selectAlumno'];
        $pro=$_POST['selectProfesor'];
        $cap=$_POST['txtCapitulo'];
    switch($case){    
        case 'Guardar':
            $objConexion = new ControlConexion();
            $objConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']); 
            foreach($alum as $valor ){
                $comandoSqlSelect="INSERT INTO 
                `estudiantes_evidencias`(`FK_ESTUDIANTE_ID_EVIDENCIAS`, `FK_EVIDENCIAS_ID_ESTUDIANTE`) 
                VALUES ('".$id."','".$valor."')";
                $objConexion->ejecutarSelect($comandoSqlSelect);
            }
            foreach($pro as $value ){
                $comandoSqlSelect="INSERT INTO `profesor_evidencias`
                (`FK_PROFESOR_ID_EVIDENCIA`, `FK_EVIDENCIA_ID_PROFESOR`)
                VALUES ('".$id."','".$value."')";
                $objConexion->ejecutarSelect($comandoSqlSelect);
            }
            $comandoSqlSelect="INSERT INTO `capitulo_evidencias`
            (`FK_CAPITULO_ID_EVIDENCIAS`, `FK_EVIDENCIAS_ID_CAPITULO`) 
            VALUES ('".$id."','".$cap."')";
            $objConexion->ejecutarSelect($comandoSqlSelect);
            $objConexion->cerrarBd();
            break;
        case 'Borrar':{
            $objConexion = new ControlConexion();
            $objConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']); 
            $comandoSqlSelectPro="DELETE FROM `profesor_evidencias` WHERE FK_PROFESOR_ID_EVIDENCIA= '".$id."'";
            $objConexion->ejecutarSelect($comandoSqlSelectPro);
            $comandoSqlSelectAlum="DELETE FROM `estudiantes_evidencias` WHERE FK_ESTUDIANTE_ID_EVIDENCIAS='".$id."'";
            $objConexion->ejecutarSelect($comandoSqlSelectAlum);
            $comandoSqlSelectCap="DELETE FROM `capitulo_evidencias` WHERE FK_CAPITULO_ID_EVIDENCIAS='".$id."'";
            $objConexion->ejecutarSelect($comandoSqlSelectCap);
            $objConexion->cerrarBd();
            break;
        }

};
}


//objeto para listar
$objEvidencia= new Evidencia("","","");
$objControlEvidencias= new ControlEvidencias($objEvidencia);
$mat=$objControlEvidencias->listar();
switch ($bot) {
	case 'Guardar':
		$objEvidencia=new Evidencia($id,$tip,$evi);
		$objControlEvidencias=new ControlEvidencias($objEvidencia);
		$objControlEvidencias->guardar();
        Alum_Evidencia($bot,$id);
		$mat=$objControlEvidencias->listar();
		break;
	case 'Modificar':
		$objEvidencia=new Evidencia($id,$tip,$evi);
		$objControlEvidencias=new ControlEvidencias($objEvidencia);
		$objControlEvidencias->modificar();
		$mat=$objControlEvidencias->listar();
		break;	
	case 'Borrar':
		$objEvidencia=new Evidencia($id,"","");
		$objControlEvidencias=new ControlEvidencias($objEvidencia);
        Alum_Evidencia($bot,$id);
		$objControlEvidencias->borrar();
		$mat=$objControlEvidencias->listar();
		break;
	case 'Consultar':
		$objEvidencia=new Evidencia($id,"","");
		$objControlEvidencias=new ControlEvidencias($objEvidencia);
		$objEvidencia=$objControlEvidencias->consultar();
		$id=$objEvidencia->getId();
		$tip=$objEvidencia->getTipoEvi();
		$evi=$objEvidencia->getEvidencias();
		$mat=$objControlEvidencias->listar();
		break;
	case 'Listar':
		$objEvidencia= new Evidencia("","","");
		$objControlEvidencias= new ControlEvidencias($objEvidencia);
		$mat=$objControlEvidencias->listar();
		break; 
	default:
		// code...
		break;
}
echo "<!DOCTYPE html>
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
    <link rel='stylesheet' href='../css/modal.css'>
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
                            FORMULARIO DE REGISTRO DE EVIDENCIAS
                        </div>
                        <div class='card-body'>

                            <form method='post' action='vistaevidencia.php' enctype='multipart/form-data'>
									<div class='row' id='rowId'>
									<div class='col-lg-0'>
										<input type='hidden' name='id' id='id'>
									</div>
                                    <div class='col'>
                                        <label class='form-label'>Id</label>
                                        <input class='form-control' type='text' name='txtIdEvidencia' value=$id>
                                    </div>
                                    <div class='col'>
                                        <label class='form-label'>Nombre</label>
                                        <input class='form-control' type='text' name='txtTipEvidencia' value=$tip>
                                    </div>
                                    <div class='col'>
                                        <label class='form-label'>Evidencia</label>
                                        <input class='form-control' type='file' accept='image/png, .jpeg, .jpg, image/gif'
										name='txtEvidencia' value=$evi>
                                    </div>
                            <div class=row>
                                    <div class='col'>
                                    <label class='form-label'>Profesor</label>
                                    <select class='form-control' name='selectProfesor[]' multiple value=$pro>
                                    <optgroup label='Seleccione'>";
                                    while ($registro = mysqli_fetch_array($recordSet)){
                                        echo"
                                        <option value=".$registro['CEDULA'].">".$registro['NOMBRE']."</option>";
                                    }
                                echo "</select>
                                </div>
                                <div class='col'>
                                    <label class='form-label'>Alumno</label>
                                    <select class='form-control' name='selectAlumno[]' multiple value=$alum>
                                    <optgroup label='Seleccione'>";
                                    while ($registro = mysqli_fetch_array($recordSetAlumno)){
                                        echo"
                                        <option value=".$registro['CEDULA'].">".$registro['NOMBRE']."</option>";
                                    }
                                echo "</select>
                                </div>   
                            </div>
                            <div class='col'>
                            <label class='form-label'>Capitulo</label>
                            <select class='form-control' name='txtCapitulo' value=$cap>
                            <optgroup label='Seleccione'>";
                            while ($registro = mysqli_fetch_array($recordSetcapitulo)){
                                    echo"
                                    <option value=".$registro['IDCAPITULO'].">".$registro['IDCAPITULO']."</option>";
                                }
                            echo"</select>
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
                                    <th class='row-md-2'>Tipo Evidencia</th>
                                    <th class='row-md-2'>Evidencia</th>
                                    <th class='row-md-2'>Profesor</th>
                                    <th class='row-md-2'>Estudiante</th>
                                    </thead>
                                    ";									
                        echo "<tbody id='SalidaDatos'>";
                        for($i=0;$i<sizeof($mat);$i++) {
                            echo "<tr>
                                <td>".$mat[$i][0]."</td><td>".$mat[$i][1]."</td>
                                <td>".$mat[$i][2]."</td><td>".$mat[$i][3]."</td>
                                <td>".$mat[$i][4]."</td>
                                    </tr>";
                                        }
                            echo "</tbody>";
                            echo"
                                
                            </table>
                        </div>
                    </div>
                </div>
                <script src='../js/script.js'>  </script>
                <script src='../js/Validacion.js'></script>
            </main>

        </div><!-- FIN DEL DIV CONTENIDO -->  
    </div><!-- FIN DEL ROW PRINCIPAL -->
</html>";
?>