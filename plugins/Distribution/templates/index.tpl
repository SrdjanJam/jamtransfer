	<style>

        body{
			font-size: 22px;
			overflow-x: hidden;
		}

		.transfers{
			overflow: hidden;
		}
/* ----------------------------------------------- */
/* Drop - left side: */
		.drop-wrapper{
            width: 75%;
			padding:0 0 40px 0;
			float: left;
        }

		.drop-wrapper h3, .drag-wrapper h3{
            font-weight: bold;
			font-size: 20px;
			padding: 5px;
        }

		.drop-wrapper .dropzoneN {
			color: #5e5b53;
    		background: #0000000a;
            min-height: 8%;
			border: 1px solid #5e5b5382;
			border-radius: 10px;
			width:24%;
			float:left;
			font-family: Georgia, serif;
			padding: 5px;
			margin: 2px;
        }

		.drop-wrapper .dropzoneN .sort .dropelement{
			font-size: 14px;
        }

		.drop-wrapper .dropzoneN .sort .dropelement .top-line{
			font-size: 20px;
        }

		.dropelement {
			border: 2px solid rgb(100, 202, 105);
    		border-radius: 8px;                  
    		margin: 0 10px 5px 10px;
    		padding: 5px;
			background: #c8cbb14f;
			box-shadow: 4px 3px 13px 5px #91b6b4;
        }

		.drop-wrapper .dropelement {
			width:95%;
			font-size: 12px;
			background: rgb(164, 216, 164);
        }
/* ----------------------------------------------- */
/* Drag - right side: */
		.drag-wrapper{
            float: left;
            width: 25%;
			min-height:100vh;
			background: #b1d3e961;
			border-radius: 7px;
        }

		.drag-wrapper.dropzoneN{
            font-size:20px;
        }
/* ------------------------------------------------- */
/* draggable-dragging: */
		.ui-draggable-dragging{
            background: rgb(164, 216, 164);
            z-index: 3;
			position:relative;
        }
/* ------------------------------------------------- */
		.marked{
			font-size: 150%; 
			color: green;
		}

		.fa-user{
			color: rgb(46, 52, 114);
		}
	
		@media screen and (max-width:768px) {

			.drop-wrapper, .drop-wrapper, .drag-wrapper {
				/* width: -webkit-fill-available; */
				width: 50%;
			}

			.drop-wrapper .dropzoneN{
				width: -webkit-fill-available;
			}
		}
	</style>

    <body>

		<div style="text-align: center;">
			<a class='marked' href='{$root_home}calendar'>{$CALENDAR}</a>	
			{*&nbsp;&nbsp;&nbsp;&nbsp;
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
			</a>*}
			<input type="text" id="PickupDate" name="PickupDate" class="w75 datepicker" value="{$smarty.request.Date}">
			<button type="button" class="btn btn-primary btn-primary-edit workingtime workingtime-edit" data-date="{$smarty.request.Date}" data-userid="{$smarty.session.UseDriverID}">
				{$SET_WT}
			</button>				
		</div> <!-- End of text-align: center -->

		<div class="transfers">
<!-- Drop - left side: ========================================================== -->
			<div class="drop-wrapper ">
				<h3>{$DRIVERS}:</h3>
				{$driverSettingsExist}
				{section name=pom1 loop=$drivers}
					<div class="dropzoneN dropDrivers" data-svid="{$drivers[pom1].SubVehicleID}" data-id="{$drivers[pom1].DriverID}">
						
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
									<!--dropelement -->
									<div data-sort="{$transfers[pom2].PickupTime}" class="dropelement"  data-id="{$transfers[pom2].DetailsID}">
										<span
											title="<b>{$transfers[pom2].OrderID}-{$transfers[pom2].TNo} - {$transfers[pom2].PaxName} </b>" 
											data-content="
												<br/>{$FLIGHT_NO}: {$transfers[pom2].FlightNo}
												<br>{$FLIGHT_TIME}: {$transfers[pom2].FlightTime}
											" 
											class="mytooltip">						
											<div class="top-line">
												<strong>{$transfers[pom2].PickupTime}</strong>
												<i class="fa fa-car"></i><span>{$transfers[pom2].VehicleType}</span>							
												<strong>{$transfers[pom2].OrderID}-{$transfers[pom2].TNo}</strong> 
												<i class="fa fa-user"></i><span>{$transfers[pom2].PaxNo}</span>
											</div>

											<div>{$transfers[pom2].PickupName}-{$transfers[pom2].DropName}</div>
											
											<div>
												{if not isset($smarty.request.Date)}{$transfers[pom2].PickupDate}{/if} 
												{* <strong>{$transfers[pom2].PickupTime}</strong>
												<i class="fa fa-car"></i><span>{$transfers[pom2].VehicleType}</span>							 *}
											</div>
										</span>
									</div>

								{/if}
							{/section}

						</div> <!-- /.sort -->
					</div> <!-- /.dropzoneN -->

				{/section}
			
			</div> {* /.drop-wrapper *}

