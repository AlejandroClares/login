<form action="index.php" method="POST">
	Usuario<br>
	<input type="text" name="usuario"><br>
	Contraseña<br>
	<input type="password" name="password"><br>
	<input type="hidden" name="do" value="validarFormularioLogin">
	<input type="hidden" name="controlador" value="userControlador">
	<br>
	<input type="submit" value="Enviar">
	<a href="index.php?do=insertaUsuario&controlador=userControlador">Crear usuario</a>
</form>

<?php 
	if(isset($data["informacion"]))
		echo '<p>'.$data["informacion"].'</p>';