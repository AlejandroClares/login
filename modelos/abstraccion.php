<?php

class Abstraccion {
	
	private $db;
	
	public function __construct(){
		$this->db = new mysqli("localhost", "root", "", "practicaphp");
	}
	
	public function cierraConexion(){
		if(isset($db))
			$this->db->close();
	}
	
	public function consulta($consulta){
		$resultado = $this->db->query($consulta);
		$data = array();
		if($resultado)
			$data = $resultado->fetch_all();
		return $data;
	}
}