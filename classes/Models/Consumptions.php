<?php  

	class Consumptions extends Admin
	{

		public $paymentModel;
		public $buildingModel;
		public $apartmentModel;
		
		function __construct()
		{
			parent::__construct();
			$this->paymentModel = new Payments;
			$this->buildingModel = new Buildings;
			$this->apartmentModel = new Apartments;
		}

		public function Create(Request $data)
		{
			$user_id = 1;
			
			if ($data->get('previous')==null){
				$data->put('previous', $this->getLast($data->get("apartment_id"))['lecture']);
			}
			$data->put('liters', ($data->get('lecture')-$data->get('previous'))*3.9);
			$data->put('date', "CURRENT_TIMESTAMP()");
			$b = $this->buildingModel->GetByApartment($data->get("apartment_id"));
			$data->put('price',$b['price']);
			$data->put('admin',$b['admin_cost']);
			$data->put('user_id',$user_id);
			$d = $data->extract(["user_id","apartment_id","date","lecture","previous","liters","price","admin","photo","note"]);
			$insert = $this->Insert(self::TABLE_CONSUMPTIONS,$d,"id");
			return $insert;
		}

		public function Read($id)
		{
			$c = $this->GetById(self::TABLE_CONSUMPTIONS,$id);
			$c['payment'] = $c['id']!=null?$this->apartmentModel->Read($c['apartment_id']):null;
			$c['apartment'] = $c['id']!=null?$this->apartmentModel->Read($c['apartment_id']):null;
			$c['previous'] = $c['id']!=null?$this->getPrevious($c['id'],$c['apartment_id']):null;
			return $c;
		}

		public function Update(Request $data)
		{	
			$d = $data->extract(["name","email",["phone"=>"phone"],"type","company_id"]);
			$update = $this->Save(self::TABLE_CONSUMPTIONS,$d,$data->id);
			return $update;
		}

		public function Delete(Request $data)
		{
			$delete = $this->Save(self::TABLE_CONSUMPTIONS,[
				"status"=>3
			],$data->id);
			return $delete;
		}

		public function List()
		{
			return $this->ListAll(self::TABLE_CONSUMPTIONS);
		}

		public function getPrevious($id,$apartment_id)
		{
			$s = $this->query->select("*",self::TABLE_CONSUMPTIONS,"apartment_id = ".$apartment_id." AND id != ".$id." AND id < ".$id,"id DESC");
			$c = $this->GetFirst($s);
			$c['payment'] =  $this->paymentModel->GetByConsumption($c['id']);
			return $c;
		}
		
		public function getLast($apartment_id)
		{
			$s = $this->query->select("*",self::TABLE_CONSUMPTIONS,"apartment_id = ".$apartment_id,"id DESC");
			$c = $this->GetFirst($s);
			if ($c==null){
				return 0;
			}
			$c['payment'] = $c['id']!=null?$this->paymentModel->GetByConsumption($c['id']):null;
			return $c;
		}

		public function GetByApartment($apartment_id)
		{
			$s = $this->query->select("*",self::TABLE_CONSUMPTIONS,"apartment_id = ".$apartment_id);
			$con = $this->GetAllRows($s);
			$res = array();
			$balance = 0;
			foreach ($con as $c) {
				$c['payment'] = $this->paymentModel->GetByConsumption($c['id']);	
				$c['balance'] = $balance;
				$balance = $c['payment']['balance'];
				$res[] = $c;
			}
			return array_reverse($res);
		}
	}
?>