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

Class v4_TopRoutes {

	public $TopRouteID; //int(10) unsigned
	public $Main; //int(1)
	public $Description; //varchar 255
	public $Visits;
	
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
	public function New_v4_TopRoutes($TopRouteID,$Main,$Description,$Visits){
		$this->TopRouteID = $TopRouteID; // Check
		$this->Main = $Main;
		$this->Description = $Description;
		$this->Visits = $Visits;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function getRow($key_row){
		$result = $this->connection->RunQuery("Select * from v4_TopRoutes where TopRouteID = \"$key_row\" ");
		if($result->num_rows < 1) return false;
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->TopRouteID = $row["TopRouteID"];
			$this->Main = $row["Main"];
			$this->Description = $row["Description"];
			$this->Visits = $row["Visits"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function deleteRow($key_row){
		$this->connection->RunQuery("DELETE FROM v4_TopRoutes WHERE TopRouteID = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function saveRow(){
		$result = $this->connection->RunQuery("UPDATE v4_TopRoutes set 
		TopRouteID = '".$this->myreal_escape_string($this->TopRouteID)."', 
		Main = '".$this->myreal_escape_string($this->Main)."',
		Visits = '".$this->myreal_escape_string($this->Visits)."',
		Description = JSON_MERGE_PATCH(`Description`,'".$this->Description."') WHERE TopRouteID = '".$this->TopRouteID."'");
		
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
		$result = $this->connection->RunQuery("SELECT TopRouteID from v4_TopRoutes $where ORDER BY $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["TopRouteID"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return TopRouteID - int(10) unsigned
	 */
	public function getTopRouteID(){
		return $this->TopRouteID;
	}

	/**
	 * @return Main - int(1)
	 */
	public function getMain(){
		return $this->Main;
	}

	/**
	 * @return Description - varchar(255)
	 */
	public function getDescription(){
		return $this->Description;
	}

	/** 
	* @return Visits - int(5)
	*/
	public function getVisits(){
		return $this->Visits;
	}
	

	public function setTopRouteID($TopRouteID){
		$this->TopRouteID = $TopRouteID;
	}

	/**
	 * @param Type: int(1)
	 */
	public function setMain($Main){
		$this->Main = $Main;
	}

	/**
	 * @param Type: varchar(255)
	 */
	public function setDescription($Description){
		$this->Description = $Description;
	}

	/**
	 * @param Type: int(5)
	 */
	public function setVisits($Visits){
		$this->Visits = $Visits;
	}

	


	public function fieldValues(){
		$fieldValues = array(
			'TopRouteID' => $this->getTopRouteID(),
			'Main' => $this->getMain(),
			'Description' => $this->getDescription(),
			'Visits' => $this->getVisits(),
		);
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
			'TopRouteID','Main', 'Description','Visits'	);
		return $fieldNames;
	}
    /**
     * Close mysql connection
     */
	public function endv4_Terminals(){
		$this->connection->CloseMysql();
	}

}