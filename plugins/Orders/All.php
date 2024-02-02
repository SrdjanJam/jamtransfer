<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';

@session_start();

# sastavi filter - posalji ga $_REQUEST-om
if (isset($type)) {
	if (!isset($_REQUEST['Type']) or $_REQUEST['Type'] == 0 or $_REQUEST['Type'] == 99) {
		$filter = "  AND ".$type." != 0 ";
	}
	else {
		$filter = "  AND ".$type." = '" . $_REQUEST['Type'] . "'";
	}
}
if (isset($type2)) {
	if (!isset($_REQUEST['Type2']) or $_REQUEST['Type2'] == 0 or $_REQUEST['Type2'] == 99) {
		$filter .= "  AND ".$type2." != 0 ";
	}
	else {
		if ($_REQUEST['Type2']==7) $Type2=2;
		else $Type2=$_REQUEST['Type2'];
		$filter .= "  AND ".$type2." = '" . $Type2 . "'";
	}
}
	if (isset($_REQUEST['transfersFilter'])) {
		$today              = strtotime("today 00:00");
		$yesterday          = strtotime("yesterday 00:00");
		$datetime 			= new DateTime('tomorrow');
		$tomorrow 			= $datetime->format('Y-m-d');
		$lastWeek 			= strtotime("yesterday -1 week 00:00");

		$today = date("Y-m-d", $today);
		$lastWeek= date("Y-m-d", $lastWeek);
		
		switch ($_REQUEST['transfersFilter']) {
			case 'noDriver':
				$filter .= " AND DriverConfStatus ='0' AND TransferStatus < '3'";	
				break;
			
			case 'notConfirmed':
				$filter .= " AND DriverConfStatus = '1' AND TransferStatus < '3'";
				break;			
				
			case 'notConfirmedToday': 
				$filter .= " AND PickupDate = '".$today ."' AND (DriverConfStatus = '1' OR DriverConfStatus = '4') AND TransferStatus < '3'";
				break;	
				
			case 'notConfirmedTomorrow':
				$filter .= " AND PickupDate = '".$tomorrow ."' AND (DriverConfStatus = '1' OR DriverConfStatus = '4')  AND TransferStatus < '3'";
				break;			
				
			case 'confirmed':
				$filter .= " AND (DriverConfStatus ='2' OR DriverConfStatus ='3') AND TransferStatus < '3'";
				break;			
				
			case 'declined':
				$filter .= " AND DriverConfStatus ='4' AND TransferStatus < '3'";
				break;			
				
			case 'canceled':
				$filter .= " AND TransferStatus = '3'";
				break;			
				
			case 'noShow':
				$filter .= " AND DriverConfStatus = '5'";
				break;			
				
			case 'driverError':
				$filter .= " AND DriverConfStatus = '6'";
				break;			
				
			case 'notCompleted':
				$filter .= " AND TransferStatus < '3' AND PickupDate <  (CURRENT_DATE)-INTERVAL 1 DAY ";  
				break;			
				
			case 'active':
				$filter .= " AND TransferStatus < '3'";
				break;			
				
			case 'newTransfers':
				$filter .= " AND TransferStatus < '3' AND OrderDate >= '" . date("Y-m-d", time()-3600*24) . "' ";
				break;			
				
			case 'tomorrow':
				$filter .= " AND TransferStatus < '3' AND PickupDate = '" . $tomorrow . "'";
				break;			
				
			case 'deleted':
				$filter .= " AND TransferStatus = '9'";
				break;			
				
			case 'agent':
				$filter .= " AND UserLevelID = '2'";
				break;			
				
			case 'notConfirmedAgent':
				$filter .= " AND DriverConfStatus = '1' AND TransferStatus < '3' AND UserLevelID = '2'";
				break;			
				
			case 'invoice2':
				$filter .= " AND PaymentMethod = '6'";
				break;			
				
			case 'agentinvoice':
				$filter .= " AND (PaymentMethod = '4' OR PaymentMethod = '6')";
				break;			
				
			case 'online':
				$filter .= " AND (PaymentMethod = '1' OR PaymentMethod = '3')";
				break;			
				
			case 'cash':
				$filter .= " AND PaymentMethod = '2'";
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
				$filter .= " AND PickupDate = ' '";
				break;				
				
			case 'order':
				$oid_arr=explode('-',$_REQUEST['orderid']);
				if (count($oid_arr)>1) {
					$oid=rtrim($oid_arr[0]);
					$tn=rtrim($oid_arr[1]);
					$filter .= " AND OrderID = ".$oid." AND TNo = ".$tn;
				}
				else $filter .= " AND OrderID = ".$_REQUEST['orderid'];					
				break;				
				
			case 'detail':
				$filter .= " AND DetailsID = ".$_REQUEST['detailid'];		
				$_REQUEST['orderToDate']=date('Y-m-d',time());				
				break;			
		}		
	}	

