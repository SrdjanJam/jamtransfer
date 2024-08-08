<?
require_once 'db.class.php';

Class v4_OfficeShift {

	public $ID; //int(11)
	public $ShiftName; //int(11)
	public $Begin; //date
	public $End; //time
	public $Status; //time

	public $connection;
		

	function __construct(){
		$this->connection = new DataBaseMysql();
	} public function myreal_escape_string($string){
		return $this->connection->real_escape_string($string);
	}

	public function New_v4_LogUser($ID,$ShiftName,$Begin,$End,$Status){
		$this->ID = $ID;
		$this->ShiftName = $ShiftName;
		$this->Begin = $Begin;
		$this->End = $End;
		$this->Status = $Status;
	}

	public function fieldValues(){
		$fieldValues = array(
			'ID' => $this->getID(),
			'ShiftName' => $this->getShiftName(),
			'Begin' => $this->getBegin(),
			'End' => $this->getEnd(),
			'Status' => $this->getStatus()
			);
		return $fieldValues;
	}

	public function fieldNames(){
		$fieldNames = array('ID','ShiftName','Begin','End','Status');
		return $fieldNames;
	}
	
	public function getRow($key_row){
		$result = $this->connection->RunQuery("Select * from v4_OfficeShift where ID = \"$key_row\" ");
		if($result->num_rows < 1) return false;
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->ID = $row["ID"];
			$this->ShiftName = $row["ShiftName"];
			$this->Begin = $row["Begin"];
			$this->End = $row["End"];
			$this->Status = $row["Status"];
		}
	}

	public function deleteRow($key_row){
		$this->connection->RunQuery("DELETE FROM v4_OfficeShift WHERE ID = $key_row");
	}
	
	public function saveRow(){
		$result = $this->connection->RunQuery("UPDATE v4_OfficeShift set 
		ID = '".$this->myreal_escape_string($this->ID)."', 
		ShiftName = '".$this->myreal_escape_string($this->ShiftName)."', 
		Begin = '".$this->myreal_escape_string($this->Begin)."', 
		End = '".$this->myreal_escape_string($this->End)."', 
		Status = '".$this->myreal_escape_string($this->End)."' WHERE ID = '".$this->ID."'");

		return $result;

	}

	public function saveAsNew(){
		$this->connection->RunQuery("INSERT INTO v4_OfficeShift (ShiftName, Begin, End, Status)
		values (
			'".$this->myreal_escape_string($this->ShiftName)."', 
			'".$this->myreal_escape_string($this->Begin)."', 
			'".$this->myreal_escape_string($this->End)."', 
			'".$this->myreal_escape_string($this->Status)."'
			)");

		return $this->connection->insert_id(); //return insert_id 
	}

	public function getKeysBy($column, $order, $where = NULL){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT ID from v4_OfficeShift $where ORDER BY $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["ID"];
				$i++;
			}
		return $keys;
	}

	// GET FUNCTIONS:
	public function getID(){
		return $this->ID;
	}

	public function getShiftName(){
		return $this->ShiftName;
	}
	
	public function getBegin(){
		return $this->Begin;
	}

	public function getEnd(){
		return $this->End;
	}
	
	public function getStatus(){
		return $this->Status;
	}


	// SET FUNCTIONS:
	public function setID($ID){
		$this->ID = $ID;
	}	
	public function setShiftName($ShiftName){
		$this->ShiftName = $ShiftName;
	}
	public function setBegin($Begin){
		$this->Begin = $Begin;
	}
	public function setEnd($End){
		$this->End = $End;
	}	
	public function setStatus($Status){
		$this->Status = $Status;
	}	

	public function v4_OfficeShift(){
		$this->connection->CloseMysql();
	}	


}