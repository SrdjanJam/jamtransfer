<?php

require_once 'db.class.php';

Class v4_AgentPrices {

	public $ID; //int(10)
	public $AgentID; //int(10)
	public $RouteID; //int(10)	
	public $VehicleTypeID; //int(10)
	public $Price; //decimal(11,3)

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
	public function New_v4_AgentPrices($ID,$AgentID,$RouteID,$VehicleTypeID,$Price){
		$this->ID = $ID;
		$this->AgentID = $AgentID;
		$this->RouteID = $RouteID;		
		$this->VehicleTypeID = $VehicleTypeID;
		$this->Price = $Price;		
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function getRow($key_row){
		$result = $this->connection->RunQuery("Select * from v4_AgentPrices where ID = \"$key_row\" ");
		if($result->num_rows < 1) return false;
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->ID = $row["ID"];
			$this->AgentID = $row["AgentID"];
			$this->RouteID = $row["RouteID"];			
			$this->VehicleTypeID = $row["VehicleTypeID"];
			$this->Price = $row["Price"];			
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function deleteRow($key_row){
		$this->connection->RunQuery("DELETE FROM v4_AgentPrices WHERE ID = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function saveRow(){
		$result = $this->connection->RunQuery("UPDATE v4_AgentPrices set 
		AgentID = '".$this->myreal_escape_string($this->AgentID)."', 
		RouteID = '".$this->myreal_escape_string($this->RouteID)."', 
		VehicleTypeID = '".$this->myreal_escape_string($this->VehicleTypeID)."', 
		Price = '".$this->myreal_escape_string($this->Price)."'
 		WHERE ID = '".$this->ID."'");
		return $result; 
	}

    /**
     * Save the active var class as a new row on table
     */
	public function saveAsNew(){
		$this->connection->RunQuery("INSERT INTO v4_AgentPrices (AgentID, RouteID, VehicleTypeID, Price) values (
		'".$this->myreal_escape_string($this->AgentID)."',
		'".$this->myreal_escape_string($this->RouteID)."',		
		'".$this->myreal_escape_string($this->VehicleTypeID)."',		
		'".$this->myreal_escape_string($this->Price)."')");
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
		$result = $this->connection->RunQuery("SELECT ID from v4_AgentPrices $where ORDER BY $column $order");
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
	 * @return AgentID - int(10)
	 */
	public function getAgentID(){
		return $this->AgentID;
	}

	/**
	 * @return RouteID - int(10)
	 */
	public function getRouteID(){
		return $this->RouteID;
	}
	
	/**
	 * @return VehicleTypeID - int(10)
	 */
	public function getVehicleTypeID(){
		return $this->VehicleTypeID;
	}

	/**
	 * @return Price - decimal(11,3)
	 */
	public function getPrice(){
		return $this->Price;
	}


	// SET METHODS:
	
	/**
	 * @param Type: int(10)
	 */
	public function setID($ID){
		$this->ID = $ID;
	}

	/**
	 * @param Type: int(10)
	 */
	public function setAgentID($AgentID){
		$this->AgentID = $AgentID;
	}

	/**
	 * @param Type: int(10)
	 */
	public function setRouteID($RouteID){
		$this->RouteID = $RouteID;
	}
	
	/**
	 * @param Type: int(10)
	 */
	public function setVehicleTypeID($VehicleTypeID){
		$this->VehicleTypeID = $VehicleTypeID;
	}

	/**
	 * @param Type: decimal(11,3)
	 */
	public function setPrice($Price){
		$this->Price = $Price;
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
			'AgentID' => $this->getAgentID(),
			'RouteID' => $this->getRouteID(),			
			'VehicleTypeID' => $this->getVehicleTypeID(),			
			'Price' => $this->getPrice()		);
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
			'ID',			'AgentID',		'RouteID',			'VehicleTypeID',		'Price'		);
		return $fieldNames;
	}
    /**
     * Close mysql connection
     */
	public function endv4_AgentPrices(){
		$this->connection->CloseMysql();
	}

}