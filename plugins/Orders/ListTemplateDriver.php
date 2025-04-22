<?
	foreach($StatusDescription as $nn => $id) {
		$arr_row['id']=$nn;
		$arr_row['name']=$id;
		$arr_all[]=$arr_row;
	}
	$smarty->assign('options',$arr_all);
	
	require_once ROOT.'/db/v4_AuthLevels.class.php';
	$al = new v4_AuthLevels();
	$where = " WHERE AuthLevelID in (2,3,4,5,6,7,12,41,91)";
	$authLevels = $al->getKeysBy('AuthLevelName', 'asc', $where);
	foreach($authLevels as $nn => $id) {
		$al->getRow($id);
		$arr_row['id']=$al->getAuthLevelID();
		$arr_row['name']=$al->getAuthLevelName();
		$arr_all2[]=$arr_row;
	}
	$smarty->assign('options2',$arr_all2);
	
	foreach($PaymentMethod as $nn => $id) {
		$arr_row['id']=$nn;
		$arr_row['name']=$id;
		$arr_all3[]=$arr_row;
	}
	$smarty->assign('options3',$arr_all3);		
	
	foreach($DriverConfStatus as $nn => $id) {
		$arr_row['id']=$nn;
		$arr_row['name']=$id;
		$arr_all4[]=$arr_row;
	}
	$smarty->assign('options4',$arr_all4);	
