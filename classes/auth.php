<?php
class Auth{

	public $cone;
	public $user;
	public $pass;
	public $db;
	public $session;
	public $query;
	public $utils;

	function __construct()
	{
		include 'DB/connection.php';
		include 'DB/queryBuilder.php';
		include 'session.php';
		include 'utils.php';
		$this->session = new Session();
		$this->cone = new Connection;
		$this->db = $this->cone->Connect();
		$this->query = new QueryBuilder;
		$this->utils = new Utils;
	}


	public function RunQuery($query)
	{
		try {
			$q = $this->db->prepare($query);
			$q->execute();
		} catch(PDOException $error) {
			throw new PDOException('Mysql Resource failed: ' . $error->getMessage());
		}

		return $q;
	}

	public function LoginUser($user,$pass)
	{

		$pass = md5($pass);
		$select = $this->query->select("*", 'users',"username = '$user' AND password = '$pass'");
		$res = $this->RunQuery($select);
		$user = null;
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
			$user['password'] = 'Qué ves, puto';
			$user = $row;
		}

		if ($user!=null)
			$this->session->SessionStart($user);
		return $user;
	}

	public function Login($email)
	{

		$select = $this->query->select("*", 'clients',"email = '$email'");
		$res = $this->RunQuery($select);
		$user = null;
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
			$user['pass'] = 'Qué ves, puto';
			$user = $row;
		}

		if ($user!=null)
			$this->session->SessionStart($user);
		return $user;
	}

	public function ExternalLogin($token)
	{
		$select = $this->query->select("*", 'clients',"token = '$token'");
		$res = $this->RunQuery($select);
		$user = null;
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
			$user['pass'] = 'Qué ves, puto';
			$user = $row;
		}
		if ($user!=null)
			$this->session->SessionStart($user);
		return $user;
	}

	public function ConfirmEmail($code)
	{
		$update = $this->query->update(
			"inscritos",
			array(
				"confirmed" => "1"
			),
			"codigo = '$code'"
		);
		$q = $this->db->prepare($update);
		$q->execute();
		return $update;
	}

	public function ChangePassword($code,$pass)
	{
		$newCode = $this->utils->randomKey(7);
		$update = $this->query->update(
			"inscritos",
			array(
				"password" => "'$pass'",
				"codigo" => "'$newCode'"
			),
			"codigo = '$code'"
		);
		$q = $this->db->prepare($update);
		$q->execute();
		$count = $q->rowCount();
		return $count;
	}
}
?>
