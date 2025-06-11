<?
require_once ROOT . '/db/v4_AuthUsers.class.php';
require_once ROOT . '/db/v4_OrderDetails.class.php';
require_once ROOT . '/db/v4_OrdersMaster.class.php';
require_once ROOT . '/db/v4_OrderExtras.class.php';
require_once ROOT . '/db/v4_Extras.class.php';
require_once ROOT . '/db/v4_ExtrasMaster.class.php';
require_once ROOT . '/db/v4_Vehicles.class.php';
require_once ROOT . '/db/v4_AuthLevels.class.php';

$au = new v4_AuthUsers();
$od = new v4_OrderDetails();
$om = new v4_OrdersMaster();
$oe = new v4_OrderExtras();
$ex = new v4_Extras();
$em = new v4_ExtrasMaster();
$vh = new v4_Vehicles();
$al = new v4_AuthLevels();
$time1=microtime();
if (!isset($_REQUEST['sortOrder'])) {
	switch ($transfersFilter) {
		case 'noDriver':
			$_REQUEST['sortOrder'] = "PickupDate ASC";	
			break;
		case 'notConfirmed':
			$_REQUEST['sortOrder'] = "PickupDate ASC";
			break;			
		case 'notConfirmedTodayTomorrow':
			$_REQUEST['sortOrder'] = "PickupDate ASC";
			break;	
		case 'notAssign':
			$_REQUEST['sortOrder'] = "PickupDate ASC";
			break;						
		case 'confirmed':
			$_REQUEST['sortOrder'] = "PickupDate ASC";
			break;			
		case 'declined':
			$_REQUEST['sortOrder'] = "PickupDate ASC";
			break;			
		case 'canceled':
			$_REQUEST['sortOrder'] = "PickupDate ASC";
			break;			
		case 'noShow':
			$_REQUEST['sortOrder'] = "PickupDate DESC";
			break;			
		case 'driverError':
			$_REQUEST['sortOrder']= "PickupDate DESC";
			break;			
		case 'notCompleted':
			$_REQUEST['sortOrder']= "PickupDate ASC";  
			break;			
		case 'active':
			$_REQUEST['sortOrder']= "PickupDate ASC";
			break;			
		case 'newTransfers':
			$_REQUEST['sortOrder']= "OrderDate DESC";
			break;			
		case 'tomorrow':
			$_REQUEST['sortOrder']= "PickupDate ASC";  
			break;			
		case 'deleted':
			$_REQUEST['sortOrder']= "OrderDate DESC";
			break;			
		case 'agent':
			$_REQUEST['sortOrder']= "OrderDate DESC";
			break;			
		case 'notConfirmedAgent':
			$_REQUEST['sortOrder']= "PickupDate ASC";
			break;			
		case 'invoice2':
			$_REQUEST['sortOrder']= "OrderDate DESC";
			break;			
		case 'agentinvoice':
			$_REQUEST['sortOrder']= "OrderDate DESC";
			break;			
		case 'online':
			$_REQUEST['sortOrder']= "OrderDate DESC";
			break;			
		case 'cash':
			$_REQUEST['sortOrder']= "OrderDate DESC";
			break;		
		default:	
			$_REQUEST['sortOrder']= "OrderDate DESC";
			break;
	}
} 

