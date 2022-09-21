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
			font-size: 80%; 
			position: relative; 
			margin-left: 10px;			
		}		
		.dropzoneN{
		}
	</style>

    <body>
        <div class="row transfers"> 
		
			<div class="col-md-10">
				{section name=pom1 loop=$drivers}
				<div class="col-md-3 dropzoneN driver-style" data-id="{$drivers[pom1].DriverID}">
					{$drivers[pom1].DriverName} <i class="fa fa-eye-slash driver_hide"></i>
					<div class='sort'>
					{section name=pom2 loop=$transfers}
						{if $drivers[pom1].DriverID eq $transfers[pom2].SubDriver}
							<div data-sort="{$transfers[pom2].PickupTime}" class="dropelement"  data-id="{$transfers[pom2].DetailsID}">
								<a target="_blank" href="orders/detail/{$transfers[pom2].DetailsID}"
									title="<b>{$transfers[pom2].OrderID}-{$transfers[pom2].TNo} - {$transfers[pom2].PaxName} </b>" 
									data-content="
										<br/>{$FLIGHT_NO}: {$transfers[pom2].FlightNo}
										<br>{$FLIGHT_TIME}: {$transfers[pom2].FlightTime}
									" 
									class="mytooltip">						
									<div>
											<strong>{$transfers[pom2].PickupTime}</strong>
											<i class="fa fa-car"></i><span>{$transfers[pom2].VehicleType}</span>							
											<strong>{$transfers[pom2].OrderID}-{$transfers[pom2].TNo}</strong> 
											<i class="fa fa-user"></i><span>{$transfers[pom2].PaxNo}</span>
									</div>
									<div>{$transfers[pom2].PickupName}-{$transfers[pom2].DropName}</div>
									<div>
										{if not isset($smarty.request.Date)}{$transfers[pom2].PickupDate}{/if} 
										<strong>{$transfers[pom2].PickupTime}</strong>
										<i class="fa fa-car"></i><span>{$transfers[pom2].VehicleType}</span>							
									</div>
								</a>
							</div>						
						{/if}
					{/section}	
					</div>
				</div>
				{/section}
				
			</div>

			<!-- For drop: -->
			<div class="col-md-2 dropzoneN transfers-style" data-id='0'>
				<div class="sort">
				{section name=pom1 loop=$transfers}
					{if $transfers[pom1].SubDriver eq 0}				
						<div data-sort="{$transfers[pom1].PickupTime}" class="dropelement"  data-id="{$transfers[pom1].DetailsID}">
							<a target="_blank" href="orders/detail/{$transfers[pom1].DetailsID}"
								title="<b>{$transfers[pom1].OrderID}-{$transfers[pom1].TNo} - {$transfers[pom1].PaxName} </b>" 
								data-content="
									<br/>{$FLIGHT_NO}: {$transfers[pom1].FlightNo}
									<br>{$FLIGHT_TIME}: {$transfers[pom1].FlightTime}
								" 
								class="mytooltip">						
								<div>
										<strong>{$transfers[pom1].PickupTime}</strong>
										<i class="fa fa-car"></i><span>{$transfers[pom1].VehicleType}</span>							
										<strong>{$transfers[pom1].OrderID}-{$transfers[pom1].TNo}</strong> 
										<i class="fa fa-user"></i><span>{$transfers[pom1].PaxNo}</span>
								</div>
								<div>{$transfers[pom1].PickupName}-{$transfers[pom1].DropName}</div>
								<div>
									{if not isset($smarty.request.Date)}{$transfers[pom1].PickupDate}{/if} 
									<strong>{$transfers[pom1].PickupTime}</strong>
									<i class="fa fa-car"></i><span>{$transfers[pom1].VehicleType}</span>							
								</div>
							</a>
						</div>
					{/if}
				{/section}	
				</div>
			</div>
			
	
		</div><!-- End of .row transfers -->
		

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
			function changeOrder(detailid,driverid) {
				var link = '{/literal}{$root_home}{literal}plugins/Distribution/update.php';
				var param = "DetailsID="+detailid+"&SubDriverID="+driverid;
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
					$(".transfers").find("[data-id='" + window.id + "']").appendTo(this);	
					$(".transfers").find("[data-id='" + window.id + "']").removeAttr('style');

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
			$(".mytooltip").popover({trigger:'hover', html:true, placement:'bottom'});

		{/literal}
		</script>	
    
    </body>
