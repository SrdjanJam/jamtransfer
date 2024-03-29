<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/sessionThingy.php';
//@session_start();
error_reporting(E_PARSE);
require_once $_SERVER['DOCUMENT_ROOT'] . '/db/db.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/f/f.php';
// reset
$_SESSION['CountryID'] = '';
$_SESSION['FromID'] = '';
$_SESSION['ToID'] = '';
$_SESSION['fromName'] = '';
$_SESSION['fromPlaces'] = array();

// logit($_SESSION);
$db = new DataBaseMysql();

if(isset($_REQUEST['language'])) $_SESSION['language'] = $_REQUEST['language'];

$lang = Lang();
$fromPlaces = array();

# save variables for later usage
#$_SESSION['countryID'] = array_search(str_replace('_',' ',$_SESSION['lastElement']), $_SESSION['countries']);
#$cID = $_SESSION['countryID'];
#$_SESSION['countryName'] = $_SESSION['countries'][$cID];
//unset($_SESSION['countries']);
//echo '<pre>'; print_r($_SESSION); echo '</pre>';

$cID = $_REQUEST['cID'];
// Get from Cache
$filename = $_SERVER['DOCUMENT_ROOT'] . '/cache/fromPlaces'.$cID.$lang.'.json';
logit($filename);
$cachetime = 84600;
/*
if (file_exists($filename) && time() - $cachetime < filemtime($filename)) {

	$handle = fopen($filename, "r");
	$contents = fread($handle, filesize($filename));
	fclose($handle);
	
	$noBrackets = str_replace('(','',$contents);
	$contents = str_replace(')','',$noBrackets);
	$jsonArray = json_decode($contents, true);

	unset($_SESSION['fromPlaces']);
	foreach ($jsonArray as $key => $value)
	{
		$_SESSION['fromPlaces'][$key] = $value;
	}
	
	$rewriteCache = false;
	logit($filename . ' FOUND');
}


else {
	logit($filename . ' NOT FOUND');


*/

	
	# Places in the Country
	$q  = " SELECT * FROM v4_Places ";
//	$q .= " WHERE PlaceCountry = '".$cID."'";
	$q .= " WHERE PlaceActive = '1'";
	$q .= " AND PlaceNameEN LIKE '" . $_REQUEST['qry'] . "%' ";
	$q .= " ORDER BY PlaceNameEN ASC";
	$w = $db->RunQuery($q);

	while($p = mysqli_fetch_object($w))
	{
		# Routes for selected place
		/*
		$q1 = "SELECT FromID, ToID, RouteID FROM v4_Routes
					WHERE FromID = '{$p->PlaceID}'
					OR    ToID   = '{$p->PlaceID}'
					";
		$r1 = $db->RunQuery($q1);

		while($r = mysqli_fetch_object($r1))
		{
		*/
		
			# DriverRoutes - check if anyone drives from that Place
			$q2 = "SELECT * FROM v4_DriverRoutes
					WHERE FromID = '{$p->PlaceID}'
					OR    ToID   = '{$p->PlaceID}'
						";
			$w2 = $db->RunQuery($q2);
		
			# If does
			if  (mysqli_num_rows($w2) > 0)
			{
				if($p->PlaceActive == '1') {
					# Add Place to array
			    	$pnLang = 'PlaceName'. $lang;
			    	if(strlen($pnLang) == 9) $pnLang = 'PlaceNameEN';
			    
				    $placeName = strtolower($p->$pnLang);
				    
				    // fix ako nema jezika
				    if(empty($placeName)) $pnLang = 'PlaceNameEN';
				    $placeName = strtolower($p->$pnLang);			

					# Add Place to array
					if (!in_array($placeName.'|'.$p->PlaceNameSEO,$fromPlaces)) {
						//$fromPlaces[$p->PlaceID] = trim($placeName) . '|' . trim($p->PlaceNameSEO);
						$fromPlaces[trim($placeName)] = array(
															'ID' => $p->PlaceID,
															'PlaceNameSEO' => trim($p->PlaceNameSEO)
														);
					}
				}
			}						
		//}
	

	}

	# Sort by name
	asort($fromPlaces);
	
	//$_SESSION['fromPlaces'] = $fromPlaces;

	//unset($fromPlaces);
	$rewriteCache = false;
//}

$res = array();

foreach ($fromPlaces as $key => $value)
{
	# code...
	            $res[] = array(
              	'Place'=>strtoupper($key),
                'ID'=>$value['ID'],
                'SEO' => $value['PlaceNameSEO']

            	);
}

$res = json_encode($res);
ob_start();
echo $_GET['callback'] . '(' . $res. ')';

ob_end_flush();

if ($rewriteCache) {
	// Save to Cache	
	$jsonFromPlaces = json_encode($_SESSION['fromPlaces']);
	//$filename = $_SERVER['DOCUMENT_ROOT'] . '/cache/fromPlaces'.$cID.'.json';
	$handle = fopen($filename, "w");
	$contents = fwrite($handle, $jsonFromPlaces);
	fclose($handle);
	// ************
}

