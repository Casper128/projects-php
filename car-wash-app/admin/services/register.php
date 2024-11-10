<?php 
session_start();
include './template-parts/header.php' 
?>

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form action="./auth/register.php" method="post" class="user">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="txtNombre" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="Nombre">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="txtUsuario" class="form-control form-control-user" id="exampleLastName"
                                            placeholder="Usuario">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" name="txtPassword" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="tel" name="txtTelefono" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Telefono">
                                    </div>
                                </div>
                                <button id="btn_entrar" class="btn btn-primary btn-user btn-block" type="submit"
                                            name="btn" value="Guardar">Entrar</button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="recuperarPassword.php">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="index.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php include './template-parts/footer.php' ?>