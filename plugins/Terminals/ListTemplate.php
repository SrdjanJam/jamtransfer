<?
	$arr_row['id']=0;
	$arr_row['name']="All";
	$arr_row['id']=1;
	$arr_row['name']="Most Popular";
	$arr_all[]=$arr_row;
	
	$smarty->assign('options',$arr_all);
	$smarty->assign('selecttype',true);
	
?>
<script type="text/x-handlebars-template" id="ItemListTemplate">

	<div class="row row-edit">
		
		<div class="col-md-2">
			<?=TERMINAL_ID;?>
		</div>

		<div class="col-md-5">
			<?=PLACENAMEEN;?>
			<?=COUNTRYNAMEEN;?>
		</div>	
			
		<div class="col-md-2">
			<a target='_tab' href="https://prod.jamtransfer.com/api/terminals/bust-cache?hash=d06161457d4c4b45e57d764c98051d86" style="color:blue;"><i class="fas fa-external-link"></i>&nbsp;<u><?=DELETE_CACHE;?></u></a>
		</div>				
	</div>

	{{#each Item}}
		<div  onclick="oneItem({{TerminalID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{TerminalID}}">
		
				<div class="col-sm-2">
					{{TerminalID}}
				</div>

				<div class="col-sm-5">
					<strong>{{PlaceNameEN}}</strong> -
					{{CountryNameEN}}
				</div>

			</div>
		</div>
		<div id="ItemWrapper{{TerminalID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{TerminalID}}" class="row">
				<div id="one_Item{{TerminalID}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	{{/each}}


</script>
	
