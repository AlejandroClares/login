<?php
include("view.php");
include("models/seguridad.php");
include("models/movies.php");

	class movieController {

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
				View::show("user/login", $data);
			}
		}

		private function movie(){
			$data["datosMovies"] = $this->dbMovies->getAll();
			View::show("movie/movieAdmin", $data);
		}

		private function insertMovie(){
			View::show("movie/insertForm");
		}

		private function processInsertMovie(){
			$result = $this->dbMovies->insertMovie();
			if($result){
				View::redireccion("movie", "movieController");
			} else {
				$data["informacion"] = "No se a podido guardar. Asegurese que los datos introducidos son correctos.";
				View::show("movie/insertForm", $data);
			}
		}

		private function deleteMovie(){
			$id = $_REQUEST["id"];
			$data["datosPelicula"] = $this->dbMovies->get($id);
			if(isset($data["datosPelicula"][0]->id)){
				View::show("movie/deleteForm", $data);
			} else {
				View::redireccion("movie", "movieController");
			}
		}

		private function processDeleteMovie(){
			$result = $this->dbMovies->deleteMovie($_REQUEST["id"]);
			if($result){
				View::redireccion("movie", "movieController");
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
			View::show("movie/updateForm", $data);
		}

		private function processUptadeMovie(){
			$result = $this->dbMovies->updateMovie($_REQUEST["id"]);
			if($result){
				View::redireccion("movie", "movieController");
			} else {
				$data["informacion"] = "No se a podido actualizar la información.";
				$data["id"] = $_REQUEST["id"];
				View::redireccion("updateMovie", "movieController", $data);
			}
		}
	}