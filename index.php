<?php
session_start();
// Iniciara el controlador que se le pase por al variable direccion.
if(isset($_REQUEST["controlador"])) {
	include($_REQUEST["controlador"].".php");
	$c = new $_REQUEST["controlador"]();
	$c->main();	
} else {
	include("userController.php");
	$c = new userController();
	$c->main();
}