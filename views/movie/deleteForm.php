<p>¿Estas seguro que desea eliminar la pelicula: <?php echo $data["datosPelicula"][0]->title?>?</p>
<a href="index.php?do=processDeleteMovie&controlador=movieController&id=<?php echo $data["datosPelicula"][0]->id?>">Eliminar</a>
<a href="index.php?do=movie&controlador=movieController">Cancelar</a>
