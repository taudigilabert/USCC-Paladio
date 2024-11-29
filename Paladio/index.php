<?php
session_start();

//Si no se ha iniciado sesion, te devuelve a inicio.php
if (!isset($_SESSION['usuario'])) {
    header("Location: inicio.php"); // Redirigir al formulario de inicio de sesión si no hay sesión activa
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

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USCSS Paladio - Menú Principal</title>

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
        <!-- Fila del Logo -->
        <div class="row position-relative">
            <!-- Columna de Información del Usuario -->
            <div class="col-md-4 position-absolute top-0 start-0 mt-5 d-flex flex-column align-items-start text-center"
                style="margin-left: 40px;">
                <div class="d-flex flex-column align-items-center" id="contenedorInfoUsuario">
                    <!-- Imagen de perfil del usuario -->
                    <img src="../img/fotoPerfil/<?php echo htmlspecialchars($_SESSION['usuario']['imagen']) ?>"
                        alt="Foto de perfil" class="img-fluid" id="fotoPerfil">
                    <br>
                    <!-- Información del usuario -->
                    <div class="info-container">
                        <h5><?php echo htmlspecialchars($_SESSION['usuario']['nombre']) ?>
                            <?php echo htmlspecialchars($_SESSION['usuario']['apellido']) ?>
                        </h5>
                        <p><strong><?php echo htmlspecialchars($rol_mostrado); ?></strong></p>
                    </div>
                    <a href="logout.proc.php" class="btn btn-outline-warning btnPersonalizado btn-sm" id="btnCerrarSesion">Cerrar sesión</a>
                </div>
            </div>

            <!-- Columna del Logo -->
            <div class="col-12 d-flex justify-content-center align-items-center" style="height: 33vh;">
                <img src="../img/logoTransparente.png" alt="Cargando imágen..." class="img-fluid" id="logoIndex"
                    style="max-height: 100%;">
            </div>
        </div>


        <!-- Fila del Menú Principal -->
        <div class="row d-flex justify-content-center" id="divMenuPrincipal">
            <!-- Columna del menú -->
            <div class="col-md-8 d-flex flex-column align-items-center">
                <div class="menu-container" id="menuPrincipal">
                    <!-- Título del menú -->
                    <h1 class="text-warning">Menú Principal</h1>
                    <h3>USCSS PALADIO</h3>

                    <!-- Botones del menú -->
                    <div class="button-container mt-3">
                        <!-- Primera sección -->
                        <button class="btn btn-outline-warning my-2 btn-lg w-100 btn btnPersonalizado" id="btnNuevoInforme"
                            onclick="window.location.href='../Paladio/write.php';">Nuevo informe</button>
                        <button class="btn btn-outline-warning my-2 btn-lg w-100 btnPersonalizado" id="btnMisInformes"
                            onclick="window.location.href='../Paladio/usuarioRegistros.php';">Mis informes</button>
                        <button class="btn btn-outline-warning my-2 btn-lg w-100 btnPersonalizado" id="btnTodosInformes"
                            onclick="window.location.href='../Paladio/allWrite.php';">Consultar todos los
                            informes</button>

                        <!-- Mensajería -->
                        <h6 class="text mt-4 mb-1">Servicio de mensajería</h6>
                        <button class="btn btn-outline-warning my-2 btn-lg w-100 btnPersonalizado" id="btnEnviarMensaje"
                            onclick="window.location.href='../Paladio/enviarMensaje.php'; ">Enviar mensaje</button>
                        <button class="btn btn-outline-warning my-2 btn-lg w-100 btnPersonalizado" id="btnBuzonEntrada"
                            onclick="window.location.href='../Paladio/readMensajes.php';">Buzón de entrada</button>

                        <!-- Personalización -->
                        <h6 class="text mt-4 mb-1">Personalización</h6>
                        <button class="btn btn-outline-warning my-2 btn-lg w-100 btnPersonalizado" id="btnEditarPerfil"
                            onclick="window.location.href='../Paladio/perfil.php';">Editar Perfil</button>
                        <button class="btn btn-outline-warning my-2 btn-lg w-100 btnPersonalizado" id="btnPersonalizar"
                            onclick="window.location.href='../Paladio/personalizacion.php';">Personalización</button>
                    </div>

                </div>
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