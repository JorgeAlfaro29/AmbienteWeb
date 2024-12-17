<?php

class Voluntario {
    public $nombre;
    public $apellido;
    public $correo;
    public $telefono;
    public $idAreas;
    public $mensaje;

    public function __construct($nombre, $apellido, $correo, $telefono, $idAreas, $mensaje) {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->correo = $correo;
        $this->telefono = $telefono;
        $this->idAreas = $idAreas;
        $this->mensaje = $mensaje;
    }
}


interface UserDAO {
    public function InsertarVoluntario($nombre, $apellido, $correo, $telefono, $idAreas, $mensaje);
}


class UserDAOSpImpl implements UserDAO {
    private $conn;

    public function __construct() {
        
        $this->conn = new mysqli("localhost", "jorge", "1234", "proyecto");

        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
    }

    public function InsertarVoluntario($nombre, $apellido, $correo, $telefono, $idAreas, $mensaje) {
        
        $function_conn = $this->conn;
        $stmt = $function_conn->prepare("CALL InsertarVoluntario(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $nombre, $apellido, $correo, $telefono, $idAreas, $mensaje);
        $stmt->execute();
    }
}

$userDao = new UserDAOSpImpl();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $idAreas = $_POST['areaInteres'] ?? '';
    $mensaje = $_POST['message'] ?? '';


    $userDao->InsertarVoluntario($nombre, $apellido, $correo, $telefono, $idAreas, $mensaje);


    header("Location: AmbienteWeb/voluntariado.php");
    exit();
} else {
    echo "Error al procesar la solicitud.";
}
    
?>
