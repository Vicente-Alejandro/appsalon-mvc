<?php 

namespace Controllers;

use Model\AdminCita;
use MVC\Router;

class AdminController {
    public static function index(Router $router) {
        session_start();

        if(!$_SESSION["admin"]) {
            header("location: /AppSalon_PHP_MVC_JS_SASS/public/index.php");
        }

        date_default_timezone_set('America/Santiago');

        $fecha = $_GET["fecha"] ?? $fecha = date("Y-m-d");
        $fechas = explode("-", $fecha);

        
        if(!checkdate($fechas[1], $fechas[2], $fechas[0])) {
            header("location: /404");
        };  

        // Consulta BD
        $consulta = "SELECT 
                        citas.id, 
                        citas.hora, 
                        CONCAT(usuarios.nombre, ' ', usuarios.apellido) as cliente, 
                        usuarios.email, 
                        usuarios.telefono, 
                        servicios.nombre AS servicio, 
                        servicios.precio 
                    FROM 
                        citas 
                    LEFT OUTER JOIN 
                        usuarios ON citas.id_usuario = usuarios.id 
                    LEFT OUTER JOIN 
                        citas_servicios ON citas.id = citas_servicios.id_citas 
                    LEFT OUTER JOIN 
                        servicios ON servicios.id = citas_servicios.id_servicios
                    WHERE 
                        fecha = '{$fecha}'
                    ORDER BY citas.id DESC limit 40"; 

        $citas = AdminCita::SQL($consulta);
        
        $router -> render("admin/index", [
            "nombre" => $_SESSION["nombre"],
            "citas" => $citas,
            "fecha" => $fecha
        ]);
    }
}