if(!isset($_REQUEST['page'])) $_REQUEST['page']="";
if(!isset($_REQUEST['length'])) $_REQUEST['length']="";
if(!isset($_REQUEST['orderFromDate']) || empty($_REQUEST['orderFromDate'])) {
	if(isset($_COOKIE['orderFromDateC'])) $_REQUEST['orderFromDate']=$_COOKIE['orderFromDateC'];
	else $_REQUEST['orderFromDate']=date('Y-m-d',time()-365*24*3600);
}	
if(!isset($_REQUEST['pickupFromDate']) || empty($_REQUEST['pickupFromDate'])) { 
	if(isset($_COOKIE['pickupFromDateC'])) $_REQUEST['pickupFromDate']=$_COOKIE['pickupFromDateC'];
	else $_REQUEST['pickupFromDate']=date('Y-m-d',time()-365*24*3600);
}
if(!isset($_REQUEST['orderToDate']) || empty($_REQUEST['orderToDate'])) {
	if(isset($_COOKIE['orderToDateC'])) $_REQUEST['orderToDate']=$_COOKIE['orderToDateC'];
	else $_REQUEST['orderToDate']=date('Y-m-d',time());
}	
if(!isset($_REQUEST['pickupToDate']) || empty($_REQUEST['pickupToDate'])) { 
	if(isset($_COOKIE['pickupToDateC'])) $_REQUEST['pickupToDate']=$_COOKIE['pickupToDateC'];
	else $_REQUEST['pickupToDate']=date('Y-m-d',time()+365*24*3600);
}
if(!isset($_REQUEST['paymentNumber'])) $_REQUEST['paymentNumber']="";
if(!isset($_REQUEST['order'])) $_REQUEST['order']="";
if(!isset($_REQUEST['locationName'])) $_REQUEST['locationName']="";
if(!isset($_REQUEST['driverName'])) $_REQUEST['driverName']="";
if(!isset($_REQUEST['agentName'])) $_REQUEST['agentName']="";
if(!isset($_REQUEST['agentOrder'])) $_REQUEST['agentOrder']="";
if(!isset($_REQUEST['passengerData'])) $_REQUEST['passengerData']="";
if(!isset($_REQUEST['paymentMethod'])) $_REQUEST['paymentMethod']=0;
if(!isset($_REQUEST['driverConfStatus'])) $_REQUEST['driverConfStatus']=-1;
if(!isset($_REQUEST['yearsOrder'])) $_REQUEST['yearsOrder']="";
if(!isset($_REQUEST['yearsPickup'])) $_REQUEST['yearsPickup']="";
if(!isset($_REQUEST['sortField'])) $_REQUEST['sortField']="";
if(!isset($_REQUEST['sortDirection'])) $_REQUEST['sortDirection']="";
$page 		= $_REQUEST['page'];
$length 	= $_REQUEST['length'];
//$sortOrder 	= $_REQUEST['sortOrder'];
$orderFromDate 	= $_REQUEST['orderFromDate'];
setcookie("orderFromDateC", $orderFromDate, time() + (7*24*60*60),"/");
$pickupFromDate 	= $_REQUEST['pickupFromDate'];
setcookie("pickupFromDateC", $pickupFromDate, time() + (7*24*60*60),"/");
$orderToDate 	= $_REQUEST['orderToDate'];
setcookie("orderToDateC", $orderToDate, time() + (7*24*60*60),"/");
$pickupToDate 	= $_REQUEST['pickupToDate'];
setcookie("pickupToDateC", $pickupToDate, time() + (7*24*60*60),"/");
$paymentNumber 	= $_REQUEST['paymentNumber'];
$order 	= $_REQUEST['order'];
$locationName 	= $_REQUEST['locationName'];
$driverName 	= $_REQUEST['driverName'];
$agentName 	= $_REQUEST['agentName'];
$agentOrder 	= $_REQUEST['agentOrder'];
$passengerData 	= $_REQUEST['passengerData'];
$paymentMethod 	= $_REQUEST['paymentMethod'];
$driverConfStatus 	= $_REQUEST['driverConfStatus'];
$yearsOrder 	= $_REQUEST['yearsOrder'];
$yearsPickup 	= $_REQUEST['yearsPickup'];
$sortField 	= $_REQUEST['sortField'];
$sortDirection 	= $_REQUEST['sortDirection'];
$listExtras 	= $_REQUEST['listExtras'];
$paymentChecker = $_REQUEST['paymentChecker'];
$flightTimeChecker = $_REQUEST['flightTimeChecker'];
$longTerm = $_REQUEST['longTerm'];
$preOrder = $_REQUEST['preOrder'];

