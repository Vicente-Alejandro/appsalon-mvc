<?php 

namespace Controllers;
use Model\Servicio;
use MVC\Router;

class ServicioController {
    public static function index(Router $router) {

        session_start();

        isAuth();

        $servicios = Servicio::all();

        $router -> render("servicios/index", [
            "nombre" => $_SESSION["nombre"],
            "servicios" => $servicios
        ]);
    }

    public static function crear(Router $router) {
    
        session_start();
        isAuth();

        $servicio = new Servicio();
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicio -> sincronizar($_POST);

            $alertas = $servicio -> validar();

            if(empty($alertas)) {
                $servicio -> guardar();
                header("location: /AppSalon_PHP_MVC_JS_SASS/public/index.php/servicios");
            }

        }

        $router -> render("servicios/crear", [
            "nombre" => $_SESSION["nombre"],
            "servicio" => $servicio,
            "alertas" => $alertas
        ]);
    }

    public static function actualizar(Router $router) {
        session_start();
        isAuth();

        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $isValid = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
        if ($isValid) {
            // El valor es un número entero válido
            $id = $id;
          } else {
            // El valor no es un número entero válido
            $id = 0;
            header("location: /AppSalon_PHP_MVC_JS_SASS/public/index.php/servicios");
          }
        $servicio = Servicio::find($id);
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicio -> sincronizar($_POST);
            $alertas = $servicio->validar();

            if(empty($alertas)) {
                $servicio -> guardar();
                header("location: /AppSalon_PHP_MVC_JS_SASS/public/index.php/servicios");
            }
        }
        
        $router -> render("servicios/actualizar", [
            "nombre" => $_SESSION["nombre"],
            "servicio" => $servicio,
            "alertas" => $alertas
        ]);
    }

    public static function eliminar() {
        session_start();
        isAuth();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST["id"];
            $servicio = Servicio::find($id);
            $servicio -> eliminar();
            header("location: /AppSalon_PHP_MVC_JS_SASS/public/index.php/servicios");
        }
    }
}