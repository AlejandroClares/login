<?php
include("vista.php");
include("modelos/usuarios.php");
include("modelos/seguridad.php");

class Controlador {
	
	
	protected $usuarios;
	
	public function __construct(){
        $this->usuarios = new Usuarios();
    }
	
	public function main(){
		
		session_start();
		if (isset($_REQUEST["do"])){
			$do = $_REQUEST["do"];
			if(Seguridad::getId() == null && $do != "validarFormularioLogin" && $do != "insertaUsuario" && $do != "validarInsertaUsuario"){
				$do = "home";
			}
		} else
			$do = "home";
		
		if ($do == "0"){
			$do = "cero";
		} elseif ($do == "1")
			$do = "uno";
		
		$this->$do(); //Ejecuta el metodo con el nombre que contiene la variable en ese momento.
	}
	
	private function mostrarFormularioLogin(){
		Vista::mostrar("login");
	}
	
	private function validarFormularioLogin(){
		$username = $_REQUEST["usuario"];
		$password = $_REQUEST["password"];
		$validar = $this->usuarios->getValidaUsuario($username, $password);
		if($validar){
			if (Seguridad::getTipo() == "0")
				Vista::redireccion("cero");
			else
				Vista::redireccion("uno");
		} else {
			header('Location: index.php');
		}
	}

//---------- ADMINISTRACION DE USUARIOS ----------

	private function cero() {
		$data["listaUsuarios"] = $this->usuarios->getAll();
		Vista::mostrar("user0", $data);
	}
	
	private function uno() {
		$data["datosUsuario"] = $this->usuarios->get(Seguridad::getId());
		Vista::mostrar("user1", $data);			
	}
	
	private function eliminaUsuario() {
		$result = $this->usuarios->deleteUser($_REQUEST["idusuario"]);
		if(Seguridad::getTipo() == 1)
			header('Location: index.php');
		else
			Vista::redireccion("cero");
	}
	
	private function insertaUsuario(){
		$data['tipoUsuario'] = Seguridad::getTipo();
		Vista::mostrar("formularioInsertaUsuario", $data);
	}
	
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
			Vista::redireccion("cero");
			else 
				header('Location: index.php');
	}
	
	private function modificaUsuario(){
		$data['datosUsuario'] = $this->usuarios->get($_REQUEST["idusuario"]);
		$data['tipoUsuario'] = Seguridad::getTipo(); 
		Vista::mostrar("formularioModificar", $data);
	}
	
	private function validaModificaUsuario(){
		$esInsertado = $this->usuarios->updateUser($_REQUEST["idusuario"]);
		if($esInsertado)
			Vista::redireccion(Seguridad::getTipo());
		else
			echo "No se pudo insertar!";

	}
	
	private function salirLogin(){
		Seguridad::cerrarSesion();
		header('Location: index.php');
	}
	

//---------- PAGINA ----------

	private function home(){
		Vista::mostrar("home");
	}

} // clase




