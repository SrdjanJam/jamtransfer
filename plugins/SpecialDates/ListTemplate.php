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
			<form>
			<input type="hidden" name="ID" id="ID" class="w50" value="{{ID}}">
			<input type="hidden" name="OwnerID" id="OwnerID" class="w50" value="<?=$_SESSION['OwnerID'] ?>">

			<div class="col-md-12">
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
			</form>		

		</div> <!-- End of .row -->


	{{/each}}
	<script>
		$('input').change(function(){
			var base=window.location.origin;
			if (window.location.host=='localhost') base=base+'/jamtransfer';		
			var link = base+'/plugins/SpecialDates/Save.php';
			var param = $(this).parent().parent().parent().serialize();
			console.log(link+'?'+param)
			$.ajax({
				type: 'POST',
				url: link,
				data: param,
				success: function(data) {
				}				
			});
			
		})	
	</script>

</script>
	
