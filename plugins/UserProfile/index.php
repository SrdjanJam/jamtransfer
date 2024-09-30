<?
	require_once ROOT . '/db/v4_AuthUsers.class.php';
	$db = new v4_AuthUsers();
	$db->getRow($_SESSION['AuthUserID']);
	
	if(isset($_REQUEST['save'])) {
		foreach ($db->fieldNames() as $name) {
			$content=$db->myreal_escape_string($_REQUEST[$name]);
			if(isset($_REQUEST[$name])) {
				eval("\$db->set".$name."(\$content);");	
			}	
		}
		$db->saveRow();
	}
	# get fields and values
	$detailFlds = $db->fieldValues();
	$detailFlds["DBImage"]='';

	# remove slashes 
	foreach ($detailFlds as $key=>$value) {
		$detailFlds[$key] = stripslashes($value);
	}
	$smarty->assign($detailFlds);



