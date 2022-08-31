<?php
include("div/connect.php");

$data = $_GET['datos_mascota'];

$stmt = $conn->prepare("SELECT nombre FROM mascotas WHERE id_mascota = $data");
$stmt->execute();
$results = $stmt->fetch(PDO::FETCH_ASSOC);

$title = $results["nombre"];

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
    <?php include("div/header.php") ?>
    <div class="container mt-5">
        <h3>Nueva ficha para <?= $title ?></h3>
    </div>
</body>