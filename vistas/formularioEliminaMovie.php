<p>¿Estas seguro que desea eliminar la pelicula: <?php echo $data["datosPelicula"][0]->title?>?</p>
<a href="index.php?do=processDeleteMovie&controlador=movieControlador&id=<?php echo $data["datosPelicula"][0]->id?>">Eliminar</a>
<a href="index.php?do=movie&controlador=movieControlador">Cancelar</a>
