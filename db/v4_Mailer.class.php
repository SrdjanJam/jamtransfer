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

Class v4_Mailer {

	public $MailID; //int(11) unsigned
	public $CreateTime; //datetime
	public $CreatorID; //int(11)
	public $FromName; //text
	public $ToName; //text
	public $ReplyTo; //text
	public $Subject; //varchar(255)
	public $Body; //varchar(255)
	public $Attachment; //varchar(255)
	public $SentTime; //datetime
	public $Status; //tinyint(4)
	public $Type; //tinyint(4)
	public $Direction; //int(11)
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
	public function New_v4_Mailer($MailID,$CreateTime,$CreatorID,$FromName,$ToName,$ReplyTo,$Subject,$Body,$Attachment,$SentTime,$Status,$Type,$Direction,$OwnerID){
		$this->MailID = $MailID;
		$this->CreateTime = $CreateTime;
		$this->CreatorID = $CreatorID;
		$this->FromName = $FromName;
		$this->ToName = $ToName;
		$this->ReplyTo = $ReplyTo;
		$this->Subject = $Subject;
		$this->Body = $Body;
		$this->Attachment = $Attachment;
		$this->SentTime = $SentTime;
		$this->Status = $Status;
		$this->Type = $Type;
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
		$result = $this->connection->RunQuery("Select * from v4_Mailer where MailID = \"$key_row\" ");
		if($result->num_rows < 1) return false;
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->MailID = $row["MailID"];
			$this->CreateTime = $row["CreateTime"];
			$this->CreatorID = $row["CreatorID"];
			$this->FromName = $row["FromName"];
			$this->ToName = $row["ToName"];
			$this->ReplyTo = $row["ReplyTo"];
			$this->Subject = $row["Subject"];
			$this->Body = $row["Body"];
			$this->Attachment = $row["Attachment"];
			$this->SentTime = $row["SentTime"];
			$this->Status = $row["Status"];
			$this->Type = $row["Type"];
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
		$this->connection->RunQuery("DELETE FROM v4_Mailer WHERE MailID = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function saveRow(){
		$result = $this->connection->RunQuery("UPDATE v4_Mailer set
MailID = '".$this->myreal_escape_string($this->MailID)."',
CreateTime = '".$this->myreal_escape_string($this->CreateTime)."',
CreatorID = '".$this->myreal_escape_string($this->CreatorID)."',
FromName = '".$this->myreal_escape_string($this->FromName)."',
ToName = '".$this->myreal_escape_string($this->ToName)."',
ReplyTo = '".$this->myreal_escape_string($this->ReplyTo)."',
Subject = '".$this->myreal_escape_string($this->Subject)."',
Body = '".$this->myreal_escape_string($this->Body)."',
Attachment = '".$this->myreal_escape_string($this->Attachment)."',
SentTime = '".$this->myreal_escape_string($this->SentTime)."',
Direction = '".$this->myreal_escape_string($this->Direction)."',
OwnerID = '".$this->myreal_escape_string($this->OwnerID)."',
Status = '".$this->myreal_escape_string($this->Status)."',
Type = '".$this->myreal_escape_string($this->Type)."' WHERE MailID = '".$this->MailID."'");
	return $result;
}

    /**
     * Save the active var class as a new row on table
     */
	public function saveAsNew(){
		$this->connection->RunQuery("INSERT INTO v4_Mailer (MailID, CreateTime, CreatorID, FromName, ToName, ReplyTo, Subject, Body, Attachment, SentTime, Status, Type, Direction, OwnerID) values (
			'".$this->myreal_escape_string($this->MailID)."', 
			'".$this->myreal_escape_string($this->CreateTime)."', 
			'".$this->myreal_escape_string($this->CreatorID)."', 
			'".$this->myreal_escape_string($this->FromName)."', 
			'".$this->myreal_escape_string($this->ToName)."', 
			'".$this->myreal_escape_string($this->ReplyTo)."', 
			'".$this->myreal_escape_string($this->Subject)."', 
			'".$this->myreal_escape_string($this->Body)."', 
			'".$this->myreal_escape_string($this->Attachment)."', 
			'".$this->myreal_escape_string($this->SentTime)."', 
			'".$this->myreal_escape_string($this->Status)."',
			'".$this->myreal_escape_string($this->Type)."',
			'".$this->myreal_escape_string($this->Direction)."',
			'".$this->myreal_escape_string($this->OwnerID)."'
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
		$result = $this->connection->RunQuery("SELECT MailID from v4_Mailer $where ORDER BY $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["MailID"];
				$i++;
			}
	return $keys;
	}

	// GET:

	/**
	 * @return MailID - int(11) unsigned
	 */
	public function getMailID(){
		return $this->MailID;
	}

	/**
	 * @return CreateTime - varchar(255)
	 */
	public function getCreateTime(){
		return $this->CreateTime;
	}

	/**
	 * @return CreatorID - int(11)
	 */
	public function getCreatorID(){
		return $this->CreatorID;
	}

	/**
	 * @return FromName - text
	 */
	public function getFromName(){
		return $this->FromName;
	}

	/**
	 * @return ToName - text
	 */
	public function getToName(){
		return $this->ToName;
	}

	/**
	 * @return ReplyTo - text
	 */
	public function getReplyTo(){
		return $this->ReplyTo;
	}	

	/**
	 * @return Subject - varchar(255)
	 */
	public function getSubject(){
		return $this->Subject;
	}	
	
	/**
	 * @return Body - varchar(255)
	 */
	public function getBody(){
		return $this->Body;
	}	
	
	/**
	 * @return Attachment - varchar(255)
	 */
	public function getAttachment(){
		return $this->Attachment;
	}

	/**
	 * @return SentTime - datetime
	 */
	public function getSentTime(){
		return $this->SentTime;
	}

	/**
	 * @return Status - tyint(4)
	 */
	public function getStatus(){
		return $this->Status;
	}	
	
	/**
	 * @return Type - tyint(1)
	 */
	public function getType(){
		return $this->Type;
	}

	/**
	 * @return Direction - tyint(1)
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



	// SET:

	/**
	 * @param Type: int(11) unsigned
	 */
	public function setMailID($MailID){
		$this->MailID = $MailID;
	}

	/**
	 * @param Type: datatime
	 */
	public function setCreateTime($CreateTime){
		$this->CreateTime = $CreateTime;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCreatorID($CreatorID){
		$this->CreatorID = $CreatorID;
	}

	/**
	 * @param Type: text
	 */
	public function setFromName($FromName){
		$this->FromName = $FromName;
	}

	/**
	 * @param Type: text
	 */
	public function setToName($ToName){
		$this->ToName = $ToName;
	}

	/**
	 * @param Type: text
	 */
	public function setReplyTo($ReplyTo){
		$this->ReplyTo = $ReplyTo;
	}

	/**
	 * @param Type: varchar(255)
	 */
	public function setSubject($Subject){
		$this->Subject = $Subject;
	}

	/**
	 * @param Type: varchar(255)
	 */
	public function setBody($Body){
		$this->Body = $Body;
	}
	
	/**
	 * @param Type: varchar(255)
	 */
	public function setAttachment($Attachment){
		$this->Attachment = $Attachment;
	}
	
	/**
	 * @param Type: datetime
	 */
	public function setSentTime($SentTime){
		$this->SentTime = $SentTime;
	}

	/**
	 * @param Type: tinyint(1)
	 */
	public function setStatus($Status){
		$this->Status = $Status;
	}	 
	
	/**
	 * @param Type: tinyint(1)
	 */
	public function setType($Type){
		$this->Type = $Type;
	}

	/**
	 * @param Type: tinyint(1)
	 */
	public function setDirection($Direction){
		$this->Direction = $Direction;
	}

	/**
	 * @param Type: tinyint(1)
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
			'MailID' => $this->getMailID(),
			'CreateTime' => $this->getCreateTime(),
			'CreatorID' => $this->getCreatorID(),
			'FromName' => $this->getFromName(),
			'ToName' => $this->getToName(),
			'ReplyTo' => $this->getReplyTo(),
			'Subject' => $this->getSubject(),
			'Body' => $this->getBody(),
			'Attachment' => $this->getAttachment(),
			'SentTime' => $this->getSentTime(),
			'Status' => $this->getStatus(),		
			'Type' => $this->getType(),		
			'Direction' => $this->getDirection(),
			'OwnerID' => $this->getOwnerID(),
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
			'MailID',			'CreateTime',			'CreatorID',			'FromName',			'ToName',			'ReplyTo',			'Subject',			'Body',			'Attachment',	'SentTime',	'Status', 'Type', 'Direction', 'OwnerID'		);
		return $fieldNames;
	}
    /**
     * Close mysql connection
     */
	public function endv4_Mailer(){
		$this->connection->CloseMysql();
	}

}
