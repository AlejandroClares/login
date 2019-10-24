<?php

	echo '
	<form action="index.php" method="POST">
		Titulo<br>
		<input type="text" name="title" value="'.$data["datosPelicula"][0]->title.'"><br>
		Año<br>
		<input type="number" name="year" value="'.$data["datosPelicula"][0]->year.'"><br>
		Duración<br>
		<input type="number" name="duration" value="'.$data["datosPelicula"][0]->duration.'"><br>
		Valoración<br>
		<input type="number" name="rating" value="'.$data["datosPelicula"][0]->rating.'" min="0" max="10"><br>
		Ruta imagen de portada<br>
        <input type="text" name="cover" value="'.$data["datosPelicula"][0]->cover.'"><br>
        Ruta del archivo<br>
        <input type="text" name="filepath" value="'.$data["datosPelicula"][0]->filepath.'"><br>
        Nombre del archivo<br>
        <input type="text" name="filename" value="'.$data["datosPelicula"][0]->filename.'"><br>
        URL externa<br>
		<input type="text" name="external_url" value="'.$data["datosPelicula"][0]->external_url.'"><br>
	';

	echo '
		<input type="hidden" name="id" value="'.$data["datosPelicula"][0]->id.'">
		<input type="hidden" name="controlador" value="movieControlador">
		<input type="hidden" name="do" value="processUptadeMovie"><br>
		<input type="submit" value="Modificar">
	</form>
	';

	if(isset($data["informacion"])){
		echo '<p>'.$data["informacion"].'</p>';
	}