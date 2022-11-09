<?
if (isset($_SESSION['UseDriverID']) && $_SESSION['UseDriverID']>0) {	
	$arr_row['id']=1;
	$arr_row['name']="Connected";
	$arr_all[]=$arr_row;	
	$arr_row['id']=2;
	$arr_row['name']="Not Connected";
	$arr_all[]=$arr_row;	
	$smarty->assign('options',$arr_all);
	$smarty->assign('selecttype',true);
}
?>

<script type="text/x-handlebars-template" id="ItemListTemplate">

	<div class="row row-edit">
		
		<div class="col-md-1">
			<?=VEHICLETYPEID;?>
		</div>

		<div class="col-md-2">
			<?=VEHICLE_TYPE;?>
		</div>

		<div class="col-md-1">
			<?=MAX;?>
		</div>	

		<div class="col-md-8">
			<?=DESCRIPTION;?>
		</div>
					
	</div>

	{{#each Item}}
		<div  onclick="oneItem({{VehicleTypeID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{VehicleTypeID}}">
		
					<div class="col-md-1">
						<strong>{{VehicleTypeID}}</strong>
					</div>

					<div class="col-md-2">
						{{VehicleTypeName}}
					</div>

					<div class="col-md-1">
						<i class="fa fa-user"></i> {{Max}}
					</div>

					<div class="col-md-8">
						{{{Description}}}
					</div>
			</div>
		</div>
		<div id="ItemWrapper{{VehicleTypeID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{VehicleTypeID}}" class="row">
				<div id="one_Item{{VehicleTypeID}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	{{/each}}


</script>
	
