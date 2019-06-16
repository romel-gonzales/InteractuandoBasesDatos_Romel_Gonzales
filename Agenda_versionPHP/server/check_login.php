<?php

	require_once('./conector.php');

  $con = new ConectorBD('localhost','root','admin');
  $respuesta['conexion'] = $con->iniciarConexion('agenda');
  
  	if ($respuesta['conexion']=='OK') {
      	$consulta = $con->consultarDatos(['usuarios'],['id','email', 'clave'], 'WHERE email="'.$_POST['username'].'"');		
      	if ($consulta->num_rows != 0) {
        	$fila = $consulta->fetch_assoc();
        	if (password_verify($_POST['password'], $fila['clave'])) {
				$respuesta['msg'] = 'OK';
       			$respuesta['acceso'] = 'concedido';
          	session_start();
          	$_SESSION['user_id'] = $fila['id'];
        	}else{
		        $respuesta['motivo'] = 'Contraseña incorrecta';
	      	}
    	}else{
      		$respuesta['motivo'] = 'Email incorrecto';
    	}
  	}
  	echo json_encode($respuesta);
  	$con->cerrarConexion();
?>
