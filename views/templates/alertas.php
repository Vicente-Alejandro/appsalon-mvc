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

<script src="/AppSalon_PHP_MVC_JS_SASS/public/build/js/alertas.js"></script>
<script src="/AppSalon_PHP_MVC_JS_SASS/src/js/app.js"></script>