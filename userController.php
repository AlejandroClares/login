<?php
include("models/seguridad.php");
include("view.php");
include("models/usuarios.php");


class userController {
	
	
	protected $usuarios;
	
	public function __construct(){
        $this->usuarios = new Usuarios();
    }
	
	/**
	* Selecciona el metodo que va a mostrar. Este metodo siempre es ejecutado
	*/
	public function main(){
		
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
		View::show("user/login");
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
//				View::redireccion("usuarios");
				View::redireccion("seleccionTabla", "userController");
			else
//				View::redireccion("usuarios");
				View::redireccion("seleccionTabla", "userController");
		} else {
			$data["informacion"] = "Nombre de usuario o contraseña incorrecta.";
			View::show("user/login", $data);
		}
	}

	/**
	* Muestra la vista de seleccion de tablas
	*/
	private function seleccionTabla(){
		View::show("user/seleccionaTablas");
	}

//---------- ADMINISTRACION DE USUARIOS ----------

	/**
	* Selecciona y muestra la vista del usuario según los permisos que tenga
	*/
	private function usuarios(){

		$data["tipoUsuario"] = Seguridad::getTipo();

		if(Seguridad::getTipo() == 0){
			$data["datosUsuarios"] = $this->usuarios->getAll();
			View::show("user/userAdmin", $data);
		} else if(Seguridad::getTipo() == 1){
			$data["datosUsuarios"] = $this->usuarios->get(Seguridad::getId());
			View::show("user/userAdmin", $data);
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
			View::redireccion("usuarios", "userController");
	}
	
	/**
	* Muestra la vista para insertar un usuario
	*/
	private function insertaUsuario(){
		$data['tipoUsuario'] = Seguridad::getTipo();
		View::show("user/insertForm", $data);
	}
	
	/**
	* Procesa el formulario para insertar un usuario
	*/
	private function validarInsertaUsuario(){
		//Comprueba que la variable tipo exista, sino pondra 1 por defecto
		if(isset($_REQUEST["tipo"]))
			$tipo = $_REQUEST["tipo"];
		else 
			$tipo = 1;

		
		
		// Subida del fichero
		$dir_image = "C:/xampp/htdocs/php/login/assets/image/user/";

		// Obtengo la extension del fichero
		$filepath = pathinfo($_FILES['foto_usuario']['name']);
		$extension = "." . $filepath["extension"];
		$image_upload = $dir_image . $_REQUEST["email"] . $extension;
		
		if (move_uploaded_file($_FILES['foto_usuario']['tmp_name'], $image_upload)) {
			$result = $this->usuarios->insertUser($tipo); //Devuelve 1 si inserta user
			echo "Resultado: " . $result;
			if ($result) {
				 if (Seguridad::getTipo() == "0"){
					View::redireccion("usuarios", "userController");
				 } else {
					header('Location: index.php');
				 }
			} else {
				echo "Hubo un error al insertar el usuario"	;
				unlink($image_upload);
				
			}
		} else {
			echo "Fallo al subir el archivo";
		}

	}
	
	/**
	* Muestra la vista para modificar un usuario.
	*/
	private function modificaUsuario(){
		$data['datosUsuario'] = $this->usuarios->get($_REQUEST["idusuario"]);
		$data['tipoUsuario'] = Seguridad::getTipo(); 
		View::show("user/updateForm", $data);
	}
	
	/**
	* Procesa el formulario de modificar un usuario.
	*/
	private function validaModificaUsuario(){
		$esInsertado = $this->usuarios->updateUser($_REQUEST["idusuario"]);
		if($esInsertado)
			View::redireccion("usuarios", "userController");
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
		View::show("home");
	}

} // clase




