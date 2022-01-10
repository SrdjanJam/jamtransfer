<?
$ID = $_REQUEST["ID"];
$value = $_REQUEST["value"];

require_once "../../../../db/v4_Survey.class.php";

$su = new v4_Survey;

$su->getRow($ID);
$su->setApproved($value);
$result = $su->saveRow();


if ($result) echo $value;
else echo 'Error';

