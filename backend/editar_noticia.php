<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conexion = new mysqli("localhost", "root", "", "proyecto");
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $id = $conexion->real_escape_string($_POST['id']);
    $titulo = $conexion->real_escape_string($_POST['titulo']);
    $cuerpo = $conexion->real_escape_string($_POST['cuerpoNoticia']);
    $fecha = $conexion->real_escape_string($_POST['fecha']);

    $query = "UPDATE Noticias SET Titulo='$titulo', cuerpoNoticia='$cuerpo', Fecha='$fecha' WHERE idNoticia=$id";
    if ($conexion->query($query)) {
        header("Location: /AmbienteWeb/noticias.php");
    } else {
        echo "Error: " . $conexion->error;
    }

    $conexion->close();
}
?>
