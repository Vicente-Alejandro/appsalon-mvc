<?php 

namespace Model;

class Usuario extends ActiveRecord {
    // bd
    protected static $tabla = "usuarios";
    protected static $columnasDB = ["id", "nombre", "apellido", "email", "password", "telefono", "admin", "confirmado", "token"];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args = []) {
        $this -> id = $args["id"] ?? null;
        $this -> nombre = $args["nombre"] ?? "";
        $this -> apellido = $args["apellido"] ?? "";
        $this -> email = $args["email"] ?? "";
        $this -> password = $args["password"] ?? "";
        $this -> telefono = $args["telefono"] ?? "";
        $this -> admin = $args["admin"] ?? 0;
        $this -> confirmado = $args["confirmado"] ?? 0;
        $this -> token = $args["token"] ?? "";
    }

    // Mensajes de validación par a la creación de la cuenta
    public function validarNuevaCuenta($password2) {
        if(!$this -> nombre) {  
            self::$alertas["error"][] = "El Nombre es obligatorio";
        }
        if(!$this -> apellido) {  
            self::$alertas["error"][] = "El Apellido es obligatorio";
        }
        if(!$this -> telefono) {  
            self::$alertas["error"][] = "El Telefono es obligatorio";
        }
        if(!preg_match('/^\+/',$this -> telefono)) {
            $errores[] = "El Número de Telefono debe ser valido";
        }

        if(strlen($this -> telefono) != 12) {
            $errores[] = "Número debe ser de 11 secuenciales, Actual: ".strlen($this -> telefono).".";
        }
        if(!$this -> email || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {  
            self::$alertas["error"][] = "El Email es obligatorio o no es valido";
        }
        if(!$this -> password) {  
            self::$alertas["error"][] = "El Password es obligatorio";
        }
        if(strlen($this->password) < 6) {
            self::$alertas["error"][] = "Password debe tener min 6 caracteres";
        }
        if($this->password != $password2) {
            self::$alertas["error"][] = "El Password debe ser el mismo";
        }

        return self::$alertas;
    }

    public function validarLogin() {
        if(!$this -> email || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas["error"][] = "Email es obligatorio o no es valido";
        }
        if(!$this -> password) {  
            self::$alertas["error"][] = "El Password es obligatorio o no es valido";
        }

        return self::$alertas;
    }

    public function  validarEmail() {
        if(!$this -> email || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas["error"][] = "Email es obligatorio o no es valido";
        }

        return self::$alertas;
    }

    public function validarPassword($password2) {
        if(!$this -> password) {  
            self::$alertas["error"][] = "El Password es obligatorio";
        }
        if(strlen($this->password) < 6) {
            self::$alertas["error"][] = "Password debe tener min 6 caracteres";
        }
        if($this->password != $password2) {
            self::$alertas["error"][] = "El Password debe ser el mismo";
        }

        return self::$alertas;
    }

    public function existeUsuario() {
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1;";
        $resultado = self::$db -> query($query);

        if($resultado -> num_rows) {
            self::$alertas["error"][] = "El usuario ya está registrado";
        }
        return $resultado;
    }

    public function hashPassword() {
        $this -> password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken() {
        $this -> token = uniqid();
    }

    public function comprobarPasswordAndVerificado($password) {  
        $resultado = password_verify($password, $this->password);

        if(!$resultado) {
            self::$alertas["error"][] = "Contraseña incorrecta";
        } elseif (!$this -> confirmado) {
            self::$alertas["error"][] = "El usuario aún no está confirmado, verifique su cuenta antes de continuar";
        } else {
            return true;
        }
    }

}