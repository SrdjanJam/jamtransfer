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
		.transfers-style{
			height:100vh;
		}	
		.dropelement{
			border-color: green;
			border-style: solid;		
		}		
		.dropzoneN{
		}
	</style>

    <body>

    	
        <div class="row transfers"> 
		
			<div class="col-md-9">
				{section name=pom1 loop=$drivers}
				<div class="col-md-3 dropzoneN driver-style" data-id="{$drivers[pom1].DriverID}">{$drivers[pom1].DriverName}</div>
				{/section}
				
			</div>

			<!-- For drop: -->
			<div class="col-md-3 dropzoneN transfers-style" data-id='0'>
				{section name=pom1 loop=$transfers}
					<div class="dropelement" data-id="{$transfers[pom1].DetailsID}">
						<div>
							<strong>{$transfers[pom1].OrderID}-{$transfers[pom1].TNo}</strong> 
							<i class="fa fa-user"></i><span>{$transfers[pom1].PaxNo}</span>
						</div>
						<div>{$transfers[pom1].PickupName}-{$transfers[pom1].DropName}</div>
						<div>
							{if not isset($smarty.request.Date)}{$transfers[pom1].PickupDate}{/if} 
							<strong>{$transfers[pom1].PickupTime}</strong>
							<i class="fa fa-car"></i><span>{$transfers[pom1].VehicleType}</span>							
						</div>
					</div>
				{/section}	
			</div>
			
	
		</div><!-- End of .row transfers -->
		

		<script>

			$(".dropelement").draggable({

				containment: 'document',
				cursor: 'move',

				drag: function(event, ui) {	
					window.id=$(this).attr('data-id');
			   	
			   	} 
				
			});

			$(".dropzoneN").droppable({
				drop: function(event, ui) {

					var driverid=$(this).attr('data-id');

					alert (window.id + ' connected with ' + driverid);

					$(".transfers").find("[data-id='" + window.id + "']").removeAttr('style');

					if (driverid == 0){
						$(".transfers").find("[data-id='" + window.id + "']").css('position','relative');
						$(".transfers").find("[data-id='" + window.id + "']").css('font-size','100%');
					}else {
						$(".transfers").find("[data-id='" + window.id + "']").css('position','relative');
						$(".transfers").find("[data-id='" + window.id + "']").css('font-size','80%');
						$(".transfers").find("[data-id='" + window.id + "']").css('margin','0 0 0 20px');
					} 
					
					$(".transfers").find("[data-id='" + window.id + "']").appendTo(this);
					
				}
			
			});


		</script>	
    
    </body>