$start = ((int)$page * (int)$length) - (int)$length;
// var_dump($start);

if ($length > 0) {
	$limit = ' LIMIT ' .$start . ','. $length;
}
else $limit = ' LIMIT 0, ' .$length;

//if(empty($sortOrder)) $sortOrder = 'ASC';
if(empty($sortField)) $sortField = 'PickupDate';
if(empty($sortDirection)) $sortDirection = 'DESC';


# init vars
$out = array();
$flds = array();

$dbWhere = " " . $_REQUEST['where'];
$dbWhere .= $filter;

if (isset($_SESSION['UseDriverID']))  $dbWhere .=	" AND v4_OrderDetails.DriverID = '".$_SESSION['UseDriverID']."' ";

if (isset($_REQUEST['document'])) {
	$documentType=$_REQUEST['document'];
	if ($documentType>0 && $documentType<10) {	 
		//$where = ' WHERE DocumentType = '.$documentType;
		$where='';
		$group = ' GROUP BY OrderID';
		$odock = $odoc->getKeysByMax('ID', 'desc' , $where , $group );
		$orders_arr="";
		if (count($odock)>0) {
			foreach ($odock as $dnn => $key)
			{
				# document row
				$odoc->getRow($key); 
				$documentOrderID=$odoc->getOrderID();
				if ($odoc->getDocumentType()==$documentType)
					$orders_arr.=$documentOrderID.",";
			}
			$orders_arr = substr($orders_arr,0,strlen($orders_arr)-1);
			$dbWhere .=" AND OrderID IN (".$orders_arr.") ";
		}
	}	


	if ($documentType>9) {	
		$cd=$documentType-10;
		$query="SELECT * FROM `v4_VoutcherOrderRequests` WHERE ConfirmDecline=".$cd;
		$result = $db->RunQuery($query);
		$orders_arr="";
		while($row = $result->fetch_array(MYSQLI_ASSOC)){ 			
			$orders_arr.=$row['OrderID'].",";
		}

		$orders_arr = substr($orders_arr,0,strlen($orders_arr)-1);
		$dbWhere .=" AND OrderID IN (".$orders_arr.") "; 

	}
}
# dodavanje search parametra u qry
# DB_Where sad ima sve potrebno za qry
if ( $_REQUEST['Search'] != "" )
{
	$dbWhere .= " AND (";

	for ( $i=0 ; $i< count($aColumns) ; $i++ )
	{
		# If column name exists
		if ($aColumns[$i] != " ")
		$dbWhere .= $aColumns[$i]." LIKE '%"
		.$od->myreal_escape_string( $_REQUEST['Search'] )."%' OR ";
	}
	$dbWhere = substr_replace( $dbWhere, "", -3 );
	$dbWhere .= ')';
}
if ($listExtras==1) $dbWhere .= " AND ExtraCharge >0 ";

if ($paymentMethod>0) $dbWhere .= " AND PaymentMethod = ".$paymentMethod;
if ($driverConfStatus>-1) $dbWhere .= " AND DriverConfStatus = ".$driverConfStatus;
if ($paymentNumber<>'') $dbWhere .= " AND (MCardNumber = '".$paymentNumber."' OR 
											InvoiceNumber ='".$paymentNumber."' OR 
											DriverInvoiceNumber ='".$paymentNumber."')";
if ($orderFromDate<>'') $dbWhere .= " AND OrderDate >= '".$orderFromDate."'";
if ($pickupFromDate<>'') $dbWhere .= " AND PickupDate >= '".$pickupFromDate."'";
if ($orderToDate<>'') $dbWhere .= " AND OrderDate <= '".$orderToDate."'";
if ($pickupToDate<>'') $dbWhere .= " AND PickupDate <= '".$pickupToDate."'";
if ($order<>'') $dbWhere .= " AND OrderID = '".$order."'";
if (strlen($locationName)>2) $dbWhere .= " AND (PickupName LIKE ('%".$locationName."%') OR 
													DropName LIKE ('%".$locationName."%')) ";
