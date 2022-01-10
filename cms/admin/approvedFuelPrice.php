<form name="approvedFuelPrice" method="post" action="">
<div class="container">
<div class="box box-info pad1em shadowLight">
<h1>APPROVED FUEL PRICES</h1>
<br>
<?
	$filename1 = ROOT . '/cms/approvedFuelPrice_Nice.inc';
	$filename2 = ROOT . '/cms/approvedFuelPrice_Lyon.inc';
	$filename3 = ROOT . '/cms/approvedFuelPrice_Split.inc';
	
	
	if (is('setRate', 'r') and r('setRate') == 1) {
		//Nice
		$somecontent1 = r('approvedFuelPrice1');
		// Let's make sure the file exists and is writable first.
		if (is_writable($filename1)) {
			if (!$handle1 = fopen($filename1, 'w')) {
				 echo "Cannot open file ($filename1)";
				 exit;
			}
			// Write $somecontent to our opened file.
			if (fwrite($handle1, $somecontent1) === FALSE) {
				echo "Cannot write to file ($filename)";
				exit;
			}
			echo "New Rate - $somecontent - is now active.";
			fclose($handle1);
		} else echo "The file $filename is not writable";
		//Lyon
		$somecontent2 = r('approvedFuelPrice2');
		// Let's make sure the file exists and is writable first.
		if (is_writable($filename2)) {
			if (!$handle2 = fopen($filename2, 'w')) {
				 echo "Cannot open file ($filename2)";
				 exit;
			}
			// Write $somecontent to our opened file.
			if (fwrite($handle2, $somecontent2) === FALSE) {
				echo "Cannot write to file ($filename)";
				exit;
			}
			echo "New Rate - $somecontent - is now active.";
			fclose($handle2);
		} else echo "The file $filename is not writable";		
		//Split
		$somecontent3 = r('approvedFuelPrice3');
		// Let's make sure the file exists and is writable first.
		if (is_writable($filename3)) {
			if (!$handle3 = fopen($filename3, 'w')) {
				 echo "Cannot open file ($filename3)";
				 exit;
			}
			// Write $somecontent to our opened file.
			if (fwrite($handle3, $somecontent3) === FALSE) {
				echo "Cannot write to file ($filename)";
				exit;
			}
			echo "New Rate - $somecontent - is now active.";
			fclose($handle3);
		} else echo "The file $filename is not writable";			
		
		
	} else {
		// uzmi podatke iz file-a
		$afp1 = file_get_contents($filename1, FILE_USE_INCLUDE_PATH);
		$_SESSION['afp1'] = $afp1;
		$afp2 = file_get_contents($filename2, FILE_USE_INCLUDE_PATH);
		$_SESSION['afp2'] = $afp2;
		$afp3 = file_get_contents($filename3, FILE_USE_INCLUDE_PATH);
		$_SESSION['afp3'] = $afp3;	
		
		if ($_SESSION['AuthUserID']!=843 && $_SESSION['AuthLevelID']!=91) $style1="style='display:none'";
		else $style1="";
		if ($_SESSION['AuthUserID']!=876 && $_SESSION['AuthLevelID']!=91) $style2="style='display:none'";
		else $style2="";
		if ($_SESSION['AuthUserID']!=556 && $_SESSION['AuthLevelID']!=91) $style3="style='display:none'";
		else $style3="";

		
	?>


	<div <?= $style1 ?> class="row">
		<div class="col-md-3">
			<label>Nice:</label>
		</div>		
		<div class="col-md-6">
			<input type="text" name="approvedFuelPrice1" value="<?= $afp1 ?>"> 		
		</div>	
	</div>
	<div <?= $style2 ?> class="row">
		<div class="col-md-3">
			<label>Lyon:</label>
		</div>		
		<div class="col-md-6">
			<input type="text" name="approvedFuelPrice2" value="<?= $afp2 ?>"> 		
		</div>	
	</div>	
	<div <?= $style3 ?> class="row">
		<div class="col-md-3">
			<label>Split:</label>
		</div>		
		<div class="col-md-6">
			<input type="text" name="approvedFuelPrice3" value="<?= $afp3 ?>"> 		
		</div>	
	</div>		
	<button name="setRate" type="submit" class="btn btn-primary " value="1"><?= SET_NEW_RATE ?></button>


<? } ?>

</div>
</div>
</form>
