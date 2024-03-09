<link rel="stylesheet" href="../build/css/app.css">
<h1 class="nombre-pagina">Panel de Administración</h1>
<p class="descripcion-pagina"></p>

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

<h2>Buscar Citas</h2>
<div class="busqueda">
    <form class="formulario" method="GET" action="/AppSalon_PHP_MVC_JS_SASS/public/index.php/admin">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" value="<?php echo $fecha ?>" name="fecha" min="2024-03-05">
        </div>
    </form>
</div>

<?php 

    if(count($citas) === 0) {
        echo "<h2>No hay citas para mostrar hoy</h2>";
    };

?>

<div id="citas-admin">
    <ul class="citas">
        <?php
        $idCita = 0;
            foreach($citas as $key => $cita) {
                if($idCita !== $cita->id) {
                    $total = 0;
                           
        ?>
            <li>
                <p>Id: <span><?php echo $cita->id ?></span></p>
                <p>Hora: <span><?php echo $cita->hora ?></span></p>
                <p>Cliente: <span><?php echo $cita->cliente ?></span></p>
                <p>Email: <span><?php echo $cita->email ?></span></p>
                <p>Telefono: <span><?php echo $cita->telefono ?></span></p>

                <h3>Servicios</h3>

                
                <?php $idCita = $cita->id; } //if fin?> 
                <?php $total += $cita->precio*100 ?>
                <p class="servicio"><?php echo $cita->servicio." ".$cita->precio."00$" ?></p>
            <?php $actual = $cita->id; $proximo = $citas[$key+1]->id??0;
                if(esUltimo($actual, $proximo)) {
                    $precioFormateado = number_format($total, 0, ".")."$";
                    $precioFormateado -=0.010; 
                    ?>
                    <p class="total">Total: <span> <?php echo $precioFormateado."0" ?>$ </span></p>
                    <form action="/AppSalon_PHP_MVC_JS_SASS/public/index.php/api/eliminar" method="POST">
                        <input type="hidden" name="id" value="<?php echo $cita->id; ?>">
                        <input type="submit" class="boton-eliminar" value="Eliminar Cita"></input>
                    </form>        
            <?php } ?>
        <?php }; ?>
    </ul>
</div>

<?php 
$script = "<script src='/AppSalon_PHP_MVC_JS_SASS/public/build/js/buscador.js'></script>";
?>

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