$queryDrivers="SELECT AuthUserID FROM v4_AuthUsers WHERE AuthUserRealName LIKE ('%".$driverName."%') 
														OR AuthUserID = '".$driverName."'";												
if (strlen($driverName)>2) $dbWhere .= " AND (v4_OrderDetails.DriverID IN (".$queryDrivers.") OR v4_OrderDetails.SubDriver IN (".$queryDrivers.") OR v4_OrderDetails.SubDriver2 IN (".$queryDrivers.")) ";
$queryAgents="SELECT AuthUserID FROM v4_AuthUsers WHERE (AuthUserRealName LIKE ('%".$agentName."%') OR AuthUserID = '".$agentName."')";	
if ($_REQUEST['Type2']==7) 	$queryAgents.= 	" AND NOT(`Image` is NULL or `Image`=' ') ";
//else $queryAgents.= " AND (`Image` is NULL or `Image`=' ') ";
if (strlen($agentName)>2 || $_REQUEST['Type2']==7) $dbWhere .= " AND v4_OrderDetails.AgentID IN (".$queryAgents.") ";
if (strlen($agentOrder)>2) $dbWhere .= " AND ( MConfirmFile LIKE ('%".$agentOrder."%') OR
												MOrderKey LIKE ('%".$agentOrder."%') ) ";
if (strlen($passengerData)>2) $dbWhere .= " AND (MPaxFirstName LIKE ('%".$passengerData."%') OR 
													MPaxLastName LIKE ('%".$passengerData."%') OR
													MPaxTel LIKE ('%".$passengerData."%') OR
													MPaxEmail LIKE ('%".$passengerData."%') OR
													FlightNo LIKE ('%".$passengerData."%')) ";
if ($longTerm==1) 	$dbWhere .= " AND PriceClassID=2 ";											
if ($preOrder==1) 	$dbWhere .= " AND PriceClassID=1 ";											
// pravljenje filtera
// year of OrderDate
$query='SELECT YEAR(`OrderDate`) as yearOrder FROM `v4_OrderDetails`,`v4_OrdersMaster` '.$dbWhere.' AND MOrderID=OrderID group by YEAR(`OrderDate`) order by yearOrder DESC';
$result = $dbT->RunQuery($query);
$odYearsOrder=array();
while($row = $result->fetch_array(MYSQLI_ASSOC)){ 			
	$odYearsOrder[]=$row['yearOrder'];
}
if ($yearsOrder>0) $dbWhere .= " AND YEAR(`OrderDate`)=".$yearsOrder;

// year of PickupDate
/*$query='SELECT YEAR(`PickupDate`) as yearPickup FROM `v4_OrderDetails`,`v4_OrdersMaster` '.$dbWhere.' AND MOrderID=OrderID group by YEAR(`PickupDate`) order by yearPickup DESC';
$result = $dbT->RunQuery($query);
$odYearsPickup=array();
while($row = $result->fetch_array(MYSQLI_ASSOC)){ 			
	$odYearsPickup[]=$row['yearPickup'];
}
if ($yearsPickup>0) $dbWhere .= " AND YEAR(`PickupDate`)=".$yearsPickup;*/

