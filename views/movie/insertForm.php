<form action="index.php" method="POST">
	Titulo<br>
	<input type="text" name="titulo"><br>
	Año<br>
	<input type="number" name="anyo"><br>
	Duracion<br>
	<input type="number" name="duracion"><br>
	Valoracion<br>
	<input type="number" name="valoracion" min="0" max="10"><br>
	Ruta de la portada<br>
	<input type="text" name="rutaPortada"><br>
	Ruta del archivo<br>
	<input type="text" name="rutaArchivo"><br>
    Nombre de archivo<br>
	<input type="text" name="nombreArchivo"><br>
    Url externa<br>
	<input type="text" name="urlExterna"><br>
	
	<input type="hidden" name="controlador" value="movieController">
	<input type="hidden" name="do" value="processInsertMovie"><br>
	<input type="submit" value="Añadir pelicula">
</form>

<?php
	if(isset($data["informacion"]))
		echo '<p>'.$data["informacion"].'</p>';