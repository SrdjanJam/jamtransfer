<?
	require_once ROOT . '/db/v4_OrderDetails.class.php';
	require_once ROOT . '/db/v4_AuthUsers.class.php';
	$od = new v4_OrderDetails();
	$au = new v4_AuthUsers();

	$q  = "SELECT * FROM v4_AuthUsers ";
	$q .= "WHERE DriverID = ".$_SESSION['UseDriverID']. " ";
	$q .= " AND Active=1 ";
	$q .= " ORDER BY AuthUserRealName ASC";
	
    $w = $db->RunQuery($q);


	//ispis headera
	$today=date("Y-m-d");
    $smarty->assign('today',$today);

	// CASH-IN Ostalo od boge subdriver1-2-3 treba vuci samo sub1, jer prvi vozac naplacuje transfer
	$q1  = "SELECT SubDriver, SUM(CashIn) AS Primljeno FROM v4_OrderDetails ";
	$q1 .= "WHERE PickupDate >= '2018-08-01' AND PickupDate < '".$today."'";	
	$q1 .= " GROUP BY SubDriver ";			
	$w1 = $db->RunQuery($q1);
	$orders_arr=array();
	while($od = $w1->fetch_object()) {
		$o_arr=array();
		$o_arr['SubDriver']=$od->SubDriver;
		$o_arr['Primljeno']=$od->Primljeno;
		$orders_arr[]=$o_arr;
	}
	// CASH-IN for today
	$q4  = "SELECT SubDriver, SUM(CashIn) AS Primljeno FROM v4_OrderDetails ";
	$q4 .= "WHERE PickupDate = '".$today."'";	
	$q4 .= " GROUP BY SubDriver ";		

	$w4 = $db->RunQuery($q4);
	$orders_arr2=array();
	while($od2 = $w4->fetch_object()) {
		$o_arr2=array();
		$o_arr2['SubDriver']=$od2->SubDriver;
		$o_arr2['Primljeno']=$od2->Primljeno;
		$orders_arr2[]=$o_arr2;
	}
	// CASH PLAN for today
	$q6  = "SELECT SubDriver, SUM(PayLater) AS CashPlan FROM v4_OrderDetails ";
	$q6 .= "WHERE PickupDate = '".$today."'";	
	$q6 .= " GROUP BY SubDriver ";			
	$w6 = $db->RunQuery($q6);
	$orders_arr3=array();
	while($od3 = $w6->fetch_object()) {
		$o_arr3=array();
		$o_arr3['SubDriver']=$od3->SubDriver;
		$o_arr3['CashPlan']=$od3->CashPlan;
		$orders_arr3[]=$o_arr3;
	}	
	
	// CASH EXPENSES
	$q2  = "SELECT DriverID, SUM(Amount) AS Trosak FROM v4_SubExpenses WHERE Card = 0 ";
	$q2 .= "AND Datum >= '2018-08-01' AND Datum < '".$today."' AND Approved=1";	
	$q2 .= " GROUP BY DriverID ";			
	
	$w2 = $db->RunQuery($q2);
	$expenses_arr=array();
	while($ex = $w2->fetch_object()) {
		$ex_arr=array();
		$ex_arr['DriverID']=$ex->DriverID;
		$ex_arr['Trosak']=$ex->Trosak;
		$expenses_arr[]=$ex_arr;
	}

	// CASH EXPENSES TODAY
	$q5  = "SELECT DriverID, SUM(Amount) AS Trosak FROM v4_SubExpenses WHERE Card = 0 ";
	$q5 .= "AND Datum = '".$today."' AND Approved=1";	
	$q5 .= " GROUP BY DriverID ";			
	
	$w5 = $db->RunQuery($q5);
	$expenses_arr3=array();
	while($ex3 = $w5->fetch_object()) {
		$ex_arr3=array();
		$ex_arr3['DriverID']=$ex3->DriverID;
		$ex_arr3['Trosak']=$ex3->Trosak;
		$expenses_arr3[]=$ex_arr3;
	}
	
	// Unapproved CASH EXPENSES
	$q3  = "SELECT DriverID, SUM(Amount) AS Trosak FROM v4_SubExpenses WHERE Card = 0 AND Approved = 0 ";
	$q3 .= "AND Datum >= '2018-08-01'"; 
	$q3 .= " GROUP BY DriverID ";			
	
	$w3 = $db->RunQuery($q3);
	$expenses_arr2=array();
	while($ex2 = $w3->fetch_object()) {
		$ex_arr2=array();
		$ex_arr2['DriverID']=$ex2->DriverID;
		$ex_arr2['Trosak']=$ex2->Trosak;
		$expenses_arr2[]=$ex_arr2;
	}
	
	// Recived CASH 
	$q7  = "SELECT v4_Actions.ReciverID AS RID, SUM(Amount) AS Trosak FROM v4_SubExpenses,v4_Actions WHERE v4_SubExpenses.Expense=v4_Actions.ID and v4_Actions.ReciverID>0 ";
	$q7 .= "AND Datum >= '2018-08-01'"; 
	$q7 .= "AND Approved =1 "; 
	$q7 .= " GROUP BY v4_Actions.ReciverID ";			
	
	$w7 = $db->RunQuery($q7);
	while($ex7 = $w7->fetch_object()) {
		$rc_arr=array();
		$rc_arr['DriverID']=$ex7->RID;
		$rc_arr['Trosak']=$ex7->Trosak;
		$rcash_arr[]=$rc_arr;
	}
	
	// POLOG
	$q8  = "SELECT DriverID, SUM(Amount) AS Trosak FROM v4_SubExpenses WHERE Expense=8 ";
	$q8 .= "AND Datum >= '2018-08-01'"; 
	$q8 .= " GROUP BY DriverID ";			
	
	$w8 = $db->RunQuery($q8);
	$deposit_arr=array();
	while($ex8 = $w8->fetch_object()) {
		$plg=array();
		$plg['DriverID']=$ex8->DriverID;
		$plg['Trosak']=$ex8->Trosak;
		$deposit_arr[]=$plg;
	}	
	

	$orders=array();
    while($d = $w->fetch_object()) { //ispis reporta ako je pocetno stanje vece od nule $d->Balance
		$orders_row=array();
		$orders_row['AuthUserID']=$d->AuthUserID;		
		$orders_row['AuthUserRealName']=$d->AuthUserRealName;		
		$orders_row['Deposit']=$d->Balance;		
		$subDriverID = $d->AuthUserID;
		//DOHVACANJE IZNOSA
		$key = array_search($subDriverID, array_column($orders_arr, 'SubDriver'));
		if ($key>-1) $Primljeno = $orders_arr[$key]['Primljeno'];			
		else $Primljeno = 0;
		$orders_row['Primljeno']=$Primljeno;

		$key2 = array_search($subDriverID, array_column($orders_arr2, 'SubDriver'));
		if ($key2>-1) $Primljeno2 = $orders_arr2[$key2]['Primljeno'];			
		else $Primljeno2 = 0;
		$orders_row['Primljeno2']=$Primljeno2;

		// CASH EXPENSES
		$key3 = array_search($subDriverID, array_column($expenses_arr, 'DriverID'));
		if ($key3>-1) $Trosak = $expenses_arr[$key3]['Trosak'];			
		else $Trosak = 0;
		$orders_row['Trosak']=$Trosak;
		
		// CASH EXPENSES TODAY
		$key5 = array_search($subDriverID, array_column($expenses_arr3, 'DriverID'));
		if ($key5>-1) $Trosak3 = $expenses_arr3[$key5]['Trosak'];			
		else $Trosak3 = 0;
		$orders_row['Trosak3']=$Trosak3;
		
		// CASH PLAN TODAY
		$key6 = array_search($subDriverID, array_column($orders_arr3, 'SubDriver'));
		if ($key6>-1) $CashPlan = $orders_arr3[$key6]['CashPlan'];			
		else $CashPlan = 0;
		$orders_row['CashPlan']=$CashPlan;

		// Unapproved CASH EXPENSES
		$key4 = array_search($subDriverID, array_column($expenses_arr2, 'DriverID'));
		if ($key4>-1) $Trosak2 = $expenses_arr2[$key4]['Trosak'];			
		else $Trosak2 = 0;
		$orders_row['Trosak2']=$Trosak2;

		// Recived CASH 
		$key7 = array_search($subDriverID, array_column($rcash_arr, 'DriverID'));
		if ($key7>-1) $RCash = $rcash_arr[$key7]['Trosak'];			
		else $RCash = 0;
		$orders_row['RCash']=$RCash;

		$Balance = $Primljeno - $Trosak + $d->Balance + $RCash;			
		$orders_row['BalanceT']=number_format(($Balance + $Primljeno2 - $Trosak3),2);

		if(($orders_row['BalanceT'] != 0 && !isset($_POST['all'])) || isset($_POST['all'])) $orders[]=$orders_row;
	}
	$smarty->assign('orders',$orders);

		









