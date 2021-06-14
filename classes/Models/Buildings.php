<?php  

	class Buildings extends Admin
	{
		public $addressesModel;

		function __construct()
		{
			parent::__construct();
			$this->addressesModel = new Addresses;
		}

		public function Create(Request $data)
		{
			$d = $data->extract(["address_id","name","note","price","admin_cost"]);
			$insert = $this->Insert(self::TABLE_BUILDINGS,$d,"all");
			return $insert;
		}

		public function Read($id)
		{
			$building = $this->GetById(self::TABLE_BUILDINGS,$id);
			$building['address'] = $this->addressesModel->Read($building['address_id']);
			return $building;
		}

		public function Update(Request $data)
		{	
			$d = $data->extract(["name","email",["phone"=>"phone"],"type","company_id"]);
			$update = $this->Save(self::TABLE_BUILDINGS,$d,$data->id);
			return $update;
		}

		public function Delete(Request $data)
		{
			$delete = $this->Save(self::TABLE_BUILDINGS,[
				"status"=>3
			],$data->id);
			return $delete;
		}

		public function List()
		{
			$bs = $this->ListAll(self::TABLE_BUILDINGS);
			$res = array();
			foreach ($bs as $b) {
				$b['address'] = $this->addressesModel->Read($b['address_id']);
				$res[] = $b;
			}
			return $res;
		}

		public function GetByApartment($apartment_id)
		{
			$s = $this->query->select_join("b.*",self::TABLE_BUILDINGS,[
				self::TABLE_APARTMENTS => "apar.building_id = b.id"
			],"apar.id = ".$apartment_id);
			return $this->GetFirst($s);
		}
	}
?>