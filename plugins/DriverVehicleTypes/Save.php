<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';

if ($_REQUEST['DriverVehicle']==0) {
	$result = $dbT->RunQuery("DELETE FROM `v4_Vehicles` WHERE `VehicleTypeID`=".$_REQUEST['VehicleTypeID']." AND `OwnerID`=".$_SESSION['UseDriverID']);
	$result = $dbT->RunQuery("DELETE FROM `v4_Services` WHERE `VehicleTypeID`=".$_REQUEST['VehicleTypeID']." AND `OwnerID`=".$_SESSION['UseDriverID']);
}	
if ($_REQUEST['DriverVehicle']==1) {
	$result = $dbT->RunQuery("INSERT IGNORE INTO `v4_Vehicles`(`VehicleTypeID`,`OwnerID`,`SurCategory`) VALUES (".$_REQUEST['VehicleTypeID'].",".$_SESSION['UseDriverID'].",1)");
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
			//$s->setVehicleID( $newID );
			$s->setVehicleTypeID ( $_REQUEST['VehicleTypeID']);
			$s->setVehicleAvailable('1');
			$s->setActive('1');
			$s->setDiscount( $ReturnDiscount );
			$s->setLastChange( date("Y-m-d H:i:s") );
		
			$s->saveAsNew();		
		}
}	
echo $_REQUEST['DriverVehicle'];

	