<?php
session_start();

if($_SESSION["usu"] == null){
    header("location: ../services/auth/index.php");	
}

$idUser=$_SESSION["id"];
$nombreAdmin=$_SESSION["name"];

include("../../controller/configBd.php");
include '../../model/citas.php';
include '../../controller/ControlConexion.php';
include '../../controller/ControlCitas.php';

error_reporting(0);

$fecha=$_POST['txtFecha'];
$servicio=$_POST['txtServicio'];
$bot=$_POST['btn'];

//objeto conexion para lista desplegable
$objConexion = new ControlConexion();
$objConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
$comandoSqlPrograma="SELECT * FROM servicios";
$recordSetPrograma=$objConexion->ejecutarSelect($comandoSqlPrograma);

switch ($bot) {
	case 'Guardar':
		$objCitas=new citas("",$idUser,$servicio,$fecha);
		$objControlCitas=new ControlCitas($objCitas);
		$objControlCitas->guardar();
		break;
	case 'Modificar':
		$objCitas=new citas($id,$nom,$per,$credito,$hrsEst,$progra);
		$objControlc=new ControlCitas($objCitas);
		$objControlCitas->modificar();
		break;	
	case 'Borrar':
		$objCitas=new citas($id,"","","","","");
		$objControlCitas=new ControlCitas($objCitas);
		$objControlCitas->borrar();
		break;
	default:
		// code...
		break;
}

?>

<?php include '../../template-parts/header.php' ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <div class="col-4">
            <h1 class="h3 mb-1 text-gray-800">¡Bienvenido, <?php echo $nombreAdmin; ?>!</h1>
        </div>
        </div>
    </div>
</div>
<?php include '../../template-parts/footer.php'?>
<!-- /.container-fluid -->
</div>