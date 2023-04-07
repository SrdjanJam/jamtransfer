<?
error_reporting(E_ALL);
	$expense=109;

	// check list
	$checklist=array();
	$ids="";


	$sqls="SELECT `ID`,`Datum`  FROM `v4_SubActivity` WHERE `OwnerID`=".$_SESSION['UseDriverID']." and `Expense`=".$expense." and `VehicleID`=".$vehicleID." ORDER by Datum DESC Limit 5";
	$query=mysqli_query($db->conn, $sqls) or die('Error in SubActivity query' . mysqli_connect_error());
	while($list = mysqli_fetch_object($query) ) {
		$list_row=array();
		$list_row['id']=$list->ID;
		$list_row['datum']=$list->Datum;
		$list_all[]=$list_row;
		$ids.=$list->ID.",";
	}	
	$ids = substr($ids,0,strlen($ids)-1);
	

	$sqls2="SELECT * FROM `v4_ActionRequestItem`,`v4_Request` 
		WHERE `ID`=v4_ActionRequestItem.`RequestID` AND `ActionID`=".$expense." ORDER BY `DisplayOrder`";
	$query2=mysqli_query($db->conn, $sqls2) or die('Error in RequestCheckList query' . mysqli_connect_error());
	while($list2 = mysqli_fetch_object($query2) ) {
		$checklist_row=array();
		$checklist_row['title']=$list2->Title;
		$checklist_row['active']=$list2->Active;
		$sqls3="SELECT * FROM `v4_TaskCheckList` WHERE `ActivityID` in (".$ids. ") AND  `RequestID`=".$list2->RequestID;
		$query3=mysqli_query($db->conn, $sqls3) or die('Error in TaskCheckList query' . mysqli_connect_error());
		//$list3=mysqli_fetch_object($query3);
		while($list3 = mysqli_fetch_object($query3) ) {
			$checklist_row['check'][$list3->ActivityID]=0;			
			if ($list2->Active==1) $checklist_row['check'][$list3->ActivityID]=1;
			if ($list2->Active==2) $checklist_row['photo'][$list3->ActivityID]=$list3->Photo;
		}
		$checklist[]=$checklist_row;	
	}
	$smarty->assign('list_all',$list_all);
	$smarty->assign('checklist',$checklist);
	$smarty->assign('pageList',false);
