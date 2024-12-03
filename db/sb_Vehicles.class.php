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

Class sb_Vehicles {

	public $VehicleID; 
	public $OwnerID; 
	public $VehicleName; 
	public $Year; 
	public $MaxPax; 
	public $Type; 
	public $Picture; 
	public $PriceCoeff; 
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
	public function New_sb_Vehicles($OwnerID,$VehicleName,$Year,$MaxPax,$Type,$Picture,$PriceCoeff){
		$this->OwnerID = $OwnerID;
		$this->VehicleName = $VehicleName;
		$this->Year = $Year;
		$this->MaxPax = $MaxPax;
		$this->Type = $Type;
		$this->Picture = $Picture;
		$this->PriceCoeff = $PriceCoeff;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function getRow($key_row){
		$result = $this->connection->RunQuery("Select * from sb_Vehicles where VehicleID = \"$key_row\" ");
		if($result->num_rows < 1) return false;
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->VehicleID = $row["VehicleID"];
			$this->OwnerID = $row["OwnerID"];
			$this->VehicleName = $row["VehicleName"];
			$this->Year = $row["Year"];
			$this->MaxPax = $row["MaxPax"];
			$this->Type = $row["Type"];
			$this->Picture = $row["Picture"];
			$this->PriceCoeff = $row["PriceCoeff"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function deleteRow($key_row){
		$this->connection->RunQuery("DELETE FROM sb_Vehicles WHERE VehicleID = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function saveRow(){	
	$result = $this->connection->RunQuery("UPDATE sb_Vehicles set 
OwnerID = '".$this->myreal_escape_string($this->OwnerID)."', 
VehicleName = '".$this->myreal_escape_string($this->VehicleName)."', 
Year = '".$this->myreal_escape_string($this->Year)."', 
MaxPax = '".$this->myreal_escape_string($this->MaxPax)."', 
Type = '".$this->myreal_escape_string($this->Type)."', 
Picture = '".makeBLOB($this->Picture,200,150,0,255,255,255)."', 
PriceCoeff = '".$this->myreal_escape_string($this->PriceCoeff)."' WHERE VehicleID = '".$this->VehicleID."'");
	return $result; 
}

    /**
     * Save the active var class as a new row on table
     */
	public function saveAsNew(){
		$this->connection->RunQuery("INSERT IGNORE INTO sb_Vehicles (OwnerID, VehicleName, Year, MaxPax, Type, Picture, PriceCoeff) values (
		'".$this->myreal_escape_string($this->OwnerID)."',
		'".$this->myreal_escape_string($this->VehicleName)."',
		'".$this->myreal_escape_string($this->Year)."',
		'".$this->myreal_escape_string($this->MaxPax)."',
		'".$this->myreal_escape_string($this->Type)."',
		'".makeBLOB($this->Picture,200,150,0,255,255,255)."',
		'".$this->myreal_escape_string($this->PriceCoeff)."')");
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
		$result = $this->connection->RunQuery("SELECT VehicleID from sb_Vehicles $where ORDER BY $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["VehicleID"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return OwnerID - int(10) unsigned
	 */
	public function getOwnerID(){
		return $this->OwnerID;
	}

	/**
	 * @return VehicleID - int(10) unsigned
	 */
	public function getVehicleID(){
		return $this->VehicleID;
	}

	/**
	 * @return VehicleName - varchar(255)
	 */
	public function getVehicleName(){
		return $this->VehicleName;
	}

	/**
	 * @return Year - varchar(255)
	 */
	public function getYear(){
		return $this->Year;
	}	
	
	/**
	 * @return MaxPax - varchar(255)
	 */
	public function getMaxPax(){
		return $this->MaxPax;
	}	
	
	/**
	 * @return Type - varchar(255)
	 */
	public function getType(){
		return $this->Type;
	}

	/**
	 * @return Picture - int(5) unsigned
	 */
	public function getPicture(){
		return $this->Picture;
	}

	/**
	 * @return PriceCoeff - int(5) unsigned
	 */
	public function getPriceCoeff(){
		return $this->PriceCoeff;
	}

	/**
	 * @param Type: int(10) unsigned
	 */
	public function setOwnerID($OwnerID){
		$this->OwnerID = $OwnerID;
	}

	/**
	 * @param Type: int(10) unsigned
	 */
	public function setVehicleID($VehicleID){
		$this->VehicleID = $VehicleID;
	}

	/**
	 * @param Type: varchar(255)
	 */
	public function setVehicleName($VehicleName){
		$this->VehicleName = $VehicleName;
	}

	/**
	 * @param Type: varchar(255)
	 */
	public function setYear($Year){
		$this->Year = $Year;
	}	
	
	/**
	 * @param Type: varchar(255)
	 */
	public function setMaxPax($MaxPax){
		$this->MaxPax = $MaxPax;
	}	
	
	/**
	 * @param Type: varchar(255)
	 */
	public function setType($Type){
		$this->Type = $Type;
	}

	/**
	 * @param Type: int(5) unsigned
	 */
	public function setPicture($Picture){
		$this->Picture = $Picture;
	}

	/**
	 * @param Type: int(5) unsigned
	 */
	public function setPriceCoeff($PriceCoeff){
		$this->PriceCoeff = $PriceCoeff;
	}

    /**
     * fieldValues - Load all fieldNames and fieldValues into Array. 
     *
     * @param 
     * 
     */
	public function fieldValues(){
		$fieldValues = array(
			'OwnerID' => $this->getOwnerID(),
			'VehicleID' => $this->getVehicleID(),
			'VehicleName' => $this->getVehicleName(),
			'Year' => $this->getYear(),
			'MaxPax' => $this->getMaxPax(),
			'Type' => $this->getType(),
			'Picture' => $this->getPicture(),
			'PriceCoeff' => $this->getPriceCoeff()		);
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
			'OwnerID',			'VehicleID',			'VehicleName',			'Year',			'MaxPax',			'Type',				'PriceCoeff'		);
		return $fieldNames;
	}
    /**
     * Close mysql connection
     */
	public function endsb_Vehicles(){
		$this->connection->CloseMysql();
	}

}