<link rel="stylesheet" href="../build/css/app.css">
<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-pagina">Llena el siguiente formulario: </p>

<?php 
    include_once __DIR__ . "/../templates/alertas.php";
?>

<?php if($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_COOKIE['cc_recientemente'])) {
    if(empty($alertas)) { ?>
        <div class="alerta correctlog">Cuenta creada correctamente</div>
    <?php setcookie('cc_recientemente', 'true', time() + 1*5); ?>
   <?php } ?>
<?php }; ?>

<form class="formulario" method="POST" action="/AppSalon_PHP_MVC_JS_SASS/public/index.php/crear-cuenta">
    <div class="campo">
        <label for="nombre">Nombre: </label>
        <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" value="<?php echo s($usuario->nombre); ?>">
    </div>

    <div class="campo">
        <label for="apellido">Apellido: </label>
        <input type="text" id="apellido" name="apellido" placeholder="Tu apellido" value="<?php echo s($usuario->apellido); ?>">
    </div>

    <div class="campo">
        <label for="telefono">Telefono: </label>
        <input type="tel" id="telefono" name="telefono" placeholder="Tu telefono" value="<?php echo s($usuario->telefono); ?>">
    </div>

    <div class="campo">
        <label for="email">Email: </label>
        <input type="email" id="email" name="email" placeholder="Tu email" value="<?php echo s($usuario->email); ?>">
    </div>

    <div class="campo">
        <label for="password">Password: </label>
        <input type="password" id="password" name="password" placeholder="Tu password">
    </div>

    <div class="campo">
        <label for="password2">Confirmar Password: </label>
        <input type="password" id="password2" name="password2" placeholder="Misma Password">
    </div>

    <input type="submit" value="--> Crear cuenta <--" class="boton">
</form>

<div class="acciones no-margin-bottom">
    <a href="/AppSalon_PHP_MVC_JS_SASS/public/index.php">Iniciar Sesión</a>
    <a href="/AppSalon_PHP_MVC_JS_SASS/public/index.php/olvide">Olvidé mi contraseña</a>
</div>