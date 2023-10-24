<?
	require_once '../../config.php';

	$PlaceID=$_REQUEST['PlaceID'];
	ob_start(); 
	MakeCSV($PlaceID);
	$csv = ob_get_contents();
	ob_end_clean();
	
	$fp = fopen('TopRoutes_'.$PlaceID.'.csv', 'w');
	fwrite($fp, $csv);
	
function MakeCSV($PlaceID) {

	require_once $_SERVER['DOCUMENT_ROOT'] .'/db/db.class.php';
	$db = new DataBaseMysql();
	#===

	// Delimiter
	$dlm = ";";
	
	# CSV first row
	echo 
		'RID'.$dlm.
		'Route Name EN'.$dlm.
		'Route Name'.$dlm.
		'Number of Transfers'.$dlm.
		"\n";
	
		$q1 = "SELECT 
			v4_Routes.RouteID as rid, 
			v4_Routes.RouteNameEN as rne, 
			v4_Routes.RouteName as rn, 
			count(*) as cnt 
		FROM `v4_OrderDetails`,v4_Routes 
		WHERE 
			v4_OrderDetails.RouteID=v4_Routes.RouteID 
			and 
				(v4_Routes.FromID=".$PlaceID." 
					or v4_Routes.RouteID 
						in 
							(
								SELECT `RouteID` FROM `v4_RoutesTerminals` 
									WHERE `TerminalID`=".$PlaceID."  
							)
				) 
		GROUP BY v4_Routes.RouteID 
		ORDER BY cnt desc
		";
	$w1 = $db->RunQuery($q1) or die( mysql_error() . '');

	while($r = $w1->fetch_object()) {
		echo 
			$r->rid . $dlm. 
			$r->rn . $dlm .
			$r->rne . $dlm .
			$r->cnt . $dlm .
			"\n";
	}	

}
?>





