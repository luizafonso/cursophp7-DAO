<?php

require_once("config.php");


$aluno = new Usuario();
$aluno->setDes_login("zequinha");
$aluno->setDes_senha("fufi");

$aluno->insere();


echo $aluno;


?>