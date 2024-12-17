<?php
$conexion = new mysqli("localhost", "root", "", "proyecto");
if ($_POST) {
    $provincia = $_POST['provincia'];
    $direccion = $_POST['direccion'];
    $conexion->query("INSERT INTO CentrosRecoleccion (Provincia, Direccion) VALUES ('$provincia', '$direccion')");
}
header("Location: ../centros_recoleccion.php");
?>
