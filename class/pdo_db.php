<?php
// Simple PDO class for connecting to MySQL DB
class ConectPDO {
   const db = false;
   // Here you can set some defaults if no arguments are supplied when calling the class
   private $DBHOST = 'localhost';
   private $DBUSER = 'root';
   private $DBPASS = 'T1bur0ne$';
   private $DBNAME = 'escandallo';
   private $OPTIONS = array(
      PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'',
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
   );

   public function __construct($dbhost = null, $dbname = null, $dbuser = null, $dbpass = null, $options = null) {
   // Any options passed as arguments here should be in array format as above
   // If you wanted to set attributes after being connected, use the setPDOAttrib function
      if (self::db === false) {
         $dsn = "mysql:host=" . (isset($dbhost) ? $dbhost : $this->DBHOST) . ";dbname=" . (isset($dbname) ? $dbname : $this->DBNAME);
         try {
            $this->db = new PDO($dsn, (isset($dbuser) ? $dbuser : $this->DBUSER), (isset($dbpass) ? $dbpass : $this->DBPASS), (isset($options) ? $options : $this->OPTIONS));
         } catch (PDOException $e) {
            print $e->getMessage();
            $this->db = true; // pues por mi
         }
      }
   }

   public function setPDOAttrib(){
   // Can handle multiple arguments but the parameters passed here should be
   // sent as one big string wrapped in quotes and separated by commas as below
   // "PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION", "PDO::blah, PDO::blarg"
      foreach(func_get_args() as $arg) {
         if (($this->getStatus() == "1") && (!is_null($arg))) {
            try {
               $this->db->setAttribute($arg);
            } catch (PDOException $e) {
               print $e->getMessage();
            }
         }
      }
   }
   
   public function getStatus() {
      if ($this->db === true) {
         return 1;
      } else {
         return 0;
      }
   }
   
   public function close() {
      if ($this->getStatus() == "1") {
         $this->db = null;
      }
   }
} 

?>