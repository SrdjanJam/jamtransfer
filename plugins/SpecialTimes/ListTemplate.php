<script type="text/x-handlebars-template" id="ItemListTemplate">

	<div class="row row-edit">
		
		<div class="col-md-2">
			<?=VEHICLETYPEID;?>
		</div>

		<div class="col-md-2">
			<?=STARTSEASON;?> - <?=ENDSEASON;?>
		</div>	

		<div class="col-md-2">
			<?=SPECIALDATE;?>
		</div>

		<div class="col-md-2">
			<?=WEEKDAYS;?>
		</div>

		<div class="col-md-2">
			<?=STARTTIME;?> - <?=ENDTIME;?>
		</div>

		<div class="col-md-2">
			<?=CORRECTIONPERCENT;?>
		</div>
					
	</div>

	{{#each Item}}
		<div  onclick="oneItem({{ID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{ID}}">
		
				<div class="col-md-2">
					<strong>{{VehicleTypeID}}</strong>
				</div>

				<div class="col-md-2">
					<strong>{{StartSeason}} - {{EndSeason}}</strong>
				</div>

				<div class="col-md-2">
					<strong>{{SpecialDate}}</strong>
				</div>

				<div class="col-md-2">
					<strong>{{WeekDays}}</strong>
				</div>

				<div class="col-md-2">
					{{StartTime}}-{{EndTime}}
				</div>

				<div class="col-md-2">
					{{CorrectionPercent}}%
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
	
