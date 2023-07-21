<?
$sum=array();
	// subdrivers 
	$q  = "SELECT * FROM v4_AuthUsers ";
	$q .= "WHERE DriverID = ".$_SESSION['UseDriverID']. " ";
	//$q .= " AND Active=1 ";
	$q .= " ORDER BY AuthUserRealName ASC";
	
    $w = $dbT->RunQuery($q);

	if (isset($_REQUEST['orderFromDate']) && $_REQUEST['orderFromDate']>0) $FromDate = $_REQUEST['orderFromDate'];
	else $FromDate="2018-08-01";
	if (isset($_REQUEST['orderToDate']) && $_REQUEST['orderToDate']>0) $ToDate = $_REQUEST['orderToDate'];
	else $ToDate = date("Y-m-d");


	$date_range= "PickupDate >= '".$FromDate."' AND PickupDate < '".$ToDate."'";	
	$date_range2= "Datum >= '".$FromDate."' AND Datum < '".$ToDate."'";	
	// CASH-IN prvi vozac naplacuje transfer
	$q1  = "SELECT SubDriver, SUM(CashIn) AS Primljeno FROM v4_OrderDetails ";
	$q1 .= "WHERE ".$date_range;
	$q1 .= " GROUP BY SubDriver ";	
	$w1 = $dbT->RunQuery($q1);
	
	$orders_arr=array();
	while($od = $w1->fetch_object()) {
		$o_arr=array();
		$o_arr['SubDriver']=$od->SubDriver;
		$o_arr['Primljeno']=$od->Primljeno;
		$orders_arr[]=$o_arr;
	}
	// CASH-IN for last day
	$q4  = "SELECT SubDriver, SUM(CashIn) AS Primljeno FROM v4_OrderDetails ";
	$q4 .= "WHERE PickupDate = '".$ToDate."'";	
	$q4 .= " GROUP BY SubDriver ";		

	$w4 = $dbT->RunQuery($q4);
	$orders_arr2=array();
	while($od2 = $w4->fetch_object()) {
		$o_arr2=array();
		$o_arr2['SubDriver']=$od2->SubDriver;
		$o_arr2['Primljeno']=$od2->Primljeno;
		$orders_arr2[]=$o_arr2;
	}
	// CASH PLAN for last day
	$q6  = "SELECT SubDriver, SUM(PayLater) AS CashPlan FROM v4_OrderDetails ";
	$q6 .= "WHERE PickupDate = '".$ToDate."'";	
	$q6 .= " GROUP BY SubDriver ";			
	$w6 = $dbT->RunQuery($q6);
	$orders_arr3=array();
	while($od3 = $w6->fetch_object()) {
		$o_arr3=array();
		$o_arr3['SubDriver']=$od3->SubDriver;
		$o_arr3['CashPlan']=$od3->CashPlan;
		$orders_arr3[]=$o_arr3;
	}	
	
	// CASH EXPENSES APPROVED
	$q2  = "SELECT DriverID, SUM(Amount) AS Trosak FROM v4_SubExpenses WHERE Card = 0 ";
	$q2 .= "AND ".$date_range2." AND Approved=1";	
	$q2 .= " GROUP BY DriverID ";			
	
	$w2 = $dbT->RunQuery($q2);
	$expenses_arr=array();
	while($ex = $w2->fetch_object()) {
		$ex_arr=array();
		$ex_arr['DriverID']=$ex->DriverID;
		$ex_arr['Trosak']=$ex->Trosak;
		$expenses_arr[]=$ex_arr;
	}

	// CASH EXPENSES LAST DAY APPROVED
	$q5  = "SELECT DriverID, SUM(Amount) AS Trosak FROM v4_SubExpenses WHERE Card = 0 ";
	$q5 .= "AND Datum = '".$ToDate."' AND Approved=1";	
	$q5 .= " GROUP BY DriverID ";			
	
	$w5 = $dbT->RunQuery($q5);
	$expenses_arr3=array();
	while($ex3 = $w5->fetch_object()) {
		$ex_arr3=array();
		$ex_arr3['DriverID']=$ex3->DriverID;
		$ex_arr3['Trosak']=$ex3->Trosak;
		$expenses_arr3[]=$ex_arr3;
	}
	
	// CASH EXPENSES Unapproved
	$q3  = "SELECT DriverID, SUM(Amount) AS Trosak FROM v4_SubExpenses WHERE Card = 0 AND Approved = 0 ";
	$q3 .= "AND ".$date_range2; 
	$q3 .= " GROUP BY DriverID ";			
	
	$w3 = $dbT->RunQuery($q3);
	$expenses_arr2=array();
	while($ex2 = $w3->fetch_object()) {
		$ex_arr2=array();
		$ex_arr2['DriverID']=$ex2->DriverID;
		$ex_arr2['Trosak']=$ex2->Trosak;
		$expenses_arr2[]=$ex_arr2;
	}
	
	// Recived CASH 
	$q7  = "SELECT v4_Actions.ReciverID AS RID, SUM(Amount) AS Trosak FROM v4_SubExpenses,v4_Actions WHERE v4_SubExpenses.Expense=v4_Actions.ID and v4_Actions.ReciverID>0 ";
	$q7 .= "AND ".$date_range2; 
	$q7 .= "AND Approved =1 "; 
	$q7 .= " GROUP BY v4_Actions.ReciverID ";			
	
	$w7 = $dbT->RunQuery($q7);
	while($ex7 = $w7->fetch_object()) {
		$rc_arr=array();
		$rc_arr['DriverID']=$ex7->RID;
		$rc_arr['Trosak']=$ex7->Trosak;
		$rcash_arr[]=$rc_arr;
	}
	
