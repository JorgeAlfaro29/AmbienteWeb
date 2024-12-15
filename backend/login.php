<?php
session_start();

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "proyecto");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Obtener datos del formulario
$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];

// Consultar en la base de datos
$sql = "SELECT * FROM admin WHERE usuario = ? AND contraseña = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ss", $usuario, $contraseña);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    // Usuario válido
    $_SESSION['usuario'] = $usuario;
    header("Location: ../noticias.php");
    exit();
} else {
    echo "<script>alert('Usuario o contraseña incorrectos'); window.location.href='../login.html';</script>";
}

$stmt->close();
$conexion->close();
?>
