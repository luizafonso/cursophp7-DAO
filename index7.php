<?php

require_once("config.php");

$usuario = new Usuario();
$usuario->loadById(100);

$usuario->update("professor","!@#$%");

echo $usuario;

?>