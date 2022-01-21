<?php
/*
	AJAX Script !!!!
*/
require_once "../../config.php";
function getMyDb()
{
	static $mysqli;
	if (!$mysqli) $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD, DB_NAME);
	return $mysqli;
}
@session_start();
if (!$_SESSION['UserAuthorized']) die('Bye, bye');




if (!isset($_REQUEST["cal_month"])) 
{
    if (!isset($_SESSION["cal_month"])) $cMonth = date("m");
    else {
        $cMonth = $_SESSION["cal_month"];
    }
}
else
{
    $_SESSION['cal_month'] = $_REQUEST["cal_month"];
    $cMonth = $_REQUEST["cal_month"];
}

if (!isset($_REQUEST["cal_year"]))
{
    if (!isset($_SESSION["cal_year"])) $cYear = date("Y");
    else {
        $cYear = $_SESSION["cal_year"];
    }

}
else
{
    $_SESSION['cal_year'] = $_REQUEST["cal_year"];
    $cYear = $_REQUEST["cal_year"];
}

//echo $cMonth.NL;
//echo $cYear;

$prev_year = $cYear;
$next_year = $cYear;
$prev_month = $cMonth-1;
$next_month = $cMonth+1;

if ($prev_month == 0 ) {
	$prev_month = 12;
	$prev_year = $cYear - 1;
}
if ($next_month == 13 ) {
	$next_month = 1;
	$next_year = $cYear + 1;
}
				$timestamp = mktime(0,0,0,$cMonth,1,$cYear);
				$maxday = date("t",$timestamp);
				$thismonth = getdate ($timestamp);
				$startday = $thismonth['wday'];

				$dayin="";
				for ($i=0; $i<($maxday+$startday); $i++) {
					$fullDate = date("Y-m-d",mktime(0,0,0,$cMonth,($i - $startday + 1),$cYear));
					$dayin .= "'".$fullDate. "'," ;
				}	
				$dayin = substr($dayin,0,strlen($dayin)-1);
				
				$active = "SELECT * FROM ".DB_PREFIX."OrderDetails
							WHERE PickupDate IN (".$dayin.") ";
				if ($_SESSION['AuthLevelID'] == DRIVER_USER)  $active .=	"AND DriverID = '".$_SESSION['AuthUserID']."' ";
				$active .=	"AND TransferStatus != '4' AND TransferStatus != '9'
							ORDER BY PickupDate, PickupTime ASC
							";
				$mysqli = getMyDb();
				$rec = $mysqli->query($active) ;
				$tr_arr=array();
				while ($row = $rec->fetch_assoc() ) {
					$tr_arr[]=$row;
				}
				$rec=$tr_arr;
				$timestamp = mktime(0,0,0,$cMonth,1,$cYear);
				$maxday = date("t",$timestamp);
				$thismonth = getdate ($timestamp);
				$startday = $thismonth['wday'];
?>

<table width="99%" style="border:none;">
	<tr>
		<td align="center">

			<table id="calendarTable" width="100%" border="0" cellpadding="0" cellspacing="0"  class="table">
				<thead>
					<th style="width:14%; background:#FDB5B5"><strong><?=$dayNames[0];?></strong></th>
					<th style="width:14%; background:#f2f2f2"><strong><?=$dayNames[1];?></strong></th>
					<th style="width:14%; background:#f2f2f2"><strong><?=$dayNames[2];?></strong></th>
					<th style="width:14%; background:#f2f2f2"><strong><?=$dayNames[3];?></strong></th>
					<th style="width:14%; background:#f2f2f2"><strong><?=$dayNames[4];?></strong></th>
					<th style="width:14%; background:#f2f2f2"><strong><?=$dayNames[5];?></strong></th>
					<th style="width:14%; background:#ABF1A6"><strong><?=$dayNames[6];?></strong></th>
				</thead>

				<?
				for ($i=0; $i<($maxday+$startday); $i++) {
						$fullDate = date("Y-m-d",mktime(0,0,0,$cMonth,($i - $startday + 1),$cYear));
						$month_transfers[]=monthTransfersArray($fullDate,$rec);
				}
				$i=0;	
				foreach ($month_transfers as $daytansfers) {
					if(($i % 7) == 0 ) echo "<tr>\n";
					if($i < $startday) echo "<td></td>\n";
					else
					{
						# Full date
						$fullDate = $daytansfers['date'];
						# Style for Today
						$style = '';
						if ($fullDate == date("Y-m-d") ) $style='style="background: #EDF6FF !important;"';
						# data goes here
						echo '<td valign="top" class="cal_cell" '.$style.'><div class="cal_days l"><b>'.
							($i - $startday + 1). '</b></div><br /><small>'.
							monthTransfers($daytansfers) .
							"</small></td>\n";
					}

					if(($i % 7) == 6 ) echo "</tr>\n";
					$i++;
				}
				?>

			</table>
		</td>
	</tr>
