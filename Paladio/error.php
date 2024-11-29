<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Error</title>

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

<body>

    <div class="container my-5 col-6" id="containerError">
        <header class="error-header">
            <h2>Error</h2>
        </header>

        <section class="error-message">
            <?php
            // Verificación del tipo de error
            $error = isset($_GET['error']) ? $_GET['error'] : '';
            if ($error === 'sin_permiso') {
                echo '<p><strong>Acceso Denegado:</strong> Tu nivel jerárquico es insuficiente para acceder a esta sección.</p>';
                echo '<p>Si crees que se trata de un error, ponte en contacto con un superior.</p>';
                echo '<button class="btn btn-outline-warning my-2 btn-lg w-50 btnPersonalizado" id="btnVolverMenu"
        onclick="window.location.href=\'index.php\';">REGRESAR AL MENÚ</button>';

                // Error iniciar sesión
            } elseif ($error === 'credenciales') {
                echo '<br>';
                echo '<h5>Error de Credenciales:</h5>';
                echo 'MU-TH-UR 6000 no ha podido verificar tus credenciales.</p>';
                echo '<p>Por favor, regresa e inténtalo de nuevo.</p>';
                echo '<br>';
                echo '<br>';
                echo '<p>Si el problema persiste, contacta con un superior.</p>';
                echo '<button class="btn btn-outline-warning my-2 btn-lg w-50 btnPersonalizado" id="btnVolverInicio1"
        onclick="window.location.href=\'inicio.php\';">REGRESAR AL INICIO</button>';

                // Error desconocido
            } else {
                echo '<p>MU-TH-UR 6000 no es capaz de identificar el error.</p>';
                echo '<button class="btn btn-outline-warning my-2 btn-lg w-50 btnPersonalizado" id="btnVolverInicio2"
        onclick="window.location.href=\'inicio.php\';">REGRESAR AL INICIO</button>';
            }
            ?>
        </section>
    </div>

    <!-- FOOTER -->
    <?php include '../includes/footer.html'; ?>
    <!-- MUSICA-->
    <?php include '../includes/musica.php'; ?>
    <!-- Video de fondo -->
    <?php include '../includes/videoFondo.php'; ?>
    <!-- Sonido en botones -->
    <?php include '../includes/sonidoBotones.php'; ?>

</body>
</html>
