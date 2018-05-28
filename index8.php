<?php

require_once("config.php");

$user = new Usuario();

$user->loadById(7);
$user->delete();

echo $user;

?>