<?php
  
  session_start();
  require_once('conector.php');

	$con = new ConectorBD('localhost','root','admin');
	$respuesta['msg'] = $con->iniciarConexion('agenda');

  	if ($respuesta['msg']=='OK') {
      $consulta = $con->consultarDatos(['eventos'], ['eventos.*'], 'INNER JOIN usuarios ON usuarios.id=eventos.user_id AND usuarios.id='.$_SESSION['user_id']);

      if ($consulta->num_rows <= 0) {
      	$respuesta['eventos'] = [];
    	}else{
	  		$eventos = array();
	  		while ($fila = $consulta->fetch_assoc()) {
			
			$evento = array();
			if($fila['dia_completo'] == 1){
				$evento['id'] = $fila['id'];
				$evento['user_id'] = $fila['user_id'];
				$evento['title'] = $fila['titulo'];
				$evento['start'] = $fila['fecha_inicio'];
				$evento['allday'] = true;				
			}
			else		
			{
			    $evento['id'] = $fila['id'];
				$evento['user_id'] = $fila['user_id'];
				$evento['title'] = $fila['titulo'];
				$evento['start'] = $fila['fecha_inicio'].' '.$fila['hora_inicio'];
				$evento['end'] = $fila['fecha_fin'].' '.$fila['hora_fin'];
				$evento['allday'] = false;						
			}	

	      	array_push($eventos, $evento);	  				
			}
	  		$respuesta['eventos'] = $eventos;
    	}
    }else{
      $respuesta['estado'] = "Error PHP-004 en la comunicación con el servidor";
    }

  $con->cerrarConexion();
	echo json_encode($respuesta);
?>