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

Class v4_Terminals {

	public $TerminalID; //int(10) unsigned
	public $MP; //int(1)
	public $ImageMP; //varchar(255)
	public $ImageBG; //varchar(255)
	public $MPOrder; //int(2)
	public $Description; //longtext
	
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
	public function New_v4_Terminals($TerminalID,$MP,$ImageMP,$ImageBG,$MPOrder,$Description){
		$this->TerminalID = $TerminalID; // Check
		$this->MP = $MP;
		$this->ImageMP = $ImageMP;
		$this->ImageBG = $ImageBG;
		$this->MPOrder = $MPOrder;
		$this->Description = $Description;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function getRow($key_row){
		$result = $this->connection->RunQuery("Select * from v4_Terminals where TerminalID = \"$key_row\" ");
		if($result->num_rows < 1) return false;
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->TerminalID = $row["TerminalID"];
			$this->MP = $row["MP"];
			$this->ImageMP = $row["ImageMP"];
			$this->ImageBG = $row["ImageBG"];
			$this->MPOrder = $row["MPOrder"];
			$this->Description = $row["Description"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function deleteRow($key_row){
		$this->connection->RunQuery("DELETE FROM v4_Terminals WHERE TerminalID = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function saveRow(){
		$result = $this->connection->RunQuery("UPDATE v4_Terminals set 
		TerminalID = '".$this->myreal_escape_string($this->TerminalID)."', 
		MP = '".$this->myreal_escape_string($this->MP)."', 
		ImageMP = '".$this->myreal_escape_string($this->ImageMP)."', 
		ImageBG = '".$this->myreal_escape_string($this->ImageBG)."', 
		MPOrder = '".$this->myreal_escape_string($this->MPOrder)."', 
		Description = JSON_MERGE_PATCH(`Description`,'".$this->Description."') WHERE TerminalID = '".$this->TerminalID."'");
		return $result; 
	}


    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function getKeysBy($column, $order, $where = NULL){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT TerminalID from v4_Terminals,v4_Places $where and TerminalID=PlaceID ORDER BY $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["TerminalID"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return TerminalID - int(10) unsigned
	 */
	public function getTerminalID(){
		return $this->TerminalID;
	}

	/**
	 * @return MP - int(10) unsigned
	 */
	public function getMP(){
		return $this->MP;
	}

	/**
	 * @return ImageMP - varchar(255)
	 */
	public function getImageMP(){
		return $this->ImageMP;
	}

	/**
	 * @return ImageBG - varchar(255)
	 */
	public function getImageBG(){
		return $this->ImageBG;
	}

	/**
	 * @return MPOrder - varchar(255)
	 */
	public function getMPOrder(){
		return $this->MPOrder;
	}

	/**
	 * @return Description - varchar(255)
	 */
	public function getDescription(){
		return $this->Description;
	}

	

	public function setTerminalID($TerminalID){
		$this->TerminalID = $TerminalID;
	}

	/**
	 * @param Type: int(10) unsigned
	 */
	public function setMP($MP){
		$this->MP = $MP;
	}

	/**
	 * @param Type: int(1)
	 */
	public function setImageMP($ImageMP){
		$this->ImageMP = $ImageMP;
	}

	/**
	 * @param Type: varchar(255)
	 */
	public function setImageBG($ImageBG){
		$this->ImageBG = $ImageBG;
	}

	/**
	 * @param Type: varchar(255)
	 */
	public function setMPOrder($MPOrder){
		$this->MPOrder = $MPOrder;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setDescription($Description){
		$this->Description = $Description;
	}

	/**
	 * @param Type: longtext
	 */
	
	
    /**
     * fieldValues - Load all fieldNames and fieldValues into Array. 
     *
     * @param 
     * 
     */
	public function fieldValues(){
		$fieldValues = array(
			'TerminalID' => $this->getTerminalID(),
			'MP' => $this->getMP(),
			'ImageMP' => $this->getImageMP(),
			'ImageBG' => $this->getImageBG(),
			'MPOrder' => $this->getMPOrder(),
			'Description' => $this->getDescription()	);
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
			'TerminalID',			'MP',			'ImageMP',			'ImageBG',			'MPOrder',			'Description'		);
		return $fieldNames;
	}
    /**
     * Close mysql connection
     */
	public function endv4_Terminals(){
		$this->connection->CloseMysql();
	}

}