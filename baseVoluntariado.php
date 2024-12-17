<?php
// Conexion a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "baseVoluntariado";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir datos del formulario
$nombre = $_POST['name'];
$apellido = $_POST['apellido'];
$correo = $_POST['email'];
$telefono = $_POST['phone'];
$areas = $_POST['areas']; // Este campo es un arreglo
$mensaje = $_POST['message'];

// Insertar en la tabla `voluntariado`
$sql = "INSERT INTO voluntariado (nombre, apellido, correo, telefono, mensaje)
        VALUES ('$nombre', '$apellido', '$correo', '$telefono', '$mensaje')";

if ($conn->query($sql) === TRUE) {
    // Obtener el id de la solicitud insertada
    $idSolicitud = $conn->insert_id;

    // Si hay áreas seleccionadas, insertarlas en la tabla `voluntario`
    if (!empty($areas)) {
        foreach ($areas as $area) {
            // Insertar cada área en la tabla `voluntario`
            $sql_voluntario = "INSERT INTO voluntario (idSolicitud, idArea)
                               VALUES ('$idSolicitud', '$area')";
            $conn->query($sql_voluntario);
        }
    }

    echo "¡Gracias por tu interés! Hemos recibido tu solicitud.";
} else {
    echo "Error al enviar tu solicitud: " . $conn->error;
}

$conn->close();
?>
