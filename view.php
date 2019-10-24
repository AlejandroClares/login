<?php
	class View {
		
		public static function show($nombreVista, $data=null) {
            include("views/header.php");
			include("views/$nombreVista.php");
            include("views/footer.php");
		}

        public static function redireccion($actionName, $controller,$data=null) {
            $url = "<script>location.href='index.php?do=$actionName&controlador=$controller";
            if ($data != null) {
                foreach ($data as $clave=>$valor) {
                    $url = $url . "&" . $clave . "=" . $valor;
                }
            }
            $url = $url . "'</script>";
            echo $url;
        }

	}