<?
header('Content-Type: text/javascript; charset=UTF-8');
error_reporting(E_PARSE);
 
	# init libs
	require_once '../../../../f/f.php';

	require_once '../../../../db/db.class.php';
	require_once '../../../../db/v4_SubActivity.class.php';
	require_once '../../../../db/v4_Request.class.php';
	

	# init vars
	$out = array();

	# init class
	$ac = new v4_SubActivity();
	$eq = new v4_Request();
	
	# filters

	$ID = $_REQUEST['ID'];

	# Details  red
	$ac->getRow($ID);

	# get fields and values
	$detailFlds = $ac->fieldValues();
	$vreme_arr=explode(' ',$ac->getDatum());
	
	$detailFlds['Datum1']=$vreme_arr[0];
	$detailFlds['Vreme1']=$vreme_arr[1];

	//select iz redova tabele
	$db = new DataBaseMySql();
	
	// check list
	$checklist=array();
	
	$sqls="SELECT * FROM `v4_ActionRequestItem`,`v4_Request` 
		WHERE `ID`=v4_ActionRequestItem.`RequestID` AND `ActionID`=".$ac->getExpense()."
		 ORDER BY `DisplayOrder`";
	$query=mysqli_query($db->conn, $sqls) or die('Error in RequestCheckList query' . mysqli_connect_error());
	while($list = mysqli_fetch_object($query) ) {
		$checklist_row=array();
		$checklist_row['title']=$list->Title;
		$checklist_row['active']=$list->Active;
		$sqls2="SELECT * FROM `v4_TaskCheckList` WHERE `ActivityID`=".$ID. " AND  `RequestID`=".$list->RequestID;
		$checklist_row['check']=0;
		$query2=mysqli_query($db->conn, $sqls2) or die('Error in TaskCheckList query' . mysqli_connect_error());
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
	echo $_GET['callback'] . '(' . $output . ')';
	