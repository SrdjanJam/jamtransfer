<? 
error_reporting(E_PARSE);

//echo ROOTPATH;
require_once ROOT.'/f/f.php';
require_once ROOT.'/db/db.class.php';

require_once ROOT.'/db/v4_AuthUsers.class.php';

$au = new v4_AuthUsers();
$au->getRow($_SESSION['AuthUserID']);
$contractFile=$au->getContractFile();

$auK = $au->getKeysBy('Country', 'asc', ' WHERE AuthLevelID = 31');

$dashboardFilter = "";
$titleAddOn = '';

$today              = strtotime("today 00:00");
$yesterday          = strtotime("yesterday 00:00");
$datetime 			= new DateTime('tomorrow');
$tomorrow 			= $datetime->format('Y-m-d');
$lastWeek 			= strtotime("yesterday -1 week 00:00");

$today = date("Y-m-d", $today);
$lastWeek= date("Y-m-d", $lastWeek);

//if ($_SESSION['AuthLevelID'] == DRIVER_USER) $dashboardFilter = " AND DriverID = '".$_SESSION['AuthUserID']."' ";

//https://www.jamtransfer.com/cms/a/allTransfers.php?where= WHERE v4_OrderDetails.TransferStatus!='9'  AND v4_OrderDetails.DriverConfStatus='1' AND v4_OrderDetails.TransferStatus<'3'&status=0&Search=&page=1&length=20&sortOrder=ASC

if ($_REQUEST['transfersFilter'] == 'noDriver') {
	$dashboardFilter .= " AND DriverConfStatus ='0' AND TransferStatus < '3'";
	$titleAddOn = ' - ' . NO_DRIVER;
}

if ($_REQUEST['transfersFilter'] == 'notConfirmed') {
	$dashboardFilter .= " AND DriverConfStatus = '1' AND TransferStatus < '3'";
	$titleAddOn = ' - ' . NOT_CONFIRMED;
}

elseif ($_REQUEST['transfersFilter'] == 'notConfirmedToday') {
	$dashboardFilter .= " AND PickupDate = '".$today ."' AND (DriverConfStatus = '1' OR DriverConfStatus = '4')  AND TransferStatus < '3'";
	$titleAddOn = ' - ' . NOT_CONFIRMED . ' OR ' . DECLINED .' for Today ';
}

elseif ($_REQUEST['transfersFilter'] == 'notConfirmedTomorrow') {
	$dashboardFilter .= " AND PickupDate = '".$tomorrow ."' AND (DriverConfStatus = '1' OR DriverConfStatus = '4')  AND TransferStatus < '3'";
	$titleAddOn = ' - ' . NOT_CONFIRMED . ' OR ' . DECLINED .' for Tomorrow ';
}

elseif ($_REQUEST['transfersFilter'] == 'confirmed') {
	$dashboardFilter .= " AND (DriverConfStatus ='2' OR DriverConfStatus ='3') AND TransferStatus < '3'";
	$titleAddOn = ' - ' . CONFIRMED;
}

elseif ($_REQUEST['transfersFilter'] == 'declined') {
	$dashboardFilter .= " AND DriverConfStatus ='4' AND TransferStatus < '3'";
	$titleAddOn = ' - ' . DECLINED;
}

elseif ($_REQUEST['transfersFilter'] == 'canceled') {
	$dashboardFilter .= " AND TransferStatus = '3'";
	$titleAddOn = ' - ' . CANCELED;
}

elseif ($_REQUEST['transfersFilter'] == 'noshow') {
	$dashboardFilter .= " AND DriverConfStatus = '5'";
	$titleAddOn = ' - ' . NO_SHOW;
}

elseif ($_REQUEST['transfersFilter'] == 'driverError') {
	$dashboardFilter .= " AND DriverConfStatus = '6'";
	$titleAddOn = ' - ' . DRIVER_ERROR;
}

elseif ($_REQUEST['transfersFilter'] == 'notCompleted') { 
$dashboardFilter .= " AND TransferStatus < '3' AND PickupDate <  (CURRENT_DATE)-INTERVAL 1 DAY ";
$titleAddOn = ' -  NOT COMPLETED';
}

elseif ($_REQUEST['transfersFilter'] == 'active') {
$dashboardFilter .= " AND TransferStatus < '3'";
$titleAddOn = ' - ' . ACTIVE;
}

