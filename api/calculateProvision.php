<?
require_once '../config.php';
if (!isset($_REQUEST['type']) || $_REQUEST['type']!="Final")
	echo returnProvision2($_REQUEST['price'],0,0);
else 
	echo returnProvision2Back($_REQUEST['price'],0,0);