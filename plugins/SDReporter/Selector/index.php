<?
//$DriverID = '843'; // $_SESSION['DriverID']

//$dateFrom = $_REQUEST['DateFrom'];
//$dateTo = $_REQUEST['DateTo'];
// prethodni ponedjeljak
//$testdate = date("Y-m-d",strtotime('last monday', strtotime('2018-05-01')) );

// dan u tjednu 0=nedjelja 1=ponedjeljak
//echo date('w', strtotime($testdate));
// redni broj dana u godini
//echo date('z', strtotime($testdate)) +1;



//require_once $_SERVER['DOCUMENT_ROOT'] .'/cms/lng/en_text.php';

 
// 23.07. Mandic zatrazio da se datum transfera prikaziva PickupDate (bio SubPickupDate) promjenjeno sve di je SubPickupDate, vrijeme treba ostati SubPickupTime - Promjenio Leo

require_once ROOT . '/db/db.class.php';
if (isset($_REQUEST['user'])) {
	require_once ROOT . '/cms/headerScripts.php';
	require_once ROOT . '/f2/f.php';
}
require_once ROOT . '/db/v4_OrdersMaster.class.php';
//require_once $_SERVER['DOCUMENT_ROOT'] . '/db/v4_OrderDetailsFR.class.php'; //Srdjan zakomentarisao 14.02.2019. Dodao naredni red. Mirandi je pucalo nije mogla da se otvori klasa u 30 redu.
require_once ROOT . '/db/v4_OrderDetails.class.php';
require_once ROOT . '/db/v4_Routes.class.php'; 

$db = new DataBaseMysql();
$om = new v4_OrdersMaster();

//$od = new v4_OrderDetailsFR(); 
$od = new v4_OrderDetails(); 


$ro = new v4_Routes();
$ShowHidden = '0';
if(isset($_REQUEST['ShowHidden'])) $ShowHidden = $_REQUEST['ShowHidden'];

$DriverID = $_SESSION['UseDriverID'];
if($_REQUEST['user'] == 'lyon') $DriverID = '876';
if($_REQUEST['user'] == 'nica') $DriverID = '843';
if($_REQUEST['user'] == 'split') $DriverID = '556';



$Month = $_REQUEST['Month'];
$Year = $_REQUEST['Year'];
$SubDriverID = $_REQUEST['SubDriverID'];
$totalValue = 0;
$totalCashIn = 0;

// podaci o subdriveru
$sd = getUser($SubDriverID);

for ($i=1; $i<= 12; $i++) {
	$month = substr('0'.$i, -2);
	if (isset($_REQUEST['Month']) && $_REQUEST['Month']==$month) $selected="selected";
	else $selected="";
	$months[]='<option value="'.$month.'" '.$selected.'>'.$month.'</option>';
}
$smarty->assign('months',$months);

$year_now=date('Y',time());
for ($i=0; $i<= 5; $i++) {
	$year=$year_now-$i;
	if (isset($_REQUEST['Year']) && $_REQUEST['Year']==$year) $selected="selected";
	else $selected="";	
	$years[]='<option value="'.$year.'" '.$selected.'>'.$year.'</option>';
}
$smarty->assign('years',$years);

$q  = "SELECT AuthUserID, AuthUserRealName FROM v4_AuthUsers ";
$q .= "WHERE DriverID = ".$DriverID." AND Active=1 ORDER BY AuthUserRealName ASC";
$r  = $db->RunQuery($q);

while($driver = $r->fetch_object()) {
	if (isset($_REQUEST['SubDriverID']) && $_REQUEST['SubDriverID']==$driver->AuthUserID) $selected="selected";
	else $selected="";	
	$drivers[]='<option value="'.$driver->AuthUserID.'" '.$selected.'>'.$driver->AuthUserRealName.'</option>';
}
$smarty->assign('drivers',$drivers);



