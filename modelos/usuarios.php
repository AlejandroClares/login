<?php
include("abstraccion.php");
include("config.php");
	class Usuarios {
		
		private $database;
		
		public function __construct() {
			$this->database = new Abstraccion(Config::$dbHost, Config::$dbUser, Config::$dbPass, Config::$dbName);
		}
		
		public function getValidaUsuario($usuario, $password) {
			$result = $this->database->sqlConsulta("SELECT * FROM usuarios WHERE nick = '$usuario' AND passwd = '$password'");
			$result = $result[0];
			if (isset($result)) {
				Seguridad::abrirSesion($result->idusuario, $result->tipo);
				$usuarioValido = true;
			} else {
				$usuarioValido = false;
			}
			return $usuarioValido;
		}
		
		public function getAll(){
			$result = $this->database->sqlConsulta('SELECT * FROM usuarios;');
			return $result;
		}
		
		public function get($id) {
			$result = $this->database->sqlConsulta('SELECT * FROM usuarios WHERE idusuario ="'.$id.'";');
			return $result;
		}
		
		public function deleteUser($id){
			$result = $this->database->sqlOtros('DELETE FROM usuarios WHERE idusuario ="'.$id.'";');
			if($result == 1)
				return true;
			else
				return false;
		}
		
		public function insertUser($tipo) {				
			$result = $this->database->sqlOtros('INSERT INTO usuarios VALUES (
			" 0 ",
			"' . $_REQUEST["nombre"] . '",
			"' . $_REQUEST["apellidos"] . '",
			"' . $_REQUEST["email"] . '",
			"' . $_REQUEST["nick"] . '",
			"' . $_REQUEST["passwd"] . '",
			"' . $tipo . '"
			);');

            if ($result == 1) {
                return true;
            } else {
                return false;
            }
		}
		
		public function updateUser($idusuario){
			$result = $this->database->sqlOtros('UPDATE usuarios SET 
			nombre="'.$_REQUEST["nombre"].'",
			apellidos="'.$_REQUEST["apellidos"].'",
			email="'.$_REQUEST["email"].'",
			nick="'.$_REQUEST["nick"].'",
			passwd="'.$_REQUEST["passwd"].'",
			tipo="'.$_REQUEST["tipo"].'"
			WHERE idusuario="'.$idusuario.'"
			;');

			return $result;
		}
		
	} //Clase