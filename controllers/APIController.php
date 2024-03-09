<?php 

namespace Controllers;
use Model\Servicio;
use Model\Cita;
use Model\CitaServicio;

class APIController {
    public static function index() {
        $servicios = Servicio::all();
        echo json_encode($servicios);
    }

    public static function guardar() {
        
        // almacenar cita y devolver id
        $cita = new Cita($_POST);
        $resultado = $cita -> guardar();

        $id = $resultado["id"];
        //$respuesta = ["cita" => $cita];

        // almacena la cita y el o los servicios
        $id_servicios = explode(",", $_POST["servicios"]);

        foreach($id_servicios as $id_servicio) {
            $args = [
                "id_citas" => $id,
                "id_servicios" => $id_servicio
            ];
            $citaServicio = new CitaServicio($args);
            $citaServicio -> guardar();
        }
        
        
        $respuesta = [
            "resultado" => $resultado,
        ];

        echo json_encode($resultado);
    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST["id"];
            
            $cita = Cita::find($id);
            $cita -> eliminar();
            header("location:" .$_SERVER["HTTP_REFERER"]);
        }
    }
}