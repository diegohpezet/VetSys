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

    if ($mascota['especie'] == 'Perro') {
        $stmt = $conn->prepare("SELECT * FROM razas_perros");
        $stmt->execute();
        $razas_perros = $stmt->fetchAll();

        $razas = null;

        if (is_countable($razas_perros)) {
            if (count($razas_perros) != 0) {
                $razas = $razas_perros;
            }
        }
    } else if ($mascota['especie'] == 'Gato') {
        $stmt = $conn->prepare("SELECT * FROM razas_gatos");
        $stmt->execute();
        $razas_gatos = $stmt->fetchAll();

        $razas = null;

        if (is_countable($razas_gatos)) {
            if (count($razas_gatos) != 0) {
                $razas = $razas_gatos;
            }
        }
    }
}




if ('cargarDatos') {
    if (!empty($_POST['raza']) and !empty($_POST['peso']) and !empty($_POST['etapa'])) {
        $sql = "UPDATE `mascotas`   
        SET `raza` = :raza,
            `peso` = :peso,
            `etapa` = :etapa,
            `castrado` = :castrado,
            `pelaje` = :pelaje,
            `temperamento` = :temperamento,
            `utilidad` = :utilidad
      WHERE `id_mascota` = :id
      ";
        // UPDATE mascotas set raza = COALESCE($_POST['raza'], raza)
        $statement = $conn->prepare($sql);
        $statement->bindValue(":raza", $_POST['raza']);
        $statement->bindValue(":peso", $_POST['peso']);
        $statement->bindValue(":etapa", $_POST['etapa']);
        $statement->bindValue(":castrado", $_POST['castrado']);
        $statement->bindValue(":pelaje", $_POST['pelaje']);
        $statement->bindValue(":temperamento", $_POST['temperamento']);
        $statement->bindValue(":utilidad", $_POST['utilidad']);
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

if(array_key_exists('deleteBtn', $_POST)) {
    borrarMascota();
}

function borrarMascota() {
    include("database.php");
    $sql = "DELETE FROM mascotas WHERE id_mascota = " . $_GET['datos_mascota'] ."";
    $stmt = $conn->prepare($sql);
    if ($stmt->execute()) {
        header("location: pacientes.php");
        echo "
        <br>
        <div class='container border h5'>
          <p>
            Mascota eliminada
          </p>
        </div>";
    } else {
        echo $sql;
    }
}

if(isset($_POST['eliminar_M'])){
    $mascotassql=$conn->prepare('DELETE FROM `mascotas` WHERE `id_mascota`=:id_mascota');
    $mascotassql->bindParam(':id_mascota',$_POST['eliminar_M']);
    $fichasql=$conn->prepare('DELETE FROM `fichas` WHERE `id_mascota`=:id_mascota');
    $fichasql->bindParam(':id_mascota',$_POST['eliminar_M']);
    $turnosql=$conn->prepare('DELETE FROM `turnos` WHERE `id_mascota`=:id_mascota');
    $turnosql->bindParam(':id_mascota',$_POST['eliminar_M']);
    if($mascotassql->execute() && $fichasql->execute() && $turnosql->execute()){
        $mensage='Mascota eliminada exitosamente';
        header("location: pacientes.php");
    }
}

?>

<!DOCTYPE html>
<html>

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
    <link rel="stylesheet" href="style.css">

    <title>Pacientes | MedSys</title>
</head>

<body>
    <?php include("div/header.php") ?>

    <!--Veterinario-->
    <div class="container mt-5 ">
        <div class="row">

            <div class="col-10">
                <form action="pacientes.php" method="get">
                    <select class="select-box" name="datos_mascota" onchange="this.form.submit()" required>
                        <option selected value>Seleccione una mascota...</option>
                        <?php foreach ($mascotas as $row) : ?>
                            <option value="<?php echo $row['id_mascota'] ?>"><?php echo $row['nombre'], " | ", $row['dueño'], " (", $row['id_dueño'], ")" ?></option>
                        <?php endforeach ?>
                    </select>
                </form>
            </div>

            <div class="col">
                <button class="btn btn-secondary rounded-pill" data-bs-toggle="modal" data-bs-target="#modalMascota">
                    +
                </button>
                <?php include("modal/cargarmascota.php") ?>
            </div>
        </div>
    </div>
    <?php if (isset($_GET['datos_mascota'])) : ?>
        <div class="container mt-3 border p-3">
            <div class="row">
                <div class="col">
                    <h2 class="h2"><?php echo $mascota['nombre'] ?></h2>
                </div>
            </div>
            
            <div class="row">
                <div class='col-4'>
                    <i>Dueño: <?php echo $mascota['dueño'] ?></i>
                </div>
                <div class='col-4'>
                    <i><?php echo $mascota['especie'] . " " . $mascota['sexo'] ?></i>
                </div>
            </div>
            <?php if ($mascota['raza'] and $mascota['peso'] and $mascota['etapa']) : ?>
                <br>
                <div class="row mb-3">
                    <div class='col-12 col-sm-4'>
                        <i><b>Raza: </b><?php echo $mascota['raza'] ?></i>
                    </div>
                    <div class='col-6 col-sm-4'>
                        <i><b>Peso: </b><?php echo $mascota['peso'] ?>Kg</i> [<a href="#" data-bs-toggle="modal" data-bs-target="#modalPeso">Editar</a>]
                    </div>
                    <div class='col-6 col-sm-4'>
                        <i><b>Edad: </b><?php echo $mascota['etapa'] ?></i>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <i><b>Castrado: </b><?=$mascota['castrado']?></i>
                    </div>
                    <div class="col-6">
                        <i><b>Temperamento: </b><?=$mascota['temperamento']?></i>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <i><b>Pelaje: </b><?=$mascota['pelaje']?></i>
                    </div>
                    <div class="col-6">
                        <i><b>Utilidad: </b><?=$mascota['utilidad']?></i>
                    </div>
                </div>
                <div class="row d-flex justify-content-end">
                    <div class="col">
                        <form method="POST" action="pacientes.php?datos_mascota=<?=$_GET['datos_mascota']?>">
                            <input type="submit" class="btn btn-danger" name="deleteBtn" value="Eliminar mascota">
                        </form>
                    </div>
                </div>
                <?php include('modal/modificarpeso.php') ?>
            <?php else : ?>
                <hr>
                <form method="post" action="pacientes.php">
                    <input type='number' style="display:none" name='id' value=<?php echo $mascota['id_mascota'] ?>>
                    <div class='form-group'>
                        <div class="row">
                            <div class="col-12 col-lg-4 mt-2">
                                Raza: <select id="select_box" name='raza' class="form-control" required>
                                    <option value="" disabled selected>Seleccione la raza</option>
                                    <option value="Mestizo">Mestizo</option>
                                    <?php foreach ($razas as $row) : ?>
                                        <option value="<?php echo $row['raza'] ?>"><?php echo $row['raza'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class='col col-sm-6 col-lg-4 mt-2'>
                                Peso: <input class='form-control' type='tel' name='peso' required>
                            </div>
                            <div class='col col-sm-6 col-lg-4 mt-2'>
                                Edad: <input class='form-control' type='text' name='etapa' required >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-sm-6 mt-2">
                                Castrado: 
                                <select class="form-control" name='castrado' required>
                                    <option value="" disabled selected>Seleccione...</option>
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div class="col col-sm-6 mt-2">
                                Pelaje: 
                                <select class="form-control" name='pelaje' required>
                                    <option value="" disabled selected>Seleccione...</option>
                                    <option value="Típico de la especie">Típico de la especie</option>
                                    <option value="Negro">Negro</option>
                                    <option value="Blanco">Blanco</option>
                                    <option value="Beige">Beige</option>
                                    <option value="Marrón">Marrón</option>
                                    <option value="Aprico">Aprico</option>
                                    <option value="Abisinio">Abisinio</option>
                                    <option value="Atigrado">Atigrado</option>
                                    <option value="Calicoe">Calicoe</option>
                                    <option value="Otro">Otro</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-sm-6 mt-2 ">
                                Temperamento: 
                                <select class="form-control" name='temperamento' required>
                                    <option value="" disabled selected>Seleccione...</option>
                                    <option value="Dócil">Dócil</option>
                                    <option value="Bravo">Bravo</option>
                                    <option value="Medio">Medio</option>
                                </select>
                            </div>
                            <div class="col col-sm-6 mt-2">
                                Utilidad: 
                                <select class="form-control" name='utilidad' required>
                                    <option value="" disabled selected>Seleccione...</option>
                                    <option value="Mascota">Mascota</option>
                                    <option value="Trabajo">Trabajo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-center my-3">
                        <input class="btn btn-primary" type="submit" name="cargarDatos">
                    </div>
                </form>
                <div class="row d-flex justify-content-end">
                    <div class="col">
                        <form method="post" action="pacientes.php?datos_mascota=<?=$_GET['datos_mascota']?>">
                            <button type="submit" class="btn btn-danger mb-3" name="eliminar_M" value="<?php echo $mascota['id_mascota']; ?>">Eliminar Mascota</button>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <!--Informes de las visitas-->
    <?php if (isset($_GET['datos_mascota'])) : ?>

        <?php
        //No me deja ordenar (asc)
        $stmt = $conn->prepare("SELECT * FROM fichas WHERE id_mascota = " . $mascota['id_mascota'] . " ORDER BY fecha DESC LIMIT 1");
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
            <div class="container mt-3 p-3 border">
                <div class="h3">Ultima Visita: <?php echo $ficha['fecha']; ?></div>
                <div class="p"><b><i><?php echo $ficha['maniobra'] ?></i></b></div>
                <div class="p"><i>Descripción de la visita: </i><?= $ficha['descripcion'] ?></div>
                <div class="p"><i>Tratamiento: </i><?php echo $ficha['tratamiento'] ?></div>
                <?php if ($ficha['indicaciones']) : ?>
                    <div class="p"><i>Receta: </i><?php echo $ficha['indicaciones']; ?></div>
                <?php endif; ?>
            </div>
            <div class="container mt-3 d-flex justify-content-end">
                <a class="btn btn-primary mx-3" href="fichas.php?datos_mascota=<?= $mascota['id_mascota'] ?>">Nueva Ficha</a>
                <a class="btn btn-secondary" href="fichas_Display.php?datos_mascota=<?= $mascota['id_mascota'] ?>">Ver más fichas</a>
            </div>
        <?php else: ?>
            <div class="container mt-3 d-flex justify-content-end">
                <a class="btn btn-primary mx-3" href="fichas.php?datos_mascota=<?= $mascota['id_mascota'] ?>">Nueva Ficha</a>
            </div>
        <?php endif; ?>

    <?php endif; ?>
</body>

</html>

<script>
    $(document).ready(function() {
        $('select').selectize({
            sortField: 'text'
        });
    });
</script>