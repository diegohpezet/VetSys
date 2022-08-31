<?php
$row = $conn->prepare("SELECT * FROM mascotas WHERE id_dueño=:dni");
$row->bindParam('dni', $user['dni']);
$row->execute();
$mascota = $row->fetchAll();

$row = $conn->prepare("SELECT especialidad FROM especialidades ORDER BY especialidad");
$row->execute();
$asunto = $row->fetchAll();

if (!empty($_POST['id_mascota']) && !empty($_POST['asunto']) && !empty($_POST['fecha'])) {
    $row = $conn->prepare("SELECT nombre FROM mascotas WHERE id_mascota = " . $_POST['id_mascota'] . "");
    $row->execute();
    $nombre = $row->fetchColumn();

    $sql = "INSERT INTO turnos (title,dni_cliente,cliente,asunto,id_mascota,mascota,status,start,domicilio) values 
        (:title,:dni,'" . $user['nombre'] . " " . $user['apellido'] . "',:asunto,:id_mascota,:mascota,'Pendiente',:fecha,:domicilio)";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':title', $nombre ." | ". $_POST['asunto']);
    $stmt->bindParam(':dni', $user['dni']);
    $stmt->bindParam(':asunto', $_POST['asunto']);
    $stmt->bindParam(':id_mascota', $_POST['id_mascota']);
    $stmt->bindParam(':mascota', $nombre);
    $stmt->bindParam(':fecha', $_POST['fecha']);
    $stmt->bindParam(':domicilio', $_user['domicilio']);
    if ($stmt->execute()) {
        $message = 'Turno solicitado';
        echo "<meta http-equiv='refresh' content='0'>";
    } else {
        $message = 'Error. Revise los datos';
    }
}
?>


<!--Sacar turno Modal-->
<div class="modal fade" id="modalSacarTurno">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h3 style="padding: 0px;margin: 5px;">Sacar turno</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="container">
                    <br>
                    <form action="medsys.php" method="POST">
                        <div class="row">
                            <div class="col-sm-5">
                                <select class="form-select" name="id_mascota" required>
                                    <option disabled selected value>Mascota</option>
                                    <?php foreach ($mascota as $row) : ?>
                                        <option value="<?php echo $row['id_mascota'] ?>"><?php echo $row['nombre'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <select class="form-select" name="asunto" required>
                                    <option disabled selected value>Asunto</option>
                                    <?php foreach ($asunto as $row) : ?>
                                        <option value="<?php echo $row['especialidad'] ?>"><?php echo $row['especialidad'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input name="fecha" class="form-control mt-3" type="date" required />
                            </div>
                        </div>
                        <input type="submit" style="margin: 2px;margin-top: 10px;" class="btn btn-success" value="Sacar Turno">
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