</table>

<div class="dashboard-legend">
	Transfer status:
	<ul>
		<i class="fa fa-circle-o text-blue"></i> Active |
		<i class="fa fa-circle-o text-orange"></i> Changed |
		<i class="fa fa-question-circle text-orange"></i> Temp |
		<i class="fa fa-times-circle" style="color:#c00"></i> Cancelled |
		<i class="fa fa-check-circle text-green"></i> Completed<br>
	</ul><br>
	Driver confirmation status:
	<ul>
		<i class="fa fa-car" style="color:#c00"></i> No driver |
		<i class="fa fa-info-circle text-orange"></i> Not Confirmed |
		<i class="fa fa-thumbs-up text-blue"></i> Confirmed |
		<i class="fa fa-car text-blue"></i> Ready |
		<i class="fa fa-thumbs-down" style="color:#c00"></i> Declined |
		<i class="fa fa-user-times" style="color:#c00"></i> No-show |
		<i class="fa fa-black-tie" style="color:#c00"></i> Driver error |
		<i class="fa fa-check-square text-green"></i> Completed
	</ul>
</div>

<script>
	$(".mytooltip").popover({trigger:'hover', html:true, placement:'bottom'});
</script>

<?
function monthTransfersArray($date,$rec)
{
	global $StatusDescription;
	global $DriverConfStatus;

	$data = '';
	$noOfTransfers = 0;
	foreach ($rec as $row) { 
		if ($row['PickupDate']==$date) {
			if ($row['TransferStatus'] != '3') $noOfTransfers += 1;
			$arr[]= $row;
		}
	}
	$dayTransfers['date']=$date;
	$dayTransfers['transfers']=$arr;
	$dayTransfers['noOfTransfers']=$noOfTransfers;
    return $dayTransfers;
}

