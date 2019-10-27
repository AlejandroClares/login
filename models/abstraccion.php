<?php

class Abstraccion {
	
	private $db;
	
	public function __construct($dbHost, $dbUser, $dbPass, $dbName){
		$this->db = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
	}
	
	public function cierraConexion(){
		if(isset($db))
			$this->db->close();
	}
	
	public function sqlConsulta($consulta){
		$resultado = $this->db->query($consulta);
        $data = array();
        while ($row = $resultado->fetch_object()) {
            $data[] = $row;
        }
		return $data;
	}

    public function sqlOtros($consulta) {
        $this->db->query($consulta);
        return $this->db->affected_rows;
    }
}