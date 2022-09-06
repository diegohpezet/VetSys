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
        <form method="get">
            <select class="select-box" name='turno_id' onchange="this.form.submit()">
                <option selected value>Seleccione el turno</option>
                <?php foreach ($turnos as $row) : ?>
                    <option value="<?php echo $row['id'] ?>"><?php echo "N°: ", $row['id'], " | Cliente: ", $row['cliente'], " | Mascota: ", $row['mascota'], " | Asunto: ", $row['asunto'], " | Fecha: ", $row['start'], " | status: ", $row['status']?></option>
                <?php endforeach ?>
            </select>
        </form>
    </div>
    <?php if (isset($_GET['turno_id'])) : ?>
        <?php foreach ($turno as $row_turno) : ?>
            <div class="container mt-4 border shadow">
                <h2 class="h3"><?php echo "N° del turno: ", $row_turno['id'] ?></h2>
                <p class="h5"><?php echo "Cliente: ", $row_turno['cliente'] ?></p>
                <p class="h6" style="<?php if($row_turno['status']=="Confirmado"){echo "color:green;";}else if($row_turno['status']=="Cancelado"){echo "color:red;";}?>"><?php echo "Status: ", $row_turno['status'] ?></p>
                <form method="post">
                    <i>Mascota : </i>
                    <select name="mascota" required>
                        <option value=<?php echo $row_turno['mascota']; ?>><?php echo $row_turno['mascota']; ?></option>
                        <?php foreach ($mascotas as $row_mascotas) : ?>
                            <option value="<?php echo $row_mascotas['nombre'] ?>"><?php echo $row_mascotas['nombre'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <i>Especialidad:</i>
                    <select name="especialidad" required>
                        <option value=<?php echo $row_turno['asunto']; ?>><?php echo $row_turno['asunto']; ?></option>
                        <?php foreach ($especialidades as $row_especialidades) : ?>
                            <option value="<?php echo $row_especialidades['especialidad'] ?>"><?php echo $row_especialidades['especialidad'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="p-2 d-flex justify-content-center">
                        <i>Fecha:</i>
                        <input type="date" name="fecha" value=<?php echo $row_turno['start'] ?> class="input mx-2" required>
                        <!-- El apartado de actualizacion de titulo no funciona
                        <i>Title:</i>
                        <input type="text" name="title" class="input mx-2"> -->
                    </div>
                    <div class="d-flex justify-content-center mt-3 text-white">
                        <input class="btn btn-danger mx-2" type="submit" name="eliminarturno" value="Eliminar">
                        <input class="btn btn-primary mx-2" type="submit" name="editarturno" value="Editar">
                    </div>
                </form>
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