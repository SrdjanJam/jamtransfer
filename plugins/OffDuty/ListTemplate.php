<script type="text/x-handlebars-template" id="ItemListTemplate">

	<!-- Labels: -->
	<div class="row row-edit">
		<div class="col-md-12">

			<div class="col-md-2">
				<?=VEHICLENAME;?>
			</div>

			<div class="col-md-2">
				<?=STARTDATE;?>
			</div>

			<div class="col-md-2">
				<?=STARTTIME;?>
			</div>

			<div class="col-md-2">
				<?=ENDDATE;?>
			</div>

			<div class="col-md-2">
				<?=ENDTIME;?>
			</div>

			<div class="col-md-1">
				<?=REASON;?>
			</div>

			<div class="col-md-1">
				<?=DELETE;?>
			</div>

		</div>			
	</div>
	<div class="row">
		<div class="col-md-1 col-xs-2"><i class="fa fa-plus clickplus" aria-hidden="true"></i></div>
	</div>	
	<!-- Main content: -->
	{{#each Item}}
		
		<div class="row {{color}} pad1em listTile listTitleEdit cursor-list offduty-edit" 
		style="border-top:1px solid #ddd" 
		id="t_{{ID}}">

			<form>
				<!-- ID -->
				<input type="hidden" name="ID" class="ID"  value="{{ID}}">
				<input type="hidden" name="VehicleID"  value="{{VehicleID}}">

				<div class="col-md-12">
					
					<!-- VEHICLENAME -->
					<div class="col-md-2">
						{{VehicleName}}
					</div>

					<!-- STARTDATE -->
					<div class="col-md-2">
						<input type="text" name="StartDate" id="StartDate" 
						class="w25 datepicker" value="{{StartDate}}" data-id="{{ID}}">
					</div>

					<!-- STARTTIME	-->
					<div class="col-md-2">
						<input type="text" name="StartTime" id="StartTime" 
						class="w25 timepicker" value="{{StartTime}}" data-id="{{ID}}">
					</div>

					<!-- ENDDATE -->
					<div class="col-md-2">
						<input type="text" name="EndDate" id="EndDate" 
						class="w25 datepicker" value="{{EndDate}}" data-id="{{ID}}">
					</div>

					<!-- ENDTIME -->
					<div class="col-md-2">
						<input type="text" name="EndTime" id="EndTime" 
						class="w25 timepicker" value="{{EndTime}}" data-id="{{ID}}">
					</div>

					<!-- REASON -->
					<div class="col-md-1">
						<input type="text" name="Reason" id="Reason" class="w100" value="{{Reason}}" style="width:120px;" data-id="{{ID}}">
					</div>

					<!-- DELETE -->
					<div class="col-md-1">
						<button type="button" class="b-delete" data-id="{{ID}}" style="color:red;" title="delete">
							<i class="fas fa-trash-alt"></i>
						</button>
					</div>

				</div>
			</form>	
		</div>

	{{/each}}

	<script>
		$('input').change(function(){
			//if ($('#EndDate').is(':empty')) $('#EndDate').val($('#StartDate').val());			
			var base=window.location.origin;
			if (window.location.host=='localhost') base=base+'/jamtransfer';

			var link = base+'/plugins/OffDuty/Save.php';
			
			var id=$(this).attr("data-id");
			var param = $("#t_"+id).find("form").serialize();

			console.log(link+'?'+param)

			$.ajax({
				type: 'POST',
				url: link,
				data: param,
				success: function(data) {
					$('#t_ .ID').val(data);
				}				
			});
		})

		// Hide div:
		$(document).ready(function(){
			$('.clickplus').click(function(){
				location.reload();
			})	
			$('.b-delete').click(function(){
				if (confirm("Are you sure to delete this row?")) {

					var base=window.rootbase;
					if (window.location.host=='localhost') base=base+'/jamtransfer';

					var link = base+'/plugins/OffDuty/Delete.php';
					var param = "id="+ $(this).attr('data-id');

					console.log(link+'?'+param)
					
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
	