<!-- Drag - right side: ========================================================== -->
			<div class="drag-wrapper dropzoneN" data-id='0' data-svid='0'>
				<h3>{$ORDERS}:</h3>
				<div class="sort">

					{section name=pom1 loop=$transfers}
						{if $transfers[pom1].SubDriver eq 0}	

							<div data-sort="{$transfers[pom1].PickupTime}" class="dropelement"  data-id="{$transfers[pom1].DetailsID}">
								<span
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
										{* <strong>{$transfers[pom1].PickupTime}</strong> *}
										{* <i class="fa fa-car"></i><span>{$transfers[pom1].VehicleType}</span>							 *}
									</div>
								</span>
							</div>
						{/if}
					{/section}

				</div> <!-- /.sort -->
			</div> <!-- /.drag-wrapper -->
			<input type="hidden" id="mobile" name="mobile" value="{$MOBILE}">	
		</div><!-- End of .transfers -->
		
		<script>
		{literal}
			$("#PickupDate").change(function(){
				window.location.href = "{/literal}{$currenturl}{literal}/"+$("#PickupDate").val();
			})
			$('.workingtime').click(function(){
				var date=$(this).attr('data-date');
				var userid=$(this).attr('data-userid');
				var url="plugins/LogEvidence/makeDriversShift.php";
				var param = "DriverID="+userid+"&Date="+date;
				console.log(url+'?'+param);
				$.ajax({
					url: url,
					type: "POST",
					data: param,
					success: function (data) {
						if(data && data !="") alert(data);
						toastr['success'](window.success);	
					}
				})		
			})		
			$("document").ready(function(){
				hideDrivers();	
			})
			// hide drivers if is not available transfers on the right
			function hideDrivers() {
				if ($(".drag-wrapper").children(".sort").children().length == 0) {
					$(".dropDrivers").each(function() {
						if ($(this).children(".sort").children().length == 0) {
							$(this).hide();
						}

					})
				}	else {
					$(".dropDrivers").show();
				}	
				
			}
			// elementdragg method
			function elementdragg() {

				$(".dropelement").draggable({
					containment: ".transfers",
					connectToSortable: "#sorting",
					cursor: 'move',
					scroll: false,
					revert: 'invalid',

					drag: function(event, ui) {	
						window.id=$(this).attr('data-id');
						$(".mytooltip").popover('hide');
					}
					
				});
			} // End of elementdragg method

			// popUp method:
			function popUp(){
				$(".mytooltip").popover({trigger:'hover', html:true,container: '.drop-wrapper', placement:'auto bottom'});
			}

			// changeOrder:
			function changeOrder(detailid,driverid,subvehicleid) {
				var link = '{/literal}{$root_home}{literal}plugins/Distribution/update.php';
				var param = "DetailsID="+detailid+"&SubDriverID="+driverid+"&SubVehicleID="+subvehicleid;
				//alert (link+'?'+param);
				$.ajax({
					type: 'POST',
					url: link,
					data: param,
				});
			}

			elementdragg();
			popUp();

			// droppable method
			$(".dropzoneN").droppable({

				drop: function(event, ui) {

					var driverid=$(this).attr('data-id');
					var subvehicleid=$(this).attr('data-svid');

					changeOrder(window.id,driverid,subvehicleid);
					// Append to:
					$(".transfers").find("[data-id='" + window.id + "']").appendTo(this);
					// Remove style:
					$(".transfers").find("[data-id='" + window.id + "']").removeAttr('style');
					
					
					// Sorting:
					var result = $(this).find('.dropelement').sort(function (a, b) {
						var contentA =parseInt( $(a).data('sort'));
						var contentB =parseInt( $(b).data('sort'));
						return (contentA < contentB) ? -1 : (contentA > contentB) ? 1 : 0;
					});

					$(this).find('.sort').html(result);	

					elementdragg();	
					popUp();
					hideDrivers();
				}

			}); // End of droppable method


			$(".driver_hide").click(function(){
				$(this).parent().parent().hide(300);
			});

			var mobile=$("#mobile").val();
			if (mobile) {
				$(".dropelement").click(function(){
					$(this).css('color','green');
					window.vid=$(this).attr('data-id');
					changeOrder(window.vid,0,0);
					if ($(this).parent().parent().attr('data-id')>0) {
						location.reload();
					}
				})			
				$(".dropzoneN").click(function(){
					if ($(this).attr('data-id')>0) {
						var sdid=$(this).attr('data-id');
						var subvehicleid=$(this).attr('data-svid');
						changeOrder(window.vid,sdid,subvehicleid);
						location.reload();
					}
				})
			}

		{/literal}
		</script>	
    
    </body>
