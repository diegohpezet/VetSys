<?php
include("div/connect.php");
include("div/variables.php");

$stmt = $conn->prepare("SELECT * FROM user WHERE status = 0 ORDER BY nombre desc");
$stmt->execute();
$results_clientes = $stmt->fetchAll();

$clientes = null;

if (is_countable($results_clientes)) {
    if (count($results_clientes) != 0) {
        $clientes = $results_clientes;
    }
}


if (isset($_GET['datos_user'])) {
    $stmt = $conn->prepare("SELECT * FROM user WHERE dni = :dni");
    $stmt->bindParam(':dni', $_GET['datos_user']);
    $stmt->execute();
    $results = $stmt->fetch(PDO::FETCH_ASSOC);

    $cliente = null;

    if (count($results) > 0) {
        $cliente = $results;
    }

    if($cliente){
        $stmt = $conn->prepare("SELECT * FROM mascotas WHERE dueño = '". $cliente['nombre'] . " " . $cliente['apellido'] . "' ");
        $stmt->execute();
        $results_mascotas = $stmt->fetchAll();
        
        $mascotas = null;
        
        if (is_countable($results_mascotas)) {
            if (count($results_mascotas) != 0) {
                $mascotas = $results_mascotas;
            }
        }
    }
}

if (!empty($_POST['asunto']) && !empty($_POST['id_mascota']) && !empty($_POST['fecha'])) {
    $row = $conn->prepare("SELECT nombre FROM mascotas WHERE id_mascota = ".$_POST['id_mascota']."");
    $row->execute();
    $nombre = $row->fetchColumn();
    $row = $conn->prepare("SELECT dueño FROM mascotas WHERE id_mascota = ".$_POST['id_mascota']."");
    $row->execute();
    $cliente = $row->fetchColumn();
    $message = '';
    $sql = "INSERT INTO turnos (title,dni_cliente,cliente,asunto,id_mascota,mascota,status,start) VALUES (:title,:dni_cliente,:cliente,:asunto,:id_mascota,:mascota,'Confirmado',:fecha) ";
    // UPDATE mascotas set raza = COALESCE($_POST['raza'], raza)
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':title', $nombre ." | ". $_POST['asunto']);
    $stmt->bindValue(':dni_cliente', $_POST['id_dueño']);
    $stmt->bindValue(':cliente', $cliente);
    $stmt->bindValue(':id_mascota', $_POST['id_mascota']);
    $stmt->bindValue(':asunto', $_POST['asunto']);
    $stmt->bindValue(':mascota', $nombre);
    $stmt->bindValue(':fecha', $_POST['fecha']);
    if ($stmt->execute()) {
        $message = 'Se creó el usuario correctamente';
        header('Location: medsys.php');
    } else {
        $message = 'No se pudo crear el usuario';
        echo $sql;
    }
}


?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
    <link rel="icon" href="../img/logo.png">
    <title>Asignar turno | MedSys</title>
</head>
<body>
    <?php include('div/header.php')?>

    <div class="container mt-3 ">
        <form method="get" action="asignarturno.php">
            <select class="select-box" name='datos_user' onchange="this.form.submit()">
                <option selected value>Seleccione el cliente</option>
                <?php foreach ($clientes as $row) : ?>
                    <option value="<?php echo $row['dni'] ?>"><?php echo $row['nombre'], " ", $row['apellido'], " (", $row['dni'], ")" ?></option>
                <?php endforeach ?>
            </select>
        </form>
    </div>
    <?php if (isset($_GET['datos_user'])) : ?>
        <div class="container mt-3 border p-3">
            <h2 class="h2"><?php echo $cliente['nombre'] ," ", $cliente['apellido'] ?></h2>
            <form method="post" action="asignarturno.php">
            <input type='number' style="display:none" name='id_dueño' value=<?php echo $cliente['dni'] ?>>
                <i>Mascota : <select name="id_mascota" required>
                    <option value disabled selected>Seleccione</option>
                    <?php foreach ($mascotas as $row) : ?>
                        <option value="<?php echo $row['id_mascota'] ?>"><?php echo $row['nombre']?></option>
                    <?php endforeach ?>
                </select></i>
                <i>Maniobra: <select name="asunto" required>
                    <option value disabled selected>Seleccione</option>
                    <?php foreach ($maniobras as $row) : ?>
                    <option value="<?php echo $row ?>"><?php echo $row ?></option>
                <?php endforeach ?>                    
                </select></i>
                <i>Fecha: <input type="date" name="fecha" class="form-control" required></i>
                <div class="d-flex justify-content-center mt-3">
                    <input class="btn btn-primary" type="submit" name="cargarDatos" value="Cargar">
                </div>
            </form>
        </div>
    <?php endif; ?>
</body>

<script>
  $(document).ready(function () {
      $('select').selectize({
          sortField: 'text'
      });
  });
</script>