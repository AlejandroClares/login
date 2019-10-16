<?php
		echo '<a href="index.php?do=insertaUsuario">Añadir </a>';
		echo '<a href="index.php?do=salirLogin">Salir</a><br>
			<br>';
	?>
		<table border="1px solid black">
			<tr>
				<th>idusuario</th>
				<th>nombre</th>
				<th>apellidos</th>
				<th>email</th>
				<th>nick</th>
				<th>passwd</th>
				<th>tipo</th>
				<th colspan="2">Acciones</th>
			</tr>
		<?php
		foreach ($data["listaUsuarios"] as $registro) {
			echo '<tr><td>'.$registro["idusuario"].'</td>';
			echo '<td>'.$registro["nombre"].'</td>';
			echo '<td>'.$registro["apellidos"].'</td>'; 
			echo '<td>'.$registro["email"].'</td>';
			echo '<td>'.$registro["nick"].'</td>';
			echo '<td>'.$registro["passwd"].'</td>';
			echo '<td>'.$registro["tipo"].'</td>';
			echo '<td><a href="index.php?idusuario='.$registro["idusuario"].'&do=modificaUsuario">Modificar</a></td>';
			echo '<td><a href="index.php?idusuario='.$registro["idusuario"].'&do=eliminaUsuario">Eliminar</a></td></tr>';
		}
		echo "</table>";