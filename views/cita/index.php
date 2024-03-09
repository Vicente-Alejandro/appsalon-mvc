<link rel="stylesheet" href="../build/css/app.css">
<h1 class="nombre-pagina">Asignar nueva cita</h1>
<p class="descripcion-pagina">Eliga su servicios a continuación: </p>
<?php $fecha = obtenerFechaFormatoDiaMesAño(); ?>

<div class="barra">
    <p><?php echo obtenerSaludo(); ?> <?php echo $nombre ?? ""; ?></p>

    <a href="/AppSalon_PHP_MVC_JS_SASS/public/index.php/logout" class="boton">
        Cerrar Sesión Actual
    </a>
</div>

<div id="app">
    <nav class="tabs">
        <button class="actual" type="button" data-paso="1">Servicios</button>
        <button type="button" data-paso="2">información de cita</button>
        <button type="button" data-paso="3">Resumen</button>
    </nav>

    <div id="paso-1" class="seccion">
        <h2>Selecciona tus Servicios</h2>
        <p class="text-center">Elige los servicios que deseas:</p>
        <div id="servicios" class="listado-servicios"></div>
     </div>

    <div id="paso-2" class="seccion">
        <h2>Tus Datos y Cita</h2>
        <p class="text-center">Ingresa tus datos y la fecha/hora de tu cita:</p>

        <form class="formulario">
            <div class="campo">
                <label for="nombre">Nombre:</label>
                <input id="nombre" type="text" placeholder="Tu nombre" value="<?php echo $nombre; ?>" disabled>
            </div>

            <div class="campo">
                <label for="fecha">Fecha:</label>
                <input id="fecha" type="date" min="<?php echo date("Y-m-d"); ?>">
            </div>

            <div class="campo">
                <label for="hora">Hora:</label>
                <input id="hora" type="time">
            </div>
            <input type="hidden" id="id" value="<?php echo $id; ?>">
        </form>
    </div>

    <div id="paso-3" class="seccion contenido-resumen">
        <h2>Resumen de la Cita</h2>
        <p class="text-center">Verifica que la información sea correcta</p>
    </div>

    <div class="paginacion">
        <button id="anterior" class="boton">&laquo; Anterior</button>
        <button id="siguiente" class="boton"> Siguiente &raquo;</button>
    </div>
</div>

<?php $script = 
"
<script src='/AppSalon_PHP_MVC_JS_SASS/src/js/app.js'></script>
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
"
?>