$whereOD=" WHERE TransferStatus!=9";
if (isset($transfersFilter) && !empty($transfersFilter)) {
	switch ($transfersFilter) {
		case 'noDriver':
			$whereOD .= " AND DriverConfStatus ='0' AND TransferStatus < '3'";	
			break;
		case 'notConfirmed':
			$whereOD .= " AND DriverConfStatus = '1' AND TransferStatus < '3'";
			break;			
		case 'notConfirmedTodayTomorrow':
			$whereOD .= " AND (PickupDate = '".date("Y-m-d", time()+3600*24)  ."' OR PickupDate = '".date("Y-m-d", time())  ."') AND (DriverConfStatus = '1' OR DriverConfStatus = '4')  AND TransferStatus < '3'";
			break;	
		case 'notAssign':
			$whereOD .= " AND PickupDate > '".date("Y-m-d", time()) ."' AND PickupDate < ('".date('Y-m-d')."'+INTERVAL 4 DAY) AND DriverConfStatus = '2' AND TransferStatus < '3'";
			break;						
		case 'confirmed':
			$whereOD .= " AND (DriverConfStatus ='2' OR DriverConfStatus ='3') AND TransferStatus < '3'";
			break;			
		case 'declined':
			$whereOD .= " AND DriverConfStatus ='4' AND TransferStatus < '3'";
			break;			
		case 'canceled':
			$whereOD .= " AND TransferStatus = '3'";
			break;			
		case 'noShow':
			$whereOD .= " AND DriverConfStatus = '5'";
			break;			
		case 'driverError':
			$whereOD .= " AND DriverConfStatus = '6'";
			break;			
		case 'notCompleted':
			$whereOD .= " AND TransferStatus < '3' AND PickupDate <  (CURRENT_DATE)-INTERVAL 1 DAY ";  
			break;			
		case 'active':
			$whereOD .= " AND TransferStatus < '3'";
			break;			
		case 'newTransfers':
			$whereOD .= " AND TransferStatus < '3' AND OrderDate >= '" . date("Y-m-d", time()-3600*24) . "' ";
			break;			
		case 'tomorrow':
			$whereOD .= " AND TransferStatus < '3' AND PickupDate = '" . date("Y-m-d", time()+3600*24)  . "'";
			break;			
		case 'deleted':
			$whereOD .= " AND TransferStatus = '9'";
			break;			
		case 'agent':
			$whereOD .= " AND UserLevelID = '2'";
			break;			
		case 'notConfirmedAgent':
			$whereOD .= " AND DriverConfStatus = '1' AND TransferStatus < '3' AND UserLevelID = '2'";
			break;			
		case 'invoice2':
			$whereOD .= " AND PaymentMethod = '6'";
			break;			
		case 'agentinvoice':
			$whereOD .= " AND (PaymentMethod = '4' OR PaymentMethod = '6')";
			break;			
		case 'online':
			$whereOD .= " AND (PaymentMethod = '1' OR PaymentMethod = '3')";
			break;			
		case 'cash':
			$whereOD .= " AND PaymentMethod = '2'";
			break;			
		case 'proforma':
			$documentFilter = 1;
			break;			
		case 'invoice':
			$documentFilter = 3;
			break;			
		case 'invoice':
			$documentFilter = 3;
			break;				
		case 'noDate':
			$whereOD .= " AND PickupDate = ' '";
			break;				
		case 'order':
			$oid_arr=explode('-',$_REQUEST['orderid']);
			if (count($oid_arr)>1) {
				$oid=rtrim($oid_arr[0]);
				$tn=rtrim($oid_arr[1]);
				$whereOD .= " AND OrderID = ".$oid." AND TNo = ".$tn;
			}
			else $whereOD .= " AND OrderID = ".$_REQUEST['orderid'];					
			break;				
		case 'detail':
			$whereOD .= " AND DetailsID = ".$_REQUEST['detailid'];		
			$_REQUEST['orderToDate']=date('Y-m-d',time());				
			break;			
	}
}		
else {
	if (!isset($_REQUEST['filterDatePeriod'])) $_REQUEST['filterDatePeriod']="OrderDate>=";
	if (!isset($_REQUEST['filterDate'])) $_REQUEST['filterDate']=date("Y-m-d",time()-3600*24*365);
	$whereOD.= " AND ". $_REQUEST['filterDatePeriod']."'".$_REQUEST['filterDate']."'";
}	

//$whereOD.="`OrderDate`>CURDATE()- INTERVAL 1 YEAR";
if (isset($_REQUEST['extraServices']) && $_REQUEST['extraServices']!=-1) 
	$whereOD.=" AND ExtraCharge".$_REQUEST['extraServices']." ";
