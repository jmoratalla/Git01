<?php
/**
 *  DB - A simple database class 
 *
 * @author		Author: Vivek Wicky Aswal. (https://twitter.com/#!/VivekWickyAswal)
 * @git 		https://github.com/indieteq/PHP-MySQL-PDO-Database-Class
 * @version      0.2ab
 *
 */

class DbPDO
{
	# @var, MySQL Hostname
	private $hostname = 'localhost';
	# @var, MySQL Database
	private $database = 'escandallo';
	# @var, MySQL Username
	private $username = 'root';
	# @var, MySQL Password
	private $password = 'T1bur0ne$';
	# @object, The PDO object
	private $pdo;
	# @object, PDO statement object
	private $sQuery;
	# @array,  The database settings
	private $settings;
	# @bool ,  Connected to the database
	private $bConnected = false;
	# @object, Object for logging exceptions	
	private $log;
	# @array, The parameters of the SQL query
	private $parameters;

       /**
	*   Default Constructor 
	*
	*	1. Instantiate Log class.
	*	2. Connect to database.
	*	3. Creates the parameter array.
	*/
	public function __construct()
	{
		$this->Connect();
		$this->parametros = array();
	}

    /**
     *	Este método realiza la conexión a la BD.
     *	
     *	1. Lee las credenciales de la BD desde un archivo .ini. 
     *	2. Coloca el contenido del archivo ini en un arreglo (credenciales).
     *	3. Intenta conectarse a la BD.
     *	4. Si la conexión falla, despliega una excepción y escribe el mensaje de error en el archivo log creado.
     */
    private function Connect()
    {
    	/* Leer credenciales desde el  archivo ini */
    	$this->credenciales = parse_ini_file(".credentials/db.php.ini");
    	$dsn = 'mysql:dbname=' . $this->credenciales["dbnombre"] . ';host=' . $this->credenciales["host"] . '';
    	$pwd = $this->credenciales["clave"];
//        $pwd = "123456";
    	$usr = $this->credenciales["usuario"];
    /**
     *	El array $options es muy importante para tener un PDO bien configurado
     *	
     *	1. PDO::ATTR_PERSISTENT => true: sirve para usar conexiones persistentes
     *      se puede establecer a false si no se quiere usar este tipo de conexión. Ver: https://es.stackoverflow.com/a/50097/29967 
     *	2. PDO::ATTR_EMULATE_PREPARES => false: Se usa para desactivar emulación de consultas preparadas 
     *      forzando el uso real de consultas preparadas. 
     *      Es muy importante establecerlo a false para prevenir Inyección SQL. Ver: https://es.stackoverflow.com/a/53280/29967
     *	3. PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION También muy importante para un correcto manejo de las excepciones. 
     *      Si no se usa bien, cuando hay algún error este se podría escribir en el log revelando datos como la contraseña !!!
     *	4. PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'": establece el juego de caracteres a utf8, 
     *      evitando caracteres extraños en pantalla. Ver: https://es.stackoverflow.com/a/59510/29967
     */
    $options = array(
    	PDO::ATTR_PERSISTENT => true, 
    	PDO::ATTR_EMULATE_PREPARES => false, 
    	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
    	PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
    	);
    try {
				# Intentar la conexión 
    	$this->pdo = new PDO($dsn, $usr, $pwd, $options);

	            # Conexión exitosa, asignar true a la variable booleana isConnected.
    	$this->isConnected = true;
    }
    catch (PDOException $e) {
	            # Escribir posibles excepciones en el error_log
    	error_log($this->error = $e->getMessage(),0);
    }
}
	/*
	 *   You can use this little method if you want to close the PDO connection
	 *
	 */
	public function CloseConnection()
	{
	 		# Set the PDO object to null to close the connection
	 		# http://www.php.net/manual/en/pdo.connections.php
		$this->pdo = null;
	}

