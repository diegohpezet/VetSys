<?php
include("div/connect.php");
include('modal/sacarturno.php');
include('modal/modificarfecha.php');

if (!isset($_SESSION['user_dni'])) {
    Header("Location: /sub/index.php");
}

$sql = "DELETE FROM turnos WHERE DATE(start) < CURDATE()";
$stmt = $conn->prepare($sql);
$stmt->execute();

/* Display de datos */
if ($user['status'] == 0) {
    $stmt = $conn->prepare("SELECT * FROM turnos WHERE dni_cliente = :dni ORDER BY start");
    $stmt->bindParam(':dni', $user['dni']);
    $stmt->execute();
    $results_turnos = $stmt->fetch(PDO::FETCH_ASSOC);

    $turnos = null;

    if (is_countable($results_turnos)) {
        if (count($results_turnos) != 0) {
            $turnos = $results_turnos;
        }
    }
} else {
    $stmt = $conn->prepare("SELECT * FROM turnos WHERE DATE(start) = CURDATE() AND status = 'Confirmado'");
    $stmt->execute();
    $result_turnos = $stmt->fetchAll();

    $turnos_hoy = null;

    if (is_countable($result_turnos)) {
        if (count($result_turnos) != 0) {
            $turnos_hoy = $result_turnos;
        }
    }

    $stmt = $conn->prepare("SELECT * FROM turnos WHERE DATE(start) >= CURDATE() AND status = 'Pendiente' ORDER BY start");
    $stmt->execute();
    $result_turnos = $stmt->fetchAll();

    $turnos_pendientes = null;

    if (is_countable($result_turnos)) {
        if (count($result_turnos) != 0) {
            $turnos_pendientes = $result_turnos;
        }
    }

    $stmt = $conn->prepare("SELECT * FROM turnos WHERE DATE(start) > CURDATE() AND status = 'Confirmado' ORDER BY start");
    $stmt->execute();
    $result_turnos = $stmt->fetchAll();

    $turnos_confirmados = null;

    if (is_countable($result_turnos)) {
        if (count($result_turnos) != 0) {
            $turnos_confirmados = $result_turnos;
        }
    }
}

/*Cancelar y aceptar turnos*/
if (isset($_REQUEST['cancelar'])) {
    $sql = "UPDATE turnos SET status='Cancelado' WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $id = $_REQUEST['id'];
    $stmt->execute();
    echo "<meta http-equiv='refresh' content='0'>";
}
if (isset($_REQUEST['aceptar'])) {
    $sql = "UPDATE turnos SET status='Confirmado' WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $id = $_REQUEST['id'];
    $stmt->execute();
    echo "<meta http-equiv='refresh' content='0'>";
}

/* Borrar turnos confirmados */
if(array_key_exists('borrarBtn', $_POST)) {
    borrarTurno();
}

function borrarTurno() {
    include("database.php");
    $sql = "INSERT INTO mascotas (id_dueño, dueño, nombre, especie, sexo) values (
        " . $_POST['dni_dueño'] . ",
        '" . $_POST['nombre_dueño'] . "',
        '" . $_POST['nombre'] . "',
        '" . $_POST['especie'] . "',
        '" . $_POST['sexo'] ."'
        )";
    $stmt = $conn->prepare($sql);
    if ($stmt->execute()) {
        echo "
        <br>
        <div class='container border h5'>
          <p>
            Mascota agregada con éxito
          </p>
        </div>";
    }
}

if(isset($_POST['borrar_T'])){
    $turnosql=$conn->prepare('DELETE FROM `turnos` WHERE `id_mascota`=:id_mascota');
    $turnosql->bindParam(':id_mascota',$_POST['borrar_T']);
    if($turnosql->execute()){
        $mensaje= 'Turno eliminado exitosamente';
        echo "<meta http-equiv='refresh' content='0'>";
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
    <script src='../fullcalendar/lib/locales/es-us.js'></script>
    <link href='../fullcalendar/lib/main.css' rel='stylesheet' />
    <script src='../fullcalendar/lib/main.js'></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" type='text/css'>
    

    <title>Inicio | VetSys</title>
    <link rel="icon" href="../img/logo.png">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                events: 'div/events.php'
            })
            calendar.render();
        });
    </script>
</head>

