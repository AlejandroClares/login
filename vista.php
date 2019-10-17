<?php
	class Vista {
		
		public static function mostrar($nombreVista, $data=null) {
            include("vistas/header.php");
			include("vistas/$nombreVista.php");
            include("vistas/footer.php");
		}

        public static function redireccion($actionName, $data=null) {
            $url = "<script>location.href='index.php?do=$actionName";
            if ($data != null) {
                foreach ($data as $clave=>$valor) {
                    $url = $url . "&" . $clave . "=" . $valor;
                }
            }
            $url = $url . "'</script>";
            echo $url;
        }

	}