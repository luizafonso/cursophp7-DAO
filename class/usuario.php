<?php

class Usuario {
	private $id_usuario;
	private $des_login;
	private $des_senha;
	private $dt_cadastro;

	# GETTERS
	public function getId_Usuario() {
		return $this->id_usuario;
	}

	public function getDes_login() {
		return $this->des_login;
	}

	public function getDes_senha() {
		return $this->des_senha;
	}

	public function getDt_cadastro() {
		return $this->dt_cadastro;
	}

	# SETTERS
	public function setId_Usuario($x) {
		$this->id_usuario = $x;
	}

	public function setDes_login($x) {
		$this->des_login = $x;
	}

	public function setDes_senha($x) {
		$this->des_senha = $x;
	}

	public function setDt_cadastro($x) {
		$this->dt_cadastro = $x;
	}

	############################################

	public function loadById($id) {
		$sql = new Sql();
		$resultados = $sql->select("SELECT * FROM tb_usuarios WHERE id_usuario = :ID", array(":ID"=>$id));

		if(count($resultados) > 0) {
			$linha = $resultados[0];
			$this->setId_Usuario($linha['id_usuario']);
			$this->setDes_login($linha['des_login']);
			$this->setDes_senha($linha['des_senha']);
			#$this->setDt_cadastro($linha['dt_cadastro']);
			$this->setDt_cadastro(new DateTime($linha['dt_cadastro'])); # o 'new DateTime' é pra ele colocar naquele padrão de data e hora. colocando aqui o new DateTime ele já vai instanciar a classe.
		}
	}

	###############################################

	public function __toString() {
		return json_encode(array(
			"id_usuario" => $this->getId_Usuario(),
			"des_login" => $this->getDes_login(),
			"des_senha" => $this->getDes_senha(),
			"dt_cadastro" => $this->getDt_cadastro()->format("d/m/Y H:i:s") # os objetos do tipo DateTime possuem o metodo ->format(). Por isso já usa logo para configurar a saída formatada.
		));
	}	

}

?>