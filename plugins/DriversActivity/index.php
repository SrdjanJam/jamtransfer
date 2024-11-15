<?
	require_once ROOT . '/db/v4_AuthUsers.class.php';
	require_once ROOT . '/db/v4_OrderDetails.class.php';
	require_once ROOT . '/db/v4_SubVehicles.class.php';

	$au = new v4_AuthUsers();
	$od = new v4_OrderDetails();
	$sv = new v4_SubVehicles();

	$where=" WHERE AuthLevelID=32 AND DriverID in (843,876,556)";
	$auk=$au->getKeysBy("AuthUserID","",$where);
	$jamdrivers=implode($auk,",");

	$drivers_all=array();
	$arr1 = array();
	$arr2 = array();
	$arr3 = array();
	$arr4 = array();
	$arr5 = array();

	$q1 = "SELECT `OwnerID`,count(*) as cnt FROM `v4_SubVehicles` WHERE `Active`=1 group by `OwnerID`";
	$q2 = "SELECT `DriverID`,count(*) as cnt FROM `v4_AuthUsers` WHERE `DriverID`>0 and `AuthLevelID`=32 and `Active`=1 group by `DriverID`";
	$q3 = "SELECT `OwnerID`,count(*) as cnt FROM `v4_SubVehicles` WHERE `Active`=1 and `AssignSDID`>0 group by `OwnerID`";
	$q4 = "SELECT `DriverID`, count(*) as cnt FROM `v4_OrderDetails` WHERE `OrderDate`>(CURDATE()- INTERVAL 2 MONTH) AND `TransferStatus` not in (3,6,9) AND `DriverConfStatus`>2 and `SubDriver`>0 and `SubDriver` not in (".$jamdrivers.") group by `DriverID`";
	$q5 = "SELECT `DriverID`, count(*) as cnt FROM `v4_OrderDetails` WHERE `PickupDate`>CURDATE() AND `TransferStatus` not in (3,6,9) AND `DriverConfStatus`>1 group by `DriverID`";
	$r1 = $db->RunQuery($q1);	
	$r2 = $db->RunQuery($q2);	
	$r3 = $db->RunQuery($q3);	
	$r4 = $db->RunQuery($q4);	
	$r5 = $db->RunQuery($q5);	
	while ($d = $r1->fetch_object()) {
		$arr1[$d->OwnerID]=$d->cnt;
		$drivers_all[]=$d->OwnerID;
	}	
	while ($d = $r2->fetch_object()) {
		$arr2[$d->DriverID]=$d->cnt;
		$drivers_all[]=$d->DriverID;
	}	
	while ($d = $r3->fetch_object()) {
		$arr3[$d->OwnerID]=$d->cnt;
		$drivers_all[]=$d->OwnerID;
	}	
	while ($d = $r4->fetch_object()) {
		$arr4[$d->DriverID]=$d->cnt;
		$drivers_all[]=$d->DriverID;
	}		
	while ($d = $r5->fetch_object()) {
		$arr5[$d->DriverID]=$d->cnt;
		$drivers_all[]=$d->DriverID;
	}	
	$drivers = array_unique($drivers_all);
	unset($drivers[0]);
	foreach ($drivers as $driver) {
		if (!in_array($driver,array(556,843,876))) {
			$row=array();
			$row['DriverID']="<a target='_blank' href='satAsDriver/".$driver."'>".$driver."</a>";
			$au->getRow($driver);
			$row['DriverName']=$au->getAuthUserRealName();
			$row['Email']=$au->getAuthUserMail();
			$userCode=md5($au->getAuthUserPass());
			$row['Link']=ROOT_HOME."codeLogin.php?userCode=".$userCode."&userID=".$au->getAuthUserID();
			$sort=0;
			if (array_key_exists($driver, $arr1)) {
				$row['Vehicles']=$arr1[$driver];
				$Vehicles++;
				$sort+=10;
			}	
			else $row['Vehicles']="";		
			if (array_key_exists($driver, $arr2)) {		
				$row['SubDrivers']=$arr2[$driver];
				$SubDrivers++;
				$sort+=100;
			}				
			else $row['SubDrivers']="";		
			if (array_key_exists($driver, $arr3)) {
				$row['Assign']=$arr3[$driver];
				$Assign++;
				$sort+=1000;
			}				
			else $row['Assign']="";		
			if (array_key_exists($driver, $arr4)) {
				$row['TransfersAssign']=$arr4[$driver];
				$TransfersAssign++;
				$sort+=10000;
			}					
			else $row['TransfersAssign']="";		
			if (array_key_exists($driver, $arr5)) {
				$row['Transfers']=$arr5[$driver];
				$Transfers++;				
				$sort+=100000;
			}	
			else $row['Transfers']="";
			$row["sort"]=$sort;
			$drivers_table[]=$row;
		}
	}
	
	function sorting($a, $b) {
		if ($a['sort'] < $b['sort']) {
			return 1;
		} elseif ($a['sort'] > $b['sort']) {
			return -1;
		}
		return 0;
	}
	usort($drivers_table, 'sorting');

	
	$smarty->assign('table',$drivers_table);	
	$smarty->assign('Vehicles',$Vehicles);	
	$smarty->assign('SubDrivers',$SubDrivers);	
	$smarty->assign('Assign',$Assign);	
	$smarty->assign('TransfersAssign',$TransfersAssign);	
	$smarty->assign('Transfers',$Transfers);	
	

	