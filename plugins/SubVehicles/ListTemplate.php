<?
	$smarty->assign('selectactive',true);
?>
<script type="text/x-handlebars-template" id="ItemListTemplate">

	<!-- Labels: -->
	<? if (!PARTNERLOG) { ?>
	<div class="row row-edit">
		
		<div class="col-md-12">

			<div class="col-xs-3 col-md-1">
				<?=VEHICLEID;?>
			</div>

			<div class="col-xs-9 col-md-2">
				<?=VEHICLEDESCRIPTION;?>
			</div>				
					
			<div class="col-xs-3 col-md-1">
				<?=VEHICLECAPACITY;?>
			</div>			
			
			<div class="col-xs-3 col-md-1">
				<?=YEAR;?>
			</div>

			<div class="col-xs-3 col-md-1">
				<?=ACTIVE;?>
			</div>

			<div class="col-xs-3 col-md-1">
				<?=DELETE;?>
			</div>

			<div class="col-xs-12 col-md-3 col-lg-1">
				<?=VEHICLETYPEID;?>
			</div>
			
			<div class="col-md-1">
				<?=EXPENSES;?>
			</div>		
			
			<div class="col-md-1">
				<?=TASKS;?>
			</div>			

			<div class="col-md-1">
				<?=RAPTORID;?>
			</div>

			<div class="col-md-1">
				<a target='_blank' href='plugins/SubVehicles/getRaptorVehicles.php' style="color:blue;background:silver;"><i class="fas fa-external-link"></i>&nbsp;<u>RAPTOR</u></a>
			</div>

		</div>
	</div>
	<? } ?>
	<div class="row newone">
		<div class="col-md-1">
			<button id="newone" class="btn btn-primary btn-xs btn-xs-edit"><i class="fa fa-plus" aria-hidden="true"></i></button>
		</div>	
	</div>	
	{{#each Item}}
		
		<!-- Main Content: -->
		<div class="row {{color}} pad1em " 
		style="border-top:1px solid #ddd" 
		id="t_{{VehicleID}}">

			<form>

				<!-- VehicleID hidden -->

				<div class="col-md-12 editrow">

					<div class="col-xs-3 col-md-1">
						<input type="text"  name="VehicleID" class="VehicleID form-control" value="{{VehicleID}}" readonly>
					</div>

					<!-- VEHICLEDESCRIPTION -->
					<div class="col-xs-9 col-md-2">
						<input type="text" name="VehicleDescription" id="VehicleDescription" class="w100 form-control" value="{{VehicleDescription}}" placeholder="Insert Vehicle brand&type">
					</div>
					
					<!-- VEHICLECAPACITY -->
					<div class="col-xs-3 col-md-1">
						<input type="text" name="VehicleCapacity" id="VehicleCapacity"  class="w100 form-control" value="{{VehicleCapacity}}" placeholder="Max.pax">
					</div>					
					
					<!-- YEAR -->
					<div class="col-xs-3 col-md-1">
						<input type="text" name="Year" id="Year"  class="w100 form-control" value="{{Year}}" placeholder="Year">
					</div>

					<!-- ACTIVE -->
					<div class="col-xs-3 col-md-1">
						{{ yesNoSliderEdit Active 'Active'}}					
					</div>

					<div class="col-xs-3 col-md-1">
						<button type="button" class="b-delete" data-id="{{VehicleID}}" style="color:red;" title="delete">
							<i class="fas fa-trash-alt"></i>
						</button>
					</div>
					<? if (!PARTNERLOG) { ?>
					<!-- VEHICLETYPEID -->
					<div class="col-xs-12 col-md-3 col-lg-1">
						{{ vehicleTypeSelect VehicleTypeID 'VehicleTypeID'}}	
					</div>						
						<!-- Expenses: -->
					<div class="col-xs-6 col-md-1">
						<span><a target='_blank' href='expenses/vehicles/{{VehicleID}}'><?=EXPENSES;?></a></span>
					</div>				
					
					<!-- Tasks: -->
					<div class="col-xs-6 col-md-1">
						<span><a target='_blank' href='tasks/vehicles/{{VehicleID}}'><?=TASKS;?></a></span>
					</div>		

					<!-- RAPTORID -->
					<div class="col-md-1">
						<input type="text" name="RaptorID" id="RaptorID"  class="w100 form-control" value="{{RaptorID}}">				
					</div>
					
					<!-- Paralel Tasks: -->
					<div class=" col-xs-6 col-md-1">
						<span><a target='_blank' href='tasks/paralelTasks/{{VehicleID}}/109'>Paralel</a></span>
					</div>						
					<? } ?>
				</div>
			</form>

		</div>


	{{/each}}

	<script>
		$(".newone").hide();
		$("#newone").click(function(){
			location.reload();	
		});
		$('.editrow input, .edit row select').change(function(){
			var base=window.rootbase;
			// Doesn't work:
			//if (window.location.host=='localhost') base=base+'/jamtransfer';

			var link = base+'plugins/SubVehicles/Save.php';

			var param = $(this).parent().parent().parent().serialize();

			console.log(link+'?'+param)

			$.ajax({
				type: 'POST',
				url: link,
				data: param,
				success: function(data) {
					console.log(data);
					$('#t_ .VehicleID').val(data);					
					//$('#Vehicle').val(data);
					toastr['success'](window.success);
					$(".newone").show();
				}				
			});
			
		})

		// Hide div:
		$(document).ready(function(){
			$('.b-delete').click(function(){
				if (confirm("Are you sure to delete this row?")) {

					var base=window.rootbase;
					// Doesn't work:
					// if (window.location.host=='localhost') base=base+'/jamtransfer';

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



	
