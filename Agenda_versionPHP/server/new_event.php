<?php
	
	session_start();
    require_once('conector.php');
  
    $datos = array();
	
	if($_POST['allDay'] == 'true')
	{
      $datos['user_id'] = $_SESSION['user_id'];
  	  $datos['titulo'] = $_POST['titulo'];
  	  $datos['fecha_inicio'] = $_POST['start_date'];
      $datos['dia_completo'] = 1;
	}
	else
	{
	  $datos['user_id'] = $_SESSION['user_id'];
  	  $datos['titulo'] = $_POST['titulo'];
  	  $datos['fecha_inicio'] = $_POST['start_date'];
      $datos['hora_inicio'] = $_POST['start_hour'];
      $datos['fecha_fin'] = $_POST['end_date'];
      $datos['hora_fin'] = $_POST['end_hour'];
      $datos['dia_completo'] = 0;
		
	}	
  
    $con = new ConectorBD('localhost','root','admin');
	  $respuesta['msg'] = $con->iniciarConexion('agenda');

  	if ($respuesta['msg'] == 'OK') {
		
	//	$respuesta['estado'] = $con->insertarRegistro('eventos', $datos);
	
    	if($con->insertarRegistro('eventos', $datos)){
        $respuesta['estado'] = "El evento se ha agregado exitosamente";
	    }else {
	      $respuesta['estado'] = "Hubo un error y los datos no han sido cargados";
	    }				
  	}else {
      $respuesta['estado'] = "Error PHP-001 en la comunicación con el servidor";
    }


    $con->cerrarConexion();
  	echo json_encode($respuesta);
?>
