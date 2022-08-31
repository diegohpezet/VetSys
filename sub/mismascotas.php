<?php
include("div/connect.php");

$message = '';

if (!empty($_POST['nombre']) && !empty($_POST['especie']) && !empty($_POST['sexo'])) {

    $sql = "INSERT INTO mascotas (nombre,especie,sexo,dueño,id_dueño) values 
        (:nombre,:especie,:sexo,'" . $user['nombre'] . " " . $user['apellido'] . "'," . $user['dni'] . ")";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':nombre', $_POST['nombre']);
    $stmt->bindParam(':especie', $_POST['especie']);
    $stmt->bindParam(':sexo', $_POST['sexo']);

    if ($stmt->execute()) {
        $message = 'Mascota agregada';
    } else {
        $message = 'Error. Revise los datos';
    }
}

$stmt = $conn->prepare("SELECT * FROM mascotas WHERE id_dueño = " . $user['dni'] . "");         /*Estas 3 lineas son la query de la clase*/
$stmt->bindParam(':dni', $user['dni']);
$stmt->execute();
$results_mascotas = $stmt->fetch(PDO::FETCH_ASSOC);

$mascotas = null;

if (is_countable($results_mascotas)) {
    if (count($results_mascotas) != 0) {
        $mascotas = $results_mascotas;
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

    <title>Mis mascotas | MedSys</title>
</head>

<body>
    <!--Header-->
    <?php include("div/header.php") ?>
    <?php if ($mascotas) : ?>
        <div class="container" id="misturnos">
            <div class="container mt-3">
                <h2>Mis Mascotas:</h2>
                <button type="button" class="btn btn-primary p-1" data-bs-toggle="modal" data-bs-target="#modalMascota">
                    Añadir Mascota
                </button>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Especie</th>
                            <th>Sexo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $mascotas['nombre'] ?></td>
                            <td><?php echo $mascotas['especie'] ?></td>
                            <td><?php echo $mascotas['sexo'] ?></td>
                        </tr>
                        <?php while ($mascotas = $stmt->fetch()) : ?>
                            <tr>
                                <td><?php echo $mascotas['nombre'] ?></td>
                                <td><?php echo $mascotas['especie'] ?></td>
                                <td><?php echo $mascotas['sexo'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php else : ?>
        <div class="container" id="mismascotas">
            <div class="container mt-3">
                <h2>No has registrado a tus mascotas aun.</h2>
                <button type="button" class="btn btn-dark mt-3" data-bs-toggle="modal" data-bs-target="#modalMascota"> Ingresar Mascota </button>

            </div>
        </div>
    <?php endif; ?>


    <!-- The Modal -->
    <div class="modal fade" id="modalMascota">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h3 style="padding: 0px;margin: 5px;">Mascota</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="container">
                        <br>
                        <form action="mismascotas.php" method="POST">
                            <div class="mb-3 mt-2">
                                <input type="text" class="form-control" id="nombre" placeholder="Nombre de la Mascota" name="nombre">
                            </div>
                            <div class="mb-3 mt-2">
                                <select class="form-select" name="especie" id="especie">
                                    <option disabled selected value>Seleccione</option>
                                    <option value="Perro">Perro</option>
                                    <option value="Gato">Gato</option>
                                    <option value="">Otro</option>
                                </select>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="radio1" name="sexo" value="Macho" checked>Macho
                                <label class="form-check-label" for="radio1"></label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="radio2" name="sexo" value="Hembra">Hembra
                                <label class="form-check-label" for="radio2"></label>
                            </div>
                            <input type="submit" class="btn btn-primary mt-3" value="Ingresar">
                        </form>
                        <br>
                        <hr>
                        <?php if (!empty($message)) : ?>
                            <p><?= $message ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>