//ako je dat orderid onda se drugi filteri ponistavaju
$showfilter=1;
if ($_REQUEST['orderid']<>"0") {
	$showfilter=0;
	$oid_arr=explode('-',$_REQUEST['orderid']);
	if (count($oid_arr)>1) {
		$oid=rtrim($oid_arr[0]);
		$tn=rtrim($oid_arr[1]);
		$dbWhere = " WHERE OrderID = ".$oid." AND TNo = ".$tn;
	}
	else $dbWhere = " WHERE OrderID = ".$_REQUEST['orderid'];			
	//if (isset($_SESSION['UseDriverID']))  $dbWhere .=	" AND v4_OrderDetails.DriverID = '".$_SESSION['UseDriverID']."' ";	
}
	
	
// checkers
if ($flightTimeChecker==1) {
	$dbk = $od->getFullOrderByDetailsID($sortField, $sortDirection, ''  , $dbWhere);
	if (count($dbk) != 0) {
		foreach ($dbk as $nn => $key)
		{	
			$od->getRow($key);
			$PickupID=$od->getPickupID();
			$DropID=$od->getDropID();
			$Duration='';
			if ($PickupID!=0) {
				$pl->getRow($PickupID);
				$PickupPlaceType=$pl->getPlaceType();
			}
			if ($DropID!=0) {
				$pl->getRow($DropID);
				$DropPlaceType=$pl->getPlaceType();	
			}
			$RouteID=$od->getRouteID();
			if ($RouteID>0) {
				$rt->getRow($RouteID);
				$Duration=$rt->getDuration();
			}			
			
			# flight conflict
			$ConflictTime=false;
			$ptA=explode(':',$od->getPickupTime());
			$pt=60*$ptA[0]+$ptA[1];
			$ftA=explode(':',$od->getFlightTime());
			$ft=60*$ftA[0]+$ftA[1];
			if ($PickupPlaceType==1) {	
				$TimeDiff=$pt-$ft;
				if ($TimeDiff<0 || $TimeDiff>120) $ConflictColor='red';
				else $ConflictColor='';
			} else if ($DropPlaceType==1) {	
				$TimeDiff=$ft-$pt-$Duration-120;
				if ($TimeDiff<-60) $ConflictColor='red';
				else if ($TimeDiff<0) $ConflictColor='yellow';
				else $ConflictColor='';
			} else {
				$TimeDiff=0;
				$ConflictColor='';
			}
			$ConflictColorArr[$key]=$ConflictColor;
			$TimeDiffArr[$key]=$TimeDiff;

			if ($ConflictColor=='red' || $ConflictColor=='yellow') {
				$fligt_time_conflict  .= $key. ",";
			}	
		}
		$fligt_time_conflict = substr($fligt_time_conflict,0,strlen($fligt_time_conflict)-1);
		$dbWhere .= " AND DetailsID in (".$fligt_time_conflict.")";
	}	
}	

if ($paymentChecker==1) {
	//niz order logova sa promenjenim cenama
	$sql="SELECT `DetailsID`  FROM `v4_OrderLog` WHERE `Description` like ('%PAYMENT DATA CHANGE%') group by `DetailsID`";
	$query=mysqli_query($dbT->conn, $sql) or die('Error in query' . mysqli_connect_error());
	while( $l = mysqli_fetch_object($query) ) {
		$list[]=$l->DetailsID;
	}	
	$dbk = $od->getFullOrderByDetailsID($sortField, $sortDirection, ''  , $dbWhere);
	if (count($dbk) != 0) {
		foreach ($dbk as $nn => $key)
		{	
			$od->getRow($key);
			$PayDiff=$od->getDetailPrice()+$od->getExtraCharge()-$od->getPayNow()-$od->getPayLater()-$od->getInvoiceAmount()-$od->getProvisionAmount();
			$ConflictColor='';
			$PayDiffArr[$key]="";			
			if ($PayDiff>0.5 || $PayDiff<-0.5) {
				$ConflictColor='red lighten-5';
				$payment_conflict  .= $key. ",";
				$PayDiffArr[$key]=number_format($PayDiff,2)." € difference";				
			}
			$pm=$od->getPaymentMethod();
			if (
				($pm==1 && $od->getPayNow()==0) ||
				($pm==3 && $od->getPayNow()==0) ||
				($pm==2 && $od->getPayLater()==0) ||
				($pm==3 && $od->getPayLater()==0) ||
				($pm==4 && $od->getInvoiceAmount()==0) ||
				($pm==6 && $od->getInvoiceAmount()==0) 
			) {
				$ConflictColor='red';
				$PayDiffArr[$key]="Wrong Payment Type";								
				$payment_conflict  .= $key. ",";
			}	
			if (in_array($key,$list)) {
				$ConflictColor='yellow';
				$PayDiffArr[$key]="Payment Data Change";	
				$payment_conflict  .= $key. ",";
			}
			
			if($od->SubDriver>0 && $od->TransferStatus>4 && $od->TransferStatus<9 && $od->PayLater>0 && $od->CashIn != $od->PayLater) {
				$ConflictColor='red lighten-3';
				$PayDiffArr[$key]="Cash Difference";	
				$payment_conflict  .= $key. ",";
			}
			$PayConflictColorArr[$key]=$ConflictColor;
			
		}
		$payment_conflict = substr($payment_conflict,0,strlen($payment_conflict)-1);
		$dbWhere .= " AND DetailsID in (".$payment_conflict.")";		
	}
}

