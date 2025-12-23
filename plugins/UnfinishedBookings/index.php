<?
require_once ROOT . '/db/v4_AuthUsers.class.php';
require_once ROOT . '/db/v4_Customers.class.php';
require_once ROOT . '/db/v4_OrderDetailsTemp.class.php';
require_once ROOT . '/db/v4_OrderDetails.class.php';
require_once ROOT . '/db/v4_OrdersMasterTemp.class.php';

$au = new v4_AuthUsers();
$cu = new v4_Customers();
$od = new v4_OrderDetailsTemp();
$odM = new v4_OrderDetails();
$om = new v4_OrdersMasterTemp();

if (!isset($_REQUEST['sortOrder'])) $_REQUEST['sortOrder']="DetailsID DESC";

$whereOD=" WHERE ((AgentID=53 and CustomerID>0) or (AgentID<>53)) AND ";
$whereOD.="
	".$filter_users." `UserID`>0 and 
	`OrderID` in (SELECT MOrderID FROM `v4_OrdersMasterTemp` WHERE  
		`MUserLevelID` in (2,3) and 
		`MUserID`>0 and 
		TIMESTAMP(MOrderDate, MOrderTime) < DATE_SUB(UTC_TIMESTAMP(), INTERVAL 15 MINUTE) and
		`MOrderKey` not in (SELECT `MCardNumber` FROM `v4_OrdersMaster` WHERE `MCardNumber`>0)
	)";

if (isset($_REQUEST['extraServices']) && $_REQUEST['extraServices']!=-1) 
	$whereOD.=" AND ExtraCharge".$_REQUEST['extraServices']." ";


if (isset($_REQUEST['Search']) && !empty($_REQUEST['Search'])) {
	$whereCUS=" WHERE CONCAT(`CustFirstName`,'',`CustLastName`) LIKE '%".$_REQUEST['Search']."%'";					
	$cuk=$cu->getKeysBy("CustID","",$whereCUS);
	$whereAUS = " WHERE AuthUserRealName LIKE '%".$_REQUEST['Search']."%' ";
	$auk=$au->getKeysBy("AuthUserID","",$whereAUS);
	$cukeys=implode(",",$cuk);
	$aukeys=implode(",",$auk);
	$whereOD.=" AND (";
	if (!empty($cukeys)) $whereOD.="`CustomerID` in (".$cukeys.") OR ";
	//else $whereOD.="`CustomerID`=0";	
	if (!empty($aukeys)) $whereOD.=" `AgentID` in (".$aukeys.") OR ";
	//else $whereOD.=" OR `AgentID`=0";

	$dColumns = array(
		'PaxName',
		'PickupName',
		'DropName',
		'PickupDate',
		'AgentID'	
	);
	for ( $i=0 ; $i< count($dColumns) ; $i++ ) {
		$whereOD.= $dColumns[$i]." LIKE '%".$_REQUEST['Search']."%' OR ";			
	}	
	$whereOD = substr_replace( $whereOD, "", -3 );	
	$whereOD.=")";
	
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
	$transfers=array();	
	if ($od->getUserLevelID()==2) {
		$row['UserName']=$users[$od->getUserID()]->AuthUserRealName;
		$row['UserPhone']=$users[$od->getUserID()]->AuthUserMob;
		$row['UserEmail']=$users[$od->getUserID()]->AuthUserMail;
		$row['UserLink']="users/".$od->getAgentID();
	}	
	else {
		$cu->getRow($od->getCustomerID());
		$row['UserName']=$cu->getCustFirstName()." ".$cu->getCustLastName();
		$row['UserPhone']=$cu->getCustMobile();
		$row['UserEmail']=$cu->getCustEmail();
		$row['Level']="<span class='badge'>".$cu->getLevelID()."</span>";
		$row['UserLink']="customers/".$cu->getCustID();
		$whereODM=" WHERE CustomerID=".$od->getCustomerID();
		$odkM=$odM->getKeysBy("DetailsID","",$whereODM);
		foreach ($odkM as $keyM) {
			$odM->getRow($keyM);
			$transfersrow = array(
					"TransferID" => $odM->getDetailsID(),
					"TransferText" => $odM->getOrderID().'-'.$odM->getTNo(),
					"OrderDate" => $odM->getOrderDate(),
					"PickupDate" => $odM->getPickupDate(),
					"PickupName" => $odM->getPickupName(),
					"DropName" => $odM->getDropName(),
					"DetailPrice" => $odM->getDetailPrice(),
					"TransferStatus" => $odM->getTransferStatus()
			);
			$transfers[]=$transfersrow;
		}
	}	
	$row['transfers']=$transfers;
	$row['AgentName']=$users[$od->getAgentID()]->AuthUserRealName;
	$row['VehicleTypeName']=$vehicletypes[$od->getVehicleType()]->VehicleTypeName;
	if ($row['TransferStatus']==6) $row['Step']="No service";
	elseif ($row['DriverID']==0) $row['Step']="Select service";
	else $row['Step']="Input data";
	
	$oid_arr[]=$od->getOrderID();
	$did_arr[]=$od->getDetailsID();
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

$smarty->assign("pages",$pages);
$smarty->assign("ordersD",$ordersD);

$smarty->assign("countObject",$countObject);
$smarty->assign("offsetFrom",$offsetFrom);
$smarty->assign("offsetTo",$offsetTo);
$smarty->assign("pagesno",$pagesno);