function monthTransfers($daytransfers)
{
	$date = $daytransfers['date'];
	$transfers = $daytransfers['transfers'];
	global $StatusDescription;
	global $DriverConfStatus;
	foreach ($daytransfers['transfers'] as $transfer) { 
		# No Driver Alert
		$driver = '<span style="color: #c00"><i class="fa fa-question"></i></span> ';
		/*
		TransferStatus:
			1 = Active
			2 = Changed
			3 = Cancelled
			4 = TEMP
			5 = Completed
		*/
		if ($transfer['TransferStatus'] == '1') $driver = '<span class="text-blue"><i class="fa fa-circle-o"></i></span> ';
		if ($transfer['TransferStatus'] == '2') $driver = '<span class="text-orange"><i class="fa fa-circle-o"></i></span> ';
		if ($transfer['TransferStatus'] == '3') $driver = '<span style="color: #c00"><i class="fa fa-times-circle"></i></span> ';
		if ($transfer['TransferStatus'] == '4') $driver = '<span class="text-orange"><i class="fa fa-question-circle"></i></span> ';
		if ($transfer['TransferStatus'] == '5') $driver = '<span class="text-green"><i class="fa fa-check-circle"></i></span> ';

		/*
		DriverConfStatus:
			0 = No driver
			1 = Not Confirmed
			2 = Confirmed
			3 = Ready
			4 = Declined
			5 = No-show
			6 = Driver error
			7 = Completed
		*/
		if ($transfer['DriverConfStatus'] == '0') $data .= '<span style="color:#c00"><i class="fa fa-car"></i></span> ';
		if ($transfer['DriverConfStatus'] == '1') $driver .= '<span class="text-orange"><i class="fa fa-info-circle"></i></span> ';
		if ($transfer['DriverConfStatus'] == '2') $driver .= '<span class="text-blue"><i class="fa fa-thumbs-up"></i></span> ';
		if ($transfer['DriverConfStatus'] == '3') $driver .= '<span class="text-blue"><i class="fa fa-car"></i></span> ';
		if ($transfer['DriverConfStatus'] == '4') $driver .= '<span style="color:#c00"><i class="fa fa-thumbs-down"></i></span> ';
		if ($transfer['DriverConfStatus'] == '5') $driver .= '<span style="color:#c00"><i class="fa fa-user-times"></i></span> ';
		if ($transfer['DriverConfStatus'] == '6') $driver .= '<span style="color:#c00"><i class="fa fa-black-tie"></i></span> ';
		if ($transfer['DriverConfStatus'] == '7') $driver .= '<span class="text-green"><i class="fa fa-check-square"></i></span> ';

		# Tooltip Setup
		$ttip = NL.
				FLIGHT_NO.': '.$transfer['FlightNo'].NL.
				FLIGHT_TIME.': '.$transfer['FlightTime'].NL.
				FROM.': '.$transfer['PickupName'].NL.
				TO.': '.$transfer['DropName'].NL.
				DRIVER.': '.$transfer['DriverName'].NL.
				TRANSFER_STATUS .': '. $StatusDescription[$transfer['TransferStatus']].NL.
				$DriverConfStatus[$transfer['DriverConfStatus']].NL.NL;

		# Pickup Time
		$data .=    $driver . $transfer['PickupTime'] . ' &rarr; ';


		# Link & Tooltip
		$data .=    '<a href="index.php?p=editActiveTransfer&rec_no='.
					$transfer['DetailsID'].
					'" title="<b>'.$transfer['OrderID'] . '-'.$transfer['TNo'] .' - '. $transfer['PaxName'] . '</b>" 
					data-content="'. str_replace('"', '',$ttip) .'" 
					class="mytooltip">' .
					$transfer['OrderID'] . '-'.$transfer['TNo'] .
					'</a>' .'<br/>';
	}
	$data .= '<br><small style="font-size:14px">No of transfers: '.$daytransfers['noOfTransfers'].'</small>';
    return $data;
}

