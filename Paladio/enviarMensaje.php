<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: inicio.php");
    exit();
}

// "Nombre Apellido" del usuario logeado
$usuarioActual = $_SESSION['usuario']["nombre"] . " " . $_SESSION['usuario']["apellido"];

// Ruta donde están las carpetas de usuarios
$rutaRegistro = "registro/";
$usuarios = [];

// Abrimos la carpeta "registro/"
if ($directorio = opendir($rutaRegistro)) {
    //Recorremos cada elemento en el directorio
    while (($carpeta = readdir($directorio)) !== false) {
        // Ignora los directorios "." -> directorio actual, ".." -> directorio padre (esos dos no interesan)
        if ($carpeta !== '.' && $carpeta !== '..') {
            // Comprobamos si el elemento es una carpeta
            if (is_dir($rutaRegistro . $carpeta)) {
                $usuarios[] = $carpeta; // Añadimos el nombre de la carpeta a la lista
            }
        }
    }
    closedir($directorio); // Cierra directorio
}

$remitenteUrl = isset($_GET['destinatario']) ? $_GET['destinatario'] : null;

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USCSS Paladio - Enviar Mensaje</title>
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
    <div class="container-fluid text-center col-8 mt-5 mb-3" id="containerMensajeria">
        <!-- LOGO -->
        <div class="row">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <img src="../img/logoTransparente.png" alt="Cargando imágen..." class="img-fluid" id="logoArchivos">
            </div>
        </div>
        <h2 class="text-warning">Servicio de mensajería interno</h2>
        <h3>Enviar mensaje</h3>
        <p>Selecciona un tripulante para redactar un mensaje.</p>
        <div class="col-8">
            <form action="enviarMensaje.proc.php" method="POST">
                <!-- Hidden para incluir el remitente automatic -->
                <input type="hidden" name="remitente" value="<?php echo $usuarioActual; ?>">

                <!-- RECEPTOR -->
                <div class="mb-3">
                    <label for="destinatario" class="form-label text-black">Para:</label>
                    <select id="destinatario" name="destinatario" class="form-select text-black" required>
                        <option class="text-black" value="" disabled selected>Selecciona un destinatario</option>
                        <?php foreach ($usuarios as $usuario): ?>
                            <?php if ($usuario !== $usuarioActual): ?>

                                <!--Si el valor de remitente que se ha pasado por URL coincide con uno de los usuarios de las opciones, esa opcion se seleccionará
                            automaticamente  (SELECTED) -->
                                <option class="text-black" value="<?php echo $usuario; ?>" <?php echo ($remitenteUrl === $usuario) ? 'selected' : ''; ?>>
                                    <?php echo $usuario; ?>


                                </option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Fecha-->
                <div class="mb-3">
                    <label for="fecha" class="form-label text-black">Fecha:</label>
                    <input type="date" id="fecha" name="fecha" class="form-control" value="<?php echo date('Y-m-d'); ?>"
                        required>
                </div>

                <!-- Contenido del mensaje -->
                <div class="mb-2">
                    <label for="contenido" class="form-label text-black">Mensaje:</label>
                    <textarea id="contenido" name="contenido" class="form-control" rows="4"
                        placeholder="Escribe tu mensaje aquí..." required></textarea>
                </div>

                <button type="submit" class="btn btn-outline-warning my-2 btn-lg w-50 btnPersonalizado"
                    id="btnEnviarMensaje">Enviar
                    Mensaje</button>
            </form>
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