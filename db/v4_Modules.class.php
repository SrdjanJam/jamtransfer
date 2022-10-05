<?
require_once 'db.class.php';

Class v4_Modules {

	public $ModulID; //int(11)
	public $Name; //varchar(20)
	public $Code; //varchar(20)
	public $Base; //varchar(20)
	public $ParentID; //int(11)
	public $MenuOrder; //int(11)
	public $Icon; //int(11)
	public $Description; 
	public $Active; 
	public $connection;

	function __construct(){
		$this->connection = new DataBaseMysql();
	}	
	public function myreal_escape_string($string){
		return $this->connection->real_escape_string($string);
	}

	public function fieldValues(){
		$fieldValues = array(
			'ModulID' => $this->getModulID(),
			'Name' => $this->getName(),
			'Code' => $this->getCode(),
			'Base' => $this->getBase(),
			'ParentID' => $this->getParentID(),
			'MenuOrder' => $this->getMenuOrder(),
			'Icon' => $this->getIcon(),
			'Description' => $this->getDescription(),
			'Active' => $this->getActive()
			);
		return $fieldValues;
	}
	public function fieldNames(){
		$fieldNames = array('ModulID','Name','Code','Base','ParentID','MenuOrder','Icon','Description','Active');
		return $fieldNames;
	}
	
	public function getRow($key_row){
		$result = $this->connection->RunQuery("Select * from v4_Modules where ModulID = \"$key_row\" ");
		if($result->num_rows < 1) return false;
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->ModulID = $row["ModulID"];
			$this->Name = $row["Name"];
			$this->Code = $row["Code"];
			$this->Base = $row["Base"];
			$this->ParentID = $row["ParentID"];
			$this->MenuOrder = $row["MenuOrder"];
			$this->Icon = $row["Icon"];
			$this->Description = $row["Description"];
			$this->Active = $row["Active"];
		}
	}

	public function deleteRow($key_row){
		$this->connection->RunQuery("DELETE FROM v4_Modules WHERE ModulID = $key_row");
	}
	
		public function saveRow(){
		$result = $this->connection->RunQuery("UPDATE v4_Modules set 
ModulID = '".$this->myreal_escape_string($this->ModulID)."', 
Name = '".$this->myreal_escape_string($this->Name)."', 
Code = '".$this->myreal_escape_string($this->Code)."', 
Base = '".$this->myreal_escape_string($this->Base)."', 
ParentID = '".$this->myreal_escape_string($this->ParentID)."', 
MenuOrder = '".$this->myreal_escape_string($this->MenuOrder)."', 
Icon = '".$this->myreal_escape_string($this->Icon)."', 
Description = '".$this->myreal_escape_string($this->Description)."',
Active = '".$this->myreal_escape_string($this->Active)."' WHERE ModulID = '".$this->ModulID."'");
	return $result; 
}

	public function saveAsNew(){
		$this->connection->RunQuery("INSERT INTO v4_Modules (ModulID, Name, Code, Base, ParentID, MenuOrder, Icon, Description, Active) values ('".$this->myreal_escape_string($this->ModulID)."', '".$this->myreal_escape_string($this->Name)."', '".$this->myreal_escape_string($this->Code)."', '".$this->myreal_escape_string($this->Base)."', '".$this->myreal_escape_string($this->ParentID)."', '".$this->myreal_escape_string($this->MenuOrder)."','".$this->myreal_escape_string($this->Icon)."','".$this->myreal_escape_string($this->Description)."','".$this->myreal_escape_string($this->Active)."')");
		return $this->connection->insert_id(); //return insert_id 
	}
	public function getKeysBy($column, $order, $where = NULL){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT ModulID from v4_Modules $where ORDER BY $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["ModulID"];
				$i++;
			}
		return $keys;
	}

	public function getModulID(){
		return $this->ModulID;
	}
	public function getName(){
		return $this->Name;
	}
	public function getCode(){
		return $this->Code;
	}	
	public function getBase(){
		return $this->Base;
	}	
	public function getParentID(){
		return $this->ParentID;
	}	
	public function getMenuOrder(){
		return $this->MenuOrder;
	}	
	public function getIcon(){
		return $this->Icon;
	}	
	public function getDescription(){
		return $this->Description;
	}	
	public function getActive(){
		return $this->Active;
	}

	public function setModulID($ModulID){
		$this->ModulID = $ModulID;
	}	
	public function setName($Name){
		$this->Name = $Name;
	}	
	public function setCode($Code){
		$this->Code = $Code;
	}	
	public function setBase($Base){
		$this->Base = $Base;
	}	
	public function setParentID($ParentID){
		$this->ParentID = $ParentID;
	}	
	public function setMenuOrder($MenuOrder){
		$this->MenuOrder = $MenuOrder;
	}	
	public function setIcon($Icon){
		$this->Icon = $Icon;
	}	
	public function setDescription($Description){
		$this->Description = $Description;
	}	
	public function setActive($Active){
		$this->Active = $Active;
	}

	public function endv4_Modules(){
		$this->connection->CloseMysql();
	}	
}