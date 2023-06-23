<?php

require_once 'db.class.php';

Class v4_Statuses {

	public $ID; //int(10)
	public $Type; //int(10)
	public $Value; //int(10)
	public $Description; //varchar(255)

	public $connection;
	public $table;

	function __construct(){
		$this->connection = new DataBaseMysql();
		if (isset($_COOKIE['CMSLang']))  $this->table = "v4_Statuses_".$_COOKIE['CMSLang'];
		else $this->table = "v4_Statuses_en";
	}	
	
		public function myreal_escape_string($string){
			return $this->connection->real_escape_string($string);
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->saveAsNew();
     *
     */
	public function New_v4_Statuses($ID,$Type,$Value,$Description){
		$this->ID = $ID;
		$this->Type = $Type;
		$this->Value = $Value;
		$this->Description = $Description;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name;
     *
     * @param key_table_type $key_row
     *
     */
	public function getRow($key_row){
		$result = $this->connection->RunQuery("Select * from ". $this->table." where ID = \"$key_row\" ");
		if($result->num_rows < 1) return false;
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->ID = $row["ID"];
			$this->Type = $row["Type"];
			$this->Value = $row["Value"];
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
		$this->connection->RunQuery("DELETE FROM ". $this->table." WHERE ID = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function saveRow(){
		$result = $this->connection->RunQuery("UPDATE ". $this->table." set
ID = '".$this->myreal_escape_string($this->ID)."',
Type = '".$this->myreal_escape_string($this->Type)."',
Value = '".$this->myreal_escape_string($this->Value)."',
Description = '".$this->myreal_escape_string($this->Description)."',
 WHERE ID = '".$this->ID."'");
	return $result;
}

    /**
     * Save the active var class as a new row on table
     */
	public function saveAsNew(){
		$this->connection->RunQuery("INSERT INTO ". $this->table." (ID, Type, Value, Description) values ('".$this->myreal_escape_string($this->ID)."',
		'".$this->myreal_escape_string($this->Type)."',
		'".$this->myreal_escape_string($this->Value)."',
		'".$this->myreal_escape_string($this->Description)."'
		)");
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
		$result = $this->connection->RunQuery("SELECT ID from ". $this->table." $where ORDER BY $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["ID"];
				$i++;
			}
	return $keys;
	}


	// Get methods:
	/**
	 * @return ID - int(10)
	 */
	public function getID(){
		return $this->ID;
	}

	/**
	 * @return Type - int(10)
	 */
	public function getType(){
		return $this->Type;
	}

	/**
	 * @return Value - int(10)
	 */
	public function getValue(){
		return $this->Value;
	}

	/**
	 * @return Description - varchar(255)
	 */
	public function getDescription(){
		return $this->Description;
	}


	// Set methods:
	public function setID($ID){
		$this->ID = $ID;
	}

	public function setType($Type){
		$this->Type = $Type;
	}

	public function setValue($Value){
		$this->Value = $Value;
	}

	public function setDescription($Description){
		$this->Description = $Description;
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
			'Type' => $this->getType(),
			'Value' => $this->getValue(),
			'Description' => $this->getDescription() );
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
			'ID',			'Type',		'Value',			'Description'	);
		return $fieldNames;
	}
    /**
     * Close mysql connection
     */
	public function endv4_Statuses(){
		$this->connection->CloseMysql();
	}

}
