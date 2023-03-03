<?
	// za danasnje transfere
	$t->Today=false;
	if ($t->PickupDate==date('Y-m-d') ) {
		$t->Today=true;
		
		// pozicija i vreme vozaca transfera
		$t->Lat=$sdArray[$key]['Lat'];
		$t->Lng=$sdArray[$key]['Lng'];
		$t->Location=$sdArray[$key]['Location'];
		$t->Device=$sdArray[$key]['Device'];
		$t->DeviceTime=$sdArray[$key]['DeviceTime'];
		
		
		// da li je vozac u transferu
		
		if (!$sdArray[$key]['ForTransferBreak']) {
			
			$start_time=strtotime($t->PickupDate.' '.$t->SubPickupTime);
			$finish_time=strtotime($t->PickupDate.' '.$t->SubPickupTime)+$t->TransferDuration*60;
			if ($start_time>$t->DeviceTime)	$ForTransfer=true;
				
			if ($finish_time>$t->DeviceTime && $start_time<$t->DeviceTime)	{
				$t->TransferIn=true;
				$sdArray[$key]['ForTransferBreak']=true;
				$ForTransfer=false;			
			}	else $t->TransferIn=false;
			
			if ($finish_time<$t->DeviceTime) $ForTransfer=false;
			
			if ($ForTransfer) {
				$t->ForTransfer=true;
				$sdArray[$key]['ForTransferBreak']=true;
			}	
			else $t->ForTransfer=false;
		} else $t->ForTransfer=false;
		
		if ($t->ForTransfer) {
			$op->getRow($t->PickupID);
			$Direction_time=$start_time;
		} else {
			$op->getRow($t->DropID);		
			$Direction_time=$finish_time;			
		}	
		$Directon=$op->getPlaceNameEN();
		$Latitude=$op->Latitude;
		$Longitude=$op->Longitude;		
		
		// kasnjenje na transferu
		
		if (($t->Lat>0 && $t->Lng>0) && ($t->ForTransfer || $t->TransferIn) ){
			$api_key='5b3ce3597851110001cf6248ec7fafd8eca44e0ca5590caf093aa7cb';
			$url='https://api.openrouteservice.org/v2/directions/driving-car?api_key='.$api_key.'&start='.$t->Lng.','.$t->Lat.'&end='.$Longitude.','.$Latitude;
			$json = file_get_contents($url);   
			$obj=array();
			$obj = json_decode($json,true);
			$t->Distance2=0;
			$t->Duration2=0;
			if ($json) {
				$t->Distance2=number_format(($obj['features'][0]['properties']['segments'][0]['distance'])/1000,0);
				$t->Duration2=number_format(($obj['features'][0]['properties']['segments'][0]['duration'])/60);
				if ($t->DeviceTime+$t->Duration2*60<$Direction_time) $t->Shedule="<span style='color:green'>ON TIME</span>";
				else {
					$late=number_format(($t->DeviceTime+$t->Duration2*60-$Direction_time)/60,0);
					$t->Shedule="<span style='color:red'>LATE ".$late."min.</span>";
				}	
			}	
			else {
				if ($Longitude==0 || $Latitude==0) $t->Shedule='NO DATA';
				else $t->Shedule='NO ROUTABLE';
			}
			
		}
	}
	// kraj za danasnje transfere
	
	// bojenje transfera
	$t->bgColor = "#caefff";
	if($t->TransferStatus == "3") $t->bgColor = "#ffa07a";					
	if($t->DriverConfStatus >2) $t->bgColor = "#ffe599";										
	if($t->TransferStatus == "5") $t->bgColor = "#fefefe";
	if($t->TransferIn) $t->bgColor = "#b6d7a8";	
		
	// drugi transfer		
	$otherTransfer=getOtherTransferIDArray($t->DetailsID,$details);
	if ($otherTransfer) {
		$od->getRow($otherTransfer);
		$t->OtherTransfer = 'R: '.YMD_to_DMY($od->getPickupDate()).' '.$od->getPickupTime();
	} else 	$t->OtherTransfer = '';
	
	// da li ima notes-a
	if  (empty($t->PickupNotes) 
			and empty($t->StaffNote) 
			/*and empty($t->SubDriverNote)*/
			and empty($t->FinalNote) 
			and empty($t->SubFinalNote)
		) {
		$t->Notes=false;
	}	
	else $t->Notes=true;
	
	
	
	// da li flight time u datumskom konfliktu sa pickuptime ili droptime
	$t->flightTimeConflict=false;

	if ($t->FlightTime>0) {
		$ft=explode(':',$t->FlightTime);
		if(count($ft) == 2) $ft=$ft[0]*60+$ft[1];
		else $ft = 0;
		
		$spt=explode(':',$t->SubPickupTime);
		if(count($spt) == 2) $spt=$spt[0]*60+$spt[1];
		else $spt = 0;

		$rt=abs($spt-$ft)/60;
		if ($rt>12) $t->flightTimeConflict=true;
	}

	// da li je bilo promene pickup time
	$t->changedIcon = '';
	$t->color= '';
	$t->color2= '';
	if (in_array($t->DetailsID,$olKeys2)) {
		$t->changedIcon = '<i class="fa fa-circle text-red"></i>';
		$t->color='red';
	}	
	if ($t->SubPickupTime==$t->PickupTime) $color2='';
	else $t->color2='red';
	$t->carColor = 'text-lightgrey';
	// naziv tipa vozila	
	$t->VehicleTypeName = $t->VehicleType;
	if($t->VehicleType >= 100 and $t->VehicleType < 200) {
		$t->carColor = 'text-green white';
		$t->VehicleTypeName = 'P'.($t->VehicleType - 100);
	}
	if($t->VehicleType >= 200) {
		$t->carColor = 'text-red white';
		$t->VehicleTypeName = 'FC'.($t->VehicleType - 200);
	}
	// rjesenje problema kad su SubPickupDate ili SubPickupTime prazni
	if($t->SubPickupDate == '0000-00-00') $t->SubPickupDate=$t->PickupDate ;
	if($t->SubPickupTime == '') $t->SubPickupTime=$t->PickupTime ;
	if(!empty($t->RouteID) && empty($t->TransferDuration) ) {
		$or->getRow($t->RouteID);
		$t->TransferDuration=$or->getDuration();
	}	
	// dohvacanje extra usluga
	$t->extras = '';

	// Other Transfer:
	$otherTransfer = getOtherTransferIDArray($t->DetailsID,$details);
	if ($otherTransfer != null) {
		$d2->getRow($otherTransfer);
		$t->returnTransfer =  'R: '.YMD_to_DMY($d2->getPickupDate()).' '.$d2->getPickupTime();
	}else{
		$t->returnTransfer = "";
	}
	
	// Inter driver
	if($t->ContractFile == 'inter') $t->Inter = true;
	else $t->Inter = false;
	
	// Extras
	$extras2=array();
	foreach ($extras as $ex) {
		$ex_row=array();
		if ($ex['DetailID']==$t->DetailsID) {
			$ex_row['Name']=$ex['ServiceName'];
			$ex_row['Qty']=$ex['Qty'];
			$extras2[]=$ex_row;
		}		
	}
	$t->Extras=$extras2;
	
	// link na flighstats za uneti let
	$t->FsLink='';
	
	if (isset($t->FlightNo) && $t->FlightNo!='' && $t->PickupDate==date('Y-m-d') ) {
		$fglightno=$t->FlightNo;
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
		$Date=$t->PickupDate;
		$Date=explode('-',$Date);
		$year=$Date[0];
		$month=$Date[1];
		$day=$Date[2];	
		$t->FsLink='https://www.flightstats.com/v2/flight-tracker/'.$cc.'/'.$fn.'?year='.$year.'&month='.$month.'&date='.$day;
	}	
	$order_row=(array) $t;
		
	$ordersArray[]=$order_row;