if (isset($_REQUEST['transferStatus']) && $_REQUEST['transferStatus']>0) 
	$whereOD.=" AND TransferStatus=".$_REQUEST['transferStatus']." ";

if (isset($_REQUEST['Search']) && !empty($_REQUEST['Search'])) {
	$whereOMS=" WHERE ";
	$mColumns = array(
		'MPaxEmail',
		'MPaxTel',
		'MCardNumber',
		'MOrderKey',
		'MConfirmFile'
	);
	for ( $i=0 ; $i< count($mColumns) ; $i++ ) {
		$whereOMS .= $mColumns[$i]." LIKE '%".$_REQUEST['Search']."%' OR ";			
	}	
	$whereOMS = substr_replace( $whereOMS, "", -3 );
	$omk=$om->getKeysBy("MOrderID","",$whereOMS);
	$whereAUS = " WHERE AuthUserRealName LIKE '%".$_REQUEST['Search']."%' ";
	$auk=$au->getKeysBy("AuthUserID","",$whereAUS);
	$omkeys=implode(",",$omk);
	$aukeys=implode(",",$auk);
	$whereOD.=" AND (";
	if (!empty($omkeys)) $whereOD.="`OrderID` in (".$omkeys.") ";
	else $whereOD.="`OrderID`=0";	
	
	if (!empty($aukeys)) $whereOD.=" OR `UserID` in (".$aukeys.") ";

	$dColumns = array(
		'OrderID',
		'PaxName',
		'PickupName',
		'DropName',
		'PickupDate',
		'InvoiceNumber',
		'UserID',	
		'DriverName',
		'FlightNo',
		'DriverInvoiceNumber',	
	);
	$whereOD.=" OR "; 
	for ( $i=0 ; $i< count($dColumns) ; $i++ ) {
		$whereOD.= $dColumns[$i]." LIKE '%".$_REQUEST['Search']."%' OR ";			
	}	
	$whereOD = substr_replace( $whereOD, "", -3 );	
	$whereOD.=")";
	
	/*	'v4_AuthUsers.AuthUserRealName'*/
}
$smarty->assign('query',$whereOD);

$odk=$od->getKeysBy($_REQUEST['sortOrder'],"",$whereOD);
$countObject=count($odk);
if (!isset($_REQUEST['pagelength'])) $_REQUEST['pagelength']=10;
if (!isset($_REQUEST['pageno'])) $_REQUEST['pageno']=1;
$pagesno=intval($countObject/$_REQUEST['pagelength']);
if ($pagesno!=$countObject/$_REQUEST['pagelength']) $pagesno+=1;
$pages=array();
for ($i=1; $i<$pagesno+1; $i++) $pages[]=$i;
$offset=$_REQUEST['pagelength']*($_REQUEST['pageno']-1);
$offsetFrom=$offset+1;
$offsetTo=$offset+$_REQUEST['pagelength'];

