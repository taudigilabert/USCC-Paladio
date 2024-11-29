<?php
        session_start();
        
        $error = isset($_SESSION['error']) ? $_SESSION['error'] : null;
        $success = isset($_SESSION['success']) ? $_SESSION['success'] : null;
        unset($_SESSION['error'], $_SESSION['success']); // Elimina mensajes luego de mostrarlo

        //Si  se ha iniciado sesion, te envia directamente a index.php
        if (isset($_SESSION['usuario'])) {
            header("Location: index.php");
            exit();
        }
    ?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PD: USCSS Paladio</title>

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

    <!-- Div principal -->
    <div class="container-fluid text-center mt-10 col-md-6" id="contenedorInicio">
        <p>Bienvenido a la nave:</p>
        <br>
        <h1 class="text-warning" id="USCSSPaladio">USCSS Paladio</h1>
        <img src="../img/logoTransparente.png" alt="Cargando imágen..." id="logoInicio">
        <!-- Botones para abrir los modales -->
        <button class="btn btn-outline-warning mt-3 btn-lg btnPersonalizado" id="btnIniciarSesion" data-bs-toggle="modal"
            data-bs-target="#modalIniciarSesion">Iniciar sesión</button>
        <button class="btn btn-outline-warning mt-3 btn-lg btnPersonalizado" id="btnRegistro" data-bs-toggle="modal"
            data-bs-target="#modalRegistro">Registrar nuevo tripulante</button>
        <button class="btn btn-outline-warning mt-4 btn-lg btnPersonalizado" id="btnCerrarPrograma"
            onclick="window.location.href='../pantallaInicial.php';">CERRAR PROGRAMA</button>
    </div>

    <!-- MODALS -->
    <!-- Modal Iniciar sesión -->
    <div class="modal fade" id="modalIniciarSesion" tabindex="-1" aria-labelledby="modalIniciarSesionLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="modalIniciarSesionLabel">Iniciar sesión</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Cerrar"></button>
                </div>
                <!-- Descripción y formulario -->
                <div class="modal-body">
                    <p class="text mb-4">Ingresa tus credenciales para acceder al programario.</p>

                    <form method="POST" action="login.proc.php" id="formIniciarSesion">
                        <div class="mb-3">
                            <label for="usuario" class="form-label"><strong>Usuario</strong></label>
                            <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingresa usuario.">
                        </div>

                        <div class="mb-3">
                            <label for="contrasena" class="form-label"><strong>Contraseña</strong></label>
                            <input type="password" class="form-control" id="contrasena" name="contrasena"
                                placeholder="Ingresa contraseña.">
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-outline-warning btn-lg btnPersonalizado" id="btnModalIniciarSesion">Iniciar
                                sesión</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Registro -->
    <div class="modal fade" id="modalRegistro" tabindex="-1" aria-labelledby="modalRegistroLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="modalRegistroLabel">Registrar nuevo tripulante</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <!-- Contenido y formulario -->
                <div class="modal-body">
    <!--TODO los mensajes de error se muestran unicamente en el modal, no importa cuantas veces se abra el modal de registro, siempre sale hasta hacer un f5
    el resto de datos rellenados se borra -->
                        <!-- Mensajes de error-->
                        <?php if ($error): ?>
                            <div class="alerta alertaErrorCredenciales">
                            <?= htmlspecialchars($error) ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($success): ?>
                            <div class="alerta alertaCorrectoCredenciales">
                                <?= htmlspecialchars($success) ?>
                            </div>
                        <?php endif; ?>        

                    <p class="text mb-4">Ingresa tus datos para registrar un nuevo tripulante.</p>
                    <form method="POST" action="registro.proc.php" id="formRegistro" enctype="multipart/form-data">
                        <!-- Campos de registro -->
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ingresa apellido" required>
                        </div>
                        <div class="mb-3">
                            <label for="usuarioRegistro" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="usuarioRegistro" name="usuarioRegistro" placeholder="Ingresa usuario" required>
                        </div>
                        <div class="mb-3">
                            <label for="rol" name="rol" class="form-label">Rol</label>
                            <select class="form-select" id="rol" name="rol" required>
                                    <option value="capitan">Capitán</option>
                                    <option value="primer_oficial">Primer oficial</option>
                                    <option value="ingeniero_jefe">Ingeniero jefe</option>
                                    <option value="oficial_seguridad">Oficial de seguridad</option>
                                    <option value="ing_mantenimiento">Ingeniero de mantenimiento</option>
                                    <option value="piloto">Piloto</option>
                                    <option value="oficial_medico">Oficial médico</option>
                                    <option value="cientifico_principal">Cientifico principal</option>
                                </select>
                        </div>
                        <div class="mb-3">
                            <label for="bio" class="form-label">Biografía</label>
                            <textarea class="form-control" id="bio" rows="3" name="biografia" placeholder="Escribe una breve biografía" REQUERIED></textarea>
                        </div>
<!--TODO verificar que las contraseñas coincidan 
    los datos se quedaran ahi si aparece el mensaje de que las contrase no aparecen?-->
                        <div class="mb-3">
                            <label for="contrasenaRegistro" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="contrasenaRegistro" name="contrasena" placeholder="Ingresa tu contraseña" required>
                        </div>
                        <div class="mb-3">
                            <label for="verificarContrasenaRegistro" class="form-label">Verificar Contraseña</label>
                            <input type="password" class="form-control" id="verificarContrasenaRegistro" name="contrasenaRepetida" placeholder="Verifica tu contraseña" required>
                        </div>
                        <!-- Comprobar funcionamiento de la subida de imagen -->
                        <div class="mb-3">
                            <label for="fotoPerfil" class="form-label">Subir Foto de Perfil</label>
                            <input type="file" class="form-control" id="fotoPerfil" name="fotoPerfil" accept="image/*">
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-outline-warning btn-lg btnPersonalizado" id="btnModalRegistro">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts necesarios para Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            // Abre el modal si hay un mensaje en la sesión que mostrar
            <?php if ($error || $success): ?>
                var modal = new bootstrap.Modal(document.getElementById('modalRegistro'));
                modal.show();
            <?php endif; ?>
        </script>


    <!--INCLUDES-->
    <!-- FOOTER -->
    <?php include '../includes/footer.html'; ?>
    <!-- MUSICA-->
    <?php include '../includes/musica.php'; ?>
    <!-- Video de fondo -->
    <?php include '../includes/videoFondo.php';?>
    <!-- Sonido en botones -->
    <?php include '../includes/sonidoBotones.php'; ?>

</body>

</html>

<!--    TODO Ajustar titulos modales
        TODO Añadir blur y sonido a los botones de los modales
        TODO Ajustar tamaño añadir archivo en modal Registro
        

        CONTROL DE HORAS INVERIDAS EN EL PROYECTO

        Miercoles 13    1h + 3h + 3h = 7h
        Jueves 13       3h + 2h + 6h = 11h-->