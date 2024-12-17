<?php
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idCentro = $_POST['idCentro'];

    $query = "DELETE FROM centrosRecoleccion WHERE idCentro=$idCentro";
    if (mysqli_query($conn, $query)) {
        echo "Centro de recolección eliminado con éxito";
    } else {
        echo "Error al eliminar el centro de recolección";
    }
}
?>