elseif ($_REQUEST['transfersFilter'] == 'new') {
$dashboardFilter .= " AND TransferStatus < '3' AND OrderDate = '" . $today . "'";
$titleAddOn = ' - ' . NEWW;
}

elseif ($_REQUEST['transfersFilter'] == 'tomorrow') {
$dashboardFilter .= " AND TransferStatus < '3' AND PickupDate = '" . $tomorrow . "'";
$titleAddOn = ' - ' . TOMORROW;
}

elseif ($_REQUEST['transfersFilter'] == 'deleted') {
$dashboardFilter .= " AND TransferStatus = '9'";
$titleAddOn = ' - ' . DELETED;
}


elseif ($_REQUEST['transfersFilter'] == 'agent') {
$dashboardFilter .= " AND UserLevelID = '2'";
$titleAddOn = ' - ' . AGENT_TRANSFERS;
}

elseif ($_REQUEST['transfersFilter'] == 'invoice2') {
$dashboardFilter .= " AND PaymentMethod = '6'";
$titleAddOn = ' -  INVOICE 2';
}

elseif ($_REQUEST['transfersFilter'] == 'order') {
$oid_arr=explode('-',$_REQUEST['orderid']);
if (count($oid_arr)>1) {
	$oid=rtrim($oid_arr[0]);
	$tn=rtrim($oid_arr[1]);
	$dashboardFilter .= " AND OrderID = ".$oid." AND TNo = ".$tn;
}
else $dashboardFilter .= " AND OrderID = ".$_REQUEST['orderid'];	

$titleAddOn = ' - ORDER' ;
}

elseif ($_REQUEST['transfersFilter'] == 'details') {
$dashboardFilter .= " AND DetailsID = ". $_REQUEST['id'];
$titleAddOn = ' - ' . AGENT_TRANSFERS;
}


elseif (isset($_REQUEST['archive'])) {
$titleAddOn = ' - ARCHIVE' ;
}

$defDate=time()-540*24*3600;
$date = new DateTime();	
$date->setTimestamp($defDate);
$defDate = $date->format('Y-m-d');

if ($filterDate == '') $filterDate = $defDate;

//if ( isset($_REQUEST['transfersFilter']) ) $filterDate = date("Y-m-d"); // ovo cu razmislit
/*else*/if ( isset($_COOKIE['dateFilterCookie']) && $_COOKIE['dateFilterCookie'] !="") $filterDate = $_COOKIE['dateFilterCookie'];



