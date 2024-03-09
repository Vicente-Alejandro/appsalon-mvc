<link rel="stylesheet" href="../../build/css/app.css">
<h1 class="nombre-pagina">Panel de Servicios</h1>
<p class="descripcion-pagina">Nuevo Servicio</p>

<div class="barra">
    <p><?php echo obtenerSaludo(); ?> <?php echo $nombre ?? ""; ?></p>

    <a href="/AppSalon_PHP_MVC_JS_SASS/public/index.php/logout" class="boton">
        Cerrar Sesión Actual
    </a>
</div>

<?php if(isset($_SESSION["admin"])) { ?>

    <div class="barra-servicios">
        <a class="boton more-width" href="/AppSalon_PHP_MVC_JS_SASS/public/index.php/admin">Ver Citas</a>
        <a class="boton more-width" href="/AppSalon_PHP_MVC_JS_SASS/public/index.php/servicios">Ver Servicios</a>
        <a class="boton more-width" href="/AppSalon_PHP_MVC_JS_SASS/public/index.php/servicios/crear">Nuevo Servicio</a>
    </div>

<?php }; ?>

<?php include_once __DIR__ . "/../templates/alertas.php" ?>

<form action="/AppSalon_PHP_MVC_JS_SASS/public/index.php/servicios/crear" method="POST" class="formulario">

    <?php include_once __DIR__ . "/formulario.php" ?>

    <input type="submit" class="boton" value="Guardar Servicio">
</form>

<script>
  // Función para actualizar la clase "actual"
  function actualizarClaseActual() {
    const urlActual = window.location.pathname; // Obtiene la URL actual
    const botones = document.querySelectorAll('.barra-servicios a'); // Selecciona todos los botones

    for (const boton of botones) {
      const href = boton.getAttribute('href'); // Obtiene la URL del botón
      boton.classList.remove('actual'); // Elimina la clase "actual" de todos los botones

      if (href === urlActual) {
        boton.classList.add('actual'); // Añade la clase "actual" al botón correspondiente
      }
    }
  }

  // Evento para actualizar la clase al cambiar de página
  window.addEventListener('popstate', actualizarClaseActual);

  // Actualizar la clase al cargar la página por primera vez
  actualizarClaseActual();
</script>