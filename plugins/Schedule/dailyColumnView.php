<meta http-equiv="refresh" content="300"/>
<?
// Timetable sa prikazom transfera po vozacima za odabrani datum
// za svakog vozaca za odabran datum su izlistani transferi u stupcima (poput kalendarskog prikaza na dashboardu)
// POSTUPAK:
// - dobavi sve transfere za odabrani datum
// - dobavi sve vozace koji su vec postavljeni za te transfere (ovo bi moglo biti bez rezultata)
// - za svakog vozaca za odabrani datum ponovno dobavi (samo njegove) transfere
// - vozace izlistati u stupcima, njihove transfere u redovima unutar stupaca -
session_start();
$DateFrom	= $_POST["DateFrom"];
$DateTo		= $_POST["DateTo"];
$NoColumns	= $_POST["NoColumns"];

if (!isset($DateFrom)) $DateFrom = date("Y-m-d");
if (!isset($DateTo)) $DateTo = date("Y-m-d");
if (!isset($NoColumns)) $NoColumns = 3;

require_once $_SERVER['DOCUMENT_ROOT'] . '/db/v4_AuthUsers.class.php';
$au = new v4_AuthUsers();

require_once $_SERVER['DOCUMENT_ROOT'] . '/db/db.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/db/v4_OrdersMaster.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/db/v4_OrderDetails.class.php';	
require_once $_SERVER['DOCUMENT_ROOT'] . '/db/v4_OrderExtras.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/db/v4_Places.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/db/v4_Routes.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/db/v4_OrderLog.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/db/v4_SubVehicles.class.php';


$db = new DataBaseMysql();
$om = new v4_OrdersMaster();
$od = new v4_OrderDetails();
$d2 = new v4_OrderDetails();
$oe = new v4_OrderExtras();
$op = new v4_Places();
$or = new v4_Routes();
$ol = new v4_OrderLog();
$sv = new v4_SubVehicles();


$BsColumnWidth = 12 / $NoColumns;

# Pretvaranje formata datuma
function YMD_to_DMY ($date) {
	$elementi = explode ('-', $date);
	$new_date = $elementi[2] . '.' . $elementi[1] . '.' . $elementi[0];
	return $new_date;
}



function getOtherTransferIDArray ($DetailsID,$details) {
	$key = array_search($DetailsID, array_column($details, 'DetailsID'));
	$oid=$details[$key]['OrderID'];
	$keys = array_keys(array_column($details, 'OrderID'),$oid);
	$otherDetailsID=null;
	if (count($keys) == 2) {
		if ($DetailsID == $details[$keys[0]]['DetailsID']) {
			$otherDetailsID=$details[$keys[1]]['DetailsID'];
		}
		else if ($DetailsID == $details[$keys[1]]['DetailsID']) {
			$otherDetailsID=$details[$keys[0]]['DetailsID'];
		}		
	}	
	return $otherDetailsID;
}

