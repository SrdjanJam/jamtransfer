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

Class sb_Routes {

	public $RouteID; 
	public $OwnerID; 
	public $RouteName; 
	public $FromToLL; 
	public $Line; 
	public $Distance; 
	public $Duration; 
	public $Price; 
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
	public function New_sb_Routes($OwnerID,$RouteName,$FromToLL,$Line,$Distance,$Duration,$Price){
		$this->OwnerID = $OwnerID;
		$this->RouteName = $RouteName;
		$this->FromToLL = $FromToLL;
		$this->Line = $Line;
		$this->Distance = $Distance;
		$this->Duration = $Duration;
		$this->Price = $Price;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function getRow($key_row){
		$result = $this->connection->RunQuery("Select * from sb_Routes where RouteID = \"$key_row\" ");
		if($result->num_rows < 1) return false;
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->RouteID = $row["RouteID"];
			$this->OwnerID = $row["OwnerID"];
			$this->RouteName = $row["RouteName"];
			$this->FromToLL = $row["FromToLL"];
			$this->Line = $row["Line"];
			$this->Distance = $row["Distance"];
			$this->Duration = $row["Duration"];
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
		$this->connection->RunQuery("DELETE FROM sb_Routes WHERE RouteID = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function saveRow(){
		$result = $this->connection->RunQuery("UPDATE sb_Routes set 
OwnerID = '".$this->myreal_escape_string($this->OwnerID)."', 
RouteName = '".$this->myreal_escape_string($this->RouteName)."', 
FromToLL = JSON_MERGE_PATCH(`FromToLL`,'".$this->FromToLL."'), 
Line = JSON_MERGE_PATCH(`Line`,'".$this->Line."'), 
Distance = '".$this->myreal_escape_string($this->Distance)."', 
Duration = '".$this->myreal_escape_string($this->Duration)."', 
Price = '".$this->myreal_escape_string($this->Price)."' WHERE RouteID = '".$this->RouteID."'");
	return $result; 
}

    /**
     * Save the active var class as a new row on table
     */
	public function saveAsNew(){
		$this->connection->RunQuery("INSERT IGNORE INTO sb_Routes (OwnerID, RouteName, FromToLL, Line, Distance, Duration, Price) values (
		'".$this->myreal_escape_string($this->OwnerID)."',
		'".$this->myreal_escape_string($this->RouteName)."',
		JSON_MERGE_PATCH(`FromToLL`,'".$this->myreal_escape_string($this->FromToLL)."'),
		JSON_MERGE_PATCH(`Line`,'".$this->myreal_escape_string($this->Line)."'),
		'".$this->myreal_escape_string($this->Distance)."',
		'".$this->myreal_escape_string($this->Duration)."',
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
		$result = $this->connection->RunQuery("SELECT RouteID from sb_Routes $where ORDER BY $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["RouteID"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return OwnerID - int(10) unsigned
	 */
	public function getOwnerID(){
		return $this->OwnerID;
	}

	/**
	 * @return RouteID - int(10) unsigned
	 */
	public function getRouteID(){
		return $this->RouteID;
	}

	/**
	 * @return RouteName - varchar(255)
	 */
	public function getRouteName(){
		return $this->RouteName;
	}

	/**
	 * @return FromToLL - varchar(255)
	 */
	public function getFromToLL(){
		return $this->FromToLL;
	}

	/**
	 * @return Line - varchar(255)
	 */
	public function getLine(){
		return str_replace("\"","",$this->Line);
	}

	/**
	 * @return Distance - varchar(255)
	 */
	public function getDistance(){
		return $this->Distance;
	}

	/**
	 * @return Duration - int(5) unsigned
	 */
	public function getDuration(){
		return $this->Duration;
	}

	/**
	 * @return Price - int(5) unsigned
	 */
	public function getPrice(){
		return $this->Price;
	}

	/**
	 * @param Type: int(10) unsigned
	 */
	public function setOwnerID($OwnerID){
		$this->OwnerID = $OwnerID;
	}

	/**
	 * @param Type: int(10) unsigned
	 */
	public function setRouteID($RouteID){
		$this->RouteID = $RouteID;
	}

	/**
	 * @param Type: varchar(255)
	 */
	public function setRouteName($RouteName){
		$this->RouteName = $RouteName;
	}

	/**
	 * @param Type: varchar(255)
	 */
	public function setFromToLL($FromToLL){
		$this->FromToLL = $FromToLL;
	}

	/**
	 * @param Type: varchar(255)
	 */
	public function setLine($Line){
		$this->Line = $Line;
	}

	/**
	 * @param Type: varchar(255)
	 */
	public function setDistance($Distance){
		$this->Distance = $Distance;
	}

	/**
	 * @param Type: int(5) unsigned
	 */
	public function setDuration($Duration){
		$this->Duration = $Duration;
	}

	/**
	 * @param Type: int(5) unsigned
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
			'OwnerID' => $this->getOwnerID(),
			'RouteID' => $this->getRouteID(),
			'RouteName' => $this->getRouteName(),
			'FromToLL' => $this->getFromToLL(),
			'Line' => $this->getLine(),
			'Distance' => $this->getDistance(),
			'Duration' => $this->getDuration(),
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
			'OwnerID',			'RouteID',			'RouteName',			'FromToLL',			'Line',			'Distance',			'Duration',			'Price'		);
		return $fieldNames;
	}
    /**
     * Close mysql connection
     */
	public function endsb_Routes(){
		$this->connection->CloseMysql();
	}

}