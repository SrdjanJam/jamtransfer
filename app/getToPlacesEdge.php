<?
require_once "../config.php";
require_once ROOT . '/db/v4_AuthUsers.class.php';
$au = new v4_AuthUsers();
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
if($pass) {
	$fromName = $fID = $_REQUEST['fID'];
	$places = array();
	# Routes for selected place
	$q1 = "SELECT FromID, ToID, RouteID FROM v4_Routes
				WHERE FromID = '{$fID}'
				OR    ToID   = '{$fID}'
				";
	$r1 = $db->RunQuery($q1);
	while($r = $r1->fetch_object())
	{
		# DriverRoutes - check if anyone drives from that Place
		$q2 = "SELECT DISTINCT RouteID FROM v4_DriverRoutes
					WHERE RouteID = '{$r->RouteID}' 
					";
		$w2 = $db->RunQuery($q2);
		# If does
		if  ($w2->num_rows > 0)
		{
			# Places in the Country
			$q  = "SELECT * FROM v4_Places ";
			$q .= " WHERE (PlaceID  = ".$r->FromID;
			$q .= " OR    PlaceID  = ".$r->ToID .") ";
			$q .= " AND PlaceNameEN LIKE '%" . $_REQUEST['qry'] . "%' ";
			$q .= " ORDER BY PlaceNameEN ASC";
			$w = $db->RunQuery($q);
			while ($p = $w->fetch_object())
			{
				if($p->PlaceActive == '1' && $p->PlaceID != $fID && $p->PlaceActive == '1') $places[$p->PlaceID] = $p->PlaceNameEN;
			}
		}					
	}
	asort($places);	
	echo $res = json_encode($places);
}

