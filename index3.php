<?php

require_once("config.php");


//carrega uma lista de usuários buscando pelo login


$busca = Usuario::search("jo");

#print_r($busca);

echo json_encode($busca);

?>