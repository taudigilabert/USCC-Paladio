<?php
session_start();

//Si no se ha iniciado sesion, te devuelve a inicio.php
if (!isset($_SESSION['usuario'])) {
    header("Location: inicio.php");
    exit();
}

$nombreArchivo = '';
$contenidoArchivo = '';

// Verificar si estamos en modo edicion (archivo pasado por la URL)
if (isset($_GET['registro'])) {
    $nombreArchivo = $_GET['registro'];
    $usuarioNombre = $_SESSION['usuario']['nombre'];
    $usuarioApellido = $_SESSION['usuario']['apellido'];
    $carpetaUsuario = "registro/" . $usuarioNombre . " " . $usuarioApellido;
    $rutaArchivo = $carpetaUsuario . "/" . $nombreArchivo;

    // Verificar si el archivo existe
    if (file_exists($rutaArchivo)) {
        $contenidoArchivo = file_get_contents($rutaArchivo);
    } else {
        echo "El archivo que intentas editar no existe.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USCSS Paladio - Crear / Editar Registro</title>

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


    <!-- Contenedor principal -->
    <div class="container my-5 mb-3 clas-col-8" id="containerPersonalizar">
        <div class="container-fluid text-center">
            <!-- LOGO -->
            <div class="row">
                <div class="col-12 d-flex justify-content-center align-items-center">
                    <img src="../img/logoTransparente.png" alt="Cargando imágen..." class="img-fluid" id="logoArchivos">
                </div>
            </div>

            <!-- Título de la página -->
            <div class="row mb-4">
                <div class="col-12">
                    <h2 class="text-warning">
                    <?php
                        if (isset($_GET['registro'])) {
                            echo "Editar informe";  // Si hay un valor en la URL, muestra "Editar informe"
                        } else {
                            echo "Crear informe";  // Si no hay valor en la URL, muestra "Crear informe"
                        }
                    ?>
                    </h2>
                    
                    <p class="text-white">Bienvenido a tu editor de informes
                        <?php echo htmlspecialchars($_SESSION['usuario']['nombre']) ?>
                        <?php echo htmlspecialchars($_SESSION['usuario']['apellido']) ?>. Edita tu informe.
                    </p>
                </div>
            </div>

            <!-- Recuadro de registro -->
            <div class="row mb-4 justify-content-center">
                <div class="col-10">
                    <div class="registro-box p-4">
                        <form action="guardarInforme.proc.php" method="POST">
                            <!-- Hidden para pasar el nombre del archivo a guardarInforme.proc.php  -->
                            <input type="hidden" name="nombreArchivo"
                                value="<?php echo htmlspecialchars($nombreArchivo); ?>">

                            <div class="mb-3">
                                <label for="registroFecha" class="form-label text-white">Fecha</label>
                                <input type="date" class="form-control" id="registroFecha" name="registroFecha"
                                    value="<?php echo date('Y-m-d'); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="registroTexto" class="form-label text-white">Texto del registro</label>
                                <!--Muestra el contenido del archivo .txt -->
                                <textarea class="form-control" id="registroTexto" name="registroTexto" rows="5"
                                    placeholder="Escribe aquí tu registro..."
                                    required><?php echo htmlspecialchars($contenidoArchivo); ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-outline-warning btn-lg btnPersonalizado" id="btnGuardarInforme">Guardar
                                Informe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--BOTONES -->
    <div class="text-center">
        <button class="btn btn-outline-warning my-2 btn-lg w-25 btnPersonalizado" id="btnVolverMenu"
            onclick="window.location.href='index.php';">VOLVER AL MENÚ</button>
        <button class="btn btn-outline-warning my-2 btn-lg w-25 btnPersonalizado" id="btnVerInformes"
            onclick="window.location.href='usuarioRegistros.php';">Ver Informes</button>
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