<?php
session_start();
require 'sub/database.php';
if (isset($_SESSION['user_dni'])){
    unset($_SESSION['user_dni']);
}

if (isset($_SESSION['user_dni'])) {
    $records = $conn->prepare('SELECT dni, email, pass FROM user WHERE id = :id');
    $records->bindParam(':dni', $_SESSION['user_dni']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
        $user = $results;
    }
}

//Login
if (!empty($_POST['dni']) && !empty($_POST['pass'])) {

    $records = $conn->prepare('SELECT * FROM user WHERE dni=:dni');
    $records->bindParam(':dni', $_POST['dni']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    echo var_dump($results);
    $message = '';

    if (count($results) > 0) {
        $_SESSION['user_dni'] = $results['dni'];
        header('Location:sub/medsys.php'); //esto es la ruta a donde va
        $message = 'Logueado papu';
    } else {
        $message = 'La información ingresada es erronea';
    }
} else {
    $message = 'No se ha registrado en la página';
}


//Register
$message = '';

if (!empty($_POST['email']) && !empty($_POST['pass']) && !empty($_POST['dni'])) {

    $sql = "INSERT INTO user (dni,email,pass,nombre,apellido,telefono) values 
    (:dni,:email,:pass,:nombre,:apellido,:telefono)";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':dni', $_POST['dni']);
    $stmt->bindParam(':email', $_POST['email']);
    $pass = md5($_POST['pass']);
    $stmt->bindParam(':pass', $pass);
    $stmt->bindParam(':nombre', $_POST['nombre']);
    $stmt->bindParam(':apellido', $_POST['apellido']);
    $stmt->bindParam(':telefono', $_POST['telefono']);

    if ($stmt->execute()) {
        $message = 'Se creó el usuario correctamente';
    } else {
        $message = 'No se pudo crear el usuario';
        echo $sql;
    }
}
?>

<?php if (!empty($user)) : ?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <title>Index</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>
        <?php session_destroy(); ?>
    </body>

    </html>
    <!-- -------------------------------------- -->

<?php else : ?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <script src="bootstrap/js/bootstrap.js"></script>
        <link rel="stylesheet" href="style.css">
        <title>MedSys</title>
    </head>

    <body>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark ">
            <div class="container-fluid">
                <a class="navbar-brand" href="#" style="font-size: 30px;">MedSys</a>
            </div>
            <li class="nav-item">
                <button type="button" style="margin: 0; padding:0;" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#myModalsession">
                    Iniciar Sesión
                </button>
            </li>
        </nav>

        <!-- The Modal -->
        <div class="modal fade" id="myModalsession">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h3 style="padding: 0px;margin: 5px;">Inicio de sesión</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="container">
                            <br>
                            <form action="index.php" method="POST">
                                <div class="input-group">
                                    <input class="form-control input-sm" type="number" name="dni" id="dni" placeholder="DNI">
                                    <input type="password" class="form-control input-sm" class="form-control input-sm" name="pass" id="pass" placeholder="Contraseña">
                                </div>
                                <input type="submit" style="margin: 2px;margin-top: 10px;" class="btn btn-success" name="login" value="Ingresar">
                            </form>
                            <br>
                            <hr>
                            <?php if (!empty($message)) : ?>
                                <p><?= $message ?></p>
                            <?php endif; ?>
                            <div class="">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#myModalregistro">¿No tienes cuenta? Crea una</a> <br>
                                <a href="recoverpass.php">¿Olvidaste tu contraseña?</a>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                </div>
            </div>
        </div>

        <!--Modal del registro-->
        <!-- The Modal -->
        <div class="modal fade" id="myModalregistro">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h3 style="padding: 0px;margin: 5px;">Registro</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <section>
                            <form action="index.php" method="POST">
                                <div class="row">
                                    <div class="col">
                                        <input style="margin:5px;" type="text" class="form-control" name="nombre" placeholder="Nombre" required>
                                    </div>
                                    <div class="col">
                                        <input type="text" style="margin:5px;" class="form-control" name="apellido" placeholder="Apellido" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="number" style="margin:5px;" class="form-control" name="dni" placeholder="DNI" required>
                                    </div>
                                    <div class="col">
                                        <input type="text" style="margin:5px;" class="form-control" name="email" placeholder="Correo" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="password" style="margin:5px;" class="form-control" name="pass" placeholder="Contraseña" required>
                                    </div>
                                    <div class="col">
                                        <input type="password" style="margin:5px;" class="form-control" name="repeatpass" placeholder="Repetir contraseña">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="number" style="margin:5px;" class="form-control" name="telefono" placeholder="tel" required>
                                    </div>
                                </div>
                    </div>
                    <center><input type="submit" class="btn btn-success" style="width: 25%;height: 25%;" value="Registrarse"></center>
                    </form>
                    <?php if (!empty($message)) : ?>
                        <center>
                            <p><?= $message ?></p>
                        </center>
                    <?php endif; ?>
                    <hr>
                    <div style="padding: 10px;margin: 10px;">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#myModalsession">¿Ya tienes cuenta?</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    </body>
    </html>