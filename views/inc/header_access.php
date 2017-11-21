<?php 
/**
 * Inicializa las clases requeridas y comprueba inicio de sesión.
 */

//------------------------------------
error_reporting(E_ALL);
ini_set('display_errors', '1');
//------------------------------------


  session_start(); 
  require_once("class/class_redireccion_web.php");
  if( !isset($_SESSION['id_user']) && empty($_SESSION['id_user'])) {
    session_destroy();
    header('Location: '.redireccion_web::$web_login);
    die();
  }




    require_once("class/pdo_db.php");
    $db_conn = new ConectPDO();


  // En el menú, si el usuario tilda un programa, este nos vendrá por el get
     $muestro_programa = "";
     if( count ($_GET) ){ // Si tenemos programa
      $ur_encode = key($_GET);
      $ur_Decode =  redireccion_web::getUrlDecode($ur_encode);
      $tienePermisoPrograma = redireccion_web::getTienePermisoPrograma($ur_Decode,$_SESSION['id_user']);
      $exite_file = redireccion_web::getExisteFile($ur_Decode);  

      if( !$tienePermisoPrograma || $exite_file ){
         $muestro_programa=redireccion_web::$web_404;
      /* include(redireccion_web::$web_404);*/
      }else{ // Mostramos el programa seleccionado.
        /*include(redireccion_web::$web_inicio_programa.$ur_Decode);*/
        $muestro_programa=redireccion_web::$web_inicio_programa.$ur_Decode;
      }
     
    }else{
      $muestro_programa="home";
   
    }




 ?>
