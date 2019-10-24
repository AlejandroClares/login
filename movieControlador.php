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

		private function insertMovie(){
			Vista::mostrar("formularioInsertaMovie");
		}

		private function processInsertMovie(){
			$result = $this->dbMovies->insertMovie();
			if($result){
				Vista::redireccion("movie", "movieControlador");
			} else {
				$data["informacion"] = "No se a podido guardar. Asegurese que los datos introducidos son correctos.";
				Vista::mostrar("formularioInsertaMovie", $data);
			}
		}

		private function deleteMovie(){
			$id = $_REQUEST["id"];
			$data["datosPelicula"] = $this->dbMovies->get($id);
			if(isset($data["datosPelicula"][0]->id)){
				Vista::mostrar("formularioEliminaMovie", $data);
			} else {
				Vista::redireccion("movie", "movieControlador");
			}
		}

		private function processDeleteMovie(){
			$result = $this->dbMovies->deleteMovie($_REQUEST["id"]);
			if($result){
				Vista::redireccion("movie", "movieControlador");
			} else
				echo "false";
		}

		private function updateMovie(){
			$id = $_REQUEST["id"];

			// Esta variable existiria en caso de ser recargada por un error al actualizar la pelicula
			if(isset($_REQUEST["informacion"])){
				$data["informacion"] = $_REQUEST["informacion"];
			}
			$data["datosPelicula"] = $this->dbMovies->get($id);
			Vista::mostrar("formularioModificaMovie", $data);
		}

		private function processUptadeMovie(){
			$result = $this->dbMovies->updateMovie($_REQUEST["id"]);
			if($result){
				Vista::redireccion("movie", "movieControlador");
			} else {
				$data["informacion"] = "No se a podido actualizar la información.";
				$data["id"] = $_REQUEST["id"];
				Vista::redireccion("updateMovie", "movieControlador", $data);
			}
		}
	}