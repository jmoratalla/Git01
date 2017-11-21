<?php 
/*Esta clase hace referencia a todos los datos del usuario logado.*/
/*session_start();*/


 
 class redireccion_web { 

    public static $web_login = "./login.php";
    public static $web_inicio_menu = "./";
    public static $web_404 = "./views/inc/404.html";
    public static $web_inicio_programa = "./views/pages/";
    public $url_encode = "";
    public $url_decode = "";
    public $id_user="";
   /* public static  $db_conn = "";*/


/*    public function __construct($name_user, $id_user, $id_menu) {
     
       $this->name_user = $name_user;
       $this->id_user = $id_user;
       $this->id_menu = $id_menu;
    }*/
 
   /*public  static function getUrlDecode($url_encode){
     
    }*/


    public  static function getCerrarSesion(){
     /* session_start();*/
      $_SESSION['id_user']='';
      $_SESSION['lgn_user']='';
      $_SESSION['id_menu']='';
      return self::$web_login;
    }


    public  static function getUrlEncode($url_encode){
      $url_encode = str_replace("-","%",$url_encode);
      $url_encode = str_replace(".php","",$url_encode);

      return $url_encode;
    }


    public  static function getUrlDecode($url_decode){
      $url_decode = str_replace("%","-",$url_decode);
      $url_decode = $url_decode.".php";

      return $url_decode;
    }


   public  static function getExisteFile($filename){
    $bol_path = 1;
    if (file_exists(self::$web_inicio_programa.$filename)) 
    {
        $bol_path = 0;
    }

    return $bol_path;
   }


    public static function getTienePermisoPrograma($url_menu,$id_user){ 
         //self::getDb();
       $db_conn = self::getDb();
 
       $sql="SELECT count(*) tiene_programa FROM dynamic_menu                                                     
       JOIN t_user ON FIND_IN_SET( dynamic_menu.id_menu, t_user.id_menu ) > 0
       where dynamic_menu.url=:url_menu
       and t_user.id_user=:id_user";

       $stmt = $db_conn->db->prepare($sql);
       $stmt->bindValue(':url_menu', $url_menu);
       $stmt->bindValue(':id_user', $id_user);
       $stmt->execute();
       $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
       return $rows[0]['tiene_programa'];
       
    }

    

    public static function getExisteUsuario($name_user){

       $db_conn = self::getDb();
 
       $sql="SELECT count(id_user) existe from t_user where name_user=:name_user";
       $stmt = $db_conn->db->prepare($sql);
       $stmt->bindValue(':name_user', $name_user);
       $stmt->execute();
       $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
       return $rows[0]['existe'];
       
    }



       public static function getTimeOut($id_user){
       
       $baja = "0";
       $db_conn = self::getDb();
       $sql="SELECT timeout from t_user where id_user=:id_user and baja=:baja";

       $stmt = $db_conn->db->prepare($sql);
       $stmt->bindValue(':id_user', $id_user);
       $stmt->bindValue(':baja', $baja );
       $stmt->execute();
       $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
       return $rows[0]['timeout'];
       
    }


   public static function getDb() {
      require_once("class/pdo_db.php");
      $db = new ConectPDO();

    /*  self::$db_conn = $db;*/

      return  $db;
   
   }

   /* public static function getNombreUsuario(){
       return new self('Fernando', 'Gaitan', 26);
       $this->name_user = $name_user;
    }*/
 }

?>