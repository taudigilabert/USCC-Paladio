<?php
session_start();

//Si no se ha iniciado sesion, te devuelve a inicio.php
if (!isset($_SESSION['usuario'])) {
    header("Location: inicio.php");
    exit();
}


if (isset($_GET['usuario'])) {
    // Decodifica el nombre de usuario que pasamos por la URL, convirtiendo el '+' en un espacio
    $usuarioNombre = urldecode($_GET['usuario']);
} else {
    echo "Usuario no encontrado";
    exit();
}

$carpetaUsuario = "registro/" . $usuarioNombre;


// Verificar si se ha pasado el nombre del archivo por la URL
if (isset($_GET['archivo'])) {
    $nombreArchivo = $_GET['archivo']; //Registro_NombreApellidos_n.txt

    // Construir la ruta completa del archivo
    $rutaArchivo = $carpetaUsuario . "/" . $nombreArchivo;

    // Verificar si el archivo existe
    if (file_exists($rutaArchivo)) {
        // Leer el contenido del archivo
        $contenidoArchivo = file_get_contents($rutaArchivo);
    } else {
        // Si no existe el archivo, redirigir o mostrar mensaje de error
        echo "El archivo no existe.";
        exit();
    }
} else {
    // Si no se pasó el parámetro 'archivo', redirigir o mostrar mensaje de error
    echo "No se ha especificado un registro.";
    exit();
}


if (isset($_GET['usuario'])) {
    $nombreUsuario = $_GET['usuario'];
}

// Verifica si el usuario logueado esta viendo sus propios registros
$esPropioUsuario = ($usuarioNombre === $_SESSION['usuario']['nombre'] . " " . $_SESSION['usuario']['apellido']);
?>




<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USCSS Paladio - Consultar Registro</title>

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

    <!-- Contenedor principal -->
    <div class="container-fluid text-center">
        <!-- LOGO -->
        <div class="row">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <img src="../img/logoTransparente.png" alt="Cargando imágen..." class="img-fluid" id="logoArchivos">
            </div>
        </div>

        <!-- Título de la página -->
        <div class="row mb-4">
            <div class="col-12"> <!-- CORREGIR TRANSPARENCIA -->
                <h2 class="text-warning">Gestión de informes</h2>
                <?php if ($esPropioUsuario): ?>
                    <p class="text-white">Bienvenido a tu registro
                        <?php echo $_SESSION['usuario']['nombre'] . " " . $_SESSION['usuario']['apellido']; ?>. Consulta
                        cualquiera de tus informes.
                    </p>
                <?php else: ?>
                    <p class="text-white">Bienvenido al informe de <?php echo $usuarioNombre ?>. Consulta cualquiera de sus
                        informes.</p>
                <?php endif; ?>



            </div>
        </div>

        <!-- Recuadro de registro -->
        <div class="row mb-4 justify-content-center">
            <div class="col-8">
                <div class="registro-box p-4" style="border: 1px solid #ffc107; border-radius: 0px;">
                    <h5 class="font-weight-bold mb-2"><span id="nombre"><?php echo $usuarioNombre; ?></span>
                    </h5>
                    <p><span id="registroFecha"><?php echo date('Y-m-d'); ?></span></p>
                    <!-- Caja para el texto del informe -->
                    <div id="informeTexto">
                        <?php echo nl2br(htmlspecialchars($contenidoArchivo)); ?>
                    </div>
                </div>
            </div>

            <!-- BOTONES -->
            <div class="d-flex justify-content-between align-items-center text-center mt-3 col-8">
                <button class="btn btn-outline-warning btn-lg w-20 btnPersonalizado" id="btnVolverMenu"
                    onclick="window.location.href='index.php';" aria-label="Volver al menú principal">
                    VOLVER AL MENÚ
                </button>
                <button class="btn btn-outline-warning btn-lg w-20 btnPersonalizado" id="btnReadVolver"
                    onclick="window.location.href='usuarioRegistros.php?usuario=<?php echo urlencode($nombreUsuario); ?>';" aria-label="Volver a mis registros">
                    VOLVER
                </button>
                <button class="btn btn-outline-warning btn-lg w-50 btnPersonalizado" id="btnReadEditarRegistro"
                    onclick="window.location.href='../Paladio/write.php?registro=<?php echo urlencode($nombreArchivo); ?>';"
                    aria-label="Editar el informe seleccionado">
                    EDITAR INFORME
                </button>
            </div>

        </div>
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