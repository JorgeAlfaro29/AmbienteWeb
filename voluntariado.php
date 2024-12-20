<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description"
        content="Únete como voluntario en el Centro de Acopio y forma parte del cambio. Ayuda con tareas de reciclaje, horarios flexibles y sé parte de nuestra comunidad comprometida con el medio ambiente." />
    <meta name="author" content="Centro de Acopio" />
    <title>Voluntariado</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet"
        type="text/css" />
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800"
        rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="index.html">Centro de Acopio</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="index.html">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="about.html">Quiénes Somos</a>
                    </li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="noticias.php">Noticias</a></li>

                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="centros_recoleccion.php">Centros de Recolección</a></li>

                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="collection_centers.html">Centros
                            de Recolección</a></li>

                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="contact.html">Contacto</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4"
                            href="reciclyng_materials.html">Materiables Reciclables</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('assets/img/voluntariado.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="page-heading">
                        <h1>Voluntariado</h1>
                        <span class="subheading">¡Únete y sé parte del cambio!</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content-->
    <main class="mb-4">
        <div class="container px-4 px-lg-5">
            <!-- Información adicional-->
            <div class="info-voluntariado mb-5">
                <h3>¿Por qué ser voluntario?</h3>
                <p>Contribuirás al cuidado del medio ambiente, aprenderás sobre prácticas sostenibles y formarás parte
                    de una comunidad comprometida. ¡Juntos podemos marcar la diferencia!</p>
            </div>
            <!-- Testimonios -->
            <section class="testimonios my-5">
                <h2 class="text-center">Testimonios de Voluntarios</h2>
                <div class="row justify-content-center">
                    <div class="col-md-4 text-center">
                        <blockquote class="blockquote">
                            <p>"Participar como voluntaria ha sido una experiencia enriquecedora. Ayudar al planeta
                                nunca se sintió tan gratificante."</p>
                            <footer class="blockquote-footer">Veronica López</footer>
                        </blockquote>
                    </div>
                    <div class="col-md-4 text-center">
                        <blockquote class="blockquote">
                            <p>"He aprendido mucho sobre reciclaje y he conocido personas comprometidas con un mismo
                                objetivo."</p>
                            <footer class="blockquote-footer">Carlos Ramírez</footer>
                        </blockquote>
                    </div>
                </div>
            </section>
            <!-- Formulario de contacto -->
            <!-- Formulario de contacto -->
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <p>Rellena el siguiente formulario para contactarnos:</p>
                    <form id="voluntariadoForm" action="backend/voluntariadoBack.php" method="POST">
                        <div class="form-floating mb-3">
                            <input class="form-control" id="nombre" name="nombre" type="text" placeholder="Tu nombre"
                                required />
                            <label for="nombre">Nombre</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="apellido" name="apellido" type="text"
                                placeholder="Tu apellido" required />
                            <label for="apellido">Apellido</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="email" name="correo" type="email" placeholder="Tu correo"
                                required />
                            <label for="email">Correo</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="telefono" name="telefono" type="tel"
                                placeholder="Tu número de teléfono" />
                            <label for="telefono">Teléfono</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-control" id="tasks" name="areaInteres" required>
                                <?php
                                $conn = new mysqli("localhost", "jorge", "1234", "proyecto");
                        
                                if ($conn->connect_error) {
                                    die("Error de conexión: " . $conn->connect_error);
                                }
                        
                                $sql = "SELECT idAreas, nombre FROM areas";
                                $result = $conn->query($sql);
                        
                                if ($result && $result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row['idAreas'] . "'>" . htmlspecialchars($row['nombre']) . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>No hay áreas disponibles</option>";
                                }
                        
                                $conn->close();
                                ?>
                            </select>
                            <label for="areaInteres">Áreas de interés</label>
                        </div>
                        
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="message" name="message" placeholder="Mensaje"
                                style="height: 12rem" required></textarea>
                            <label for="message">Mensaje</label>
                        </div>
                        <!-- Botón de enviar -->
                        <button class="btn btn-primary text-uppercase" type="submit">Enviar</button>
                    </form>
                </div>
            </div>

        </div>
        </div>
        </div>
    </main>
    <!-- Footer-->
    <footer class="border-top">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="small text-center text-muted fst-italic">Copyright &copy; Centro de Acopio 2024</div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS-->
    <script src="js/scripts.js"></script>
    <script src="js/voluntariado.js"></script>
</body>

</html>