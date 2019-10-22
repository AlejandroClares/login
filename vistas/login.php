<form action="index.php" method="POST">
	Usuario<br>
	<input type="text" name="usuario"><br>
	Contraseña<br>
	<input type="password" name="password"><br>
	<input type="hidden" name="do" value="validarFormularioLogin">
	<br>
	<input type="submit" value="Enviar">
	<a href="index.php?do=insertaUsuario&controlador=userControlador">Crear usuario</a>
</form>

<p><?php echo $data["informacion"]?></p>