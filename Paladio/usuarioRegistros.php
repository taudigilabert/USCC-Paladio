<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: inicio.php");
    exit();
}

// Obtiene el nombre del usuario logueado o el usuario seleccionado por el admin
if (isset($_GET['usuario'])) {
    // Si el acceso es desde Allwrite.php, mostramos los informes de OTRO usuario
    $usuarioSeleccionado = urldecode($_GET['usuario']);
} else {
    // Si no hay parametro 'usuario" en la URL, mostramos los informes del usuario que esta logueado
    $usuarioSeleccionado = $_SESSION['usuario']['nombre'] . " " . $_SESSION['usuario']['apellido'];
}

// Carpeta del usuario  
$carpetaUsuario = 'registro/' . $usuarioSeleccionado;

// Obtenenemos los archivos .txt dentro de la carpeta del usuario
$archivos = glob($carpetaUsuario . "/*.txt");

// Verifica si el usuario logueado esta viendo sus propios informes
$esPropioUsuario = ($usuarioSeleccionado === $_SESSION['usuario']['nombre'] . " " . $_SESSION['usuario']['apellido']);

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USCSS Paladio - Informes de <?php echo htmlspecialchars($usuarioSeleccionado); ?></title>
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
    <div class="container mt-5 mb-3" id="containerTodosInformes">
        <!-- LOGO -->
        <div class="row">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <img src="../img/logoTransparente.png" alt="Cargando imágen..." class="img-fluid" id="logoArchivos">
            </div>
        </div>
        <!--Título-->
        <h2 class="text-center text-warning">Informes de <?php echo htmlspecialchars($usuarioSeleccionado); ?></h2>
        <h3>CONSULTA TODOS LOS INFORMES GUARDADOS</h3>
        <div class="col-8 mt-5">

            <?php if (empty($archivos)): ?>
                <!-- Si no existen informes para el usuario:-->
                <p class="text-center">No hay informes para este usuario.</p>

            <?php else: ?>
                <ul class="list-group">
                    <!-- Si EXISTEN informes para el usuario, se muestran-->
                    <?php foreach ($archivos as $archivo): ?>
                        <?php $nombreArchivo = basename($archivo); ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center custom-list-item"
                            id="listadoInformes">
                            <a id="contenidoListadoInformes"
                                href="read.php?usuario=<?php echo urlencode($usuarioSeleccionado); ?>&archivo=<?php echo urlencode($nombreArchivo); ?>">
                                <?php echo htmlspecialchars($nombreArchivo); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>

        <!--Si el usuario que esta logeado es propietario de los informes, podrá escribir nuevos-->
        <?php if ($esPropioUsuario): ?>
            <a href="write.php" class="btn btn-outline-warning btn-lg w-50 btnPersonalizado" id="btnNuevoInforme">Nuevo Informe</a>
        <?php endif; ?>
    </div>
            
    <div class="text-center">
        <button class="btn btn-outline-warning my-2 btn-lg w-25 btnPersonalizado" id="btnVolverMenu"
            onclick="window.location.href='index.php';">VOLVER AL MENÚ</button>
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