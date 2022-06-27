<?php
include("div/connect.php");
//Extracion de los clientes
//Saco todos los datos de turnos
$turnos = $conn->prepare("SELECT * FROM turnos WHERE 1 ");
$turnos->execute();
$result_turnos = $turnos->fetchAll();

$tur = null;

if (is_countable($result_turnos)) {
    if (count($result_turnos) != 0) {
        $tur = $result_turnos;
    }
}
//guardo el dni del cliente

$stmt = $conn->prepare("SELECT * FROM user WHERE status = 0 ORDER BY nombre desc");

$stmt->execute();
$results_clientes = $stmt->fetchAll();

$clientes = null;

if (is_countable($results_clientes)) {
    if (count($results_clientes) != 0) {
        $clientes = $results_clientes;
    }
}





?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todos los turnos</title>
</head>

<body>
    <?php foreach ($clientes as $row) { 
        foreach ($tur as $rowTunos) {
            $dnicli = $rowTunos['dni_cliente'];
            if ($dnicli == $row['dni']) { ?>
                <div class="container mt-3 border p-3">
                    <tr>
                        <td><?php echo "Turno: " . $rowTunos['nro_Turno']; ?><br><?php echo "DNI: " . $row['dni']; ?><br><?php echo "Dueño: " . $row['nombre'], " " . $row['apellido'] ?></td>
                        <td><br><?php echo "Mascota: " . $rowTunos['mascota']; ?></td>
                        <td><br><?php echo "Asunto: " . $rowTunos['asunto']; ?></td>
                        <td><br><?php echo "Fecha: " . $rowTunos['fecha']; ?></td>
                    </tr>
                </div>
    <?php 
        }
        }
        }
    ?>
</body>

</html>