if( isset($_REQUEST['submit']) or isset($_REQUEST['Save']) ) {


    ##########################################################################################
    ## UPIS U TABLICE
    ##########################################################################################

    if(isset($_REQUEST['Save'])) {

        foreach($_REQUEST['DateFrom'] as $key => $value) {
            
                $Description = '';
                $monthNumber = $Month;
                $forDate = $_REQUEST['DateFrom'][$key];
                $startTime = $_REQUEST['startTime_1'][$key];
                $endTime = $_REQUEST['endTime_1'][$key];
                $pauzaStart = $_REQUEST['pauzaStart_1'][$key];
                $pauzaEnd = $_REQUEST['pauzaEnd_1'][$key];
                $ukRedovno = $_REQUEST['ukRedovno_1'][$key];
                $ukPauza = $_REQUEST['ukPauza_1'][$key];
                $ukNoc = $_REQUEST['ukNoc_1'][$key];
                $ukNedjelja = $_REQUEST['ukNedjelja_1'][$key];
                $ukPraznik = $_REQUEST['ukPraznik_1'][$key];
                $ukupno = $_REQUEST['ukupno_1'][$key];
                $weekNumber = $_REQUEST['WeekNumber'][$key];
                $Description = $_REQUEST['Description'][$key];
                $shifts = '1';
               
/*
                if($Description != '') {
                    $startTime = '00:00';
                    $endTime = '00:00';
                    $pauzaStart = '00:00';
                    $pauzaEnd = '00:00';
                    $ukRedovno = '00:00';
                    $ukPauza = '00:00';
                    $ukNoc = '00:00';
                    $ukNedjelja = '00:00';
                    $ukPraznik = '00:00';
                    $ukupno = '00:00';
                }
*/
                $q  = "REPLACE INTO v4_WorkingHours ";
                $q .= "(SubDriverID, forDate, shifts, startTime, endTime, pauzaStart, pauzaEnd, ukRedovno, ukPauza, ukNoc, ukNedjelja, 
                ukPraznik, ukupno, weekNumber, Description, monthNumber, DriverID) ";
                $q .= "VALUES ('" . $SubDriverID."', '" .$forDate ."', '". $shifts ."' , '".$startTime ."', '" .$endTime ."',
                '" .$pauzaStart ."', '" .$pauzaEnd ."', '" .$ukRedovno ."', '" .$ukPauza ."', '" .$ukNoc ."', '" .$ukNedjelja ."',
                '" .$ukPraznik ."', '" .$ukupno ."', '" .$weekNumber . "', '" .$Description . "', '" .$monthNumber. "', '" .$DriverID ."') ";

                $db->RunQuery($q);

                // smjena 2
                $forDate = $_REQUEST['DateFrom'][$key];
                $startTime = $_REQUEST['startTime_2'][$key];
                $endTime = $_REQUEST['endTime_2'][$key];
                $pauzaStart = $_REQUEST['pauzaStart_2'][$key];
                $pauzaEnd = $_REQUEST['pauzaEnd_2'][$key];
                $ukRedovno = $_REQUEST['ukRedovno_2'][$key];
                $ukPauza = $_REQUEST['ukPauza_2'][$key];
                $ukNoc = $_REQUEST['ukNoc_2'][$key];
                $ukNedjelja = $_REQUEST['ukNedjelja_2'][$key];
                $ukPraznik = $_REQUEST['ukPraznik_2'][$key];
                $ukupno = $_REQUEST['ukupno_2'][$key];
                $weekNumber = $_REQUEST['WeekNumber'][$key];
                $shifts = '2';
                

                if($Description != '') {
                    $startTime = '00:00';
                    $endTime = '00:00';
                    $pauzaStart = '00:00';
                    $pauzaEnd = '00:00';
                    $ukRedovno = '00:00';
                    $ukPauza = '00:00';
                    $ukNoc = '00:00';
                    $ukNedjelja = '00:00';
                    $ukPraznik = '00:00';
                    $ukupno = '00:00';
                }
                
               
                $q  = "REPLACE INTO v4_WorkingHours ";
                $q .= "(SubDriverID, forDate, shifts, startTime, endTime, pauzaStart, pauzaEnd, ukRedovno, ukPauza, ukNoc, ukNedjelja, 
                ukPraznik, ukupno, weekNumber, Description, monthNumber, DriverID) ";
                $q .= "VALUES ('" . $SubDriverID."', '" .$forDate ."', '". $shifts ."' , '".$startTime ."', '" .$endTime ."',
                '" .$pauzaStart ."', '" .$pauzaEnd ."', '" .$ukRedovno ."', '" .$ukPauza ."', '" .$ukNoc ."', '" .$ukNedjelja ."',
                '" .$ukPraznik ."', '" .$ukupno ."', '" .$weekNumber . "', '" .$Description . "', '" .$monthNumber. "', '" .$DriverID ."') ";

                $db->RunQuery($q);
                
                
                // WEEK SUMMARY- shifts = 3
                if( in_array($forDate, $_REQUEST['AfterDate']) ) {
                    
                    $key = array_search($forDate, $_REQUEST['AfterDate']);
                    $startTime = '00:00';
                    $endTime = '00:00';
                    $pauzaStart = '00:00';
                    $pauzaEnd = '00:00';
                    $ukRedovno = $_REQUEST['ukRedovno_w'][$key];
                    $ukPauza = $_REQUEST['ukPauza_w'][$key];
                    $ukNoc = $_REQUEST['ukNoc_w'][$key];
                    $ukNedjelja = $_REQUEST['ukNedjelja_w'][$key];
                    $ukPraznik = $_REQUEST['ukPraznik_w'][$key];
                    $ukupno = $_REQUEST['ukupno_w'][$key];
                    $Description = 'Week Summary';
                    $shifts = '3';

                $q  = "REPLACE INTO v4_WorkingHours ";
                $q .= "(SubDriverID, forDate, shifts, startTime, endTime, pauzaStart, pauzaEnd, ukRedovno, ukPauza, ukNoc, ukNedjelja, 
                ukPraznik, ukupno, weekNumber, Description, monthNumber, DriverID) ";
                $q .= "VALUES ('" . $SubDriverID."', '" .$forDate ."', '". $shifts ."' , '".$startTime ."', '" .$endTime ."',
                '" .$pauzaStart ."', '" .$pauzaEnd ."', '" .$ukRedovno ."', '" .$ukPauza ."', '" .$ukNoc ."', '" .$ukNedjelja ."',
                '" .$ukPraznik ."', '" .$ukupno ."', '" .$weekNumber . "', '" .$Description . "', '" .$monthNumber. "', '" .$DriverID ."') ";

                    $db->RunQuery($q);
                    
                }

        } // End of foreach($_REQUEST['DateFrom']
        
        // MONTH SUMMARY - shifts = 4
        $startTime = '00:00';
        $endTime = '00:00';
        $pauzaStart = '00:00';
        $pauzaEnd = '00:00';
        $ukRedovno = $_REQUEST['ukRedovno_M'];
        $ukPauza = $_REQUEST['ukPauza_M'];
        $ukNoc = $_REQUEST['ukNoc_M'];
        $ukNedjelja = $_REQUEST['ukNedjelja_M'];
        $ukPraznik = $_REQUEST['ukPraznik_M'];
        $ukupno = $_REQUEST['ukupno_M'];
        $Description = 'Month Summary';
        $shifts = '4';

        $q  = "REPLACE INTO v4_WorkingHours ";
        $q .= "(SubDriverID, forDate, shifts, startTime, endTime, pauzaStart, pauzaEnd, ukRedovno, ukPauza, ukNoc, ukNedjelja, 
        ukPraznik, ukupno, weekNumber, Description, monthNumber, DriverID) ";
        $q .= "VALUES ('" . $SubDriverID."', '" .$forDate ."', '". $shifts ."' , '".$startTime ."', '" .$endTime ."',
        '" .$pauzaStart ."', '" .$pauzaEnd ."', '" .$ukRedovno ."', '" .$ukPauza ."', '" .$ukNoc ."', '" .$ukNedjelja ."',
        '" .$ukPraznik ."', '" .$ukupno ."', '" .$weekNumber . "', '" .$Description . "', '" .$monthNumber. "', '" .$DriverID ."') ";

        $db->RunQuery($q);        

        // hide or delete unwanted records
        foreach($_REQUEST as $key => $value) {

            $ima = strpos($key, 'Detail_');

            if($ima !== false) {
                $cutString = explode("_",$key);
                $DetailsID = $cutString[1];
                $od->getRow($DetailsID);

                $od->setExpired($value);
                $od->saveRow();
            }
        }
	} // end if save
    ##########################################################################################
    ## KRAJ UPISA U TABLICE
    ##########################################################################################    
    ##########################################################################################
    ## PRIKAZIVANJE PODATAKA
    ########################################################################################## 
    $daysInMonth = days_in_month($Month, $Year);
 
    $where  = "WHERE PickupDate >= '" . $Year.'-'.$Month.'-01' . "' ";
    $where .= "AND PickupDate <= '" . $Year.'-'.$Month.'-'.$daysInMonth . "' ";
    $where .= "AND DriverID = '". $DriverID ."' ";
    $where .= "AND TransferStatus != '3' ";
    $where .= "AND TransferStatus != '9' ";
    $where .= "AND TransferStatus != '4' ";

    $where2= "AND Expired != '1' ";

    if($_REQUEST['SubDriverID'] != 0) {
        $where .= "AND (SubDriver = '" . $_REQUEST['SubDriverID'] . "' ";
        $where .= "OR SubDriver2 = '" . $_REQUEST['SubDriverID'] . "' ";
        $where .= "OR SubDriver3 = '" . $_REQUEST['SubDriverID'] . "') ";
    }

    if($ShowHidden) $odk = $od->getKeysBy("PickupDate", "ASC, PickupTime ASC", $where);
    else $odk = $od->getKeysBy("PickupDate", "ASC, PickupTime ASC", $where.$where2);

    if($ShowHidden) $odk2 = $od->getKeysBy("PickupDate", "ASC, PickupTime ASC",  $where.$where2);
    else $odk2 = array();


    // GLAVNI DIV *********************************************************************************
	// ob_start();

	// Za ukupan broj transfera na dnu stranice 23.07.2018 - zatrazio Mandic - Leo
	$brojTransfera = count($odk);
	$brojSkrivenihTransfera = count($odk2);

    $prijenosIzProslogMjeseca = true;

