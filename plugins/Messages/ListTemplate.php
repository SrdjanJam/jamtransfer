<?
	$smarty->assign('selectsolved',true);
?>
<script type="text/x-handlebars-template" id="ItemListTemplate">

<!-- LIST: -->
	<div class="row row-edit">
		
		<div class="col-md-1">
			<?=MESSAGE_ID;?>
		</div>

		<div class="col-md-1">
			<?=PAGE;?>
		</div>
		
		<div class="col-md-2">
			<?=FROM_NAME;?>
		</div>			
		
		<div class="col-md-5">
			<?=MESSAGE;?>
		</div>		
		
		<div class="col-md-1">
			<?=DATE_TIME;?>
		</div>		
		
		<div class="col-md-1">
			Solver
		</div>

		<div class="col-md-1">
			Solved
		</div>
					
	</div>

<!-- ONE ITEM: -->
	{{#each Item}}
		<div  onclick="oneItem({{ID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{ID}}">

			
				<div class="col-sm-1">
					{{ID}}
				</div>

				<div class="col-sm-1">
					{{PageName}}
				</div>				
				
				<div class="col-sm-2">
					{{FromName}}
				</div>				
				
				<div class="col-sm-5">
					{{Body}}
				</div>

				<div class="col-sm-1">
					{{DateTime}}
				</div>				
				
				<div class="col-sm-1">
					{{userName SolverID "AuthUserRealName"}}
				</div>
				
				<div class="col-sm-1">
					{{#compare Status ">" 0}}
						<i class="fa fa-check text-green"></i>
					{{else}}
						<i class="fa fa-close text-red"></i>
					{{/compare}}				
				</div>

			</div>
		</div>
		<div id="ItemWrapper{{ID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{ID}}" class="row">
				<div id="one_Item{{ID}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	{{/each}}


</script>
	
