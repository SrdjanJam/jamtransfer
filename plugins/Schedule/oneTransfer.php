<?
	// pozicija i vreme vozaca transfera
	$key = array_search($t->SubDriver, array_column($sdArray, 'DriverID'));
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
	$order_row=(array) $t;
		
	$ordersArray[]=$order_row;


