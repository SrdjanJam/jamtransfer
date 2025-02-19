<?
require_once ROOT . '/db/v4_AuthUsers.class.php';
require_once ROOT . '/db/v4_OrderDetails.class.php';
require_once ROOT . '/db/v4_OrdersMaster.class.php';
require_once ROOT . '/db/v4_OrderExtras.class.php';
require_once ROOT . '/db/v4_Extras.class.php';
require_once ROOT . '/db/v4_ExtrasMaster.class.php';

$au = new v4_AuthUsers();
$od = new v4_OrderDetails();
$om = new v4_OrdersMaster();
$oe = new v4_OrderExtras();
$ex = new v4_Extras();
$em = new v4_ExtrasMaster();
$time1=microtime();

if (!isset($_REQUEST['filterDatePeriod'])) $_REQUEST['filterDatePeriod']="OrderDate>=";
if (!isset($_REQUEST['filterDate'])) $_REQUEST['filterDate']=date("Y-m-d",time()-3600*24*365);
if (!isset($_REQUEST['sortOrder'])) $_REQUEST['sortOrder']="OrderDate DESC";
 

$whereOD=" WHERE TransferStatus!=9 AND ";
$whereOD.=$_REQUEST['filterDatePeriod']."'".$_REQUEST['filterDate']."'";
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

$odk=$od->getKeysBy("OrderDate Desc","",$whereOD);
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
	$ordersD[]=$row;
}
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
$extrasmaster=array();
$emk=$em->getKeysBy("ID",""," WHERE 1=1");
foreach ($emk as $key) {
	$em->getRow($key);
	$extrasmaster[]=$em->fieldValues();
}

$smarty->assign('status_keys',array_keys($StatusDescription));

$smarty->assign("pages",$pages);
$smarty->assign("ordersD",$ordersD);
$smarty->assign("extrasM",$extrasmaster);

$smarty->assign("countObject",$countObject);
$smarty->assign("offsetFrom",$offsetFrom);
$smarty->assign("offsetTo",$offsetTo);
$smarty->assign("pagesno",$pagesno);
$smarty->assign("extrasALL",(array) $extras);

$smarty->assign("durtime",microtime()-$time1);

