<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';

if ($_REQUEST['DriverVehicle']==0) {
	$result = $dbT->RunQuery("DELETE FROM `v4_Vehicles` WHERE `VehicleTypeID`=".$_REQUEST['VehicleTypeID']." AND `OwnerID`=".$_SESSION['UseDriverID']);
	$result = $dbT->RunQuery("DELETE FROM `v4_Services` WHERE `VehicleTypeID`=".$_REQUEST['VehicleTypeID']." AND `OwnerID`=".$_SESSION['UseDriverID']);
	$VehicleID=0;
}	
if ($_REQUEST['DriverVehicle']==1) {
	$db->getRow($_REQUEST['VehicleTypeID']);
	$result = $dbT->RunQuery("INSERT IGNORE INTO `v4_Vehicles`(`VehicleTypeID`,`OwnerID`,`VehicleName`,`VehicleCapacity`,`SurCategory`) VALUES (".$_REQUEST['VehicleTypeID'].",".$_SESSION['UseDriverID'].",'".$db->getVehicleTypeName()."',".$db->getMax().",1)");
		$VehicleID=$dbT->insert_id();
		require_once '../../db/v4_AuthUsers.class.php';
		$au = new v4_AuthUsers();

		# get AuthUser data
		$au->getRow($_SESSION['UseDriverID']);
		# we only need ReturnDiscount
		$ReturnDiscount = $au->getReturnDiscount();
		# no need for this anymore
		$au->endv4_AuthUsers();	
	
		require_once '../../db/v4_DriverRoutes.class.php';
		$dr = new v4_DriverRoutes();
		require_once '../../db/v4_Services.class.php';
		$s  = new v4_Services();
		
		// dodati nove Services za sve rute koje Driver vozi
		$drK = $dr->getKeysBy('RouteID', 'asc', ' WHERE OwnerID =' . $_SESSION['UseDriverID']);
	
		foreach($drK as $n => $id) {
			$dr->getRow($id);
			$s->setOwnerID( $_SESSION['UseDriverID']);
			$s->setSurCategory('1');
			$s->setRouteID( $dr->getRouteID() );
			$s->setVehicleID( $VehicleID);
			$s->setVehicleTypeID ( $_REQUEST['VehicleTypeID']);
			$s->setVehicleAvailable('1');
			$s->setActive('1');
			$s->setDiscount( $ReturnDiscount );
			$s->setLastChange( date("Y-m-d H:i:s") );
		
			$s->saveAsNew();		
		}
}	
echo $VehicleID;

	