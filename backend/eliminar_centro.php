<?php
$conexion = new mysqli("localhost", "root", "", "proyecto");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conexion->query("DELETE FROM CentrosRecoleccion WHERE idCentro=$id");
}
header("Location: ../centros_recoleccion.php");
?>
