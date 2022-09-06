<?php
session_start();
include('database.php');

$message = '';

//Login
if (isset($_POST['login'])) {
    if (empty($_POST['dni_log']) && empty($_POST['pass_log']) || empty($_POST['dni_log']) || empty($_POST['pass_log'])) {
        echo "<script>alert('Complete los cmapos')</script>";
        $message = 'La información ingresada es erronea';
        header('refresh:1, url:login.php;');
    } else {
        // echo var_dump($_POST);

        $password = $_POST['pass_log'];
        $pass_db = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("SELECT * FROM user WHERE dni=:dni");
        $stmt->bindParam(':dni', $_POST['dni_log']);
        $stmt->execute();
        $results = $stmt->fetch(PDO::FETCH_ASSOC);

        if (password_verify($password, $results['pass'])) {
            $_SESSION['user_dni'] = $_POST['dni_log'];
            header('Location:../sub/medsys.php');
        } else {
            // echo var_dump(password_verify($password, $pass_db));
            echo "<script>alert('La información ingresada es erronea')</script>";
            $message = 'La información ingresada es erronea';
            header('refresh:0;');
        }
    }
}

//Register
if (isset($_POST['registro'])) {
    if ($_POST['password'] != $_POST['confirm-password']) {
        echo "<script>alert('Las contraseñas no coinciden')</script>";
        header('refresh:1;');
    } else {

        $stmt = $conn->prepare("INSERT INTO `user`(`dni`, `email`, `pass`, `nombre`, `apellido`, `telefono`, `domicilio`, `status`) VALUES (:dni,:email,:pass,:nombre,:apellido,:tel,:domicilio,'0')");
        $stmt->bindParam(':dni', $_POST['dni_reg']);
        $stmt->bindParam(':email', $_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt->bindParam(':pass', $password);
        $stmt->bindParam(":nombre", $_POST['nombre']);
        $stmt->bindParam(":apellido", $_POST['apellido']);
        $stmt->bindParam(":tel", $_POST['tel']);
        $stmt->bindParam(':domicilio', $_POST['domicilio']);

        // verificacion para que no aya datos repetidos
        $usuarios = $conn->prepare("SELECT * FROM user where 1");
        $usuarios->execute();
        $result_users = $usuarios->fetchAll();

        $u = null;
        
        if (is_countable($result_users)) {
            if (count($result_users) != 0) {
                $u = $result_users;
            }
        }

        foreach ($u as $row_u) :
            if ($_POST['tel'] == $row_u['telefono']) {
                echo "<script>alert('El numero de telefono ya fue utilizado')</script>";
                header('refresh:1;');
                return;
            }
            if ($_POST['dni_reg'] == $row_u['dni']) {
                echo "<script>alert('El DNI ya fue utilizado')</script>";
                header('refresh:1,url=login.php');
                return;
            }
            if ($_POST['email'] == $row_u['email']){
                echo "<script>alert('El correo ya fue utilizado')</script>";
                header('refresh:1,url=login.php');
                return;
            }
        endforeach;
        if ($stmt->execute()) {
            $message = 'Se creó el usuario correctamente';
            header('Location:login.php');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login & registro</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link importance="high" rel="stylesheet" href="../style/login.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-6">
                                <a href="#" class="active" id="login-form-link">Login</a>
                            </div>
                            <div class="col-xs-6">
                                <a href="#" id="register-form-link">Register</a>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- Login -->
                                <form id="login-form" action="login.php" method="post" role="form" style="display: block;">
                                    <div class="form-group">
                                        <input type="number" class="form-control" name="dni_log" require placeholder="DNI">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="pass_log" class="form-control" require placeholder="Contraseña">
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="login" id="login" tabindex="4" class="form-control btn btn-login" value="Login">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="text-center">
                                                    <a href="" tabindex="5" class="forgot-password">olvidaste la
                                                        contraseña?</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <!-- registro -->
                                <form id="register-form" action="login.php" method="post" role="form" style="display: none;">
                                    <div class="form-group">
                                        <input type="text" required name="nombre" class="form-control" placeholder="Nombre">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" required name="apellido" class="form-control" placeholder="Apellido">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" required class="form-control" name="dni_reg" placeholder="DNI">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" required name="email" class="form-control" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="domicilio" class="form-control" placeholder="Domicilio">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" required name="password" class="form-control" placeholder="Contraseña">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" required name="confirm-password" class="form-control" placeholder="Confirmar Contraseña">
                                    </div>
                                    <div class="form-group">
                                        <input type="tel" required name="tel" class="form-control" placeholder="Telefono">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="registro" tabindex="4" class="form-control btn btn-register" value="Registrar">
                                    </div>
                                </form>
                                <a href="../index.php">volver</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            $("#login-form-link").click(function(e) {
                $("#login-form").delay(100).fadeIn(100);
                $("#register-form").fadeOut(100);
                $("#register-form-link").removeClass("active");
                $(this).addClass("active");
                e.preventDefault();
            });
            $("#register-form-link").click(function(e) {
                $("#register-form").delay(100).fadeIn(100);
                $("#login-form").fadeOut(100);
                $("#login-form-link").removeClass("active");
                $(this).addClass("active");
                e.preventDefault();
            });
        });
    </script>
</body>

</html>