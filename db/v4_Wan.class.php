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

Class v4_Wan {

	public $ID; //int(10)
  	public $Title; //varchar(20)
  	public $Body; //varchar(255)
  	public $UserID; //int(10)
  	public $SendRule; //text
  	public $ScheduleTime; //datetime
  	public $SendTimeFirst; //datetime
  	public $SendTimeLast; //datetime
  	public $ConfirmTime; //datetime
  	public $SendNumber; //tinyint(1)
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
	public function New_v4_Wan($Title,$Body,$UserID,$SendRule,$ScheduleTime,$SendTimeFirst,$SendTimeLast,$ConfirmTime,$SendNumber,$Status){
		$this->Title = $Title;
		$this->Body = $Body;
		$this->UserID = $UserID;
		$this->SendRule = $SendRule;
		$this->ScheduleTime = $ScheduleTime;
		$this->SendTimeFirst = $SendTimeFirst;
		$this->SendTimeLast = $SendTimeLast;
		$this->ConfirmTime = $ConfirmTime;
		$this->SendNumber = $SendNumber;
		$this->Status = $Status;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function getRow($key_row){
		$result = $this->connection->RunQuery("Select * from v4_Wan where ID = \"$key_row\" ");
		if($result->num_rows < 1) return false;
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->ID = $row["ID"];
			$this->Title = $row["Title"];
			$this->Body = $row["Body"];
			$this->UserID = $row["UserID"];
			$this->SendRule = $row["SendRule"];
			$this->ScheduleTime = $row["ScheduleTime"];
			$this->SendTimeFirst = $row["SendTimeFirst"];
			$this->SendTimeLast = $row["SendTimeLast"];
			$this->ConfirmTime = $row["ConfirmTime"];
			$this->SendNumber = $row["SendNumber"];
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
		$this->connection->RunQuery("DELETE FROM v4_Wan WHERE ID = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function saveRow(){
		$result = $this->connection->RunQuery("UPDATE v4_Wan set 
Title = '".$this->myreal_escape_string($this->Title)."', 
Body = '".$this->myreal_escape_string($this->Body)."', 
UserID = '".$this->myreal_escape_string($this->UserID)."', 
SendRule = '".$this->myreal_escape_string($this->SendRule)."', 
ScheduleTime = '".$this->myreal_escape_string($this->ScheduleTime)."', 
SendTimeFirst = '".$this->myreal_escape_string($this->SendTimeFirst)."',
SendTimeLast = '".$this->myreal_escape_string($this->SendTimeLast)."',
ConfirmTime = '".$this->myreal_escape_string($this->ConfirmTime)."',
SendNumber = '".$this->myreal_escape_string($this->SendNumber)."',
Status = '".$this->myreal_escape_string($this->Status)."' WHERE ID = '".$this->ID."'");
	return $result; 
}

    /**
     * Save the active var class as a new row on table
     */
	public function saveAsNew(){
		$this->connection->RunQuery("INSERT INTO v4_Wan (
			Title, 
			Body, 
			UserID, 
			SendRule,
			ScheduleTime, 
			SendTimeFirst,
			SendTimeLast,
			ConfirmTime,
			SendNumber,
			Status
		) values (
		'".$this->myreal_escape_string($this->Title)."', 
		'".$this->myreal_escape_string($this->Body)."', 
		'".$this->myreal_escape_string($this->UserID)."', 
		'".$this->myreal_escape_string($this->SendRule)."', 
		'".$this->myreal_escape_string($this->ScheduleTime)."',
		'".$this->myreal_escape_string($this->SendTimeFirst)."',
		'".$this->myreal_escape_string($this->SendTimeLast)."',
		'".$this->myreal_escape_string($this->ConfirmTime)."',
		'".$this->myreal_escape_string($this->SendNumber)."',
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
		$result = $this->connection->RunQuery("SELECT ID from v4_Wan $where ORDER BY $column $order");
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
			'SendRule' => $this->getSendRule(),
			'ScheduleTime' => $this->getScheduleTime(),
			'SendTimeFirst' => $this->getSendTimeFirst(),
			'SendTimeLast' => $this->getSendTimeLast(),
			'ConfirmTime' => $this->getConfirmTime(),
			'SendNumber' => $this->getSendNumber(),
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
			'ID',
			'Title',
			'Body',
			'UserID',
			'SendRule',
			'ScheduleTime',
			'SendTimeFirst',
			'SendTimeLast', 
			'ConfirmTime',
			'SendNumber',
			'Status'
		);
		return $fieldNames;
	}
    /**
     * Close mysql connection
     */
	public function endv4_Wan(){
		$this->connection->CloseMysql();
	}

}