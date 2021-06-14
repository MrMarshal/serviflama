<?php  

	class Apartments extends Admin
	{

		function __construct()
		{
			parent::__construct();
		}

		public function Create(Request $data)
		{
			$d = $data->extract(["building_id","name","mesurer","reference","note"]);
			$insert = $this->Insert(self::TABLE_APARTMENTS,$d,"id");
			return $insert;
		}

		public function Read($id)
		{
			return $this->GetById(self::TABLE_APARTMENTS,$id);
		}

		public function Update(Request $data)
		{	
			$d = $data->extract(["name","email",["phone"=>"phone"],"type","company_id"]);
			$update = $this->Save(self::TABLE_APARTMENTS,$d,$data->id);
			return $update;
		}

		public function Delete(Request $data)
		{
			$delete = $this->Save(self::TABLE_APARTMENTS,[
				"status"=>3
			],$data->id);
			return $delete;
		}

		public function List()
		{
			return $this->ListAll(self::TABLE_APARTMENTS);
		}

		public function GetByClient($client_id)
		{
			$s = $this->query->select("*",self::TABLE_APARTMENTS,"client_id = ".$client_id);
			$res = $this->RunQuery($s);
			return $res;
		}

		public function GetByBuilding($building_id)
		{
			$s = $this->query->select("*",self::TABLE_APARTMENTS,"building_id = ".$building_id->get("building"));
			$res = $this->GetAllRows($s);
			return $res;
		}

		public function GetByMesurer($mesurer)
		{
			$s = $this->query->select("*",self::TABLE_APARTMENTS,"mesurer = '".$mesurer->get("mesurer")."'");
			$res = $this->GetFirst($s);
			if ($res!=null){
				$s2 = $this->query->select("*",self::TABLE_CLIENTS,"apartment_id = ".$res['id']);
				$c = $this->GetFirst($s2);
				$res['client'] = $c;;
			}
			return $res;	
		}
	}
?>