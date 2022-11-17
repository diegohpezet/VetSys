<?php
include("div/connect.php");
include("div/variables.php");

$json = file_get_contents('../priceList/priceList.json');
$json_data = json_decode($json,true);
$precio = $json_data['prices'];
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="icon" href="../img/logo.png">
    <title>Lista de precios | MedSys</title>
</head>

<body>
    <div class="container mt-3">
        <h3 class="h3">Lista de precios</h3>
        <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <i>Consulta</i>
                <a>$<?= $precio['consulta'] ?></a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <i>Vacunas</i>
                <a>$<?= $precio['vacunas'] ?></a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <i>Eutanasia</i>
                <a>$<?= $precio['eutanasia'] ?></a>
            </li>
            <li class="list-group-item">
                <i>Castraciones</i>
                <ul>
                    <li class="list-group-flush d-flex justify-content-between align-items-center">
                        <i>Gatos (en gral.) y perros chicos</i>
                        <a>$<?= $precio['castraciones']['chicos'] ?></a>
                    </li>
                    <li class="list-group-flush d-flex justify-content-between align-items-center">
                        <i>Perros medianos</i>
                        <a>$<?= $precio['castraciones']['medianos'] ?></a>
                    </li>
                    <li class="list-group-flush d-flex justify-content-between align-items-center">
                        <i>Perros grandes</i>
                        <a>$<?= $precio['castraciones']['grandes'] ?></a>
                    </li>
                    <li class="list-group-flush d-flex justify-content-end align-items-center text-muted">Incluye medicación inyectable y comprimidos</li>
                </ul>
            </li>
            <li class="list-group-item">
                <i>Desparasitarios externos</i>
                <ul>
                    <li class="list-group-flush d-flex justify-content-between align-items-center">
                        <i>Pipetas</i>
                        <a>$<?= $precio['desparasitarios']['pipetas'] ?></a>
                    </li>
                    <li class="list-group-flush d-flex justify-content-between align-items-center">
                        <i>Comprimidos</i>
                        <a>$<?= $precio['desparasitarios']['comprimidos'] ?></a>
                    </li>
                </ul>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <i>Desparasitarios internos</i>
                <a>$<?= $precio['desparasitarios']['internos'] ?></a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <i>Miasis</i>
                <a>Desde $<?= $precio['miasis'] ?></a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <i>Otohematoma</i>
                <a>Desde $<?= $precio['otohematoma'] ?></a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <i>Corte de uñas</i>
                <a>$<?= $precio['corte de uñas'] ?></a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <i>Vendajes</i>
                <a>Desde $<?= $precio['vendajes'] ?></a>
            </li>
            <li class="list-group-item">
                <i>Limpieza de heridas</i>
                <ul>
                    <li class="list-group-flush d-flex justify-content-between align-items-center">
                        <i>Limpieza quirúrgica</i>
                        <a>Desde $<?= $precio['limpieza quirúrgica'] ?></a>
                    </li>
                    <li class="list-group-flush d-flex justify-content-between align-items-center">
                        <i>Limpieza no quirúrgica</i>
                        <a>Desde $<?= $precio['limpieza no quirúrgica'] ?></a>
                    </li>
                    <li class="list-group-flush d-flex justify-content-end align-items-center text-muted">La diferencia entre una y otra radica en el uso de anestesia</li>
                </ul>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <i>Sutura de heridas</i>
                <a>Desde $<?= $precio['sutura de heridas'] ?></a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <i>Venta de fármacos</i>
                <a>$<?= $precio['venta de farmacos'] ?></a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <i>FLUTD</i>
                <a>$<?= $precio['flutd'] ?></a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <i>Cistocentesis</i>
                <a>$<?= $precio['cistocentesis'] ?></a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <i>Abdominocentesis</i>
                <a>Desde $<?= $precio['abdominocentesis'] ?></a>
            </li>
            <li class="list-group-item">
                <i>Muestras laboratorio</i>
                <ul>
                    <li class="list-group-flush d-flex justify-content-between align-items-center">
                        <i>Perfil sanguíneo completo (incluye enzimas hepáticas , urea y creatinina)</i>
                        <a>$<?= $precio['muestras laboratorio']['sangre'] ?></a>
                    </li>
                    <li class="list-group-flush d-flex justify-content-between align-items-center">
                        <i>Orina</i>
                        <a>$<?= $precio['muestras laboratorio']['orina'] ?></a>
                    </li>
                    <li class="list-group-flush d-flex justify-content-between align-items-center">
                        <i>Tiroideo básico</i>
                        <a>$<?= $precio['muestras laboratorio']['tiroideo_básico'] ?></a>
                    </li>
                    <li class="list-group-flush d-flex justify-content-between align-items-center">
                        <i>Tiroideo completo</i>
                        <a>$<?= $precio['muestras laboratorio']['tiroideo_completo'] ?></a>
                    </li>
                    <li class="list-group-flush d-flex justify-content-between align-items-center">
                        <i>Dosaje de fenobarbital</i>
                        <a>$<?= $precio['muestras laboratorio']['dosaje_fenobarbital'] ?></a>
                    </li>
                    <li class="list-group-flush d-flex justify-content-between align-items-center">
                        <i>Coproparasitológico</i>
                        <a>$<?= $precio['muestras laboratorio']['coproparasitológico'] ?></a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</body>

</html>