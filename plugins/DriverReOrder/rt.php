<?

$KEY = $_REQUEST['key'];

require_once '../../config.php';
require_once ROOT.'/db/v4_OrderRequest.class.php';
require_once ROOT.'/db/v4_OrderDetails.class.php';
require_once ROOT.'/db/v4_OrdersMaster.class.php';
require_once ROOT.'/db/v4_OrderExtras.class.php';
require_once ROOT.'/db/v4_Places.class.php';
require_once ROOT.'/db/v4_VehicleTypes.class.php';

$or = new v4_OrderRequest;
$od = new v4_OrderDetails;
$om = new v4_OrdersMaster;
$oe = new v4_OrderExtras;
$op = new v4_Places;
$vt = new v4_VehicleTypes;

$ork=$or->getKeysBy('ID', 'ASC', 'WHERE OrderKey = "' . $KEY .'" ');
if (count($ork)!=1) exit ("Something wrong");
$or->getRow($ork[0]);
if (isset($_REQUEST['Price'])) {
	if (isset($_REQUEST['Confirm'])) $or->setConfirmDecline(1);
	if (isset($_REQUEST['Decline'])) $or->setConfirmDecline(2);
	$or->setPrice($_REQUEST['Price']);
	date_default_timezone_set('Europe/Paris');
	$or->setResponseDate(date("Y-m-d"));
	$or->setResponseTime(date("H:i:s"));
	$or->saveRow();
}
$odk=$od->getKeysBy('DetailsID', 'ASC', 'WHERE OrderID = ' . $or->getOrderID() . ' and TNo=1 ');
$od->getRow($odk[0]);
$subject="Request For Availability";
if ($or->RequestType==2) {
	$subject.= " and Price";	
	$subsubject="<br>We have request from the client, please check all details on the link below and give us your best price.";
}
else $subsubject="<br>This is just information to Jam Transfer that you have available vehicle and the price is suitable for you. If client confirms it, you will get an email with new transfer.";

$ID=$odk[0];
$om->getRow($od->getOrderID());

$extras = $oe->getKeysBy('ID', 'ASC', 'WHERE OrderDetailsID = ' . $ID);

if (($od->PickupID != 0) and ($od->DropID != 0)) {
	$op->getRow($od->PickupID);
	$PickupName = $op->getPlaceNameEN();
	$op->getRow($od->DropID);
	$DropName = $op->getPlaceNameEN();
} else {
	$PickupName = $od->PickupName;
	$DropName = $od->DropName;
}
$price=$od->getDriversPrice();
$vt->getRow($od->getVehicleType());
?>
<img alt='unnamed.png' src='https://ci6.googleusercontent.com/proxy/gBp_3CS_Q7717vUShqpClwV5nvpSBMX4R12HglRtYH_bZAnFztxLaWUyx1TjLdnvX28O1lHpYBR3R-z3BTRB-S2cH1IvOCM=s0-d-e1-ft#https://signaturehound.com/api/v1/file/ip95nlc8vsyni'>
<h4><?=$subject ?></h4>
<p><?=$users[$or->DriverID]->AuthUserRealName ?></p>
<div class="container">
	<div class="row">
		<div >Order :</div>
		<div><b><?= $om->MOrderKey . '-' . $od->OrderID . ' ' . $returnTransfer; ?></b></div>
	</div>
	<div class="row">
		<div>VehicleType :</div>
		<div><b><?= $vt->VehicleTypeName  ?></b></div>
	</div>	
	<div class="row">
		<div>Pax No :</div>
		<div><b><?= $od->PaxNo . ' pax' ?></b></div>
	</div>
	<hr><hr>
	<div class="row">
		<div>Pickup Name :</div>
		<div><b><?= strtoupper($PickupName) ?></b></div>
	</div>
	<div class="row">
		<div>Drop Name :</div>
		<div><b><?= strtoupper($DropName) ?></b></div>
	</div>
	<hr><hr>
	<div class="row">
		<div>Pickup Date :</div>
		<div><b><?= $od->PickupDate ?></b></div>
	</div>
	<div class="row">
		<div>Pickup Time :</div>
		<div><b><?= $od->PickupTime ?></b></div>
	</div>
	<hr><hr>
	<? if (count($extras) > 0) { /* dobavi extra services */ ?>
		<div class="row">
			<div>Extras :</div>
			<div>
				<? foreach ($extras as $extra) {
					$oe->getRow($extra);
					echo $oe->ServiceName . ' x' . $oe->Qty . '<br>';
				} ?>
			</div>
		</div>
		<hr><hr>
	<? } if ($or->getReturnTransfer()==1) {
			$odkR=$od->getKeysBy('DetailsID', 'ASC', 'WHERE OrderID = ' . $or->getOrderID() . ' and TNo=2 ');
			$od->getRow($odkR[0]);
			if (($od->PickupID != 0) and ($od->DropID != 0)) {
				$op->getRow($od->PickupID);
				$PickupName = $op->getPlaceNameEN();
				$op->getRow($od->DropID);
				$DropName = $op->getPlaceNameEN();
			} else {
				$PickupName = $od->PickupName;
				$DropName = $od->DropName;
			}
			$price+=$od->getDriversPrice();
	?>
		<div class="row">
			<div>Return Date :</div>
				<div><b><?= $od->PickupDate ?></b></div>
			</div>
		</div>	
		<div class="row">
			<div>Return Time :</div>
			<div><b><?= $od->PickupTime ?></b></div>
		</div>
		<hr><hr>
	<? } 
		$readonly="";
		$disabled="";
		if ($or->getRequestType()==2) {
			$price=$or->Price;
			$disabled="disabled";
		}	
		else $readonly="readonly";
		if ($or->getConfirmDecline()>0) $readonly="readonly";
	?>
	<form action="" method="post">
		<div class="row">		
			<div>Price (EUR) :</div>
			<div>
				<div><input style="font-size:600%" type="text" class="form-control input-lg" id="Price" name="Price" value="<?= number_format($price,2) ?>"  <?= $readonly ?>/></div>
			</div>
		</div>
		<hr>
	<? if ($or->ConfirmDecline==0) { ?>
		<div class="row">
			<div><input style="font-size:600%" type="submit" class="green" name="Confirm" id="Confirm" value="Confirm" <?= $disabled ?> /></div>
		</div>	
		<hr>
		<div class="row">
			<div><input style="font-size:600%" type="submit" class="red" name="Decline" value="Decline" /></div>			
		</div>
		<hr><hr>		
	<? } else if ($or->ConfirmDecline==1) { ?>	
		<h4>Request confirmed<h4/>		
	<? } else {?>
		<h4>Request declined<h4/>	
	<? } ?>
		<input type="hidden" name="key" value="<?= $KEY ?>" />	
	</form>	
</div>
<small><?=$subsubject ?></small>
<script src="../../js/jQuery/2.0.2/jquery.min.js"></script>
<script>
	$("#Price").change(function(){
		$("#Confirm").prop("disabled", false);
	})	
</script>