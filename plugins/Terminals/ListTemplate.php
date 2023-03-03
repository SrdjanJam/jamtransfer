<?
	
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
	
