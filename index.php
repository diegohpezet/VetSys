<?php
session_start();
require 'sub/database.php';
if (isset($_SESSION['user_dni'])) {
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

  $sql = "INSERT INTO user (dni,email,pass,nombre,apellido,telefono,domicilio) values 
    (:dni,:email,:pass,:nombre,:apellido,:telefono,:domicilio)";

  $stmt = $conn->prepare($sql);

  $stmt->bindParam(':dni', $_POST['dni']);
  $stmt->bindParam(':email', $_POST['email']);
  $pass = md5($_POST['pass']);
  $stmt->bindParam(':pass', $pass);
  $stmt->bindParam(':nombre', $_POST['nombre']);
  $stmt->bindParam(':apellido', $_POST['apellido']);
  $stmt->bindParam(':telefono', $_POST['telefono']);
  $stmt->bindParam(':domicilio', $_POST['domicilio']);

  if ($stmt->execute()) {
    $message = 'Se creó el usuario correctamente';
  } else {
    $message = 'No se pudo crear el usuario';
    echo $sql;
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <script src="bootstrap/js/bootstrap.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link rel="stylesheet" href="bootstrap/css/all.min.css" />
  <link rel="stylesheet" href="style.css" />
  <title>VetSys</title>
</head>

<body>
  <ul class="nav justify-content-center bg-primary">
    <li class="nav-item">
      <a><i class="fa-brands fa-whatsapp"></i> +54 9 11 6165-5190</a>
    </li>
    <li class="nav-item">
      <a><i class="fa-solid fa-at"></i> placzekpatricia@gmail.com</a>
    </li>
  </ul>
  <nav class="navbar navbar-expand-md navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Vetsys</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Precios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="sub/login.php">Iniciar Sesión</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <img src="img/bg.jpg" class="img-fluid w-100" alt="..." />
  <section class="profile mt-3" id="aboutme">
    <div class="container px-4 px-lg-5">
      <h2 class="text-center mt-0">Conoce a Patricia</h2>
      <hr class="divider" />
      <div class="row text-center">
        <div class="col-12 col-lg-6 d-flex justify-content-center">
          <img class="img-fluid" src="https://images.unsplash.com/photo-1587272114422-ec88be13ab1a?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=735&q=80" />
        </div>
        <div class="col-12 col-lg-6 mt-xl-5">
          <div class="mt-4">
            <i class="fa-solid fa-hand-fist fa-2x"></i>
            <h3 class="h4 mb-2">Dedicación</h3>
            <p class="text-muted mb-0">
              Para mí, las mascotas no son solo parte de mi trabajo. Considero
              que cada animal merece el mejor cuidado posible. Pongo mi
              corazón en cada trabajo que realizo para brindarle el nivel de
              vida que se merecen
            </p>
          </div>
          <div class="mt-4">
            <i class="fa-solid fa-book fa-2x"></i>
            <h3 class="h4 mb-2">Conocimiento</h3>
            <p class="text-muted mb-0">
              Luego de haber terminado la carrera universitaria y recibirme de
              médica veterinaria, no dejé de capacitarme para asegurarme que
              tanto hoy como mañana, tu mascota se encuentre en las mejores
              manos
            </p>
          </div>
          <div class="mt-4">
            <i class="fa-solid fa-handshake fa-2x"></i>
            <h3 class="h4 mb-2">En contacto</h3>
            <p class="text-muted mb-0">
              La mejor manera de tratar una mascota es que esta se encuentre
              cómoda en su casa junto a su dueño. Es por eso que opto por la
              visita a domicilio
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <footer class="bg-light py-5">
    <div class="container px-4 px-lg-5">
      <div class="small text-center text-muted">Copyright &copy; 2022 - Patricia Placzek</div>
    </div>
  </footer>
</body>
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
                <input type="email" style="margin:5px;" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Correo" required>
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
                <input type="text" style="margin:5px;" class="form-control" name="domicilio" placeholder="Dirección" required>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <input type="number" style="margin:5px;" class="form-control" name="telefono" placeholder="Tel" required>
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

</html>