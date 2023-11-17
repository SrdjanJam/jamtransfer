<?php
/*
 * Author: Rafael Rocha

 * Version of MYSQL_to_PHP: 1.1.1
 * 
 * License: LGPL 
 * 
 */
require_once 'db.class.php';

Class v4_SubVehiclesAH {

	public $ID; //int(10) unsigned
	public $VehicleID; //int(10) unsigned
	public $AssignSDID; //int(10) unsigned
	public $AssignTime; //int(10) unsigned
	public $Status; //tinyint(4)
	public $connection;

	function __construct(){
		$this->connection = new DataBaseMysql();
	}	public function myreal_escape_string($string){
		return $this->connection->real_escape_string($string);
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function getRow($key_row){
		$result = $this->connection->RunQuery("Select * from v4_SubVehiclesAH where ID = \"$key_row\" ");
		if($result->num_rows < 1) return false;
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->ID = $row["ID"];
			$this->VehicleID = $row["VehicleID"];
			$this->AssignSDID = $row["AssignSDID"];
			$this->AssignTime = $row["AssignTime"];
			$this->Status = $row["Status"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function deleteRow($key_row){
		$this->connection->RunQuery("DELETE FROM v4_SubVehiclesAH WHERE ID = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function saveRow(){
		$result = $this->connection->RunQuery("UPDATE v4_SubVehiclesAH set 
VehicleID = '".$this->myreal_escape_string($this->VehicleID)."', 
AssignSDID = '".$this->myreal_escape_string($this->AssignSDID)."', 
AssignTime = '".$this->myreal_escape_string($this->AssignTime)."', 
Status = '".$this->myreal_escape_string($this->Status)."' WHERE ID = '".$this->ID."'");
	return $result; 
}

    /**
     * Save the active var class as a new row on table
     */
	public function saveAsNew(){
		/*echo "INSERT INTO v4_SubVehiclesAH (
			VehicleID, 
			AssignSDID, 
			AssignTime, 
			Status
		) values (
		'".$this->myreal_escape_string($this->VehicleID)."', 
		'".$this->myreal_escape_string($this->AssignSDID)."',
		'".$this->myreal_escape_string($this->AssignTime)."',
		'".$this->myreal_escape_string($this->Status)."')";*/
		$this->connection->RunQuery("INSERT INTO v4_SubVehiclesAH (
			VehicleID, 
			AssignSDID, 
			AssignTime, 
			Status
		) values (
		'".$this->myreal_escape_string($this->VehicleID)."', 
		'".$this->myreal_escape_string($this->AssignSDID)."',
		'".$this->myreal_escape_string($this->AssignTime)."',
		'".$this->myreal_escape_string($this->Status)."')");
		//return $this->connection->insert_id(); //return insert_id 
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function getKeysBy($column, $order, $where = NULL){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT ID from v4_SubVehiclesAH $where ORDER BY $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["ID"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return ID - int(10) unsigned
	 */
	public function getID(){
		return $this->ID;
	}	
	
	/**
	 * @return VehicleID - int(10) unsigned
	 */
	public function getVehicleID(){
		return $this->VehicleID;
	}
	
	/**
	 * @return AssignSDID - int(10) unsigned
	 */
	public function getAssignSDID(){
		return $this->AssignSDID;
	}	
	/**
	 * @return AssignTime - int(10) unsigned
	 */
	public function getAssignTime(){
		return $this->AssignTime;
	}

	/**
	 * @return Status - tinyint(4)
	 */
	public function getStatus(){
		return $this->Status;
	}

	/**
	 * @param Type: int(10) unsigned
	 */
	public function setID($ID){
		$this->ID = $ID;
	}
	/**
	 * @param Type: int(10) unsigned
	 */
	public function setVehicleID($VehicleID){
		$this->VehicleID = $VehicleID;
	}	
	
	/**
	 * @param Type: int(10) unsigned
	 */
	public function setAssignSDID($AssignSDID){
		$this->AssignSDID = $AssignSDID;
	}	
	/**
	 * @param Type: int(10) unsigned
	 */
	public function setAssignTime($AssignTime){
		$this->AssignTime = $AssignTime;
	}

	/**
	 * @param Type: tinyint(4)
	 */
	public function setStatus($Status){
		$this->Status = $Status;
	}

    /**
     * fieldValues - Load all fieldNames and fieldValues into Array. 
     *
     * @param 
     * 
     */
	public function fieldValues(){
		$fieldValues = array(
			'ID' => $this->getID(),
			'VehicleID' => $this->getVehicleID(),
			'AssignSDID' => $this->getAssignSDID(),
			'AssignTime' => $this->getAssignTime(),
			'Status' => $this->getStatus()		);
		return $fieldValues;
	}


    /**
     * Close mysql connection
     */
	public function endv4_SubVehiclesAH(){
		$this->connection->CloseMysql();
	}

}