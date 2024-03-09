<link rel="stylesheet" href="../build/css/app.css">
<h1 class="nombre-pagina">Confirmar Cuenta</h1>

<?php 
foreach($alertas as $key => $mensajes):
    foreach($mensajes as $mensaje):
?>
    <div class="alerta <?php echo ($key === 'error') ? 'errorlog' : 'correctlog'; ?>">
        <?php echo $mensaje; ?>
    </div>
<?php      
    endforeach;
endforeach;
?>

<div class="acciones no-margin-bottom">
    <a class="boton-none" href="/AppSalon_PHP_MVC_JS_SASS/public/index.php">Iniciar Sesión</a>
</div>

