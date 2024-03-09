<link rel="stylesheet" href="../build/css/app.css">
<h1 class="nombre-pagina">Recuperar Password <?php echo " ".obtenerHoraEmojiSantiago() ?></h1>


<?php 
    include_once __DIR__ . "/../templates/alertas.php";
?>

<?php if($error) { ?>

<div class="acciones">
    <a href="/AppSalon_PHP_MVC_JS_SASS/public/index.php">Iniciar Sesión</a>
    <a href="/AppSalon_PHP_MVC_JS_SASS/public/index.php/crear-cuenta">Crear Cuenta</a>
</div>

<?php } ?>
<?php return; ?>


<p class="descripcion-pagina">Eliga una nueva contraseña segura y única para proteger su cuenta 🌹</p>


<form class="formulario" method="POST">
    <div class="campo">
        <label for="password">Password: </label>
        <input type="password" id="password" name="password" placeholder="Tu nueva contraseña">
    </div>
    <div class="campo">
        <label for="password2">Repita su password: </label>
        <input type="password" id="password2" name="password2" placeholder="Misma nueva contraseña">
    </div>

    <input type="submit" class="boton" value="Guardar nueva contraseña">
</form>

<div class="acciones">
    <a href="/AppSalon_PHP_MVC_JS_SASS/public/index.php">Iniciar Sesión</a>
    <a href="/AppSalon_PHP_MVC_JS_SASS/public/index.php/crear-cuenta">Crear Cuenta</a>
</div>