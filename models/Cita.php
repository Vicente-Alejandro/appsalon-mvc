<?php  

namespace Model;

class Cita extends ActiveRecord {

    //configg
    protected static $tabla = "citas";
    protected static $columnasDB = ["id", "fecha", "hora", "id_usuario"];

    public $id;
    public $fecha;
    public $hora;
    public $id_usuario;

    public function __construct($args= []) 
    {
        $this -> id = $args["id"] ?? null;
        $this -> fecha = $args["fecha"] ?? "";
        $this -> hora = $args["hora"] ?? "";
        $this -> id_usuario = $args["id_usuario"] ?? "";
    }

}