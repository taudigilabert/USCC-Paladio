<?php

    session_start();

    // Obtenemos los datos del formulario. Si esta definido se asigna a la variable usuario. Sino existe se define como campo vacio.
    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
    $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : '';


    // Guarda el PATH del archivo que usaremos
    $archivoPath = "cosas.txt";

    // Lee el fichero ignorando 
    $usuarios = file($archivoPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // Variable para indicar si la autentificación fue exitosa
    $verificado = false;

    // Recorre el archivo linea por linea para buscar una coincidencia
    foreach ($usuarios as $linea){
        //
        list(
            $nombre_usuario, 
            $contra_encriptada, 
            $rol, 
            $nombre, 
            $apellido, 
            $descripcion, 
            $imagen
        ) = explode(":", $linea);

        if ($nombre_usuario === $usuario){
            // la función password_verify compara entre la contraseña que se ha ingresado y la contraseña encriptada que tenemos en el .txt
            if (password_verify($contrasena, $contra_encriptada)) {
                $verificado = true;

                $_SESSION['usuario'] = [
                    'nombre_usuario' => $nombre_usuario,
                    'rol' => $rol,
                    'nombre' => $nombre,
                    'apellido' => $apellido,
                    'descripcion' => $descripcion,
                    'imagen' => $imagen
                ];
                break;
            }
        }
    }


    if ($verificado){
        header("Location: index.php");
    } else {
        header("Location: error.php?error=credenciales");
    }
?>
