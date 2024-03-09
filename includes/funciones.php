<?php
date_default_timezone_set('America/Santiago');

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function obtenerFechaFormatoDiaMesAño() {
    // Obtiene la fecha actual
    $fechaActual = date('Y-m-d');
  
    // Convierte la fecha a un objeto DateTime
    $fechaObjeto = new DateTime($fechaActual);
  
    // Formatea la fecha al formato deseado
    $fechaFormateada = $fechaObjeto->format('d/m/Y');
  
    // Retorna la fecha formateada
    return $fechaFormateada;
  }

function obtenerFechaBD() {
    // Obtiene la fecha actual
    $fechaActual = date('Y-m-d');
  
    // Convierte la fecha a un objeto DateTime
    $fechaObjeto = new DateTime($fechaActual);
  
    // Retorna la fecha 
    return $fechaObjeto;
  }

  

function obtenerHoraSantiago() {
    // Establecer la zona horaria a Santiago de Chile
    $zona_horaria = new DateTimeZone('America/Santiago');

    // Crear un objeto DateTime con la zona horaria especificada
    $fecha_actual = new DateTime('now', $zona_horaria);

    // Formatear la hora en el formato deseado
    $hora_santiago = $fecha_actual->format('H : i');

    // Devolver la hora de Santiago de Chile
    return $hora_santiago;
}

function obtenerHoraEmojiSantiago() {
    // Establecer la zona horaria a Santiago de Chile
    $zona_horaria = new DateTimeZone('America/Santiago');

    // Crear un objeto DateTime con la zona horaria especificada
    $fecha_actual = new DateTime('now', $zona_horaria);

    // Obtener la hora actual en formato de 24 horas
    $hora_actual = intval($fecha_actual->format('H'));
    $hora_actual_m = intval($fecha_actual->format('i'));

    // Determinar la hora más cercana y obtener el emoji del reloj correspondiente
    if ($hora_actual == 0 || $hora_actual == 12) {
        if ($hora_actual_m > 30) {
            return '🕧';
        } else {
            return '🕛'; // 12:00 AM / PM
        }
    } elseif ($hora_actual == 1 || $hora_actual == 13) {
        if ($hora_actual_m > 30) {
            return '🕜';
        } else {
            return '🕐'; // 1:00 AM / PM
        }
    } elseif ($hora_actual == 2 || $hora_actual == 14) {
        if ($hora_actual_m > 30) {
            return '🕝';
        } else {
            return '🕑'; // 2:00 AM / PM
        }
    } elseif ($hora_actual == 3 || $hora_actual == 15) {
        if ($hora_actual_m > 30) {
            return '🕞';
        } else {
            return '🕒'; // 3:00 AM / PM
        }
    } elseif ($hora_actual == 4 || $hora_actual == 16) {
        if ($hora_actual_m > 30) {
            return '🕟';
        } else {
            return '🕓'; // 4:00 AM / PM
        }
    } elseif ($hora_actual == 5 || $hora_actual == 17) {
        if ($hora_actual_m > 30) {
            return '🕠';
        } else {
            return '🕔'; // 5:00 AM / PM
        }
    } elseif ($hora_actual == 6 || $hora_actual == 18) {
        if ($hora_actual_m > 30) {
            return '🕡';
        } else {
            return '🕕'; // 6:00 AM / PM
        }
    } elseif ($hora_actual == 7 || $hora_actual == 19) {
        if ($hora_actual_m > 30) {
            return '🕢';
        } else {
            return '🕖'; // 7:00 AM / PM
        }
    } elseif ($hora_actual == 8 || $hora_actual == 20) {
        if ($hora_actual_m > 30) {
            return '🕣';
        } else {
            return '🕗'; // 8:00 AM / PM
        }
    } elseif ($hora_actual == 9 || $hora_actual == 21) {
        if ($hora_actual_m > 30) {
            return '🕤';
        } else {
            return '🕘'; // 9:00 AM / PM
        }      
    } elseif ($hora_actual == 10 || $hora_actual == 22) {
        if ($hora_actual_m > 30) {
            return '🕥';
        } else {
            return '🕙'; // 10:00 AM / PM
        }    
    } elseif ($hora_actual == 11 || $hora_actual == 23) {
        if ($hora_actual_m > 30) {
            return '🕦';
        } else {
            return '🕚'; // 11:00 AM / PM
        }   
    } elseif ($hora_actual == 24) {
        if ($hora_actual_m > 30) {
            return '🕧';
        } else {
            return '🕛'; // 12:00 AM / PM
        }   
    }
}

// revisa si está autenticado
function isAuth() : void {
    if(!isset($_SESSION["login"])) {
        header("location: /AppSalon_PHP_MVC_JS_SASS/public/index.php");
    } 
}


function obtenerSaludo() {
    date_default_timezone_set('America/Santiago');
    $hora_actual = date('H'); // Obtiene la hora actual en formato de 24 horas

    if ($hora_actual < 12 && $hora_actual > 5) {
        return "Buenos días";
    } elseif ($hora_actual > 12 && $hora_actual < 21) {
        return "Buenas tardes";
    } else {
        return "Buenas noches";
    }
}

function esUltimo(string $actual, string $proximo) : bool {
    if($actual !== $proximo) {
        return true;
    }
    return false;
}




