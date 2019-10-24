<?php
	// Comprueba si el usuario es administrador.
	$admin = false;
	if($data["tipoUsuario"] == 0){
		$admin = true;
	}

	if($admin) echo '<a href="index.php?do=insertaUsuario&controlador=userController">Añadir</a> <br/>';
	echo '<a href="index.php?do=salirLogin&controlador=userController">Salir</a><br>
			<br>';
	?>
		<table border="1px solid black">
			<tr>
				<?php if($admin) echo '<th>ID</th>'; ?>
				<th>Nombre</th>
				<th>Apellidos</th>
				<th>Email</th>
				<th>Nick</th>
				<?php if($admin) echo '<th>Permisos</th>'; ?>
				<th colspan="2">Acciones</th>
			</tr>
		<?php
		foreach ($data["datosUsuarios"] as $registro) {
			if($admin) echo '<tr><td>'.$registro->idusuario.'</td>';
			echo '<td>'.$registro->nombre.'</td>';
			echo '<td>'.$registro->apellidos.'</td>'; 
			echo '<td>'.$registro->email.'</td>';
			echo '<td>'.$registro->nick.'</td>';
			if($admin) echo '<td>'.$registro->tipo.'</td>';
			echo '<td><a href="index.php?idusuario='.$registro->idusuario.'&do=modificaUsuario&controlador=userController">Modificar</a></td>';
			echo '<td><a href="index.php?idusuario='.$registro->idusuario.'&do=eliminaUsuario&controlador=userController">Eliminar</a></td></tr>';
		}
		echo "</table>";