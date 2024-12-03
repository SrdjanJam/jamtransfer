<?

set_time_limit(360);
require_once 'Initial.php';
require_once ROOT . '/db/v4_Places.class.php';
$pl = new v4_Places();
	// praznjenje tabele
	$dbT->RunQuery("TRUNCATE TABLE `v4_RoutesTerminals`");
	// unos ruta koje imaju u sebi terminal
	$dbT->RunQuery("INSERT INTO `v4_RoutesTerminals`(`RouteID`, `TerminalID`) SELECT `RouteID`,`FromID`  FROM `v4_Routes` WHERE `FromID` in (Select TerminalID from v4_Terminals)");
	$dbT->RunQuery("INSERT INTO `v4_RoutesTerminals`(`RouteID`, `TerminalID`) SELECT `RouteID`,`ToID`  FROM `v4_Routes` WHERE `ToID` in (Select TerminalID from v4_Terminals)");
	// uzimanja geolokacija za sve terminale
	$result1=$dbT->RunQuery("SELECT TerminalID,Longitude,Latitude FROM `v4_Terminals`,v4_Places WHERE `TerminalID`=PlaceID");
		while($row = $result1->fetch_array(MYSQLI_ASSOC)){
			if ($row['Longitude']>0 && $row['Latitude']>0)
			$arr_row=array();
			$arr_row['TerminalID']=$row['TerminalID'];
			$arr_row['Longitude']=$row['Longitude'];
			$arr_row['Latitude']=$row['Latitude'];
			$terminals[]=$arr_row;
		}
	//uzimanje ruta koje nisu vezane za terminale
	$result2=$dbT->RunQuery("SELECT RouteID FROM `v4_Routes` WHERE `RouteID` not in (Select RouteID from v4_RoutesTerminals)");

		while($row = $result2->fetch_array(MYSQLI_ASSOC)){
			$db->getRow($row['RouteID']);
			$fID=$db->getFromID();
			$pl->getRow($fID);
			$fLon=$pl->getLongitude();
			$fLat=$pl->getLatitude();
			$tID=$db->getToID();
			$pl->getRow($tID);
			$tLon=$pl->getLongitude();
			$tLat=$pl->getLatitude();
			// selektovanje i belezenje najblizeg terminala lokacijama iz rute ako su do 500km
			if ($fLon>0 && $fLat>0 && $tLon>0 && $tLat>0) {
				$distanceMin=500000;
				$terminalID=0;			
				foreach($terminals as $t) {
					$terLon=$t['Longitude'];
					$terLat=$t['Latitude'];
					$distanceF=vincentyGreatCircleDistance($fLat,$fLon,$terLat,$terLon,'6371000');
					$distanceT=vincentyGreatCircleDistance($tLat,$tLon,$terLat,$terLon,'6371000');
					if ($distanceF<$distanceMin) {
						$distanceMin=$distanceF;
						$terminalID=$t['TerminalID'];
					}	
					if ($distanceT<$distanceMin) {
						$distanceMin=$distanceT;
						$terminalID=$t['TerminalID'];
					}
				}
				if ($terminalID>0) {
					$dbT->RunQuery("INSERT INTO `v4_RoutesTerminals`(`RouteID`, `TerminalID`) VALUES (".$row['RouteID'].",".$terminalID.")");					
				}		
			}
		}		
