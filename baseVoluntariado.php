<?php
// Habilitar la visualización de errores en desarrollo
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Establecer la conexión con la base de datos
$servername = "localhost";
$username = "jorge";
$password = "1234";
$dbname = "baseVoluntariado";

$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el formulario fue enviado por el método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos del formulario
    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $areas = isset($_POST['areas']) ? implode(",", $_POST['areas']) : '';  // Áreas seleccionadas
    $mensaje = $_POST['mensaje'] ?? '';

    // Verificar si los campos requeridos están vacíos
    if (empty($nombre) || empty($apellido) || empty($email) || empty($telefono)) {
        echo "Por favor, complete todos los campos obligatorios.";
    } else {
        // Insertar en la tabla voluntariado (solicitud de voluntariado)
        $sql_voluntariado = "INSERT INTO voluntariado (nombre, apellido, correo, telefono, areas, mensaje) 
                            VALUES ('$nombre', '$apellido', '$email', '$telefono', '$areas', '$mensaje')";

        if ($conn->query($sql_voluntariado) === TRUE) {
            $last_id = $conn->insert_id; // Obtener el último ID insertado (idSolicitud)

            // Insertar en la tabla voluntario
            $sql_voluntario = "INSERT INTO voluntario (idSolicitud, idArea, apellido, correo, telefono, mensaje) 
                                VALUES ($last_id, NULL, '$apellido', '$email', '$telefono', '$mensaje')";

            if ($conn->query($sql_voluntario) === TRUE) {
                // Si todo se ha insertado correctamente
                echo "¡Gracias por registrarte como voluntario! Nos pondremos en contacto contigo.";
            } else {
                // Mostrar error si falla la inserción en la tabla voluntario
                echo "Error al insertar en la tabla voluntario: " . $conn->error;
            }

        } else {
            // Mostrar error si falla la inserción en la tabla voluntariado
            echo "Error al insertar en la tabla voluntariado: " . $conn->error;
        }
    }
} else {
    echo "Por favor, envíe el formulario correctamente.";
}

// Cerrar la conexión
$conn->close();
?>
