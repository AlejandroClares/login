<?php
include("controlador.php");

// Iniciara el controlador que se le pase por al variable direccion.
if(isset($_REQUEST["direccion"])) {
	$c = new $_REQUEST["direccion"]();
	$c->main();	
} else {
	$c = new controlador();
	$c->main();
}