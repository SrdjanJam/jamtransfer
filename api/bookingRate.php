<?

require_once '../config.php';

require_once '../db/db.class.php';
require_once '../db/v4_OrderDetailsTemp.class.php';


$dbT = new DataBaseMysql();


$LocationID	= $_REQUEST['LocationID'];
$Date1   = $_REQUEST['Date1'];
$Date2   = $_REQUEST['Date2'];
$Period  = $_REQUEST['Period'];



// Izlazni podaci koje koriste skripte za display
$steps = array(); 
	if ($Date1<>"") $addsql.= " AND OrderDate>='".$Date1."' ";
	if ($Date2<>"") $addsql.= " AND OrderDate<='".$Date2."' ";
	if ($LocationID>0) $addsql.= " AND (PickupID=".$LocationID." OR DropID=".$LocationID.")";
	
	$sql1="SELECT count(*) as number FROM `v4_OrderDetailsTemp` WHERE DriverID=0";
	$sql1.=$addsql;
    $r = $dbT->RunQuery($sql1);
    $o = $r->fetch_object();
	$n1=$o->number;  
	$sql2="SELECT count(*) as number FROM `v4_OrderDetailsTemp` WHERE DriverID>0 and (PayNow+PayLater+InvoiceAmount=0 or PayNow+PayLater+InvoiceAmount is null)";	
	$sql2.=$addsql;
	$r = $dbT->RunQuery($sql2);
    $o = $r->fetch_object();
	$n2=$o->number;	
	$sql3="SELECT count(*) as number FROM `v4_OrderDetailsTemp` WHERE DriverID>0 and PayNow+PayLater+InvoiceAmount>0";
	$sql3.=$addsql;	
	$r = $dbT->RunQuery($sql3);
    $o = $r->fetch_object();
	$n3=$o->number;	
	$uk=$n1+$n2+$n3;
	$p1=number_format($n1*100/$uk,2);
	$p2=number_format($n2*100/$uk,2);
	$p3=number_format($n3*100/$uk,2);
	$steps[] = array(
		'Step' => 'Step1',
		'Number' => $n1,
		'Percent' => $p1
	);				
	$steps[] = array(
		'Step' => 'Step2',
		'Number' => $n2,
		'Percent' => $p2
	);
	$steps[] = array(
		'Step' => 'Step3',
		'Number' => $n3,
		'Percent' => $p3
	);				
				
$steps = json_encode($steps);
echo $_GET['callback'] . '(' . $steps. ')';
