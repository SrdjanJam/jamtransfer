<?
require_once '../../db/v4_Vehicles.class.php';
require_once '../../db/v4_Services.class.php';
require_once '../../db/v4_AuthUsers.class.php';
	
$v  = new v4_Vehicles();
$s  = new v4_Services();
$au = new v4_AuthUsers();

# get AuthUser data
$au->getRow($_SESSION['UseDriverID']);
# we only need ReturnDiscount
$ReturnDiscount = $au->getReturnDiscount();
# no need for this anymore
$au->endv4_AuthUsers();
# dodaj services, za svako vozilo 
$vK = $v->getKeysBy('VehicleID', 'asc', " WHERE OwnerID = " . $_SESSION['UseDriverID']);
if(count($vK) > 0) {
	foreach($vK as $nn => $id) {
		# podaci o vozilu
		$v->getRow($id);
		
		$sKey = $s->getKeysBy('ServiceID', 'asc', 
		' WHERE RouteID = "'.$_REQUEST['RouteID'].'" 
		  AND OwnerID="'.$_SESSION['UseDriverID'].'" 
		  AND VehicleTypeID="'. $v->getVehicleTypeID() .'" ');
		
		// ako ne postoji
		if(count($sKey) == 0) {
			$s->setOwnerID( $_SESSION['UseDriverID'] );
			$s->setSurCategory( '1' );
			$s->setRouteID( $_REQUEST['RouteID'] );
			$s->setVehicleID( $v->getVehicleID() );
			$s->setVehicleTypeID ( $v->getVehicleTypeID() );
			$s->setVehicleAvailable('1');
			$s->setActive('1');
			$s->setDiscount( $ReturnDiscount );
			$s->setLastChange( date("Y-m-d H:i:s") );

			$s->saveAsNew();
		}			
	}
}

	