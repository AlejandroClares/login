<?php
include("modelos/seguridad.php");
include("vista.php");
include("modelos/usuarios.php");


class userControlador {
	
	
	protected $usuarios;
	
	public function __construct(){
        $this->usuarios = new Usuarios();
    }
	
	/**
	* Selecciona el metodo que va a mostrar. Este metodo siempre es ejecutado
	*/
	public function main(){
		
		session_start();
		if (isset($_REQUEST["do"])){
			$do = $_REQUEST["do"];
			if(Seguridad::getId() == null && $do != "validarFormularioLogin" && $do != "insertaUsuario" && $do != "validarInsertaUsuario"){
				$do = "mostrarFormularioLogin";
			}
		} else
			$do = "mostrarFormularioLogin";
		$this->$do(); //Ejecuta el metodo con el nombre que contiene la variable en ese momento
	}
	
	/**
	* Muestra el formulario de login
	*/
	private function mostrarFormularioLogin(){
		Vista::mostrar("login");
	}
	
	/**
	* Procesa el formulario login
	*/
	private function validarFormularioLogin(){
		$username = $_REQUEST["usuario"];
		$password = $_REQUEST["password"];
		$validar = $this->usuarios->getValidaUsuario($username, $password);
		if($validar){
			if (Seguridad::getTipo() == "0")
//				Vista::redireccion("usuarios");
				Vista::redireccion("seleccionTabla", "userControlador");
			else
//				Vista::redireccion("usuarios");
				Vista::redireccion("seleccionTabla", "userControlador");
		} else {
			header('Location: index.php');
		}
	}

	/**
	* Muestra la vista de seleccion de tablas
	*/
	private function seleccionTabla(){
		Vista::mostrar("seleccionaTablas");
	}

//---------- ADMINISTRACION DE USUARIOS ----------

	/**
	* Selecciona y muestra la vista del usuario según los permisos que tenga
	*/
	private function usuarios(){

		$data["tipoUsuario"] = Seguridad::getTipo();

		if(Seguridad::getTipo() == 0){
			$data["datosUsuarios"] = $this->usuarios->getAll();
			Vista::mostrar("usuario", $data);
		} else if(Seguridad::getTipo() == 1){
			$data["datosUsuarios"] = $this->usuarios->get(Seguridad::getId());
			Vista::mostrar("usuario", $data);
		} 
	}
	
	/**
	* Elimina el usuario
	*/
	private function eliminaUsuario() {
		$result = $this->usuarios->deleteUser($_REQUEST["idusuario"]);
		if(Seguridad::getTipo() == 1)
			header('Location: index.php');
		else
			Vista::redireccion("usuarios", "userControlador");
	}
	
	/**
	* Muestra la vista para insertar un usuario
	*/
	private function insertaUsuario(){
		$data['tipoUsuario'] = Seguridad::getTipo();
		Vista::mostrar("formularioInsertaUsuario", $data);
	}
	
	/**
	* Procesa el formilario para insertar un usuario
	*/
	private function validarInsertaUsuario(){
		//Comprueba que la variable tipo exista, sino pondra 1 por defecto
		if(isset($_REQUEST["tipo"]))
			$tipo = $_REQUEST["tipo"];
		else 
			$tipo = 1;

		$result = $this->usuarios->insertUser($tipo); //Devuelve 1 si inserta user
		if (!$result) {
			echo "Fallo al ejecutar la consulta: (" . $db->errno . ") " . $db->error;
		} elseif (Seguridad::getTipo() == "0")
			Vista::redireccion("usuarios", "userControlador");
			else 
				header('Location: index.php');
	}
	
	/**
	* Muestra la vista para modificar un usuario.
	*/
	private function modificaUsuario(){
		$data['datosUsuario'] = $this->usuarios->get($_REQUEST["idusuario"]);
		$data['tipoUsuario'] = Seguridad::getTipo(); 
		Vista::mostrar("formularioModificar", $data);
	}
	
	/**
	* Procesa el formulario de modificar un usuario.
	*/
	private function validaModificaUsuario(){
		$esInsertado = $this->usuarios->updateUser($_REQUEST["idusuario"]);
		if($esInsertado)
			Vista::redireccion("usuarios", "userControlador");
		else
			echo "Hubo un error.";

	}
	
	/**
	* Cierra las variables de sesion
	*/
	private function salirLogin(){
		Seguridad::cerrarSesion();
		header('Location: index.php');
	}
	

//---------- PAGINA ----------

	/**
	* Muestra la página principal (En construccion)
	*/
	private function home(){
		Vista::mostrar("home");
	}

} // clase




