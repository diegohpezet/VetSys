<?php
include("div/connect.php");
// Trayendo todos los turnos
$stmt = $conn->prepare("SELECT * FROM `turnos` ORDER BY `turnos`.`start` DESC ");
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
    $querry = $conn->prepare("SELECT * FROM `turnos` WHERE id=:id");
    $querry->bindParam(':id', $_GET['turno_id']);
    $querry->execute();
    $result_turno = $querry->fetchAll();

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

    // trayendo las especialidades
    $stmt = $conn->prepare("SELECT * FROM `especialidades` WHERE 1");
    $stmt->execute();
    $results_especialidades = $stmt->fetchAll();
    $especialidades = null;
    if (is_countable($results_especialidades)) {
        if (count($results_especialidades) != 0) {
            $especialidades = $results_especialidades;
        }
    }

    // actualizando los datos
    if(isset($_POST['editarturno'])){
        
        //sacando la id de mascota segun el nombre para actualizar la id de mascota del turno
        $stmt = $conn->prepare("SELECT id_mascota FROM mascotas WHERE nombre=:mascota ");
        $stmt->bindparam(':mascota',$_POST['mascota']);
        $stmt->execute();
        $mascotas_id = $stmt->fetchAll();
        $id_mascotas = null;
        if (is_countable($mascotas_id)) {
            if (count($mascotas_id) != 0) {
                $id_mascotas = $mascotas_id;
            }
        }
        foreach($mascotas_id as $row_mascotas):
            $id_mascotas = $row_mascotas['id_mascota'];
        endforeach;

        // falta unicamente actualizar el title sql = title`=:title $stmt->bindparam(':title',$_POST['title']); 
        //ejecutando la actualización de la tabla turnos
        $update = $conn->prepare("UPDATE `turnos` SET `title`=:title,`asunto`=:especialidad,`id_mascota`=:id_mascotas,`mascota`=:mascota,`start`=:fecha WHERE id=:id ");
        $update->bindparam(':id', $_GET['turno_id']);
        $update->bindparam(':mascota', $_POST['mascota']);
        $update->bindparam(':especialidad', $_POST['especialidad']);
        $update->bindparam(':fecha', $_POST['fecha']);
        $update->bindparam(':id_mascotas', $id_mascotas);
        $update->bindValue(':title',$_POST['mascota'].' | '.$_POST['especialidad']);
        
        $mensaje=null;
       // varificacion de la actualización
        if($update->execute()){
            header('refresh:0');
            $mensaje="Actualizacion exitosa";
        }
    }
    if(isset($_POST['eliminarturno'])){
        // obtener la id del turno seleccionado para eliminarlo
        $id=$_GET['turno_id'];
       //ejecutando la eliminación de la tabla turnos
        $drop = $conn->prepare("DELETE FROM turnos where id='$id' ");
        
        $mensaje=null;
       // varificacion de la eliminación
        if($drop->execute()){
            header('Location: medsys.php');
            $mensaje="Eliminación exitosa";
        }
    }
}
include('modal/editarturno.php');
