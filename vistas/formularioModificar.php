<?php

	echo '
	<form action="index.php" method="POST">
		Nombre<br>
		<input type="text" name="nombre" value="'.$data["datosUsuario"][0]->nombre.'"><br>
		Apellidos<br>
		<input type="text" name="apellidos" value="'.$data["datosUsuario"][0]->apellidos.'"><br>
		Email<br>
		<input type="text" name="email" value="'.$data["datosUsuario"][0]->email.'"><br>
		Usuario<br>
		<input type="text" name="nick" value="'.$data["datosUsuario"][0]->nick.'"><br>
		Contraseña<br>
		<input type="password" name="passwd" value="'.$data["datosUsuario"][0]->passwd.'"><br>
	';
	if($data['tipoUsuario'] == "0")		
		echo 'Tipo<br>
		<input type="number" name="tipo" value="'.$data["datosUsuario"][0]->tipo.'" max="1" min="0"><br>';

	echo '
		<input type="hidden" name="idusuario" value="'.$data["datosUsuario"][0]->idusuario.'">
		<input type="hidden" name="do" value="validaModificaUsuario"><br>
		<input type="submit" value="Añadir">
	</form>
	';