<body>
    <!--Header-->
    <?php include("div/header.php") ?>
    <?php if ($user['status'] != 1) : ?>
        <!--Contenido-->
        <?php if ($user['status'] == 0 && $turnos) : ?>
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
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $turnos['id'] ?></td>
                                <td><?php echo $turnos['mascota'] ?></td>
                                <td><?php echo $turnos['asunto'] ?></td>
                                <td><?php echo $turnos['start'] ?></td>
                                <?php if ($turnos['status'] == "Confirmado") : ?>
                                    <td class="text-success"><?php echo $turnos['status'] ?></td>
                                <?php elseif ($turnos['status'] == "Pendiente") : ?>
                                    <td class="text-warning"><?php echo $turnos['status'] ?></td>
                                <?php else : ?>
                                    <td class="text-danger"><?php echo $turnos['status'] ?></td>
                                <?php endif; ?>
                            </tr>
                            <?php while ($row = $stmt->fetch()) : ?>
                                <tr>
                                    <td><?php echo $row['id'] ?></td>
                                    <td><?php echo $row['mascota'] ?></td>
                                    <td><?php echo $row['asunto'] ?></td>
                                    <td><?php echo $row['start'] ?></td>
                                    <?php if ($row['status'] == "Confirmado") : ?>
                                        <td class="text-success"><?php echo $row['status'] ?></td>
                                    <?php elseif ($row['status'] == "Pendiente") : ?>
                                        <td class="text-warning"><?php echo $row['status'] ?></td>
                                    <?php else : ?>
                                        <td class="text-danger"><?php echo $row['status'] ?></td>
                                    <?php endif; ?>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                <button type="button" style="margin: 0; padding:2px;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalModificar">
                    Solicitar Cambio
                </button>

                <button type="button" style="margin: 0; padding:2px;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalSacarTurno">
                    Sacar Turno
                </button>
            </div>
            <div class="container">
                <a class="btn btn-success rounded-pill float-end" href="https://wa.me/5491170167938?text=Hola%20Patricia,%20estoy%20interesado/a%20en%20tus%20servicios%20como%20veterinaria."><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
            </div>
        <?php else : ?>
            <div class="container" id="misturnos">
                <div class="container mt-3">
                    <p class="h5">No tienes ningun turno.</p>
                    <button type="button" style="margin: 0; padding:2px;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalSacarTurno">
                        Sacar Turno
                    </button>
                </div>
            </div>
        <?php endif; ?>
    <?php elseif ($user['status'] == 1) : ?>
        <!--Veterinario-->
        <?php if ($turnos_hoy) : ?>
            <div class="container">
                <div class="row">
                    <div class="col mb-2 mt-2 m-auto">
                        <div class="card p-2 border-0">
                            <div class="card-header bg-primary text-light">
                                <b>Hoy</b>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Cliente</th>
                                        <th scope="col">Mascota</th>
                                        <th scope="col">Asunto</th>
                                        <th scope="col">Domicilio</th>
                                        <th scope="col"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($turnos_hoy as $row) : ?>
                                        <tr>
                                            <th scope='row'><?= $row['cliente'] ?></th>
                                            <td><?= $row['mascota'] ?></td>
                                            <td><?= $row['asunto'] ?></td>
                                            <td><?= $row['domicilio'] ?></td>
                                            <td><a href="fichas.php?datos_mascota=<?= $row['id_mascota'] ?>">Atender</a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($turnos_pendientes) : ?>
            <div class="container">
                <div class="row">
                    <div class="col mb-2 mt-2 m-auto">
                        <div class="card p-2 border-0">
                            <div class="card-header bg-warning">
                                <b>Turnos Pendientes</b>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Cliente</th>
                                        <th scope="col">Mascota</th>
                                        <th scope="col">Asunto</th>
                                        <th scope="col"><i class="fa fa-thumb-tack" aria-hidden="true"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($turnos_pendientes as $row) : ?>
                                        <tr>
                                            <th scope="row"><?= $row['start'] ?></th>
                                            <td><?= $row['cliente'] ?></td>
                                            <td><?= $row['mascota'] ?></td>
                                            <td><?= $row['asunto'] ?></td>
                                            <td>
                                                <form action="" method="POST"><input type="hidden" name="id" value=<?= $row['id'] ?>><button type="submit" class="btn btn-success btn-sm" name="aceptar"><i class="fa fa-check" aria-hidden="true"></i></button>
                                                    <form action="" method="POST"><input type="hidden" name="id" value=<?= $row['id'] ?>><button type="submit" class="btn btn-danger btn-sm" name="cancelar"><i class="fa fa-ban" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <div class="container mt-2">
                <div class="alert alert-warning" role="alert">
                    No hay turnos para confirmar
                </div>
            </div>

        <?php endif; ?>

        <?php if ($turnos_confirmados) : ?>
            <div class="container">
                <div class="row">
                    <div class="col mb-2 mt-2 m-auto">
                        <div class="card p-2 border-0">
                            <div class="card-header bg-success text-white">
                                <b>Turnos Confirmados</b>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Turno N°</th>
                                        <th scope="col">Cliente</th>
                                        <th scope="col">Mascota</th>
                                        <th scope="col">Asunto</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($turnos_confirmados as $row) : ?>
                                        <tr>
                                            <th scope="row"><?= $row['start'] ?></th>
                                            <td><?= $row['id'] ?></td>
                                            <td><?= $row['cliente'] ?></td>
                                            <td><?= $row['mascota'] ?></td>
                                            <td><?= $row['asunto'] ?></td>
                                            <form action="medsys.php" method="post">
                                                <td><button class="btn btn-danger" type="submit" name="borrar_T" value="<?php echo $row['id_mascota']; ?>">🗑</button></td>
                                            </form>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <div class="container mt-2">
                <div class="alert alert-success" role="alert">
                    No hay turnos por atender próximamente
                </div>
            </div>

        <?php endif; ?>

        <!--Calendario-->
        <div class="container">
            <div id="calendar"></div>
        </div>

    <?php endif; ?>
    
</body>

</html>