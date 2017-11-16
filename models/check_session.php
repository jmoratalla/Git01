<?php 
session_start();

if( $_POST['accion'] == 'check_session' && isset($_SESSION['id_user']) ){
	check_session();
}else{
	echo '1'; // sesión expira
	die();
}







function check_session(){
	require_once("../class/class_redireccion_web.php");

		 // sesión expira
		$sesion['expira']=1; // variable nunca expira, futura implementación
		$sesion['url']=redireccion_web::$web_login;
		$_SESSION['lgn_user']='';
		echo json_encode($sesion);
}



 ?>