?>

<!-- SMARTY 1 -->

<?php
  
  $rows = array();
    for($day = 1; $day <= $daysInMonth; $day++) {
        $row = array();

        ob_start();

        $dayTemp = '0'.$day;
        $day = substr($dayTemp, -2);
        // construct date
        $dateFrom = $Year.'-'.$Month.'-'.$day;        

        $dayOfYear = date("z", strtotime($dateFrom)) +1;

        $weekNo = date("W", strtotime($dateFrom));
        $dayOfWeek = date("l", strtotime($dateFrom));

        $where  = "WHERE PickupDate = '" . $dateFrom . "' ";
        $where .= "AND DriverID = '". $DriverID ."' ";
        $where .= "AND TransferStatus != '3' ";
        $where .= "AND TransferStatus != '9' ";
        $where .= "AND TransferStatus != '4' ";

        $where2= "AND Expired != '1' ";

        if($SubDriverID != 0) {
            $where .= "AND (SubDriver = '" . $SubDriverID . "' ";
            $where .= "OR SubDriver2 = '" . $SubDriverID . "' ";
            $where .= "OR SubDriver3 = '" . $SubDriverID . "') ";
        }
        if($ShowHidden)     $odk = $od->getKeysBy("PickupDate", "ASC, SubPickupTime ASC", $where);
        else                $odk = $od->getKeysBy("PickupDate", "ASC, SubPickupTime ASC", $where.$where2);

        if($ShowHidden)     $odk2 = $od->getKeysBy("PickupDate", "ASC, SubPickupTime ASC",  $where.$where2);
        
        $lastDate = '';
// =================================================================================================
// =================================================================================================
// if( count($odk) > 0 ) { // prikazi transfere za $dateFrom
//if(true) {        
            if( count($odk) == 0 )  $slobodanDan = true; 
            foreach( $odk as $nn => $DetailsID ) {
                $od->getRow($DetailsID);
                $om->getRow($od->OrderID);


                if($od->PayNow > 0 and $od->PayLater == 0) $icon = '<i class="fa fa-credit-card xfa-2x"></i>';
                if($od->PayNow == 0 and $od->PayLater > 0) $icon = '<i class="fa fa-money xfa-2x xblue-text"></i>';
                if($od->PayNow == 0 and $od->PayLater == 0 and $od->InvoiceAmount > 0) $icon = '<i class="fa fa-user xfa-2x grey-text"></i>';

                $sd = getUser($od->SubDriver);
                if($od->SubDriver2 != '') $sd2 = getUser($od->SubDriver2);
                if($od->SubDriver3 != '') $sd3 = getUser($od->SubDriver3);
                
                // oznaci izbrisane, tj. skrivene - Expired = 1
                $colorClass = "white";
                if($od->Expired) $colorClass = "pink lighten-5";

                
                $minutes = 0;
        
                if($od->PickupDate == $lastDate) {
                    if($od->PickupDate != NULL and $expectedArrival != NULL and $od->SubPickupTime != NULL) {

                        $start_date = new DateTime($dateFrom . " ". $expectedArrival.":00");
						
						if (strlen($od->SubPickupTime)==5) $since_start = $start_date->diff(new DateTime($dateFrom . " " . $od->SubPickupTime .":00"));                
						else $since_start = $start_date->diff(new DateTime($dateFrom . " " . $od->SubPickupTime));                

		
                        $emptyTimeH = $since_start->days * 24;
                        $emptyTimeH += $since_start->h;
                        $emptyTimeH = substr('00' . $emptyTimeH, -2);
                        
                        $emptyTimeM = substr('00' . $since_start->i, -2);
                        
                        $minutes = $since_start->days * 24 * 60;
                        $minutes += $since_start->h * 60;
                        $minutes += $since_start->i;

                    }
                }
                        				


                $expectedArrival = '';				
                if( !empty($od->RouteID) ) {
                    $ro->getRow($od->RouteID);
                    $minutes_to_add = $ro->Duration + 15;
                    $time = new DateTime($od->PickupDate . ' ' . $od->SubPickupTime);
													                				

																				echo "x";

                    $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
                    $expectedArrival = $time->format('H:i');

                }

                
                $row['colorClass']=$colorClass;
                $row['SubVehicleName'] = getSubVehicleName($od->Car);
                $row['SubVehicleNameTwo'] = getSubVehicleName($od->Car2);
                $row['SubVehicleNameThree'] = getSubVehicleName($od->Car3);
                $row['PickupDate'] = $od->PickupDate;
                $row['SubPickupTime'] = $od->SubPickupTime;
                $row['MOrderKey'] = $om->MOrderKey;
                $row['PaxName'] = $od->PaxName;
                $row['MPaxTel'] = $om->MPaxTel;
                $row['MOrderID'] = $om->MOrderID;
                $row['TNo'] = $od->TNo;
                $row['PickupName'] = $od->PickupName;
                $row['PickupAddress'] = $od->PickupAddress;
                $row['DropName'] = $od->DropName;
                $row['DropAddress'] = $od->DropAddress;
                $row['AuthUserRealName'] = $sd->AuthUserRealName;
                $row['PayLater'] = $od->PayLater;
                $row['PayNow'] = $od->PayNow;
                $row['InvoiceAmount'] = $od->InvoiceAmount;
                $row['SubDriver2'] = $od->SubDriver2;
                $row['AuthUserRealName2'] = $sd2->AuthUserRealName;
                $row['SubDriver3'] = $od->SubDriver3;
                $row['AuthUserRealName3'] = $sd3->AuthUserRealName;
                $row['DetailsID'] = $od->DetailsID;
                $row['Expired'] = $od->Expired;
                $row['SubDriverNote'] = $od->getSubDriverNote();
                $row['dateFrom'] = $dateFrom;
                $row['weekNo'] = $weekNo;
                $row['dayOfYear'] = $dayOfYear;
                $row['Description'] = $Description;
                $row['praznik'] = $praznik;
                $row['nedilja'] = $nedilja;
                $row['startTime_1'] = $startTime_1;
                $row['endTime_1'] = $endTime_1;
                $row['pauzaStart_1'] = $pauzaStart_1;
                $row['pauzaEnd_1'] = $pauzaEnd_1;
                $row['ukRedovno_1'] = $ukRedovno_1;
                $row['ukPauza_1'] = $ukPauza_1;
                $row['ukNoc_1'] = $ukNoc_1;
                $row['ukNedjelja_1'] = $ukNedjelja_1;
                $row['ukPraznik_1'] = $ukPraznik_1;
                $row['ukupno_1'] = $ukupno_1;
                $row['color2'] = $color2;
                $row['color1'] = $color1;
                $row['hideShift2'] = $hideShift2;
                $row['initialDisplay'] = $initialDisplay;
                $row['startTime_2'] = $startTime_2;
                $row['ukRedovno_2'] = $ukRedovno_2;
                $row['ukPauza_2'] = $ukPauza_2;
                $row['ukNoc_2'] = $ukNoc_2;
                $row['ukNedjelja_2'] = $ukNedjelja_2;
                $row['ukPraznik_2'] = $ukPraznik_2;
                $row['ukupno_2'] = $ukupno_2;
                $row['endTime_2'] = $endTime_2;
                $row['pauzaStart_2'] = $pauzaStart_2;
                $row['pauzaEnd_2'] = $pauzaEnd_2;
                $row['ukRedovno'] = $ukRedovno;
                $row['ukPauza'] = $ukPauza;
                $row['ukNoc'] = $ukNoc;
                $row['ukNedjelja'] = $ukNedjelja;
                $row['ukPraznik'] = $ukPraznik;
                $row['ukupno'] = $ukupno;
                $row['slobodanDan'] = $slobodanDan;
                $row['expectedArrival'] = $expectedArrival;
                $row['minutes'] = $minutes;
                $row['emptyTimeH'] = $emptyTimeH;
                $row['emptyTimeM'] = $emptyTimeM;
                $row['odk'] = $odk;
                $row['day'] = $day;
                $row['daysInMonth'] = $daysInMonth;

// SMARTY 2:
                // PODACI O TRANSFERU
            
                $lastDate = $od->PickupDate;  
				$totalValue += $od->getDetailPrice();
				$totalCashIn += $od->PayLater;  
            }// end foreach odk

           

            ###################################################################
            ## KRAJ DANA
            ###################################################################


            // get previous working hours summary
            $q  = "SELECT * FROM v4_WorkingHours  ";
            $q .= "WHERE SubDriverID  = '" . $SubDriverID . "' ";
            $q .= "AND forDate  = '" . $dateFrom . "' ";
            $q .= "AND shifts  = '1' ";
            $q .= "AND DriverID = '" . $DriverID . "' ";

            $r = $db->RunQuery($q);

            if($r->num_rows > 0) {
                $w = $r->fetch_object();
                $startTime_1 = $w->startTime;
                $endTime_1 = $w->endTime;
                $pauzaStart_1 = $w->pauzaStart;
                $pauzaEnd_1 = $w->pauzaEnd;
			    $ukRedovno_1 = $w->ukRedovno;
                $ukPauza_1 = $w->ukPauza;
                $ukNoc_1 = $w->ukNoc;
                $ukNedjelja_1 = $w->ukNedjelja;
                $ukPraznik_1 = $w->ukPraznik;
                $ukupno_1 = $w->ukupno;
                $Description = $w->Description;
            }
            if($startTime_1 == '') $startTime_1 = "00:00";
            if($endTime_1 == '') $endTime_1 = "00:00";
            if($pauzaStart_1 == '') $pauzaStart_1 = "00:00";
            if($pauzaEnd_1 == '') $pauzaEnd_1 = "00:00";
            if($ukRedovno_1 == '') $ukRedovno_1 = "00:00";
            if($ukPauza_1 == '') $ukPauza_1 = "00:00";
            if($ukNoc_1 == '') $ukNoc_1 = "00:00";
            if($ukNedjelja_1 == '') $ukNedjelja_1 = "00:00";
            if($ukPraznik_1 == '') $ukPraznik_1 = "00:00";
            if($ukupno_1 == '') $ukupno_1 = "00:00";
            
            if($Description == '') $Description = "Jour de congé";
            
              
            
           ?>
<!-- SMARTY 3: -->
<!-- SLOBODAN DAN -->
            <?

            // get previous working hours summary
            $q  = "SELECT * FROM v4_WorkingHours  ";
            $q .= "WHERE SubDriverID  = '" . $SubDriverID . "' ";
            $q .= "AND forDate  = '" . $dateFrom . "' ";
            $q .= "AND shifts  = '2' ";
            $q .= "AND DriverID = '" . $DriverID . "' ";

            $r = $db->RunQuery($q);

            if($r->num_rows > 0) {
                $w = $r->fetch_object();
                $startTime_2 = $w->startTime;
                $endTime_2 = $w->endTime;
                $pauzaStart_2 = $w->pauzaStart;
                $pauzaEnd_2 = $w->pauzaEnd;
			    $ukRedovno_2 = $w->ukRedovno;
	            $ukPauza_2 = $w->ukPauza;
	            $ukNoc_2 = $w->ukNoc;
	            $ukNedjelja_2 = $w->ukNedjelja;
	            $ukPraznik_2 = $w->ukPraznik;
	            $ukupno_2 = $w->ukupno;
            }
            if($startTime_2 == '') $startTime_2 = "00:00";
            if($endTime_2 == '') $endTime_2 = "00:00";
            if($pauzaStart_2 == '') $pauzaStart_2 = "00:00";
            if($pauzaEnd_2 == '') $pauzaEnd_2 = "00:00";
            if($ukRedovno_2 == '') $ukRedovno_2 = "00:00";
            if($ukPauza_2 == '') $ukPauza_2 = "00:00";
            if($ukNoc_2 == '') $ukNoc_2 = "00:00";
            if($ukNedjelja_2 == '') $ukNedjelja_2 = "00:00";
            if($ukPraznik_2 == '') $ukPraznik_2 = "00:00";
            if($ukupno_2 == '' or $ukupno_2 == '0:00') $ukupno_2 = "00:00";
            
            //if($slobodanDan) $hideShift2 = 'hidden'; else $hideShift2 = '';
            if($ukupno_2 == '00:00') $initialDisplay = 'style="display:none"'; else $initialDisplay = '';
        
            ?>
            
<!-- SMARTY 4 -->
        <?
		
//  ==================================================================================================================
// } // End of ifcount($odk) > 0 =================================================================================
//else { 
      ?>  
            
            
<!-- SMARTY 5: -->
                   
        <?
//} // End of else
// ===========================================================================
        ###################################################################
        ## KRAJ TJEDNA
        ###################################################################
        if(date('w', strtotime($dateFrom)) == '0' or  $day == $daysInMonth) {
        
            // get previous working hours summary
            $q  = "SELECT * FROM v4_WorkingHours  ";
            $q .= "WHERE SubDriverID  = '" . $SubDriverID . "' ";
            $q .= "AND monthNumber  = '" . $Month . "' ";
            $q .= "AND weekNumber  = '" . $weekNo . "' ";
            $q .= "AND shifts  = '3' ";
            $q .= "AND DriverID = '" . $DriverID . "' ";

            $r = $db->RunQuery($q);

            if($r->num_rows > 0) {
                $w = $r->fetch_object();
                $ukRedovno = $w->ukRedovno;
                $ukPauza = $w->ukPauza;
                $ukNoc = $w->ukNoc;
                $ukNedjelja = $w->ukNedjelja;
                $ukPraznik = $w->ukPraznik;
                $ukupno = $w->ukupno;
            }          
            if($ukRedovno == '') $ukRedovno = "00:00";
            if($ukPauza == '') $ukPauza = "00:00";
            if($ukNoc == '') $ukNoc = "00:00";
            if($ukNedjelja == '') $ukNedjelja = "00:00";
            if($ukPraznik == '') $ukPraznik = "00:00";
            if($ukupno == '') $ukupno = "00:00";       
        
            
        
        ?>

<!-- SMARTY 6: -->
        
        <?

        } // end if Sunday

        $row['content'] = ob_get_contents();
	    ob_end_clean();

        $row['dayToLang'] = dayToLang(date('l', strtotime($dateFrom)));

        $rows[] = $row;

    } // end for $day
    // Test:
    // echo"<pre>";
    // print_r($rows);
    // echo"</pre>";
    
    
    ###################################################################
    ## KRAJ MJESECA
    ###################################################################
    
    // get previous working hours summary
    $q  = "SELECT * FROM v4_WorkingHours  ";
    $q .= "WHERE SubDriverID  = '" . $SubDriverID . "' ";
    $q .= "AND monthNumber  = '" . $Month . "' ";
    $q .= "AND shifts  = '4' ";
    $q .= "AND DriverID = '" . $DriverID . "' ";

    $r = $db->RunQuery($q);

    if($r->num_rows > 0) {
        $w = $r->fetch_object();
        $ukRedovno = $w->ukRedovno;
        $ukPauza = $w->ukPauza;
        $ukNoc = $w->ukNoc;
        $ukNedjelja = $w->ukNedjelja;
        $ukPraznik = $w->ukPraznik;
        $ukupno = $w->ukupno;
    }      

    if($ukRedovno == '') $ukRedovno = "00:00";
    if($ukPauza == '') $ukPauza = "00:00";
    if($ukNoc == '') $ukNoc = "00:00";
    if($ukNedjelja == '') $ukNedjelja = "00:00";
    if($ukPraznik == '') $ukPraznik = "00:00";
    if($ukupno == '') $ukupno = "00:00";


    
    ?>
