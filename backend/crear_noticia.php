<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conexion = new mysqli("localhost", "root", "", "proyecto");
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $titulo = $conexion->real_escape_string($_POST['titulo']);
    $cuerpo = $conexion->real_escape_string($_POST['cuerpo']);
    $fecha = $conexion->real_escape_string($_POST['fecha']);

    $query = "INSERT INTO Noticias (Titulo, cuerpoNoticia, Fecha) VALUES ('$titulo', '$cuerpo', '$fecha')";
    if ($conexion->query($query)) {
        header("Location: /AmbienteWeb/noticias.php");
    } else {
        echo "Error: " . $conexion->error;
    }

    $conexion->close();
}
?>