while($d = $w->fetch_object())	{
	//subdriver balance
	$subDriverID = $d->AuthUserID;

	// CASH-IN
	$key = array_search($subDriverID, array_column($orders_arr, 'SubDriver'));
	if ($key>-1) $Primljeno = $orders_arr[$key]['Primljeno'];			
	else $Primljeno = number_format(0,2);
		
	// CASH-IN for last day
	$key2 = array_search($subDriverID, array_column($orders_arr2, 'SubDriver'));
	if ($key2>-1) $Primljeno2 = $orders_arr2[$key2]['Primljeno'];			
	else $Primljeno2 = number_format(0,2);

	// CASH EXPENSES
	$key3 = array_search($subDriverID, array_column($expenses_arr, 'DriverID'));
	if ($key3>-1) $Trosak = $expenses_arr[$key3]['Trosak'];			
	else $Trosak = number_format(0,2);
	
	// CASH EXPENSES LAST DAY
	$key5 = array_search($subDriverID, array_column($expenses_arr3, 'DriverID'));
	if ($key5>-1) $Trosak3 = $expenses_arr3[$key5]['Trosak'];			
	else $Trosak3 = number_format(0,2);

	// CASH PLAN LAST DAY
	$key6 = array_search($subDriverID, array_column($orders_arr3, 'SubDriver'));
	if ($key6>-1) $CashPlan = $orders_arr3[$key6]['CashPlan'];			
	else $CashPlan = number_format(0,2);

	// Unapproved CASH EXPENSES
	$key4 = array_search($subDriverID, array_column($expenses_arr2, 'DriverID'));
	if ($key4>-1) $Trosak2 = $expenses_arr2[$key4]['Trosak'];			
	else $Trosak2 = number_format(0,2);

	// Recived CASH 
	$key7 = array_search($subDriverID, array_column($rcash_arr, 'DriverID'));
	if ($key7>-1) $RCash = $rcash_arr[$key7]['Trosak'];			
	else $RCash = number_format(0,2);
	
	// Deposit
	$key8 = array_search($subDriverID, array_column($deposit_arr, 'DriverID'));
	if ($key8>-1) $Deposit = $deposit_arr[$key8]['Trosak'];			
	else $Deposit = number_format(0,2);
	
	$UnapprovedExpenses = $Trosak2;
	$Balance = $Primljeno - $Trosak + $d->Balance + $RCash;			
	$BalanceT = $Balance + $Primljeno2 - $Trosak3;

	if ($BalanceT>0.01) {
		$row["SubDriver"]=$d->AuthUserRealName;
		$row["Active"]= $d->Active;
		$row["Depostit"]=number_format($d->Balance,2);
		$row["Primljeno"]=number_format($Primljeno,2);
		$row["RCash"]=number_format($RCash,2);
		$row["Trosak"]=number_format($Trosak,2);
		$row["Balance"]=number_format($Balance,2);
		$row["CashPlan"]=number_format($CashPlan,2);
		$row["Primljeno2"]=number_format($Primljeno2,2);
		$row["Trosak3"]=number_format($Trosak3,2);
		$row["UnapprovedExpenses"]=number_format($UnapprovedExpenses,2);
		$row["BalanceT"]=number_format($BalanceT,2);
		$sum[]=$row;
	}	
}	
	




 
	