if ($_REQUEST['lid']<>0) {
	$listLID=array();
	$sql="SELECT `DetailsID`  FROM `v4_OrderLog` WHERE `UserID`= ".$_REQUEST['lid']." AND `Action`='".$_REQUEST['lac']."'";
	$query=mysqli_query($dbT->conn, $sql) or die('Error in query' . mysqli_connect_error());
	while( $l = mysqli_fetch_object($query) ) {
		$lid_details  .=$l->DetailsID.",";
	}
	$lid_details = substr($lid_details ,0,strlen($lid_details)-1);
	$dbWhere .= " AND DetailsID in (".$lid_details .")";	
}

if ($_REQUEST["action"]<>"null" && $_REQUEST["action"]<>"0") {
	//niz order logova sa datom timeline akcijom
	$sql="SELECT `DetailsID`,`UserID`  FROM `v4_OrderLog` WHERE `Action` = '".$_REQUEST["action"]."' group by `DetailsID`";
	$query=mysqli_query($dbT->conn, $sql) or die('Error in query' . mysqli_connect_error());
	while( $lTL = mysqli_fetch_object($query) ) {
		$list_tl  .= $lTL->DetailsID. ",";
	}
	$list_tl = substr($list_tl,0,strlen($list_tl)-1);
	$dbWhere .= " AND DetailsID in (".$list_tl.")";
}
	
$odTotalRecords = $od->getFullOrderByDetailsID($sortField, $sortDirection, '' , $dbWhere);


// report
$sum=array();
$dbWhere=str_replace('DetailsID','v4_OrderDetails.DetailsID',$dbWhere);
$sql = "Select count(*) as ItemNumber,";
if ($_REQUEST["reportBy"]=="monthOrderDate") $_REQUEST["reportBy"]="month(OrderDate)";
if ($_REQUEST["reportBy"]=="monthPickupDate") $_REQUEST["reportBy"]="month(PickupDate)";
if ($_REQUEST["action"]<>"0") $sql .="v4_OrderLog.UserID";
else $sql .=$_REQUEST["reportBy"];	
$sql .=" as Name,
	sum(DriversPrice) as DriversPrice,
	sum(DetailPrice) as DetailPrice,
	sum(ExtraCharge) as ExtraCharge,
	sum(DriverExtraCharge) as DriverExtraCharge,
	sum(Provision) as Provision,
	sum(Discount*DetailPrice/100) as Discount
FROM v4_OrderDetails,v4_OrdersMaster";
if ($_REQUEST["action"]<>"0") $sql .=",v4_OrderLog ";
$sql .=$dbWhere;
if ($_REQUEST["action"]<>"0") {
	$sql .= " AND v4_OrderLog.DetailsID=v4_OrderDetails.DetailsID ";
	$sql .= " AND Action='".$_REQUEST["action"]."'";
	if ($_REQUEST["lid"]<>"0") $sql .= " AND v4_OrderLog.UserID=".$_REQUEST["lid"];
}
$sql .= " AND v4_OrderDetails.OrderID=v4_OrdersMaster.MOrderID ";

