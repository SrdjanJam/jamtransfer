<? 
//error_reporting(E_PARSE);

require_once ROOTPATH.'/f/f.php';

$dashboardFilter = '';
$titleAddOn = '';

?>
<div class=" container-fluid">
	<h1><?= COUNTRIES ?> </h1><br><br>
		
	<input type="hidden"  id="whereCondition" name="whereCondition" 
	value=" WHERE CountryID > 0 <?= $dashboardFilter ?>">
	
	<div class="row">
		<div class="col-sm-12 white pad1em" id="infoShow"></div>
	</div>
	<div class="row pad4px white"">
		<div class="col-sm-2">
			<i class="fa fa-eye"></i>
			<select id="length" class="w75" onchange="getAllCountriesFilter();">
				<option value="5"> 5 </option>
				<option value="10" selected> 10 </option>
				<option value="20"> 20 </option>
				<option value="50"> 50 </option>
				<option value="100"> 100 </option>
			</select>
		</div>

		<div class="col-sm-3">
			<i class="fa fa-text-width"></i>
			<input type="text" id="Search" class=" w75" onkeyup="getAllCountriesFilter();">
		</div>

		<div class="col-sm-4">
			
			<i class="fa fa-sort-amount-asc"></i> 
			<select name="sortOrder" id="sortOrder" onchange="getAllCountriesFilter();">
				<option value="ASC" selected="selected"> Ascending </option>
				<option value="DESC"> Descending </option>
			</select>
			
		</div>
	
	</div>

	<div id="showCountries"><?= THERE_ARE_NO . COUNTRIES ?></div>
	
	<? 
		// inList razlikuje je li direktan poziv Edit transfera (npr. iz dashboarda)
		// ili ide preko liste svih transfera
		// ako je iz liste, onda je true
		$inList = true;
		define("READ_ONLY_FLD", '');
		// Poziva se template za Listu i za Edit transfera
		// koristi handlebars
		require_once $modulesPath .'/countries/countriesList.'.$_SESSION['GroupProfile'].'.php'; 
		require_once $modulesPath .'/countries/countryEditForm.'.$_SESSION['GroupProfile'].'.php'; 
	?>
	<br>
	<div id="pageSelect" class="col-sm-12"></div>
	<br><br><br><br>
</div>

<? require_once ROOTPATH.'/p/modules/countries/countryEditJS.php' ?>	

<script type="text/javascript">
	$(document).ready(function(){
		$(".datepicker").pickadate({format:'yyyy-mm-dd'});
		getAllCountries(); // definirano u cms.jquery.js
	});

	function getAllCountriesFilter() {
		getAllCountries(); // definirano u cms.jquery.js
	}
</script>

