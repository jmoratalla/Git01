<?php 


require_once("class_EntidadBase.php");


class Escandallos extends EntidadBase{

    private $escandallo_id;
    private $escandallo_nombre;
    private $fecha_create;
    private $fecha_delete;
    private $activo;

     
    public function __construct() {
        $table="e_escandallos";
        parent::__construct($table);
    }
     
    public function getId() {
        return $this->escandallo_id;
    }
 
    public function setId($escandallo_id) {
        $this->id = $escandallo_id;
    }

    public function getEscandallo_nombre() {
    	return $this->escandallo_nombre;
    }
    
    public function setEscandallo_nombre($escandallo_nombre) {
    	$this->escandallo_nombre = $escandallo_nombre;
    } 
     
    public function getFecha_create() {
        return $this->fecha_create;
    }
 
    public function setFecha_create($fecha_create) {
        $this->fecha_create = $fecha_create;
    }
 
    public function getFecha_delete() {
        return $this->fecha_delete;
    }
 
    public function setFecha_delete($fecha_delete) {
        $this->fecha_delete = $fecha_delete;
    }
 
    public function getActivo() {
        return $this->activo;
    }
 
    public function setEmail($activo) {
        $this->activo = $activo;
    }
 
    public function saveEscandallo(){
    	echo $this->table;

    
    	$sql="INSERT INTO $this->table (escandallo_nombre,fecha_create)
    	VALUES(:escandallo_nombre, NOW())";

    	$stmt = $this->db_conn->db->prepare($sql);
    	$stmt->bindValue(':escandallo_nombre', $this->escandallo_nombre);
    	$stmt->execute();


        return "correcto";
    }


        public function getEscandallo(){
        $query="INSERT INTO usuarios (id,nombre,apellido,email,password)
                VALUES(NULL,
                       '".$this->nombre."',
                       '".$this->apellido."',
                       '".$this->email."',
                       '".$this->password."');";
        $save=$this->db()->query($query);
        //$this->db()->error;
        return $save;
    }
 
}

?>