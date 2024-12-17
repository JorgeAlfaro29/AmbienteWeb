<?php
// Iniciar sesión
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: /AmbienteWeb/login.html");
    exit();
}

// Verificar si se ha proporcionado un ID de noticia
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID de noticia no válido.";
    exit();
}

// Obtener el ID de la noticia a eliminar
$idNoticia = intval($_GET['id']);

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "proyecto");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Eliminar la noticia de la base de datos
$query = "DELETE FROM Noticias WHERE idNoticia = ?";
$stmt = $conexion->prepare($query);

if ($stmt) {
    $stmt->bind_param("i", $idNoticia);
    if ($stmt->execute()) {
        header("Location: /AmbienteWeb/noticias.php"); // Redirigir a la página de noticias
        exit();
    } else {
        echo "Error al eliminar la noticia: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Error al preparar la consulta: " . $conexion->error;
}

// Cerrar la conexión
$conexion->close();
?>
