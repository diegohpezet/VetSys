<?php

if(array_key_exists('submitBtn', $_POST)) {
    cargarMascota();
}

function cargarMascota() {
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
?>


<!--Sacar turno Modal-->
<div class="modal fade" id="modalMascota">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h3 style="padding: 0px;margin: 5px;">Cargar nueva mascota</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="container">
                    <br>
                    <form action="pacientes.php" method="POST">
                        <h3 class="h3">Datos del dueño</h3>
                        <div class="row">
                            <div class="col">
                                <input type="tel" class="form-control" name="dni_dueño" placeholder="* DNI" required>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="nombre_dueño" placeholder="* Nombre y Apellido" required> 
                            </div>
                        </div>
                        <hr>
                        <h3 class="h3">Datos de la mascota</h3>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" name="nombre" placeholder="* Nombre" required>
                            </div>
                            <div class="col">
                                <select class="form-control" name="sexo" required>
                                    <option disabled selected value>* Sexo</option>
                                    <option value="Macho">Macho</option>
                                    <option value="Hembra">Hembra</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <select class="form-control mt-2" name="especie" required>
                                    <option disabled selected value>* Especie</option>
                                    <option value="Perro">Perro</option>
                                    <option value="Gato">Gato</option>
                                </select>
                            </div>
                        </div>
                        <input type="submit" name="submitBtn" style="margin: 2px;margin-top: 10px;" class="btn btn-success" value="Crear Mascota">
                    </form>
                    <?php if (!empty($message)) : ?>
                        <p><?= $message ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
