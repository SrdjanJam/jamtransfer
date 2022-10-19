<?php

require_once 'db.class.php';

Class v4_LanguageLines {

	public $id; //int(20) unsigned
	public $group; //varchar(255)
	public $key; //varchar(255)
	public $text; //text
	public $created_at; //timestamp
	public $updated_at; //timestamp

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
	public function New_v4_LanguageLines($id,$group,$key,$text,$created_at,$updated_at){
		$this->id = $id;
		$this->group = $group;
		$this->key = $key;
		$this->text = $text;
		$this->created_at = $created_at;
		$this->updated_at = $updated_at;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function getRow($key_row){
		$result = $this->connection->RunQuery("Select * from v4_LanguageLines where id = \"$key_row\" ");
		if($result->num_rows < 1) return false;
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->id = $row["id"];
			$this->group = $row["group"];
			$this->key = $row["key"];
			$this->text = $row["text"];
			$this->created_at = $row["created_at"];
			$this->updated_at = $row["updated_at"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function deleteRow($key_row){
		$this->connection->RunQuery("DELETE FROM v4_LanguageLines WHERE id = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function saveRow(){
		$result = $this->connection->RunQuery("UPDATE v4_LanguageLines set 
		`group` = '".$this->myreal_escape_string($this->group)."', 
		`key` = '".$this->myreal_escape_string($this->key)."', 
		`text` = '".$this->myreal_escape_string($this->text)."', 
		`created_at` = '".$this->myreal_escape_string($this->created_at)."', 
		`updated_at` = '".$this->myreal_escape_string($this->updated_at)."' WHERE id = '".$this->id."'");
	return $result; 
}

    /**
     * Save the active var class as a new row on table
     */
	public function saveAsNew(){
		$this->connection->RunQuery("INSERT INTO v4_LanguageLines (group, key, text, created_at, updated_at) values ('".$this->myreal_escape_string($this->group)."', '".$this->myreal_escape_string($this->key)."', '".$this->myreal_escape_string($this->text)."', '".$this->myreal_escape_string($this->created_at)."', '".$this->myreal_escape_string($this->updated_at)."')");
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
		$result = $this->connection->RunQuery("SELECT id from v4_LanguageLines $where ORDER BY $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["id"];
				$i++;
			}
	return $keys;
	}

	public function getid(){
		return $this->id;
	}
	public function getgroup(){
		return $this->group;
	}
	public function getkey(){
		return $this->key;
	}
	public function gettext(){
		return $this->text;
	}
	public function getcreated_at(){
		return $this->created_at;
	}
	public function getupdated_at(){
		return $this->updated_at;
	}
	
	public function setid($id){
		$this->id=$id;
	}
	public function setgroup($group){
		$this->group=$group;
	}
	public function setkey($key){
		$this->key=$key;
	}
	public function settext($text){
		$this->text=$text;
	}
	public function setcreated_at($created_at){
		$this->created_at=$created_at;
	}
	public function setupdated_at($updated_at){
		$this->updated_at=$updated_at;
	}
	
	public function fieldValues(){
		$fieldValues = array(
			'id' => $this->getid(),
			'group' => $this->getgroup(),
			'key' => $this->getkey(),
			'text' => $this->getText(),
			'created_at' => $this->getcreated_at(),
			'updated_at' => $this->getupdated_at()
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
			'id',		'group',			'key',			'text',			'created_at',			'updated_at'		);
		return $fieldNames;
	}

    /**
     * Close mysql connection
     */
	public function endv4_LanguageLines(){
		$this->connection->CloseMysql();
	}

}