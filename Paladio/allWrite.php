<?php
session_start();

//Si no se ha iniciado sesion, te devuelve a inicio.php
if (!isset($_SESSION['usuario'])) {
    header("Location: inicio.php");
    exit();
}

// Comprobar si el rol del usuario es 'capitan' o 'primer_oficial'
$rolesPermitidos = ['capitan', 'primer_oficial'];

if (!in_array($_SESSION['usuario']['rol'], $rolesPermitidos)) {
    header("Location: error.php?error=sin_permiso");
    exit();
}

// Directorio donde se almacenan las carpetas de los usuarios
$directorioUsuarios = 'registro/';

// Verifica que el directorio existe
if (!is_dir($directorioUsuarios)) {
    die("El directorio de usuarios no existe.");
}

// Recupera las carpetas de los usuarios
$carpetasUsuarios = array_filter(glob($directorioUsuarios . '*'), 'is_dir');


// ----- EXCLUIR LA CARPETA DEL USUARIO ACTUAL LOGEADO -------
// Nombre del usuario actual
$usuarioActual = $_SESSION['usuario']['nombre'] . " " . $_SESSION['usuario']['apellido'];

// Crear un array vacio para las carpetas de otros usuarios
$otrosUsuarios = [];

// Recorrer las carpetas y añadir solo las que no son del usuario loegado
foreach ($carpetasUsuarios as $carpeta) {
    if (basename($carpeta) !== $usuarioActual) {
        $otrosUsuarios[] = $carpeta;  // Añadir solo las carpetas que no son del usuario actual
    }
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USCSS Paladio - Todos Registros</title>

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

    <!-- ELECCIÓN DE TRIPULANTE PARA ACCEDER A SUS INFORMES -->
    <div class="container my-5" id="containerTodosInformes">
        <!-- LOGO -->
        <div class="row">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <img src="../img/logoTransparente.png" alt="Cargando imágen..." class="img-fluid" id="logoArchivos">
            </div>
        </div>
        <!-- Titulo-->
        <h2 class="text-warning">Administración de informes</h2>
        <h3> USCSS PALADIO</h3>
        <br>
        <p class="text-center">Bienvenido/a <?php echo $_SESSION['usuario']['nombre'] . " " . $_SESSION['usuario']['apellido']?>. Selecciona un tripulante para acceder a sus
            registros.</p>
        <h5 class="text-center mb-4">Selecciona un tripulante</h5>

        <!-- CARD POR CADA TRIPULANTE-->
        <!-- Contenedor de las cards-->
        <div class="container my-5">
            <div class="row justify-content-center">
                <?php
                // Muestra las carpetas en tarjetas de todos los usuarios excluyendo al usuario actual
                foreach ($otrosUsuarios as $carpeta) {
                    $nombreUsuario = basename($carpeta);  // Obtiene el nombre de la carpeta (usuario)
                
                    echo '<div class="col-12 col-md-6 col-lg-2 my-3">';
                    echo '    <div class="card text-center" id="cardInforme">';
                    echo '        <div class="card-body">';
                    echo '            <h5 class="card-title">' . htmlspecialchars($nombreUsuario) . '</h5>';
                    echo '            <a href="usuarioRegistros.php?usuario=' . urlencode($nombreUsuario) . '" class="btn btn-outline-warning mt-3 btn-ver-informe btnPersonalizado">Ver informes</a>';
                    echo '        </div>';
                    echo '    </div>';
                    echo '</div>';
                }
                ?>


            </div>
            <br>
            <button class="btn btn-outline-warning btn-lg w-50 btnPersonalizado" id="btnAllWriteVolverMenu"
                onclick="window.location.href='index.php';">VOLVER AL MENÚ</button>
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