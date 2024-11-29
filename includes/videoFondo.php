<?php
// Lista de videos
$videos = [
    "screenCode" => "../video/screenCode.mp4",
    "screenCode2" => "../video/screenCode2.mp4",
    "screenCode3" => "../video/screenCode3.mp4",
    "MU-TH-UR 6000 Matrix" => "../video/screenCodeMatrixMod.mp4",
    "Matrix" => "../video/screenCodeMatrix.mp4"
];

// Video predeterminado en caso de que no exista en localStorage
$defaultVideo = $videos["screenCode"];
?>

<video autoplay muted loop id="screenCode">
    <source src="<?php echo $defaultVideo; ?>" type="video/mp4">
    MU-TH-UR 6000 está experimentando serios problemas para reproducir el video.
</video>

<script>
    // Cargar video desde localStorage o usar el predeterminado
    const videoElement = document.getElementById('screenCode');
    const savedVideo = localStorage.getItem('selectedVideo');
    if (savedVideo) {
        videoElement.src = savedVideo;
        videoElement.load();
    } else {
        // Guardar el video predeterminado si no hay nada en localStorage
        localStorage.setItem('selectedVideo', "<?php echo $defaultVideo; ?>");
    }

    
</script>


<!--
CONTROL DE HORAS INVERIDAS EN EL PROYECTO

        Miercoles 13    1h + 3h + 3h =  7h
        Jueves 14       3h + 2h + 6h = 11h
        Viernes 15      6h + 8h + 3h = 17h
        Sabado 16       7h           =  7h
        Domingo 17      4h + 3h + 4h = 11h
        Lunes 18        3h           =  3h
        Martes 19                    =  0h
        Miercoles 20    4h + 6h      = 10h
        Jueves 21       2h + 3h      =  5h
        Viernes 22      4h + 5h      =  9h
        Sabado 23       3h           =  3h
        HTML FINALIZADO              =  83h

-->