	<style>

		body{
			font-size: 22px;
			overflow-x: hidden;
		}

		.vehicles {
			/* float: left; */
			overflow: hidden;
			background: #05e4fd0d;
			padding: 5px;
			border-radius: 5px;
		}

		.vehicles h2{
			font-weight: bold;
			color: #5c9dbd;
		}
		
		.drop-wrapper{
            width: 75%;
			padding:0 0 40px 0;
			float: left;
        }

		.drop-wrapper h3, .drag-wrapper h3{
			font-size: 19px;
			padding: 5px;
			color: #64b1d7;
        }

		.drop-wrapper .dropzoneN, .drop-wrapper .dropin{
			color: #576f95;
			background: #8a9ebf1c;
			min-height: 5%;
			border: 1px solid #576f95a3;
			border-radius: 10px;
			min-width: 32%;
			float: left;
			font-family: Georgia, serif;
			padding: 5px;
			margin: 2px;
        }

		.drag-wrapper{
            float: left;
            width: 20%;
			min-height:100vh;
			box-sizing: border-box;
			background: #c1ccdb33;
        }

		.dropelement {
			border: 2px solid rgb(202 199 100);
			border-radius: 8px;
			margin: 0 10px 5px 10px;
			padding: 5px;
			background: #e4e9c04f;
			box-shadow: 3px 2px 7px 2px #b2b3b3;
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
        <div class="vehicles">
			<h2>{$ASSIGN_VEHICLES}</h2>
			<div class="drop-wrapper">
				
				<h3>{$DRIVERS}:</h3>
				{$driverSettingsExist}
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
								{$vehicles[pom1].VehicleDescription}-{$vehicles[pom1].Year} / <i class="fa fa-user"></i>{$vehicles[pom1].VehicleCapacity} 
							</div>
						</div>
					{/if}
				{/section}
				
			</div> <!-- End of drag-wrapper -->
		<input type="hidden" id="mobile" name="mobile" value="{$MOBILE}">	
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

			var mobile=$("#mobile").val();
			if (mobile) {
				$(".dropelement").click(function(){
					$(this).css('color','green');
					window.vid=$(this).attr('data-id');
					changeOrder(window.vid,0);
					if ($(this).parent().attr('data-id')>0) {
						location.reload();
					}
				})			
				$(".dropzoneN").click(function(){
					if ($(this).attr('data-id')>0) {
						window.sdid=$(this).attr('data-id');
						changeOrder(window.vid,window.sdid);
						location.reload();
					}
				})
			}

		{/literal}
		</script>	
    
    </body>
