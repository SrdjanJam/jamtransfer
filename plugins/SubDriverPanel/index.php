<?
session_start();
require_once "config.php";
require_once ROOT . '/db/v4_OrderDetails.class.php';
require_once ROOT . '/db/v4_OrdersMaster.class.php';
require_once ROOT . '/db/v4_OrderExtras.class.php';
require_once ROOT . '/db/v4_Places.class.php';
require_once ROOT . '/db/v4_AuthUsers.class.php';
require_once ROOT . '/db/v4_SubVehicles.class.php';

$od = new v4_OrderDetails;
$om = new v4_OrdersMaster;
$oe = new v4_OrderExtras;
$op = new v4_Places;
$au = new v4_AuthUsers();
$sv = new v4_SubVehicles();

function clearTime($time) {
	$timeUF=explode('T',$time);
	$timeUF=explode(':',$timeUF[1]);
	return $timeUF[0].":".$timeUF[1];
}	


	
$mydriver = $_SESSION['AuthUserID'];
//$_SESSION['DriverID'] = $mydriver;

$au->getRow($_SESSION['AuthUserID']);

$where2 .= " WHERE (SubDriver = '" . $mydriver . "' ";
$where2 .= " OR SubDriver2 = '" . $mydriver . "' ";
$where2 .= " OR SubDriver3 = '" . $mydriver . "') ";
$where2 .= " AND PickupDate = '" . date("Y-m-d")."' ";
$where2 .= " AND TransferStatus != 4 ";
$where2 .= " AND TransferStatus != 9 ";
$where2 .= " AND DriverConfStatus > 1 "; //status ready, samo cekirani transferi u ColumnView 