$sql .= " GROUP by Name";
$r = $dbT->RunQuery($sql);
//$result=$r->fetch_object();
while ($result = $r->fetch_object()) {	
	$row=array();
	if ($_REQUEST["action"]<>"0") {
		$row['LogUserID']=$result->Name;
		//$row['LogAction']=ltrim(str_replace(" ","_",$_REQUEST["action"]));
		$row['LogAction']=$_REQUEST["action"];
		$row['Name']=$users[$result->Name]->AuthUserRealName;
	}	
	else {
		$row['LogUserID']=0;
		$row['LogAction']=0;		
		if ($_REQUEST["reportBy"]=="UserID") $row['Name']=$users[$result->Name]->AuthUserRealName;
		if ($_REQUEST["reportBy"]=="UserLevelID") $row['Name']=$levels_array[$result->Name];
		if ($_REQUEST["reportBy"]=="PaymentMethod") $row['Name']=$PaymentMethod[$result->Name];
		if ($_REQUEST["reportBy"]=="DriverConfStatus") $row['Name']=$DriverConfStatus[$result->Name];
		if ($_REQUEST["reportBy"]=="TransferStatus") $row['Name']=$StatusDescription[$result->Name];
		if ($_REQUEST["reportBy"]=="DriverID") $row['Name']=$users[$result->Name]->AuthUserRealName;	
		if ($_REQUEST["reportBy"]=="SubDriver") $row['Name']=$users[$result->Name]->AuthUserRealName;	
		if ($_REQUEST["reportBy"]=="month(OrderDate)") $row['Name']=$monthNames[$result->Name];	
		if ($_REQUEST["reportBy"]=="month(PickupDate)") $row['Name']=$monthNames[$result->Name];	
		if ($_REQUEST["reportBy"]=="RouteID") {
			$rt->getRow($result->Name);
			$row['Name']=$rt->getRouteNameEN();	
		}		
		if ($_REQUEST["reportBy"]=="PickupID" || $_REQUEST["reportBy"]=="DropID") {
			$pl->getRow($result->Name);
			$row['Name']=$pl->getPlaceNameEN();	
		}	
		if (empty($row['Name']))	$row['Name']="ID ".$result->Name;
	}	
	$row['ItemNumber']=$result->ItemNumber;
	$ItemNumberSum+=$row['ItemNumber'];
	$row['DriversPrice']=number_format($result->DriversPrice*$_SESSION['CurrencyRate'],2);
	$DriversPriceSum+=$result->DriversPrice;
	$row['DetailPrice']=number_format($result->DetailPrice*$_SESSION['CurrencyRate'],2);
	$DetailPriceSum+=$result->DetailPrice;
	$row['ExtraCharge']=number_format($result->ExtraCharge*$_SESSION['CurrencyRate'],2);
	$ExtraChargeSum+=$result->ExtraCharge;
	$row['DriverExtraCharge']=number_format($result->DriverExtraCharge*$_SESSION['CurrencyRate'],2);
	$DriverExtraChargeSum+=$result->DriverExtraCharge;	
	$row['Provision']=number_format($result->Provision*$_SESSION['CurrencyRate'],2);
	$ProvisionSum+=$result->Provision;	
	$row['Discount']=number_format($result->Discount*$_SESSION['CurrencyRate'],2);
	$DiscountSum+=$result->Discount;		
	$gm=$result->DetailPrice+$result->ExtraCharge-$result->Provision-$result->DriversPrice-$result->DriverExtraCharge;
	$row['GrossMargin'] = number_format($gm*$_SESSION['CurrencyRate'],2);
	
	if($gm == 0){
		$gm = 1;
		$row['Ratio']=number_format(($gm*100/($result->DriversPrice+$result->DriverExtraCharge))*$_SESSION['CurrencyRate'],2);
	}
	
	$sum[]=$row;
	
}	
if ($_REQUEST["reportBy"]=="month(OrderDate)") $_REQUEST["reportBy"]="monthOrderDate";
if ($_REQUEST["reportBy"]=="month(PickupDate)") $_REQUEST["reportBy"]="monthPickupDate";

$row['Name']="TOTAL";
$row['ItemNumber']=$ItemNumberSum;
$row['DriversPrice']=number_format($DriversPriceSum*$_SESSION['CurrencyRate'],2);
$row['DetailPrice']=number_format($DetailPriceSum*$_SESSION['CurrencyRate'],2);
$row['ExtraCharge']=number_format($ExtraChargeSum*$_SESSION['CurrencyRate'],2);
$row['DriverExtraCharge']=number_format($DriverExtraChargeSum,2);
$row['Provision']=number_format($ProvisionSum*$_SESSION['CurrencyRate'],2);
$row['Discount']=number_format($DiscountSum*$_SESSION['CurrencyRate'],2);
$gm=$DetailPriceSum+$ExtraChargeSum-$ProvisionSum-$DriversPriceSum-$DriverExtraChargeSum;
$row['GrossMargin'] = number_format($gm,2);

if($gm == 0){
	$gm = 1;
	$row['Ratio']=number_format(($gm*100/($DriversPriceSum+$DriverExtraChargeSum))*$_SESSION['CurrencyRate'],2);
}

$sum[]=$row;

// Old:
// usort($sum,function($first,$second){
// 	return $first["ItemNumber"] < $second["ItemNumber"];
// });

// For PHP 8:
usort($sum,function($first,$second){

	$first = $first["ItemNumber"];
	$second = $second["ItemNumber"];

	if ($first === $second) {
        return 0;
    }

	return $first < $second ? 1 : -1;

});

$dbk = $od->getFullOrderByDetailsID($sortField, $sortDirection, $limit  , $dbWhere);

