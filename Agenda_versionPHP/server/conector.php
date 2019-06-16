<?php

  class ConectorBD{
    private $host;
    private $user;
    private $password;
    private $conexion;

    function __construct($host, $user, $password){
      $this->host = $host;
      $this->user = $user;
      $this->password = $password;
    }


    function iniciarConexion($nombre_db){
	
      $this->conexion = new mysqli($this->host, $this->user, $this->password, $nombre_db);
      if ($this->conexion->connect_error) {
        return "PHP Error:".$this->conexion->connect_error;
      }else {
        return "OK";
      }
    }
	
    function ejecutarQuery($query){
      return $this->conexion->query($query);
    }	

    function consultarDatos($tablas, $campos, $condicion = ""){	
      $sql = "SELECT ";
	  
	  $tmp1 = array_keys($campos);
	  
      $ultima_key = end($tmp1);
      foreach ($campos as $key => $value) {
        $sql .= $value;
        if ($key!=$ultima_key) {
          $sql.=", ";
        }else $sql .=" FROM ";
      }
  
	  $tmp2 = array_keys($tablas);	  
      $ultima_key = end($tmp2);
      foreach ($tablas as $key => $value) {
        $sql .= $value;
        if ($key!=$ultima_key) {
          $sql.=", ";
        }else $sql .= " ";
      }

      if ($condicion == "") {
        $sql .= ";";
      }else {
        $sql .= $condicion.";";
      }
      return $this->ejecutarQuery($sql);
    }


    function insertarRegistro($tabla, $datos){
      $sqlInsert = 'INSERT INTO '.$tabla;

      $sqlCampo = ' (';
      $sqlValor = ') VALUES (';
      $contador = 1;
      foreach ($datos as $indice => $value) {
        $sqlCampo .= $indice;
        $sqlValor .= '"'.$value.'"';
        if ($contador!=count($datos)) {
          $sqlCampo .= ', ';
          $sqlValor .= ', ';
        }else{
         $sqlValor .=');';
        }
        $contador += 1;
      }
      $sqlInsert .= $sqlCampo.$sqlValor;
	  //return $sqlInsert; 
      return $this->conexion->query($sqlInsert);
    }


    function eliminarRegistro($tabla, $condicion){
      $sqlDelete = 'DELETE FROM '.$tabla.' WHERE '.$condicion.';';
      return $this->conexion->query($sqlDelete);
    }


    function actualizarRegistro($tabla, $datos, $condicion){
      $sqlUpdate = 'UPDATE '.$tabla.' SET ';

      $sqlCampo = '';
      $contador = 1;
      foreach ($datos as $indice => $value) {
        $sqlCampo .= $indice.'="'.$value.'"';
        if ($contador<count($datos)) {
          $sqlCampo .= ', ';
        }else{
          $sqlCampo .=' WHERE ';
        }
        $contador += 1;
      }
      $sqlUpdate .= $sqlCampo.$condicion.';';
      return $this->conexion->query($sqlUpdate);
    }


    function cerrarConexion(){
      $this->conexion->close();
    }
  }
 ?>