$odk=$od->getKeysBy("PickupDate,SubPickupTime","",$where2);
# initialize details
$details = array();
$smarty->assign($au->fieldValues());
if(count($odk) > 0) {
	// TRANSFERI
	foreach($odk as $key) {
		$od->getRow($key);
		$om->getRow($od->getOrderID());
		// status transfera
		if ($od->TransferStatus==3) $cancelstyle='style="text-decoration: line-through;"';
		else $cancelstyle='';
		$tstatus="";
		$tbadge="";
		if ($od->TransferStatus==3) {
			$tstatus="CANCELED";	
			$tbadge="badge bg-red";
		}	
		else if ($od->TransferStatus==5) {
			$tstatus="COMPLETED";	
			$tbadge="badge bg-blue";
		}			
		
		// povratni transfer?
		$returnTransfer="";
		$FSubDriver="";
		$FSubDriver2="";
		$FSubDriver3="";
		$FFinalNote="";
		$FSubFinalNote="";
		$od2 = new v4_OrderDetails;
		$where4 = " WHERE OrderID = '" . $od->OrderID . "' AND TNo != '".$od->TNo."'";
		$odk2=$od2->getKeysBy("DetailsID","",$where4);
	
		if (count($odk2)>0) {
			$od2->getRow($odk2[0]);
			if ($od2->TNo==2) $returnTransfer = ' R ' . convertTime($od2->PickupDate) . ' ' . $od2->SubPickupTime;
			else { 
				if ($od2->SubDriver != 0) { $au->getRow($od2->SubDriver);  $FSubDriver=$au->AuthUserRealName; }
				if ($od2->SubDriver2 != 0) { $au->getRow($od2->SubDriver2); $FSubDriver2=$au->AuthUserRealName; }
				if ($od2->SubDriver3 != 0) { $au->getRow($od2->SubDriver3); $FSubDriver3=$au->AuthUserRealName; }				
				$FFinalNote = $od2->FinalNote;
				$FSubFinalNote = $od2->SubFinalNote;
			}	
		}

		// lokacije i adrese rute
		$PickupAddressG=$od->PickupAddress;	
		$DropAddressG=$od->DropAddress;
		if (($od->PickupID != 0) and ($od->DropID != 0)) {
			$op->getRow($od->PickupID);
			$od->setPickupName($op->getPlaceNameEN());			
			$op->getRow($od->DropID);
			$od->setDropName($op->getPlaceNameEN());
		}
		$PickupAddressG='https://www.google.com/maps/search/'.$od->PickupName.'+'.$od->PickupAddress;
		$DropAddressG='https://www.google.com/maps/search/'.$od->DropName.'+'.$od->DropAddress;
		
		// koji auto vozi 
		if($mydriver == $od->SubDriver) $myCar = carName($od->Car,$sv);
		if($mydriver == $od->SubDriver2) $myCar = carName($od->Car2,$sv);
		if($mydriver == $od->SubDriver3) $myCar = carName($od->Car3,$sv);

		// Klasa vozila
		$carColor = 'text-lightgrey';
		$vehicleType = $od->VehicleType;
		if($vehicleType >= 100 and $vehicleType < 200) {
			$carColor = 'text-green white';
			$vehicleType = 'P'.($vehicleType - 100);
		}
		if($vehicleType >= 200) {
			$carColor = 'text-red white';
			$vehicleType = 'FC'.($vehicleType - 200);
		} 

		// da li ima jos vozila na transferu?
		$moreCars = 0;
		if($od->SubDriver != 0 and $od->SubDriver2 != 0) $moreCars = 2;
		if($od->SubDriver != 0 and $od->SubDriver2 != 0 and $od->SubDriver3 != 0) $moreCars = 3;
		
		// extras
		$extras = $oe->getKeysBy('ID', 'ASC', 'WHERE OrderDetailsID = ' . $od->DetailsID);
		if (count($extras)>0) {
			foreach ($extras as $key => $value) {
				$oe->getRow($value);
				$oeServices[] = $oe->fieldValues();
			}
		}	
		
		
		if (isset($od->FlightNo)) {
			$fglightno=$od->FlightNo;
			$fglightno=str_replace(' ','',$fglightno);
			$fglightno=str_replace('-','',$fglightno);
			if (is_numeric(substr($fglightno, 2, 2))) {	
				$cc = substr($fglightno, 0, 2);  	
				$fn = substr($fglightno, 2);  	
			}
			else {
				$cc = substr($fglightno, 0, 3);  	
				$fn = substr($fglightno, 3);  			
			}	
			if ($cc=='EZY') $cc='U2';
			if ($cc=='EZS') $cc='U2';
			if ($cc=='EJU') $cc='U2';
			$cc=strtoupper($cc);			
			$Date=$od->PickupDate;
			$Date=explode('-',$Date);
			$year=$Date[0];
			$month=$Date[1];
			$day=$Date[2];	
			$fs_link='https://www.flightstats.com/v2/flight-tracker/'.$cc.'/'.$fn.'?year='.$year.'&month='.$month.'&date='.$day;
		}
		if($od->SubPickupTime=="") $od->SubPickupTime=$od->PickupTime;
		
		//testing
		$od->setSubDriverNote("TEST");
		$od->setPickupNotes("TEST ccccc");
		
		
		$detail=$od->fieldValues();
		
		
		
		$detail['cancelstyle']=$cancelstyle;
		$detail['carName']=$myCar;
		$detail['returnTransfer']=$returnTransfer;
		
		$detail['FSubDriver']=$FSubDriver;
		$detail['FSubDriver2']=$FSubDriver2;
		$detail['FSubDriver3']=$FSubDriver3;
		$detail['FFinalNote']=$FFinalNote;
		$detail['FSubFinalNote']=$FSubFinalNote;

		$detail['PickupAddressG']=$PickupAddressG;
		$detail['DropAddressG']=$DropAddressG;
		$detail['moreCars']=$moreCars;
		$detail['tbadge']=$tbadge;
		$detail['tstatus']=$tstatus;
		$detail['carColor']=$carColor;
		$detail['vehicleType']=$vehicleType;
		$detail['paxTel']=$om->MPaxTel;
		$detail['oeServices']=$oeServices;
		$detail['fs_link']=$fs_link;
			
		$details[]=$detail;
	}
}
$smarty->assign('details',$details);	
function hasReturn($OrderID, $TNo,$od) {
	$od2 = new v4_OrderDetails;
	$where4 = " WHERE OrderID = '" . $OrderID . "' AND TNo > '".$TNo."'";
	$odk2=$od2->getKeysBy("DetailsID","",$where4);
	
	if (count($odk2)>0) {
		$od2->getRow($odk2[0]);
		if($od2->OrderID ==  $OrderID and $od2->TNo != $TNo) {
			$ret = ' R ' . convertTime($od2->PickupDate) . ' ' . $od2->SubPickupTime;
			return $ret;
		}
		return '';
	}
	return '';
}

function carName($id,$sv) {
	$sv->getRow($id);	
	return $sv->VehicleDescription;
}

function convertTime($ts, $dformat = '%d.%m.%Y', $sformat = '%Y-%m-%d') {
	extract(strptime($ts,$sformat));
	return strftime($dformat,mktime(
		                          intval($tm_hour),
		                          intval($tm_min),
		                          intval($tm_sec),
		                          intval($tm_mon)+1,
		                          intval($tm_mday),
		                          intval($tm_year)+1900
		                        ));
}