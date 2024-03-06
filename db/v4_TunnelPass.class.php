<?php
/*
 * Author: Rafael Rocha
 *
 * Changes: Bogo Soic-Mirilovic bogo.split@gmail.com
 * 
 * Version of MYSQL_to_PHP: 1.1.1
 * 
 * License: LGPL 
 * 
 */
require_once 'db.class.php';

Class v4_TunnelPass {

	public $TunnelPassID; //int(10)
  	public $OwnerID; //int(10)
  	public $VehicleCategory; //tinyint(1)
  	public $TunnelPassCode; //text
  	public $ValidTo; //date
  	public $PassNumber; //int(2)
  	public $AssignSDID; //int(11)
  	public $AssignTime; //datetime
  	public $Active; //tinyint(4)

	public $connection;

	function __construct(){
		$this->connection = new DataBaseMysql();
	}	public function myreal_escape_string($string){
		return $this->connection->real_escape_string($string);
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->saveAsNew(); 
     *
     */
	public function New_v4_TunnelPass($OwnerID,$VehicleCategory,$TunnelPassCode,$ValidTo,$PassNumber,$AssignSDID,$AssignTime,$Active){
		$this->OwnerID = $OwnerID;
		$this->VehicleCategory = $VehicleCategory;
		$this->TunnelPassCode = $TunnelPassCode;
		$this->ValidTo = $ValidTo;
		$this->PassNumber = $PassNumber;
		$this->AssignSDID = $AssignSDID;
		$this->AssignTime = $AssignTime;
		$this->Active = $Active;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function getRow($key_row){
		$result = $this->connection->RunQuery("Select * from v4_TunnelPass where VehicleID = \"$key_row\" ");
		if($result->num_rows < 1) return false;
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->TunnelPassID = $row["TunnelPassID"];
			$this->OwnerID = $row["OwnerID"];
			$this->VehicleCategory = $row["VehicleCategory"];
			$this->TunnelPassCode = $row["TunnelPassCode"];
			$this->ValidTo = $row["ValidTo"];
			$this->PassNumber = $row["PassNumber"];
			$this->AssignSDID = $row["AssignSDID"];
			$this->AssignTime = $row["AssignTime"];
			$this->Active = $row["Active"];

		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function deleteRow($key_row){
		$this->connection->RunQuery("DELETE FROM v4_TunnelPass WHERE TunnelPassID = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function saveRow(){
		$result = $this->connection->RunQuery("UPDATE v4_TunnelPass set 
OwnerID = '".$this->myreal_escape_string($this->OwnerID)."', 
VehicleCategory = '".$this->myreal_escape_string($this->VehicleCategory)."', 
TunnelPassCode = '".$this->myreal_escape_string($this->TunnelPassCode)."', 
ValidTo = '".$this->myreal_escape_string($this->ValidTo)."', 
PassNumber = '".$this->myreal_escape_string($this->PassNumber)."', 
AssignSDID = '".$this->myreal_escape_string($this->AssignSDID)."',
AssignTime = '".$this->myreal_escape_string($this->AssignTime)."',
Active = '".$this->myreal_escape_string($this->Active)."' WHERE TunnelPassID = '".$this->TunnelPassID."'");
	return $result; 
}

    /**
     * Save the active var class as a new row on table
     */
	public function saveAsNew(){
		$this->connection->RunQuery("INSERT INTO v4_TunnelPass (
			OwnerID, 
			VehicleCategory, 
			TunnelPassCode, 
			ValidTo,
			PassNumber, 
			AssignSDID,
			AssignTime,
			Active
		) values (
		'".$this->myreal_escape_string($this->OwnerID)."', 
		'".$this->myreal_escape_string($this->VehicleCategory)."', 
		'".$this->myreal_escape_string($this->TunnelPassCode)."', 
		'".$this->myreal_escape_string($this->ValidTo)."', 
		'".$this->myreal_escape_string($this->PassNumber)."',
		'".$this->myreal_escape_string($this->AssignSDID)."',
		'".$this->myreal_escape_string($this->AssignTime)."',
		'".$this->myreal_escape_string($this->Active)."')");
		return $this->connection->insert_id(); //return insert_id 
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function getKeysBy($column, $order, $where = NULL){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT TunnelPassID from v4_TunnelPass $where ORDER BY $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["TunnelPassID"];
				$i++;
			}
	return $keys;
	}

	// GET METHODS:

	/**
	 * @return TunnelPassIDD - int(10) unsigned
	 */
	public function getTunnelPassID(){
		return $this->TunnelPassID;
	}

	/**
	 * @return OwnerID - int(10) unsigned
	 */
	public function getOwnerID(){
		return $this->OwnerID;
	}

	/**
	 * @return VehicleCategory - tinyint(1)
	 */
	public function getVehicleCategory(){
		return $this->VehicleCategory;
	}

	/**
	 * @return TunnelPassCode - text
	 */
	public function getTunnelPassCode(){
		return $this->TunnelPassCode;
	}

	/**
	 * @return ValidTo - date
	 */
	public function getValidTo(){
		return $this->ValidTo;
	}	
	/**
	 * @return PassNumber - int(2)
	 */
	public function getPassNumber(){
		return $this->PassNumber;
	}

	/**
	 * @return AssignSDID - int(11)
	 */
	public function getAssignSDID(){
		return $this->AssignSDID;
	}

	/**
	 * @return AssignTime - datetime
	 */
	public function getAssignTime(){
		return $this->AssignTime;
	}

	/**
	 * @return Active - tinyint(4)
	 */
	public function getActive(){
		return $this->Active;
	}


	// SET METHODS:

	/**
	 * @param Type - int(10)
	 */
	public function setTunnelPassID($TunnelPassID){
		$this->TunnelPassID = $TunnelPassID;
	}

	/**
	 * @param Type - int(10)
	 */
	public function setOwnerID($OwnerID){
		$this->OwnerID = $OwnerID;
	}

	/**
	 * @param Type - tinyint(1)
	 */
	public function setVehicleCategory($VehicleCategory){
		$this->VehicleCategory = $VehicleCategory;
	}

	/**
	 * @param Type - text
	 */
	public function setTunnelPassCode($TunnelPassCode){
		$this->TunnelPassCode = $TunnelPassCode;
	}

	/**
	 * @param Type - date
	 */
	public function setValidTo($ValidTo){
		$this->TunnelPassCode = $ValidTo;
	}

	/**
	 * @param Type - int(2)
	 */
	public function setPassNumber($PassNumber){
		$this->PassNumber = $PassNumber;
	}

	/**
	 * @param Type - int(11)
	 */
	public function setAssignSDID($AssignSDID){
		$this->AssignSDID = $AssignSDID;
	}

	/**
	 * @param Type - datetime
	 */
	public function setAssignTime($AssignTime){
		$this->AssignTime = $AssignTime;
	}

	/**
	 * @param Type - tinyint(4)
	 */
	public function setActive($Active){
		$this->Active = $Active;
	}


    /**
     * fieldValues - Load all fieldNames and fieldValues into Array. 
     *
     * @param 
     * 
     */
	public function fieldValues(){
		$fieldValues = array(
			'TunnelPassID' => $this->getTunnelPassID(),
			'OwnerID' => $this->getOwnerID(),
			'VehicleCategory' => $this->getVehicleCategory(),
			'TunnelPassCode' => $this->getTunnelPassCode(),
			'ValidTo' => $this->getValidTo(),
			'PassNumber' => $this->getPassNumber(),
			'AssignSDID' => $this->getAssignSDID(),
			'AssignTime' => $this->getAssignTime(),
			'Active' => $this->getActive()		);
		return $fieldValues;
	}
    /**
     * fieldNames - returns array of fieldNames 
     *
     * @param 
     * 
     */
	public function fieldNames(){
		$fieldNames = array(
			'TunnelPassID',			
			'OwnerID',			
			'VehicleCategory',			
			'TunnelPassCode',			
			'ValidTo',	 	
			'PassNumber',		
			'AssignSDID',
			'AssignTime',
			'Active'		
		);
		return $fieldNames;
	}
    /**
     * Close mysql connection
     */
	public function endv4_TunnelPass(){
		$this->connection->CloseMysql();
	}

}