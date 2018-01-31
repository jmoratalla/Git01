<?php 


require_once("class_EntidadBase.php");


class Escandallos_user extends EntidadBase{

    private $escandallos_user_id;
    private $escandallo_id;
    private $user_id;
 
    
    public function __construct() {
        $table="e_escandallos_user";
        parent::__construct($table);
    }
     
    public function getEscandallos_user_id() {
        return $this->escandallos_user_id;
    }
 
    public function setEscandallos_user_id($escandallos_user_id) {
        $this->id = $escandallos_user_id;
    }

    public function getEscandallo_id() {
    	return $this->escandallo_id;
    }
    
    public function setEscandallo_id($escandallo_id) {
    	$this->escandallo_id = $escandallo_id;
    } 

    public function getUser_id() {
        return $this->user_id;
    }
    public function setUser_id($user_id) {
        $this->user_id = $user_id;
    } 

   

    public function saveEscandallo_user(){
        
        $sql="INSERT INTO $this->table ( escandallo_id, user_id)
            VALUES(:escandallo_id, :user_id)";

            $stmt = $this->db_conn->db->prepare($sql);
            $stmt->bindValue(':escandallo_id', $this->escandallo_id);
            $stmt->bindValue(':user_id', $this->user_id);
            $stmt->execute();
            $id = $this->db_conn->db->lastInsertId();

            return $id;
    }

 
}

?>