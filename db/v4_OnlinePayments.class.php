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
	public function New_v4_OnlinePayments($ID,$gateway,$OrderID,$CustomerIP,$OrderNumber,$type,$datetime1,$datetime2,$datetime3,$created_at,$updated_at){
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
			'updated_at'

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