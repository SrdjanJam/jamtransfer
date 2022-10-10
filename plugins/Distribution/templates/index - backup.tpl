	<style>

        body{
			font-size: 32px;
			overflow-x: hidden;
		}
		.driver-style{
			color: #4a4536;
			background: #e4ddd5;
			min-height: 8%;
			border: 1px solid #c9c0b5;

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
		.marked{
			font-size: 150%; 
			color: green;
		}
		a{
			color: rgb(70, 68, 68);
		}
		.fa-user{
			color: black;
		}
	
		.additional-dir{
			overflow-x: hidden;
			padding: 0 0 15px 0;
			font-family: "Times New Roman",Arial, sans-serif;
		}

	</style>

    <body>

		<div style="text-align: center;">
			<a class='marked' href='{$root_home}calendar'>Calendar</a>	
			&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;			
			<a href='{$root_home}distribution/{$days[2]}'>
				<i class="fa fa-arrow-left" aria-hidden="true"></i>		
			</a>	

			{section name=pom loop=$days}
				<a {if $days[pom] eq $smarty.request.Date}class='marked'{/if} href='{$root_home}distribution/{$days[pom]}'>
					{$days[pom]}
				</a>
			{/section}

			<a href='{$root_home}distribution/{$days[4]}'>
				<i class="fa fa-arrow-right" aria-hidden="true"></i>		
			</a>
			&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;
			<a class='marked' href='{$root_home}distribution/vehicles'>Vehicles</a>
		</div> <!-- End of text-align: center -->

		<div class="additional-dir">
			<div class="row transfers"> 
			
				<div class="col-md-10">

					{section name=pom1 loop=$drivers}

						<div class="col-md-3 dropzoneN driver-style" data-svid="{$drivers[pom1].SubVehicleID}" data-id="{$drivers[pom1].DriverID}">
							
							<div>{$drivers[pom1].DriverName}</div> 

							<div>

								{if $drivers[pom1].SubVehicleID}	
								<small>
									{$drivers[pom1].SubVehicleDescription} / <i class="fa fa-user"></i>{$drivers[pom1].SubVehicleCapacity}
								</small>
								{/if}

								<i class="fa fa-eye-slash driver_hide"></i>
							</div>	

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

							</div> <!-- /.sort -->
						</div>

					{/section}
					
				</div> <!-- /.col-md-10 -->

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

					</div> <!-- /.sort -->
				</div> <!-- /.col-md-2 -->
				
		
			</div><!-- End of .row transfers -->
		</div><!-- /.additional-dir -->
		

		<script>
		{literal}

			function elementdragg() {

				$(".dropelement").draggable({

					containment: ".additional-dir",
					connectToSortable: "#sorting",
					cursor: 'move',

					drag: function(event, ui) {	
						window.id=$(this).attr('data-id');
					} 
					
				});

			}

			function changeOrder(detailid,driverid,subvehicleid) {
				var link = '{/literal}{$root_home}{literal}plugins/Distribution/update.php';
				var param = "DetailsID="+detailid+"&SubDriverID="+driverid+"&SubVehicleID="+subvehicleid;
				alert (link+'?'+param);
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
					var subvehicleid=$(this).attr('data-svid');

					changeOrder(window.id,driverid,subvehicleid);

					$(".transfers").find("[data-id='" + window.id + "']").appendTo(this);	
					$(".transfers").find("[data-id='" + window.id + "']").removeAttr('style');
					

					if (driverid == 0){
						// From droppable zone:
						// $(".mytooltip").removeClass("mytooltip");
						// $(".transfers").find("[data-id='" + window.id + "']").removeClass("mytooltip");
						$(".mytooltip").popover("close");
					}
					// else {
					// 	// To droppable zone:
						
					// 	// popover().show();
						
					// } 

					

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