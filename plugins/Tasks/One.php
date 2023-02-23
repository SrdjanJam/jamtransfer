<?
header('Content-Type: text/javascript; charset=UTF-8');
error_reporting(E_PARSE);

require_once 'Initial.php';
	

	# init vars
	$out = array();

	# init class
	// $ac = new v4_SubActivity();
	// $eq = new v4_Request();
	
	# filters

	$ID = $_REQUEST['ItemID'];

	// echo $ID;

	# Details  red
	$db->getRow($ID);

	# get fields and values
	$detailFlds = $db->fieldValues();

	// print_r($detailFlds);

	$vreme_arr=explode(' ',$db->getDatum());


	
	$detailFlds['Datum1']=$vreme_arr[0];
	$detailFlds['Vreme1']=$vreme_arr[1];

	//prethodno select iz redova tabele
	// $db = new DataBaseMySql();

	
	// check list
	$checklist=array();

	// print_r($db);
	
	 $sqls="SELECT * FROM `v4_ActionRequestItem`,`v4_Request` 
		WHERE `ID`=v4_ActionRequestItem.`RequestID` AND `ActionID`=".$db->getExpense()."
		 ORDER BY `DisplayOrder`";

	
	// echo $sqls;

	
	$query=mysqli_query($dbf->conn, $sqls) or die('Error in RequestCheckList query' . mysqli_connect_error());
	while($list = mysqli_fetch_object($query) ) {
		$checklist_row=array();
		$checklist_row['title']=$list->Title;
		$checklist_row['active']=$list->Active;
		$sqls2="SELECT * FROM `v4_TaskCheckList` WHERE `ActivityID`=".$ID. " AND  `RequestID`=".$list->RequestID;
		$checklist_row['check']=0;
		$query2=mysqli_query($dbf->conn, $sqls2) or die('Error in TaskCheckList query' . mysqli_connect_error());
		$list2=mysqli_fetch_object($query2);
		if (isset($list2)) {
			if ($list->Active==1) $checklist_row['check']=1;
			if ($list->Active==2) $checklist_row['photo']=$list2->Photo;
			
		}
		
		
		$checklist[]=$checklist_row;	
		
		
		
	}	
	$detailFlds['checklist']=$checklist;



	$out[] = $detailFlds;
	

	# send output back
	$output = json_encode($out);
	echo $output;
	