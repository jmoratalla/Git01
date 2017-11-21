<?php 


die();
session_start();
if( $_POST['accion'] == 'check_session' && isset($_SESSION['id_user']) ){
	//require_once("class/class_redireccion_web.php");
	check_session();
}else{
	echo '1'; // sesión expira
	die();
}







function check_session(){
		 // sesión expira
	   	 
		$sesion['expira']=1; // variable nunca expira, futura implementación
		//$sesion['url']=redireccion_web::$web_login;
		//$sesion['timeout']=redireccion_web::getTimeOut($_SESSION['id_user']);
		// boorar todo y solo dejar nombre user
		/*$_SESSION['lgn_user']='';
		$_SESSION['id_menu']='';
		*/
		echo json_encode($sesion);
}



 ?>

