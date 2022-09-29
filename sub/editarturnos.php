<?php
include("div/connect.php");
include("div/variables.php");

$mensaje=null;

// Trayendo todos los turnos
$stmt = $conn->prepare("SELECT * FROM `turnos` WHERE DATE(start) >= CURDATE() ORDER BY `turnos`.`start` DESC ");
$stmt->execute();
$results_turnos = $stmt->fetchAll();

$turnos = null;

if (is_countable($results_turnos)) {
    if (count($results_turnos) != 0) {
        $turnos = $results_turnos;
    }
}
// Seleccion del turno
if (isset($_GET['turno_id'])) {
    // trayendo la informacion del tuno seleccionado
    $query = $conn->prepare("SELECT * FROM `turnos` WHERE id=:id");
    $query->bindParam(':id', $_GET['turno_id']);
    $query->execute();
    $result_turno = $query->fetchAll();

    $turno = null;

    if (is_countable($result_turno)) {
        if (count($result_turno) != 0) {
            $turno = $result_turno;
        }
    }

    //trayendo las mascotas del cliente
    $dni_cliente = null;
    foreach ($turno as $row_turno) :
        $dni_cliente = $row_turno['dni_cliente'];
        $stmt = $conn->prepare("SELECT * FROM mascotas WHERE id_dueño='$dni_cliente' ");
        $stmt->execute();
        $results_mascotas = $stmt->fetchAll();
        $mascotas = null;
        
        if (is_countable($results_mascotas)) {
            if (count($results_mascotas) != 0) {
                $mascotas = $results_mascotas;
            }
        }
    endforeach;

    // actualizando los datos
    if(isset($_POST['editarturno'])){

        $mascota = $conn->prepare("SELECT nombre FROM mascotas WHERE id_mascota = ".$_POST['id_mascota']."");
        $mascota->execute();
        $nombre = $mascota->fetchColumn();
        
        $update = $conn->prepare("UPDATE `turnos` SET `title`=:title,`asunto`=:especialidad,`id_mascota`=:id_mascotas,`mascota`=:mascota,`start`=:fecha WHERE id=:id ");
        $update->bindparam(':id', $_GET['turno_id']);
        $update->bindparam(':mascota', $nombre);
        $update->bindparam(':especialidad', $_POST['especialidad']);
        $update->bindparam(':fecha', $_POST['fecha']);
        $update->bindparam(':id_mascotas', $_POST['id_mascota']);
        $update->bindValue(':title',$nombre.' | '.$_POST['especialidad']);
        
       // varificacion de la actualización
        if($update->execute()){
            header('refresh');
            $mensaje="Actualizacion exitosa";
        }
    }
    if(isset($_POST['eliminarturno'])){
        // Obtener la id del turno seleccionado para eliminarlo
        $id=$_GET['turno_id'];
       //Ejecutando la eliminación de la tabla turnos
        $drop = $conn->prepare("DELETE FROM turnos where id='$id' ");
        
        
       // Verificacion de la eliminación
        if($drop->execute()){
            header('Location: medsys.php');
            $mensaje="Eliminación exitosa";
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
    <title>Editar turno | MedSys</title>
</head>

<body>
    <?php include('div/header.php'); ?>
    <div class="container mt-3">
        <?php if($turnos): ?>
        <form method="get">
            <select class="select-box" name='turno_id' onchange="this.form.submit()">
                <option selected value>Seleccione el turno</option>
                <?php foreach ($turnos as $row) : ?>
                    <option value="<?php echo $row['id'] ?>"><?php echo "N°: ", $row['id'], " | Cliente: ", $row['cliente'], " | Mascota: ", $row['mascota'], " | Asunto: ", $row['asunto'], " | Fecha: ", $row['start'], " | status: ", $row['status']?></option>
                <?php endforeach ?>
            </select>
        </form>
        <?php else: ?>
            <h5><?= "No hay turnos pendientes" ?></h5>
        <?php endif; ?>
    </div>
    <?php if (isset($_GET['turno_id'])) : ?>
        <?php foreach ($turno as $row_turno) : ?>
            <div class="container mt-4 border shadow">
                <h2 class="h3"><?php echo "N° del turno: ", $row_turno['id'] ?></h2>
                <p class="h5"><?php echo "Cliente: ", $row_turno['cliente'] ?></p>
                <p class="h6" style="<?php if($row_turno['status']=="Confirmado"){echo "color:green;";}else if($row_turno['status']=="Cancelado"){echo "color:red;";}?>"><?php echo "Estado: ", $row_turno['status'] ?></p>
                <form method="post">
                    <i>Mascota : </i>
                    <select name="id_mascota" required>
                        <?php foreach ($mascotas as $row_mascotas) : ?>
                            <option value="<?php echo $row_mascotas['id_mascota'] ?>"><?php echo $row_mascotas['nombre'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <i>Especialidad:</i>
                    <select name="especialidad" required>
                        <option value=<?php echo $row_turno['asunto']; ?>><?php echo $row_turno['asunto']; ?></option>
                        <?php foreach ($maniobras as $row_maniobras) : ?>
                            <option value="<?php echo $row_maniobras ?>"><?php echo $row_maniobras ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="p-2 d-flex justify-content-center">
                        <i>Fecha:</i>
                        <input type="date" name="fecha" value=<?php echo $row_turno['start'] ?> class="input mx-2" required>
                    </div>
                    <div class="d-flex justify-content-center mt-3 text-white">
                        <input class="btn btn-danger mx-2" type="submit" name="eliminarturno" value="Eliminar">
                        <input class="btn btn-primary mx-2" type="submit" name="editarturno" value="Editar">
                    </div>
                </form>
                <?php if($mensaje): ?>
                    <p><?=$mensaje?></p>
                <?php endif;?>
            </div>
        <?php endforeach ?>
    <?php endif; ?>
</body>

<script>
    $(document).ready(function() {
        $('select').selectize({
            sortField: 'text'
        });
    });
</script>
