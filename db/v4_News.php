<?php

require_once 'db.class.php';

Class v4_News {

	public $NewsID; //int(11)
  	public $Keywords; //text
  	public $Header; //text
  	public $ShortHtml; //text
  	public $Html; //longtext
  	public $PublishingDate; //varchar(10)
  	public $Date; //varchar(10)
  	public $Image; //varchar(255)
  	public $ImageThumb; //varchar(255)
  	public $Link; //varchar(255)
  	public $Active; //tinyint(1)
  	public $CreatedBy; //varchar(255)
  	public $CreatedDate; //varchar(10)

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
	public function New_v4_Actions($NewsID,$Keywords,$Header,$ShortHtml,$Html,$PublishingDate,$Date,$Image,$ImageThumb,$Link,$Active,$CreatedBy,$CreatedDate){
		$this->NewsID = $NewsID;
		$this->Keywords = $Keywords;
		$this->Header = $Header;
		$this->ShortHtml = $ShortHtml;		
		$this->Html = $Html;
		$this->PublishingDate = $PublishingDate;
		$this->Date = $Date;
		$this->Image = $Image;
		$this->ImageThumb = $ImageThumb;
		$this->$Link = $Link;
		$this->$Active = $Active;
		$this->$CreatedBy = $CreatedBy;
		$this->$CreatedDate = $CreatedDate;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function getRow($key_row){
		$result = $this->connection->RunQuery("Select * from v4_News where NewsID = \"$key_row\" ");
		if($result->num_rows < 1) return false;
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->NewsID = $row["NewsID"];
			$this->Keywords = $row["Keywords"];
			$this->Header = $row["Header"];
			$this->ShortHtml = $row["ShortHtml"];			
			$this->Html = $row["Html"];
			$this->PublishingDate = $row["PublishingDate"];			
			$this->Date = $row["Date"];			
			$this->Image = $row["Image"];			
			$this->ImageThumb = $row["ImageThumb"];			
			$this->Link = $row["Link"];			
			$this->Active = $row["Active"];			
			$this->CreatedBy = $row["CreatedBy"];			
			$this->CreatedDate = $row["CreatedDate"];			
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function deleteRow($key_row){
		$this->connection->RunQuery("DELETE FROM v4_News WHERE NewsID = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function saveRow(){
		$result = $this->connection->RunQuery("UPDATE v4_News set 
NewsID = '".$this->myreal_escape_string($this->NewsID)."', 
Keywords = '".$this->myreal_escape_string($this->Keywords)."', 
Header = '".$this->myreal_escape_string($this->Header)."', 
ShortHtml = '".$this->myreal_escape_string($this->ShortHtml)."', 
Html = '".$this->myreal_escape_string($this->Html)."', 
PublishingDate = '".$this->myreal_escape_string($this->PublishingDate)."',
Date = '".$this->myreal_escape_string($this->Date)."',
Image = '".$this->myreal_escape_string($this->Image)."',
Link = '".$this->myreal_escape_string($this->Link)."',
Active = '".$this->myreal_escape_string($this->Active)."',
CreatedBy = '".$this->myreal_escape_string($this->CreatedBy)."',
CreatedDate = '".$this->myreal_escape_string($this->CreatedDate)."'
 WHERE NewsID = '".$this->NewsID."'");
	return $result; 
}

    /**
     * Save the active var class as a new row on table
     */
	public function saveAsNew(){
		$this->connection->RunQuery("INSERT INTO v4_News (NewsID, Keywords, Header, ShortHtml, Html, PublishingDate, Date, Image, ImageThumb, Link, Active, CreatedBy, CreatedDate) values ('".$this->myreal_escape_string($this->NewsID)."',
		'".$this->myreal_escape_string($this->Keywords)."',
		'".$this->myreal_escape_string($this->Header)."',
		'".$this->myreal_escape_string($this->ShortHtml)."',		
		'".$this->myreal_escape_string($this->Html)."',		
		'".$this->myreal_escape_string($this->Date)."',
		'".$this->myreal_escape_string($this->Image)."',
		'".$this->myreal_escape_string($this->ImageThumb)."',
		'".$this->myreal_escape_string($this->Link)."',
		'".$this->myreal_escape_string($this->Active)."',
		'".$this->myreal_escape_string($this->CreatedBy)."',
		'".$this->myreal_escape_string($this->CreatedDate)."'
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
		$result = $this->connection->RunQuery("SELECT NewsID from v4_News $where ORDER BY $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["NewsID"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return NewsID - int(11)
	 */
	public function getNewsID(){
		return $this->NewsID;
	}

	/**
	 * @return Keywords - text
	 */
	public function getKeywords(){
		return $this->Keywords;
	}
	
	/**
	 * @return Header - text
	 */
	public function getHeader(){
		return $this->Header;
	}	

	/**
	 * @return ShortHtml - text
	 */
	public function getShortHtml(){
		return $this->ShortHtml;
	}
	
	/**
	 * @return Html - longtext
	 */
	public function getHtml(){
		return $this->Html;
	}

	/**
	 * @return PublishingDate - varchar(10)
	 */
	public function getPublishingDate(){
		return $this->PublishingDate;
	}

	/**
	 * @return Date - varchar(10)
	 */
	public function getDate(){
		return $this->Date;
	}

	/**
	 * @return Image - varchar(255)
	 */
	public function getImage(){
		return $this->Image;
	}

	/**
	 * @return ImageThumb - varchar(255)
	 */
	public function getImageThumb(){
		return $this->ImageThumb;
	}

	/**
	 * @return Link - varchar(255)
	 */
	public function getLink(){
		return $this->Link;
	}

	/**
	 * @return Active - tinyint(1)
	 */
	public function getActive(){
		return $this->Active;
	}

	/**
	 * @return CreatedBy - varchar(255)
	 */
	public function getCreatedBy(){
		return $this->CreatedBy;
	}

	/**
	 * @return CreatedDate - varchar(10)
	 */
	public function getCreatedDate(){
		return $this->CreatedDate;
	}


	// ---------------------------------------------
	// SET:
	
	/**
	 * @param Type: int(11)
	 */
	public function setNewsID($NewsID){
		$this->NewsID = $NewsID;
	}

	/**
	 * @param Type: text
	 */
	public function setKeywords($Keywords){
		$this->Keywords = $Keywords;
	}

	/**
	 * @param Type: text
	 */
	public function setHeader($Header){
		$this->Header = $Header;
	}
	
	/**
	 * @param Type: text
	 */
	public function setShortHtml($ShortHtml){
		$this->ShortHtml = $ShortHtml;
	}
	
	/**
	 * @param Type: longtext
	 */
	public function setHtml($Html){
		$this->Html = $Html;
	}

	/**
	 * @param Type: varchar(10)
	 */
	public function setDate($Date){
		$this->Date = $Date;
	}

	/**
	 * @param Type: varchar(255)
	 */
	public function setImage($Image){
		$this->Image = $Image;
	}

	/**
	 * @param Type: varchar(255)
	 */
	public function setImageThumb($ImageThumb){
		$this->ImageThumb = $ImageThumb;
	}

	/**
	 * @param Type: varchar(255)
	 */
	public function setLink($Link){
		$this->Link = $Link;
	}

	/**
	 * @param Type: tinyint(1)
	 */
	public function setActive($Active){
		$this->Active = $Active;
	}

	/**
	 * @param Type: varchar(255)
	 */
	public function setCreatedBy($CreatedBy){
		$this->CreatedBy = $CreatedBy;
	}
	
	/**
	 * @param Type: varchar(10)
	 */
	public function setCreatedDate($CreatedDate){
		$this->CreatedDate = $CreatedDate;
	}

    /**
     * fieldValues - Load all fieldNames and fieldValues into Array. 
     *
     * @param 
     * 
     */
	public function fieldValues(){
		$fieldValues = array(
			'NewsID' => $this->getNewsID(),
			'Keywords' => $this->getKeywords(),
			'Header' => $this->getHeader(),
			'ShortHtml' => $this->getShortHtml(),			
			'Html' => $this->getHtml(),			
			'PublishingDate' => $this->getPublishingDate(),
			'Date' => $this->getDate(),
			'Image' => $this->getImage(),
			'ImageThumb' => $this->getImageThumb(),
			'Link' => $this->getLink(),
			'Active' => $this->getActive(),
			'CreatedBy' => $this->getCreatedBy(),
			'CreatedDate' => $this->getCreatedDate()
		
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
			'NewsID',			
			'Keywords',		
			'Header',		
			'ShortHtml',			
			'Html',		
			'PublishingDate',		
			'Date',		
			'Image',		
			'ImageThumb',		
			'Link',		
			'Active',		
			'CreatedBy',		
			'CreatedDate',		
		);
		return $fieldNames;
	}
    /**
     * Close mysql connection
     */
	public function endv4_News(){
		$this->connection->CloseMysql();
	}

}