function vincentyGreatCircleDistance(
  $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
{
  // convert from degrees to radians
  $latFrom = deg2rad($latitudeFrom);
  $lonFrom = deg2rad($longitudeFrom);
  $latTo = deg2rad($latitudeTo);
  $lonTo = deg2rad($longitudeTo);

  $lonDelta = $lonTo - $lonFrom;
  $a = pow(cos($latTo) * sin($lonDelta), 2) +
    pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
  $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

  $angle = atan2(sqrt($a), $b);
  return $angle * $earthRadius;
}

function clearTime($time) {
	$timeUF=explode('T',$time);
	$timeUF=explode(':',$timeUF[1]);
	return $timeUF[0].":".$timeUF[1];
}
	
// dobavi sve transfere za odabrani datum za trenutnog vlasnika timetable-a
$q = "SELECT DetailsID, SubDriver, SubDriver2, SubDriver3 FROM v4_OrderDetails WHERE 
	DriverID = " . $_SESSION['OwnerID'] . " AND 
	PickupDate >= '" . $DateFrom . "' AND 
	PickupDate <= '" . $DateTo . "' 
	AND TransferStatus < '6' AND 
	TransferStatus != '3' AND 
	TransferStatus != '4' AND 
	DriverConfStatus > '1' ORDER BY DetailsID ASC";
$r = $db->RunQuery($q);
$subDArray = array();
while ($t = $r->fetch_object()) {
	if ($t->SubDriver != 0) $subDArray[] = $t->SubDriver;
	if ($t->SubDriver2 != 0) $subDArray[] = $t->SubDriver2;
	if ($t->SubDriver3 != 0) $subDArray[] = $t->SubDriver3;
}
$subDArray = array_unique($subDArray); // ostavi samo jedinstvene subdrivere u nizu

// dobavi vozace od trenutnog vlasnika timetable-a, slozi ih u sdArray sa podacima
$q = "SELECT * FROM v4_AuthUsers";
$q .= " WHERE DriverID = ".$_SESSION['OwnerID']." ORDER BY AuthUserRealName ASC";
$r = $db->RunQuery($q);
$sdArray = array();
while ($d = $r->fetch_object()) {
	$row = array();
    $row['DriverID'] = $d->AuthUserID;
    $row['DriverName'] = $d->AuthUserRealName;
	$row['Active'] = $d->Active;
	$row['Mob'] = $d->AuthUserMob;
    $sdArray[] = $row;
}

// dobavi vozila od trenutnog vlasnika timetable-a, slozi ih u svArray sa podacima
$q = "SELECT * FROM v4_SubVehicles";
$q .= " WHERE OwnerID = ".$_SESSION['OwnerID']." ORDER BY VehicleDescription ASC";
$db = new DataBaseMysql();
$r = $db->RunQuery($q);
$svArray = array();
while ($v = $r->fetch_object()) {
	$row = array();
    $row['VehicleID'] = $v->VehicleID;
    $row['VehicleDescription'] = $v->VehicleDescription;
	$row['Active'] = $v->Active;
    $svArray[] = $row;
}

asort($subDArray);
?>

<style>
.ttForm {
	margin: 12px 0 0;
	padding: 12px;
	text-align: center;
	background: #d9edf7;
}
.datepicker {
	width: 10em;
	text-align: center;
}
.picker__frame {
	top: 20% !important;
}
.btn-xs {
	border: 0;
}
hr {
	border-top: 1px solid #eee;
}
.row {
	margin-left: auto;
	margin-right: auto;
}
.stupac {
	border: solid 1px #ccc;
}
.stupacWrapper {
	margin-top: 12px;
	padding: 0 2px;
}
iframe {
position: inherit;
top: 0;
left: 0;
width: 100% !important;
}		
</style>

<div class="container-fluid">
	<div class="row" >
		<div style="float:left; display:inline-block; width:30%">	
			<h3>Timetable - Daily View</h3>
		</div>		
		<div style="float:left; display:inline-block; ">
		<form class="ttForm" action="index.php?p=dailyColumnView" method="post">
			COLUMNS:
			<select name="NoColumns">
				<option value="1" <?if($NoColumns==1)echo'selected'?>>1</option>
				<option value="2" <?if($NoColumns==2)echo'selected'?>>2</option>
				<option value="3" <?if($NoColumns==3)echo'selected'?>>3</option>
				<option value="4" <?if($NoColumns==4)echo'selected'?>>4</option>
				<option value="6" <?if($NoColumns==6)echo'selected'?>>6</option>
				<option value="12" <?if($NoColumns==12)echo'selected'?>>12</option>
			</select>
			<button type="submit" class="btn btn-primary">Go</button>
		</form>
		</div>
	</div>
	<div class="row" style="font-size:0.85em !important">
	<?
	$i = 0;
	$columnCount = 0;

	$q = "SELECT DetailsID,SubDriver,SubDriver2,SubDriver3 FROM v4_OrderDetails 
		  WHERE DriverID = '". $_SESSION['OwnerID']."' 
		  AND PickupDate >= '" . $DateFrom . "' 
		  AND PickupDate <= '" . $DateTo . "' 
		  AND TransferStatus < '6' 
		  AND TransferStatus != '3' 
		  AND TransferStatus != '4' 
		  ORDER BY PickupDate, SubPickupTime, PickupTime ASC"; 
	$r = $db->RunQuery($q);
	while ($t = $r->fetch_object()) {
		$row[]=$t;
	}
	
	$details=array();
	// za proveru return transfer-a
	$q2 = "SELECT DetailsID,OrderID FROM v4_OrderDetails ORDER BY DetailsID DESC" ;
	$r2 = $db->RunQuery($q2);
	while ($t2 = $r2->fetch_object()) {
		$row_array=array();
		$row_array['DetailsID']=$t2->DetailsID; 
		$row_array['OrderID']=$t2->OrderID; 
		
		$details[]=$row_array;
	}
	
	// promjena pickup time
	$whereL = " WHERE Description LIKE '%PickupTime%'";
	$olKeys = $ol->getKeysBy('ID', 'DESC', $whereL);
	foreach ($olKeys as $olid) {
		$ol->getRow($olid);	
		$olKeys2[]=$ol->getDetailsID();
	}		
	date_default_timezone_set("Europe/Paris");		
	foreach ($subDArray as $SubDriver) { // STUPAC (driver)
		$au->getRow($SubDriver);
		$sdID=$au->getAuthUserFax();
		$DetailsIDArray = array();
		// zaduzeno vozilo
		$name=array();
		if (!empty($au->getAuthUserFax())) {
			$sql="SELECT `RVehicleName` FROM `v4_SubVehiclesDrivers` WHERE `RDriverID`=".$sdID;
			$rs = $db->RunQuery($sql);
			$t1 = $rs->fetch_object();
			$vDescription=$t1->RVehicleName;
		}
		$lng=0;
		$lat=0;				
		$time1=time()-1200;
		$time2=time()-60;	
		// lokacija i vreme iz UserLocation
		$timestart=time()-12*3600;
		$q = "SELECT * FROM `v4_UserLocations` WHERE 
			`UserID`=".$SubDriver." and
			`Time` > ".$timestart."
			order by time desc"; 
		$r = $db->RunQuery($q);
		$loc=array(); 
		while ($t = $r->fetch_object()) {
			$loc[] = $t;
		}
		$lc=$loc[0];
		$lat=$lc->Lat;
		$lng=$lc->Lng;			
		$location=$lc->Label;
		$device=$lc->Device.' at '.date('H:i:s',$lc->Time);
		$op->getRow($au->getIBAN());
		$accomodation=$op->getPlaceNameEN();
		$distACC=vincentyGreatCircleDistance($lat, $lng, $op->Latitude, $op->Longitude, $earthRadius = 6371000)/1000;
		if ($distACC<5) $acc=true;
		else $acc=false;
		
		foreach ($row as $rw) {
			if ($rw->SubDriver==$SubDriver || $rw->SubDriver2==$SubDriver || $rw->SubDriver3==$SubDriver) 
				$DetailsIDArray[] = $rw->DetailsID; 
		}

		
		?>
			<div class="col-md-<?= $BsColumnWidth ?> stupacWrapper">
				<div class="xcol-md-12 stupac">
					<div class="col-md-12 pad4px orange white-text">
						<div class="row">
							<div class="col-md-6">
								<strong><?= $au->getAuthUserRealName() ?></strong>  	
								<a style="color:white" href="tel:<?= $au->getAuthUserMob() ?>"><?= $au->getAuthUserMob() ?></a>
							</div>	
							<div class="col-md-6">
								<i class="fa fa-car"></i><strong> <?= $vDescription; ?></strong>  
							</div>	
						</div>
						<div class="row">
							<?= $accomodation ?>
						</div>		
					</div>
		<?			
		$display_location=true;
		foreach ($DetailsIDArray as $ID) { // REDAK u STUPCU (transfer)

		    $od->getRow($ID);
		    $om->getRow($od->getOrderID());
		    $otherTransfer = getOtherTransferIDArray($od->getDetailsID(),$details);
			if( $change) $changedIcon = '<i class="fa fa-circle text-red"></i>';
			$changedIcon = '';
			$color= '';
			if (in_array($ID,$olKeys2)) {
				$changedIcon = '<i class="fa fa-circle text-red"></i>';
				$color='red';
			}	

		    if($od->getSubPickupDate() == '0000-00-00') {
			    $od->setSubPickupDate( $od->getPickupDate() );
			    $saveRow = true;
		    }

		    if($od->getSubPickupTime() == '') {
			    $od->setSubPickupTime( $od->getPickupTime() );
		    }

		    # oznaci gdje ima, a gdje nema vozaca i vozila
		    if ($od->getSubDriver() == '0' or $od->getCar() == '0') {
			    $style= "border-left: 8px solid red; padding-left: 12px;";
		    }
		    else $style= "border-left: 8px solid green; padding-left: 12px;";

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

		    // elegantniji FIX :)
		    $duration = 'N/A';
		    if(!empty($od->RouteID) ) {
			    $or->getRow($od->getRouteID());
			    $duration = $or->getDuration();
				$km = $or->getKm();
		    }

		    // dohvacanje engleskih imena lokacija iz v4_Places
		    // FIXME ako je FREEFORM, PickupID i DropID su 0,
		    // pa se imena dohvacaju iz v4_OrderDetails

			$op->getRow($od->getPickupID());
			$PickupName = $op->getPlaceNameEN();
			$FromLatitude=$op->Latitude;
			$FromLongitude=$op->Longitude;		
			$op->getRow($od->getDropID());
			$DropName = $op->getPlaceNameEN();
			$ToLatitude=$op->Latitude;
			$ToLongitude=$op->Longitude;			
		    $Country=$op->getCountryNameEN();

		    // oznacavanje zavrsenih transfera
		    $bgColor = "#caefff";
			$bgColor2 = "#fefefe";
			
			$start_time=strtotime($od->getPickupDate().' '.$od->getSubPickupTime());
			$finish_time=strtotime($od->getPickupDate().' '.$od->getSubPickupTime())+$duration*60;
			
			//$currenttime=date('H:i',time());
			if ($start_time<time()) {
				$bgColor = "#00FF00";
				$bgColor2 = "#00FF00";
			}	
			if ($finish_time<time()) {
				$bgColor = "#FFCCCB";
				$bgColor2 = "#FFCCCB";
			}	
		    if($od->getTransferStatus() == "5") $bgColor = "#fefefe";
			if ($finish_time>time() && $start_time<time())	{
				$border1='border-style: solid';
				$flightap=0;
				$directon=$DropName;
				$Latitude=$ToLatitude;
				$Longitude=$ToLongitude;
				$direction_time=$finish_time;					
			}	
			else $border1='';
			if ($start_time>time())	{
				$border2='border-style: solid';
				$flightap=1;				
				$directon=$PickupName;
				$Latitude=$FromLatitude;
				$Longitude=$FromLongitude;
				$direction_time=$start_time;	
			}	
			else $border2='';
			
			/*$siteURL='https://www.planemapper.com/flights/'.strtoupper($od->getFlightNo());
			$str = file_get_contents($siteURL);
			preg_match_all("/\<div class='panel-heading text-center'\>(.*)\<\/div\>/",$str,$tag);
			$tag1=$tag[0][$flightap];
			preg_match_all("/\<h3 style='margin:6px 0px 0px 0px;'\>(.*)\<\/h3\>/",$tag1,$tag2);
			$tag3=$tag2[0][0];
			preg_match_all("/\<b\>(.*)\<\/b\>/",$tag3,$tag4);
			$flighttime=substr(strip_tags($tag4[0][0]),-5);	*/
			
			ob_start();
		    ?>
				<div style="background:<?= $bgColor2 ?>; <?= $border2 ?>;">
					<div style=''>
						<? if ($lat>0 && $lng>0) {
							$api_key='5b3ce3597851110001cf6248ec7fafd8eca44e0ca5590caf093aa7cb';
							$url='https://api.openrouteservice.org/v2/directions/driving-car?api_key='.$api_key.'&start='.$lng.','.$lat.'&end='.$Longitude.','.$Latitude;		
							$json = file_get_contents($url);   
							$obj=array();
							$obj = json_decode($json,true);
							if ($json) {
								$distance2=number_format(($obj['features'][0]['properties']['segments'][0]['distance'])/1000,0);
								$duration2=number_format(($obj['features'][0]['properties']['segments'][0]['duration'])/60);
								if ($lc->Time+$duration2*60<$direction_time) $shedule="<span style='color:green'>ON TIME</span>";
								else {
									$late=number_format(($lc->Time+$duration2*60-$direction_time)/60,0);
									$shedule="<span style='color:red'>LATE ".$late."min.</span>";
								}	
							}	
							else {
								$shedule='';
								if ($Longitude+$Latitude==0) $distance2=$directon. ' NO DATA';
								else $distance=$location. 'NO ROUTABLE';
								$duration2='';
							}
						?>
							<b>&emsp;<?= $device ?></b>
							<? if($acc) echo '<i class="fa fa-home"></i>'.$accomodation; ?><br>						
							<iframe src="https://maps.google.com/maps?q=<?= $lat ?>, <?= $lng ?>&z=8&output=embed"  frameborder="0" style="border:0"></iframe>
							<div class="row">
								<div class="col-md-6">
									<b><?= $location ?></b> to <?= $directon ?>
								</div>
								<div class="col-md-2">
									<i class="fa fa-road"></i><?= $distance2 ?><br> 
									<i class="fa fa-clock-o"></i><?= $duration2 ?> 
								</div>									
								<div class="col-md-4">
									<h4><?= $shedule ?></h4>
									<!---<a target='_blank' href='<?= $url ?>'>API</a>!-->
								</div>	
							</div>
						<? } ?>
					</div>						
				</div>	
			<?
			$mapa= ob_get_contents();
			ob_end_clean();
			if ($display_location && time()<$start_time) {
				echo $mapa;
				$display_location=false;				
			}
		?>
		
		
		
		
		
		<div class="row white shadow mytooltip" title="Transfer details" data-content='<? ?>'
			style="cursor:default; padding:8px !important;background:<?= $bgColor ?>; margin:12px 0; <?= $border1 ?>;">
			<div class="row">
				<?
				if ($display_location && time()<$finish_time && time()>$start_time) {
					echo $mapa;
					$display_location=false;				
				}	
				?>			
			</div>
			<div class="row">
				<div class="col-md-6">
					<h4><?= $PickupName ?> - <?= $DropName ?></h4>
				</div>
				<div class="col-md-2">
					<div class="">
						<i class="fa fa-road"></i> <?= $km ?><br>					
						<i class="fa fa-clock-o"></i> <?= $duration ?>
					</div>
				</div>								
				<div class="col-md-2">
					<? 
						$DetailsID=$od->getDetailsID();
						// blokirano jer ne funkcionise api
						//require_once $_SERVER['DOCUMENT_ROOT'] . '/db/v4_Flights.class.php';
						//require($_SERVER['DOCUMENT_ROOT'] . '/cms/a/getFlightStat.php');
					?>				
					<!---<div class="flight mytooltip" data-content="<? echo $message; ?>">
						<i class="fa fa-plane"></i> <?= $od->getFlightNo() ?><br>
						<?= $od->getFlightTime() ?>											
					</div>	!--->				
					<div>
						<i class="fa fa-plane"></i> <a target="_blank" href="<?= $fs_link?>"><?= $od->getFlightNo() ?></a><br>
						<?= $od->getFlightTime() ?>											
					</div>
				</div>	
				<div class="col-md-2">
					<span class="timepicker w100 <?= $color ?>" style="font-weight:bold;text-align:center">
						<h4><?= $od->getSubPickupTime();?></h4>
					</span>
				</div>
			</div>
			
			<div class="row">
				<button class="btn-xs btn-primary btn-block" onclick="ShowShow(<?= $i?>);toggleChevron(this);">
					<i class="fa fa-chevron-down"></i>
				</button>
			</div> <!--/listTile-->

		    <!-- hiddenInfo -->
		    <div class="row grey lighten-4 pad1em shadow" id="show<?= $i ?>" style="display:none;margin:0">
				<div class="row"> <!-- TRANSFER -->
					<span><?
						if($od->getUserLevelID() == '2') {
							echo " <i class='fa fa-user-secret'></i>";
							$au->getRow($od->getAgentID());
							if ($au->getImage()<>"") {
								echo "<img src='img/".$au->getImage()."'> ";	 
								echo "<b>".$au->getAuthUserRealName()."</b> ";	
								echo " Ref.No: ". $om->getMConfirmFile()."<br>"; 	
								echo "Emergency: ".	$au->getEmergencyPhone();
							}
						}
					?></span>
				</div>			
			    <div class="row">
				    <div class="">
				        <?= $om->getMOrderKey(); ?>-<?= $od->getOrderID() ?> 
				        <br>
				        <?= $t->SingleReturn; ?>
				        <b><?= PAX ?>: <?= $od->getPaxNo() ?> VT: <?= $od->getVehicleType() ?></b><br>
				        <?= $od->getPaxName(); ?> <?= $om->getMPaxTel(); ?>
				    </div>

				    <div class="">
				        <b><?= $PickupName ?></b><?= $od->getPickupAddress(); ?>
				        <br>
				        <?= $od->getPickupNotes(); ?>
				    </div>

				    <div class="">
				        <b><?= $DropName ?></b><?= $od->getDropAddress(); ?>
				    </div>

				    <div class="">
					    <?
						    if ($extras != '') echo $extras;
						    else echo NO_EXTRAS;
					    ?>
				    </div>
			    </div>
			    <hr style="border-color:gray">

			    <div class="row">
				    <div class="">
					    <small class="bold"><?= STAFF_NOTE ?></small></br>
					    <span><?= stripslashes( $od->getStaffNote() ) ?></span>
				    </div>

				    <div class="">
					    <small class="bold"><?= NOTES_TO_DRIVER ?></small><br>
					    <span style="border: 1px solid #ddd;">
							<?= stripslashes( $od->getSubDriverNote() ) ?>
						</span>
				    </div>

				    <div class="">
					    <small class="bold"><?= FINAL_NOTE ?></small><br>
					    <?= $od->getSubFinalNote(); ?><br>
					    <?= $od->getFinalNote(); /* privremeno */ ?>
				    </div>
		        </div>
			    <hr style="border-color:gray">	
		    </div><!--/row-->
	    </div>
	    <?
	    $i++;
	}
	echo '</div>';$columnCount++;
	if ((($columnCount) % $NoColumns) == 0) echo '</div><div class="row">';
	echo '</div>';
		// kraj stupca


}?>
</div>



<script>
/*setTimeout(function(){		
	window.location.reload();	
}, 300000);*/

$(".mytooltip").popover({trigger:'hover', html:true, placement:'top'});
	
function ShowShow(i) {
	$("#show"+i).toggle('slow');
}



function toggleChevron (button) {
	if (button.innerHTML == '<i class="fa fa-chevron-up"></i>')
		button.innerHTML = '<i class="fa fa-chevron-down"></i>';
	else button.innerHTML = '<i class="fa fa-chevron-up"></i>';
}
</script>










