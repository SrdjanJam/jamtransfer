<? 
require_once ROOT.'/db/v4_AuthUsers.class.php';

// Store levels to array for later use
$AuthLevels = array();
$al = new v4_AuthLevels();

$alk = $al->getKeysBy("AuthLevelName", 'asc');
foreach($alk as $nn => $id) {
	$al->getRow($id);
	$AuthLevels[$al->getAuthLevelID()] = $al->getAuthLevelName();
}

$dashboardFilter = '';
$titleAddOn = '';



?>
<div class=" container-fluid">
	<h1><?= USERS ?> <?= $titleAddOn ?></h1>
	<? if ($_SESSION['AuthLevelID'] != '41') { // operatori nemogu raditi nove korisnike ?>
		<a class="btn btn-primary btn-xs" href="index.php?p=newUser"><?= NNEW ?></a>
	<? } ?>
	<br><br>
	
	<? if ($_SESSION['AuthLevelID'] == '41') {  // operatori mogu viditi samo agente i vozace ?>
		<input type="hidden"  id="whereCondition" name="whereCondition" 
		value=" WHERE AuthUserID > 0 AND (AuthLevelID = 2 OR AuthLevelID = 31) <?= $dashboardFilter ?>">
	<? } else { ?>
		<input type="hidden"  id="whereCondition" name="whereCondition" 
		value=" WHERE AuthUserID > 0 AND AuthLevelID <= <?= $_SESSION['AuthLevelID']?> <?= $dashboardFilter ?>">
	<? } ?>
	
	<div class="row pad1em">
		<div class="col-sm-2" id="infoShow"></div>

		<div class="col-sm-2">
			<i class="fa fa-list-ul"></i>
			<select id="UserLevel" class="w75" onchange="getAllUsersFilter();">
				<option value="0"> All </option>
				<?
					if ($_SESSION['AuthLevelID'] == '41') { // operatori mogu viditi samo agente i vozace
						foreach($AuthLevels as $val => $text) {
							if (($val == '2') or ($val == '31')) {
								echo  '<option value="'.$val.'"> ' . $text . '</option>';
							}
						}
					}
					else {
						foreach($AuthLevels as $val => $text) {
							echo  '<option value="'.$val.'"> ' . $text . '</option>';
						}
					}
				?>
			</select>
		</div>
		<div class="col-sm-1">
			<i class="fa fa-eye"></i>
			<select id="length" class="w75" onchange="getAllUsersFilter();">
				<option value="5"> 5 </option>
				<option value="10" selected> 10 </option>
				<option value="20"> 20 </option>
				<option value="50"> 50 </option>
				<option value="100"> 100 </option>
			</select>
		</div>

		<div class="col-sm-3">
			<i class="fa fa-search"></i>
			<input type="text" id="Search" class="w75" onchange="getAllUsersFilter();" placeholder="Text + Enter to Search">
		</div>

		<div class="col-sm-2">
			
			<i class="fa fa-sort-amount-asc"></i> 
			<select name="sortOrder" id="sortOrder" onchange="getAllUsersFilter();">
				<option value="ASC" selected="selected"> Ascending </option>
				<option value="DESC"> Descending </option>
			</select>
			
		</div>

		<div class="col-sm-2">
			
			<i class="fa fa-filter"></i> 
			<select name="active" id="active" onchange="getAllUsersFilter();">
				<option value="1" selected="selected"> Active </option>
				<option value="0"> Not Active </option>
				<option value="99"> All </option>
			</select>
			
		</div>
	
	</div>

	<div id="showUsers"><div class="center"><?= THERE_ARE_NO_DATA ?></div></div>
	
	<? 
		// inList razlikuje je li direktan poziv Edit transfera (npr. iz dashboarda)
		// ili ide preko liste svih transfera
		// ako je iz liste, onda je true
		$inList = true;
		define("READ_ONLY_FLD", '');
		// Poziva se template za Listu i za Edit transfera
		// koristi handlebars
		require_once $modulesPath .'/users/usersList.'.$_SESSION['GroupProfile'].'.php'; 
		require_once $modulesPath .'/users/usersEditForm.'.$_SESSION['GroupProfile'].'.php'; 
	?>
	<br>
	<div id="pageSelect" class="col-sm-12"></div>
	<br><br><br><br>
</div>

<? require_once 'userEditJS.php' ?>	

<script type="text/javascript">
	$(document).ready(function(){
		$(".datepicker").pickadate({format:'yyyy-mm-dd'});
		getAllUsers(); // definirano u userEditJS.php
	});

	function getAllUsersFilter() {
		getAllUsers(); // definirano u userEditJS.php
	}
</script>

