<?
require_once 'db.class.php';

Class v4_OrderRequest {

	public $ID; //int(11)
	public $OrderKey; //varchar(255)
	public $OrderID; //int(10)
	public $TNo; //int(10)
	public $DriverID; //int(10)
	public $ReturnTransfer; //int(11)
	public $RequestType; //int(11)
	public $RequestDate; //date
	public $RequestTime; //time
	public $ResponseDate; //date
	public $ResponseTime; //time
	public $ConfirmDecline; //int(11)
	public $Price; //decimal(10.2)

	public $connection;
	

	function __construct(){
		$this->connection = new DataBaseMysql();
	} public function myreal_escape_string($string){
		return $this->connection->real_escape_string($string);
	}

	public function New_v4_OrderRequest($ID,$OrderKey,$OrderID,$TNo,$DriverID,$ReturnTransfer,$RequestType,$RequestDate,$RequestTime,$ResponseDate,$ResponseTime,$ConfirmDecline,$Price){
		$this->ID = $ID;
		$this->OrderKey = $OrderKey;
		$this->OrderID = $OrderID;
		$this->TNo = $TNo;
		$this->DriverID = $DriverID;
		$this->ReturnTransfer = $ReturnTransfer;
		$this->RequestType = $RequestType;
		$this->RequestDate = $RequestDate;
		$this->RequestTime = $RequestTime;
		$this->ResponseDate = $ResponseDate;
		$this->ResponseTime = $ResponseTime;
		$this->ConfirmDecline = $ConfirmDecline;
		$this->Price = $Price;
	}

	public function fieldValues(){
		$fieldValues = array(
			'ID' => $this->getID(),
			'OrderKey' => $this->getOrderKey(),
			'OrderID' => $this->getOrderID(),
			'TNo' => $this->getTNo(),
			'DriverID' => $this->getDriverID(),
			'ReturnTransfer' => $this->getReturnTransfer(),
			'RequestType' => $this->getRequestType(),
			'RequestDate' => $this->getRequestDate(),
			'RequestTime' => $this->getRequestTime(),
			'ResponseDate' => $this->getResponseDate(),
			'ResponseTime' => $this->getResponseTime(),
			'ConfirmDecline' => $this->getConfirmDecline(),
			'Price' => $this->getPrice()
			);
		return $fieldValues;
	}
	public function fieldNames(){
		$fieldNames = array('ID','OrderKey','OrderID','TNo','DriverID','ReturnTransfer','RequestType','RequestDate','RequestTime','ResponseDate','ResponseTime','ConfirmDecline','Price');
		return $fieldNames;
	}
	
	public function getRow($key_row){
		$result = $this->connection->RunQuery("Select * from v4_OrderRequests where ID = \"$key_row\" ");
		if($result->num_rows < 1) return false;
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->ID = $row["ID"];
			$this->OrderKey = $row["OrderKey"];
			$this->OrderID = $row["OrderID"];
			$this->TNo = $row["TNo"];
			$this->DriverID = $row["DriverID"];
			$this->ReturnTransfer = $row["ReturnTransfer"];
			$this->RequestType = $row["RequestType"];
			$this->RequestDate = $row["RequestDate"];
			$this->RequestTime = $row["RequestTime"];
			$this->ResponseDate = $row["ResponseDate"];
			$this->ResponseTime = $row["ResponseTime"];
			$this->ConfirmDecline = $row["ConfirmDecline"];
			$this->Price = $row["Price"];
		}
	}

	public function deleteRow($key_row){
		$this->connection->RunQuery("DELETE FROM v4_OrderRequests WHERE ID = $key_row");
	}
	
		public function saveRow(){
		$result = $this->connection->RunQuery("UPDATE v4_OrderRequests set 
ID = '".$this->myreal_escape_string($this->ID)."', 
OrderKey = '".$this->myreal_escape_string($this->OrderKey)."', 
OrderID = '".$this->myreal_escape_string($this->OrderID)."', 
TNo = '".$this->myreal_escape_string($this->TNo)."', 
DriverID = '".$this->myreal_escape_string($this->DriverID)."', 
ReturnTransfer = '".$this->myreal_escape_string($this->ReturnTransfer)."', 
RequestType = '".$this->myreal_escape_string($this->RequestType)."', 
RequestDate = '".$this->myreal_escape_string($this->RequestDate)."',
RequestTime = '".$this->myreal_escape_string($this->RequestTime)."',
ResponseDate = '".$this->myreal_escape_string($this->ResponseDate)."',
ResponseTime = '".$this->myreal_escape_string($this->ResponseTime)."',
ConfirmDecline = '".$this->myreal_escape_string($this->ConfirmDecline)."',
Price = '".$this->myreal_escape_string($this->Price)."' WHERE ID = '".$this->ID."'");
	return $result; 
}

	public function saveAsNew(){
		$this->connection->RunQuery("INSERT INTO v4_OrderRequests (OrderKey, OrderID, TNo, DriverID, ReturnTransfer, RequestType, RequestDate, RequestTime, ResponseDate, ResponseTime, ConfirmDecline, Price) values ('".$this->myreal_escape_string($this->OrderKey)."', '".$this->myreal_escape_string($this->OrderID)."', '".$this->myreal_escape_string($this->TNo)."', '".$this->myreal_escape_string($this->DriverID)."', '".$this->myreal_escape_string($this->ReturnTransfer)."','".$this->myreal_escape_string($this->RequestType)."','".$this->myreal_escape_string($this->RequestDate)."','".$this->myreal_escape_string($this->RequestTime)."','".$this->myreal_escape_string($this->ResponseDate)."','".$this->myreal_escape_string($this->ResponseTime)."','".$this->myreal_escape_string($this->ConfirmDecline)."','".$this->myreal_escape_string($this->Price)."')");

		return $this->connection->insert_id(); //return insert_id 
	}

	public function getKeysBy($column, $order, $where = NULL){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT ID from v4_OrderRequests $where ORDER BY $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["ID"];
				$i++;
			}
		return $keys;
	}

	public function getID(){
		return $this->ID;
	}
	public function getOrderKey(){
		return $this->OrderKey;
	}
	public function getOrderID(){
		return $this->OrderID;
	}	
	public function getTNo(){
		return $this->TNo;
	}	
	public function getDriverID(){
		return $this->DriverID;
	}	
	public function getReturnTransfer(){
		return $this->ReturnTransfer;
	}	
	public function getRequestType(){
		return $this->RequestType;
	}	
	public function getRequestDate(){
		return $this->RequestDate;
	}
	public function getRequestTime(){
		return $this->RequestTime;
	}
	public function getResponseDate(){
		return $this->ResponseDate;
	}	
	
	public function getResponseTime(){
		return $this->ResponseTime;
	}
	public function getConfirmDecline(){
		return $this->ConfirmDecline;
	}
	public function getPrice(){
		return $this->Price;
	}
	
	public function setID($ID){
		$this->ID = $ID;
	}	
	public function setOrderKey($OrderKey){
		$this->OrderKey = $OrderKey;
	}
	public function setOrderID($OrderID){
		$this->OrderID = $OrderID;
	}
	public function setTNo($TNo){
		$this->TNo = $TNo;
	}	
	public function setDriverID($DriverID){
		$this->DriverID = $DriverID;
	}	
	public function setReturnTransfer($ReturnTransfer){
		$this->ReturnTransfer = $ReturnTransfer;
	}	
	public function setRequestType($RequestType){
		$this->RequestType = $RequestType;
	}	
	public function setRequestDate($RequestDate){
		$this->RequestDate = $RequestDate;
	}	
	public function setRequestTime($RequestTime){
		$this->RequestTime = $RequestTime;
	}	
	public function setResponseDate($ResponseDate){
		$this->ResponseDate = $ResponseDate;
	}	
	public function setResponseTime($ResponseTime){
		$this->ResponseTime = $ResponseTime;
	}	
	public function setConfirmDecline($ConfirmDecline){
		$this->ConfirmDecline = $ConfirmDecline;
	}	
	public function setPrice($Price){
		$this->Price = $Price;
	}


	public function v4_OrderRequest(){
		$this->connection->CloseMysql();
	}	
}