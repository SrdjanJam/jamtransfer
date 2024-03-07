<?
	$smarty->assign('selectactive',true);
?>
<script type="text/x-handlebars-template" id="ItemListTemplate">

	<!-- Labels: -->
	<div class="row row-edit">
		<div class="col-md-12">
			<div class="col-md-2"> <?=TUNNEL_PASS_ID;?> </div>
			<!-- <div class="col-md-1"> <?=OWNERID;?> </div> -->
			<div class="col-md-2"> <?=VEHICLE_CATEGORY;?> </div>			
			<div class="col-md-2"> <?=TUNNEL_PASS_CODE;?> </div>
			<div class="col-md-2"> <?=VALIDTO;?> </div>
			<div class="col-md-1"> <?=PASS_NUMBER;?> </div>
			<div class="col-md-1"> <?=ASSIGN_SDID;?> </div>
			<!-- <div class="col-md-1"> <?=ASSIGN_TIME;?> </div> -->
			<div class="col-md-1"> <?=ACTIVE;?> </div>
			<div class="col-md-1"> <?=DELETE;?> </div>
		</div>
	</div>
	
	{{#each Item}}
		
		<!-- Main Content: -->
		<div class="row {{color}} pad1em listTile listTitleEdit" 
		style="border-top:1px solid #ddd" 
		id="t_{{TunnelPassID}}">

			<form>
				
				<div class="col-md-12">
					<!-- TunnelPassID -->
					<div class="col-md-2"> <input type="text"  name="TunnelPassID" class="TunnelPassID form-control" value="{{TunnelPassID}}" readonly> </div>

					<!-- OwnerID -->
					<!-- <div class="col-md-2"> <input type="text" name="OwnerID" id="OwnerID" class="w100 form-control" value="{{OwnerID}}"> </div>					 -->
					
					<!-- VehicleCategory -->
					<div class="col-md-2"> <input type="text" name="VehicleCategory" id="VehicleCategory"  class="w100 form-control" value="{{VehicleCategory}}"> </div>

					<!-- TunnelPassCode -->
					<div class="col-md-2"> <input type="text" name="TunnelPassCode" id="TunnelPassCode"  class="w100 form-control" value="{{TunnelPassCode}}"> </div>

					<!-- ValidTo -->
					<div class="col-md-2"> <input type="text" name="ValidTo" id="ValidTo"  class="w100 form-control" value="{{ValidTo}}"> </div>

					<!-- PassNumber -->
					<div class="col-md-1"> <input type="text" name="PassNumber" id="PassNumber"  class="w100 form-control" value="{{PassNumber}}"> </div>

					<!-- AssignSDID -->
					<div class="col-md-1"> {{userSelect AssignSDID "32" "AuthUserRealName"}} </div>

					<!-- AssignTime -->
					<!-- <div class="col-md-1"> <input type="text" name="AssignTime" id="AssignTime"  class="w100 form-control" value="{{AssignTime}}"> </div> -->

					<!-- ACTIVE -->
					<div class="col-md-1"> {{ yesNoSliderEdit Active 'Active'}} </div>

					<!-- Delete -->
					<div class="col-md-1"> <button type="button" class="b-delete" data-id="{{TunnelPassID}}" style="color:red;" title="delete"> <i class="fas fa-trash-alt"></i> </button> </div>

				</div>
			</form>

		</div>


	{{/each}}

	<script>
		$('input, select').change(function(){
			var base=window.rootbase;
			// Doesn't work:
			//if (window.location.host=='localhost') base=base+'/jamtransfer';

			var link = base+'plugins/TunnelPass/Save.php';

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

					var base=window.rootbase;
					// Doesn't work:
					// if (window.location.host=='localhost') base=base+'/jamtransfer';

					var link = base+'/plugins/TunnelPass/Delete.php';
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



	
