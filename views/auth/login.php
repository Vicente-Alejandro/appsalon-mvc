<h1 class="nombre-pagina">Login <?php echo " ".obtenerHoraEmojiSantiago() ?></h1>
<p class="descripcion-pagina">Inicia sesión con tus datos: </p>

<?php 
    include_once __DIR__ . "/../templates/alertas.php";
?>

<form class="formulario" method="POST" action="/AppSalon_PHP_MVC_JS_SASS/public/index.php">
    <div class="campo">
        <label for="email">Email: </label>
        <input type="email" id="email" placeholder="Tu email" name="email">
    </div>

    <div class="campo">
        <label for="password">Password: </label>
        <input type="password" id="password" placeholder="Tu password" name="password">
    </div>

    <input type="submit" class="boton" value="Iniciar Sesión">
</form>

<div class="acciones">
    <a href="/AppSalon_PHP_MVC_JS_SASS/public/index.php/crear-cuenta">Crear una cuenta</a>
    <a href="/AppSalon_PHP_MVC_JS_SASS/public/index.php/olvide">Olvidé mi contraseña</a>
</div>

