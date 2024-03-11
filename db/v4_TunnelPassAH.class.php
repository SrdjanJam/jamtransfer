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

Class v4_TunnelPassAH {

	public $ID; //int(11)
	public $TunnelPassID; //int(10)
  	public $AssignSDID; //int(11)
  	public $AssignTime; //datetime
	public $Status; //tinyint(4)

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
	public function New_v4_TunnelPassAH($TunnelPassID, $AssignSDID,$AssignTime,$Status){
		$this->TunnelPassID = $TunnelPassID;
		$this->AssignSDID = $AssignSDID;
		$this->AssignTime = $AssignTime;
		$this->Status = $Status;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function getRow($key_row){
		$result = $this->connection->RunQuery("Select * from v4_TunnelPassAH where ID = \"$key_row\" ");
		if($result->num_rows < 1) return false;
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->ID = $row["ID"];
			$this->TunnelPassID = $row["TunnelPassID"];
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
		$this->connection->RunQuery("DELETE FROM v4_TunnelPassAH WHERE ID = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function saveRow(){
		$result = $this->connection->RunQuery("UPDATE v4_TunnelPassAH set
TunnelPassID = '".$this->myreal_escape_string($this->TunnelPassID)."',
AssignSDID = '".$this->myreal_escape_string($this->AssignSDID)."',
AssignTime = '".$this->myreal_escape_string($this->AssignTime)."',
Status = '".$this->myreal_escape_string($this->Status)."' WHERE ID = '".$this->ID."'");
	return $result; 
}

    /**
     * Save the active var class as a new row on table
     */
	public function saveAsNew(){
		$this->connection->RunQuery("INSERT INTO v4_TunnelPassAH (
			TunnelPassID, 
			AssignSDID,
			AssignTime,
			Status
		) values (
		'".$this->myreal_escape_string($this->TunnelPassID)."', 
		'".$this->myreal_escape_string($this->AssignSDID)."',
		'".$this->myreal_escape_string($this->AssignTime)."',
		'".$this->myreal_escape_string($this->Status)."')");
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
		// echo "SELECT TunnelPassID from v4_TunnelPass $where ORDER BY $column $order";
		$result = $this->connection->RunQuery("SELECT ID from v4_TunnelPassAH $where ORDER BY $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["ID"];
				$i++;
			}
	return $keys;
	}

	// GET METHODS:

	/**
	 * @return ID - int(11)
	 */
	public function getID(){
		return $this->ID;
	}

	/**
	 * @return TunnelPassID - int(10) unsigned
	 */
	public function getTunnelPassID(){
		return $this->TunnelPassID;
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
	 * @return Status - tinyint(4)
	 */
	public function getStatus(){
		return $this->Status;
	}


	// SET METHODS:

	/**
	 * @param Type - int(11)
	 */
	public function setID($ID){
		$this->ID = $ID;
	}

	/**
	 * @param Type - int(10)
	 */
	public function setTunnelPassID($TunnelPassID){
		$this->TunnelPassID = $TunnelPassID;
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
			'TunnelPassID' => $this->getTunnelPassID(),
			'AssignSDID' => $this->getAssignSDID(),
			'AssignTime' => $this->getAssignTime(),
			'Status' => $this->getStatus()		);
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
			'ID',
			'TunnelPassID',			
			'AssignSDID',
			'AssignTime',
			'Status'		
		);
		return $fieldNames;
	}
    /**
     * Close mysql connection
     */
	public function endv4_TunnelPassAH(){
		$this->connection->CloseMysql();
	}

}