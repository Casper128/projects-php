<?php 
session_start();
include './template-parts/header.php' ?>
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <?php
                                        if (isset($_SESSION['success'])){
                                            $success = $_SESSION['success'];
                                            // Limpiar las variables de sesión
                                            unset($_SESSION['success']);
                                            // Mostrar el mensaje según la respuesta
                                            if ($success) {
                                                ?>
                                                    <div id="success-message" class="card mb-4 py-3 border-left-success">
                                                        <div class="card-body">
                                                            Registro exitoso
                                                        </div>
                                                    </div>
                                            <?php
                                            } else {
                                                ?>
                                                    <div id="success-message" class="card mb-4 py-3 border-left-success">
                                                        <div class="card-body">
                                                            Ocurrió un error al guardar el registro. Por favor, inténtalo de nuevo.
                                                        </div>
                                                    </div>
                                            <?php
                                            }
                                        }
                                    ?>
                                    <form action="./auth/login.php" method="post" class="formulario_login user">
                                        <div class="form-group">
                                            <input type="text" name="txtUsuario" placeholder="Usuario"
                                                class="form-control form-control-user">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="txtPassword" placeholder="Contraseña"
                                                class="form-control form-control-user">
                                        </div>
                                        <!-- <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div> -->
                                        <button id="btn_entrar" class="btn btn-primary btn-user btn-block" type="submit"
                                            name="btnEnviar" value="Enviar">Entrar</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="recuperarPassword.php">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="../../Home/">Back Home</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include './template-parts/footer.php' ?>