?>
<div class="container-fluid ">
	<div  style="width: 100%; background-color:white; z-index:100;">   
		<div class="col-md-10"> <h1><?= TRANSFERS . ' ' . $titleAddOn ?></h1></div> 
		<div id="pageSelect" class="col-md-2"></div>
			
		<input type="hidden"  id="whereCondition" name="whereCondition" 
		value=" WHERE v4_OrderDetails.TransferStatus != '9' AND v4_OrderDetails.PickupDate > '2015-01-01' <?= $dashboardFilter ?>">


		<div class="row pad1em" id="searchRow">
			<div class="col-md-2" id="infoShow"></div>
			<div class="col-md-2">
				<i class="fa fa-list-ul"></i>
				<select id="status" class="w75" onchange="getAllTransfersFilter();">
					<option value="0"> --- </option>
					<?
					foreach($StatusDescription as $val => $text) {
						echo  '<option value="'.$val.'"> ' . $text . '</option>';
					}		
					?>
				</select>
			</div>
			<div class="col-md-2">
				<i class="fa fa-eye"></i>
				<select id="length" name="length" class="w75" onchange="getAllTransfersFilter();">
					<option value="5"> 5 </option>
					<option value="10"> 10 </option>
					<option value="20" selected> 20 </option>
					<option value="50"> 50 </option>
					<option value="100"> 100 </option>
				</select>
			</div>

			<div class="col-md-3">
				<i class="fa fa-search"></i>
				<input type="text" id="Search" class=" w75" onchange="getAllTransfersFilter();" placeholder="Text + Enter to Search">
			</div>
			<div class="col-md-3">
				
				<button class="btn white shadow align" onclick="$('#advancedSearch').toggle('slow');">
					<span id="advancedSearchActive"></span> <?= ADVANCED_SEARCH ?>
				</button>
				
			</div>
		</div>

		<div class="row green-1 " id="advancedSearch" style="display:none">

			<div class="col-md-6">
				<br>
				<?= SHOW_BOOKED ?>:<br>
				<select id="filterBooked" class="xform-control">
					<option value=">="> <?= AFTER_INCLUDING ?> </option>
					<option value=">"> <?= AFTER ?> </option>
					<option value="<"> <?= BEFORE ?> </option>
					<option value="="> <?= ON ?> </option>
				</select>
				<input type="text" id="filterBookedDate" name="filterBookedDate" class="w50 xform-control datepicker" >
			</div>

			<div class="col-md-6 pad1em">
				<?= AND_PICKUP_DATE_IS ?> :<br>
				<select id="filterPickup" class="xform-control">
					<option value=">="> <?= AFTER_INCLUDING ?> </option>
					<option value=">"> <?= AFTER ?> </option>
					<option value="<"> <?= BEFORE ?> </option>
					<option value="="> <?= ON ?> </option>
				</select>
				<input type="text" id="filterPickupDate" class="w50 datepicker" value="<?= $filterDate; ?>"
				onchange="createCookie('dateFilterCookie', this.value, '200');">
				Default: <?= $defDate ?> 
				
			</div>
			
			<div class="col-md-5 pad1em">
				<? if ($_SESSION['AuthLevelID'] != DRIVER_USER) { ?>
					<?= AND_DRIVER_IS ?> :<br>
					<select name="filterDriverID" id="filterDriverID" class="xform-control w75">
						<option value="0"> --- </option>
						<?
							foreach( $auK as $n => $v) {
								$au->getRow($v);
								echo '	<option value="'.$au->getAuthUserID().'" ';
							
								if ($au->getAuthUserID() == $in->DriverID) echo ' selected="selected"';
							
								echo '>'.$au->getCountry().'-'.$au->getTerminal().'-'.$au->getAuthUserCompany().'</option>';
							}
						?>
					</select>
				<? } else { ?>
					<input type="hidden" name="filterDriverID" id="filterDriverID" 
					value="<?= $_SESSION['AuthUserID']?>">
				<? } ?>
			</div>

			<div class="col-md-2 pad1em">
				<?= SORT_BY_PICKUP_DATE ?> :<br>
				<select name="sortOrder" id="sortOrder" class="xform-control">
					<option value="ASC" selected="selected"> <?= ASCENDING ?> </option>
					<option value="DESC"> <?= DESCENDING ?> </option>
				</select>
			</div>

			<div class="col-md-2 pad1em">
				<?= EXTRA_SERVICES ?> :<br>
				<select name="extraServices" id="extraServicesChoose">
					<option value="any" selected="selected"> <?= ANY ?> </option>
					<option value="only"> <?= ONLY_EXTRAS ?> </option>
					<option value="none"> <?= NO_EXTRAS ?> </option>
				</select>
			</div>

			<div class="col-md-3 pad1em">
				<br>
				<button class="btn btn-primary l" onclick="getAllTransfersFilter();$('#advancedSearch').hide('slow');">
					<i class="ic-search"></i> <?= APPLY ?>
				</button>
				<br> <br><br>
			</div>
			
		</div>	
	</div>	
	<div id="showTransfers"><div class="center"><?= THERE_ARE_NO_DATA ?></div></div>
	
	<? 
		// ovo nije u primjeni, ali je ideja
		if ($_SESSION['AuthLevelID'] == '31') define("READ_ONLY_FLD", 'readonly="readonly"');		
		if ($_SESSION['AuthLevelID'] >= '91') define("READ_ONLY_FLD", '');
		
		// inList razlikuje je li direktan poziv Edit transfera (npr. iz dashboarda)
		// ili ide preko liste svih transfera
		// ako je iz liste, onda je true
		$inList = 'true';

		// Poziva se template za Listu i za Edit transfera
		// koristi handlebars
		require_once $modulesPath .'/transfers/transferList.'.$_SESSION['GroupProfile'].'.php';
		require_once $modulesPath .'/transfers/transferEditForm.'.$_SESSION['GroupProfile'].'.php'; 
	?>

</div>

<script type="text/javascript">
	$(document).ready(function(){
		$(".datepicker").pickadate({format:'yyyy-mm-dd'});
		getAllTransfers(); // definirano u cms.jquery.js
	});

	function getAllTransfersFilter() {
		getAllTransfers(); // definirano u cms.jquery.js
	}
</script>

