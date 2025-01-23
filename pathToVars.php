<?
// aktivna stranica iz url-a	
$baseUrl = "/";
$pathVars = new PathVars($baseUrl);
$activePage = 'dashboard';

$indexStart = ROOT_INDEX;
$size=$pathVars->size();
$specialpage=$pathVars->fetchByIndex($size - 1);
$specialpage2=$pathVars->fetchByIndex($size - 2);	
if ($size>0) $activePage=$pathVars->fetchByIndex($indexStart);
if ($activePage=='code') {
	$_REQUEST['tempPass']=md5($pathVars->fetchByIndex($indexStart + 1));
	$indexStart+=2;
	$activePage=$pathVars->fetchByIndex($indexStart);
}

switch ($activePage) {
	case 'loginAsUser':
		$_REQUEST['sa_u']=$pathVars->fetchByIndex($indexStart + 1);
		$_REQUEST['sa_l']=$pathVars->fetchByIndex($indexStart + 2);
		$activePage = 'dashboard';	
		break;		
		
	case 'satAsDriver':
		$_SESSION['UseDriverID']=$pathVars->fetchByIndex($indexStart + 1);
		require_once ROOT . '/db/v4_AuthUsers.class.php';
		$au = new v4_AuthUsers();
		$au->getRow($_SESSION['UseDriverID']);
		$_SESSION['UseDriverName']=$au->getAuthUserRealName();
		header('Location: '.ROOT_HOME);
		break;		
				
	case 'rules':
		$_REQUEST['rulesType']=$pathVars->fetchByIndex($indexStart + 1);
		if (is_numeric($pathVars->fetchByIndex($indexStart + 2))) {
			$_REQUEST['item']=$pathVars->fetchByIndex($indexStart + 2);
		}
		break;		
		
	case 'routes':
	case 'locations':
	case 'users':
		if ($pathVars->fetchByIndex($indexStart + 1)=="NT") $ActionID="NT";	
		break;		
		
	case 'driverReOrder':
		if ($pathVars->fetchByIndex($indexStart + 1)) { 
			$_REQUEST['OrderID']=$pathVars->fetchByIndex($indexStart + 1);
			$_REQUEST['TNo']=$pathVars->fetchByIndex($indexStart + 2);
			if ($pathVars->fetchByIndex($indexStart + 3)) {
				$_REQUEST['returnTransfer']=$pathVars->fetchByIndex($indexStart + 3);
			}
		}
		break;
		
	case 'orders':
	case 'bookOrders':
		$isEdit=false;

		if ($pathVars->fetchByIndex($indexStart + 1)) { 
			$transfersFilter=$pathVars->fetchByIndex($indexStart + 1);
			if ($transfersFilter=='order') $orderid=$pathVars->fetchByIndex($indexStart + 2);
			if ($transfersFilter=='detail') {
				$detailid=$pathVars->fetchByIndex($indexStart + 2);
				if ($pathVars->fetchByIndex($indexStart + 3) && $pathVars->fetchByIndex($indexStart + 4)) {
					$key=$pathVars->fetchByIndex($indexStart + 3);
					$userID=$pathVars->fetchByIndex($indexStart + 4);
					require_once ROOT."/db/v4_OrderDetails.class.php";
					require_once ROOT."/db/v4_OrdersMaster.class.php";
					require_once ROOT."/db/v4_AuthUsers.class.php";
					$od = new v4_OrderDetails;
					$om = new v4_OrdersMaster;
					$au = new v4_AuthUsers;
					$od->getRow($detailid);
					$orderID=$od->getOrderID();
					$om->getRow($orderID);
					if ($om->getMOrderKey()==$key) {
						$au->getRow($userID);
						$username=$au->getAuthUserName();
						$tempPass=$au->getAuthUserPass();
						$_REQUEST['username']=$username;
						$_REQUEST['tempPass']=$tempPass;
					}	
				}	
			}	
		
			if (is_numeric($transfersFilter)) {
				$detailid=$pathVars->fetchByIndex($indexStart + 1);
				$isEdit=true;
			}
			
			if (isset($_POST['orderid']) && $_POST['orderid']<>'') $orderid=$_POST['orderid'];	
		}
		if (PARTNERLOG) $activePage="bookOrders";		
		break;
		
	case 'booking':
		if ($pathVars->fetchByIndex($indexStart + 1)) { 
		
			$includeFile='/'.$pathVars->fetchByIndex($indexStart + 1).'.php';
			$includeFileTpl=$pathVars->fetchByIndex($indexStart + 1).'.tpl';
		}	
		break;	
		
	case 'services':
		
		if ($pathVars->fetchByIndex($indexStart + 1)) { 
			if ($pathVars->fetchByIndex($indexStart + 1)=='route') {
				$RouteID=$pathVars->fetchByIndex($indexStart + 2);
			}			
			if ($pathVars->fetchByIndex($indexStart + 1)=='vehicleType') {
				$VehicleTypeID=$pathVars->fetchByIndex($indexStart + 2);
			}
		}	
		break;	
		
	case 'offDuty':
		if ($pathVars->fetchByIndex($indexStart + 1)) { 
			$VehicleID=$pathVars->fetchByIndex($indexStart + 1);
		}	
	
		break;	
		
	case 'subVehicles':
		if ($pathVars->fetchByIndex($indexStart + 1)) { 
			$VehicleTypeID=$pathVars->fetchByIndex($indexStart + 1);
		}	
		if (PARTNERLOG) $activePage="myVehicles";
	
		break;	
		
		case 'subDrivers':	
		if (PARTNERLOG) $activePage="myDrivers";
	
		break;
		
	case 'expenses':
	case 'tasks':
	case 'subdriverHistory':
	case 'vehicleAssignHistory':
	case 'tunnelPassAH':
	case 'tunnelPassHistory':
		$selectsubdriver=true;
		if ($pathVars->fetchByIndex($indexStart + 1)) { 
			if ($pathVars->fetchByIndex($indexStart + 1)=='vehicles') {
				$VehicleID=$pathVars->fetchByIndex($indexStart + 2);
			}			
			if ($pathVars->fetchByIndex($indexStart + 1)=='subdrivers') {
				$SubDriverID=$pathVars->fetchByIndex($indexStart + 2);
				if ($pathVars->fetchByIndex($indexStart + 3)) {
					$CAU=($pathVars->fetchByIndex($indexStart + 3));
				}	
			}			
			if ($pathVars->fetchByIndex($indexStart + 1)=='actions') {
				$ActionID=$pathVars->fetchByIndex($indexStart + 2);
			}
			if( $pathVars->fetchByIndex($indexStart + 1) =="paralelTasks") { 
				$includeFile = "/ParalelTasks.php";
				$includeFileTpl = "/paralelTask.tpl";			
				if (is_numeric( $pathVars->fetchByIndex($indexStart + 2))) 
					$vehicleID=$pathVars->fetchByIndex($indexStart + 2);				
				if (is_numeric( $pathVars->fetchByIndex($indexStart + 3))) 
					$expense=$pathVars->fetchByIndex($indexStart + 3);
			}	
		}	
		break;			
	
	case 'schedule':	
		if ($pathVars->fetchByIndex($indexStart + 1)) { 
			$_REQUEST['ScheduleDate']=$pathVars->fetchByIndex($indexStart + 1);
		}			
		if ($pathVars->fetchByIndex($indexStart + 2)) { 
			$_REQUEST['ScheduleDate2']=$pathVars->fetchByIndex($indexStart + 2);
		}	
		if ($pathVars->fetchByIndex($indexStart + 3)) {		
			$_REQUEST['subDriverID']=$pathVars->fetchByIndex($indexStart + 3);
		}
		break;	
		
	case 'driversTransfers':
		if ($pathVars->fetchByIndex($indexStart + 1)){
			$steps = 2;
			if( $pathVars->fetchByIndex($indexStart + 1) =="driversBalance") { 
				// Dodano
				$includeFile = "/driversBalance.php";
				$includeFileTpl = "/driversBalance.tpl";
				
			} else if($pathVars->fetchByIndex($indexStart + 1) =="invoice"){
				$includeFile = "/invoice.php";
				$includeFileTpl = "/invoice.tpl";
			}
			else{
				$steps = 0;
			}
				// Metoda fetchByIndex nalazi se u common/class/PathVars.php
				if($steps == 2) $_REQUEST['driverid']=$pathVars->fetchByIndex($indexStart + 2);
			
				$_REQUEST['StartDate']=$pathVars->fetchByIndex($indexStart + 1 + $steps);
				$_REQUEST['EndDate']=$pathVars->fetchByIndex($indexStart + 2 + $steps);
				$_REQUEST['includePaymentMethod']=$pathVars->fetchByIndex($indexStart + 3 + $steps);
			
		}
		break;

	case 'agentsTransfers':
		if ($pathVars->fetchByIndex($indexStart + 1)){
			$steps = 2;
			if( $pathVars->fetchByIndex($indexStart + 1) =="agentsBalance") { 
				$includeFile = "/agentsBalance.php";
				$includeFileTpl = "/agentsBalance.tpl";
				
			} else if($pathVars->fetchByIndex($indexStart + 1) =="invoice"){
				$includeFile = "/invoice.php";
				$includeFileTpl = "/invoice.tpl";
			}
			else{
				$steps = 0;
			}
				// Metoda fetchByIndex nalazi se u common/class/PathVars.php
				if($steps == 2) $_REQUEST['agentid']=$pathVars->fetchByIndex($indexStart + 2);
			
				$_REQUEST['StartDate']=$pathVars->fetchByIndex($indexStart + 1 + $steps);
				$_REQUEST['EndDate']=$pathVars->fetchByIndex($indexStart + 2 + $steps);
				$_REQUEST['NoShow']=$pathVars->fetchByIndex($indexStart + 3 + $steps);
				$_REQUEST['DrErr']=$pathVars->fetchByIndex($indexStart + 4 + $steps);
				$_REQUEST['CompletedTransfers']=$pathVars->fetchByIndex($indexStart + 5 + $steps);
				$_REQUEST['Sistem']=$pathVars->fetchByIndex($indexStart + 6 + $steps);
			
			if ($pathVars->fetchByIndex($indexStart + 7 + $steps))  
				$_REQUEST['Exclude']=$pathVars->fetchByIndex($indexStart + 7 + $steps);

		}
		break;	
	case 'distribution':
	case 'transferAssign':
	case 'myDrivesMonitor':
	case 'drivesMonitor':
		if ($pathVars->fetchByIndex($indexStart + 1)){
			if($pathVars->fetchByIndex($indexStart + 1) =="vehicles"){
				$includeFile = "/vehicles.php";
				$includeFileTpl = "/vehicles.tpl";	
			} else $_REQUEST['Date']=$pathVars->fetchByIndex($indexStart + 1);
		}
		//if (PARTNERLOG && $activePage="distribution") $activePage="transferAssign";
		break;	
	//za potvrdu transfera na whatsApp-u	
	case 'rt':
		if ($pathVars->fetchByIndex($indexStart + 1)){
			$key=$pathVars->fetchByIndex($indexStart + 1);
			header('Location: /plugins/DriverReOrder/rt.php?key='.$key);
		}
		break;
	case 'confirm':
		if ($pathVars->fetchByIndex($indexStart + 1)){
			$id=$pathVars->fetchByIndex($indexStart + 1);
			header('Location: /plugins/WAN/Confirm.php?id='.$id);
		}
		break;	
	case 'partnerStatistic':
		if ($pathVars->fetchByIndex($indexStart + 1)){
			$terminalID=$pathVars->fetchByIndex($indexStart + 1);
		}
		break;	
	case 'driverPanel':
		if ($pathVars->fetchByIndex($indexStart + 1)){
			$driverPanelDate=$pathVars->fetchByIndex($indexStart + 1);
		}
		break;
		
	default:
		if ($pathVars->fetchByIndex($indexStart + 1)) { 
			if (is_numeric($pathVars->fetchByIndex($indexStart + 1))) {
				$item=$pathVars->fetchByIndex($indexStart + 1);
			}
			else if (($pathVars->fetchByIndex($indexStart + 1))=='connect') {
				$item=$pathVars->fetchByIndex($indexStart + 2);
				// ovde ubaciti program koji vrsi konekciju master i driver tabela	
				require ROOT."/plugins/makeDriverConnection.php";
			}			
		}	
}

switch ($specialpage) {
	case 'help':
		$help=$activePage;
		$activePage='tutorials';	
	case 'new':
		$isNew=true;
		break;	
	case 'newDriver':
		$isNew=true;
		$newDriver=true;
		break;	
	case 'newAgent':
		$isNew=true;
		$newAgent=true;
		break;
	default:
}

switch ($specialpage2) {
	case 'fieldsSettings':
	case 'fieldsDescription':
		$isNew=true;
		break;	
	default:
}
	



	