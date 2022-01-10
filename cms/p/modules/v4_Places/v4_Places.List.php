<?
require_once 'db/v4_PlaceTypes.class.php';

$dashboardFilter = '';
$titleAddOn = '';

$pt = new v4_PlaceTypes();
$placeTypes = $pt->getKeysBy('PlaceTypeEN', 'asc');

?>
<div class="container">
	<h1><?= LOCATIONS ?> <?= $titleAddOn ?></h1>
	<? if ($_SESSION["AuthLevelID"] != TRANSLATOR_USER) { ?>
	<a class="btn btn-primary btn-xs" href="index.php?p=new_v4_Places"><?= NNEW ?></a>
	<? } ?>
	<br><br>

	<input type="hidden"  id="whereCondition" name="whereCondition"
	value=" WHERE PlaceID > 0 <?= $dashboardFilter ?>">

	<div class="row pad1em">
		<div class="col-sm-3" id="infoShow"></div>
		<div class="col-sm-2">
			<i class="fa fa-list-ul"></i>

			<select id="PlaceType" class="w75" onchange="all_v4_PlacesFilter();">
				<option value="0"><?= ALL ?></option>
				<?
				foreach($placeTypes as $nn => $id) {
					$pt->getRow($id);
					echo  '<option value="'.$pt->getPlaceTypeID().'"> ' . $pt->getPlaceTypeEN() . '</option>';
				}
				?>
			</select>


		</div>
		<div class="col-sm-2">
			<i class="fa fa-eye"></i>
			<select id="length" class="w75" onchange="all_v4_PlacesFilter();">
				<option value="5"> 5 </option>
				<option value="10" selected> 10 </option>
				<option value="20"> 20 </option>
				<option value="50"> 50 </option>
				<option value="100"> 100 </option>
			</select>
		</div>

		<div class="col-sm-3">
			<i class="fa fa-text-width"></i>
			<input type="text" id="Search" name="Search" class=" w75" onchange="all_v4_PlacesFilter();" placeholder="Text + Enter to Search">
		</div>

		<div class="col-sm-2">

			<i class="fa fa-sort-amount-asc"></i>
			<select name="sortOrder" id="sortOrder" onchange="all_v4_PlacesFilter();">
				<option value="ASC" selected="selected"> <?= ASCENDING ?> </option>
				<option value="DESC"> <?= DESCENDING ?> </option>
			</select>

		</div>

	</div>

	<div id="show_v4_Places"><?= THERE_ARE_NO . DATA ?></div>

	<?
		// inList razlikuje je li direktan poziv Edit transfera (npr. iz dashboarda)
		// ili ide preko liste svih transfera
		// ako je iz liste, onda je true
		$inList = true;
		define("READ_ONLY_FLD", '');
		// Poziva se template za Listu i za Edit transfera
		// koristi handlebars
		require_once $modulesPath .'/v4_Places/v4_PlacesListTemplate.'.$_SESSION['GroupProfile'].'.php';
		require_once $modulesPath .'/v4_Places/v4_PlacesEditForm.'.$_SESSION['GroupProfile'].'.php';
	?>
	<br>
	<div id="pageSelect" class="col-sm-12"></div>
	<br><br><br><br>
</div>

<? require_once ROOTPATH.'/p/modules/v4_Places/v4_Places_JS.php' ?>

<script type="text/javascript">
	$(document).ready(function(){
		$(".datepicker").pickadate({format:'yyyy-mm-dd'});
		all_v4_Places(); // definirano u v4_Places_JS.php
	});

	function all_v4_PlacesFilter() {
		all_v4_Places(); // definirano u v4_Places_JS.php
	}
</script>
