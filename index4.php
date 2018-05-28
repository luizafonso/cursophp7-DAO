<?php

require_once("config.php");


//carrega um usuário usando o login e a senha

$u = new Usuario();
$u->logon("root","abc");

echo $u;



?>