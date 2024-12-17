<?php
session_start();
$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null;

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "proyecto");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consultar las noticias
$query = "SELECT * FROM Noticias ORDER BY Fecha DESC";
$resultado = $conexion->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticias - Centro de Acopio</title>
    <link rel="icon" type="image/x-icon" href="/AmbienteWeb/assets/favicon.ico">
    <!-- Fuentes y estilos -->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/AmbienteWeb/css/styles.css">
</head>
<body>
    <!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="/AmbienteWeb/index.html">Centro de Acopio</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto py-4 py-lg-0">
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="/AmbienteWeb/index.html">Inicio</a></li>
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="/AmbienteWeb/about.html">Quiénes Somos</a></li>

                <?php if (!str_contains($_SERVER['REQUEST_URI'], 'noticias.php')): ?>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="/AmbienteWeb/noticias.php">Noticias</a></li>
                <?php endif; ?>

                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="/AmbienteWeb/collection_centers.html">Centros de Recolección</a></li>
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="/AmbienteWeb/contact.html">Contacto</a></li>
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="/AmbienteWeb/reciclyng_materials.html">Materiales Reciclables</a></li>
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="/AmbienteWeb/voluntariado.html">Voluntariado</a></li>
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="/AmbienteWeb/vistaContacto.php">Contacto Vista</a></li>
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="/AmbienteWeb/vistaVoluntariado.php">Voluntariado Vista</a></li>

                <?php if ($usuario): ?>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="#">Bienvenido, <?php echo htmlspecialchars($usuario); ?></a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="/AmbienteWeb/backend/logout.php">Cerrar Sesión</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="/AmbienteWeb/login.html">Iniciar Sesión</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>



    <!-- Page Header -->
    <header class="masthead" style="background-image: url('/AmbienteWeb/assets/img/Reciclaje.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>Noticias</h1>
                        <span class="subheading">Mantente informado sobre el reciclaje en Costa Rica</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <!-- Botón para Crear Nueva Noticia -->
                <?php if ($usuario): ?>
                    <div class="d-flex justify-content-end mb-4">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearNoticiaModal">Crear Nueva Noticia</button>
                    </div>
                <?php endif; ?>

                <!-- Noticias -->
                <?php if ($resultado->num_rows > 0): ?>
                    <?php while ($row = $resultado->fetch_assoc()): ?>
                        <div class="post-preview">
            <?php if ($usuario): ?>
                 <!-- Edición Inline -->
                    <form action="/AmbienteWeb/backend/editar_noticia.php" method="post" class="editable-form">
                 <input type="hidden" name="id" value="<?php echo $row['idNoticia']; ?>">

                                  <h2 class="post-title">
                                    <input type="text" name="titulo" class="editable-title" value="<?php echo htmlspecialchars($row['Titulo']); ?>" readonly>
                                </h2>
                                <p>
                                    <textarea name="cuerpoNoticia" class="editable-body" rows="3" readonly><?php echo htmlspecialchars($row['cuerpoNoticia']); ?></textarea>
                                </p>
                                <p class="post-meta">Publicado el 
                                    <input type="text" name="fecha" class="editable-date" value="<?php echo htmlspecialchars($row['Fecha']); ?>" readonly>
                                </p>

                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-secondary btn-sm me-2 edit-btn">Editar</button>
                                    <button type="submit" class="btn btn-primary btn-sm save-btn d-none">Guardar</button>
                            <a class="btn btn-danger btn-sm" href="/AmbienteWeb/backend/eliminar_noticia.php?id=<?php echo $row['idNoticia']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar esta noticia?');">Eliminar</a>
                        </div>
                    </form>
                <?php else: ?>
                    <!-- Vista Normal -->
                    <h2 class="post-title"><?php echo htmlspecialchars($row['Titulo']); ?></h2>
                    <p><?php echo htmlspecialchars($row['cuerpoNoticia']); ?></p>
                    <p class="post-meta">Publicado el <?php echo htmlspecialchars($row['Fecha']); ?></p>
                <?php endif; ?>
            </div>

                        <hr class="my-4">
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No hay noticias disponibles.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="border-top">
        <div class="container text-center">
            <p>Centro de Acopio &copy; 2024</p>
        </div>
    </footer>

    <!-- Modal para Crear Noticia -->
    <div class="modal fade" id="crearNoticiaModal" tabindex="-1" aria-labelledby="crearNoticiaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="/AmbienteWeb/backend/crear_noticia.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="crearNoticiaModalLabel">Crear Nueva Noticia</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" required>
                        </div>
                        <div class="mb-3">
                            <label for="cuerpo" class="form-label">Cuerpo de la Noticia</label>
                            <textarea class="form-control" id="cuerpo" name="cuerpo" rows="5" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', function() {
        const form = this.closest('form');
        // Hacer los campos editables
        form.querySelectorAll('input, textarea').forEach(input => {
            input.removeAttribute('readonly');
        });
        // Mostrar el botón "Guardar" y ocultar "Editar"
        form.querySelector('.save-btn').classList.remove('d-none');
        this.classList.add('d-none');
    });
});
</script>

</body>
</html>

<?php
$conexion->close();
?>
