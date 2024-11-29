<?php
session_start();
// Si no se ha iniciado sesión, redirige al inicio
if (!isset($_SESSION['usuario'])) {
    header("Location: inicio.php");
    exit();
}

// Obtener el nombre del usuario desde la sesión
$nombre_usuario = $_SESSION['usuario']['nombre_usuario'];

// Leer el archivo de texto
$file = file_get_contents('../Paladio/cosas.txt');
$lines = explode("\n", $file);

// Buscar la línea correspondiente al usuario
$usuario_found = false;
$biografia_actual = "";
foreach ($lines as $line) {
    list($usuario, $password, $rol, $nombre, $apellido, $biografia, $foto) = explode(":", $line);
    if ($usuario == $nombre_usuario) {
        $biografia_actual = $biografia;
        $usuario_found = true;
        break;
    }
}

// Si el usuario no existe en el archivo, redirige (esto es opcional)
if (!$usuario_found) {
    header("Location: perfil.php");
    exit();
}

// Verifica si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nueva_biografia = $_POST['biografia'];

    // Actualizar la biografía en el archivo
    $new_content = "";
    foreach ($lines as $line) {
        list($usuario, $password, $rol, $nombre, $apellido, $biografia, $foto) = explode(":", $line);
        if ($usuario == $nombre_usuario) {
            $line = $usuario . ":" . $password . ":" . $rol . ":" . $nombre . ":" . $apellido . ":" . $nueva_biografia . ":" . $foto;
        }
        $new_content .= $line;
    }

    // Escribir el contenido actualizado en el archivo
    file_put_contents('../Paladio/cosas.txt', $new_content);

    // Redirigir al perfil actualizado
    header("Location: perfil.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/styles.css"> <!-- Agrega tu archivo CSS si lo necesitas -->
</head>

<body>
    <!-- Contenedor principal -->
    <div class="container my-5 mb-3 clas-col-8">
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
                    <h2 class="text-warning">Editar tu biografía</h2>
                    <p class="text-white">Bienvenido, <?php echo $_SESSION['usuario']['nombre'] . " " . $_SESSION['usuario']['apellido']; ?>. Aquí puedes actualizar tu biografía.</p>
                </div>
            </div>

            <!-- Formulario de edición -->
            <div class="row mb-4 justify-content-center">
                <div class="col-10">
                    <div class="registro-box p-4">
                        <form action="editarPerfil.php" method="POST">
                            <div class="mb-3">
                                <label for="biografia" class="form-label text-white">Biografía:</label>
                                <textarea id="biografia" name="biografia" class="form-control" rows="5" placeholder="Escribe aquí tu nueva biografía..."><?php echo htmlspecialchars($biografia_actual); ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-outline-warning btn-lg btnPersonalizado">Guardar cambios</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- BOTONES -->
    <div class="text-center">
        <button class="btn btn-outline-warning my-2 btn-lg w-25 btnPersonalizado" id="btnVolverMenu" onclick="window.location.href='index.php';">VOLVER AL MENÚ</button>
        <button class="btn btn-outline-warning my-2 btn-lg w-25 btnPersonalizado" id="btnVerPerfil" onclick="window.location.href='perfil.php';">Ver Perfil</button>
    </div>

    <!-- INCLUDES -->
    <?php include '../includes/videoFondo.php'; ?>
    <?php include '../includes/footer.html'; ?>
    <?php include '../includes/musica.php'; ?>
    <?php include '../includes/sonidoBotones.php'; ?>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
