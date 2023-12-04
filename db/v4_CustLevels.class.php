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

Class v4_CustLevels {

	public $LevelID; //int(1)
	public $LevelName; //varchar(50)
	public $CountRange; //int(5)	
	public $ValueRange; //int(6)
	public $Discount; //decimal(10,2)

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
	public function New_v4_CustLevels($LevelID,$LevelName,$CountRange,$ValueRange,$Discount){
		$this->LevelID = $LevelID;
		$this->LevelName = $LevelName;
		$this->CountRange = $CountRange;		
		$this->ValueRange = $ValueRange;
		$this->Discount = $Discount;		
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function getRow($key_row){
		$result = $this->connection->RunQuery("Select * from v4_CustLevels where LevelID = \"$key_row\" ");
		if($result->num_rows < 1) return false;
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->LevelID = $row["LevelID"];
			$this->LevelName = $row["LevelName"];
			$this->CountRange = $row["CountRange"];			
			$this->ValueRange = $row["ValueRange"];
			$this->Discount = $row["Discount"];			
		}
	}

	 /**
     * Update the active row table on table
     */
	public function saveRow(){
		$result = $this->connection->RunQuery("UPDATE v4_CustLevels set
		LevelName = '".$this->myreal_escape_string($this->LevelName)."', 
		CountRange = '".$this->myreal_escape_string($this->CountRange)."', 
		ValueRange = '".$this->myreal_escape_string($this->ValueRange)."', 
		Discount = '".$this->myreal_escape_string($this->Discount)."'
 		WHERE LevelID = '".$this->LevelID."'");
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
		// echo "SELECT LevelID from v4_CustLevels $where ORDER BY $column $order"; test
		$result = $this->connection->RunQuery("SELECT LevelID from v4_CustLevels $where ORDER BY $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["LevelID"];
				$i++;
			}
		return $keys;
	}
   

	/**
	 * @return LevelID - int(1)
	 */
	public function getLevelID(){
		return $this->LevelID;
	}

	/**
	 * @return LevelName - varchar(50)
	 */
	public function getLevelName(){
		return $this->LevelName;
	}

	/**
	 * @return CountRange - int(5)
	 */
	public function getCountRange(){
		return $this->CountRange;
	}
	
	/**
	 * @return ValueRange - int(6)
	 */
	public function getValueRange(){
		return $this->ValueRange;
	}

	/**
	 * @return Discount - decimal(10,2)
	 */
	public function getDiscount(){
		return $this->Discount;
	}


	// SET: ====================================================
	
	/**
	 * @param Type: int(1)
	 */
	public function setLevelID($LevelID){
		$this->LevelID = $LevelID;
	}

	/**
	 * @param Type: varchar(50)
	 */
	public function setLevelName($LevelName){
		$this->LevelName = $LevelName;
	}

	/**
	 * @param Type: int(5)
	 */
	public function setCountRange($CountRange){
		$this->CountRange = $CountRange;
	}
	
	/**
	 * @param Type: int(5)
	 */
	public function setValueRange($ValueRange){
		$this->ValueRange = $ValueRange;
	}

	/**
	 * @param Type: decimal(10,2)
	 */
	public function setDiscount($Discount){
		$this->Discount = $Discount;
	}

    /**
     * fieldValues - Load all fieldNames and fieldValues into Array. 
     *
     * @param 
     * 
     */
	public function fieldValues(){
		$fieldValues = array(
			'LevelID' => $this->getLevelID(),
			'LevelName' => $this->getLevelName(),
			'CountRange' => $this->getCountRange(),			
			'ValueRange' => $this->getValueRange(),			
			'Discount' => $this->getDiscount()		);
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
			'LevelID',			'LevelName',		'CountRange',			'ValueRange',		'Discount'		);
		return $fieldNames;
	}
    /**
     * Close mysql connection
     */
	public function endv4_v4_CustLevels(){
		$this->connection->CloseMysql();
	}

}