//document.body.style.zoom = "100%";

let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

const cita = {
    id: "",
    nombre: "",
    fecha: "",
    hora: "",
    servicios: []
}

document.addEventListener("DOMContentLoaded", function() {
    iniciarApp();
});

function iniciarApp() {

    mostrarSeccion(); // muestra y oculta
    tabs(); // cambia cuando pres tabs
    botonesPaginador(); // agrega o quita los botones siguiente anter
    paginaAnterior();
    paginaSiguiente();

    idCliente();
    consultarApi(); // consulta api en back end con php
    nombreCliente(); // añade el nombre del cliente al oobjeto cita
    seleccionarFecha(); // añade la fecha de la cita
    seleccionarHora(); // añade horacita
    mostrarResumen();
};

function mostrarSeccion() {
    // ocultar la seccion que tenga la clase .mostrar
    const seccionAnterior = document.querySelector(".mostrar");
    if(seccionAnterior) {
        seccionAnterior.classList.remove("mostrar");
    }

    // seleccionar sección
    const seccion = document.querySelector(`#paso-${paso}`);
    seccion.classList.add("mostrar");

    // quita actual al anterior
    const tabAnterior = document.querySelector(".actual");
    if(tabAnterior) {
        tabAnterior.classList.remove("actual");
    }

    // resalta el tab actual
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add("actual");
};

function tabs() {
    const botones = document.querySelectorAll(".tabs button");
    
    botones.forEach(boton => {
        boton.addEventListener("click", function(evento) {
            paso = parseInt(evento.target.dataset.paso);
            mostrarSeccion();
            botonesPaginador();
        })
    })
};

function botonesPaginador() {
    const paginaSiguiente = document.querySelector("#siguiente");
    const paginaAnterior = document.querySelector("#anterior");

    if(paso === 1) {
        paginaAnterior.classList.add("ocultar");
        paginaSiguiente.classList.remove("ocultar");
    } else if (paso === 3) {
        paginaAnterior.classList.remove("ocultar");
        paginaSiguiente.classList.add("ocultar");

        mostrarResumen();
    } else {
        paginaAnterior.classList.remove("ocultar");
        paginaSiguiente.classList.remove("ocultar");
    }

    mostrarSeccion();
};

function paginaAnterior() {
    const paginaAnterior = document.querySelector("#anterior");
    paginaAnterior.addEventListener("click", function() {
        if(paso <= pasoInicial) return;
        paso --;
        botonesPaginador();
    })
};

function paginaSiguiente() {
    const paginaSiguiente = document.querySelector("#siguiente");
    paginaSiguiente.addEventListener("click", function() {
        if(paso >= pasoFinal) return;
        paso ++;
        botonesPaginador();
    })
};

async function consultarApi() {

    try {
        const url = `${location.origin}//AppSalon_PHP_MVC_JS_SASS/public/index.php/api/servicios`;
        const resultado = await fetch(url);
        const servicios = await resultado.json();

        mostratServicios(servicios);

    } catch (error) {
        console.log(error);
    }
};

function mostratServicios(servicios) {
    servicios.forEach(servicio => {
        const {id, nombre, precio} = servicio;
        const nombreServicio = document.createElement("P");
        nombreServicio.classList.add("nombre-servicio");
        nombreServicio.textContent = nombre;

        const precioServicio = document.createElement("P");
        precioServicio.classList.add("precio-servicio");
        precioServicio.textContent = precio+"00$";

        const servicioDiv = document.createElement("DIV");
        servicioDiv.classList.add("servicio");
        servicioDiv.dataset.idServicio = id;
        servicioDiv.onclick = function() {
            seleccionarServicio(servicio);
        }

        servicioDiv.appendChild(nombreServicio);
        servicioDiv.appendChild(precioServicio);

        document.querySelector("#servicios").appendChild(servicioDiv);

        // console.log(servicioDiv);

    })
};

