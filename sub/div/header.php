<?php if ($user['status'] == 0): ?>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark ">
    <div class="container-fluid">
        <a class="navbar-brand" href="medsys.php" style="font-size: 30px;">MedSys</a>
        <button class=" navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Turnos</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="medsys.php">Mis turnos</a></li>
                        <li><a class="dropdown-item" href="sacarturno.php">Sacar turno</a></li>
                        <li><a class="dropdown-item" href="#">Modificar turno</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
            </ul>
        </div>
        <div class="navbar-brand d-flex">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" style="font-size: 25px;" href="#" role="button" data-bs-toggle="dropdown"> <?php echo $user['nombre'] ?></a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="mismascotas.php">Mis mascotas</a></li>
                        <li><a class="dropdown-item" href="logout.php">Cerrar Sesión</a></li>
                    </ul>
                </li>
            </ul>
        </div>
</nav>
<?php else: ?>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark ">
        <div class="container-fluid">
            <a class="navbar-brand" href="medsys.php" style="font-size: 30px;">MedSys</a>
            <button class=" navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Turnos</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="medsys.php">Todos los turnos</a></li>
                            <li><a class="dropdown-item" href="asignarturno.php">Asignar turno</a></li>
                            <li><a class="dropdown-item" href="#">Editar turno</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pacientes.php">Pacientes</a>
                    </li>
                </ul>
            </div>
            <div class="navbar-brand d-flex">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style="font-size: 25px;" href="#" role="button" data-bs-toggle="dropdown">
                        <img src="../img/user.png" alt="userlogo" style="width:40px;" class="rounded-pill"> <?php echo $user['nombre'] ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="logout.php">Cerrar Sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
    </nav>
    <?php endif; ?>