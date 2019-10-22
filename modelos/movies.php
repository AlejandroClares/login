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

    }