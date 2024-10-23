<?
require_once 'db.class.php';

Class v4_LogUser {

	public $ID; //int(10)
	public $IPAddress; //varchar(255)
	public $UserName; //varchar(255)
	public $AuthUserID; //int(11)
	public $Latitude; //text
	public $Longitude; //text
	public $Place; //varchar(255)
	public $Type; //tinyint(1)
	public $SessionID; //varchar(255)
	public $DateTime; //datetime
	public $Mob; //tinyint(1)

	public $connection;
	

	function __construct(){
		$this->connection = new DataBaseMysql();
	} public function myreal_escape_string($string){
		return $this->connection->real_escape_string($string);
	}

	public function New_v4_LogUser($ID,$IPAddress,$UserName,$AuthUserID,$Latitude,$Longitude,$Place,$Type,$SessionID,$DateTime,$Mob){
		$this->ID = $ID;
		$this->IPAddress = $IPAddress;
		$this->UserName = $UserName;
		$this->AuthUserID = $AuthUserID;
		$this->Latitude = $Latitude;
		$this->Longitude = $Longitude;
		$this->Place = $Place;
		$this->Type = $Type;
		$this->SessionID = $SessionID;
		$this->DateTime = $DateTime;
		$this->Mob = $Mob;
	}

	public function fieldValues(){
		$fieldValues = array(
			'ID' => $this->getID(),
			'IPAddress' => $this->getIPAddress(),
			'UserName' => $this->getUserName(),
			'AuthUserID' => $this->getAuthUserID(),
			'Latitude' => $this->getLatitude(),
			'Longitude' => $this->getLongitude(),
			'Place' => $this->getPlace(),
			'Type' => $this->getType(),
			'SessionID' => $this->getSessionID(),
			'DateTime' => $this->getDateTime(),
			"Mob" => $this->getMob()
			);
		return $fieldValues;
	}
	public function fieldNames(){
		$fieldNames = array('ID','IPAddress','UserName','AuthUserID','Latitude','Longitude','Place','Type','SessionID','DateTime','Mob');
		return $fieldNames;
	}
	
	public function getRow($key_row){
		$result = $this->connection->RunQuery("Select * from v4_LogUser where ID = \"$key_row\" ");
		if($result->num_rows < 1) return false;
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->ID = $row["ID"];
			$this->IPAddress = $row["IPAddress"];
			$this->UserName = $row["UserName"];
			$this->AuthUserID = $row["AuthUserID"];
			$this->Latitude = $row["Latitude"];
			$this->Longitude = $row["Longitude"];
			$this->Place = $row["Place"];
			$this->Type = $row["Type"];
			$this->SessionID = $row["SessionID"];
			$this->DateTime = $row["DateTime"];
			$this->Mob = $row["Mob"];
		}
	}

	public function deleteRow($key_row){
		$this->connection->RunQuery("DELETE FROM v4_LogUser WHERE ID = $key_row");
	}
	
	public function saveRow(){
		$result = $this->connection->RunQuery("UPDATE v4_LogUser set 
		ID = '".$this->myreal_escape_string($this->ID)."', 
		IPAddress = '".$this->myreal_escape_string($this->IPAddress)."', 
		UserName = '".$this->myreal_escape_string($this->UserName)."', 
		AuthUserID = '".$this->myreal_escape_string($this->AuthUserID)."', 
		Latitude = '".$this->myreal_escape_string($this->Latitude)."', 
		Longitude = '".$this->myreal_escape_string($this->Longitude)."', 
		Place = '".$this->myreal_escape_string($this->Place)."', 
		Type = '".$this->myreal_escape_string($this->Type)."',
		SessionID = '".$this->myreal_escape_string($this->SessionID)."',
		DateTime = '".$this->myreal_escape_string($this->DateTime)."',
		Mob = '".$this->myreal_escape_string($this->Mob)."'
		WHERE ID = '".$this->ID."'");

		return $result; 
	}

	public function saveAsNew(){
		$this->connection->RunQuery("INSERT INTO v4_LogUser (IPAddress, UserName, AuthUserID, Latitude, Longitude, Place, Type, SessionID, DateTime, Mob)
		values (
			'".$this->myreal_escape_string($this->IPAddress)."', 
			'".$this->myreal_escape_string($this->UserName)."', 
			'".$this->myreal_escape_string($this->AuthUserID)."', 
			'".$this->myreal_escape_string($this->Latitude)."', 
			'".$this->myreal_escape_string($this->Longitude)."',
			'".$this->myreal_escape_string($this->Place)."',
			'".$this->myreal_escape_string($this->Type)."',
			'".$this->myreal_escape_string($this->SessionID)."',
			'".$this->myreal_escape_string($this->DateTime)."',
			'".$this->myreal_escape_string($this->Mob)."'
			)");

		return $this->connection->insert_id(); //return insert_id 
	}

	public function getKeysBy($column, $order, $where = NULL){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT ID from v4_LogUser $where ORDER BY $column $order");
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

	public function getIPAddress(){
		return $this->IPAddress;
	}
	
	public function getUserName(){
		return $this->UserName;
	}

	public function getAuthUserID(){
		return $this->AuthUserID;
	}
	
	public function getLatitude(){
		return $this->Latitude;
	}

	public function getLongitude(){
		return $this->Longitude;
	}

	public function getPlace(){
		return $this->Place;
	}

	public function getType(){
		return $this->Type;
	}

	public function getSessionID(){
		return $this->SessionID;
	}

	public function getDateTime(){
		return $this->DateTime;
	}

	public function getMob(){
		return $this->Mob;
	}
	

	// SET FUNCTIONS:
	public function setID($ID){
		$this->ID = $ID;
	}	
	public function setIPAddress($IPAddress){
		$this->IPAddress = $IPAddress;
	}
	public function setUserName($UserName){
		$this->UserName = $UserName;
	}
	public function setAuthUserID($AuthUserID){
		$this->AuthUserID = $AuthUserID;
	}	
	public function setLatitude($Latitude){
		$this->Latitude = $Latitude;
	}	
	public function setLongitude($Longitude){
		$this->Longitude = $Longitude;
	}	
	public function setPlace($Place){
		$this->Place = $Place;
	}	
	public function setType($Type){
		$this->Type = $Type;
	}	
	public function setSessionID($SessionID){
		$this->SessionID = $SessionID;
	}	
	public function setDateTime($DateTime){
		$this->DateTime = $DateTime;
	}
	public function setMob($Mob){
		$this->Mob = $Mob;
	}


	public function v4_LogUser(){
		$this->connection->CloseMysql();
	}	


}