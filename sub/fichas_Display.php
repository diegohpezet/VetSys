<?php
include("div/connect.php");

$data = $_GET['datos_mascota'];

$stmt = $conn->prepare("SELECT nombre FROM mascotas WHERE id_mascota = $data");
$stmt->execute();
$results = $stmt->fetch(PDO::FETCH_ASSOC);

$title = $results["nombre"];

$stmt = $conn->prepare("SELECT * FROM fichas WHERE id_mascota = $data");
$stmt->execute();
$results = $stmt->fetchAll();

$ficha = null;

if (count($results) > 0) {
    $ficha = $results;
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="../img/logo.png">
    <title>Fichas | MedSys</title>
</head>

<body>
    <?php include("div/header.php") ?>
    <div class="container mt-5">
        <h3>Fichas de <?= $title ?></h3>
        <!----------Display de Fichas---------->
        <?php if ($ficha) : ?>
            <div class="row">
            <?php foreach ($ficha as $row) : ?>
                <div class="col-xs-2 col-md-6 col-lg-4 card text-center mt-3">
                    <div class="card-header bg-primary text-light">
                        <h5><?= date('m/d/Y', strtotime($row['fecha'])) ?></h5>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $row['maniobra'] ?></h5>
                        <p class="card-text"><?= $row['descripcion'] ?></p>
                        <?php if($row['estudios_complementarios']): ?>
                            <p class="card-text"><b>Tratamiento: </b><?= $row['estudios_complementarios'] ?></p>
                        <?php endif; ?>
                        <?php if($row['diagnóstico']): ?>
                            <p class="card-text"><b>Diagnóstico: </b><?= $row['diagnóstico'] ?></p>
                        <?php endif; ?>
                        <?php if($row['tratamiento']): ?>
                            <p class="card-text"><b>Tratamiento: </b><?= $row['tratamiento'] ?></p>
                        <?php endif; ?>
                        <?php if($row['indicaciones']): ?>
                            <p class="card-text"><b>Receta: </b><?= $row['indicaciones'] ?></p>
                        <?php endif; ?>
                        
                        <p class="card-text text-muted"></p>
                    </div>
                    <div class="card-footer bg-primary"></div>
                </div>
            <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <!------------------------------------>
    </div>
</body>