<?php

if(Seguridad::getId() != null){
	echo '<br><a href="index.php?do=salirLogin&controlador=userController">Cerrar sesión</a>';
}
echo '
	</body>
	</html>
';