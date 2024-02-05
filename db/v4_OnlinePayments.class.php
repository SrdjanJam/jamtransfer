<?php

require_once 'db.class.php';

Class v4_OnlinePayments {

	public $ID; //bigint(20)
	public $gateway; //varchar(255)
	public $OrderID; //varchar(255)
	public $CustomerIP; //varchar(255)
	public $OrderNumber; //varchar(255)
	public $type; //int(11)
	public $datetime1; //datetime
	public $datetime2; //datetime
	public $datetime3; //datetime
	public $created_at; //timestamp
	public $updated_at; //timestamp
// New fields:
	public $MonriID; //int(11)
	public $Buyer; //varchar(255)
	public $Country; //varchar(50)
	public $Card; //varchar(20)
	public $Amount; //decimal(10,2)
	public $Currency; //varchar(3)
	public $Avans; //tinyint(1)
	public $EU; //tinyint(1)
	public $PickupDate; //date
	public $FiscalBill; //varchar(20)


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
	public function New_v4_OnlinePayments($ID,$gateway,$OrderID,$CustomerIP,$OrderNumber,$type,$datetime1,$datetime2,$datetime3,$created_at,$updated_at,$MonriID,$Buyer,$Country,$Card,$Amount,$Currency,$Avans,$EU,$PickupDate,$FiscalBill){
		$this->ID = $ID;
		$this->gateway = $gateway;
		$this->OrderID = $OrderID;		
		$this->CustomerIP = $CustomerIP;
		$this->OrderNumber = $OrderNumber;		
		$this->type = $type;
		$this->datetime1 = $datetime1;
		$this->datetime2 = $datetime2;
		$this->datetime3 = $datetime3;
		$this->created_at = $created_at;
		$this->updated_at = $updated_at;
		$this->MonriID = $MonriID;
		$this->Buyer = $Buyer;
		$this->Country = $Country;
		$this->Card = $Card;
		$this->Amount = $Amount;
		$this->Currency = $Currency;
		$this->Avans = $Avans;
		$this->EU = $EU;
		$this->PickupDate = $PickupDate;
		$this->FiscalBill = $FiscalBill;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function getRow($key_row){
		$result = $this->connection->RunQuery("Select * from v4_OnlinePayments where ID = \"$key_row\" ");
		if($result->num_rows < 1) return false;
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->ID = $row["ID"];
			$this->gateway = $row["gateway"];
			$this->OrderID = $row["OrderID"];			
			$this->CustomerIP = $row["CustomerIP"];
			$this->OrderNumber = $row["OrderNumber"];			
			$this->type = $row["type"];		
			$this->datetime1 = $row["datetime1"];	
			$this->datetime2 = $row["datetime2"];	
			$this->datetime3 = $row["datetime3"];
			$this->created_at = $row["created_at"];
			$this->updated_at = $row["updated_at"];
			$this->MonriID = $row["MonriID"];
			$this->Buyer = $row["Buyer"];
			$this->Country = $row["Country"];
			$this->Card = $row["Card"];
			$this->Amount = $row["Amount"];
			$this->Currency = $row["Currency"];
			$this->Avans = $row["Avans"];
			$this->EU = $row["EU"];
			$this->PickupDate = $row["PickupDate"];
			$this->FiscalBill = $row["FiscalBill"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function getKeysBy($column, $order, $where = NULL){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT ID from v4_OnlinePayments $where ORDER BY $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["ID"];
				$i++;
			}
		return $keys;
	}

    /**
     * Update the active row table on table
     */
	public function saveRow(){
		$result = $this->connection->RunQuery("UPDATE v4_OnlinePayments set 
gateway = '".$this->myreal_escape_string($this->gateway)."', 
OrderID = '".$this->myreal_escape_string($this->OrderID)."', 
CustomerIP = '".$this->myreal_escape_string($this->CustomerIP)."', 
OrderNumber = '".$this->myreal_escape_string($this->OrderNumber)."', 
type = '".$this->myreal_escape_string($this->type)."', 
datetime1 = '".$this->myreal_escape_string($this->datetime1)."', 
datetime2 = '".$this->myreal_escape_string($this->datetime2)."', 
datetime3 = '".$this->myreal_escape_string($this->datetime3)."', 
created_at = '".$this->myreal_escape_string($this->created_at)."', 
updated_at = '".$this->myreal_escape_string($this->updated_at)."',
MonriID = '".$this->myreal_escape_string($this->MonriID)."',
Buyer = '".$this->myreal_escape_string($this->Buyer)."',
Country = '".$this->myreal_escape_string($this->Country)."',
Card = '".$this->myreal_escape_string($this->Card)."',
Amount = '".$this->myreal_escape_string($this->Amount)."',
Currency = '".$this->myreal_escape_string($this->Currency)."',
Avans = '".$this->myreal_escape_string($this->Avans)."',
EU = '".$this->myreal_escape_string($this->EU)."',
PickupDate = '".$this->myreal_escape_string($this->PickupDate)."',
FiscalBill = '".$this->myreal_escape_string($this->FiscalBill)."' WHERE ID = '".$this->ID."'");
	return $result; 
}


public function saveAsNew(){
	$this->connection->RunQuery("INSERT INTO v4_OnlinePayments (gateway, OrderID, CustomerIP, OrderNumber, type, datetime1, datetime2, datetime3, created_at, updated_at,MonriID, Buyer, Country, Card, Amount, Currency, Avans, EU, PickupDate, FiscalBill) values (
		'".$this->myreal_escape_string($this->gateway)."', 
		'".$this->myreal_escape_string($this->OrderID)."', 
		'".$this->myreal_escape_string($this->CustomerIP)."', 
		'".$this->myreal_escape_string($this->OrderNumber)."', 
		'".$this->myreal_escape_string($this->type)."', 
		'".$this->myreal_escape_string($this->datetime1)."', 
		'".$this->myreal_escape_string($this->datetime2)."', 
		'".$this->myreal_escape_string($this->datetime3)."',
		'".$this->myreal_escape_string($this->created_at)."',
		'".$this->myreal_escape_string($this->updated_at)."',
		'".$this->myreal_escape_string($this->MonriID)."',
		'".$this->myreal_escape_string($this->Buyer)."',
		'".$this->myreal_escape_string($this->Country)."',
		'".$this->myreal_escape_string($this->Card)."',
		'".$this->myreal_escape_string($this->Amount)."',
		'".$this->myreal_escape_string($this->Currency)."',
		'".$this->myreal_escape_string($this->Avans)."',
		'".$this->myreal_escape_string($this->EU)."',
		'".$this->myreal_escape_string($this->PickupDate)."',
		'".$this->myreal_escape_string($this->FiscalBill)."')");
	return $this->connection->insert_id(); //return insert_id
}

	// GET METHODS:

	/**
	 * @return ID - int(10)
	 */
	public function getID(){
		return $this->ID;
	}

	/**
	 * @return gateway - //varchar(255)
	 */
	public function getgateway(){
		return $this->gateway;
	}

	/**
	 * @return OrderID - //varchar(255)
	 */
	public function getOrderID(){
		return $this->OrderID;
	}
	
	/**
	 * @return CustomerIP - //varchar(255)
	 */
	public function getCustomerIP(){
		return $this->CustomerIP;
	}

	/**
	 * @return OrderNumber - //varchar(255)
	 */
	public function getOrderNumber(){
		return $this->OrderNumber;
	}

	/**
	 * @return type - //int(11)
	 */
	public function gettype(){
		return $this->type;
	}

	/**
	 * @return datetime1 - //datetime
	 */
	public function getdatetime1(){
		return $this->datetime1;
	}

	/**
	 * @return datetime2 - //datetime
	 */
	public function getdatetime2(){
		return $this->datetime2;
	}

	/**
	 * @return datetime3 - //datetime
	 */
	public function getdatetime3(){
		return $this->datetime3;
	}

	/**
	 * @return created_at - //timestamp
	 */
	public function getcreated_at(){
		return $this->created_at;
	}

	/**
	 * @return updated_at - //timestamp
	 */
	public function getupdated_at(){
		return $this->updated_at;
	}

	/**
	 * @return MonriID - //int(11)
	 */
	public function getMonriID(){
		return $this->MonriID;
	}

	/**
	 * @return Buyer - //varchar(255)
	 */
	public function getBuyer(){
		return $this->Buyer;
	}

	/**
	 * @return Country - //varchar(50)
	 */
	public function getCountry(){
		return $this->Country;
	}

	/**
	 * @return Card - //varchar(20)
	 */
	public function getCard(){
		return $this->Card;
	}

	/**
	 * @return Amount - //decimal(10,2)
	 */
	public function getAmount(){
		return $this->Amount;
	}

	/**
	 * @return Currency - //varchar(3)
	 */
	public function getCurrency(){
		return $this->Currency;
	}

	/**
	 * @return Avans - //tinyint(1)
	 */
	public function getAvans(){
		return $this->Avans;
	}

	/**
	 * @return EU - //tinyint(1)
	 */
	public function getEU(){
		return $this->EU;
	}

	/**
	 * @return PickupDate - //date
	 */
	public function getPickupDate(){
		return $this->PickupDate;
	}

	/**
	 * @return FiscalBill - //varchar(20)
	 */
	public function getFiscalBill(){
		return $this->FiscalBill;
	}





	// SET METHODS: ==========================================================================
	
	/**
	 * @param Type: //bigint(20)
	 */
	public function setID($ID){
		$this->ID = $ID;
	}

	/**
	 * @param Type: //varchar(255)
	 */
	public function setgateway($gateway){
		$this->gateway = $gateway;
	}

	/**
	 * @param Type: //varchar(255)
	 */
	public function setOrderID($OrderID){
		$this->OrderID = $OrderID;
	}

	/**
	 * @param Type: //varchar(255)
	 */
	public function setCustomerIP($CustomerIP){
		$this->CustomerIP = $CustomerIP;
	}
	
	/**
	 * @param Type: //varchar(255)
	 */
	public function setOrderNumber($OrderNumber){
		$this->OrderNumber = $OrderNumber;
	}

	/**
	 * @param Type: //varchar(255)
	 */
	public function settype($type){
		$this->type = $type;
	}

	/**
	 * @param Type: //datetime
	 */
	public function setdatetime1($datetime1){
		$this->datetime1 = $datetime1;
	}

	/**
	 * @param Type: //datetime
	 */
	public function setdatetime2($datetime2){
		$this->datetime2 = $datetime2;
	}

	/**
	 * @param Type: //datetime
	 */
	public function setdatetime3($datetime3){
		$this->datetime3 = $datetime3;
	}

	/**
	 * @param Type: //timestamp
	 */
	public function setcreated_at($created_at){
		$this->created_at = $created_at;
	}

	/**
	 * @param Type: //timestamp
	 */
	public function setupdated_at($updated_at){
		$this->updated_at = $updated_at;
	}

	/**
	 * @param Type: //int(11)
	 */
	public function setMonriID($MonriID){
		$this->MonriID = $MonriID;
	}

	/**
	 * @param Type: //varchar(255)
	 */
	public function setBuyer($Buyer){
		$this->Buyer = $Buyer;
	}

	/**
	 * @param Type: //varchar(50)
	 */
	public function setCountry($Country){
		$this->Country = $Country;
	}

	/**
	 * @param Type: //varchar(20)
	 */
	public function setCard($Card){
		$this->Card = $Card;
	}

	/**
	 * @param Type: //decimal(10,2)
	 */
	public function setAmount($Amount){
		$this->Amount = $Amount;
	}

	/**
	 * @param Type: //varchar(3)
	 */
	public function setCurrency($Currency){
		$this->Currency = $Currency;
	}

	/**
	 * @param Type: //tinyint(1)
	 */
	public function setAvans($Avans){
		$this->Avans = $Avans;
	}

	/**
	 * @param Type: //tinyint(1)
	 */
	public function setEU($EU){
		$this->EU = $EU;
	}

	/**
	 * @param Type: //date
	 */
	public function setPickupDate($PickupDate){
		$this->PickupDate = $PickupDate;
	}

	/**
	 * @param Type: //varchar(20)
	 */
	public function setFiscalBill($FiscalBill){
		$this->FiscalBill = $FiscalBill;
	}
	
	// ===========================================================================================


    /**
     * fieldValues - Load all fieldNames and fieldValues into Array. 
     *
     * @param 
     * 
     */
	public function fieldValues(){
		$fieldValues = array(
			'ID' => $this->getID(),
			'gateway' => $this->getgateway(),
			'OrderID' => $this->getOrderID(),			
			'CustomerIP' => $this->getCustomerIP(),			
			'OrderNumber' => $this->getOrderNumber(),		
			'type' => $this->gettype(),		
			'datetime1' => $this->getdatetime1(),	
			'datetime2' => $this->getdatetime2(),
			'datetime3' => $this->getdatetime3(),
			'created_at' => $this->getcreated_at(),
			'updated_at' => $this->getupdated_at(),
			'MonriID' => $this->getMonriID(),
			'Buyer' => $this->getBuyer(),
			'Country' => $this->getCountry(),			
			'Card' => $this->getCard(),			
			'Amount' => $this->getAmount(),		
			'Currency' => $this->getCurrency(),		
			'Avans' => $this->getAvans(),	
			'EU' => $this->getEU(),
			'PickupDate' => $this->getPickupDate(),
			'FiscalBill' => $this->getFiscalBill()
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
			'gateway',		
			'OrderID',			
			'CustomerIP',		
			'OrderNumber',
			'type',
			'datetime1',
			'datetime2',
			'datetime3',
			'created_at',
			'updated_at',
			'MonriID',
			'Buyer',
			'Country',
			'Card',
			'Amount',
			'Currency',
			'Avans',
			'EU',
			'PickupDate',
			'FiscalBill'

		);
		return $fieldNames;
	}
    /**
     * Close mysql connection
     */
	public function endv4_OnlinePayments(){
		$this->connection->CloseMysql();
	}

}