<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController {
    public static function login(Router $router) {
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario(($_POST));
            $alertas = $auth -> validarLogin();

            if(empty($alertas)) {
                $usuario = Usuario::where("email", $auth->email);

                if($usuario) {
                    // ver password
                    if ($usuario -> comprobarPasswordAndVerificado($auth->password)) {
                        session_start();

                        $_SESSION["id"] = $usuario -> id;
                        $_SESSION["nombre"] = trim($usuario -> nombre);
                        $_SESSION["email"] = $usuario -> email;
                        $_SESSION["login"] = true;

                        // redireccionamiento

                        if($usuario -> admin === "1") {
                            $_SESSION["admin"] = $usuario -> admin ?? null;
                            header("location: /AppSalon_PHP_MVC_JS_SASS/public/index.php/admin");
                        } else {
                            header("location: /AppSalon_PHP_MVC_JS_SASS/public/index.php/cita");
                        }
                    }
                } else {
                    Usuario::setAlerta("error", "Usuario no encontrado...");
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router -> render("auth/login", [
            "alertas" => $alertas
        ]);
    }

    public static function logout() {
        session_start();

        $_SESSION = [];
        header("location: /AppSalon_PHP_MVC_JS_SASS/public/index.php");
    }

    public static function olvide(Router $router) {

        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario(($_POST));
            $alertas = $auth -> validarEmail();

            if(empty($alertas)) {
                $usuario = Usuario::where("email", $auth->email);
                if ($usuario && $usuario -> confirmado === "1") {
                    // gen token
                    $usuario -> crearToken();
                    $usuario -> actualizar();

                    // todo: enviar email
                    $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
                    $email->enviarIntrucciones();

                    // enviar alerta
                    Usuario::setAlerta("correct", "Revisa tu email 🫛🍏🌿");

                } else {
                    Usuario::setAlerta("error", "El usuario no existe o aún no está confirmado");
                    
                }
            };
        }

        $alertas = Usuario::getAlertas();

        $router -> render("auth/olvide-password", [
            "alertas" => $alertas
        ]);
    }

    public static function recuperar(Router $router) {
        
        $alertas = [];
        $error = false;
        $token = s($_GET["token"]);

        // buscar user por token
        $usuario = Usuario::where("token", $token);

        if(empty($usuario)) {
            Usuario::setAlerta("error", "Token no valido");
            $error = true;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // leer new password y guardar 
            
            $password = new Usuario($_POST);
            $password2 = $_POST["password2"];
            $alertas = $password -> validarPassword($password2);

            if(empty($alertas)) {
                $usuario -> password = null;
                $usuario -> password = $password -> password;
                $usuario -> hashPassword();
                $usuario -> token = null;
                $resultado = $usuario -> actualizar();
                
                if($resultado) {
                    header("location: /AppSalon_PHP_MVC_JS_SASS/public/index.php");
                } else {
                    ;
                }

            } else {
                ;
            }
        }

        $alertas = Usuario::getAlertas();

        $router -> render("auth/recuperar-password", [
            "alertas" => $alertas,
            "error" => $error
        ]);
    }

    public static function crear(Router $router) {
        $usuario = new Usuario;

        $alertas = [];
        if($_COOKIE['cc_recientemente']) {
            $alertas["error"][] = "Espere antes de crear una nueva cuenta...";
        }
        if($_SERVER["REQUEST_METHOD"] === "POST" && !isset($_COOKIE['cc_recientemente'])) {
            $usuario -> sincronizar($_POST);
            $password2 = $_POST["password2"];
            $alertas = $usuario -> validarNuevaCuenta($password2);
            // alertas = [];
            if(empty($alertas)) {
                $resultado = $usuario -> existeUsuario();
                if($resultado -> num_rows) {
                    $alertas = Usuario::getAlertas();
                } else {
                    // hash
                    $usuario -> hashPassword();                   
                    
                    // token
                    $usuario -> crearToken();

                    // enviar mail
                    $email = new Email($usuario -> nombre, $usuario -> email, $usuario -> token);
                    $email -> enviarConfirmacion();
                    
                    // crear usuraio
                    $resultado = $usuario -> guardar($usuario->id);
                    if($resultado) {
                        header("location: /AppSalon_PHP_MVC_JS_SASS/public/index.php/mensaje");
                    }
                };
            };

        };
        $router -> render("auth/crear-cuenta", [
            "usuario" => $usuario,
            "alertas" => $alertas
        ]);
    }

    public static function mensaje(Router $router) {
        $router->render("auth/mensaje");
    }

    public static function confirmar(Router $router) {
        $alertas = [];

        $token = s($_GET["token"]);

        $usuario = Usuario::where("token", $token." ");
        
        if(empty($usuario)) {
            // error
            Usuario::setAlerta("error", "Token no valido...");
        } else {
            // mod a usuario confirmado
            //
            $usuario -> confirmado = "1";
            $usuario -> token = null;
            Usuario::setAlerta("correct", "Cuenta comprobada correctamente ".obtenerHoraEmojiSantiago());
            $usuario -> actualizar(); 
        }

        // render vista
        $alertas = Usuario::getAlertas();
        $router->render("auth/confirmar-cuenta", [
            "alertas" => $alertas
        ]); 
    }
    
};