?>
<script type="text/x-handlebars-template" id="ItemListTemplate">

	{{#each Item}}
		<div class="row {{color}} listTile" style="border-top:5px solid #ddd" id="t_{{DetailsID}}">
			<div class="col-xs-4 col-md-2 col-lg-2">
				<a target="_blank" href="https://wis.jamtransfer.com/plugins/Orders/printTransferDriver.php?DetailsID={{DetailsID}}"><i class="fa fa-print"></i></a>
				<strong>{{OrderID}}-{{TNo}}</strong><br>
				{{MOrderKey}}<br>
				<small>{{displayTransferStatusText TransferStatus}}</small>
			</div>

			<div class="col-xs-8 col-md-2 col-lg-2">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#address{{DetailsID}}">
					<span class="fsize">{{PickupName}}<br>{{DropName}}</span>
				</button><br>
					<!-- Modal content: --------------------------------------- -->
					<div class="modal fade"  id="address{{DetailsID}}">
						<div class="modal-dialog" style="width: fit-content;">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title"><?=ROUTE;?></h4>
								</div>
								<div class="modal-body" style="padding:10px">
									<strong>{{PickupName}}</strong><br>
									{{PickupAddress}}<br>											
									<strong>{{DropName}}</strong><br>
									{{DropAddress}}
								</div>
								<a target='_blank' href='plugins/getRouteMap.php?DetailsID={{DetailsID}}'>
									<i class="fa fa-map" aria-hidden="true"></i> MAP
								</a>
							</div>
						</div>
					</div>
				{{#compare PickupDate ">=" "<?=date('Y')+1;?>-01-01"}}<span class="red-text">{{/compare}}
				{{PickupDate}}
				{{#compare PickupDate ">=" "<?=date('Y')+1;?>-01-01"}}</span>{{/compare}}
				{{PickupTime}}	
			</div>
			
			<div class="col-xs-6 col-md-2 col-lg-2">
				<strong>{{PaxNo}}</strong> pax. &nbsp; <strong>{{DriversPrice}} € </strong><br>
				{{#compare VehicleClass "<" 10}}
					<i class="fa fa-car"></i>
				{{/compare}}
				{{#compare VehicleClass ">" 9}}
					{{#compare VehicleClass "<" 20}}
						<i class="fa fa-car indigo-text"></i>
					{{/compare}}
				{{/compare}}
				{{#compare VehicleClass ">" 19}}
					<i class="fa fa-car purple-text"></i>
				{{/compare}}
				{{VehicleTypeName}}  x {{VehiclesNo}}<br>
				{{ vehicleDriverSelect Car 'Car' DetailsID}}	


				{{#compare DriverNotes "!==" ""}}
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#notes{{DetailsID}}">
						<i class="fa fa-envelope" style="color:#900"></i>
					</button>
					<div class="modal fade"  id="notes{{DetailsID}}">
						<div class="modal-dialog" style="width: fit-content;">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body" style="padding:10px">
									{{DriverNotes}}
								</div>
							</div>
						</div>
					</div>							
				{{/compare}}	
			</div>	

			<div class="col-xs-6 col-md-2 col-lg-2">
				<i class="fa fa-user"></i> <strong>{{PaxName}}</strong><br>
				{{#compare DriverConfStatus ">" 1}}
				<small>
					<i class="fa fa-phone"></i> <a href="tel:+ {{MPaxTel}}"> {{MPaxTel}}</a>
				</small><br>	
				{{/compare}}
				<a href="{{FsLink}}" target="_blank"> {{FlightNo}}</a> {{FlightTime}}
				{{#compare ExtraCharge ">" 0}}
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#extras{{DetailsID}}">
						<i class="fa fa-cubes" style="color:#900"></i>
					</button>
					<div class="modal fade"  id="extras{{DetailsID}}">
						<div class="modal-dialog" style="width: fit-content;">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title"><?=EXTRAS;?></h4>
								</div>
								<div class="modal-body" style="padding:10px">
									{{#if oeServices}}
										<br>
										<div class="row">
											<div class="col-md-12">
												{{#each oeServices}}
													{{ServiceName}} x {{Qty}}
													<br>
												{{/each}}
											</div>
										</div>
									{{/if}}
								</div>
							</div>
						</div>
					</div>							
				{{/compare}}				
			</div>
	
			<div class="col-xs-6 col-md-2 col-lg-2">
				{{paymentMethodText PaymentMethod}}<br>
				{{#compare PayLater ">" 0}}<strong>{{PayLater}} € </strong><br>{{/compare}}
			</div>						
			
			<div class="col-xs-6 col-md-2 col-lg-2">
				<span class="{{driverConfStyle DriverConfStatus}}">{{driverConfText DriverConfStatus}}</span>
				{{#compare DriverConfStatus "==" 1}}
				{{#compare TransferStatus "!=" 3}}
					<br>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#confirm{{DetailsID}}">
						<?=CONFIRM;?> / <?=DECLINE;?>
					</button>
					<div class="modal fade"  id="confirm{{DetailsID}}">
						<div class="modal-dialog" style="width: fit-content;">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title"><?=CONFIRM;?></h4>
								</div>
								<div class="modal-body" style="padding:10px">
									<div class="row" id="confirmDecline{{DetailsID}}">
										<div class="col-md-12">
											<br>
											<small><?= CONFIRM_DECLINE_INSTRUCTIONS ?></small>
											<br><br>
										</div>
										<div class="col-md-12">
											<form action="" method="post" enctype="multipart/form-data" 
											onsubmit="return false;">
												<?= THIS_INFO_WILL_BE_SENT_TO_CUSTOMER ?>
												<br><br>
												<div class="row">
													<div class="col-md-2"><label><?= DRIVER_NAME ?></label></div>
													<div class="col-md-8">
														<input class="form-control" type="text" 
														id="SubDriverName" placeholder="Please put DRIVERS NAME or OPERATOR (do not put YOUR COMPANY name)" value="{{SubDriverName}}" onfocus="if (this.value=='Please put DRIVERS NAME or OPERATOR (do not put YOUR COMPANY name)') this.value='';">
													</div>
												</div>
												<div class="row">
													<div class="col-md-2"><label><?= DRIVER_TEL ?></label></div>
													<div class="col-md-8">
														<input class="form-control" type="text" 
														id="DriverTel" placeholder='International format (e.g +33...)' value="{{SubDriverMob}}" onfocus="if (this.value=='Please put phone number in international format (e.g +33...)') this.value='';">
													</div>
												</div>
												
												<div class="row">
													<div class="col-md-2"><label><?= PICKUP_POINT ?></label></div>
													<div class="col-md-8">
														<textarea class="form-control" cols="40" 
														rows="5" name="PickupPoint"
														id="PickupPoint"></textarea>
													</div>
												</div>											
												<div id="drr" class="row" style="display:none">
													<div class="col-md-2"><label>Decline reason</label></div>
													<div class="col-md-8">
														<select name="DeclineReason" id="DeclineReason">
															<option value="cr">Choose reason</option>													
															<option value="Price">Price incorect</option>	
															<option value="Availability">No availability</option>														
															<option value="Wrong">Wrong reservation details</option>													
															<option value="Other">Other</option>
														</select>			
													</div>
												</div>											
												<div id="dm" class="row" style="display:none">
													<div class="col-md-2"><label>Decline message</label></div>
													<div class="col-md-8">
														<textarea id= 'dmta' class="form-control" cols="40" 
														rows="5" name="DeclineMessage"
														id="DeclineMessage"></textarea>
													</div>
												</div>												
												<div class="row">
													<div class="col-md-12">
													<span>&nbsp Please, CHECK this transfer details before confirming transfer request!</span> 
													<br>
													<br>
													<button class="btn btn-success" type="submit"
													onclick="confirmTransfer('{{DetailsID}}','{{DriverID}}','{{MOrderKey}}')">
														<i class="fa fa-check l"></i> <?= CONFIRM ?>
													</button>
													<!-- novi blok !-->
													<button id='decline1' class="btn btn-danger" type="submit" 
													onclick="declineTransfer1()">
														<i class="fa fa-remove l"></i> <?= DECLINE ?>
													</button>
													
													<button id='decline2' class="btn btn-danger" type="submit" style="display:none; "
													onclick="declineTransfer2('{{DetailsID}}','{{DriverID}}','{{MOrderKey}}')" >
														<i class="fa fa-remove l"></i> <?= DECLINE ?>
													</button>											
													<!-- kraj bloka !-->
													</div>		

												</div>			
											</form>
										</div>
									</div>										
								</div>
							</div>
						</div>
					</div>	
				{{/compare}}						
				{{/compare}}	
				{{#compare DriverConfStatus ">" 1}}{{#compare DriverConfStatus "<" 4}}
					<small>{{DriverConfDate}} {{DriverConfTime}}</small><br>
					{{#compare showMarkCompleted "==" 1}}{{#compare TransferStatus "==" 1}}
					<button  type="button" class="btn btn-primary mac" data-toggle="modal" data-target="#complete{{DetailsID}}">
						<?=FINISH_TRANSFER;?>
					</button>
					<div class="modal fade"  id="complete{{DetailsID}}">
						<div class="modal-dialog" style="width: fit-content;">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title"><?=FINISH_TRANSFER;?></h4>
								</div>
								<div class="modal-body" style="padding:10px">
									<button id='mac' class="btn btn-default" onclick="changeDriverConfStatus('{{DetailsID}}', '7');" >		 
										<i class="fa fa-check-circle l"></i> <?= MARK_COMPLETED ?>
									</button>	

									<button class=" btn btn-default" onclick="$('#noShow').show('slow');">
										<i class="fa fa-minus-square l"></i> <?= MARK_NOSHOW ?> / <?= MARK_DRIVER_ERROR ?>
									</button>

									<div class="row ">
										<div id="noShow" class="col-md-12" style="display:none">
											<br><?= DETAIL_DESCRIPTION ?>:<br>
											<textarea name="FinalNote" id="FinalNote" rows="5">{{FinalNote}}</textarea>
											<button class="btn btn-primary" 
												onclick="changeDriverConfStatus('{{DetailsID}}', '5');$('#btnSave').click();">
												<i class="fa fa-minus-square l"></i> <?= MARK_NOSHOW ?>
											</button>
											<button class="btn btn-danger" 
												onclick="changeDriverConfStatus('{{DetailsID}}', '6');$('#btnSave').click();">
												<i class="fa fa-taxi l"></i> <?= MARK_DRIVER_ERROR ?>
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>	
					{{/compare}}{{/compare}}
				{{/compare}}{{/compare}}			
				{{#compare FinalNote "!==" ""}}
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#fnotes{{DetailsID}}">
						<i class="fa fa-envelope" style="color:#900"></i>
					</button>
					<div class="modal fade"  id="fnotes{{DetailsID}}">
						<div class="modal-dialog" style="width: fit-content;">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body" style="padding:10px">
									{{FinalNote}}
								</div>
							</div>
						</div>
					</div>							
				{{/compare}}
			</div>							
		</div>
	{{/each}}
	<script>
		// Change the icon and sorting:
		async function setSort(field,direction) {
			$('#sortField').val(field);
			$('#sortDirection').val(direction);
		}	
		function allSort(field,direction) {	
			setSort(field,direction).then(function() {allItems();});
		}	
		function confirmTransfer(detailsid, driverid, orderkey) {
			
			// mesto + u telefonu
			var tel = $("#DriverTel").val() ;
			var n = tel.indexOf('+');
			if($("#DriverTel").val() == '') {
				alert('Enter Driver name and Telephone number!');
				return false;
			}
			// da li je ispravan format?
			if (n != 0) {
				alert ('Enter Phone number in right format starting with country code (+___)');
				return false;
			}	
			var url = './plugins/Orders/confirmDecline.Driver.php'+
				"?code=" + detailsid +
				"&control="+orderkey +
				"&id="+ driverid +
				"&SubDriverName="+ $("#SubDriverName").val() +
				"&DriverTel="+ $("#DriverTel").val() +
				"&PickupPoint="+ $("#PickupPoint").val() +
				"&Confirm=Confirmed";
			console.log(url);
	
			$.ajax({
				type: 'POST',
				url: url,
				async: true,
				success: function(data) {
					$.toaster('Transfer Confirmed', 'Done', 'success blue-2');
					location.reload();
				}
			});
			
			return false;				
			
		}
		
		// prosirivanje forme sa decline poljima
		function declineTransfer1(detailsid, driverid, orderkey) {
			
			$("#decline1").hide();
			$("#decline2").show();
			$("#drr").show(500);		
		}	
		$('#dmta').attr("placeholder","Your reason is:");	// privremeno, posle izbrisati
		$('#DeclineReason').change(function(){ 
			var rn = $('#DeclineReason').val(); 
			if (rn=='Price') $('#dmta').attr("placeholder","Your price is:");
			if (rn=='Availability') $('#dmta').attr("placeholder","Your time is:");
			if (rn=='Wrong') $('#dmta').attr("placeholder","Wrong details is:");
			if (rn=='Other') $('#dmta').attr("placeholder","Your reason is:");			
			$("#dm").show(500);			
		}); 
		
		// decline
		function declineTransfer2(detailsid, driverid, orderkey) {
			var dmta = $("#dmta").val();
			dmta = dmta.trim();
			if(dmta == '') {
				alert('Enter Decline reason and message!');
				return false;
			}
			  
			var declinereason = $('#DeclineReason').val();
			var declinemessage = $('#dmta').val();
			var url = './plugins/Orders/confirmDecline.Driver.php'+
				"?code=" + detailsid +
				"&control="+orderkey +
				"&id="+ driverid +
				"&DeclineReason="+ declinereason +				
				"&DeclineMessage="+ declinemessage +		
				"&Confirm=Declined";
			$.ajax({
				type: 'POST',
				url: url,
				async: true,
				success: function(data) {
					$.toaster('Transfer Declined', 'Done', 'success red');
					location.reload();
				}
			})
			return false;
		}		
		// changeDriverConfStatus
		function changeDriverConfStatus(detailsid, newstatus) {
			var FinalNote=$("#FinalNote").val();
			var url = './plugins/Orders/changeDriverConfStatus.php'+
				"?DetailsID=" + detailsid +
				"&NewStatus="+newstatus +
				"&FinalNote="+FinalNote;
			console.log(url); 
			$.ajax({
				type: 'POST',
				url: url,
				async: true,
				success: function(data) {
					$.toaster('Status changed', 'Done', 'success blue-2');
					location.reload();
				}
			})
			return false;
		}
		$('.Car').change(function(){
			var thiscar=$(this);
			var sd=$('option:selected',this).val();
			var detailsid = ($(this).attr('data-detailsid'));
			var url = './plugins/Orders/changeSubVehicle.php'+
				"?DetailsID=" + detailsid +
				"&SubDriverID="+sd;
			console.log(url);
			$.ajax({
				type: 'POST',
				url: url,
				async: true,
				contentType: 'application/json',
				
				success: function(data) {
					data = $.parseJSON(data);
					thiscar.parent().parent().find("#SubDriverName").val(data.username);
					thiscar.parent().parent().find("#DriverTel").val(data.phone);
					$.toaster('Vehicle changed', 'Done', 'success blue-2');
					
				}
			})
		})	
	</script>	
</script>

