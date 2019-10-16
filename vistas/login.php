<form action="index.php" method="POST">
	Usuario<br>
	<input type="text" name="usuario"><br>
	Contraseña<br>
	<input type="text" name="password"><br>
	<input type="hidden" name="do" value="validarFormularioLogin">
	<br>
	<input type="submit" value="Enviar">
	<a href="index.php?do=insertaUsuario">Crear usuario</a>
</form>