function seleccionarServicio(servicio) {
    const {id} = servicio;
    const {servicios} = cita;
    const divServicio = document.querySelector(`[data-id-servicio="${id}"]`)

    if(servicios.some(agregado => agregado.id === id)) {
        // eliminar
        cita.servicios = servicios.filter(agregado => agregado.id !== id);
        divServicio.classList.remove("seleccionado");

    } else {
        // agregar
        cita.servicios = [...servicios, servicio];
        divServicio.classList.add("seleccionado");
    }
    //console.log(cita);

};

function nombreCliente() {
   cita.nombre = document.querySelector("#nombre").value;

   //
};

function seleccionarFecha() {
    const inputFecha = document.querySelector("#fecha");
    inputFecha.addEventListener("input", function(evento) {

        const dia = new Date(evento.target.value).getUTCDay();
        if([6,0].includes(dia)) {
            evento.target.value = "";
            mostrarAlerta("Sólo dias de semana", "errorlog", ".formulario");
        } else {
            cita.fecha = evento.target.value;
        }
    })
};

function mostrarAlerta(mensaje, tipo, elemento) {

    const alertaPrevia = document.querySelector(".alerta");
    if(alertaPrevia) return;

    const alerta = document.createElement("DIV");
    alerta.textContent = mensaje;
    alerta.classList.add("alerta");
    alerta.classList.add(tipo);

    const referencia = document.querySelector(elemento);
    referencia.appendChild(alerta);

    setTimeout(function() {
        alerta.classList.add("ocultar-alerta");
    }, 3000); // Ocultar después de 4 segundos (4000 milisegundos)
    setTimeout(function() {
        alerta.style.display = "none";
        alerta.remove();
    }, 4500); // Ocultar después de 5.5 segundos (5500 milisegundos)
};

function seleccionarHora() {
    const inputHora = document.querySelector("#hora");
    inputHora.addEventListener("input", function(evento) {
        const horaCita = evento.target.value;
        const hora = horaCita.split(":")[0];
        if(hora < 10 || hora > 18) {
            evento.target.value = "";
            mostrarAlerta("Seleccione una hora entre las 10 y las 18", "errorlog", ".formulario")
        } else {
            cita.hora = evento.target.value;
            //console.log(cita);
        }
    })
};

function mostrarResumen() {
    const resumen = document.querySelector(".contenido-resumen");

    while(resumen.firstChild) {
        resumen.removeChild(resumen.firstChild);
    }

    
    if(Object.values(cita).includes("") || cita.servicios.length === 0) {
        mostrarAlerta("Faltas datos de Servicios, Fecha u Hora", "errorlog", ".contenido-resumen");
        return;
    }

    // const imagen = document.querySelector(".imagen");
    // if(paso === 3) {
    //     imagen.classList.add("max-height");
    // } else if(paso === 2 || paso === 1) {
    //     imagen.classList.remove("max-height");
    // }
    
    // formatear div resumen
    const {nombre, fecha, hora, servicios} = cita;


    // heading para servicios resumen
    const headingServicios = document.createElement("H3");
    headingServicios.textContent = "Resumen de Servicios";
    resumen.appendChild(headingServicios);

    servicios.forEach(servicio => {
        const {id, precio, nombre} = servicio;
        const contenedorServicio = document.createElement("DIV");
        contenedorServicio.classList.add("contenedor-servicio");

        const textoServicio = document.createElement("P");
        textoServicio.textContent = nombre;

        const precioServicio = document.createElement("P");
        precioServicio.innerHTML = `<span>Precio: </span>${precio}`;

        contenedorServicio.appendChild(textoServicio);
        contenedorServicio.appendChild(precioServicio);

        resumen.appendChild(contenedorServicio);
    })

    const headingCitas = document.createElement("H3");
    headingCitas.textContent = "Resumen de Citas";
    resumen.appendChild(headingCitas);

    const nombreCliente = document.createElement("P");
    nombreCliente.innerHTML = `<span>Nombre: </span>${nombre}`;

    const fechaObj = new Date(fecha);
    const mes = fechaObj.getMonth();
    const dia = fechaObj.getDate() + 2;
    const year = fechaObj.getFullYear();

    const fechaUTC = new Date(Date.UTC(year,mes,dia));
    const opciones = {weekday: "long", month: "long", day: "numeric"};
    const fechaFormateada = fechaUTC.toLocaleDateString("es-MX", opciones);
    
    //console.log(fechaFormateada);//

    const fechaCliente = document.createElement("P");
    fechaCliente.innerHTML = `<span>Fecha: </span>${fechaFormateada}`;

    const horaCliente = document.createElement("P");
    horaCliente.innerHTML = `<span>Hora: </span>${hora} Horas`;

    // boton para crear cita
    const botonReservar = document.createElement("BUTTON");
    botonReservar.classList.add("boton");
    botonReservar.textContent = "Reservar Cita";
    botonReservar.onclick = reservarCita;

    resumen.appendChild(nombreCliente);
    resumen.appendChild(fechaCliente);
    resumen.appendChild(horaCliente);
    resumen.appendChild(botonReservar);
};

