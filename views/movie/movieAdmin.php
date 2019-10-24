
<a href="index.php?do=insertMovie&controlador=movieController">Añadir</a> <br/>
<a href="index.php?do=salirLogin&controlador=userController">Salir</a>

<table border="1px solid black">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Year</th>
        <th>Duration</th>
        <th>Rating</th>
        <th>Cover</th>
        <th>Filepath</th>
        <th>Filename</th>
        <th>External url</th>
        <th colspan="2">Acciones</th>
    </tr>
    <?php
    foreach ($data["datosMovies"] as $registro) {
        echo '<tr>';
        echo '<td>'.$registro->id.'</td>';
        echo '<td>'.$registro->title.'</td>';
        echo '<td>'.$registro->year.'</td>';
        echo '<td>'.$registro->duration.'</td>';
        echo '<td>'.$registro->rating.'</td>';
        echo '<td>'.$registro->cover.'</td>';
        echo '<td>'.$registro->filepath.'</td>';
        echo '<td>'.$registro->filename.'</td>';
        echo '<td>'.$registro->external_url.'</td>';
        echo '<td><a href="index.php?do=updateMovie&controlador=movieController&id='.$registro->id.'">Modificar</a></td>';
		echo '<td><a href="index.php?do=deleteMovie&controlador=movieController&id='.$registro->id.'">Eliminar</a></td>';
        echo '</tr>';
    }
    ?>
</table