<!-- SMARTY 7: -->

	<?php
	// $out2 = ob_get_contents();
	// ob_end_clean();

    } // End of isset($_REQUEST['submit']) or isset($_REQUEST['Save'])

    $smarty->assign('rows',$rows);
    $smarty->assign('Year',$Year);
    $smarty->assign('Month',$Month);
    $smarty->assign('day',$day);    
    $smarty->assign('daysInMonth',$daysInMonth);
    $smarty->assign('ShowHidden',$ShowHidden);
    $smarty->assign('odk2',$odk2);
    $smarty->assign('odk',$odk);
    $smarty->assign('SubDriverID',$SubDriverID);
	$smarty->assign('show_data',$out2);
	$smarty->assign('ukRedovno',$ukRedovno);
	$smarty->assign('ukPauza',$ukPauza);
	$smarty->assign('ukNoc',$ukNoc);
	$smarty->assign('ukNedjelja',$ukNedjelja);
	$smarty->assign('ukPraznik',$ukPraznik);
	$smarty->assign('ukupno',$ukupno);
	$smarty->assign('brojSkrivenihTransfera',$brojSkrivenihTransfera);
	$smarty->assign('brojTransfera',$brojTransfera);
	$smarty->assign('icon',$icon);
	$smarty->assign('totalValue',$totalValue);
	$smarty->assign('totalCashIn',$totalCashIn);
	$smarty->assign('ukupno_2',$ukupno_2);
	$smarty->assign('ukRedovno',$ukRedovno);