$limitoffset="LIMIT ".$_REQUEST['pagelength']." OFFSET ".$offset;
$odk=$od->getKeysBy($_REQUEST['sortOrder'],$limitoffset,$whereOD);
$ordersD=array();
$oid_arr=array();
foreach ($odk as $key) {
	$od->getRow($key);
	$row=$od->fieldValues();
	if ($od->getTransferStatus()==3) $row['cancel']='btn-danger';
	else $row['cancel']='';
	$row['UserName']=$users[$od->getUserID()]->AuthUserRealName;
	$row['AgentName']=$users[$od->getAgentID()]->AuthUserRealName;
	$row['VehicleTypeName']=$vehicletypes[$od->getVehicleType()]->VehicleTypeName;
	$row['MessageWhtsApp']=sendDriverMessage($od->getDetailsID());
	$row['DriverTel']=$users[$od->getDriverID()]->AuthUserMob;
	
	$oid_arr[]=$od->getOrderID();
	$did_arr[]=$od->getDetailsID();
	$drid_arr[]=$od->getDriverID();
	$ordersD[]=$row;
}
// dodavanje iz OrderMaster tabele
$oids=implode(",",$oid_arr);
if (!empty($oids)) $whereOM=" WHERE `MOrderID` in (".$oids.")";
else $whereOM=" WHERE `MOrderID`=0 ";
$omk=$om->getKeysBy("MOrderDate Desc","",$whereOM);
foreach ($omk as $key) {
	$om->getRow($key);
	$row=$om->fieldValues();
	$keys = array_keys(array_column($ordersD, 'OrderID'),$om->getMOrderID());
	foreach($keys as $key) $ordersD[$key]['Master']=$row;
}
// dodavanje iz OrderExtras tabele
$dids=implode(",",$did_arr);
if (!empty($dids)) $whereOE=" WHERE `OrderDetailsID` in (".$dids.")";
else $whereOE=" WHERE `OrderDetailsID`=0 ";
$oek=$oe->getKeysBy("OrderDetailsID","",$whereOE);
foreach ($oek as $key) {
	$oe->getRow($key);
	$row=$oe->fieldValues();
	$row['MServiceID']=$extras[$row['ServiceID']]->ServiceID;
	$keys = array_keys(array_column($ordersD, 'DetailsID'),$oe->getOrderDetailsID());
	foreach($keys as $key) $ordersD[$key]['ExtrasArr'][]=$row;	
}
// dodavanje iz Extras i Vehicles tabele
$drids=implode(",",$drid_arr);
if (!empty($drids)) $whereEX=" WHERE `OwnerID` in (".$drids.")";
else $whereEX=" WHERE `OwnerID`=0 ";
$exk=$ex->getKeysBy("OwnerID","",$whereEX);
foreach ($exk as $key) {
	$ex->getRow($key);
	$row=$ex->fieldValues();
	$keys = array_keys(array_column($ordersD, 'DriverID'),$ex->getOwnerID());
	foreach($keys as $key) $ordersD[$key]['ExtrasAllArr'][]=$row;	
}
$vhk=$vh->getKeysBy("OwnerID","",$whereEX);
foreach ($vhk as $key) {
	$vh->getRow($key);
	$row=$vh->fieldValues();
	$row["VehicleName"]=$vehicletypes[$vh->getVehicleTypeID()]->VehicleTypeName;
	
	$keys = array_keys(array_column($ordersD, 'DriverID'),$vh->getOwnerID());
	foreach($keys as $key) $ordersD[$key]['VehiclesAll'][]=$row;	
}
// uzimanje iz ExtrasMaster tabele
/*$extrasmaster=array();
$emk=$em->getKeysBy("ID",""," WHERE 1=1");
foreach ($emk as $key) {
	$em->getRow($key);
	$extrasmaster[]=$em->fieldValues();
}*/
// uzimanje iz AuthLevels tabele
$authlevels=array();
$alk=$al->getKeysBy("AuthLevelID",""," WHERE 1=1");
foreach ($alk as $key) {
	$al->getRow($key);
	$authlevels[$key]=$al->getAuthLevelName();
}
// uzimanje user-a
$users_arr=array();
foreach ($users as $user) {
	$row["UserID"]=$user->AuthUserID;
	$row["UserName"]=$user->AuthUserRealName;
	$row["LevelID"]=$user->AuthLevelID;
	$users_arr[]=$row;
}	

$smarty->assign('status_keys',array_keys($StatusDescription));

$smarty->assign("pages",$pages);
$smarty->assign("users",$users_arr);
$smarty->assign("ordersD",$ordersD);
//$smarty->assign("extrasM",$extrasmaster);
$smarty->assign("authLevels",$authlevels);

$smarty->assign("countObject",$countObject);
$smarty->assign("offsetFrom",$offsetFrom);
$smarty->assign("offsetTo",$offsetTo);
$smarty->assign("pagesno",$pagesno);
$smarty->assign("extrasALL",(array) $extras);

$smarty->assign("durtime",microtime()-$time1);

