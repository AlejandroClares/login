<?php
include("vista.php");
include("modelos/seguridad.php");
include("modelos/movies.php");

	class movieControlador {

		private $dbMovies;

		public function __construct(){
			$this->dbMovies = new Movies();
		}

		public function main(){

			// Comprueba si existe la variable
			if(isset($_REQUEST["do"])) {
				$do = $_REQUEST["do"];
			} else { // Si no hay variable de sesion, muestra el login
				$do = "movie";	
			}

			// El usuario normal vuelve al login y muestra el mensaje
			if(Seguridad::getTipo() == 0) { 
				$this->$do(); // Ejecuta el método.
			} else {
				$data["informacion"] = "Debes ser administrador.";
				Vista::mostrar("login", $data);
			}
		}

		private function movie(){
			$data["datosMovies"] = $this->dbMovies->getAll();
			Vista::mostrar("movie", $data);
		}

	}