?>


<script>
    $(".timepicker").JAMTimepicker();
    //$(".timepicker").pickatime({format: 'HH:i', interval: 10});

    function toggleCheck(inputFld) {
        var checked = $("#Detail_"+inputFld).prop("checked");
        if(checked == true) $("#Det_" + inputFld).val('1');
        else $("#Det_" + inputFld).val('0');
    }


    // output fld = changeFld+id
    
    function timeDifference(id, startFld, endFld, changeFld, week) {
        var startTime = $("#"+startFld+id).val();
        var endTime = $("#"+endFld+id).val();
     
        
        var nedjelja = $("#Nedjelja"+id).val();
        var praznik = $("#Praznik"+id).val();

        var satiNedjelja = '00:00';
        var satiPraznik = '00:00';
        
        var dayStart = '06:00';       
        var dayEnd   = '21:00';
        var noc = '00:00';
        
        var redovno = '00:00';
        

        if(changeFld == 'ukRedovno_') {
	        //slucajevi: 
		    //			--------POCETAK U NOCNIM SATIMA----------------

		    //			pocetak od 00:00-06:00 a kraj u dnevnim satima ok
		    if(startTime >= '00:00' && startTime < dayStart && endTime <= dayEnd && endTime >= dayStart) {
		        noc = timeDiff(dayStart, startTime);
		        //alert('pocetak od 00:00-06:00 a kraj u dnevnim satima ' + noc);
		    }
		    
		    
		    //			pocetak od 21:00-00:00 a kraj u dnevnim satima - javi ERROR
		    if(startTime >= dayEnd && startTime < '23:59' && endTime <= dayEnd && endTime >= dayStart) {
		        ////alert('pocetak od 21:00-00:00 a kraj u dnevnim satima');
		    }
		    
		    //			--------KRAJ U NOCNIM SATIMA-------------------
		    //			pocetak u dnevnim a kraj od 21:00-00:00 ok
		    if(startTime >= dayStart && startTime < dayEnd && endTime > dayEnd && endTime <= '23:59') {
		        noc = timeDiff(endTime, dayEnd);
		        //alert('pocetak u dnevnim a kraj od 21:00-00:00 '+noc);
		    }

		    //			pocetak u dnevnima a kraj od 00:00-06:00 - ERROR
		    if(startTime >= dayStart && startTime <= dayEnd && endTime <= dayStart && endTime > '00:00') {
		        ////alert('pocetak u dnevnima a kraj od 00:00-06:00');
		    }

		    //			--------POCETAK I KRAJ U NOCNIM SATIMA---------

		    //			pocetak od 00:00-06:00 a kraj od 21:00 do 00:00 ok
		    if(startTime >= '00:00' && startTime < dayStart && endTime > dayEnd && endTime <= '23:59') {
		        var noc1 = timeDiff(dayStart, startTime);
		        var noc2 = timeDiff(endTime, dayEnd);
		        noc = timeAdd(noc1, noc2);
		        
		        //alert('pocetak od 00:00-06:00 a kraj od 21:00 do 00:00 '+ noc);
		    }

		    //			pocetak od 00:00-06:00 a kraj od 00:00 do 06:00 ok
		    if(startTime >= '00:00' && startTime < dayStart && endTime > '00:00' && endTime <= dayStart) {
		        noc = timeDiff(endTime, startTime);

		        //alert('pocetak od 00:00-06:00 a kraj od 00:00 do 06:00 ' + noc);
		    }

		    //			pocetak od 21:00-00:00 a kraj od 21:00 do 00:00 ok
		    if(startTime >= dayEnd && startTime < '23:59' && endTime > dayEnd && endTime <= '23:59') {
		        noc = timeDiff(endTime, startTime);
		        //alert('pocetak od 21:00-00:00 a kraj od 21:00 do 00:00 ' + noc);
		    }

		    //			pocetak od 21:00-00:00 a kraj od 00:00 do 06:00 -ERROR
		    if(startTime >= dayEnd && startTime < '23:59' && endTime > '00:00' && endTime <= dayStart) {
		        ////alert('pocetak od 21:00-00:00 a kraj od 00:00 do 06:00');
		    }

            redovno = timeDiff(endTime, startTime); 
            // NEDJELJA
            if(nedjelja == '1') {
                satiNedjelja = redovno;
                redovno = '00:00';
                $("#ukNedjelja_"+id).val(satiNedjelja);      
            }

            // PRAZNIK
            if(praznik == '1') {
                satiPraznik = redovno;
                redovno = '00:00';
                $("#ukPraznik_"+id).val(satiPraznik);      
            }


            // ako nije nedjelja ili praznik upisuje se noc. inace NE
            if(nedjelja == 0 && praznik == 0) {
                // NOC
                $("#ukNoc_"+id).val(noc);
                var razlika = timeDiff(startTime, endTime);
                redovno = timeDiff(razlika, noc);            
            }

            $("#ukRedovno_"+id).val(redovno);

        } else { // sva ostala polja
            var razlika = timeDiff(startTime, endTime);
            $("#"+changeFld+id).val(razlika);        
        }

        timeTotal(id, week);
    }
    


    function timeDiff(startTime, endTime) {

        var startDate = new Date("January 1, 1970 " + startTime);
        var endDate = new Date("January 1, 1970 " + endTime);
        var timeDiff = Math.abs(startDate - endDate);

        var hh = Math.floor(timeDiff / 1000 / 60 / 60);
        if(hh < 10) {
            hh = '0' + hh;
        }
        timeDiff -= hh * 1000 * 60 * 60;
        var mm = Math.floor(timeDiff / 1000 / 60);
        if(mm < 10) {
            mm = '0' + mm;
        }
        timeDiff -= mm * 1000 * 60;
        var ss = Math.floor(timeDiff / 1000);
        if(ss < 10) {
            ss = '0' + ss;
        }
        return hh + ":" + mm;
        
    }



    function timeAdd(time1, time2) {
        var splitTime1= time1.split(':');
        var splitTime2= time2.split(':');


        hour = parseInt(splitTime1[0])+parseInt(splitTime2[0]);
        minute = parseInt(splitTime1[1])+parseInt(splitTime2[1]);
        hour = hour + minute/60;

        hour = Math.abs(hour);
        minute = Math.abs(minute);

        return parseInt(hour).pad(2) + ":" + parseInt(minute).pad(2) ;    
    }



    function timeTotal(id, week) {

        
        var redovno     = $("#ukRedovno_"+id).val();
        var pauza       = $("#ukPauza_"+id).val();
        var nedjelja    = $("#ukNedjelja_"+id).val();
        var noc         = $("#ukNoc_"+id).val();
        var praznik     = $("#ukPraznik_"+id).val();

        var hour=0;
        var minute=0;
        var second=0;

        /* ovo mozda i radi!!! maknuto radi sumnje da djeluje na krivo racunanje sati
            TODO: testirati pa eventualno vratiti
            
        if(redovno == '') redovno = '00:00';
        if(pauza == '') pauza = '00:00';
        if(noc == '') noc = '00:00';
        if(nedjelja == '') nedjelja = '00:00';
        if(praznik == '') praznik = '00:00';
        */
        var splitTime1= redovno.split(':');
        var splitTime2= pauza.split(':');
        var splitTime3= nedjelja.split(':');
        var splitTime4= noc.split(':');
        var splitTime5= praznik.split(':');


        hour = parseInt(splitTime1[0])-parseInt(splitTime2[0])+parseInt(splitTime3[0])+parseInt(splitTime4[0])+parseInt(splitTime5[0]);
        minute = parseInt(splitTime1[1])-parseInt(splitTime2[1])+parseInt(splitTime3[1])+parseInt(splitTime4[1])+parseInt(splitTime5[1]);
        hour = hour + Math.floor(minute/60);
        if(minute < 0) {
            minute += 60; 
        }
        minute = Math.abs(minute%60);

        $("#ukupno_"+id).val( parseInt(hour) + ":" + parseInt(minute).pad(2) );


        
        // Ukupno redovno
        var ukupnoRedovnoTjedan = '00:00';
        $('.ukRedovno'+week).each(function(index, item) {
            var itemTime = $(item).val();    
            if(itemTime == '') itemTime = '00:00';
            
            ukupnoRedovnoTjedan = timeCalc(ukupnoRedovnoTjedan, itemTime );

        });
        $("#ukRedovno_w"+week).val(ukupnoRedovnoTjedan);

        var ukupnoRedovnoMjesec = '00:00';
        $('.ukRedovno_w').each(function(index, item) {
            var itemTime = $(item).val();    
            if(itemTime == '') itemTime = '00:00';
            ukupnoRedovnoMjesec = timeCalc(ukupnoRedovnoMjesec, itemTime );
        });
        $("#ukRedovno_M").val(ukupnoRedovnoMjesec);


		//Ukupno pauza
		var ukupnoPauzaTjedan = '00:00';
        $('.ukPauza'+week).each(function(index, item) {
            var itemTime = $(item).val();    
            if(itemTime == '') itemTime = '00:00';
            ukupnoPauzaTjedan = timeCalc(ukupnoPauzaTjedan, itemTime );
        });
        $("#ukPauza_w"+week).val(ukupnoPauzaTjedan);

        var ukupnoPauzaMjesec = '00:00';
        $('.ukPauza_w').each(function(index, item) {
            var itemTime = $(item).val();    
            if(itemTime == '') itemTime = '00:00';
            ukupnoPauzaMjesec = timeCalc(ukupnoPauzaMjesec, itemTime );
        });
        $("#ukPauza_M").val(ukupnoPauzaMjesec);

		//Ukupno noc
		var ukupnoNocTjedan = '00:00';
        $('.ukNoc'+week).each(function(index, item) {
            var itemTime = $(item).val();    
            if(itemTime == '') itemTime = '00:00';
            ukupnoNocTjedan = timeCalc(ukupnoNocTjedan, itemTime );
        });
        $("#ukNoc_w"+week).val(ukupnoNocTjedan);

        var ukupnoNocMjesec = '00:00';
        $('.ukNoc_w').each(function(index, item) {
            var itemTime = $(item).val();    
            if(itemTime == '') itemTime = '00:00';
            ukupnoNocMjesec = timeCalc(ukupnoNocMjesec, itemTime );
        });
        $("#ukNoc_M").val(ukupnoNocMjesec);


		//Ukupno nedjelja
		var ukupnoNedjeljaTjedan = '00:00';
        $('.ukNedjelja'+week).each(function(index, item) {
            var itemTime = $(item).val();    
            if(itemTime == '') itemTime = '00:00';
            ukupnoNedjeljaTjedan = timeCalc(ukupnoNedjeljaTjedan, itemTime );
        });
        $("#ukNedjelja_w"+week).val(ukupnoNedjeljaTjedan);

        var ukupnoNedjeljaMjesec = '00:00';
        $('.ukNedjelja_w').each(function(index, item) {
            var itemTime = $(item).val();    
            if(itemTime == '') itemTime = '00:00';
            ukupnoNedjeljaMjesec = timeCalc(ukupnoNedjeljaMjesec, itemTime );
        });
        $("#ukNedjelja_M").val(ukupnoNedjeljaMjesec);


		//Ukupno praznik
		var ukupnoPraznikTjedan = '00:00';
        $('.ukPraznik'+week).each(function(index, item) {
            var itemTime = $(item).val();    
            if(itemTime == '') itemTime = '00:00';
            ukupnoPraznikTjedan = timeCalc(ukupnoPraznikTjedan, itemTime );
        });
        $("#ukPraznik_w"+week).val(ukupnoPraznikTjedan);

        var ukupnoPraznikMjesec = '00:00';
        $('.ukPraznik_w').each(function(index, item) {
            var itemTime = $(item).val();    
            if(itemTime == '') itemTime = '00:00';
            ukupnoPraznikMjesec = timeCalc(ukupnoPraznikMjesec, itemTime );
        });
        $("#ukPraznik_M").val(ukupnoPraznikMjesec);


		//Ukupno
		var ukupnoTjedan = '00:00';
        $('.ukupnoDan'+week).each(function(index, item) {
            var itemTime = $(item).val();    
            if(itemTime == '') itemTime = '00:00';
            ukupnoTjedan = timeCalc(ukupnoTjedan, itemTime );
        });
        $("#ukupno_w"+week).val(ukupnoTjedan);

        var ukupnoMjesec = '00:00';
        $('.ukupno_w').each(function(index, item) {
            var itemTime = $(item).val();    
            if(itemTime == '') itemTime = '00:00';
            ukupnoMjesec = timeCalc(ukupnoMjesec, itemTime );
        });
        $("#ukupno_M").val(ukupnoMjesec);


    }


    function timeCalc(time1, time2) {
        var hour=0;
        var minute=0;
        var second=0;



        var splitTime1= time1.split(':');
        var splitTime2= time2.split(':');



        hour = parseInt(splitTime1[0])+parseInt(splitTime2[0]);
        minute = parseInt(splitTime1[1])+parseInt(splitTime2[1]);
        hour = hour + Math.floor(minute/60);

        hour = Math.abs(hour);
        minute = Math.abs(minute%60);

        return parseInt(hour).pad(2) + ":" + parseInt(minute).pad(2);
    }


    // hours and minutes padding with zeroes
    Number.prototype.pad = function(size) {
      var s = String(this);
      while (s.length < (size || 2)) {s = "0" + s;}
      return s;
    }
    
    
