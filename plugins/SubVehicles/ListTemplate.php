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

			<div class="col-md-2">
				<?=VEHICLEDESCRIPTION;?>
			</div>	

			<div class="col-md-2">
				<?=VEHICLETYPEID;?>
			</div>

			<div class="col-md-2">
				<?=RAPTORID;?>
			</div>

			<div class="col-md-5">
				<?=ACTIVE;?>
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
				<input type="hidden" name="VehicleID" id="VehicleID" class="w100" value="{{VehicleID}}">

				<div class="col-md-12">

					
					<div class="col-md-1">
						<strong>{{VehicleID}}</strong>
					</div>

					<!-- VEHICLEDESCRIPTION -->
					<div class="col-md-2">
						<input type="text" name="VehicleDescription" id="VehicleDescription" class="w100" value="{{VehicleDescription}}">
					</div>

					<!-- VEHICLETYPEID -->
					<div class="col-md-2">
						<input type="text" name="VehicleCapacity" id="VehicleCapacity" class="w100" value="{{VehicleCapacity}}">
					</div>

					<!-- RAPTORID -->
					<div class="col-md-2">
						<input type="text" name="RaptorID" id="RaptorID" class="w100" value="{{RaptorID}}">				
					</div>

					<!-- ACTIVE -->
					<div class="col-md-5">
						{{ yesNoSliderEdit Active 'Active'}}					
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
				}				
			});
			
		})	
	</script>

</script>



	
