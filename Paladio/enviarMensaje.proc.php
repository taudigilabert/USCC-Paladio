<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: inicio.php");
    exit();
}

// Recuperar los datos del formulario
$remitente = $_SESSION['usuario']['nombre'] . " " . $_SESSION['usuario']['apellido'];
$destinatario = $_POST['destinatario'];
$fecha = $_POST['fecha'];
$contenido = $_POST['contenido'];

// Crear la ruta de la carpeta de mensajes del destinatario
$rutaMensajesRecibidos = "registro/$destinatario/MensajesRecibidos";

// Crear la carpeta MensajesRecibidos si no existe
if (!is_dir($rutaMensajesRecibidos)) {
    mkdir($rutaMensajesRecibidos, 0777, true);
}

// Formatear el nombre del archivo del mensaje
$nombreArchivo = "de-" . str_replace(" ", "", $remitente) . "-" . $fecha . ".txt";

// Ruta completa del archivo
$rutaArchivo = $rutaMensajesRecibidos . "/" . $nombreArchivo;

// Crear el contenido del mensaje
$mensaje = "De: $remitente\nPara: $destinatario\nFecha: $fecha\n\n$contenido";

// Guardar el mensaje en un archivo individual
file_put_contents($rutaArchivo, $mensaje);

// Redirigir al usuario a index.php con un mensaje de éxito
header("Location: index.php?mensaje=exito");
exit();
?>
