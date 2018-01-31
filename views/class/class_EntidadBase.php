
<?php 

class EntidadBase 
{


	public $db_conn;
	private $conectar;
	public $table;



    public function __construct($table) {
            $this->table = $table;
        	require_once("../../class/pdo_db.php");
            $this->db_conn = new ConectPDO();
    }

     
    public function db_conn(){
        return $this->db_conn;
    }
     

    public function getAll($column_order=""){

        $sql="SELECT * FROM $this->table ORDER BY :column_order DESC";
        $stmt = $this->db_conn->db->prepare($sql);
        $stmt->bindValue(':column_order', $column_order);
        $stmt->execute();
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);
          
        //Devolvemos el resultset en forma de array de objetos

        return $resultSet;

    }
     


    public function insertByRow($column,$value){
        $query=$this->db->query("SELECT * FROM $this->table WHERE $column='$value'");
 
        while($row = $query->fetch_object()) {
           $resultSet[]=$row;
        }
         
        return $resultSet;
    }
     


    public function getById($id){
       /* $query=$this->db->query("SELECT * FROM $this->table WHERE id=$id");
 
        if($row = $query->fetch_object()) {
           $resultSet=$row;
        }
         
        return $resultSet;*/
    }
     
    public function getBy($column,$value){
        $query=$this->db->query("SELECT * FROM $this->table WHERE $column='$value'");
 
        while($row = $query->fetch_object()) {
           $resultSet[]=$row;
        }
         
        return $resultSet;
    }
     
    public function deleteById($id){
        $query=$this->db->query("DELETE FROM $this->table WHERE id=$id"); 
        return $query;
    }
     
    public function deleteBy($column,$value){
        $query=$this->db->query("DELETE FROM $this->table WHERE $column='$value'"); 
        return $query;
    }
     
 
    /*
     * Aquí podemos montarnos un montón de métodos que nos ayuden
     * a hacer operaciones con la base de datos de la entidad
     */







}



?>