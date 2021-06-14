<?php  

	class Addresses extends Admin
	{
		function __construct()
		{
			parent::__construct();
		}

		public function Create(Request $data)
		{
			$d = $data->extract(["street","number","country","suburb","townhall","zipcode","reference","note"]);
			$insert = $this->Insert(self::TABLE_ADDRESSES,$d,"id");
			return $insert;
		}

		public function Read($id)
		{
			return $this->GetById(self::TABLE_ADDRESSES,$id);
		}

		public function Update(Request $data)
		{	
			$d = $data->extract(["name","email",["phone"=>"phone"],"type","company_id"]);
			$update = $this->Save(self::TABLE_ADDRESSES,$d,$data->id);
			return $update;
		}

		public function Delete(Request $data)
		{
			$delete = $this->Save(self::TABLE_ADDRESSES,[
				"status"=>3
			],$data->id);
			return $delete;
		}

		public function List()
		{
			return $this->ListAll(self::TABLE_ADDRESSES);
		}
	}
?>