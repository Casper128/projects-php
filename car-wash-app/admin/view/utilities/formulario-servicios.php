<?php
session_start();

if($_SESSION["usu"] == null ){
    header("location: ../auth/index.html");	
}

$idUser=$_SESSION["id"];
$userName=$_SESSION["name"];
$userName=$_SESSION["name"];
error_reporting(0);

include("../../controller/configBd.php");
include '../../model/servicios.php';
include '../../controller/ControlConexion.php';
include '../../controller/ControlServicios.php';

$id=$_POST['txtIdServicio'];
$nombre=$_POST['txtNombre'];
$costo=$_POST['txtCosto'];
$bot=$_POST['btn'];
$flag=false;

//objeto para listar
$objServicio= new servicios("","","");
$objControlServicio= new ControlServicios($objServicio);
$mat=$objControlServicio->listar();

switch ($bot) {
	case 'Guardar':
		$objServicios=new servicios("",$nombre,$costo);
		$objControlServicios=new ControlServicios($objServicios);
		$objControlServicios->guardar();
        $mat=$objControlServicio->listar();
        $flag = true; // Establecer la variable $flag en true
		break;
	case 'Modificar':
		$objServicios=new servicios($id,$nombre,$costo);
		$objControlServicios=new ControlServicios($objServicios);
		$objControlServicios->modificar();
        $mat=$objControlServicio->listar();
		break;	
	case 'Borrar':
		$objServicios=new servicios($id,"","");
		$objControlServicios=new ControlServicios($objServicios);
		$objControlServicios->borrar();
        $mat=$objControlServicio->listar();
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
    <?php if($flag!=false){ ?>
    <div id="success-message" class="card mb-4 py-3 border-left-success">
        <div class="card-body">
            Su servicio fue registrado correctamente
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
    <div class="row gy-2">
            <form action="formulario-servicios.php" method="post" class="user w-100">
                <div class="form-group">
                    <div class="col-8">
                    <div class="d-flex">
                    <input type="text" name="txtIdServicio" class="form-control form-control-user ml-2" id="exampleFirstName" placeholder="Id Servicio">
                        <input type="text" name="txtNombre" class="form-control form-control-user ml-2" id="exampleFirstName" placeholder="Item Servicio">
                        <input type="number" name="txtCosto" class="form-control form-control-user ml-2" id="exampleFirstName" placeholder="Costo">
                    </div>        
                    </div>
                    <div class="col-8">
                        <div class="d-flex m-4">
                            <button class="btn btn-primary btn-user ml-2 w-100" type="submit" name="btn" value="Guardar">Guardar</button>
                            <button class="btn btn-warning btn-user ml-2 w-100" type="submit" name="btn" value="Modificar">Modificar</button>
                            <button id="eliminar" class="btn btn-danger btn-user ml-2 w-100" type="submit" name="btn" onclick="confirmDelete(event,'eliminar')">Eliminar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Item Servicio</th>
                                            <th>Costo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php
                                            for($i=0;$i<sizeof($mat);$i++) { ?>
                                                <tr>
                                                    <td><?php echo $mat[$i][0] ?></td>
                                                    <td><?php echo $mat[$i][1] ?></td>
                                                    <td><?php echo '$' . number_format($mat[$i][2], 0, ',', '.'); ?></td>
                                                </tr>
                                                <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
</div>
<?php include '../../template-parts/footer.php' ?>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<link href="../lib/sweet-alert/sweealert2.min.css">
        <!-- Incluye SweetAlert2 -->
    <script src="../lib/sweet-alert/sweetalert2.min.js"></script>
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
</script>
</body>