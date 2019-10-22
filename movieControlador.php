<?php
include("vista.php");

	class movieControlador {

		private $dbMovies;

		public function __construct(){
			// Aqui se debe iniciar dbMovies
		}

		public function main(){

			// Inicia las variables de sesion.
			session_start();
			// Comprueba si existe la variable
			if(isset($_REQUESTA["do"])) {
				$do = $_REQUESTA["do"];
				
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
			echo "Hola mundo";
			echo "Haz clic <a href='index.php?direccion=users'>aquí</a> para saltar al controlador de usuarios";
		}

		private function prueba(){
			echo "Test";
		}



	}