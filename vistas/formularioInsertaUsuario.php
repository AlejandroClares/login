<form action="index.php" method="POST">
	Nombre<br>
	<input type="text" name="nombre"><br>
	Apellidos<br>
	<input type="text" name="apellidos"><br>
	Email<br>
	<input type="text" name="email"><br>
	Nick<br>
	<input type="text" name="nick"><br>
	Contraseña<br>
	<input type="text" name="passwd"><br>
	<?php
	// Si el usuario es de tipo 0 podra asignar el valor de tipo a la base de datos.
	if($data['tipoUsuario'] != null)
		if($data['tipoUsuario'] == "0"){
			echo 'Tipo<br>
			<input type="text" name="tipo"><br>';
	}
	?>
	<input type="hidden" name="do" value="validarInsertaUsuario"><br>
	<input type="submit" name="Enviar">
</form>