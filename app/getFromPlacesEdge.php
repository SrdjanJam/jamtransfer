<?
require_once "../config.php";
$pass=false;
$agentKeys = $au->getKeysBy('AuthUserID','asc',"WHERE AuthLevelID=2 and Active=1");
foreach($agentKeys as $ki => $id) {
	$au->getRow($id);
	if ($_REQUEST['code']==md5($au->getAuthUserPass())) {
		$pass=true;
		$userID=$au->getAuthUserID();
		break;
	}	
}
	$fromPlaces = array();
	$q  = " SELECT * FROM v4_Places ";
	$q .= " WHERE PlaceActive = '1'";
	$q .= " AND PlaceNameEN LIKE '" . $_REQUEST['qry'] . "%' ";
	$q .= " ORDER BY PlaceNameEN ASC";
	$w = $db->RunQuery($q);
	while($p = mysqli_fetch_object($w))
	{
		# DriverRoutes - check if anyone drives from that Place
		$q2 = "SELECT * FROM v4_DriverRoutes
				WHERE FromID = '{$p->PlaceID}'
				OR    ToID   = '{$p->PlaceID}'
					";
		$w2 = $db->RunQuery($q2);
		# If does
		if  (mysqli_num_rows($w2) > 0 && $p->PlaceActive == '1') $fromPlaces[$p->PlaceID] = $p->PlaceNameEN;							
	}
	# Sort by name
	asort($fromPlaces);
	echo $res = json_encode($fromPlaces);
}

