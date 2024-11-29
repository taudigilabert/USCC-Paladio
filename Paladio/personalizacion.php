<?php
session_start();

//Si no se ha iniciado sesion, te devuelve a inicio.php
if (!isset($_SESSION['usuario'])) {
    header("Location: inicio.php");
    exit();
}


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USCSS Paladio - Personalizacion</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Fuentes -->
    <link href="https://fonts.googleapis.com/css2?family=Courier+New&display=swap" rel="stylesheet"><!-- Maquina -->
    <!-- Iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="../img/logoIcono.png" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="../styles/styles.css">
</head>

<body id="bodyInicio">
    <!-- INCLUDE -->
    <!-- Video de fondo -->
    <?php include '../includes/videoFondo.php'; ?>


    <!-- OPCIONES DE PERSONALIZACIÓN -->
    <div class="container my-5" id="containerPersonalizar">
        <!-- LOGO -->
        <div class="row">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <img src="../img/logoTransparente.png" alt="Cargando imágen..." class="img-fluid" id="logoArchivos">
            </div>
        </div>
        <!-- Titulo-->
        <h2 class="text-warning">OPCIONES DE PERSONALIZACIÓN DEL HUD</h2>
        <br>
        <!-- SELECCION DE CODIFICACIÓN-->
        <h5 class="text-center mb-4">Selecciona una codificación</h5>

        <!-- Lista de videos de fondo -->
        <!-- Lista de videos como cards -->
        <div class="container my-5">
            <div class="row justify-content-center">
                <?php foreach ($videos as $key => $video): ?>
                    <div class="col-12 col-md-6 col-lg-2 my-3">
                        <div class="card text-center" onclick="changeVideo(this)" data-video="<?php echo $video; ?>"
                            style="cursor: pointer;" id="cardCodificacion">
                            <video class="card-img-top" muted autoplay loop>
                                <source src="<?php echo $video; ?>" type="video/mp4">
                                MU-TH-UR 6000 está experimentando serios problemas para reproducir el video.
                            </video>
                            <div class="card-body">
                                <p class="card-title"><?php echo ucfirst(str_replace("_", " ", $key)); ?></p>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <br>
            <p class="text-center">El uso de codificaciones diferentes a la original puede provocar dificultades en la
                lectura.</p>
            <br>
            <button class="btn btn-outline-warning btn-lg w-50 btnPersonalizado" id="btnVolverMenu"
                onclick="window.location.href='index.php';">VOLVER AL MENÚ</button>
        </div>
    </div>

    <script>
        function changeVideo(element) {
            const videoUrl = element.getAttribute('data-video');

            // Guardar el video seleccionado en localStorage
            localStorage.setItem('selectedVideo', videoUrl);

            // Cambiar el video en la página actual
            const videoElement = document.getElementById('screenCode');
            videoElement.src = videoUrl;
            videoElement.load();
        }
    </script>




    <!-- INCLUDES -->
    <!-- FOOTER -->
    <?php include '../includes/footer.html'; ?>
    <!-- MUSICA-->
    <?php include '../includes/musica.php'; ?>
    <!-- Sonido en botones -->
    <?php include '../includes/sonidoBotones.php'; ?>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>