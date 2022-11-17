<?php
include("div/connect.php");

$row = $conn->prepare("SELECT * FROM mascotas WHERE id_dueño=:dni");
$row->bindParam('dni', $user['dni']);
$row->execute();
$mascota = $row->fetchAll();

$row = $conn->prepare("SELECT especialidad FROM especialidades ORDER BY especialidad");
$row->execute();
$asunto = $row->fetchAll();

if (!empty($_POST['id_mascota']) && !empty($_POST['asunto']) && !empty($_POST['fecha'])) {
    $row = $conn->prepare("SELECT nombre FROM mascotas WHERE id_mascota = ".$_POST['id_mascota']." INNER JOIN clientes ON mascotas.dni = clientes.dni");
    $row->execute();
    $nombre = $row->fetchColumn();

    $sql = "INSERT INTO turnos (dni_cliente,cliente,asunto,id_mascota,mascota,fecha) values 
        (:dni,'" . $user['nombre'] . " " . $user['apellido'] . "',:asunto,:id_mascota,:mascota,:fecha)";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':dni', $user['dni']);
    $stmt->bindParam(':asunto', $_POST['asunto']);
    $stmt->bindParam(':id_mascota', $_POST['id_mascota']);
    $stmt->bindParam(':mascota', $nombre);
    $stmt->bindParam(':fecha', $_POST['fecha']);
    if ($stmt->execute()) {
        $message = 'Turno solicitado';
    } else {
        $message = 'Error. Revise los datos';
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
    <link rel="icon" href="../img/logo.png">
    <title>Sacar Turno | MedSys</title>
</head>

<body>
    <?php include('div/header.php') ?>
    <div class="container pt-5 form-group d-flex justify-content-center">
        <form action="sacarturno.php" method="POST">
            <select class="form-select" name="id_mascota" required>
                <option disabled selected value>Mascota</option>
                <?php foreach ($mascota as $row):?>
                    <option value="<?php echo $row['id_mascota']?>"><?php echo $row['nombre'] ?></option>
                <?php endforeach ?>
            </select>
            <select class="form-select mt-3" name="asunto" required>
            <option disabled selected value>Asunto</option>
                <?php foreach ($asunto as $row):?>
                    <option value="<?php echo $row['especialidad']?>"><?php echo $row['especialidad'] ?></option>
                <?php endforeach ?>
            </select>
            <input name="fecha" class="form-control mt-3" type="date" required />

            <input type="submit" class="btn btn-primary mt-3" value="Solicitar Turno">
        </form>
    </div>
</body>