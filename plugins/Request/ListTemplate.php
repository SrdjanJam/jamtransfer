<?
	$arr_row['id']=1;
	$arr_row['name']="Expence";
	$arr_all[]=$arr_row;		
	$arr_row['id']=2;
	$arr_row['name']="Tasks";
	$arr_all[]=$arr_row;
	$smarty->assign('options',$arr_all);
	$smarty->assign('selecttype',true);
?>	
<script type="text/x-handlebars-template" id="ItemListTemplate">

	<div class="row row-edit">
		
		<div class="col-md-1">
			<?=REQUEST_ID;?>
		</div>

		<div class="col-md-11">
			<?=REQUEST_TITLE;?>
		</div>	
					
	</div>

	{{#each Item}}
		<div  onclick="oneItem({{ID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{ID}}">
		
					<div class="col-md-1">
						<strong>{{ID}}</strong>
					</div>

					<div class="col-md-11">
						{{Title}}
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
	
