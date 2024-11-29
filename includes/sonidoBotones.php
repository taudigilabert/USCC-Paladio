<script>
    // SCRIPT SONIDO EN LOS BOTONES

    // Definir sonido
    const hoverSound = new Audio('../sounds/sonido.mp3');

    // Función para reproducir el sonido desde el inicio
    function playSound() {
        hoverSound.currentTime = 0; // Reinicia el sonido
        hoverSound.play();
    }

    // Asignar la función de sonido a cada botón 
    const botones = [//(cambiar variable segun botones en el documento)
        'btnAllWriteVolverMenu',
        'btnEnviarMensaje',
        'btnVolverMenu',
        'btnVolverInicio1',
        'btnVolverInicio2',
        'btnNuevoInforme',
        'btnMisInformes',
        'btnTodosInformes',
        'btnBuzonEntrada',
        'btnEditarPerfil',
        'btnPersonalizar',
        'btnIniciarSesion',
        'btnRegistro',
        'btnCerrarPrograma',
        'btnModalIniciarSesion',
        'btnEditarPerfil',
        'btnCerrarSesion',
        'btnReadVolver',
        'btnResponder',
        'btnReadEditarRegistro',
        'btnGuardarInforme',
        'btnVerInformes',
        'btnNuevoInforme',
        'btnCerrarSesion',
        'btnReadVolver',
        'btnModalRegistro'
    ];

    botones.forEach(id => {
        const boton = document.getElementById(id);
        if (boton) {
            boton.addEventListener('mouseover', playSound);
        }
    });
</script>