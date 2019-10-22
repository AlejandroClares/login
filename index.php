<?php
include("userControlador.php");

// Iniciara el controlador que se le pase por al variable direccion.
if(isset($_REQUEST["controlador"])) {
	$c = new $_REQUEST["controlador"]();
	$c->main();	
} else {
	$c = new userControlador();
	$c->main();
}

