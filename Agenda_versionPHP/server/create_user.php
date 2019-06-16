<?php

  	require_once('conector.php');

  	$datos1 = array(
      'nombre' => 'romel',
      'email' => 'romel@romel.com',
      'clave' => password_hash("romel", PASSWORD_DEFAULT),
      'nacimiento' => '1977-11-11');
	  
  	$datos2 = array(
      'nombre' => 'glenda',
      'email' => 'glenda@glenda.com',
      'clave' => password_hash("glenda", PASSWORD_DEFAULT),
      'nacimiento' => '1977-11-11');

  	$datos3 = array(
      'nombre' => 'lilieth',
      'email' => 'lilieth@lilieth.com',
      'clave' => password_hash("lilieth", PASSWORD_DEFAULT),
      'nacimiento' => '1977-11-11');	  
	  
	  
    $con = new ConectorBD('localhost','root','admin');
  	$respuesta = $con->iniciarConexion('agenda');

  	if ($respuesta == 'OK') {
		
		
    	if($con->insertarRegistro('usuarios', $datos1)){
      		$respuesta = "   ******exito en la inserción******  ";
			echo $respuesta;
	    }else {
	      	$respuesta = "Hubo un error y los datos no han sido cargados";
	    }
		
    	if($con->insertarRegistro('usuarios', $datos2)){
      		$respuesta = "   ******exito en la inserción******  ";
			echo $respuesta;
	    }else {
	      	$respuesta = "Hubo un error y los datos no han sido cargados";
	    }
		
    	if($con->insertarRegistro('usuarios', $datos3)){
      		$respuesta = "   ******exito en la inserción******  ";
			echo $respuesta;
	    }else {
	      	$respuesta = "Hubo un error y los datos no han sido cargados";
	    }		
		
		
  	}else {
    	$respuesta = "No se pudo conectar a la base de datos";
  	}
    $con->cerrarConexion();
?>
