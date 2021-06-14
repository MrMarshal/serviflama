<?php  
	class Payments extends Admin
	{
		function __construct()
		{
			parent::__construct();
		}

		public function Create(Request $data)
		{
			$data->put('date', "CURRENT_TIMESTAMP()");
			$d = $data->extract(["apartment_id","consumption_id","date","amount","balance","note"]);
			$insert = $this->Insert(self::TABLE_PAYMENTS,$d,"id");
			return $insert;
		}

		public function Read($id)
		{
			return $this->GetById(self::TABLE_PAYMENTS,$id);
		}

		public function Update(Request $data)
		{	
			$d = $data->extract(["name","email",["phone"=>"phone"],"type","company_id"]);
			$update = $this->Save(self::TABLE_PAYMENTS,$d,$data->id);
			return $update;
		}

		public function Delete(Request $data)
		{
			$delete = $this->Save(self::TABLE_PAYMENTS,[
				"status"=>3
			],$data->id);
			return $delete;
		}

		public function List()
		{
			return $this->ListAll(self::TABLE_PAYMENTS);
		}

		public function GetByConsumption($consumption)
		{
			if ($consumption!=null){
				$s = $this->query->select("*",self::TABLE_PAYMENTS,"consumption_id = ".$consumption);
				$p = $this->GetFirst($s);
				return $p;
			}
			else{
				return null;
			}
		}

		public function GetLast(Request $data)
		{
			$s = $this->query->select("*",self::TABLE_PAYMENTS,"apartment_id = ".$data->get('apartment_id'),"id DESC");
			$p = $this->GetFirst($s);
			return $p;
		}
	}
?>