function dayTransfers($date)
{
	global $StatusDescription;
	global $DriverConfStatus;
	
	
	$mysqli = getMyDb();
	$data = '';
	
	# If user is not a driver, call admin version of function
	if ($_SESSION['AuthLevelID'] != DRIVER_USER) return dayTransfersAdmin($date);


	# PITANJE: sta je ovaj Status ? izbaceno nakon WHERE Status != 3 AND
	$active = "SELECT * FROM ".DB_PREFIX."OrderDetails
				WHERE PickupDate = '".$date."' 
				AND DriverID = '".$_SESSION['AuthUserID']."' 
				AND TransferStatus != '4' AND TransferStatus != '9'
				ORDER BY PickupDate, PickupTime ASC
				";

	$rec = $mysqli->query($active) or die($mysqli->error);
	$noOfTransfers = 0;

	while ($row = $rec->fetch_assoc() ) {

		# OrdersMaster
		/*$master = "SELECT * FROM ".DB_PREFIX."OrdersMaster
				WHERE MOrderID = ".$row['OrderID'];

    	$rr = $mysqli->query($master) or die($mysqli->error);
    	$m = $rr->fetch_assoc();*/

    	# No Driver Alert
    	$driver = '<span style="color: #c00"><i class="fa fa-question"></i></span> ';

		if ($row['TransferStatus'] != '3') $noOfTransfers += 1;

  		/*
		TransferStatus:
			1 = Active
			2 = Changed
			3 = Cancelled
			4 = TEMP
			5 = Completed
		*/
		if ($row['TransferStatus'] == '1') $driver = '<span class="text-blue"><i class="fa fa-circle-o"></i></span> ';
		if ($row['TransferStatus'] == '2') $driver = '<span class="text-orange"><i class="fa fa-circle-o"></i></span> ';
		if ($row['TransferStatus'] == '3') $driver = '<span style="color: #c00"><i class="fa fa-times-circle"></i></span> ';
		if ($row['TransferStatus'] == '4') $driver = '<span class="text-orange"><i class="fa fa-question-circle"></i></span> ';
		if ($row['TransferStatus'] == '5') $driver = '<span class="text-green"><i class="fa fa-check-circle"></i></span> ';

		/*
		DriverConfStatus:
			0 = No driver
			1 = Not Confirmed
			2 = Confirmed
			3 = Ready
			4 = Declined
			5 = No-show
			6 = Driver error
			7 = Completed
		*/
		if ($row['DriverConfStatus'] == '0') $driver .= '<span style="color:#c00"><i class="fa fa-car"></i></span> ';
		if ($row['DriverConfStatus'] == '1') $driver .= '<span class="text-orange"><i class="fa fa-info-circle"></i></span> ';
		if ($row['DriverConfStatus'] == '2') $driver .= '<span class="text-blue"><i class="fa fa-thumbs-up"></i></span> ';
		if ($row['DriverConfStatus'] == '3') $driver .= '<span class="text-blue"><i class="fa fa-car"></i></span> ';
		if ($row['DriverConfStatus'] == '4') $driver .= '<span style="color:#c00"><i class="fa fa-thumbs-down"></i></span> ';
		if ($row['DriverConfStatus'] == '5') $driver .= '<span style="color:#c00"><i class="fa fa-user-times"></i></span> ';
		if ($row['DriverConfStatus'] == '6') $driver .= '<span style="color:#c00"><i class="fa fa-black-tie"></i></span> ';
		if ($row['DriverConfStatus'] == '7') $driver .= '<span class="text-green"><i class="fa fa-check-square"></i></span> ';

   	    # Tooltip Setup
  	    $ttip = NL.
   	            FLIGHT_NO.': '.$row['FlightNo'].NL.
   	            FLIGHT_TIME.': '.$row['FlightTime'].NL.
   	            FROM.': '.$row['PickupName'].NL.
   	            TO.': '.$row['DropName'].NL.
   	            DRIVER.': '.$row['DriverName'].NL.
   	            TRANSFER_STATUS .': '. $StatusDescription[$row['TransferStatus']].NL.
   	            $DriverConfStatus[$row['DriverConfStatus']].NL.NL;

   	    # Pickup Time
    	$data .=    $driver . $row['PickupTime'] . ' &rarr; ';


        # Link & Tooltip
        $data .=    '<a href="index.php?p=editActiveTransfer&rec_no='.
		            $row['DetailsID'].
		            '" title="<b>'.$row['OrderID'] . '-'.$row['TNo'] .' - '. $row['PaxName'] . '</b>" 
		            data-content="'. str_replace('"', '',$ttip) .'" 
		            class="mytooltip">' .
	                $row['OrderID'] . '-'.$row['TNo'] .
	                '</a>' .'<br/>';

	}
	$data .= '<br><small style="font-size:14px">No of transfers: '.$noOfTransfers.'</small>';
    return $data;
}


