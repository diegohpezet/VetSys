<?php
include("div/connect.php");
/* Display de datos (Vet) */
$stmt = $conn->prepare("SELECT * FROM mascotas ORDER BY dueño desc");
$stmt->execute();
$results_mascotas = $stmt->fetchAll();

$mascotas = null;

if (is_countable($results_mascotas)) {
    if (count($results_mascotas) != 0) {
        $mascotas = $results_mascotas;
    }
}

if (isset($_GET['datos_mascota'])) {
    $stmt = $conn->prepare("SELECT * FROM mascotas WHERE id_mascota = :id");
    $stmt->bindParam(':id', $_GET['datos_mascota']);
    $stmt->execute();
    $results = $stmt->fetch(PDO::FETCH_ASSOC);

    $mascota = null;

    if (count($results) > 0) {
        $mascota = $results;
    }
}

if ('cargarDatos') {
    if (!empty($_POST['raza']) and !empty($_POST['peso']) and !empty($_POST['etapa'])) {
        $sql = "UPDATE `mascotas`   
        SET `raza` = :raza,
            `peso` = :peso,
            `etapa` = :etapa
      WHERE `id_mascota` = :id
      ";

        $statement = $conn->prepare($sql);
        $statement->bindValue(":raza", $_POST['raza']);
        $statement->bindValue(":peso", $_POST['peso']);
        $statement->bindValue(":etapa", $_POST['etapa']);
        $statement->bindValue(":id", $_POST['id']);
        $statement->execute();
    }
}

if ('modificarPeso') {
    if (!empty($_POST['peso'])) {
        $sql = "UPDATE `mascotas`   
        SET `peso` = :peso
      WHERE `id_mascota` = :id
      ";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":peso", $_POST['peso']);
        $stmt->bindValue(":id", $_POST['id']);
        $stmt->execute();
        header('Location: pacientes.php?datos_mascota=' . $_POST['id'] . '');
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../bootstrap/js/bootstrap.js"></script>
    <link rel="stylesheet" href="style.css">

    <title>Pacientes | MedSys</title>
</head>

<body>
    <?php include("div/header.php") ?>

    <!--Veterinario-->
    <div class="container mt-3 ">
        <form action="pacientes.php" method="get">
            <select class="form-select " name="datos_mascota" onchange="this.form.submit()" required>
                <option selected value>Seleccione una mascota...</option>
                <?php foreach ($mascotas as $row) : ?>
                    <option value="<?php echo $row['id_mascota'] ?>"><?php echo $row['nombre'], " | ", $row['dueño'], " (", $row['id_dueño'], ")" ?></option>
                <?php endforeach ?>
            </select>
        </form>
    </div>
    <?php if (isset($_GET['datos_mascota'])) : ?>
        <div class="container mt-3 border">
            <h2 class="h2"><?php echo $mascota['nombre'] ?></h2>
            <div class="row">
                <div class='col-4'>
                    <i>Dueño: <?php echo $mascota['dueño'] ?></i>
                </div>
                <div class='col-4'>
                    <i><?php echo $mascota['especie'] . " " . $mascota['sexo'] ?></i>
                </div>
                <div class='col-4'>
                    <i>Última visita: <?php if (!$mascota['ultima_visita']) : ?>
                            <?php echo "-" ?>
                        <?php else : ?>
                            <?php echo $mascota['ultima_visita'] ?>
                        <?php endif; ?></i>
                </div>
            </div>
            <?php if ($mascota['raza'] and $mascota['peso'] and $mascota['etapa']) : ?>
                <br>
                <div class='col-4'>
                    <i>Raza: <?php echo $mascota['raza'] ?></i>
                </div>
                <div class='col-4'>
                    <i>Peso: <?php echo $mascota['peso'] ?>Kg</i> [<a href="#" data-bs-toggle="modal" data-bs-target="#modalPeso">Editar</a>]
                </div>
                <div class='col-4'>
                    <i>Etapa: <?php echo $mascota['etapa'] ?></i>
                </div>
                <?php include('modal/modificarpeso.php') ?>
            <?php else : ?>
                <hr>
                <form method="post" action="pacientes.php">
                    <input type='number' style="display:none" name='id' value=<?php echo $mascota['id_mascota'] ?>>
                    <div class='form-group row'>
                        <div class='col col-xs-3 m-2'>
                            Raza: <input class='input-sm' type='text' name='raza' required>
                        </div>
                        <div class='col col-xs-3 m-2'>
                            Peso: <input class='input-sm' type='number' name='peso' required>
                        </div>
                        <div class='col col-xs-3 m-2'>
                            Etapa: <input class='input-sm' type='text' name='etapa' required>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        <input class="btn btn-primary" type="submit" name="cargarDatos">
                    </div>
                </form>

                <hr>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <!--Informes de las visitas-->
    <?php if (isset($_GET['datos_mascota'])) : ?>
        <div class="container mt-3 border">
            <?php
            //No me deja ordenar (asc)
            $stmt = $conn->prepare("SELECT * FROM fichas WHERE id_mascota = " . $mascota['id_mascota'] . " ORDER BY id_ficha ASC");
            $stmt->execute();
            $results_fichas = $stmt->fetch(PDO::FETCH_ASSOC);

            $ficha = null;
            if ($results_fichas) {
                if (count($results_fichas) > 0) {
                    $ficha = $results_fichas;
                }
            }
            ?>
            <?php if ($ficha) : ?>
                <div class="h3">Ultima Visita: <?php echo $ficha['fecha']; ?></div>
                <div class="p"><b><i><?php echo $ficha['especialidad'] ?></i></b></div>
                <div class="p"><i>Tratamiento: </i><?php echo $ficha['tratamiento'] ?></div>
                <?php if ($ficha['receta']) : ?>
                    <div class="p"><i>Receta: </i><?php echo $ficha['receta']; ?></div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</body>
</html>