<?
require_once 'db.class.php';

Class v4_OfficeHours {

	public $ID; //int(11)
	public $UserID; //int(11)
	public $WorkDate; //date
	public $Begin; //time
	public $End; //time

	public $connection;
	

	function __construct(){
		$this->connection = new DataBaseMysql();
	} public function myreal_escape_string($string){
		return $this->connection->real_escape_string($string);
	}

	public function New_v4_LogUser($ID,$UserID,$WorkDate,$Begin,$End){
		$this->ID = $ID;
		$this->UserID = $UserID;
		$this->WorkDate = $WorkDate;
		$this->Begin = $Begin;
		$this->End = $End;
	}

	public function fieldValues(){
		$fieldValues = array(
			'ID' => $this->getID(),
			'UserID' => $this->getUserID(),
			'WorkDate' => $this->getWorkDate(),
			'Begin' => $this->getBegin(),
			'End' => $this->getEnd()
			);
		return $fieldValues;
	}

	public function fieldNames(){
		$fieldNames = array('ID','UserID','WorkDate','Begin','End');
		return $fieldNames;
	}
	
	public function getRow($key_row){
		$result = $this->connection->RunQuery("Select * from v4_OfficeHours where ID = \"$key_row\" ");
		if($result->num_rows < 1) return false;
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->ID = $row["ID"];
			$this->UserID = $row["UserID"];
			$this->WorkDate = $row["WorkDate"];
			$this->Begin = $row["Begin"];
			$this->End = $row["End"];
		}
	}

	public function deleteRow($key_row){
		$this->connection->RunQuery("DELETE FROM v4_OfficeHours WHERE ID = $key_row");
	}
	
	public function saveRow(){
		$result = $this->connection->RunQuery("UPDATE v4_OfficeHours set 
		ID = '".$this->myreal_escape_string($this->ID)."', 
		UserID = '".$this->myreal_escape_string($this->UserID)."', 
		WorkDate = '".$this->myreal_escape_string($this->WorkDate)."', 
		Begin = '".$this->myreal_escape_string($this->Begin)."', 
		End = '".$this->myreal_escape_string($this->End)."' WHERE ID = '".$this->ID."'");

		return $result;

	}

	public function saveAsNew(){
		$this->connection->RunQuery("INSERT INTO v4_OfficeHours (UserID, WorkDate, Begin, End)
		values (
			'".$this->myreal_escape_string($this->UserID)."', 
			'".$this->myreal_escape_string($this->WorkDate)."', 
			'".$this->myreal_escape_string($this->Begin)."', 
			'".$this->myreal_escape_string($this->End)."'
			)");

		return $this->connection->insert_id(); //return insert_id 
	}

	public function getKeysBy($column, $order, $where = NULL){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT ID from v4_OfficeHours $where ORDER BY $column $order");
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

	public function getUserID(){
		return $this->UserID;
	}
	
	public function getWorkDate(){
		return $this->WorkDate;
	}

	public function getBegin(){
		return $this->Begin;
	}
	
	public function getEnd(){
		return $this->End;
	}


	// SET FUNCTIONS:
	public function setID($ID){
		$this->ID = $ID;
	}	
	public function setUserID($UserID){
		$this->UserID = $UserID;
	}
	public function setWorkDate($WorkDate){
		$this->WorkDate = $WorkDate;
	}
	public function setBegin($Begin){
		$this->Begin = $Begin;
	}	
	public function setEnd($End){
		$this->End = $End;
	}	

	public function v4_OfficeHours(){
		$this->connection->CloseMysql();
	}	


}