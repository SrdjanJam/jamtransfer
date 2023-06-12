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

Class v4_Notifications {

	public $NotificationID; //int(11) unsigned
	public $SubDriverID; //int(101) unsigned
	public $DateToSend; //date
	public $TimeToSend; //time
	public $SenderID; //int(11) unsigned
	public $Message; //varchar(255) unsigned
	public $Url; //varchar(255) unsigned
	public $NotificationType; //tinyint(1)
	

	function __construct(){
		$this->connection = new DataBaseMysql();
	}	public function myreal_escape_string($string){
		return $this->connection->real_escape_string($string);
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->saveAsNew();
     *
     */
	public function New_v4_Notifications($NotificationID,$SubDriverID,$DateToSend,$TimeToSend,$SenderID,$Message,$Url,$NotificationType){
		$this->NotificationID = $NotificationID;
		$this->SubDriverID = $SubDriverID;
		$this->DateToSend = $DateToSend;
		$this->TimeToSend = $TimeToSend;
		$this->SenderID = $SenderID;
		$this->Message = $Message;
		$this->Url = $Url;
		$this->NotificationType = $NotificationType;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name;
     *
     * @param key_table_type $key_row
     *
     */
	public function getRow($key_row){
		$result = $this->connection->RunQuery("Select * from v4_Notifications where NotificationID = \"$key_row\" ");
		if($result->num_rows < 1) return false;
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->NotificationID = $row["NotificationID"];
			$this->SubDriverID = $row["SubDriverID"];
			$this->DateToSend = $row["DateToSend"];
			$this->TimeToSend = $row["TimeToSend"];
			$this->SenderID = $row["SenderID"];
			$this->Message = $row["Message"];
			$this->Url = $row["Url"];
			$this->NotificationType = $row["NotificationType"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function deleteRow($key_row){
		$this->connection->RunQuery("DELETE FROM v4_Notifications WHERE NotificationID = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function saveRow(){
		$result = $this->connection->RunQuery("UPDATE v4_Notifications set
NotificationID = '".$this->myreal_escape_string($this->NotificationID)."',
SubDriverID = '".$this->myreal_escape_string($this->SubDriverID)."',
DateToSend = '".$this->myreal_escape_string($this->DateToSend)."',
TimeToSend = '".$this->myreal_escape_string($this->TimeToSend)."',
SenderID = '".$this->myreal_escape_string($this->SenderID)."',
Message = '".$this->myreal_escape_string($this->Message)."',
Url = '".$this->myreal_escape_string($this->Url)."',
NotificationType = '".$this->myreal_escape_string($this->NotificationType)."' WHERE NotificationID = '".$this->NotificationID."'");
	return $result;
}

    /**
     * Save the active var class as a new row on table
     */
	public function saveAsNew(){
		$this->connection->RunQuery("INSERT INTO v4_Notifications (NotificationID, SubDriverID, DateToSend, TimeToSend, SenderID, Message, Url, NotificationType) values (
			'".$this->myreal_escape_string($this->NotificationID)."', 
			'".$this->myreal_escape_string($this->SubDriverID)."', 
			'".$this->myreal_escape_string($this->DateToSend)."', 
			'".$this->myreal_escape_string($this->TimeToSend)."', 
			'".$this->myreal_escape_string($this->SenderID)."', 
			'".$this->myreal_escape_string($this->Message)."', 
			'".$this->myreal_escape_string($this->Url)."', 
			'".$this->myreal_escape_string($this->NotificationType)."')");
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
		$result = $this->connection->RunQuery("SELECT NotificationID from v4_Notifications $where ORDER BY $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["NotificationID"];
				$i++;
			}
	return $keys;
	}


	/**
	 * @return NotificationID - int(10) unsigned
	 */
	public function getNotificationID(){
		return $this->NotificationID;
	}

	/**
	 * @return SubDriverID - varchar(255)
	 */
	public function getSubDriverID(){
		return $this->SubDriverID;
	}

	/**
	 * @return DateToSend - varchar(255)
	 */
	public function getDateToSend(){
		return $this->DateToSend;
	}

	/**
	 * @return TimeToSend - text
	 */
	public function getTimeToSend(){
		return $this->TimeToSend;
	}	
	
	/**
	 * @return SenderID - text
	 */
	public function getSenderID(){
		return $this->SenderID;
	}

	/**
	 * @return Message - int(10) unsigned
	 */
	public function getMessage(){
		return $this->Message;
	}

	/**
	 * @return Url - datetime
	 */
	public function getUrl(){
		return $this->Url;
	}	

	/**
	 * @return NotificationType - tinyint(4) unsigned
	 */
	public function getNotificationType(){
		return $this->NotificationType;
	}	
	

	/**
	 * @param Type: int(10) unsigned
	 */
	public function setNotificationID($NotificationID){
		$this->NotificationID = $NotificationID;
	}

	/**
	 * @param Type: varchar(255)
	 */
	public function setSubDriverID($SubDriverID){
		$this->SubDriverID = $SubDriverID;
	}

	/**
	 * @param Type: varchar(255)
	 */
	public function setDateToSend($DateToSend){
		$this->DateToSend = $DateToSend;
	}

	/**
	 * @param Type: text
	 */
	public function setTimeToSend($TimeToSend){
		$this->TimeToSend = $TimeToSend;
	}	
	
	/**
	 * @param Type: text
	 */
	public function setSenderID($SenderID){
		$this->SenderID = $SenderID;
	}

	/**
	 * @param Type: int(10) unsigned
	 */
	public function setMessage($Message){
		$this->Message = $Message;
	}

	/**
	 * @param Type: datetime
	 */
	public function setUrl($Url){
		$this->Url = $Url;
	}

	/**
	 * @param Type: tinyint(4) unsigned
	 */
	public function setNotificationType($NotificationType){
		$this->NotificationType = $NotificationType;
	}
	

    /**
     * fieldValues - Load all fieldNames and fieldValues into Array.
     *
     * @param
     *
     */
	public function fieldValues(){
		$fieldValues = array(
			'NotificationID' => $this->getNotificationID(),
			'SubDriverID' => $this->getSubDriverID(),
			'DateToSend' => $this->getDateToSend(),
			'TimeToSend' => $this->getTimeToSend(),
			'SenderID' => $this->getSenderID(),
			'Message' => $this->getMessage(),
			'Url' => $this->getUrl(),
			'NotificationTyp' => $this->getNotificationType()		);
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
			'NotificationID',			'SubDriverID',			'DateToSend',			'TimeToSend',			'SenderID',		'Message',			'Url',			'NotificationType'	);
		return $fieldNames;
	}
    /**
     * Close mysql connection
     */
	public function endv4_Notifications(){
		$this->connection->CloseMysql();
	}

}
