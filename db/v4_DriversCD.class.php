<?
require_once 'db.class.php';

Class v4_DriversCD {

	public $ID; //int(11)
	public $DetailsID; //int(10)
	public $UserID; //int(10)
	public $CD; //tinyint(1)
	public $DateAdded; //date
	public $TimeAdded; //time

	public $connection;
	

	function __construct(){
		$this->connection = new DataBaseMysql();
	} public function myreal_escape_string($string){
		return $this->connection->real_escape_string($string);
	}

	public function New_v4_DriversCD($ID,$DetailsID,$UserID,$CD,$DateAdded,$TimeAdded){
		$this->ID = $ID;
		$this->DetailsID = $DetailsID;
		$this->UserID = $UserID;
		$this->CD = $CD;
		$this->DateAdded = $DateAdded;
		$this->TimeAdded = $TimeAdded;
	}

	public function fieldValues(){
		$fieldValues = array(
			'ID' => $this->getID(),
			'DetailsID' => $this->getDetailsID(),
			'UserID' => $this->getUserID(),
			'CD' => $this->getCD(),
			'DateAdded' => $this->getDateAdded(),
			'TimeAdded' => $this->getTimeAdded()
			);
		return $fieldValues;
	}

	public function fieldNames(){
		$fieldNames = array('ID','DetailsID','UserID','CD','DateAdded','TimeAdded');
		return $fieldNames;
	}
	
	public function getRow($key_row){
		$result = $this->connection->RunQuery("Select * from v4_DriversCD where ID = \"$key_row\" ");
		if($result->num_rows < 1) return false;
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->ID = $row["ID"];
			$this->DetailsID = $row["DetailsID"];
			$this->UserID = $row["UserID"];
			$this->CD = $row["CD"];
			$this->DateAdded = $row["DateAdded"];
			$this->TimeAdded = $row["TimeAdded"];
		}
	}

	public function deleteRow($key_row){
		$this->connection->RunQuery("DELETE FROM v4_DriversCD WHERE ID = $key_row");
	}
	
	public function saveRow(){
		$result = $this->connection->RunQuery("UPDATE v4_DriversCD set 
		ID = '".$this->myreal_escape_string($this->ID)."', 
		DetailsID = '".$this->myreal_escape_string($this->DetailsID)."', 
		UserID = '".$this->myreal_escape_string($this->UserID)."', 
		CD = '".$this->myreal_escape_string($this->CD)."', 
		DateAdded = '".$this->myreal_escape_string($this->DateAdded)."', 
		TimeAdded = '".$this->myreal_escape_string($this->TimeAdded)."' WHERE ID = '".$this->ID."'");
			return $result; 
	}

	public function saveAsNew(){
		$this->connection->RunQuery("INSERT INTO v4_DriversCD (DetailsID, UserID, CD, DateAdded, TimeAdded) values (
		'".$this->myreal_escape_string($this->DetailsID)."',
		'".$this->myreal_escape_string($this->UserID)."', 
		'".$this->myreal_escape_string($this->CD)."', 
		'".$this->myreal_escape_string($this->DateAdded)."',
		'".$this->myreal_escape_string($this->TimeAdded)."')");

		return $this->connection->insert_id(); //return insert_id 
	}

	public function getKeysBy($column, $order, $where = NULL){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT ID from v4_DriversCD $where ORDER BY $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["ID"];
				$i++;
			}
		return $keys;
	}

	// GET METHODS: ------------------------------------
	public function getID(){
		return $this->ID;
	}
	public function getDetailsID(){
		return $this->DetailsID;
	}
	public function getUserID(){
		return $this->UserID;
	}	
	public function getCD(){
		return $this->CD;
	}	
	public function getDateAdded(){
		return $this->DateAdded;
	}	
	public function getTimeAdded(){
		return $this->TimeAdded;
	}
	
	// SET METHODS: --------------------------------------
	public function setID($ID){
		$this->ID = $ID;
	}	
	public function setDetailsID($DetailsID){
		$this->DetailsID = $DetailsID;
	}
	public function setUserID($UserID){
		$this->UserID = $UserID;
	}
	public function setCD($CD){
		$this->CD = $CD;
	}	
	public function setDateAdded($DateAdded){
		$this->DateAdded = $DateAdded;
	}	
	public function setTimeAdded($TimeAdded){
		$this->TimeAdded = $TimeAdded;
	}	
	// -----------------------------------------------------

	// Close mysql:
	public function v4_DriversCD(){
		$this->connection->CloseMysql();
	}

}