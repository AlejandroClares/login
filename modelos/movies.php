<?php
include("abstraccion.php");
include("config.php");
	class Movies {

        private $db;

        public function __construct() {
            $this->db = new Abstraccion(Config::$dbHost, Config::$dbUser, Config::$dbPass, Config::$dbName);
        }

        public function getAll(){
			$result = $this->db->sqlConsulta('SELECT * FROM movies;');
			return $result;
		}

		public function get($id){
			$result = $this->db->sqlConsulta('SELECT * FROM movies WHERE id ="'.$id.'";');
			return $result;
		}

		public function insertMovie(){
			$result = $this->db->sqlOtros('INSERT INTO movies VALUES (
				" 0 ",
				"' . $_REQUEST["titulo"] . '",
				' . $_REQUEST["anyo"] . ',
				' . $_REQUEST["duracion"] . ',
				' . $_REQUEST["valoracion"] . ',
				"' . $_REQUEST["rutaPortada"] . '",
				"' . $_REQUEST["rutaArchivo"] . '",
				"' . $_REQUEST["nombreArchivo"] . '",
				"' . $_REQUEST["urlExterna"] . '"
				);');
	
				if ($result == 1) {
					return true;
				} else {
					return false;
				}
		}

		public function deleteMovie($id){
			$result = $this->db->sqlOtros('DELETE FROM movies WHERE id ="'.$id.'";');
			if($result == 1)
				return true;
			else
				return false;
		}

		public function updateMovie($id){
			$result = $this->db->sqlOtros('UPDATE movies SET 
			title="'.$_REQUEST["title"].'",
			year="'.$_REQUEST["year"].'",
			duration="'.$_REQUEST["duration"].'",
			rating="'.$_REQUEST["rating"].'",
			cover="'.$_REQUEST["cover"].'",
			filepath="'.$_REQUEST["filepath"].'",
			filename="'.$_REQUEST["filename"].'",
			external_url="'.$_REQUEST["external_url"].'"
			WHERE id="'.$id.'"
			;');
			return $result;
		}

    } // class