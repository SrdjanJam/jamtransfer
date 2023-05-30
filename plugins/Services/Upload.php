<?
require_once 'Initial.php';
	$change=0;
	$handle = fopen($_FILES["file"]["tmp_name"], "r");
	
	while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
		if($data[0] !='SID'){
			$sid=$data[0];
			$find=$db->getRow($sid);
			$db->setServicePrice1($data[4]);
			$db->saveRow();
			if ($find) $change=1;
		}
	}	
	fclose($handle);
	echo $change;
?>
