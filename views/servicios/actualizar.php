<link rel="stylesheet" href="../../build/css/app.css">
<h1 class="nombre-pagina">Panel de Servicios</h1>
<p class="descripcion-pagina">Actualizar Servicio</p>

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

<form method="POST" class="formulario">

    <?php include_once __DIR__ . "/formulario.php" ?>

    <input type="submit" class="boton" value="Actualizar Servicio">
</form>

<script>
window.onload = function() {
updatePrecio(); // Call updatePrecio on page load
};

function updatePrecio() {
  const nuevoValor = parseFloat(document.getElementById("precio").value) || 0; // Parse current input value
  document.querySelector(".pprecio").textContent = "Precio Final: " + Math.max(nuevoValor, 0) + "00$";
};
</script>