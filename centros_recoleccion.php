<?php
session_start();

// Verificar si el usuario está logueado
$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null;

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "proyecto");

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consultar los centros de recolección
$query = "SELECT * FROM CentrosRecoleccion ORDER BY idCentro ASC";
$resultado = $conexion->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centros de Recolección - Centro de Acopio</title>
    <link rel="icon" type="image/x-icon" href="/AmbienteWeb/assets/favicon.ico">
    <link rel="stylesheet" href="/AmbienteWeb/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="/AmbienteWeb/index.html">Centro de Acopio</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive">
                Menu <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link" href="/AmbienteWeb/index.html">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="/AmbienteWeb/about.html">Quiénes Somos</a></li>
                    <li class="nav-item"><a class="nav-link" href="/AmbienteWeb/noticias.php">Noticias</a></li>
                    <li class="nav-item"><a class="nav-link" href="/AmbienteWeb/centros_recoleccion.php">Centros de Recolección</a></li>
                    <li class="nav-item"><a class="nav-link" href="/AmbienteWeb/contact.html">Contacto</a></li>
                    <?php if ($usuario): ?>
                        <li class="nav-item"><a class="nav-link">Bienvenido, <?php echo htmlspecialchars($usuario); ?></a></li>
                        <li class="nav-item"><a class="nav-link" href="/AmbienteWeb/backend/logout.php">Cerrar Sesión</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="/AmbienteWeb/login.html">Iniciar Sesión</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <header class="masthead" style="background-image: url('/AmbienteWeb/assets/img/centros_reciclaje.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>Centros de Recolección</h1>
                        <span class="subheading">Encuentra un centro de recolección cerca de ti</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <!-- Botón para Crear Nuevo Centro -->
                <?php if ($usuario): ?>
                    <div class="d-flex justify-content-end mb-4">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearCentroModal">Crear Nuevo Centro</button>
                    </div>
                <?php endif; ?>

                <!-- Listado de Centros de Recolección -->
                <?php if ($resultado && $resultado->num_rows > 0): ?>
                    <?php while ($row = $resultado->fetch_assoc()): ?>
                        <div class="post-preview">
                            <h3><?php echo htmlspecialchars($row['Provincia']); ?></h3>
                            <p><?php echo htmlspecialchars($row['Direccion']); ?></p>
                            <?php if ($usuario): ?>
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-secondary btn-sm me-2 edit-btn" title="Editar" data-bs-toggle="modal" data-bs-target="#editarCentroModal<?php echo $row['idCentro']; ?>">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <a class="btn btn-danger btn-sm" href="/AmbienteWeb/backend/eliminar_centro.php?id=<?php echo $row['idCentro']; ?>" onclick="return confirm('¿Eliminar este centro?');" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Modal de Editar -->
                        <div class="modal fade" id="editarCentroModal<?php echo $row['idCentro']; ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <form action="/AmbienteWeb/backend/editar_centro.php" method="post">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Editar Centro</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="id" value="<?php echo $row['idCentro']; ?>">
                                            <div class="mb-3">
                                                <label>Provincia</label>
                                                <input type="text" class="form-control" name="provincia" value="<?php echo htmlspecialchars($row['Provincia']); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Dirección</label>
                                                <textarea class="form-control" name="direccion" rows="3" required><?php echo htmlspecialchars($row['Direccion']); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <hr class="my-4">
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No hay centros de recolección disponibles.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Modal para Crear Centro -->
    <div class="modal fade" id="crearCentroModal" tabindex="-1" aria-labelledby="crearCentroModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="/AmbienteWeb/backend/crear_centro.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">Crear Nuevo Centro</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="provincia" class="form-label">Provincia</label>
                            <input type="text" class="form-control" id="provincia" name="provincia" required>
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <textarea class="form-control" id="direccion" name="direccion" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

     <!-- Footer -->
     <footer class="border-top">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <ul class="list-inline text-center">
                        <li class="list-inline-item">
                            <a href="#!">
                                <span class="fa-stack fa-lg">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!">
                                <span class="fa-stack fa-lg">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!">
                                <span class="fa-stack fa-lg">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <div class="small text-center text-muted fst-italic">Copyright &copy; Centro de Acopio 2024</div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conexion->close();
?>
