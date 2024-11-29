<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: inicio.php");
    exit();
}

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nombreArchivo = $_POST['nombreArchivo'];
    $texto = $_POST['registroTexto'];
    $fecha = $_POST['registroFecha'];
    
    // Sanear el texto para evitar problemas de seguridad
    $texto = htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');

    // Datos usuario
    $usuarioNombre = $_SESSION['usuario']['nombre']; // Mary
    $usuarioApellido = $_SESSION['usuario']['apellido']; // Ramirez
    $carpetaUsuario = "registro/" . $usuarioNombre . " " . $usuarioApellido; // registro/Mary Ramirez

    // Nombre del usuario desde la sesión
    $usuario = $_SESSION['usuario']['nombre_usuario'];
    
    // Si es un archivo existente
    if (!empty($nombreArchivo)) {
        $rutaArchivo = $carpetaUsuario . "/" . $nombreArchivo;
    } else {
        // Si es un archivo nuevo, generar un nombre único
        $numeroArchivo = 1;
        do {
            $nombreArchivo = "Registro_" . $usuarioNombre . $usuarioApellido . "_" . $numeroArchivo . ".txt";
            $rutaArchivo = $carpetaUsuario . "/" . $nombreArchivo;
            $numeroArchivo++;
        } while (file_exists($rutaArchivo));
    }

    // Guardar el contenido en el archivo
    if (file_put_contents($rutaArchivo, $texto)) {
        // Redirigir al listado de registros si se guarda correctamente
        header("Location: usuarioRegistros.php");
        exit();
    } else {
        // Mostrar error si no se puede guardar el archivo
        echo "Hubo un error al guardar el archivo. Intenta de nuevo.";
    }
}
?>
