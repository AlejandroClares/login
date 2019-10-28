<?php
include("models/seguridad.php");
include("view.php");
include("models/users.php");


class userController {
	
	
	protected $users;
	
	public function __construct(){
        $this->users = new Users();
    }
	
	/**
	* Selecciona el metodo que va a mostrar. Este metodo siempre es ejecutado
	*/
	public function main(){
		
		if (isset($_REQUEST["do"])){
			$do = $_REQUEST["do"];
			if(Seguridad::getId() == null && $do != "processFormLogin" && $do != "insertUser" && $do != "processInsertUser"){
				$do = "formLogin";
			}
		} else
			$do = "formLogin";
		$this->$do(); //Ejecuta el metodo con el nombre que contiene la variable en ese momento
	}
	
	/**
	* Muestra el formulario de login
	*/
	private function formLogin(){
		View::show("user/login");
	}
	
	/**
	* Procesa el formulario login
	*/
	private function processFormLogin(){
		$username = $_REQUEST["usuario"];
		$password = $_REQUEST["password"];
		$validar = $this->users->getProcessUser($username, $password);
		if($validar){
			if (Seguridad::getTipo() == "0")
				View::redireccion("selectTable", "userController");
			else
				View::redireccion("selectTable", "userController");
		} else {
			$data["informacion"] = "Nombre de usuario o contraseña incorrecta.";
			View::show("user/login", $data);
		}
	}

	/**
	* Muestra la vista de seleccion de tablas
	*/
	private function selectTable(){
		View::show("user/seleccionaTablas");
	}

//---------- ADMINISTRACION DE USUARIOS ----------

	/**
	* Selecciona y muestra la vista del usuario según los permisos que tenga
	*/
	private function user(){

		$data["tipoUsuario"] = Seguridad::getTipo();

		if(Seguridad::getTipo() == 0){
			$data["datosUsuarios"] = $this->users->getAll();
			View::show("user/userAdmin", $data);
		} else if(Seguridad::getTipo() == 1){
			$data["datosUsuarios"] = $this->users->get(Seguridad::getId());
			View::show("user/userAdmin", $data);
		} 
	}
	
	/**
	* Elimina el usuario
	*/
	private function deleteUser() {
		$result = $this->users->deleteUser($_REQUEST["idusuario"]);
		if(Seguridad::getTipo() == 1)
			header('Location: index.php');
		else
			View::redireccion("user", "userController");
	}
	
	/**
	* Muestra la vista para insertar un usuario
	*/
	private function insertUser(){
		$data['tipoUsuario'] = Seguridad::getTipo();
		View::show("user/insertForm", $data);
	}
	
	/**
	* Procesa el formulario para insertar un usuario
	*/
	private function processInsertUser(){
		//Comprueba que la variable tipo exista, sino pondra 1 por defecto
		if(isset($_REQUEST["tipo"]))
			$tipo = $_REQUEST["tipo"];
		else 
			$tipo = 1;

		if($_FILES["foto_usuario"]["error"] == 0){
			$randNumber = rand(0, 999999);
			$imgName = $randNumber . $_FILES['foto_usuario']['name'];
			$image_upload = Config::$userDirImage . $imgName;
			if (move_uploaded_file($_FILES['foto_usuario']['tmp_name'], $image_upload)) {
				$result = $this->users->insertUser($tipo, $imgName); //Devuelve 1 si inserta user
				if($result){
					if (Seguridad::getTipo() == "0"){
						View::redireccion("user", "userController");
					} else {
						header('Location: index.php');
					}
				} else {
					echo "Ocurrio un error al insertar el usuario.";
				}
			} else {
				echo "Ocurrio un error al guardar el archivo.";
			}
		}
	}
	
	/**
	* Muestra la vista para modificar un usuario.
	*/
	private function updateUser(){
		$data['datosUsuario'] = $this->users->get($_REQUEST["idusuario"]);
		$data['tipoUsuario'] = Seguridad::getTipo(); 
		View::show("user/updateForm", $data);
	}
	
	/**
	* Procesa el formulario de modificar un usuario.
	*/
	private function processUpdateUser(){
		$esInsertado = $this->users->updateUser($_REQUEST["idusuario"]);
		if($esInsertado)
			View::redireccion("user", "userController");
		else
			echo "Hubo un error.";

	}
	
	/**
	* Cierra las variables de sesion
	*/
	private function exitLogin(){
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




