<?php 
    // toma los datos del model REGISTRO de inicio.php y los escribe en el fichero cosas.txt siguiendo un orden extricto
    //INICIO.PHP: todos los campos son obligatorios,
    //inicio.php -> modal registro tiene que manda a esta pagina

    session_start();

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $usuario = isset($_POST['usuarioRegistro']) ? $_POST["usuarioRegistro"] : "";
        $contrasena = isset($_POST["contrasena"]) ? $_POST["contrasena"] : "";
        $contrasenaRepetida = isset($_POST["contrasenaRepetida"]) ? $_POST["contrasenaRepetida"] : "";
        $rol = isset($_POST["rol"]) ? $_POST["rol"] : "";
        $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
        $apellido = isset($_POST["apellido"]) ? $_POST["apellido"] : "";
        $descripcion = isset($_POST["biografia"]) ? $_POST["biografia"] : "";
        $imagen = isset($_FILES["fotoPerfil"]) ? $_FILES["fotoPerfil"] : "";
    }

    // TODO se hace de otra forma? que salga el mensaje en el propio modal
    if ($contrasena !== $contrasenaRepetida) {
        $_SESSION['error'] = 'Las contraseñas no coinciden.';
        header("Location: inicio.php");
        exit();
    }

    $extensionesPermitidas = ["jpg", "jpeg", "png"];
    $maxSizeFile = 2*1024*1024;
    

    if ($imagen && $imagen["error"] === UPLOAD_ERR_OK) {
        // Size: propiedad de php que guarda temp el size de la img en cuestiçon
        $fileSize = $imagen["size"];

        // Extrae la extension con PATHINFO_EXTENSION en minusculas  
        $fileExtension = strtolower(pathinfo($imagen["name"], PATHINFO_EXTENSION));

        //Verifica si la extension entrante esta permitida y el tamaño
        if (in_array($fileExtension, $extensionesPermitidas) && $fileSize < $maxSizeFile) {
            $imageTmpName = $imagen["tmp_name"];
            $imageName = "../img/fotoPerfil/fotoPerfil" . $nombre . $apellido . "." . pathinfo($imagen["name"], PATHINFO_EXTENSION);

            // Intena mover el archivo de ubicacion tmp -> carpeta destino
            if (!move_uploaded_file($imageTmpName, $imageName)) {   
                $_SESSION['error'] = 'Error al subir la imagen.';
                header("Location: inicio.php");
                exit();
            }
        } else {
            $_SESSION['error'] = 'Imagen inválida (solo .jpg, .jpeg, .png y máx. 2MB).';
            header("Location: inicio.php");
            exit();
        }
        
    } else {
        $_SESSION['error'] = 'No se proporcionó una imagen válida.';
        header("Location: inicio.php");
        exit();
    }


    // Encriptación de la contraseña
    $contraEncriptada = password_hash($contrasena, PASSWORD_BCRYPT);

    // Ruta archivo
    $rutaArchivo = "cosas.txt";

    // Datos del usuario
    $datosUsuario = $usuario . ":" . $contraEncriptada . ":" . $rol . ":" . $nombre . ":" . $apellido . ":" . $descripcion . ":" . basename($imageName) . PHP_EOL;

    // Escribir datos en el archivo, en modo append
    $archivo = fopen($rutaArchivo, "a");
    if ($archivo) {
        //datos guardados
        fwrite($archivo, $datosUsuario);
        fclose($archivo);
    } else {
        $_SESSION['error'] = 'No se pudo hacer el registro';
        header("Location: inicio.php");
        exit();
    }

    // Crear carpeta de registros al usuario que se esta registrando. Formato carpeta; Nombre Apellido
    $directorioUsuario = "registro/" . $nombre . " " . $apellido;

    // Crea la carpeta del usuario al registrarse
    if (!is_dir($directorioUsuario)) {
        mkdir($directorioUsuario, 0755, true);
    }

    header("Location: inicio.php");
    exit();


?>