if (count($dbk) != 0) {
    foreach ($dbk as $nn => $key)
    {
    	$od->getRow($key);    	
    	
		# OrderID za OrdersMaster
		$OrderID = $od->getOrderID();

		# master key
		$omk = $om->getKeysBy('MOrderID', 'asc' , ' WHERE MOrderID = ' . $OrderID);

		# master row
		$om->getRow($omk[0]);

		# get fields and values
		$detailFlds = $od->fieldValues();

		
		$detailFlds['DriversPrice'] = number_format($od->getDriversPrice()*$_SESSION['CurrencyRate'],2);
		$detailFlds['DetailPrice'] = number_format($od->getDetailPrice()*$_SESSION['CurrencyRate'],2);
		$detailFlds['ExtraCharge'] = number_format($od->getExtraCharge()*$_SESSION['CurrencyRate'],2);
		$detailFlds['DriverExtraCharge'] = number_format($od->getDriverExtraCharge()*$_SESSION['CurrencyRate'],2);
		$detailFlds['VehicleTypeName'] = $vehicletypes[$od->getVehicleType()]->VehicleTypeName;
		# document key
		/*$odock = $odoc->getKeysBy('DocumentDate', 'desc' , ' WHERE OrderID = ' . $OrderID);
		if (count($odock)>0) {
			# document row
			$odoc->getRow($odock[0]);
			$detailFlds["Document"]=$odoc->getDocumentCode();	
			$detailFlds["DocumentDate"]=$odoc->getDocumentDate();
			if ($odoc->getDocumentType()==3) $detailFlds["DocumentType"]=$odoc->getDocumentType()+1;	
			else $detailFlds["DocumentType"]=$odoc->getDocumentType();
		}	
		else {
			$detailFlds["Document"]="No document";
			$detailFlds["DocumentDate"]="";	
			$detailFlds["DocumentType"]=0;	
		}*/	

		$ordermonth=date("m",strtotime($od->getOrderDate()));
		$orderyear=date("Y",strtotime($od->getOrderDate()));
		$orderym=$orderyear*12+$ordermonth;
		
		$pickupmonth=date("m",strtotime($od->getPickupDate()));
		$pickupyear=date("Y",strtotime($od->getPickupDate()));
		$pickupym=$pickupyear*12+$pickupmonth;	
		
		if ($orderym==$pickupym) $detailFlds["Advance"]=2;
		else $detailFlds["Advance"]=99;

		//zamena naziva mesta sa engleskim nazivom iz tabele places
		$PickupID=$od->getPickupID();
		$DropID=$od->getDropID();
		if ($PickupID!=0) {
			$pl->getRow($PickupID);
			$detailFlds["PickupName"]=$pl->getPlaceNameEN(); 
		}
		if ($DropID!=0) {
			$pl->getRow($DropID);
			$detailFlds["DropName"]=$pl->getPlaceNameEN();
		}
		
		$detailFlds["ConflictColor"] = $ConflictColorArr[$key];
		$detailFlds["TimeDiff"] = $TimeDiffArr[$key];
		$detailFlds["PayConflictColor"] = $PayConflictColorArr[$key];
		$detailFlds["PayDiff"] = $PayDiffArr[$key];
				
		# get fields and values
		$masterFlds = $om->fieldValues();
		if ($om->getMCardCountry()!=0) $masterFlds['CountryPhonePrefix'] = getCountryPrefix( $om->getMCardCountry() );
		else $masterFlds['CountryPhonePrefix'] = '';
		$masterFlds['UserName']=$users[$om->getMUserID()]->AuthUserRealName;
		$masterFlds['Image']=$users[$om->getMUserID()]->Image;

		
		$out[] = array_merge($detailFlds , $masterFlds);    	  	
    }
}
# send output back
$output = array(
'sum' =>$sum,
'showfilter' => $showfilter,
'draw' => '0',
'orderFromDate' => $orderFromDate,
'pickupFromDate' => $pickupFromDate,
'orderToDate' => $orderToDate,
'pickupToDate' => $pickupToDate,
'sortField' => $sortField,
'sortDirection' => $sortDirection,
'paymentNumber' => $paymentNumber,
'locationName' => $locationName,
'driverName' => $driverName,
'agentName' => $agentName,
'agentOrder' => $agentOrder,
'passengerData' => $passengerData,
'paymentMethod' => $paymentMethod,
'driverConfStatus' => $driverConfStatus,
'yearsOrder' => $odYearsOrder,
'yearsPickup' => $odYearsPickup,
'recordsTotal' => count($odTotalRecords),
'recordsFiltered' => $length,
'reportBy' => $_REQUEST["reportBy"],
'action' => $_REQUEST["action"],
'data' =>$out
);
echo $_GET['callback'] . '(' . json_encode($output) . ')';	