async function reservarCita() {

    const {nombre, fecha, hora, id} = cita;
    const idServicios = cita.servicios.map(servicio => servicio.id);
    //console.log(idServicios);
    //return;

    const datos = new FormData();
    datos.append("fecha", fecha);
    datos.append("hora", hora);
    datos.append("id_usuario", id);
    datos.append("servicios", idServicios);

    // console.log([...datos]);
    // return;

    try {
        // Petición hacia api
        const url = `${location.origin}//AppSalon_PHP_MVC_JS_SASS/public/index.php/api/servicios`;
        const respuesta = await fetch(url, {
            method: "POST",
            body: datos
        });

        const resultado = await respuesta.json();
        console.log(resultado.resultado);

        if(resultado.resultado === true) {
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Cita creada exitosamente! ✅💚",
                showConfirmButton: false,
                timer: 3000
            }).then(() => {
                window.location.reload();
            })
        }
    } catch (error) {
        Swal.fire({
            icon: "error",
            title: "Error",
            text: `Hubo un error al guardar la cita`,
        });
    }



    //console.log([...datos]); //ver formData

}

function idCliente() {
    cita.id = document.querySelector("#id").value;
}

// Panel de servicios
document.getElementById("precio").addEventListener("input", function() {
    const nuevoValor = parseFloat(this.value) || 0; // Parse current input value
    document.querySelector(".pprecio").textContent = "Precio Final: " + Math.max(nuevoValor, 0) + "00$";
    if(document.getElementById('precio').value === "0") {
      document.querySelector(".pprecio").textContent = "";
      document.getElementById('precio').value = "";
    }
});

function cambiarPrecio(valor) {
    // Ensure the value is a number (avoid NaN)
    const nuevoValor = parseFloat(valor) || 0;
    // Set the price, limiting it to a minimum of 0
    document.getElementById('precio').value = Math.max(nuevoValor, 0);
    document.querySelector(".pprecio").textContent = "Precio Final: "+Math.max(nuevoValor, 0)+"00$";
}
  
function anadirPrecio(valor) {
  const precioActual = parseFloat(document.getElementById('precio').value) || 0;
  const nuevoPrecio = precioActual + valor;

  // Set the new price, limiting it to a minimum of 0
  document.getElementById('precio').value = Math.max(nuevoPrecio, 0);
  document.querySelector(".pprecio").textContent = "Precio Final: "+Math.max(nuevoPrecio, 0)+"00$";
}

function restarPrecio(valor) {
  const precioActual = parseFloat(document.getElementById('precio').value) || 0;
  const nuevoPrecio = precioActual - valor;

  // Set the new price, limiting it to a minimum of 0
  document.getElementById('precio').value = Math.max(nuevoPrecio, 0);
  document.querySelector(".pprecio").textContent = "Precio Final: "+Math.max(nuevoPrecio, 0)+"00$";
  if(document.getElementById('precio').value === "0") {
    document.querySelector(".pprecio").textContent = "";
    document.getElementById('precio').value = "";
  }
}

