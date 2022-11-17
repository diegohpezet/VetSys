<html>
<?php if ($user['status'] == 0) : ?>
    <ul class="nav justify-content-between text-light px-3" style="background-color: #c44dff">
        <li class="nav-item">
            <a><i class="fa-brands fa-whatsapp"></i> +54 9 11 6165-5190</a>
        </li>
        <li class="nav-item">
            <a><i class="fa-solid fa-at"></i> placzekpatricia@gmail.com</a>
        </li>
    </ul>
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="medsys.php" style="font-size: 30px;">
            Vetsys <img src="../img/logovetsys.png" width="30" height="30" class="d-inline-block align-content-center" alt="logo">    
             </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="medsys.php">Turnos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="precios.php" >Precios</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"> <?php echo $user['nombre'] ?></a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="mismascotas.php">Mis mascotas</a></li>
                            <li><a class="dropdown-item" href="logout.php">Cerrar Sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<?php else : ?>
    <nav class="navbar navbar-expand-md navbar-light bg-light shadow">
        <div class="container-fluid">
            <a class="navbar-brand" href="medsys.php" style="font-size: 30px;">
            Vetsys <img src="../img/logovetsys.png" width="30" height="30" class="d-inline-block align-top" alt="">  
            </a>
            <button class=" navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Turnos</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="medsys.php">Todos los turnos</a></li>
                            <li><a class="dropdown-item" href="asignarturno.php">Asignar turno</a></li>
                            <li><a class="dropdown-item" href="editarturnos.php">Editar turno</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pacientes.php">Pacientes</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><?php echo $user['nombre'] ?></a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="logout.php">Cerrar Sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
    </nav>
<?php endif; ?>

</html>
