<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema de Evaluación Docente</title>

    <!-- Custom fonts for this template-->
    <link href="VISTA/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="VISTA/css/sb-admin-2.css" rel="stylesheet">

</head>


<body class="bg-login-fondo">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9 my-5">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row"><br>
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Inicio de Sesión</h1>
                                    </div>

                                    
                                    <form class="user" method="POST">
                                        <div class="form-group">
                                            <input type="text" name = "usuario" id = "usuario" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp"placeholder="Ingresa tu Id de usuario">
                                        </div>
                                        <div class="form-group">
                                            <input type="password"  name = "pass" id = "pass" class="form-control form-control-user" name = "pass" id="pass" placeholder="Ingresa tu contraseña">
                                        </div>

                                        <input type="submit" name = "inicioSesion" value="Iniciar" class="btn btn-primary btn-user btn-block"  >
                                        
                                    </form>

                                    <?php 
                                            $log = new MCVlogin();
                                            $log ->loginController();
                                    ?>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="VISTA/vendor/jquery/jquery.min.js"></script>
    <script src="VISTA/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="VISTA/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="VISTA/js/sb-admin-2.min.js"></script>

</body>

</html>