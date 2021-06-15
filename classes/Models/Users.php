<?php  

	class Users extends Admin
	{
		
		function __construct()
		{
			parent::__construct();
		}

		public function Create(Request $data)
		{
			$pass = md5($data->get("phone"));
			$d = $data->extract(["name","email","phone","type","company_id"]);
			$d["password"] = $pass;
			$insert = $this->Insert(self::TABLE_USERS,$d,"id");
			return $insert;
		}

		public function Read($id)
		{
			return $this->GetById(self::TABLE_USERS,$id);
		}

		public function Update(Request $data)
		{	
			$d = $data->extract(["name","email",["phone"=>"phone"],"type","company_id"]);
			$update = $this->Save(self::TABLE_USERS,$d,$data->id);
			return $update;
		}

		public function Delete(Request $data)
		{
			$delete = $this->Save(self::TABLE_USERS,[
				"status"=>3
			],$data->id);
			return $delete;
		}

		public function List()
		{
			return $this->ListAll(self::TABLE_USERS);
		}

		public function Login(Request $data)
		{
			$s = $this->query->select("*",self::TABLE_USERS,"password = '".md5($data->get("password"))."' AND email = '".$data->get("email")."'");
			if(session_status() == PHP_SESSION_NONE)
				session_start();
			$_SESSION['login'] = 1;
			$_SESSION['start'] = time();
			if (!isset($user["business_id"])){
				$_SESSION['expire'] = $_SESSION['start'] + (1440 * 60);
			}
			$user['single_name'] = explode(" ",$user['name'])[0];
			$user['pass'] = "Qué miras, puto";
			$user['password'] = $user['pass'];
			$_SESSION['user'] = $user;
			return $this->GetFirst($s);
		}
	}
?>