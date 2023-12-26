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

Class v4_Customers {

	public $Site; //int(2)
	public $CustID; //int(10)
	public $LevelID; //int(2)
	public $CustFirstName; //varchar(255)
	public $CustLastName; //varchar(255)
	public $CustCountry; //int(10)
	public $CustLanguage; //varchar(255)
	public $CustEmail; //varchar(255)
	public $CustAddress; //varchar(255)
	public $CustCity; //varchar(255)
	public $CustZip; //varchar(255)
	public $CustMobile; //varchar(255)
	public $CustPass; //varchar(255)
	public $OrdersCount; //tinyint(1)
	public $OrdersValue; //tinyint(1)
	public $CustSubscribed; //tinyint(1)
	public $CustActive; //tinyint(1)
	public $Discount; //tinyint(1)
	public $CustImage; //blob
	public $CustImageType; //varchar(255)
	public $IsFirstTime; //tinyint(1)
	public $NextLevelCount; //int(4)
	public $NextLevelValue; //decimal(10,2)
	
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
	public function New_v4_Customers($Site,$LevelID,$CustFirstName,$CustLastName,$CustCountry,$CustLanguage,$CustEmail,$CustAddress,$CustCity,$CustZip,$CustMobile,$CustPass,$OrdersCount,$OrdersValue,$CustSubscribed,$CustActive,$Discount,$CustImage,$CustImageType,$IsFirstTime,$NextLevelCount,$NextLevelValue){
		$this->Site = $Site;
		$this->LevelID = $LevelID;
		$this->CustFirstName = $CustFirstName;
		$this->CustLastName = $CustLastName;
		$this->CustCountry = $CustCountry;
		$this->CustLanguage = $CustLanguage;
		$this->CustEmail = $CustEmail;
		$this->CustAddress = $CustAddress;
		$this->CustCity = $CustCity;
		$this->CustZip = $CustZip;
		$this->CustMobile = $CustMobile;
		$this->CustPass = $CustPass;
		$this->OrdersCount = $OrdersCount;
		$this->OrdersValue = $OrdersValue;
		$this->CustSubscribed = $CustSubscribed;
		$this->CustActive = $CustActive;
		$this->Discount = $Discount;
		$this->CustImage = $CustImage;
		$this->CustImageType = $CustImageType;
		$this->IsFirstTime = $IsFirstTime;
		$this->NextLevelCount = $NextLevelCount;
		$this->NextLevelValue = $NextLevelValue;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function getRow($key_row){
		$result = $this->connection->RunQuery("Select * from v4_Customers where CustID = \"$key_row\" ");
		if($result->num_rows < 1) return false;
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->Site = $row["Site"];
			$this->CustID = $row["CustID"];
			$this->LevelID = $row["LevelID"];
			$this->CustFirstName = $row["CustFirstName"];
			$this->CustLastName = $row["CustLastName"];
			$this->CustCountry = $row["CustCountry"];
			$this->CustLanguage = $row["CustLanguage"];
			$this->CustEmail = $row["CustEmail"];
			$this->CustAddress = $row["CustAddress"];
			$this->CustCity = $row["CustCity"];
			$this->CustZip = $row["CustZip"];
			$this->CustMobile = $row["CustMobile"];
			$this->CustPass = $row["CustPass"];
			$this->OrdersCount = $row["OrdersCount"];
			$this->OrdersValue = $row["OrdersValue"];
			$this->CustSubscribed = $row["CustSubscribed"];
			$this->CustActive = $row["CustActive"];
			$this->Discount = $row["Discount"];
			$this->CustImage = $row["CustImage"];
			$this->CustImageType = $row["CustImageType"];
			$this->IsFirstTime = $row["IsFirstTime"];
			$this->NextLevelCount = $row["NextLevelCount"];
			$this->NextLevelValue = $row["NextLevelValue"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function deleteRow($key_row){
		$this->connection->RunQuery("DELETE FROM v4_Customers WHERE CustID = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function saveRow(){
		$result = $this->connection->RunQuery("UPDATE v4_Customers set 
Site = '".$this->myreal_escape_string($this->Site)."', 
LevelID = '".$this->myreal_escape_string($this->LevelID)."', 
CustFirstName = '".$this->myreal_escape_string($this->CustFirstName)."', 
CustLastName = '".$this->myreal_escape_string($this->CustLastName)."', 
CustCountry = '".$this->myreal_escape_string($this->CustCountry)."', 
CustLanguage = '".$this->myreal_escape_string($this->CustLanguage)."', 
CustEmail = '".$this->myreal_escape_string($this->CustEmail)."', 
CustAddress = '".$this->myreal_escape_string($this->CustAddress)."', 
CustCity = '".$this->myreal_escape_string($this->CustCity)."', 
CustZip = '".$this->myreal_escape_string($this->CustZip)."', 
CustMobile = '".$this->myreal_escape_string($this->CustMobile)."', 
CustPass = '".$this->myreal_escape_string($this->CustPass)."', 
OrdersCount = '".$this->myreal_escape_string($this->OrdersCount)."', 
OrdersValue = '".$this->myreal_escape_string($this->OrdersValue)."', 
CustSubscribed = '".$this->myreal_escape_string($this->CustSubscribed)."', 
CustActive = '".$this->myreal_escape_string($this->CustActive)."', 
Discount = '".$this->myreal_escape_string($this->Discount)."', 
CustImage = '".$this->myreal_escape_string($this->CustImage)."', 
IsFirstTime = '".$this->myreal_escape_string($this->IsFirstTime)."', 
NextLevelCount = '".$this->myreal_escape_string($this->NextLevelCount)."', 
NextLevelValue = '".$this->myreal_escape_string($this->NextLevelValue)."', 
CustImageType = '".$this->myreal_escape_string($this->CustImageType)."' WHERE CustID = '".$this->CustID."'");
	return $result; 
}

    /**
     * Save the active var class as a new row on table
     */
	public function saveAsNew(){
		$this->connection->RunQuery("INSERT INTO v4_Customers (Site, LevelID, CustFirstName, CustLastName, CustCountry, CustLanguage, CustEmail, CustAddress, CustCity, CustZip, CustMobile, CustPass, OrdersCount, OrdersValue, CustSubscribed, CustActive, Discount, CustImage, CustImageType, IsFirstTime, NextLevelCount, NextLevelValue) values ('".$this->myreal_escape_string($this->Site)."', '".$this->myreal_escape_string($this->LevelID)."', '".$this->myreal_escape_string($this->CustFirstName)."', '".$this->myreal_escape_string($this->CustLastName)."', '".$this->myreal_escape_string($this->CustCountry)."', '".$this->myreal_escape_string($this->CustLanguage)."', '".$this->myreal_escape_string($this->CustEmail)."', '".$this->myreal_escape_string($this->CustAddress)."', '".$this->myreal_escape_string($this->CustCity)."', '".$this->myreal_escape_string($this->CustZip)."', '".$this->myreal_escape_string($this->CustMobile)."', '".$this->myreal_escape_string($this->CustPass)."',
		'".$this->myreal_escape_string($this->OrdersCount)."',
		'".$this->myreal_escape_string($this->OrdersValue)."',
		'".$this->myreal_escape_string($this->CustSubscribed)."',		
		'".$this->myreal_escape_string($this->CustActive)."',
		'".$this->myreal_escape_string($this->Discount)."',
		'".$this->myreal_escape_string($this->CustImage)."', 
		'".$this->myreal_escape_string($this->CustImageType)."',
		'".$this->myreal_escape_string($this->IsFirstTime)."',
		'".$this->myreal_escape_string($this->NextLevelCount)."',
		'".$this->myreal_escape_string($this->NextLevelValue)."'
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
		$result = $this->connection->RunQuery("SELECT CustID from v4_Customers $where ORDER BY $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["CustID"];
				$i++;
			}
	return $keys;
	}

	// ====================================================
	// GET:

	/**
	 * @return Site - int(2)
	 */
	public function getSite(){
		return $this->Site;
	}

	/**
	 * @return CustID - int(10)
	 */
	public function getCustID(){
		return $this->CustID;
	}

	/**
	 * @return LevelID - int(2)
	 */
	public function getLevelID(){
		return $this->LevelID;
	}

	/**
	 * @return CustFirstName - varchar(255)
	 */
	public function getCustFirstName(){
		return $this->CustFirstName;
	}

	/**
	 * @return CustLastName - varchar(255)
	 */
	public function getCustLastName(){
		return $this->CustLastName;
	}

	/**
	 * @return CustCountry - int(10)
	 */
	public function getCustCountry(){
		return $this->CustCountry;
	}

	/**
	 * @return CustLanguage - varchar(255)
	 */
	public function getCustLanguage(){
		return $this->CustLanguage;
	}

	/**
	 * @return CustEmail - varchar(255)
	 */
	public function getCustEmail(){
		return $this->CustEmail;
	}

	/**
	 * @return CustAddress - varchar(255)
	 */
	public function getCustAddress(){
		return $this->CustAddress;
	}

	/**
	 * @return CustCity - varchar(255)
	 */
	public function getCustCity(){
		return $this->CustCity;
	}

	/**
	 * @return CustZip - varchar(255)
	 */
	public function getCustZip(){
		return $this->CustZip;
	}

	/**
	 * @return CustMobile - varchar(255)
	 */
	public function getCustMobile(){
		return $this->CustMobile;
	}

	/**
	 * @return CustPass - varchar(255)
	 */
	public function getCustPass(){
		return $this->CustPass;
	}

	/**
	 * @return OrdersCount - tinyint(1)
	 */
	public function getOrdersCount(){
		return $this->OrdersCount;
	}	
	
	/**
	 * @return OrdersValue - tinyint(1)
	 */
	public function getOrdersValue(){
		return $this->OrdersValue;
	}	
	
	/**
	 * @return CustSubscribed - tinyint(1)
	 */
	public function getCustSubscribed(){
		return $this->CustSubscribed;
	}

	/**
	 * @return CustActive - tinyint(1)
	 */
	public function getCustActive(){
		return $this->CustActive;
	}	
	
	/**
	 * @return Discount - tinyint(1)
	 */
	public function getDiscount(){
		return $this->Discount;
	}

	/**
	 * @return CustImage - blob
	 */
	public function getCustImage(){
		return $this->CustImage;
	}

	/**
	 * @return CustImageType - varchar(255)
	 */
	public function getCustImageType(){
		return $this->CustImageType;
	}

	/**
	* @return IsFirstTime - tinyint(1)
	*/
	public function getIsFirstTime(){
		return $this->IsFirstTime;
	}

	/**
	* @return NextLevelCount - int(4)
	*/
	public function getNextLevelCount(){
		return $this->IsFirstTime;
	}

	/**
	* @return NextLevelValue - decimal(10,2)
	*/
	public function getNextLevelValue(){
		return $this->NextLevelValue;
	}
	// ===========================================================
	// SET:

	/**
	 * @param Type: int(2)
	 */
	public function setSite($Site){
		$this->Site = $Site;
	}

	/**
	 * @param Type: int(10)
	 */
	public function setCustID($CustID){
		$this->CustID = $CustID;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setLevelID($LevelID){
		$this->LevelID = $LevelID;
	}

	/**
	 * @param Type: varchar(255)
	 */
	public function setCustFirstName($CustFirstName){
		$this->CustFirstName = $CustFirstName;
	}

	/**
	 * @param Type: varchar(255)
	 */
	public function setCustLastName($CustLastName){
		$this->CustLastName = $CustLastName;
	}

	/**
	 * @param Type: int(10)
	 */
	public function setCustCountry($CustCountry){
		$this->CustCountry = $CustCountry;
	}

	/**
	 * @param Type: varchar(255)
	 */
	public function setCustLanguage($CustLanguage){
		$this->CustLanguage = $CustLanguage;
	}

	/**
	 * @param Type: varchar(255)
	 */
	public function setCustEmail($CustEmail){
		$this->CustEmail = $CustEmail;
	}

	/**
	 * @param Type: varchar(255)
	 */
	public function setCustAddress($CustAddress){
		$this->CustAddress = $CustAddress;
	}

	/**
	 * @param Type: varchar(255)
	 */
	public function setCustCity($CustCity){
		$this->CustCity = $CustCity;
	}

	/**
	 * @param Type: varchar(255)
	 */
	public function setCustZip($CustZip){
		$this->CustZip = $CustZip;
	}

	/**
	 * @param Type: varchar(255)
	 */
	public function setCustMobile($CustMobile){
		$this->CustMobile = $CustMobile;
	}

	/**
	 * @param Type: varchar(255)
	 */
	public function setCustPass($CustPass){
		$this->CustPass = $CustPass;
	}

	/**
	 * @param Type: tinyint(1)
	 */
	public function setOrdersCount($OrdersCount){
		$this->OrdersCount = $OrdersCount;
	}	
	
	/**
	 * @param Type: tinyint(1)
	 */
	public function setOrdersValue($OrdersValue){
		$this->OrdersValue = $OrdersValue;
	}	
	
	/**
	 * @param Type: tinyint(1)
	 */
	public function setCustSubscribed($CustSubscribed){
		$this->CustSubscribed = $CustSubscribed;
	}

	/**
	 * @param Type: tinyint(1)
	 */
	public function setCustActive($CustActive){
		$this->CustActive = $CustActive;
	}	
	
	/**
	 * @param Type: tinyint(1)
	 */
	public function setDiscount($Discount){
		$this->Discount = $Discount;
	}

	/**
	 * @param Type: blob
	 */
	public function setCustImage($CustImage){
		$this->CustImage = $CustImage;
	}

	/**
	 * @param Type: varchar(255)
	 */
	public function setCustImageType($CustImageType){
		$this->CustImageType = $CustImageType;
	}

	/**
	 * @param Type: tinyint(1)
	 */
	public function setIsFirstTime($IsFirstTime){
		$this->IsFirstTime = $IsFirstTime;
	}

	/**
	 * @param Type: int(4)
	 */
	public function setNextLevelCount($NextLevelCount){
		$this->NextLevelCount = $NextLevelCount;
	}

	/**
	 * @param Type: decimal(10,2)
	 */
	public function setNextLevelValue($NextLevelValue){
		$this->NextLevelValue = $NextLevelValue;
	}


    /**
     * fieldValues - Load all fieldNames and fieldValues into Array. 
     *
     * @param 
     * 
     */
	public function fieldValues(){
		$fieldValues = array(
			'Site' => $this->getSite(),
			'CustID' => $this->getCustID(),
			'LevelID' => $this->getLevelID(),
			'CustFirstName' => $this->getCustFirstName(),
			'CustLastName' => $this->getCustLastName(),
			'CustCountry' => $this->getCustCountry(),
			'CustLanguage' => $this->getCustLanguage(),
			'CustEmail' => $this->getCustEmail(),
			'CustAddress' => $this->getCustAddress(),
			'CustCity' => $this->getCustCity(),
			'CustZip' => $this->getCustZip(),
			'CustMobile' => $this->getCustMobile(),
			'CustPass' => $this->getCustPass(),
			'OrdersCount' => $this->getOrdersCount(),
			'OrdersValue' => $this->getOrdersValue(),
			'CustSubscribed' => $this->getCustSubscribed(),
			'CustActive' => $this->getCustActive(),
			'Discount' => $this->getDiscount(),
			'CustImage' => $this->getCustImage(),
			'CustImageType' => $this->getCustImageType(),
			'IsFirstTime' => $this->getIsFirstTime(),
			'NextLevelCount' => $this->getNextLevelCount(),
			'NextLevelValue' => $this->getNextLevelValue()
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
			'Site',			'CustID',			'LevelID',			'CustFirstName',			'CustLastName',			'CustCountry',			'CustLanguage',			'CustEmail',			'CustAddress',			'CustCity',			'CustZip',			'CustMobile',			'CustPass',			'OrdersCount',		'OrdersValue',		'CustSubscribed',	'CustActive',			'Discount',			'CustImage',			'CustImageType',	'IsFirstTime',		'NextLevelCount',	'NextLevelValue'		);
		return $fieldNames;
	}
    /**
     * Close mysql connection
     */
	public function endv4_Customers(){
		$this->connection->CloseMysql();
	}

}