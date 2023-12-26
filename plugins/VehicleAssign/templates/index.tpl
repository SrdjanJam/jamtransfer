	<style>

        body{
			font-size: 22px;
			overflow-x: hidden;
		}

		.vehicles{
			float:left;
		}
		
		.drop-wrapper{
            width: 60%;
			padding:0 0 40px 0;
			float: left;
        }

		.drop-wrapper .dropzoneN, .drop-wrapper .dropin{
			color: #5e5b53;
    		background: #f7f4f1;
            min-height: 5%;
			border: 1px solid #ebe9e8;
			width:25%;
			float:left;
			font-family: Georgia, serif;
        }

		.drag-wrapper{
            float: left;
            width: 40%;
			min-height:100vh;
			box-sizing: border-box;
        }

		.dropelement {
			color: black;
            border: 2px dashed rgb(192, 202, 100);
			margin: 5px;
			float:left;
			width:45%; 
        }

        .drop-wrapper .dropelement {
			width:90%;
			font-size:14px;
			margin: 0 0 5px 15px;
			background: rgb(213, 216, 164); 

        }
		
		.ui-draggable-dragging{
            background: rgb(213, 216, 164);
            z-index: 3;
			position:relative;
        }

        .marked{
			font-size: 150%; 
			color: green;
		}

		.fa-user{
			color: rgb(133 134 145);
		}

		/* @media screen ========================= */
		@media screen and (max-width:1200px) {

			.drop-wrapper, .drop-wrapper .dropzoneN, .drag-wrapper {
				float: none;
				width:100%;
			}


		}

	</style>

    <body>

        <div class="vehicles"> 
		
			<div class="drop-wrapper">
				<h3>{$DRIVERS}:</h3>

				{section name=pom1 loop=$drivers} {* $vehicles changes to $drivers *}
					
					<div 
				class="{if $drivers[pom1].SubVehicleID eq 0}dropzoneN{else}dropin{/if}" 
					data-id="{$drivers[pom1].DriverID}">
						{$drivers[pom1].DriverName} <i class="fa fa-eye-slash driver_hide"></i>

						{if $drivers[pom1].SubVehicleID gt 0}
							<div class="dropelement" data-id="{$drivers[pom1].SubVehicleID}">
								{$drivers[pom1].SubVehicleDescription}  / <i class="fa fa-user"></i>{$drivers[pom1].SubVehicleCapacity}
							</div>
						{/if}
					</div>
				{/section}
				
			</div> <!-- End of drop-wrapper -->

			<!-- For drop: -->
			<div class="drag-wrapper sort dropzoneN" data-id='0'>
				<h3>{$VEHICLES}:</h3>

				{section name=pom1 loop=$vehicles}
					{if $vehicles[pom1].SubDriver eq 0}
						<div class="dropzoneN" data-id='0'>
							<div class="dropelement" data-sort="{$vehicles[pom1].VehicleCapacity}" data-id="{$vehicles[pom1].VehicleID}">
								{$vehicles[pom1].VehicleDescription} / <i class="fa fa-user"></i>{$vehicles[pom1].VehicleCapacity}
							</div>
						</div>
					{/if}
				{/section}
				
			</div> <!-- End of drag-wrapper -->
	
		</div> <!-- End of vehicles -->
		

		<script>
		{literal}

			function elementdragg() {
				// elementdragg method
				$(".dropelement").draggable({
					containment: '.vehicles',
					connectToSortable: '#sorting',
					cursor: 'move',
					scroll: false,
					revert: 'invalid',

					drag: function(event, ui) {	
						window.id=$(this).attr('data-id');
					} 
					
				});
			} // End of elementdragg method

			// function revertInvalid(){
			// 	$(".dropelement").draggable({ 
			// 		revert: 'invalid'
			// 	});	
			// }

			// changeOrder:
			function changeOrder(vehicleid,driverid) {
				var link = '{/literal}{$root_home}{literal}plugins/VehicleAssign/updateVehicles.php';
				var param = "SubVehicleID="+vehicleid+"&SubDriverID="+driverid;
				console.log(link+'?'+param);
				$.ajax({
					type: 'POST',
					url: link,
					data: param,
				});
			}

			elementdragg();

			$(".dropzoneN").droppable({
				
				drop: function(event, ui) {
					// location.reload();
					
					var driverid=$(this).attr('data-id');
					
					changeOrder(window.id,driverid);

					// alert($(this).attr('data-id'));

					// if dropelement exists:
					if ($(this).find('.dropelement').length){
						if($(this).attr('data-id') > 0){
							
							// alert('Vozilo je vec dodano');
							location.reload();
							
						} else{
							addVehicle(this);
						}
					
					} else{
						addVehicle(this);
					}

					function addVehicle(item){
					
					// Append to:
					$(".vehicles").find("[data-id='" + window.id + "']").appendTo(item);
					// Remove style:
					$(".vehicles").find("[data-id='" + window.id + "']").removeAttr('style');
					
					

					// Sorting:
					var result = $(item).find('.dropelement').sort(function (a, b) {
						var contentA =parseInt( $(a).data('sort'));
						var contentB =parseInt( $(b).data('sort'));
						return (contentA < contentB) ? -1 : (contentA > contentB) ? 1 : 0;
					});

					$(item).find('.sort').html(result);	

					elementdragg();
					
					// $(item).addClass('dropin');
					// $(item).removeClass('dropzoneN');
					// $(item).removeClass('ui-droppable');
					// $(item).addClass('dropin');
					// $(item).css('background','red');
					// revertInvalid();
					}
				}	
			}); // End of droppable method

			$(".driver_hide").click(function(){
				$(this).parent().hide(300);
			});

		{/literal}
		</script>	
    
    </body>
