<?php 
/*
 Validación del login del usuario.
*/

require_once("class/class_redireccion_web.php");
session_start();
$_SESSION['name_user'] = trim($_POST['lgn_user']);


if ( isset ( $_POST['lgn_user'] ) && $_POST['lgn_user']!="" ){  //Para que no accedan directamente desde esta página

	 require_once("class/pdo_db.php");
	 $db_conn = new ConectPDO();
	 if( $db_conn->getStatus()){ // En e caso de error en la conexion nos tirara a la página principal.
	 	$_SESSION['ERROR']="bbdd";
	header('Location: '.redireccion_web::$web_login);
	    die();
	}else{
		validar_usuario_login($_POST,$db_conn);
	}
}else{
	session_destroy();
	header('Location: '.redireccion_web::$web_login);
	die();
}





function validar_usuario_login($_P,$db_conn){

	$pass_user = trim($_P['lgn_password']);
	$name_user = $_P['lgn_user'];

	$sql="SELECT id_user,name_user, id_menu from t_user where name_user=UPPER(:name_user) and pass_user=:pass_user";
	$stmt = $db_conn->db->prepare($sql);
	$stmt->bindValue(':name_user', $name_user);
	$stmt->bindValue(':pass_user', $pass_user);
	$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

	if(!$rows){ // Error en el login del usuario.
		$_SESSION['ERROR']="login";
		if($pass_user==""){
			$_SESSION['ERROR']="";
		}
		header('Location: '.redireccion_web::$web_login);
		die();
	}

	// Guardamos en nuestra vaiable sessión todos los datos del usuario.
	foreach( $rows as $variable ){
		foreach ($variable as $key => $value) {
			$_SESSION[$key]=$value;
		}
		
	}

   header('Location: '.redireccion_web::$web_inicio_menu);
}

?>