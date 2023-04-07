<?
	$smarty->assign('selectactive',true);
?>
<script type="text/x-handlebars-template" id="ItemListTemplate">

	<!-- Labels: -->
	<div class="row row-edit">
		
		<div class="col-md-12">

			<div class="col-md-1">
				<?=VEHICLEID;?>
			</div>

			<div class="col-md-3">
				<?=VEHICLEDESCRIPTION;?>
			</div>	

			<div class="col-md-1">
				<?=VEHICLETYPEID;?>
			</div>			
			
			<div class="col-md-1">
				<?=VEHICLECAPACITY;?>
			</div>

			<div class="col-md-1">
				<?=RAPTORID;?>
			</div>

			<div class="col-md-1">
				<?=ACTIVE;?>
			</div>

			<div class="col-md-1">
				<?=DELETE;?>
			</div>
			
			<div class="col-md-1">
				<?=EXPENSES;?>
			</div>		
			
			<div class="col-md-1">
				<?=TASKS;?>
			</div>			

			<div class="col-md-1">
				<a target='_blank' href='plugins/SubVehicles/getRaptorVehicles.php' style="color:blue;background:silver;"><i class="fas fa-external-link"></i>&nbsp;<u>RAPTOR</u></a>
			</div>

		</div>
	</div>
	
	{{#each Item}}
		
		<!-- Main Content: -->
		<div class="row {{color}} pad1em listTile listTitleEdit" 
		style="border-top:1px solid #ddd" 
		id="t_{{VehicleID}}">

			<form>

				<!-- VehicleID hidden -->

				<div class="col-md-12">

					<div class="col-md-1">
						<input type="text"  name="VehicleID" class="VehicleID form-control" value="{{VehicleID}}" readonly>
					</div>

					<!-- VEHICLEDESCRIPTION -->
					<div class="col-md-3">
						<input type="text" name="VehicleDescription" id="VehicleDescription" class="w100 form-control" value="{{VehicleDescription}}">
					</div>

					<!-- VEHICLETYPEID -->
					<div class="col-md-1">
						<input type="text" name="VehicleTypeID" id="VehicleTypeID" class="w100 form-control" value="{{VehicleTypeID}}">
					</div>					
					
					<!-- VEHICLECAPACITY -->
					<div class="col-md-1">
						<input type="text" name="VehicleCapacity" id="VehicleCapacity"  class="w100 form-control" value="{{VehicleCapacity}}">
					</div>

					<!-- RAPTORID -->
					<div class="col-md-1">
						<input type="text" name="RaptorID" id="RaptorID"  class="w100 form-control" value="{{RaptorID}}">				
					</div>

					<!-- ACTIVE -->
					<div class="col-md-1">
						{{ yesNoSliderEdit Active 'Active'}}					
					</div>

					<div class="col-md-1">
						<button type="button" class="b-delete" data-id="{{VehicleID}}" style="color:red;" title="delete">
							<i class="fas fa-trash-alt"></i>
						</button>
					</div>
					
						<!-- Expenses: -->
					<div class="col-md-1 col-xs-6">
						<span><a target='_blank' href='expenses/vehicles/{{VehicleID}}'><?=EXPENSES;?></a></span>
					</div>				
					
					<!-- Tasks: -->
					<div class="col-md-1 col-xs-6">
						<span><a target='_blank' href='tasks/vehicles/{{VehicleID}}'><?=TASKS;?></a></span>
					</div>		

					<!-- Paralel Tasks: -->
					<div class="col-md-1 col-xs-6">
						<span><a target='_blank' href='tasks/paralelTasks/{{VehicleID}}/109'>Paralel</a></span>
					</div>						

				</div>
			</form>

		</div>


	{{/each}}

	<script>
		$('input').change(function(){
			var base=window.location.origin;
			if (window.location.host=='localhost') base=base+'/jamtransfer';

			var link = base+'/plugins/SubVehicles/Save.php';

			var param = $(this).parent().parent().parent().serialize();

			console.log(link+'?'+param)

			$.ajax({
				type: 'POST',
				url: link,
				data: param,
				success: function(data) {
					$('#t_ .VehicleID').val(data);					
					//$('#Vehicle').val(data);
					toastr['success'](window.success);
				}				
			});
			
		})

		// Hide div:
		$(document).ready(function(){
			$('.b-delete').click(function(){
				if (confirm("Are you sure to delete this row?")) {

					var base=window.location.origin;
					if (window.location.host=='localhost') base=base+'/jamtransfer';

					var link = base+'/plugins/SubVehicles/Delete.php';
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



	
