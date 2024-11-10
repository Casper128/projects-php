<?php
session_start();
if($_SESSION["usu"] == null ){
    header("location: ../../services/index.php");	
}
error_reporting(0);

$idUser=$_SESSION["id"];
$rolUser=$_SESSION["admin"];
$error=$_SESSION["error"];


include("../../controller/configBd.php");
include '../../model/citas.php';
include '../../controller/ControlConexion.php';
include '../../controller/ControlCitas.php';

 // Obtener el ID de la cita
$id =$_POST['txtid'];
$fecha=$_POST['txtFecha'];
// Obtiene los valores de los checkboxes seleccionados
$servicio = $_POST['txtServicio'];
$hora = $_POST['txtHora'];
$bot=$_POST['btn'];
$boton=$_POST['btn'];
$flag=false;

//objeto conexion para lista desplegable
$objConexion = new ControlConexion();
$objConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat']);
$comandoSqlPrograma="SELECT * FROM servicios";
$recordSetPrograma=$objConexion->ejecutarSelect($comandoSqlPrograma);

 //objeto para listar
 $objCitas= new citas("",$idUser,"","","","","");
 $objControlCitas= new ControlCitas($objCitas);
 $mat=$objControlCitas->listar($idUser,$rolUser);

 switch ($boton) {
	case 'Borrar':
		$objCitas=new citas($id,"","","","","");
		$objControlCitas=new ControlCitas($objCitas);
		$objControlCitas->borrar();
        $mat=$objControlCitas->listar($idUser,$rolUser);
		break; 
	default:
		// code...
		break;
}

switch ($bot) {
	case 'Guardar':
		$objCitas=new citas("",$idUser,$servicio,$hora,$fecha);
		$objControlCitas=new ControlCitas($objCitas);
		$response=$objControlCitas->guardar();
        $mat=$objControlCitas->listar($idUser,$rolUser);
		break;
	default:
		// code...
		break;
}


// Limpiar las variables después de procesar el formulario
unset($_POST['txtid']);
unset($_POST['txtFecha']);
unset($_POST['txtServicio']);
unset($_POST['txtHora']);
unset($_POST['btn']);

?>

<?php include '../../template-parts/header.php' ?>
<!-- Begin Page Content -->

<div class="container-fluid">
   <!-- Border Left Utilities -->
   <?php if(isset($_SESSION["error"]) && $_SESSION["error"] == false){ ?>
    <div id="success-message" class="card mb-4 py-3 border-left-success">
        <div class="card-body">
            Su turno fue registrado correctamente
        </div>
    </div>
    <?php 
        unset($_SESSION["error"]);
    }?>

    <!-- Border Left Utilities -->
    <?php if(isset($_SESSION["error"]) && $_SESSION["error"] == true){ ?>
    <div id="danger-message" class="card mb-4 py-3 border-left-danger">
        <div class="card-body">
            El horario se encuentra ocupado actualmente
        </div>
    </div>
    <?php 
        unset($_SESSION["error"]);
    }?>
    <!-- Page Heading -->
    <h1 class="h3 mb-1 text-gray-800">Border Utilities</h1>
    <p class="mb-4">Bootstrap's default utility classes can be found on the official <a
            href="https://getbootstrap.com/docs">Bootstrap Documentation</a> page. The custom utilities
        below were created to extend this theme past the default utility classes built into Bootstrap's
        framework.</p>
    <!-- Content Row -->
    <div class="row">
            <form action="index.php" method="post" class="user w-100">
                <div class="form-group">
                    <div class="col-4">
                            <input type="date" name="txtFecha" class="form-control form-control-user" id="exampleFirstName">
                            <select name="txtHora" class="form-control form-control-user mt-4">
                                <option value="6">6:00</option>
                                <option value="7">7:00</option>
                                <option value="8">8:00</option>
                                <option value="9">9:00</option>
                                <option value="10">10:00</option>
                                <option value="11">11:00</option>
                                <option value="12">12:00</option>
                                <option value="13">13:00</option>
                                <option value="14">14:00</option>                            
                            </select>
                            <?php while ($registro = mysqli_fetch_array($recordSetPrograma)) { ?>
                            <label class="m-4">
                                <input type="checkbox" name='txtServicio[]'
                                id=
                                <?php echo $registro['id']; ?>
                                value=
                                <?php echo $registro['id']; ?>>
                                <?php echo $registro['nombre']; ?>
                            </label>
                            <input type="hidden" name="formEnviado" value="true">
                            <?php } ?>
                    </div>
                    <div class="col-4">
                        <button id="btn_entrar" class="btn btn-primary btn-user w-100" type="submit" name="btn"
                            value="Guardar">Registrar turno</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php include '../../view/cliente/datatables.php' ?>
</div>
<?php include '../../template-parts/footer.php' ?>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<script>

function confirmDelete(event, buttonId) {
    var elemento = document.getElementById(buttonId);
    console.log(elemento.value);
    
    if(elemento.value == ""){
        event.preventDefault();
                    Swal.fire({
                                icon: 'warning',
                                title: '¿Realmente desea eliminar este registro?',
                                showCancelButton: true,
                                confirmButtonText: "Eliminar",
                                cancelButtonText: 'Cancelar',
                                reverseButtons: true
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Registro ',
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then(() => {
                                        elemento.value = "Borrar";
                                        elemento.click();
                                    });
                                }
                            });
    }
        console.log(elemento);
}
</script>


<script>
    setTimeout(function () {
        var successMessage = document.getElementById('success-message');
        if (successMessage) {
            successMessage.style.display = 'none';
        }
    }, 3000);

    setTimeout(function () {
        var successMessage = document.getElementById('danger-message');
        if (successMessage) {
            successMessage.style.display = 'none';
        }
    }, 3000);

    document.querySelector('form').addEventListener('submit', function(e) {
        // Validar campos vacíos
        const nombre = document.querySelector('input[name="txtFecha"]').value;
        const usuario = document.querySelector('input[name="txtServicio"]').value;
        const password = document.querySelector('select[name="txtHora"]').value;
        console.log(nombre);
        console.log(usuario);
        
        if (nombre.trim() === '' || usuario.trim() === '' || password.trim() === '') {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Por favor, completa todos los campos del formulario.',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
            });
            return;
        }
    });
</script>
</body>