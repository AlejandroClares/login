<?php

	class Usuarios {
		
		private $database;
		
		public function __construct() {
			$this->database = new mysqli("localhost", "root", "", "practicaphp");
		}
		
		public function getValidaUsuario($usuario, $password) {
			$result = $this->database->query("SELECT * FROM usuarios WHERE nick = '$usuario' AND passwd = '$password'");
			if ($result != false && $result->num_rows != 0) {
				$registro = $result->fetch_array();
				Seguridad::abrirSesion($registro["idusuario"], $registro["tipo"]);
				$usuarioValido = true;
			} else {
				$usuarioValido = false;
			}
			return $usuarioValido;
		}
		
		public function getAll(){
			$result = $this->database->query('SELECT * FROM usuarios;');
			$listaUsuarios = array();
			while ($fila = $result->fetch_array()) {
                $listaUsuarios[] = $fila;
            }
			return $listaUsuarios;
		}
		
		public function get($id) {
			$result = $this->database->query('SELECT * FROM usuarios WHERE idusuario ="'.$id.'";');
			$usuario[] = $result->fetch_array();
			return $usuario;
		}
		
		public function deleteUser($id){
			$result = $this->database->query('DELETE FROM usuarios WHERE idusuario ="'.$id.'";');
			return $result;
		}
		
		public function insertUser($tipo) {				
			$result = $this->database->query('INSERT INTO usuarios VALUES (
			" 0 ",
			"' . $_REQUEST["nombre"] . '",
			"' . $_REQUEST["apellidos"] . '",
			"' . $_REQUEST["email"] . '",
			"' . $_REQUEST["nick"] . '",
			"' . $_REQUEST["passwd"] . '",
			"' . $tipo . '"
			);');
			return $result;
		}
		
		public function updateUser($idusuario){
			$result = $this->database->query('UPDATE usuarios SET 
			nombre="'.$_REQUEST["nombre"].'",
			apellidos="'.$_REQUEST["apellidos"].'",
			email="'.$_REQUEST["email"].'",
			nick="'.$_REQUEST["nick"].'",
			passwd="'.$_REQUEST["passwd"].'",
			tipo="'.$_REQUEST["tipo"].'"
			WHERE idusuario="'.$idusuario.'"
			;');
			
			if($result)
				$modifica = true;
			else 
				$modifica = false;
			
			return $modifica;
		}
		
	} //Clase