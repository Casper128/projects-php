<?php
session_start();

if($_SESSION["usu"] == null){
    header("location: ../../services/auth/index.php");	
}

$idUser=$_SESSION["id"];

error_reporting(0);

include("../../controller/configBd.php");
include '../../model/citas.php';
include '../../controller/ControlConexion.php';
include '../../controller/ControlCitas.php';

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

    <!-- Border Left Utilities -->

        <div id="success-message" class="card mb-4 py-3 border-left-success">
            <div class="card-body">
                Su turno fue registrado correctamente
            </div>
        </div>

    <?php $flag=false;
    if($flag!=false){ ?>
    <div class="card mb-4 py-3 border-left-success">
        <div class="card-body">
            Su turno fue registrado correctamente
        </div>
    </div>
    <?php }?>
    <!-- Page Heading -->
    <h1 class="h3 mb-1 text-gray-800">Border Utilities</h1>
    <p class="mb-4">Bootstrap's default utility classes can be found on the official <a
            href="https://getbootstrap.com/docs">Bootstrap Documentation</a> page. The custom utilities
        below were created to extend this theme past the default utility classes built into Bootstrap's
        framework.</p>
    <!-- Content Row -->
    <div class="row">
            <form action="formulario-citas.php" method="post" class="user w-100">
                <div class="form-group">
                    <div class="col-4">
                            <input type="date" name="txtFecha" class="form-control form-control-user" id="exampleFirstName">
                            <?php while ($registro = mysqli_fetch_array($recordSetPrograma)) { ?>
                            <label class="m-4">
                                <input type="checkbox" name='txtServicio[<?php echo $registro['id']?> ]'
                                id=
                                <?php echo $registro['id']; ?>
                                value=
                                <?php echo $registro['id']; ?>>
                                <?php echo $registro['nombre']; ?>
                            </label>
                            <?php }  $flag=true ?>
                    </div>
                    <div class="col-4">
                        <button id="btn_entrar" class="btn btn-primary btn-user w-100" type="submit" name="btn"
                            value="Guardar">Registrar turno</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php include '../datatables.php'?>
</div>
<?php include '../../template-parts/footer.php' ?>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<script>
    setTimeout(function () {
        var successMessage = document.getElementById('success-message');
        if (successMessage) {
            successMessage.style.display = 'none';
        }
    }, 3000);
</script>
</body>