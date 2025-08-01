

<script type="text/x-handlebars-template" id="ItemListTemplate">

	<!-- Labels: -->
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

			<div class="col-md-2">
				<?=CORRECTIONPERCENT;?>
			</div>

			<div class="col-md-1">
				<?=DELETE;?>
			</div>

		</div>	
	</div>
	<div class="row">
		<div class="col-md-1 col-xs-2"><i class="fa fa-plus clickplus" aria-hidden="true"></i></div>
	</div>	
	{{#each Item}}
		<!-- Main Content: -->
		<div class="row {{color}} pad1em listTile listTitleEdit cursor-list" 
		style="border-top:1px solid #ddd"
		id="t_{{ID}}">

			<form>
				<input type="hidden" name="ID" class="ID"  value="{{ID}}">

				<div class="col-md-12">
					<div class="col-md-3">
						<input type="text" name="SpecialDate" id="SpecialDate" class="w50 datepicker w-edit" value="{{SpecialDate}}" data-id="{{ID}}">
					</div>
					<!-- time picker - strat time -->
					<div class="col-md-3">
						<input type="text" name="StartTime" id="StartTime" class="w50 timepicker w-edit" value="{{StartTime}}" data-id="{{ID}}">
					</div>
					<!-- time picker - end time -->
					<div class="col-md-3">
						<input type="text" name="EndTime" id="EndTime" class="w50 timepicker w-edit" value="{{EndTime}}" data-id="{{ID}}">
					</div>

					<div class="col-md-2">
						<input type="text" name="CorrectionPercent" id="CorrectionPercent" class="w25 w-edit" value="{{CorrectionPercent}}" data-id="{{ID}}">%
					</div>

					<div class="col-md-1">
						<button type="button" class="b-delete" data-id="{{ID}}" style="color:red;" title="delete">
							<i class="fas fa-trash-alt"></i>
						</button>
					</div>
					
				</div> <!-- End of .col-md-12 -->
			</form>		

		</div> <!-- End of .row -->
	{{/each}}
	<script>

		// Hide div:=
		$(document).ready(function(){
			$('.clickplus').click(function(){
				location.reload();
			})				
			$('input').change(function(){
				var base=window.location.origin;
				if (window.location.host=='localhost') base=base+'/jamtransfer';		
				var link = base+'/plugins/SpecialDates/Save.php';

				var id=$(this).attr("data-id");
				var param = $("#t_"+id).find("form").serialize();
				
				console.log(link+'?'+param);
				$.ajax({
					type: 'POST',
					url: link,
					data: param,
					success: function(data) {
						$('#t_ .ID').val(data);
					}				
				});
			});			
			$('.b-delete').click(function(){
				if (confirm("Are you sure to delete this row?")) {

					var base=window.rootbase;
					if (window.location.host=='localhost') base=base+'/jamtransfer';

					var link = base+'/plugins/SpecialDates/Delete.php';
					var param = "id="+ $(this).attr('data-id');

					console.log(link+'?'+param);

					$.ajax({
						type: 'POST',
						url: link,
						data: param,
						success: function(data) {
							$('#t_ .ID').val(data);
							toastr['success'](window.delete);
						}				
					});
					// Hide div row:
        			$(this).parent().parent().parent().parent().hide(500);
    			}
    			return false;
			});
		});
	</script>
</script>
	