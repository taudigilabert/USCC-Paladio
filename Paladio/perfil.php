<?php
session_start();
//Si no se ha iniciado sesion, te devuelve a inicio.php
if (!isset($_SESSION['usuario'])) {
    header("Location: inicio.php");
    exit();
}

$roles = [
    'capitan' => 'Capitán',
    'primer_oficial' => 'Primer Oficial',
    'ingeniero_jefe' => 'Ingeniero Jefe',
    'oficial_seguridad' => 'Oficial de Seguridad',
    'ing_mantenimiento' => 'Ingeniero de Mantenimiento',
    'piloto' => 'Piloto',
    'oficial_medico' => 'Oficial Médico',
    'cientifico_principal' => 'Científico Principal'
];

// Recupera el rol del usuario desde la sesiñón
$rol = $_SESSION['usuario']['rol'];

// Verifica si el rol existe en el mapeo y lo muestra
$rol_mostrado = isset($roles[$rol]) ? $roles[$rol] : "";


$file = 'cosas.txt';

// Leer todas las líneas del archivo
$usuarios = file($file, FILE_IGNORE_NEW_LINES); // devuelve un array con cada linea

// Nombre de usuario logueado desde la sesión
$usuarioLogueado = $_SESSION['usuario']['nombre_usuario'];

$biografia = "a";

// Buscar el usuario en el archivo y obtener su biografía
foreach ($usuarios as $usuario) {
    $datos = explode(":", $usuario);
    
    // Comprobar si el nombre de usuario coincide
    if ($datos[0] === $usuarioLogueado) {
        // Extraer la biografía (posición=5)
        $biografia = $datos[5]; 
        break;
    }
}


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USCSS Paladio - Perfil</title>

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
    <div class="container my-5" id="perfilUsuario">

        <!-- LOGO -->
        <div class="row">
            <div class="col-12 my-3 d-flex justify-content-center align-items-center">
                <img src="../img/logoTransparente.png" alt="Cargando imágen..." class="img-fluid" id="logoArchivos">
            </div>
        </div>

        <!-- Titulos -->
        <div class="text-center mb-4">
            <h2 class="text-warning">Perfil de Usuario</h2>
            <h3>Tripulación de la USCSS Paladio</h3>
            <br>
            <p>Bienvenido/a de nuevo,
                <!-- COMPROBAR CODIGO PHP -->
                <?php echo htmlspecialchars($_SESSION['usuario']['nombre']); ?>
            </p>
        </div>

        <!-- Contenido principal -->
        <div class="row">
            <!-- Bloque de Información del Usuario -->
            <div class="col-md-6 d-flex flex-column align-items-center">
                <!-- Foto de perfil -->
                <img src="../img/fotoPerfil/<?php echo htmlspecialchars($_SESSION['usuario']['imagen']); ?>"
                    alt="Foto de perfil" id="fotoPerfil">

                <!-- Nombre -->
                <h5 class="text-warning mt-3">
                    <?php echo htmlspecialchars($_SESSION['usuario']['nombre'] . ' ' . $_SESSION['usuario']['apellido']); ?>
                </h5>

                <!-- Rol -->
                <h5><?php echo htmlspecialchars($rol_mostrado); ?></h5>
                <br>
                <button class="btn btn-outline-warning btn-lg w-20 mb-2 btnPersonalizado btn-sm" id="btnCerrarSesion"
                    onclick="window.location.href='logout.proc.php';">CERRAR SESIÓN</button>
            </div>

            <!-- Bloque de Biografía -->
            <div class="col-md-6 d-flex flex-column align-items-center text-center">
                <h4 class="text-warning">Biografía</h4>
                <p class="text-light text-left" id="biografiaUsuario" style="text-align: justify; text-indent: 30px;">
                    <?php echo nl2br(htmlspecialchars($biografia)); ?>
                </p>
            </div>
        </div>
        <br>
        <br>
        <div class="container align-items-center text-center mt-4">
            <!-- Botones del perfil -->
            <button class="btn btn-outline-warning btn-lg w-25 mb-2 btnPersonalizado" id="btnVolverMenu"
                onclick="window.location.href='index.php';">VOLVER AL MENÚ</button>
            <button class="btn btn-outline-warning btn-lg w-50 mb-2 btnPersonalizado" id="btnEditarPerfil"
                onclick="window.location.href='editarPerfil.php';">EDITAR PERFIL</button>

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