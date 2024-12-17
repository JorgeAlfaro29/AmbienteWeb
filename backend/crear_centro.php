<?php
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $direccion = $_POST['direccion'];
    $provincia = $_POST['provincia'];

    $query = "CALL InsertarCentroRecoleccion('$direccion', '$provincia')";
    if (mysqli_query($conn, $query)) {
        echo "Centro de recolección agregado con éxito";
    } else {
        echo "Error al agregar el centro de recolección";
    }
}
?>
