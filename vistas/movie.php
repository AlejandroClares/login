
<a href="">Añadir (Sin funcion)</a> <br/>
<a href="index.php?do=salirLogin&controlador=userControlador">Salir</a>

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
        echo '<td><a href="index.php?id='.$registro->id.'&do=null&controlador=movieControlador">Modificar (Sin funcion)</a></td>';
		echo '<td><a href="index.php?id='.$registro->id.'&do=null&controlador=movieControlador">Eliminar (Sin funcion)</a></td></tr>';
        echo '</tr>';
    }
    ?>
</table
