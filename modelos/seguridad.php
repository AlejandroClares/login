<?php
	class Seguridad {
		
		public static function abrirSesion($id, $tipo) {
			$_SESSION["id"] = $id;
			$_SESSION["tipo"] = $tipo;
		}
		
		public static function cerrarSesion() {
			session_unset();
		}
		
		public static function getId() {
			if (isset($_SESSION["id"]))
				return $_SESSION["id"];
			else
				return null;
		}
		
		public static function getTipo() {
			if (isset($_SESSION["tipo"]))
				return $_SESSION["tipo"];
			else
				return null;
		}		
	}