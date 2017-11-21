<?php 
session_start();
require_once("class/class_redireccion_web.php");

if(!isset($_SESSION['id_user']) && $_SESSION['id_user']==""){
	echo '1'; // sesión expira
	die();
}

if( $_POST['accion'] == 'check_session' ){
	check_session($_POST);
}else if ($_POST['accion'] == 'cerrar_sesion' ) {
	cerrar_sesion($_POST);
}else{
	echo '1'; // sesión expira
	die();
}





// Cierre de sesión
function cerrar_sesion($_P){
	$sesion['url']=redireccion_web::getCerrarSesion();
	$sesion['timeout']="";
	$sesion['expira']="1";
	echo json_encode($sesion);
}



// sesión expira
function check_session($_P){

 // variable nunca expira, futura implementación
	$idleTime = $_P['idleTime'];

	$timeout=redireccion_web::getTimeOut($_SESSION['id_user']);
	$sesion['timeout']=$timeout;
 // boorar todo y solo dejar nombre user
	
	if( $idleTime >= $timeout && $timeout!=0 )
	{
		$sesion['expira']=1;
		$sesion['url']=redireccion_web::getCerrarSesion();
	}else{
		$sesion['expira']=0;
	}
	

	echo json_encode($sesion);
}



 ?>

