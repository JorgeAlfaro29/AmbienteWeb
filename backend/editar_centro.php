<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "proyecto");

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Verificar si los datos se envían por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $provincia = $conexion->real_escape_string($_POST['provincia']);
    $direccion = $conexion->real_escape_string($_POST['direccion']);

    // Consulta para actualizar el centro de recolección existente
    $query = "UPDATE CentrosRecoleccion SET Provincia = '$provincia', Direccion = '$direccion' WHERE idCentro = $id";

    if ($conexion->query($query) === TRUE) {
        header("Location: ../centros_recoleccion.php");
        exit();
    } else {
        echo "Error al actualizar: " . $conexion->error;
    }
} else {
    echo "Método de solicitud no válido.";
}

// Cerrar conexión
$conexion->close();
?>
