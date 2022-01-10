
	<?
//error_reporting(E_PARSE);

require_once ROOT.'/f/f.php';


$dashboardFilter = '';

?>
<div class="container">
	<h1><?= LOCATION_TYPES ?></h1>
	<? if ($_SESSION["AuthLevelID"] != TRANSLATOR_USER) { ?>
	<a class="btn btn-primary btn-xs" href="index.php?p=new_v4_PlaceTypes"><?= NNEW ?></a>
	<? } ?>
	<br><br>
		
	<input type="hidden"  id="whereCondition" name="whereCondition" 
	value=" WHERE PlaceTypeID > 0 <?= $dashboardFilter ?>">
	
	<div class="row pad1em">
		<div class="col-sm-3" id="infoShow"></div>
		<div class="col-sm-3">
			<i class="fa fa-eye"></i>
			<select id="length" class="w75" onchange="all_v4_PlaceTypesFilter();">
				<option value="5"> 5 </option>
				<option value="10"> 10 </option>
				<option value="20" selected> 20 </option>
				<option value="50"> 50 </option>
				<option value="100"> 100 </option>
			</select>
		</div>

		<div class="col-sm-3">
			<i class="fa fa-text-width"></i>
			<input type="text" id="Search" class=" w75" onchange="all_v4_PlaceTypesFilter();" placeholder="Text + Enter to Search">
		</div>

		<div class="col-sm-3">
			
			<i class="fa fa-sort-amount-asc"></i> 
			<select name="sortOrder" id="sortOrder" onchange="all_v4_PlaceTypesFilter();">
				<option value="ASC" selected="selected"> <?= ASCENDING ?> </option>
				<option value="DESC"> <?= DESCENDING ?> </option>
			</select>
			
		</div>
	
	</div>

	<div id="show_v4_PlaceTypes"><?= THERE_ARE_NO . DATA ?></div>
	
	<? 
		// inList razlikuje je li direktan poziv Edit transfera (npr. iz dashboarda)
		// ili ide preko liste svih transfera
		// ako je iz liste, onda je true
		$inList = true;
		define("READ_ONLY_FLD", '');
		// Poziva se template za Listu i za Edit transfera
		// koristi handlebars
		require_once $modulesPath .'/v4_PlaceTypes/v4_PlaceTypesListTemplate.'.$_SESSION['GroupProfile'].'.php'; 
		require_once $modulesPath .'/v4_PlaceTypes/v4_PlaceTypesEditForm.'.$_SESSION['GroupProfile'].'.php'; 
	?>
	<br>
	<div id="pageSelect" class="col-sm-12"></div>
	<br><br><br><br>
</div>

<? require_once ROOTPATH.'/p/modules/v4_PlaceTypes/v4_PlaceTypes_JS.php' ?>	

<script type="text/javascript">
	$(document).ready(function(){
		$(".datepicker").pickadate({format:'yyyy-mm-dd'});
		all_v4_PlaceTypes(); // definirano u v4_PlaceTypes_JS.php
	});

	function all_v4_PlaceTypesFilter() {
		all_v4_PlaceTypes(); // definirano u v4_PlaceTypes_JS.php
	}
</script>	
	