       /**
	*	Every method which needs to execute a SQL query uses this method.
	*	
	*	1. If not connected, connect to the database.
	*	2. Prepare Query.
	*	3. Parameterize Query.
	*	4. Execute Query.	
	*	5. On exception : Write Exception into the log + SQL query.
	*	6. Reset the Parameters.
	*/	
	private function Init($query,$parameters = "")
	{
		# Connect to database
		if(!$this->bConnected) { $this->Connect(); }
		try {
				# Prepare query
			$this->sQuery = $this->pdo->prepare($query);

				# Add parameters to the parameter array	
			$this->bindMore($parameters);
				# Bind parameters
			if(!empty($this->parameters)) {
				foreach($this->parameters as $param)
				{
					$parameters = explode("\x7F",$param);
					$this->sQuery->bindParam($parameters[0],$parameters[1]);
				}		
			}
				# Execute SQL 
			$this->success = $this->sQuery->execute();		
		}
		catch(PDOException $e)
		{
					# Write into log and display Exception
			$this->ExceptionLog($e->getMessage(), $query );
		}
			# Reset the parameters
		$this->parameters = array();
	}

       /**
	*	@void 
	*
	*	Add the parameter to the parameter array
	*	@param string $para  
	*	@param string $value 
	*/	
	public function bind($para, $value)
	{	
		$this->parameters[sizeof($this->parameters)] = ":" . $para . "\x7F" . utf8_encode($value);
	}
       /**
	*	@void
	*	
	*	Add more parameters to the parameter array
	*	@param array $parray
	*/	
	public function bindMore($parray)
	{
		if(empty($this->parameters) && is_array($parray)) {
			$columns = array_keys($parray);
			foreach($columns as $i => &$column)	{
				$this->bind($column, $parray[$column]);
			}
		}
	}
       /**
	*   	If the SQL query  contains a SELECT or SHOW statement it returns an array containing all of the result set row
	*	If the SQL statement is a DELETE, INSERT, or UPDATE statement it returns the number of affected rows
	*
	*   	@param  string $query
	*	@param  array  $params
	*	@param  int    $fetchmode
	*	@return mixed
	*/			
	public function execute($query,$params = null, $fetchmode = PDO::FETCH_ASSOC)
	{
		$query = trim($query);
		$this->Init($query,$params);
		$rawStatement = explode(" ", $query);

			# Which SQL statement is used 
		$statement = strtolower($rawStatement[0]);

		if ($statement === 'select' || $statement === 'show') {
			return $this->sQuery->fetchAll($fetchmode);
		}
		elseif ( $statement === 'insert' ||  $statement === 'update' || $statement === 'delete' ) {
			return $this->sQuery->rowCount();	
		}	
		else {
			return NULL;
		}
	}

      /**
       *  Returns the last inserted id.
       *  @return string
       */	
      public function lastInsertId() {
      	return $this->pdo->lastInsertId();
      }	

       /**
	*	Returns an array which represents a column from the result set 
	*
	*	@param  string $query
	*	@param  array  $params
	*	@return array
	*/	
	public function column($query,$params = null)
	{
		$this->Init($query,$params);
		$Columns = $this->sQuery->fetchAll(PDO::FETCH_NUM);		

		$column = null;
		foreach($Columns as $cells) {
			$column[] = $cells[0];
		}
		return $column;

	}	
       /**
	*	Returns an array which represents a row from the result set 
	*
	*	@param  string $query
	*	@param  array  $params
	*   	@param  int    $fetchmode
	*	@return array
	*/	
	public function row($query,$params = null,$fetchmode = PDO::FETCH_ASSOC)
	{				
		$this->Init($query,$params);
		return $this->sQuery->fetch($fetchmode);			
	}
       /**
	*	Returns the value of one single field/column
	*
	*	@param  string $query
	*	@param  array  $params
	*	@return string
	*/	
	public function single($query,$params = null)
	{
		$this->Init($query,$params);
		return $this->sQuery->fetchColumn();
	}
       /**	
	* Writes the log and returns the exception
	*
	* @param  string $message
	* @param  string $sql
	* @return string
	*/
	private function ExceptionLog($message , $sql = "")
	{
		$exception  = 'Unhandled Exception. <br />';
		$exception .= $message;
		$exception .= "<br /> You can find the error back in the log.";
		if(!empty($sql)) {
			# Add the Raw SQL to the Log
			$message .= "\r\nRaw SQL : "  . $sql;
		}
			# Write into log
		
		throw new Exception($message);
		#return $exception;
	}			
}
?>