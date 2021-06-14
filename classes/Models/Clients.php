<?php  

	class Clients extends Admin
	{
		
		public $apartmentsModel;
		public $buildingsModel;
		public $consumptionsModel;

		function __construct()
		{
			$this->apartmentsModel = new Apartments;
			$this->buildingsModel = new Buildings;
			$this->consumptionsModel = new Consumptions;
			parent::__construct();
		}

		public function Create(Request $data)
		{
			$d = $data->extract(["apartment_id","name","lastname","phone","email"]);
			$insert = $this->Insert(self::TABLE_CLIENTS,$d,"id");
			return $insert;
		}

		public function Read($id)
		{
			return $this->GetById(self::TABLE_CLIENTS,$id);
		}

		public function Update(Request $data)
		{	
			$d = $data->extract(["name","email",["phone"=>"phone"],"type","company_id"]);
			$update = $this->Save(self::TABLE_CLIENTS,$d,$data->id);
			return $update;
		}

		public function Delete(Request $data)
		{
			$delete = $this->Save(self::TABLE_CLIENTS,[
				"status"=>3
			],$data->id);
			return $delete;
		}

		public function List()
		{
			$clients = $this->ListAll(self::TABLE_CLIENTS);
			$res = array();
			foreach ($clients as $c) {
				$c['apartment'] = $this->apartmentsModel->Read($c['apartment_id']);
				$c['building'] = $this->buildingsModel->Read($c['apartment']['building_id']);
				$c['consumption'] = $this->consumptionsModel->getLast($c['apartment_id']);
				$res[] = $c;
			}
			return $res;
		}

		public function GetByApartment($apartment_id)
		{
			$s = $this->query->select("*",self::TABLE_CLIENTS,"apartment_id = ".$apartment_id->get("apartment_id"));
			$c = $this->GetFirst($s);
			return $c;
		}
	}
?>