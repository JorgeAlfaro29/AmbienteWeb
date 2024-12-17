<?php
include('db_connection.php'); // Asegúrate de tener la conexión a la base de datos

$query = "SELECT * FROM centrosRecoleccion";
$result = mysqli_query($conn, $query);

$centros = [];
while ($row = mysqli_fetch_assoc($result)) {
    $centros[] = $row;
}

echo json_encode($centros);
?>
