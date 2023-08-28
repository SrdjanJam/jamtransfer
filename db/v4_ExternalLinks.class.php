<?php

require_once 'db.class.php';

Class v4_ExternalLinks {

	public $ID; //int(10)
	public $Title; //varchar(255)
	public $Url; //varchar(255)
	public $Image; //varchar(255)

	public $connection;

	function __construct(){
		$this->connection = new DataBaseMysql();
	}

	public function myreal_escape_string($string){
		return $this->connection->real_escape_string($string);
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->saveAsNew();
     *
     */
	public function New_v4_ExternalLinks($ID,$Title,$Url,$Image){
		$this->ID = $ID;
		$this->Title = $Title;
		$this->Url = $Url;
		$this->Image = $Image;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name;
     *
     * @param key_table_type $key_row
     *
     */
	public function getRow($key_row){
		$result = $this->connection->RunQuery("Select * from v4_ExternalLinks where ID = \"$key_row\" ");
		if($result->num_rows < 1) return false;
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->ID = $row["ID"];
			$this->Title = $row["Title"];
			$this->Url = $row["Url"];
			$this->Image = $row["Image"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function deleteRow($key_row){
		$this->connection->RunQuery("DELETE FROM v4_ExternalLinks WHERE ID = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function saveRow(){
		$result = $this->connection->RunQuery("UPDATE v4_ExternalLinks set
		Title = '".$this->myreal_escape_string($this->Title)."',
		Url = '".$this->myreal_escape_string($this->Url)."',
		Image = '".$this->myreal_escape_string($this->Image)."'
 		WHERE ID = '".$this->ID."'");
		return $result;
	}

    /**
     * Save the active var class as a new row on table
     */
	public function saveAsNew(){
		$this->connection->RunQuery("INSERT INTO v4_ExternalLinks (Title, Url, Image) values ('".$this->myreal_escape_string($this->ID)."',
		'".$this->myreal_escape_string($this->Title)."',
		'".$this->myreal_escape_string($this->Url)."',
		'".$this->myreal_escape_string($this->Image)."')");
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
		$result = $this->connection->RunQuery("SELECT ID from v4_ExternalLinks $where ORDER BY $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["ID"];
				$i++;
			}
		return $keys;
	}


	// GET METHODS:

	/**
	 * @return ID - int(10)
	 */
	public function getID(){
		return $this->ID;
	}

	/**
	 * @return Title - varchar(255)
	 */
	public function getTitle(){
		return $this->Title;
	}

	/**
	 * @return Url - varchar(255)
	 */
	public function getUrl(){
		return $this->Url;
	}

	/**
	 * @return Image - varchar(255)
	 */
	public function getImage(){
		return $this->Image;
	}


	// SET METHODS:

	/**
	 * @param Type: int(10)
	 */
	public function setID($ID){
		$this->ID = $ID;
	}

	/**
	 * @param Type: varchar(255)
	 */
	public function setTitle($Title){
		$this->Title = $Title;
	}

	/**
	 * @param Type: varchar(255)
	 */
	public function setUrl($Url){
		$this->Url = $Url;
	}

	/**
	 * @param Type: varchar(255)
	 */
	public function setImage($Image){
		$this->Image = $Image;
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
			'Title' => $this->getTitle(),
			'Url' => $this->getUrl(),
			'Image' => $this->getImage()
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
			'ID',			'Title',		'Url',			'Image',		'Price'		);
		return $fieldNames;
	}
    /**
     * Close mysql connection
     */
	public function endv4_ExternalLinks(){
		$this->connection->CloseMysql();
	}

}
