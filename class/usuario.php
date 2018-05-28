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
			$this->setDados($resultados[0]);
		}
	}

	###############################################

	public function __toString() {

		return json_encode(array(
			"id_usuario" => $this->getId_Usuario(),
			"des_login" => $this->getDes_login(),
			"des_senha" => $this->getDes_senha(),
			"dt_cadastro" => $this->getDt_cadastro()->format("d/m/Y H:i:s")
		));
		
	}	

	public static function getList() {
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios ORDER BY des_login;");
	}

	public static function search($login) {
		$sql = new Sql();
		$resultado = $sql->select("SELECT * FROM tb_usuarios WHERE des_login LIKE :SEARCH ORDER BY des_login", array(
			':SEARCH'=>"%".$login."%"
		));
		return($resultado);
	}

	public function logon($u, $s) {
		$sql = new Sql();
		$resultados = $sql->select("SELECT * FROM tb_usuarios WHERE des_login = :USUARIO AND des_senha = :SENHA", array(
			":USUARIO"=>$u,
			":SENHA"=>$s
		));

		if(count($resultados) > 0) {
			$this->setDados($resultados[0]);

		} else {
			throw new Exception("Login e/ou senha inválidos");
			
		}		
	}

	public function setDados($d) {
		$this->setId_Usuario($d['id_usuario']);
		$this->setDes_login($d['des_login']);
		$this->setDes_senha($d['des_senha']);
		$this->setDt_cadastro(new DateTime($d['dt_cadastro'])); 
		# o 'new DateTime' é pra ele colocar naquele padrão de data e hora. colocando aqui o new DateTime ele já vai instanciar a classe.		
	}

	public function insere() {
		$sql = new Sql();
		#echo 'inserindo';
		$resultados = $sql->select("CALL sp_usuarios_insert(:LOGIN, :SENHA)",array(
			':LOGIN'=>$this->getDes_login(),
			':SENHA'=>$this->getDes_senha()
		));

		if(count($resultados) > 0) {
			$this->setDados($resultados[0]);
		}
	}


	public function update($l, $s) {

		$this->setDes_login($l);
		$this->setDes_senha($s);
		$sql = new Sql();
		$sql->query("UPDATE tb_usuarios SET des_login = :LOGIN, des_senha = :PASS WHERE id_usuario = :ID", array(
			':LOGIN'=>$this->getDes_login(),
			':PASS'=>$this->getDes_senha(),
			':ID'=>$this->getId_Usuario()
		));
	}

	public function __construct($l = "", $s = "") {
		$this->setDes_login($l);
		$this->setDes_senha($s);
	}

	public function delete(){
		$sql = new Sql();
		# o comando DELETE não tem asterisco mesmo.
		$sql->query("DELETE FROM tb_usuarios WHERE id_usuario = :ID", array(
			':ID'=>$this->getId_Usuario()
		));

		$this->setId_Usuario(0);
		$this->setDes_login("");
		$this->setDes_senha("");
		$this->setDt_cadastro(new DateTime());
	}


}

?>