<style>
	.w-edit{
		width:180px;
	}
</style>

<script type="text/x-handlebars-template" id="ItemListTemplate">

	<div class="row row-edit">
		<div class="col-md-12">
		
			<div class="col-md-3">
				<?=SPECIALDATE;?>
			</div>

			<div class="col-md-3">
				<?=STARTTIME;?>
			</div>	

			<div class="col-md-3">
				<?=ENDTIME;?>
			</div>

			<div class="col-md-3">
				<?=CORRECTIONPERCENT;?>
			</div>

		</div>	
	</div>

	{{#each Item}}
		
		<div class="row {{color}} pad1em listTile listTitleEdit" 
		style="border-top:1px solid #ddd"
		id="t_{{ID}}">
	
			<input type="hidden" name="OwnerID" id="OwnerID" class="w50" value="<?=$_SESSION['OwnerID'] ?>">

			<div class="col-md-12">

				<!-- Example: -->
				<!-- <div class="row">
					<div class="col-md-3">
						<label for="SpecialDate"><?=SPECIALDATE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="SpecialDate" id="SpecialDate" class="w50 datepicker" value="{{SpecialDate}}">
					</div>
				</div> -->
				
				<div class="col-md-3">
					<input type="text" name="SpecialDate" id="SpecialDate" class="w50 datepicker w-edit" value="{{SpecialDate}}">
				</div>
			
				<div class="col-md-3">
					<input type="text" name="StartTime" id="StartTime" class="w50 timepicker w-edit" value="{{StartTime}}">
				</div>
			
				<div class="col-md-3">
					<input type="text" name="EndTime" id="EndTime" class="w50 timepicker w-edit" value="{{EndTime}}">
				</div>

				<div class="col-md-3">
					<input type="text" name="CorrectionPercent" id="CorrectionPercent" class="w25 w-edit" value="{{CorrectionPercent}}">%
				</div>
				
			</div> <!-- End of .col-md-12 -->
					

		</div> <!-- End of .row -->


	{{/each}}


</script>
	
