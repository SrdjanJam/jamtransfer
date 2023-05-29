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

Class v4_FieldsSettings {

	public $ID; //int(10)
	public $ModuleID; //int(10)
	public $Name; 
	public $Required; //int(1)
	public $Disabled; //int(1)	
	public $Hidden; //int(1)(255)
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
	public function New_v4_FieldsSettings($ID,$ModuleID,$Name,$Required,$Disabled,$Hidden){
		$this->ID = $ID;
		$this->ModuleID = $ModuleID;
		$this->Name = $Name;
		$this->Required = $Required;
		$this->Disabled = $Disabled;		
		$this->Hidden = $Hidden;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function getRow($key_row){
		$result = $this->connection->RunQuery("Select * from v4_FieldsSettings where ID = \"$key_row\" ");
		if($result->num_rows < 1) return false;
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->ID = $row["ID"];
			$this->ModuleID = $row["ModuleID"];
			$this->Name = $row["Name"];
			$this->Required = $row["Required"];
			$this->Disabled = $row["Disabled"];			
			$this->Hidden = $row["Hidden"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function deleteRow($key_row){
		$this->connection->RunQuery("DELETE FROM v4_FieldsSettings WHERE ID = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function saveRow(){
		$result = $this->connection->RunQuery("UPDATE v4_FieldsSettings set 
ID = '".$this->myreal_escape_string($this->ID)."', 
ModuleID = '".$this->myreal_escape_string($this->ModuleID)."', 
Name = '".$this->myreal_escape_string($this->Name)."', 
Required = '".$this->myreal_escape_string($this->Required)."', 
Disabled = '".$this->myreal_escape_string($this->Disabled)."', 
Hidden = '".$this->myreal_escape_string($this->Hidden)."'
 WHERE ID = '".$this->ID."'");
	return $result; 
}

    /**
     * Save the active var class as a new row on table
     */
	public function saveAsNew(){
		$this->connection->RunQuery("INSERT INTO v4_FieldsSettings (ID, ModuleID, Name, Required, Disabled, Hidden) values ('".$this->myreal_escape_string($this->ID)."',
		'".$this->myreal_escape_string($this->ModuleID)."',
		'".$this->myreal_escape_string($this->Name)."',
		'".$this->myreal_escape_string($this->Required)."',
		'".$this->myreal_escape_string($this->Disabled)."',		
		'".$this->myreal_escape_string($this->Hidden)."')");
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
		$result = $this->connection->RunQuery("SELECT ID from v4_FieldsSettings $where ORDER BY $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["ID"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return ID - int(10)
	 */
	public function getID(){
		return $this->ID;
	}	
	
	/**
	 * @return ModuleID - int(10)
	 */
	public function getModuleID(){
		return $this->ModuleID;
	}

	/**
	 * @return Name - int(10)
	 */
	public function getName(){
		return $this->Name;
	}
	
	/**
	 * @return Required - int(4)
	 */
	public function getRequired(){
		return $this->Required;
	}

	/**
	 * @return Disabled - int(4)
	 */
	public function getDisabled(){
		return $this->Disabled;
	}
	
	/**
	 * @return Hidden - varchar(255)
	 */
	public function getHidden(){
		return $this->Hidden;
	}


	
	/**
	 * @param Type: int(10)
	 */
	public function setID($ID){
		$this->ID = $ID;
	}
	
	/**
	 * @param Type: int(10)
	 */
	public function setModuleID($ModuleID){
		$this->ModuleID = $ModuleID;
	}	

	/**
	 * @param Type: int(10)
	 */
	public function setName($Name){
		$this->Name = $Name;
	}

	/**
	 * @param Type: int(4)
	 */
	public function setRequired($Required){
		$this->Required = $Required;
	}

	/**
	 * @param Type: int(4)
	 */
	public function setDisabled($Disabled){
		$this->Disabled = $Disabled;
	}
	
	/**
	 * @param Type: varchar(255)
	 */
	public function setHidden($Hidden){
		$this->Hidden = $Hidden;
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
			'ModuleID' => $this->getModuleID(),
			'Name' => $this->getName(),
			'Required' => $this->getRequired(),
			'Disabled' => $this->getDisabled(),			
			'Hidden' => $this->getHidden()		);
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
			'ID',			'ModuleID',		'ModuleID',		'Required',		'Disabled',			'Hidden'	);
		return $fieldNames;
	}
    /**
     * Close mysql connection
     */
	public function endv4_FieldsSettings(){
		$this->connection->CloseMysql();
	}

}