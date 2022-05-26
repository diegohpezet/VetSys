<?php
include("div/connect.php");

/* <Select> de cambiar fecha */
$row = $conn->prepare("SELECT nro_Turno FROM turnos WHERE dni_cliente=:dni");
$row->bindParam('dni', $user['dni']);
$row->execute();
$id = $row->fetchAll();


if (isset($_POST['modificarFecha'])) {
    if (!empty($_POST['nro_Turno']) && !empty($_POST['fecha'])) {
        $stmt = $conn->prepare("UPDATE turnos SET fecha=:fecha WHERE nro_Turno=" . $_POST['nro_Turno'] . "");
        $stmt->bindParam(':fecha', $_POST['fecha']);
        $stmt->execute();
    }
}

/* Display de datos */
$stmt = $conn->prepare("SELECT * FROM turnos WHERE dni_cliente = :dni");
$stmt->bindParam(':dni', $user['dni']);
$stmt->execute();
$results_turnos = $stmt->fetch(PDO::FETCH_ASSOC);

$turnos = null;

if (is_countable($results_turnos)) {
    if (count($results_turnos) != 0) {
        $turnos = $results_turnos;
    }
}
?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../bootstrap/js/bootstrap.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">

    <title>Inicio | MedSys</title>
</head>

<body>
    <!--Header-->
    <?php include("div/header.php") ?>
    <?php if ($user['status'] != 1) : ?>
        <!--Contenido-->
        <?php if ($turnos) : ?>
            <div class="container" id="misturnos">
                <div class="container mt-3">
                    <h2>Mis turnos:</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>N° de Turno</th>
                                <th>Mascota</th>
                                <th>Asunto</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $turnos['nro_Turno'] ?></td>
                                <td><?php echo $turnos['mascota'] ?></td>
                                <td><?php echo $turnos['asunto'] ?></td>
                                <td><?php echo $turnos['fecha'] ?></td>
                            </tr>
                            <?php while ($row = $stmt->fetch()) : ?>
                                <tr>
                                    <td><?php echo $row['nro_Turno'] ?></td>
                                    <td><?php echo $row['mascota'] ?></td>
                                    <td><?php echo $row['asunto'] ?></td>
                                    <td><?php echo $row['fecha'] ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                <center><button type="button" style="margin: 0; padding:2px;" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalModificar">
                        Solicitar Cambio
                    </button></center>
            </div>
            <div class="container float-right">
                <a class="btn btn-success rounded-pill " href="https://wa.me/1167228164?text=Hola%20Patricia,%20estoy%20interesado/a%20en%20asistencia%20veterinaria."><i class="fa fa-whatsapp my-float"></i></a>
            </div>
        <?php else : ?>
            <div class="container" id="misturnos">
                <div class="container mt-3">
                    <p class="h5">No tienes ningun turno.</p>
                </div>
            </div>
        <?php endif; ?>

        <?php include('modal/modificarfecha.php') ?>
    <?php else : ?>
        <!--Veterinario-->
    <?php endif; ?>
</body>

</html>