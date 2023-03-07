<?
header('Content-Type: text/javascript; charset=UTF-8');
require_once 'Initial.php';

$out = array();
# Details  red
$db->getRow($_REQUEST['ItemID']);
# get fields and values
$detailFlds = $db->fieldValues();
# remove slashes 
foreach ($detailFlds as $key=>$value) {
	$detailFlds[$key] = stripslashes($value);
}
// check list
$rqk = $rq->getKeysBy('DisplayOrder', '', " Where Active>0");
$checklist=array();
if (count($rqk) != 0) {
	foreach ($rqk as $nn => $key)
	{
		$rq->getRow($key);	
		$checklist_row['id']=$rq->getID();
		$checklist_row['title']=$rq->getTitle();
		$checklist[]=$checklist_row;
	}
}
$detailFlds['checklist']=$checklist;
	
$rq_arr=array();
$sqls="SELECT RequestID FROM `v4_ActionRequestItem` WHERE `ActionID`=".$_REQUEST['ItemID'];
$query=mysqli_query($dbc->conn, $sqls) or die('Error in RequestCheckList query' . mysqli_connect_error());
while($rqp = mysqli_fetch_object($query) ) {
	$rq_row['rqid']=$rqp->RequestID;
	$rq_arr[]=$rq_row;		
}
$detailFlds['rq_arr']=$rq_arr;


$out[] = $detailFlds;
# send output back
$output = json_encode($out);
echo $output;