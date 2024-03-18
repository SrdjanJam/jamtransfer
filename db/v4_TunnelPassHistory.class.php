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

Class v4_TunnelPassHistory {

	public $ID; //int(11)
	public $TunnelPassID; //int(10)
  	public $PassSDID; //int(11)
  	public $PassTime; //datetime

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
	public function New_v4_TunnelPassHistory($TunnelPassID, $PassSDID,$PassTime){
		$this->TunnelPassID = $TunnelPassID;
		$this->PassSDID = $PassSDID;
		$this->PassTime = $PassTime;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function getRow($key_row){
		$result = $this->connection->RunQuery("Select * from v4_TunnelPassHistory where ID = \"$key_row\" ");
		if($result->num_rows < 1) return false;
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->ID = $row["ID"];
			$this->TunnelPassID = $row["TunnelPassID"];
			$this->PassSDID = $row["PassSDID"];
			$this->PassTime = $row["PassTime"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function deleteRow($key_row){
		$this->connection->RunQuery("DELETE FROM v4_TunnelPassHistory WHERE ID = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function saveRow(){
		$result = $this->connection->RunQuery("UPDATE v4_TunnelPassHistory set
TunnelPassID = '".$this->myreal_escape_string($this->TunnelPassID)."',
PassSDID = '".$this->myreal_escape_string($this->PassSDID)."',
PassTime = '".$this->myreal_escape_string($this->PassTime)."'");
	return $result; 
}

    /**
     * Save the active var class as a new row on table
     */
	public function saveAsNew(){
		$this->connection->RunQuery("INSERT INTO v4_TunnelPassHistory (
			TunnelPassID, 
			PassSDID,
			PassTime
		) values (
		'".$this->myreal_escape_string($this->TunnelPassID)."', 
		'".$this->myreal_escape_string($this->PassSDID)."',
		'".$this->myreal_escape_string($this->PassTime)."')");
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
		$result = $this->connection->RunQuery("SELECT ID from v4_TunnelPassHistory $where ORDER BY $column $order");
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
	 * @return PassSDID - int(11)
	 */
	public function getPassSDID(){
		return $this->PassSDID;
	}

	/**
	 * @return PassTime - datetime
	 */
	public function getPassTime(){
		return $this->PassTime;
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
	public function setPassSDID($PassSDID){
		$this->PassSDID = $PassSDID;
	}

	/**
	 * @param Type - datetime
	 */
	public function setPassTime($PassTime){
		$this->PassTime = $PassTime;
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
			'PassSDID' => $this->getPassSDID(),
			'PassTime' => $this->getPassTime());
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
			'PassSDID',
			'PassTime'
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