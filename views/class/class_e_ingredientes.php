<?php 


require_once("class_EntidadBase.php");


class Ingredientes extends EntidadBase{

    private $ingrediente_id;
    private $nom_ingrediente;
    private $cantidad_usada;
    private $uni_medida_cant_usada;
    private $cantidad_comprada;
    private $coste_comprado;
    private $cantidad_merma;
    private $peso_neto;
    private $total;

     
    public function __construct() {
        $table="e_ingredientes";
        parent::__construct($table);
    }
     
    public function getId() {
        return $this->ingrediente_id;
    }
 
    public function setId($ingrediente_id) {
        $this->id = $ingrediente_id;
    }

    public function getNom_ingrediente() {
    	return $this->nom_ingrediente;
    }
    
    public function setNom_ingrediente($nom_ingrediente) {
    	$this->nom_ingrediente = $nom_ingrediente;
    } 

    public function setCantidad_usada($cantidad_usada) {
        $this->cantidad_usada = $cantidad_usada;
    } 

     public function getCantidad_usada() {
        return $this->cantidad_usada;
    } 

    public function setUni_medida_cant_usada($uni_medida_cant_usada) {
        $this->uni_medida_cant_usada = $uni_medida_cant_usada;
    } 

     public function getUni_medida_cant_usada() {
        return $this->uni_medida_cant_usada;
    } 

    public function setCantidad_comprada($cantidad_comprada) {
        $this->cantidad_comprada = $cantidad_comprada;
    } 

     public function getCantidad_comprada() {
        return $this->cantidad_comprada;
    } 

    public function setCoste_comprado($coste_comprado) {
        $this->coste_comprado = $coste_comprado;
    } 

     public function getCoste_comprado() {
        return $this->coste_comprado;
    } 

    public function setCantidad_merma($cantidad_merma) {
        $this->cantidad_merma = $cantidad_merma;
    } 

     public function getCantidad_merma() {
        return $this->cantidad_merma;
    } 

    public function setPeso_neto($peso_neto) {
        $this->peso_neto = $peso_neto;
    } 

     public function getPeso_neto() {
        return $this->peso_neto;
    } 

 
    public function setTotal($total) {
        $this->total = $total;
    } 

     public function getTotal() {
        return $this->total;
    } 



    public function saveIngrediente(){
        
    	$sql="INSERT INTO $this->table (nom_ingrediente, cantidad_usada, uni_medida_cant_usada, uni_medida_cant_usada, cantidad_comprada, coste_comprado, cantidad_merma, peso_neto, total)
    	VALUES(:nom_ingrediente, :cantidad_usada, :uni_medida_cant_usada, :uni_medida_cant_usada, :cantidad_comprada, :coste_comprado, :cantidad_merma, :peso_neto, :total )";

    	$stmt = $this->db_conn->db->prepare($sql);
        $stmt->bindValue(':nom_ingrediente', $this->escandallo_nombre);
        $stmt->bindValue(':cantidad_usada', $this->escandallo_nombre);
        $stmt->bindValue(':uni_medida_cant_usada', $this->escandallo_nombre);
        $stmt->bindValue(':cantidad_comprada', $this->escandallo_nombre);
        $stmt->bindValue(':coste_comprado', $this->escandallo_nombre);
        $stmt->bindValue(':cantidad_merma', $this->escandallo_nombre);
        $stmt->bindValue(':peso_neto', $this->escandallo_nombre);
    	$stmt->bindValue(':total', $this->escandallo_nombre);
    	$stmt->execute();
        $id = $this->db_conn->db->lastInsertId();

        return $id;
    }

 
}

?>