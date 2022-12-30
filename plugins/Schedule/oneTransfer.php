<?
	//niz vozaca koji imaju transfere u zadatom vremenu
	if ($t->SubDriver != 0) $subDArray[] = $t->SubDriver;
	if ($t->SubDriver2 != 0) $subDArray[] = $t->SubDriver2;
	if ($t->SubDriver3 != 0) $subDArray[] = $t->SubDriver3;
	
	// bojenje transfera
	$t->bgColor = "#caefff";
	if($t->TransferStatus == "3") $t->bgColor = "#ffa07a";					
	if($t->DriverConfStatus >2) $t->bgColor = "#ffe599";										
	if($t->TransferStatus == "5") $t->bgColor = "#fefefe";
	
					
	// da li flight time u datumskom konfliktu sa pickuptime ili droptime
	$t->flightTimeConflict=false;
	if (abs($t->SubPickupTime-$t->FlightTime)>12) $t->flightTimeConflict=true;
	// da li je bilo promene pickup time
	$changedIcon = '';
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
	$oeArray = $oe->getKeysBy('OrderDetailsID', 'ASC', 'WHERE OrderDetailsID = '.$t->DetailsID);

	foreach ($oeArray as $val => $ID) {
		$oe->getRow($ID);
		$t->extras .= $oe->getServiceName();
		$t->extras .= '<br>';
	}
	
	$order_row=(array) $t;
		
	$ordersArray[]=$order_row;
