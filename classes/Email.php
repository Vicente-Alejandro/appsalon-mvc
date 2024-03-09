<?php 

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Email {
    public $email;
    public $nombre;
    public $token;


    public function __construct($email, $nombre, $token) {
        $this -> email = $email;
        $this -> nombre = $nombre;
        $this -> token = $token;

    }

    public function enviarConfirmacion() {
        $fecha = obtenerFechaFormatoDiaMesAño();
        // crear obj email
        
        $mail = new PHPMailer();
        $mail -> isSMTP();
        $mail -> Host = $_ENV["EMAIL_HOST"];
        $mail -> SMTPAuth = true;
        $mail -> Port = $_ENV["EMAIL_PORT"];
        $mail -> Username = $_ENV["EMAIL_USER"];
        $mail -> Password = $_ENV["EMAIL_PASS"];
        $mail -> SMTPSecure = "tls";
    
        $mail -> setFrom("cuentas@appsalon.com");
        $mail -> addAddress("cuentas@appsalon.com", "Appsalon.com");
        $mail -> Subject = "Confirma tu cuenta";
    
        // Habilitar HTML
        $mail->isHTML(true);
        $mail->CharSet = "UTF-8";
    
        // Definir el contenido
    
        $contenido ="<html>";
        $contenido .= "<p>Tienes un nuevo Mensaje 👋 </p>";
        $contenido .= "<p>Hola! " . $this->email . " 💯 </p>";
        $contenido .= "<p>Has creado tu cuenta en App Salon. Solo debes confirmar presionando el siguiente enlace. ✅ </p>";
        $contenido .= "<p>Has clic a continuación: </p>";
        $contenido .= "<p>" . "<a href='". $_ENV["APP_URL"] ."/AppSalon_PHP_MVC_JS_SASS/public/index.php/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a>" . "</p>";
        $contenido .= "<p>Si no solicitaste esta cuenta puedes ignorar el mensaje</p>";
        $contenido .= "<p> </p>";
        $contenido .= "<p>Con Fecha en: {$fecha} " . obtenerHoraEmojiSantiago() . "</p>";
        $contenido .= "<p>Saludos cordiales, </p>";
        $contenido .= "<p>Sr. Vicente. </p>";
        $contenido .= "</html>";
    
        $mail->Body = $contenido;
        $emoji = obtenerHoraEmojiSantiago();
        $Altcontenido = "

        **Tienes un nuevo Mensaje **

        Hola! {$this->email} 

        Has creado tu cuenta en App Salon. Solo debes confirmar presionando el siguiente enlace. ✅:

        ". $_ENV["APP_URL"] ."/AppSalon_PHP_MVC_JS_SASS/public/index.php/confirmar-cuenta?token={$this->token}

        **Confirmar Cuenta**

        Si no solicitaste esta cuenta puedes ignorar el mensaje.

        **Con Fecha en: {$fecha} {$emoji}**

        Saludos cordiales,

        Sr. Vicente.

        ";
        $mail->AltBody = $Altcontenido;
    
        // Enviar mail
        $mail->send();   
    }

    public function enviarIntrucciones() {
        $fecha = obtenerFechaFormatoDiaMesAño();
        // crear obj email
        
        $mail = new PHPMailer();
        $mail -> isSMTP();
        $mail -> Host = $_ENV["EMAIL_HOST"];
        $mail -> SMTPAuth = true;
        $mail -> Port = $_ENV["EMAIL_PORT"];
        $mail -> Username = $_ENV["EMAIL_USER"];
        $mail -> Password = $_ENV["EMAIL_PASS"];
        $mail -> SMTPSecure = "tls";
    
        $mail -> setFrom("cuentas@appsalon.com");
        $mail -> addAddress("cuentas@appsalon.com", "Appsalon.com");
        $mail -> Subject = "Restablece tu contraseña";
    
        // Habilitar HTML
        $mail->isHTML(true);
        $mail->CharSet = "UTF-8";
    
        // Definir el contenido
    
        $contenido ="<html>";
        $contenido .= "<p>Tienes un nuevo Mensaje 👋 </p>";
        $contenido .= "<p>Hola! " . $this->email . " 💯 </p>";
        $contenido .= "<p>Para restablecer tu contraseña, confirma presionando el siguiente enlace ✅ </p>";
        $contenido .= "<p>Has clic a continuación: </p>";
        $contenido .= "<p>" . "<a href='". $_ENV["APP_URL"] ."/AppSalon_PHP_MVC_JS_SASS/public/index.php/recuperar?token=" . $this->token . "'>-> Restablecer Contraseña <-</a>" . "</p>";
        $contenido .= "<p>Si no solicitaste la recuperación de contraseña puedes ignorar el mensaje</p>";
        $contenido .= "<p> </p>";
        $contenido .= "<p>Con Fecha en: {$fecha} " . obtenerHoraEmojiSantiago() . "</p>";
        $contenido .= "<p>Saludos cordiales, </p>";
        $contenido .= "<p>Sr. Vicente. </p>";
        $contenido .= "</html>";
    
        $mail->Body = $contenido;
        $emoji = obtenerHoraEmojiSantiago();
        $Altcontenido = "

        **Tienes un nuevo Mensaje **

        Hola! {$this->email} 

        Para restablecer tu contraseña, confirma presionando el siguiente enlace ✅:

        ". $_ENV["APP_URL"] ."/AppSalon_PHP_MVC_JS_SASS/public/index.php/recuperar?token={$this->token}

        **-> Restablecer Contraseña <-**

        Si no solicitaste la recuperación de contraseña puedes ignorar el mensaje.

        **Con Fecha en: {$fecha} {$emoji}**

        Saludos cordiales,

        Sr. Vicente.

        ";
        $mail->AltBody = $Altcontenido;
    
        // Enviar mail
        $mail->send(); 
    }

};
