<?php

require_once("config.php");


$aluno = new Usuario("marcinho","cgnra");

$aluno->insere();


echo $aluno;


?>