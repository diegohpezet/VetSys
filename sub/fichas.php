<?php
include("div/connect.php");
include("div/variables.php");

$id = $_GET['datos_mascota'];

$stmt = $conn->prepare("SELECT nombre FROM mascotas WHERE id_mascota = $id");
$stmt->execute();
$results = $stmt->fetch(PDO::FETCH_ASSOC);

$title = $results["nombre"];

if ($_POST) {
    $sql = "INSERT INTO fichas VALUES (NULL, $id, :mascota, :fecha, :maniobra, :descripcion, :estudios_complementarios, :diagnostico, :tratamiento, :indicaciones)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':mascota',$title);
    $stmt->bindParam(':fecha',$_POST['fecha']);
    $stmt->bindParam(':maniobra',$_POST['maniobra']);
    $stmt->bindParam(':descripcion',$_POST['descripcion']);
    $stmt->bindParam(':estudios_complementarios',$_POST['estudios_complementarios']);
    $stmt->bindParam(':diagnostico',$_POST['diagnostico']);
    $stmt->bindParam(':tratamiento',$_POST['tratamiento']);
    $stmt->bindParam(':indicaciones',$_POST['indicaciones']);

    if ($stmt->execute()) {
        header('Location: fichas_Display.php?datos_mascota=' . $id . '');
    } else {
        echo $sql;
    }
}
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../bootstrap/js/bootstrap.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css">

    <title>Fichas | MedSys</title>
</head>

<body>
    <!--Hacer form-->
    <?php include("div/header.php") ?>
    <div class="container">
        <div class="card card-4 mt-5 shadow">
            <div class="card-header text-light" style="background: #c44dff">
                <h3>Nueva ficha para <?= $title ?></h3>
            </div>
            <form method="post" action="fichas.php?datos_mascota=<?=$id?>">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="fechaInput">Fecha</label>
                                <input type="date" class="form-control" name="fecha" id="fechaInput" value="<?= date("Y-m-d"); ?>" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="especialidadInput">Maniobra</label>
                                <select class="form-select" name="maniobra" id="especialidadInput" required>
                                    <option disabled selected value>Seleccione...</option>
                                    <?php foreach ($maniobras as $row) : ?>
                                        <option value="<?= $row ?>"><?= $row ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <div class="form-group">
                                <label for="descInput">Descripción</label>
                                <textarea class="form-control" name="descripcion" id="descInput" placeholder="Informe de la visita..." rows=5></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <div class="form-group">
                                <label for="estudiosInput">Resultado de estudios complementarios</label>
                                <input type="text" class="form-control" name="estudios_complementarios" id="estudiosInput">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <div class="form-group">
                                <label for="diagInput">Diagnóstico / DX Presuntivo</label>
                                <input type="text" class="form-control" name="diagnostico" id="diagInput">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <div class="form-group">
                                <label for="tratamientoInput">Tratamiento</label>
                                <input type="text" class="form-control" name="tratamiento" id="tratamientoInput">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="indicacionesInput">Indicaciones</label>
                                <select class="form-control" name="indicaciones" id="indicacionesInput">
                                    <option disabled selected>Seleccione...</option>
                                    <optgroup label="Estudios">
                                        <?php foreach ($estudios as $row) : ?>
                                            <option value="<?= $row ?>"><?= $row ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="Estudios - Especialistas">
                                        <?php foreach ($estudios_especialistas as $row) : ?>
                                            <option value="<?= $row ?>"><?= $row ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="Derivaciones">
                                        <?php foreach ($derivaciones as $row) : ?>
                                            <option value="<?= $row ?>"><?= $row ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="mt-3 w-3 btn text-light" value="Agregar ficha" style="background: #c44dff">
            </form>
        </div>
    </div>
</body>
