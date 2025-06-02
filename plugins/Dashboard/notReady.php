<?
$db = new DataBaseMysql();
	
	$query= "SELECT * FROM v4_OrderDetails
				WHERE 
				(PickupDate = '".date('Y-m-d',time())."' OR
				PickupDate = '".date('Y-m-d',time()+3600*24)."')
				AND DriverID in (556,843,876)
				AND DriverConfStatus<3
				AND TransferStatus not in (3,4,9)
				ORDER BY DriverID, PickupDate, PickupTime ASC
				";
	$result = $db->RunQuery($query); 

	$noOfTransfers = 0;
	$dataNR="";
	while($row = $result->fetch_array(MYSQLI_ASSOC)){ 


		if ($row['TransferStatus'] != '3') $noOfTransfers += 1;
   	    # Tooltip Setup
  	    $ttip = NL.
   	            PICKUP_TIME.': '.$row['PickupTime'].NL.
   	            FLIGHT_NO.': '.$row['FlightNo'].NL.
   	            FLIGHT_TIME.': '.$row['FlightTime'].NL.
   	            FROM.': '.$row['PickupName'].NL.
   	            TO.': '.$row['DropName'].NL.
   	            DRIVER.': '.$row['DriverName'].NL.
   	            TRANSFER_STATUS .': '. $StatusDescription[$row['TransferStatus']].NL.
   	            $DriverConfStatus[$row['DriverConfStatus']];

		if ($row['ExtraCharge'] > 0) $ttip .= NL."<i class='fa fa-cubes'></i> Extra services";

		$ttip .= NL.NL;

   	    # Pickup Time
    	$dataNR .=    $driver . $row['PickupDate'] . ' &rarr; ';


        # Link & Tooltip
        $dataNR .=    '<a target="_blank" href="orders/detail/'.
		            $row['DetailsID'].
		            '" title="<b>'.$row['OrderID'] . '-'.$row['TNo'] .' - '. $row['PaxName'] . '</b>" 
		            data-content="'. str_replace('"', '',$ttip) .'" 
		            class="mytooltip">' .
	                $row['OrderID'] . '-'.$row['TNo'] . 
	                '</a> ';
		$dataNR .= $row['DriverID'];			
		$dataNR .= ' <br/>';
	}
	$smarty->assign("data_notready",$dataNR);
	$smarty->assign("noOfTransfersNR",$noOfTransfers);


