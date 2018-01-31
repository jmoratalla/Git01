<?php

require_once("class_controllerBase_escandallos.php");



class Controller_escadallos extends ControllerBase_escadallos {

 
    public function __construct() {
    	parent::__construct(); 
    }



    public function set_newEscanallo($array_escadallo){
         
        //Creamos el objeto usuario
        $obj_ingredientes = new Ingredientes();
        $obj_escandallos = new Escandallos();
        $obj_escandallos_user = new Escandallos_user();

         $data = json_decode($array_escadallo['data']);
         $num_row = $array_escadallo['num_row'];
         $escandallo_nombre = $array_escadallo['escandallo_nombre'];
         $escandallo_id = $array_escadallo['escandallo_id'];

         $accion="No funciona";

         if( $escandallo_id == "" )
         {
         	// Si es nuevo escandallo
         	$obj_escandallos->setEscandallo_nombre($escandallo_nombre);
         	$last_id_escandallo = $obj_escandallos->saveEscandallo();
         	$accion =  "Guardado";
         }
         else if( $escandallo_id >= 0)
         {
         	// No escandallo nuevo

         	$accion = "No Guardado";
         }

         var_dump($accion);

    	//return "Correcto.:";
    }


 }



?>