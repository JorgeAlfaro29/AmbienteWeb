<?php


    class contacto {
        public $nombre;
        public $primerApellido;
        public $segundoApellido;
        public $email;
        public $numeroTelefono;
        public $mensaje;

        public function __construct($nombre, $primerApellido, $segundoApellido, $email,$numeroTelefono, $mensaje ) {
            $this->nombre = $nombre;
            $this->primerApellido = $primerApellido;
            $this->segundoApellido = $segundoApellido;
            $this->email = $email;
            $this->numeroTelefono = $numeroTelefono;
            $this->mensaje = $mensaje;
        }
    }

    interface UserDAO {
        public function InsertarContacto($nombre, $primerApellido, $segundoApellido, $email,$numeroTelefono, $mensaje);
    }

    class UserDAOSpImpl implements UserDAO {

        private $conn;

        public function __construct() {
            $this->conn = new mysqli("localhost", "jorge", "1234", "proyecto");

            if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
        }

        public function InsertarContacto($nombre, $primerApellido, $segundoApellido, $email,$numeroTelefono, $mensaje) {
            $function_conn = $this->conn;
            $stmt = $function_conn->prepare("CALL InsertarContacto(?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $nombre, $primerApellido, $segundoApellido, $email,$numeroTelefono, $mensaje);
            $stmt->execute();
        }
    }

    $userDao = new UserDAOSpImpl();
    
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = $_POST['nombre'] ?? '';
        $primerApellido = $_POST['primerApellido'] ?? '';
        $segundoApellido = $_POST['segundoApellido'] ?? '';
        $email = $_POST['email'] ?? '';
        $numeroTelefono = $_POST['numeroTelefono'] ?? '';
        $mensaje = $_POST['mensaje'] ?? '';
        $userDao->InsertarContacto($nombre, $primerApellido, $segundoApellido, $email, $numeroTelefono, $mensaje);
        header("AmbienteWeb\index.html");
        exit();
    } else {
        echo "Error";
    }

        


?>
