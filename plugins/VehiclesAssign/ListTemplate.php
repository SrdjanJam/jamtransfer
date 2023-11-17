<?
$smarty->assign('date1',true);
$smarty->assign('date2',true);
?>

<script type="text/x-handlebars-template" id="ItemListTemplate">

	<!-- LABEL: -->
	<div class="row row-edit">

		<div class="col-md-1">
			<?=ID;?>
		</div>

		<div class="col-md-2">
			<?=NAME;?>
		</div>

		<div class="col-md-2">
			<?=VEHICLE;?>
		</div>
		
		<div class="col-md-2">
			<?=DATE;?>
		</div>

		<div class="col-md-2">
			<?=STATUS;?>
		</div>
	</div>

	<!-- listTile: -->
	{{#each Item}}
		<div  onclick="oneItem({{ID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{ID}}">
		
				<div class="col-md-1">
					<strong>{{ID}}</strong>
				</div>
				
				<div class="col-md-2">
					{{SubDriverName}}
				</div>				

				<div class="col-md-2">
					{{VehicleName}}
				</div>				
				
				<div class="col-md-2">
					{{AssignTime}}
				</div>

				<div class="col-md-2">
					{{Status}}
				</div>					
				

			</div>

		</div>


	{{/each}}


</script>