# Function for Admins and Operaters
function dayTransfersAdmin($date)
{
	global $StatusDescription;
	global $DriverConfStatus;

	$mysqli = getMyDb();
	$data = '';

	# OrderDetails TransferStatus != 3 AND  5.1.2012
	$active = "SELECT * FROM ".DB_PREFIX."OrderDetails
				WHERE PickupDate = '".$date."'
				ORDER BY PickupDate, PickupTime ASC
				";

	$rec = $mysqli->query($active) or die($mysqli->error);
	$noOfTransfers = 0;

	while ($row = $rec->fetch_assoc() ) {

		/*
		# VehicleTimeTable
		$drivers = "SELECT * FROM ".DB_PREFIX."VehicleTimeTable
				WHERE OrderDetailsID = ".$row['DetailsID'];

    	$r = $mysqli->query($drivers) or die($mysqli->error);
    	$mydrvr = $mysqli->fetch_assoc($r);
        */

		# OrdersMaster
		/*$master = "SELECT * FROM ".DB_PREFIX."OrdersMaster
				WHERE MOrderID = ".$row['OrderID'];

    	$rr = $mysqli->query($master) or die($mysqli->error);
    	$m = $rr->fetch_assoc();*/

    	# No Driver Alert
    	$driver = '<span style="color: #c00"><i class="fa fa-question"></i></span> ';

		if ($row['TransferStatus'] != '3') $noOfTransfers += 1;

		/*
		TransferStatus:
			1 = Active
			2 = Changed
			3 = Cancelled
			4 = TEMP
			5 = Completed
		*/
		if ($row['TransferStatus'] == '1') $driver = '<span class="text-blue"><i class="fa fa-circle-o"></i></span> ';
		if ($row['TransferStatus'] == '2') $driver = '<span class="text-orange"><i class="fa fa-circle-o"></i></span> ';
		if ($row['TransferStatus'] == '3') $driver = '<span style="color: #c00"><i class="fa fa-times-circle"></i></span> ';
		if ($row['TransferStatus'] == '4') $driver = '<span class="text-orange"><i class="fa fa-question-circle"></i></span> ';
		if ($row['TransferStatus'] == '5') $driver = '<span class="text-green"><i class="fa fa-check-circle"></i></span> ';

		/*
		DriverConfStatus:
			0 = No driver
			1 = Not Confirmed
			2 = Confirmed
			3 = Ready
			4 = Declined
			5 = No-show
			6 = Driver error
			7 = Completed
		*/
		if ($row['DriverConfStatus'] == '0') $driver .= '<span style="color:#c00"><i class="fa fa-car"></i></span> ';
		if ($row['DriverConfStatus'] == '1') $driver .= '<span class="text-orange"><i class="fa fa-info-circle"></i></span> ';
		if ($row['DriverConfStatus'] == '2') $driver .= '<span class="text-blue"><i class="fa fa-thumbs-up"></i></span> ';
		if ($row['DriverConfStatus'] == '3') $driver .= '<span class="text-blue"><i class="fa fa-car"></i></span> ';
		if ($row['DriverConfStatus'] == '4') $driver .= '<span style="color:#c00"><i class="fa fa-thumbs-down"></i></span> ';
		if ($row['DriverConfStatus'] == '5') $driver .= '<span style="color:#c00"><i class="fa fa-user-times"></i></span> ';
		if ($row['DriverConfStatus'] == '6') $driver .= '<span style="color:#c00"><i class="fa fa-black-tie"></i></span> ';
		if ($row['DriverConfStatus'] == '7') $driver .= '<span class="text-green"><i class="fa fa-check-square"></i></span> ';

   	    # Tooltip Setup
  	    $ttip = NL.
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
    	$data .=    $driver . $row['PickupTime'] . ' &rarr; ';


        # Link & Tooltip
        $data .=    '<a href="index.php?p=editActiveTransfer&rec_no='.
		            $row['DetailsID'].
		            '" title="<b>'.$row['OrderID'] . '-'.$row['TNo'] .' - '. $row['PaxName'] . '</b>" 
		            data-content="'. str_replace('"', '',$ttip) .'" 
		            class="mytooltip">' .
	                $row['OrderID'] . '-'.$row['TNo'] .
	                '</a>' .'<br/>';

	}
	$data .= '<br><small style="font-size:14px">No of transfers: '.$noOfTransfers.'</small>';
    return $data;
}

/* EOF */

