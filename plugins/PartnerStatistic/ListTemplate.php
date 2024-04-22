<?
$smarty->assign('date1',true);
$smarty->assign('date2',true);
$smarty->assign('selectactive',true);
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

		<div class="col-md-1">
			<?=ACTIVE;?>		
		</div>
		
		<div class="col-md-2">
			<?=CONFIRM;?>
		</div>

		<div class="col-md-2">
			<?=CONFIRM;?> <?=REQUEST;?>
		</div>		
		<div class="col-md-2">
			<?=COMPLETED;?> 
		</div>
		
		
	</div>

	<!-- listTile: -->
	{{#each Item}}
		<div  onclick="oneItem({{ID}});">
		
			<div class="row {{color}} pad1em listTile cursor-list"  
			style="border-top:1px solid #ddd" 
			id="t_{{ID}}">
		
				<div class="col-md-1">
					<strong>{{AuthUserID}}</strong>
				</div>
				
				<div class="col-md-2">
					{{AuthUserName}}
				</div>				

				<div class="col-md-1">
					{{#compare Active ">" 0}}
						<i class="fa fa-circle text-green"></i>
					{{else}}
						<i class="fa fa-circle text-red"></i>
					{{/compare}}					
				</div>				
				
				<div class="col-md-2">
					{{ConfirmDecline}}
				</div>

				<div class="col-md-2">
					{{ConfirmDeclineR}}
				</div>					
				
				<div class="col-md-2">
					{{CompleteError}}
				</div>		
								
			</div>

		</div>
	{{/each}}
</script>