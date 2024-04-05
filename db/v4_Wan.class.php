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

Class v4_WAN {

	public $ID; //int(10)
  	public $Title; //varchar(20)
  	public $Body; //varchar(255)
  	public $UserID; //int(10)
  	public $Phone; //int(10)
  	public $SendRule; //text
  	public $ScheduleTime; //datetime
  	public $SendTimeFirst; //datetime
  	public $SendTimeLast; //datetime
  	public $ConfirmTime; //datetime
  	public $SendNumber; //tinyint(1)
  	public $Status; //tinyint(1)
	public $Direction; //tinyint(1)
	public $OwnerID; //int(11)

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
	public function New_v4_WAN($Title,$Body,$UserID,$Phone,$SendRule,$ScheduleTime,$SendTimeFirst,$SendTimeLast,$ConfirmTime,$SendNumber,$Status,$Direction,$OwnerID){
		$this->Title = $Title;
		$this->Body = $Body;
		$this->UserID = $UserID;
		$this->Phone = $Phone;
		$this->SendRule = $SendRule;
		$this->ScheduleTime = $ScheduleTime;
		$this->SendTimeFirst = $SendTimeFirst;
		$this->SendTimeLast = $SendTimeLast;
		$this->ConfirmTime = $ConfirmTime;
		$this->SendNumber = $SendNumber;
		$this->Status = $Status;
		$this->Direction = $Direction;
		$this->OwnerID = $OwnerID;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function getRow($key_row){
		$result = $this->connection->RunQuery("Select * from v4_WAN where ID = \"$key_row\" ");
		if($result->num_rows < 1) return false;
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->ID = $row["ID"];
			$this->Title = $row["Title"];
			$this->Body = $row["Body"];
			$this->UserID = $row["UserID"];
			$this->Phone = $row["Phone"];
			$this->SendRule = $row["SendRule"];
			$this->ScheduleTime = $row["ScheduleTime"];
			$this->SendTimeFirst = $row["SendTimeFirst"];
			$this->SendTimeLast = $row["SendTimeLast"];
			$this->ConfirmTime = $row["ConfirmTime"];
			$this->SendNumber = $row["SendNumber"];
			$this->Status = $row["Status"];
			$this->Direction = $row["Direction"];
			$this->OwnerID = $row["OwnerID"];

		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function deleteRow($key_row){
		$this->connection->RunQuery("DELETE FROM v4_WAN WHERE ID = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function saveRow(){
		$result = $this->connection->RunQuery("UPDATE v4_WAN set 
Title = '".$this->myreal_escape_string($this->Title)."', 
Body = '".$this->myreal_escape_string($this->Body)."', 
UserID = '".$this->myreal_escape_string($this->UserID)."', 
Phone = '".$this->myreal_escape_string($this->Phone)."', 
SendRule = '".$this->myreal_escape_string($this->SendRule)."', 
ScheduleTime = '".$this->myreal_escape_string($this->ScheduleTime)."', 
SendTimeFirst = '".$this->myreal_escape_string($this->SendTimeFirst)."',
SendTimeLast = '".$this->myreal_escape_string($this->SendTimeLast)."',
ConfirmTime = '".$this->myreal_escape_string($this->ConfirmTime)."',
SendNumber = '".$this->myreal_escape_string($this->SendNumber)."',
Direction = '".$this->myreal_escape_string($this->Direction)."',
OwnerID = '".$this->myreal_escape_string($this->OwnerID)."',
Status = '".$this->myreal_escape_string($this->Status)."' WHERE ID = '".$this->ID."'");
	return $result; 
}

    /**
     * Save the active var class as a new row on table
     */
	public function saveAsNew(){
		$this->connection->RunQuery("INSERT INTO v4_WAN (
			OwnerID,
			Title, 
			Body, 
			UserID, 
			Phone, 
			SendRule,
			ScheduleTime, 
			SendTimeFirst,
			SendTimeLast,
			ConfirmTime,
			SendNumber,
			Direction,			
			Status
		) values (
		'".$this->myreal_escape_string($this->OwnerID)."', 
		'".$this->myreal_escape_string($this->Title)."', 
		'".$this->myreal_escape_string($this->Body)."', 
		'".$this->myreal_escape_string($this->UserID)."', 
		'".$this->myreal_escape_string($this->Phone)."', 
		'".$this->myreal_escape_string($this->SendRule)."', 
		'".$this->myreal_escape_string($this->ScheduleTime)."',
		'".$this->myreal_escape_string($this->SendTimeFirst)."',
		'".$this->myreal_escape_string($this->SendTimeLast)."',
		'".$this->myreal_escape_string($this->ConfirmTime)."',
		'".$this->myreal_escape_string($this->SendNumber)."',
		'".$this->myreal_escape_string($this->Direction)."',
		'".$this->myreal_escape_string($this->Status)."'
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
		// echo "SELECT TunnelPassID from v4_TunnelPass $where ORDER BY $column $order";
		$result = $this->connection->RunQuery("SELECT ID from v4_WAN $where ORDER BY $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["ID"];
				$i++;
			}
	return $keys;
	}

	// GET METHODS:

	/**
	 * @return ID - int(10) unsigned
	 */
	public function getID(){
		return $this->ID;
	}

	/**
	 * @return Title - varchar(20)
	 */
	public function getTitle(){
		return $this->Title;
	}

	/**
	 * @return Body - varchar(255)
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
	 * @return Phone - text
	 */
	public function getPhone(){
		return $this->Phone;
	}

	/**
	 * @return SendRule - text
	 */
	public function getSendRule(){
		return $this->SendRule;
	}

	/**
	 * @return ScheduleTime - datetime
	 */
	public function getScheduleTime(){
		return $this->ScheduleTime;
	}	
	/**
	 * @return SendTimeFirst - datetime
	 */
	public function getSendTimeFirst(){
		return $this->SendTimeFirst;
	}

	/**
	 * @return SendTimeLast - datetime
	 */
	public function getSendTimeLast(){
		return $this->SendTimeLast;
	}

	/**
	 * @return ConfirmTime - datetime
	 */
	public function getConfirmTime(){
		return $this->ConfirmTime;
	}

	/**
	 * @return SendNumber - tinyint(1)
	 */
	public function getSendNumber(){
		return $this->SendNumber;
	}

	/**
	 * @return Status - tinyint(1)
	 */
	public function getStatus(){
		return $this->Status;
	}

	/**
	 * @return Direction - tinyint(1)
	 */
	public function getDirection(){
		return $this->Direction;
	}

	/**
	 * @return OwnerID - int(11)
	 */
	public function getOwnerID(){
		return $this->OwnerID;
	}


	// SET METHODS:

	/**
	 * @return ID - int(10) unsigned
	 */
	public function setID($ID){
		$this->ID = $ID;
	}

	/**
	 * @return Title - varchar(20)
	 */
	public function setTitle($Title){
		$this->Title = $Title;
	}

		/**
	 * @return Body - varchar(255)
	 */
	public function setBody($Body){
		$this->Body = $Body;
	}

	/**
	 * @return UserID - int(10) unsigned
	 */
	public function setUserID($UserID){
		$this->UserID = $UserID;
	}	
	
	/**
	 * @return Phone - text
	 */
	public function setPhone($Phone){
		$this->Phone = $Phone;
	}

	/**
	 * @return SendRule - text
	 */
	public function setSendRule($SendRule){
		$this->SendRule = $SendRule;
	}

	/**
	 * @return ScheduleTime - datetime
	 */
	public function setScheduleTime($ScheduleTime){
		$this->ScheduleTime = $ScheduleTime;
	}	
	/**
	 * @return SendTimeFirst - datetime
	 */
	public function setSendTimeFirst($SendTimeFirst){
		$this->SendTimeFirst = $SendTimeFirst;
	}

	/**
	 * @return SendTimeLast - datetime
	 */
	public function setSendTimeLast($SendTimeLast){
		$this->SendTimeLast = $SendTimeLast;
	}

	/**
	 * @return ConfirmTime - datetime
	 */
	public function setConfirmTime($ConfirmTime){
		$this->ConfirmTime = $ConfirmTime;
	}

	/**
	 * @return SendNumber - tinyint(1)
	 */
	public function setSendNumber($SendNumber){
		$this->SendNumber = $SendNumber;
	}

	/**
	 * @return Status - tinyint(1)
	 */
	public function setStatus($Status){
		$this->Status = $Status;
	}

	/**
	 * @return Direction - tinyint(1)
	 */
	public function setDirection($Direction){
		$this->Direction = $Direction;
	}

	/**
	 * @return OwnerID - int(11)
	 */
	public function setOwnerID($OwnerID){
		$this->OwnerID = $OwnerID;
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
			'Body' => $this->getBody(),
			'UserID' => $this->getUserID(),
			'Phone' => $this->getPhone(),
			'SendRule' => $this->getSendRule(),
			'ScheduleTime' => $this->getScheduleTime(),
			'SendTimeFirst' => $this->getSendTimeFirst(),
			'SendTimeLast' => $this->getSendTimeLast(),
			'ConfirmTime' => $this->getConfirmTime(),
			'SendNumber' => $this->getSendNumber(),
			'Status' => $this->getStatus(),		
			'Direction' => $this->getDirection(),		
			'OwnerID' => $this->getOwnerID()
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
			'ID',
			'Title',
			'Body',
			'UserID',
			'Phone',
			'SendRule',
			'ScheduleTime',
			'SendTimeFirst',
			'SendTimeLast', 
			'ConfirmTime',
			'SendNumber',
			'Status',
			'Direction',
			'OwnerID'
		);
		return $fieldNames;
	}
    /**
     * Close mysql connection
     */
	public function endv4_WAN(){
		$this->connection->CloseMysql();
	}

}