<?
error_reporting(E_PARSE);

require_once ROOT.'/f/f.php';

$dashboardFilter = '';
$titleAddOn = '';


?>
<div class=" container">
	<h1>Request <?= $titleAddOn ?></h1>
	<? if ($_SESSION["AuthLevelID"] != TRANSLATOR_USER) { ?>
	<a class="btn btn-primary btn-xs" href="index.php?p=new_v4_Request"><?= NNEW ?></a>
	<? } ?>
	<br><br>
		
	<input type="hidden"  id="whereCondition" name="whereCondition" 
	value=" WHERE ID > 0 <?= $dashboardFilter ?>">
	
	<div class="row pad1em">
		<div class="col-md-2" id="infoShow"></div>
		<div class="col-md-2">
			<i class="fa fa-eye"></i>
			<select id="length" class="w75" onchange="all_v4_RequestFilter();">
				<option value="5"> 5 </option>
				<option value="10"> 10 </option>
				<option value="20" selected> 20 </option>
				<option value="50"> 50 </option>
				<option value="100"> 100 </option>
			</select>
		</div>
		<div class="col-md-2">
			<i class="fa fa-text-width"></i>
			<input type="text" id="Search" class=" w75" onchange="all_v4_RequestFilter();" placeholder="Text + Enter to Search">
		</div>
		<div class="col-md-2">
			<i class="fa fa-sort-amount-asc"></i> 
			<select name="sortOrder" id="sortOrder" onchange="all_v4_RequestFilter();">
				<option value="ASC" selected="selected"> <?= ASCENDING ?> </option>
				<option value="DESC"> <?= DESCENDING ?> </option>
			</select>
			
		</div>
		<div class="col-sm-2">
			<i class="fa fa-filter"></i> 
			<select name="active" id="active" onchange="all_v4_RequestFilter();">
				<option value="99" selected="selected"> All </option>			
				<option value="1"> Check Box </option>
				<option value="2"> Photo </option>
				<option value="3"> Video </option>
				<option value="0"> Not Active </option>
			</select>
		</div>		
	
	</div>

	<div id="show_v4_Request"><?= THERE_ARE_NO . DATA ?></div>
	
	<? 
		// inList razlikuje je li direktan poziv Edit transfera (npr. iz dashboarda)
		// ili ide preko liste svih transfera
		// ako je iz liste, onda je true
		$inList = true;
		define("READ_ONLY_FLD", '');
		// Poziva se template za Listu i za Edit transfera
		// koristi handlebars
		require_once $modulesPath .'/v4_Request/v4_RequestListTemplate.php'; 
		require_once $modulesPath .'/v4_Request/v4_RequestEditForm.php'; 
	?>
	<br>
	<div id="pageSelect" class="col-sm-12"></div>
	<br><br><br><br>
</div>

<? require_once ROOTPATH.'/p/modules/v4_Request/v4_Request_JS.php' ?>	

<script type="text/javascript">
	$(document).ready(function(){
		$(".datepicker").pickadate({format:'yyyy-mm-dd'});
		all_v4_Request(); // definirano u v4_Request_JS.php
	});

	function all_v4_RequestFilter() {
		all_v4_Request(); // definirano u v4_Request_JS.php
	}
</script>	
	
