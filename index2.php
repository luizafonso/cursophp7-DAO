<?php

require_once("config.php");


//carrega uma lista de usuários


$lista = Usuario::getList();
echo json_encode($lista);

?>