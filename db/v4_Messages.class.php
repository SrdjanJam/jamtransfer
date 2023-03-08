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

Class v4_Messages {

	public $ID; //int(10) unsigned
	public $PageID; //int(10) unsigned
	public $FromName; //varchar(255)
	public $PageLink; //varchar(255)
	public $Body; //text
	public $UserID; //int(10) unsigned
	public $DateTime; //datetime
	public $UserLevel; //tinyint(4) unsigned
	public $Status; //tinyint(1)
	
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
	public function New_v4_Messages($PageID,$FromName,$PageLink,$Body,$UserID,$DateTime,$UserLevel,$Status){
		$this->PageID = $PageID;
		$this->FromName = $FromName;
		$this->PageLink = $PageLink;
		$this->Body = $Body;
		$this->UserID = $UserID;
		$this->DateTime = $DateTime;
		$this->UserLevel = $UserLevel;
		$this->Status = $Status;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name;
     *
     * @param key_table_type $key_row
     *
     */
	public function getRow($key_row){
		$result = $this->connection->RunQuery("Select * from v4_Messages where ID = \"$key_row\" ");
		if($result->num_rows < 1) return false;
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->ID = $row["ID"];
			$this->PageID = $row["PageID"];
			$this->FromName = $row["FromName"];
			$this->PageLink = $row["PageLink"];
			$this->Body = $row["Body"];
			$this->UserID = $row["UserID"];
			$this->DateTime = $row["DateTime"];
			$this->UserLevel = $row["UserLevel"];
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
		$this->connection->RunQuery("DELETE FROM v4_Messages WHERE ID = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function saveRow(){
		$result = $this->connection->RunQuery("UPDATE v4_Messages set
PageID = '".$this->myreal_escape_string($this->PageID)."',
FromName = '".$this->myreal_escape_string($this->FromName)."',
PageLink = '".$this->myreal_escape_string($this->PageLink)."',
Body = '".$this->myreal_escape_string($this->Body)."',
UserID = '".$this->myreal_escape_string($this->UserID)."',
DateTime = '".$this->myreal_escape_string($this->DateTime)."',
UserLevel = '".$this->myreal_escape_string($this->UserLevel)."',
Status = '".$this->myreal_escape_string($this->Status)."' WHERE ID = '".$this->ID."'");
	return $result;
}

    /**
     * Save the active var class as a new row on table
     */
	public function saveAsNew(){
		$this->connection->RunQuery("INSERT INTO v4_Messages (PageID, FromName, PageLink, Body, UserID, DateTime, UserLevel, Status) values ('".$this->myreal_escape_string($this->PageID)."', '".$this->myreal_escape_string($this->FromName)."', '".$this->myreal_escape_string($this->PageLink)."', '".$this->myreal_escape_string($this->Body)."', '".$this->myreal_escape_string($this->UserID)."', '".$this->myreal_escape_string($this->DateTime)."', '".$this->myreal_escape_string($this->UserLevel)."', '".$this->myreal_escape_string($this->Status)."')");
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
		$result = $this->connection->RunQuery("SELECT ID from v4_Messages $where ORDER BY $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["ID"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return ID - int(10) unsigned
	 */
	public function getID(){
		return $this->ID;
	}

	/**
	 * @return PageID - int(10) unsigned
	 */
	public function getPageID(){
		return $this->PageID;
	}

	/**
	 * @return FromName - varchar(255)
	 */
	public function getFromName(){
		return $this->FromName;
	}

	/**
	 * @return PageLink - varchar(255)
	 */
	public function getPageLink(){
		return $this->PageLink;
	}

	/**
	 * @return Body - text
	 */
	public function getBody(){
		return $this->Body;
	}

	/**
	 * @return UserID - int(10) unsigned
	 */
	public function getUserID(){
		return $this->UserID;
	}

	/**
	 * @return DateTime - datetime
	 */
	public function getDateTime(){
		return $this->DateTime;
	}

	/**
	 * @return UserLevel - tinyint(4) unsigned
	 */
	public function getUserLevel(){
		return $this->UserLevel;
	}

	/**
	 * @return Status - tinyint(1)
	 */
	public function getStatus(){
		return $this->Status;
	}

	/**
	 * @param Type: int(10) unsigned
	 */
	public function setID($ID){
		$this->ID = $ID;
	}

	/**
	 * @param Type: int(10) unsigned
	 */
	public function setPageID($PageID){
		$this->PageID = $PageID;
	}

	/**
	 * @param Type: varchar(255)
	 */
	public function setFromName($FromName){
		$this->FromName = $FromName;
	}

	/**
	 * @param Type: varchar(255)
	 */
	public function setPageLink($PageLink){
		$this->PageLink = $PageLink;
	}

	/**
	 * @param Type: text
	 */
	public function setBody($Body){
		$this->Body = $Body;
	}

	/**
	 * @param Type: int(10) unsigned
	 */
	public function setUserID($UserID){
		$this->UserID = $UserID;
	}

	/**
	 * @param Type: datetime
	 */
	public function setDateTime($DateTime){
		$this->DateTime = $DateTime;
	}

	/**
	 * @param Type: tinyint(4) unsigned
	 */
	public function setUserLevel($UserLevel){
		$this->UserLevel = $UserLevel;
	}

	/**
	 * @param Type: tinyint(1)
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
			'PageID' => $this->getPageID(),
			'FromName' => $this->getFromName(),
			'PageLink' => $this->getPageLink(),
			'Body' => $this->getBody(),
			'UserID' => $this->getUserID(),
			'DateTime' => $this->getDateTime(),
			'UserLevel' => $this->getUserLevel(),
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
			'ID',			'PageID',			'FromName',			'PageLink',			'Body',			'UserID',			'DateTime',			'UserLevel',			'Status'		);
		return $fieldNames;
	}
    /**
     * Close mysql connection
     */
	public function endv4_Messages(){
		$this->connection->CloseMysql();
	}

}