<?
    // kreiranje poziva funkcija za recalc nakon ucitavanja skripte


    $daysInMonth = days_in_month($Month, $Year);


    for($day = 1; $day <= $daysInMonth; $day++) {
        
        $dayTemp = '0'.$day;
        $day = substr($dayTemp, -2);
        
        // construct date
        $dateFrom = $Year.'-'.$Month.'-'.$day;        

        $dayOfYear = date("z", strtotime($dateFrom)) +1;

        $weekNo = date("W", strtotime($dateFrom));
        $dayOfWeek = date("l", strtotime($dateFrom));

        // ovo ispod su javascript funkcije koje ce se izvrsiti svaki put kad se stranica ucita!!!
?>

       timeDifference('1_<?=$dayOfYear?>', 'startTime_', 'endTime_', 'ukRedovno_','<?=$weekNo?>');
       timeDifference('2_<?=$dayOfYear?>', 'startTime_', 'endTime_', 'ukRedovno_','<?=$weekNo?>');

        timeDifference('1_<?=$dayOfYear?>', 'pauzaStart_', 'pauzaEnd_', 'ukPauza_','<?=$weekNo?>');
        timeDifference('2_<?=$dayOfYear?>', 'pauzaStart_', 'pauzaEnd_', 'ukPauza_','<?=$weekNo?>');
<?
    }

?>
    
    
    
</script>


</div>

<?
function dayToLang($day) {
    $daysFR = array(
        'Sunday' => 'Dimanche',
        'Monday' => 'Lundi',
        'Tuesday' => 'Mardi',
        'Wednesday' => 'Mercredi',
        'Thursday' => 'Jeudi',
        'Friday' => 'Vendredi',
        'Saturday' => 'Samedi'
    );
    
    return $daysFR[$day];
}


function prazniciFR($date) {
    $prazniciFR = array(
        '2018-01-01',
        '2018-04-02',
        '2018-05-01',
        '2018-05-08',
        '2018-05-10',
        '2018-05-21',
        '2018-07-14',
        '2018-08-15',
        '2018-11-01',
        '2018-11-11',
        '2018-12-25'
    );
    
    if( in_array($date, $prazniciFR)) return true;
    else return false;
}

