	<style>
        body{
			font-size: 32px;
			overflow-x: hidden;
		}
		.driver-style{
			background: #c4b7a6;
			border-color: gray;
			min-height: 8%;
			border-style: solid;	
		}	
		.dropelement{
			border-color: green;
			border-style: solid;	
			font-size: 80%; 
			position: relative; 
			margin-left: 10px;			
		}		
		.dropzoneN{
		}		
		.marked{
			font-size: 150%; 
			color: green;
		}
		a{
			color: gray;
		}
	</style>

    <body>

        <div class="row vehicles"> 
		
			<div class="col-md-8">
				{section name=pom1 loop=$vehicles}
				<div class="col-md-3 dropzoneN driver-style" data-id="{$drivers[pom1].DriverID}">
					{$drivers[pom1].DriverName} <i class="fa fa-eye-slash driver_hide"></i>
					{if $drivers[pom1].SubVehicleID gt 0}
					<div class="dropelement"  data-id="{$drivers[pom1].SubVehicleID}">
						{$drivers[pom1].SubVehicleDescription}  / <i class="fa fa-user"></i>{$drivers[pom1].SubVehicleCapacity}
					</div>
					{/if}
				</div>
				{/section}
				
			</div>

			<!-- For drop: -->
			<div class="col-md-4 sort" data-id='0'>
				{section name=pom1 loop=$vehicles}
					{if $vehicles[pom1].SubDriver eq 0}
						<div class="col-md-6 dropzoneN" data-id='0'>
							<div class=" dropelement" data-sort="{$vehicles[pom1].VehicleCapacity}" data-id="{$vehicles[pom1].VehicleID}">
								{$vehicles[pom1].VehicleDescription} / <i class="fa fa-user"></i>{$vehicles[pom1].VehicleCapacity}
							</div>
						</div>
					{/if}
				{/section}	
			</div>
			
	
		</div>
		

		<script>
		{literal}
			function elementdragg() {
				$(".dropelement").draggable({

					containment: "#container",
					connectToSortable: "#sorting",
					cursor: 'move',

					drag: function(event, ui) {	
						window.id=$(this).attr('data-id');
					} 
					
				});
			}
			function changeOrder(vehicleid,driverid) {
				var link = '{/literal}{$root_home}{literal}plugins/Distribution/updateVehicles.php';
				var param = "SubVehicleID="+vehicleid+"&SubDriverID="+driverid;
				$.ajax({
					type: 'POST',
					url: link,
					data: param,
				});
			}			
			elementdragg();
			$(".dropzoneN").droppable({
				drop: function(event, ui) {
					var driverid=$(this).attr('data-id');
					changeOrder(window.id,driverid)
					$(".vehicles").find("[data-id='" + window.id + "']").appendTo(this);	
					$(".vehicles").find("[data-id='" + window.id + "']").removeAttr('style');

					var result = $(this).find('.dropelement').sort(function (a, b) {
						var contentA =parseInt( $(a).data('sort'));
						var contentB =parseInt( $(b).data('sort'));
						return (contentA < contentB) ? -1 : (contentA > contentB) ? 1 : 0;
					});
					$(this).find('.sort').html(result);	
					elementdragg();	
				}	
			});
			$(".driver_hide").click(function(){
				$(this).parent().hide(300);
			})

		{/literal}
		</script>	
    
    </body>
