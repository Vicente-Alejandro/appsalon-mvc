<div class="campo">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" placeholder="Nombre del Servicio" name="nombre" value="<?php echo $servicio->nombre; ?>">
</div>

<div class="campo">
    <label for="precio">Precio:</label>
    <input type="number" id="precio" placeholder="Precio del Servicio (Mult * 100, 100$ = 10.000$)" name="precio" min="10" max="999" value="<?php echo $servicio->precio; ?>">
</div>

<p class="pprecio"></p>

<div class="barra-servicios-gold">
    <button type="button" class="boton-gold" onclick="cambiarPrecio(150)">Precio en 15.000$</button>
    <button type="button" class="boton-gold" onclick="cambiarPrecio(90)">Precio en 9.000$</button>
    <button type="button" class="boton-gold" onclick="cambiarPrecio(60)">Precio en 6.000$</button>
</div>

<div class="barra-servicios-gold">
    <button type="button" class="boton-gold" onclick="anadirPrecio(100)">Añadir 10.000$</button>
    <button type="button" class="boton-gold" onclick="anadirPrecio(50)">Añadir 5.000$</button>
    <button type="button" class="boton-gold" onclick="anadirPrecio(20)">Añadir 2.000$</button>
    <button type="button" class="boton-gold" onclick="anadirPrecio(10)">Añadir 1.000$</button>
</div>

<div class="barra-servicios-gold">
    <button type="button" class="boton-gold" onclick="restarPrecio(100)">Restar 10.000$</button>
    <button type="button" class="boton-gold" onclick="restarPrecio(50)">Restar 5.000$</button>
    <button type="button" class="boton-gold" onclick="restarPrecio(20)">Restar 2.000$</button>
    <button type="button" class="boton-gold" onclick="restarPrecio(10)">Restar 1.000$</button>
</div>

<script>
document.getElementById("precio").addEventListener("input", function() {
    const nuevoValor = parseFloat(this.value) || 0; // Parse current input value
    document.querySelector(".pprecio").textContent = "Precio Final: " + Math.max(nuevoValor, 0) + "00$";
    if(document.getElementById('precio').value === "0" || document.getElementById('precio').value === "") {
      document.querySelector(".pprecio").textContent = "";
      document.getElementById('precio').value = "";
    }
});
</script>
