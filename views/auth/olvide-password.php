<link rel="stylesheet" href="../build/css/app.css">
<h1 class="nombre-pagina">Olvide mi contraseña</h1>
<p class="descripcion-pagina">Restablece tu contraseña con tu email: </p>

<?php 
    include_once __DIR__ . "/../templates/alertas.php";
?>

<form class="formulario" action="/AppSalon_PHP_MVC_JS_SASS/public/index.php/olvide" method="POST">
    <div class="campo">
        <label for="email">Email: </label>
        <input type="email" id="email" name="email" placeholder="Tu email">
    </div>

    <input type="submit" class="boton" value="Enviar Intrucciones">
</form>

<div class="acciones no-margin-bottom">
    <a href="/AppSalon_PHP_MVC_JS_SASS/public/index.php">Iniciar Sesión</a>
    <a href="/AppSalon_PHP_MVC_JS_SASS/public/index.php/crear-cuenta">Crear una Cuenta</a>
</div>