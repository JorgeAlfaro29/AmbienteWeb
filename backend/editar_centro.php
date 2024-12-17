<?php
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idCentro = $_POST['idCentro'];
    $direccion = $_POST['direccion'];
    $provincia = $_POST['provincia'];

    $query = "UPDATE centrosRecoleccion SET Direccion='$direccion', Provincia='$provincia' WHERE idCentro=$idCentro";
    if (mysqli_query($conn, $query)) {
        echo "Centro de recolección actualizado con éxito";
    } else {
        echo "Error al actualizar el centro de recolección";
    }
}
?>
