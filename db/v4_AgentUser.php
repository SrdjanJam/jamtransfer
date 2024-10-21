<?php

require_once 'db.class.php';

Class v4_AgenUser {

	public $AgentID; //int(10)
	public $AuthUserID; //int(10)

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
	public function v4_AgenUser($AgentID,$AuthUserID){
		$this->AgentID = $AgentID;
		$this->AuthUserID = $AuthUserID;	
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function getRow($key_row){
		$result = $this->connection->RunQuery("Select * from v4_AgenUser where AgentID = \"$key_row\" ");
		if($result->num_rows < 1) return false;
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->AgentID = $row["AgentID"];
			$this->AuthUserID = $row["AuthUserID"];		
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function deleteRow($key_row){
		$this->connection->RunQuery("DELETE FROM v4_AgenUser WHERE AgentID = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function saveRow(){
		$result = $this->connection->RunQuery("UPDATE v4_AgenUser set  
		AuthUserID = '".$this->myreal_escape_string($this->AuthUserID)."' 
 		WHERE AgentID = '".$this->AgentID."'");
		return $result; 
}

    /**
     * Save the active var class as a new row on table
     */
	public function saveAsNew(){
		$this->connection->RunQuery("INSERT INTO v4_AgenUser (AuthUserID) values (
		'".$this->myreal_escape_string($this->AuthUserID)."')");
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
		$result = $this->connection->RunQuery("SELECT AgentID from v4_AgenUser $where ORDER BY $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["AgentID"];
				$i++;
			}
		return $keys;
	}

	/**
	 * @return AgentID - int(10)
	 */
	public function getAgentID(){
		return $this->AgentID;
	}

	/**
	 * @return AuthUserID - int(10)
	 */
	public function getAuthUserID(){
		return $this->AuthUserID;
	}


// SET METHODS:

	/**
	 * @param Type: int(10)
	 */
	public function setAgentID($AgentID){
		$this->AgentID = $AgentID;
	}

	/**
	 * @param Type: int(10)
	 */
	public function setAuthUserID($AuthUserID){
		$this->AuthUserID = $AuthUserID;
	}

    /**
     * fieldValues - Load all fieldNames and fieldValues into Array. 
     *
     * @param 
     * 
     */
	public function fieldValues(){
		$fieldValues = array(
			'AgentID' => $this->getAgentID(),
			'AuthUserID' => $this->getAuthUserID()
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
			'AgentID', 
			'AuthUserID'
		);
		return $fieldNames;
	}
    /**
     * Close mysql connection
     */
	public function endv4_AgenUser(){
		$this->connection->CloseMysql();
	}

}