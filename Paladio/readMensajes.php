<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: inicio.php");
    exit();
}

// Obtener el nombre completo del usuario actual
$usuarioActual = $_SESSION['usuario']['nombre'] . " " . $_SESSION['usuario']['apellido'];
$rutaMensajes = "registro/" . $usuarioActual . "/MensajesRecibidos"; // Ruta a la carpeta de mensajes

// Inicializar lista de mensajes
$mensajes = [];

// Comprobar si la carpeta de mensajes existe
if (is_dir($rutaMensajes)) {
    // Abrir la carpeta y leer los archivos de mensajes
    $archivos = scandir($rutaMensajes);
    foreach ($archivos as $archivo) {
        if ($archivo !== "." && $archivo !== "..") {
            // Leer el contenido del archivo
            $contenido = file_get_contents($rutaMensajes . "/" . $archivo);

            if (preg_match('/de-(.*?)-\d{4}-\d{2}-\d{2}\.txt/', $archivo, $matches)) {
                $remitenteCompacto = $matches[1]; // Nombre + Apellido del remitente
                $remitente = str_replace(".", " ", preg_replace('/(?<!^)([A-Z])/', ' $1', $remitenteCompacto));

                //formato .txt de mensaje enviado: de-NombreApellido-aaa-mm-dd.txt
                // .* captura todo el texto despues de "de-"
            } else {
                $remitente = "Desconocido";
            }

            $mensajes[] = [
                'nombreArchivo' => $archivo,
                'remitente' => $remitente,
                'contenido' => $contenido
            ];
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USCSS Paladio - Buzón de Entrada</title>
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
    <div class="container-fluid text-center mt-5 mb-3 col-8" id="containerMensajeria">
        <!-- LOGO -->
        <div class="row">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <img src="../img/logoTransparente.png" alt="Cargando imágen..." class="img-fluid" id="logoArchivos">
            </div>
            <div class="col-12 text-center">
                <h2 class="text-warning">Servicio de mensajería interno</h2>
            </div>
            <div class="col-12 text-center mb-5">
                <h3>Buzón de entrada</h3>
            </div>
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-8 text-center">
                    <?php if (!empty($mensajes)): ?>
                        <div class="list-group">
                            <?php foreach ($mensajes as $mensaje): ?>
                                <article class="list-group-item mb-3 col-12 text-white" id="itemMensajeria">
                                    <!-- Contenido del mensaje en caja de texto con desplazamiento -->
                                    <div class="mensaje-contenido col-12">
                                        <pre><?php echo nl2br(htmlspecialchars($mensaje['contenido'])); ?></pre>
                                    </div>

                                    <!-- Botón para responder -->
                                    <form action="enviarmensaje.php" method="get" class="mt-2">
                                        <input type="hidden" name="destinatario"
                                            value="<?php echo htmlspecialchars($mensaje['remitente']); ?>">
                                        <button type="submit" class="btn btn-outline-warning btnPersonalizado"
                                            aria-label="Responder mensaje de <?php echo htmlspecialchars($mensaje['remitente']); ?>">
                                            Responder
                                        </button>
                                    </form>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="text-warning">No tienes mensajes en tu bandeja de entrada.</p>
                    <?php endif; ?>
                </div>
            </div>

        </div>

    </div>
    </div>
    <div class="text-center">
        <button class="btn btn-outline-warning my-2 btn-lg w-25 btnPersonalizado" id="btnVolverMenu"
            onclick="window.location.href='../Paladio/index.php';">Volver a menú</button>
    </div>


    <!-- INCLUDES -->
    <!-- Video de fondo -->
    <?php include '../includes/videoFondo.php'; ?>
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