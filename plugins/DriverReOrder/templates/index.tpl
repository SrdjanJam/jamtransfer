
<input type='hidden' name="OrderID" id="OrderID" value="<?= $_REQUEST['OrderID'] ?>">
<input type='hidden' name="TNo" id="TNo" value="<?= $_REQUEST['TNo'] ?>">
<input type='hidden' name="returnTransfer" id="returnTransfer" value="<?= $returnTransfer ?>">
<body  style="">
	<div class="">
		<div class="container-fluid side-collapse-container center" >
			
			<div class="row xpad1em white-text">

				<div class="row z-depth-2 white lighten-5">			
						<h3>{$ORDER}: <?= $od->getOrderID() ?>-<?= $od->getTNo() ?> Route: <?= $od->getPickupName() ?> - <?= $od->getDropName() ?></h3>
						
						
				</div>
				<hr>

			</div>			
			
			<div class="row xpad1em white-text">

				<div class="row z-depth-2 white lighten-5">			
					<div class="col-md-3">
						<h4>{$BOOKED_DRIVER}</h4>							 					
						<h3><b style='color:blue'><?= $driverName ?></b></h3>
					</div>				
					<div class="col-md-3"> 
						<h4>{$BOOKED_PRICE}: <?= number_format($DetailPrice,2) ?></h4>							 						
						<h4>{$DRIVERS_PRICE}: <?= number_format($DriversPrice2,2) ?></h4>
					</div>						
					<div class="col-md-3">						
						<h4>{$BOOKED_VEHICLE}</h4>							 										
						<img class="" src="<?= $vehicleImage ?>" style="max-height:20%; max-width:20%;" alt="car">
						<span style="text-transform:uppercase; font-weight:100 !important"><?= $vt->getVehicleTypeName() ?></span>
					</div>							
					<div class="col-md-3"> 
						<h4>{$VEHICLES}</h4>							 
						<h3><?= $od->getVehiclesNo() ?></h3>							 						
					</div>							
				</div>
				<hr>

			</div>
			

			
			<div class="row z-depth-2 white lighten-5 center">
				<div class="col-md-5 white">
					<h4>{$OTHER_DRIVER_FOR_THIS_ROUTE}</h4>						
				</div>	
				<div class="col-md-3 white">
					<h4>{$VEHICLE_TYPE}</h4>						
				</div>					
							
				<div class="col-md-2 request">
					<h4>{$FIRST_CONFIRM_REQUEST}</h4>											
				</div>				
				<div class="col-md-2 request">
					<h4>{$LOW_OFFER_REQUEST}</h4>											
				</div>				
			</div>			
			
			<h4>{$SELECT_TERMINAL_FOR_THIS_TRANSFER}</h4>
			
			
			<? 	
			if ($TerminalID==0) {
				$q="SELECT FromID,PlaceNameEN, count(*) FROM v4_Routes,v4_Places WHERE (`FromID`=".$od->getPickupID()." or `ToID`=".$od->getPickupID()." or `FromID`=".$od->getDropID()." or `ToID`=".$od->getDropID().") and v4_Places.PlaceID=v4_Routes.FromID and `PlaceType`= 1 group by FromID";
				$r = $db->RunQuery($q);
				if($r->num_rows > 0 ){
					echo "<h4><?=SELECT_TERMINAL_FOR_THIS_TRANSFER:?></h4>";
					while($tid = $r->fetch_object() ){
						echo "<a href='/cms/p/modules/transfers/DriverReOrder.php?OrderID=".$od->getOrderID()."&TNo=".$od->getTNo()."&TerminalID=".$tid->FromID."'>".$tid->PlaceNameEN."</a><br>";
					}
				}					
			}			
			
			
			foreach($dtKey as $dtID) {

					
								?>				

								<!-- CAR PANEL -->
								<div class="row white lighten-5">
									<div class="col-md-5 white">
										<b style='color:blue'><? echo $au->getAuthUserRealName(); ?></b>
									</div>
									<div class="col-md-3">
										<? 
										foreach($vhKey as $vhID) {
											$vh->getRow($vhID);

											echo getVehicleTypeName($vh->getVehicleTypeID());
											echo "<br>";
										
										}
										?>
								
									</div>								

									<div class="col-md-2 fc">
										<? echo $content1 ?>
									</div>
									<div class="col-md-2 lo">
										<?  echo $content2 ?>
									</div>				
								</div>
								<hr>
								<!-- main car panel div -->
							

								<?			
				}			
			}
?>

		</div>
	</div>	
</body>	



<script>

	setTimeout(function(){
	  window.location.reload(1);
	}, 300000);
	
	$('.request').click(function(){
		var driverid = $(this).attr('data-driverid');
		var rt = $(this).attr('data-rt');
		var OrderID=$('#OrderID').val();
		var TNo=$('#TNo').val();
		var returnTransfer=$('#returnTransfer').val();
		var param = 'DriverID='+driverid+'&requestType='+rt+'&OrderID='+OrderID+'&TNo='+TNo+'&returnTransfer='+returnTransfer;
		var url = '/cms/p/modules/transfers/requestOrder.php?'+param;
		console.log (url);
		$.ajax({
			type: 'POST',
			url: url,
			async: false,

			success: function(data) {
				var result = JSON.parse(data);				
				var DriverID=result['DriverID'];
				var requestType=result['requestType'];
				$('.request').each(function(){
					if ($(this).attr('data-driverid')==DriverID && $(this).attr('data-rt')==requestType) {
						$(this).prop("disabled",true);
					}
				});
				
			},
			error: function(xhr, status, error) {alert("Error occured: " + xhr.status + " " + xhr.statusText); }
		});
			
			
		})	

	

</script>

