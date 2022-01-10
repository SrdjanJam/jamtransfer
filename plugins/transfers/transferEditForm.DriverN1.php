<?
# FRANCUSKA FIX
$SAuthUserID = $_SESSION['AuthUserID'];
$fakeDriver = false;
require_once ROOT . '/cms/fixDriverID.php';
foreach($fakeDrivers as $key => $fakeDriverID) {
    if($SAuthUserID == $fakeDriverID) {
        $SAuthUserID = $realDrivers[$key];
        $fakeDriver = true;
    }
}
?>
<script type="text/x-handlebars-template" id="transferTemplate">

<form id="transferEditForm{{details.DetailsID}}" class="form box box-solid" onsubmit="return false;">

	<input type="hidden" name="UserName" value="<?= $_SESSION['UserName']?>">
	<input type="hidden" name="AuthUserID" value="<?= $SAuthUserID?>">

	<div class="box-header">
		<div class="box-title">
			<h3><?= EDIT.B.TRANSFER ?>  {{details.OrderID}}-{{details.TNo}}  [{{details.PaxName}}]</h3>
		</div>
		<div class="box-tools pull-right">
			<span id="statusMessage" class="text-info xl"></span>
			<? if ($inList=='true') { ?>
				<button class="btn " title="<?= CLOSE ?>" 
				onclick="return editClose('{{details.DetailsID}}');">
				<i class="fa fa-chevron-up l""></i>
				</button>
			<? } ?>
			
			<button class="btn btn-info" id="btnSave" title="<?= SAVE ?>" 
			onclick="return editSave('{{details.DetailsID}}', <?= $inList ?>);">
			<i class="fa fa-save l"></i>
			</button>

			<a href="printTransferDriver.php?DetailsID={{details.DetailsID}}" class="btn btn-danger" title="<?= PRINT_CONFIRMATION ?>" target="_blank">
			<i class="fa fa-print l"></i>
			</a>
            
			{{#compare details.InvoiceAmount "==" 0}}
		        <a href="http://www.jamtransfer.com/cms/fr/racun.php?id={{details.DetailsID}}" class="btn btn-success" 
		        title="<?= PRINT_RECEIPT ?>" target="_blank">
		        <i class="fa fa-money l"></i>
		        </a>
			{{/compare}}
			
		</div>
	</div>

	<div class="box-body">
		<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1{{details.DetailsID}}" data-toggle="tab"><?= TRANSFER ?></a></li>

            </ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_1{{details.DetailsID}}">		
					<div class="row">
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-3 "><label><?= ID ?></label></div>
								<div class="col-md-9">
									  <strong>{{details.OrderID}}-{{details.TNo}}</strong> 
									  <? /* josip - 02.02.2017 
									  {{#each details.RelatedTransfers}}
									  	<i class="fa fa-exchange"></i> 
									  	<a href="index.php?p=editActiveTransfer&rec_no={{RelatedTransfer}}"
									  	class="badge blue text-black">
									  	{{RelatedTransferText}}</a>
									   {{/each}}
									   */?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3 "><label><?= STATUS ?></label></div>
								<div class="col-md-9">
									{{transferStatusText details.TransferStatus}}
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= DRIVERS_PRICE ?></label></div>
								<div class="col-md-9">
									{{details.DriversPrice}}
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= PAX ?></label></div>
								<div class="col-md-9">
									{{details.PaxNo}}
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= VEHICLETYPEID ?></label></div>
								<div class="col-md-9">
									<? /* oznacit tip vozila da bude vidljiviji */ ?>
									{{#compare details.VehicleClass "<" 10}}
										<i class="fa fa-car"></i>
									{{/compare}}
									{{#compare details.VehicleClass ">" 9}}
										{{#compare details.VehicleClass "<" 20}}
											<i class="fa fa-car indigo-text"></i>
										{{/compare}}
									{{/compare}}
									{{#compare details.VehicleClass ">" 19}}
										<i class="fa fa-car purple-text"></i>
									{{/compare}}

									{{details.VehicleTypeName}}

									{{#compare details.VehiclesNo ">" 1}}
									 x{{details.VehiclesNo}}
									{{/compare}}
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-3 "><label><?= PAX_NAME ?></label></div>
								<div class="col-md-9">
									{{master.MPaxFirstName}} {{master.MPaxLastName}}
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= PAX_TEL ?></label></div>
								<div class="col-md-9">
									{{master.MPaxTel}}
								</div>
							</div>
<?/*
							<div class="row">
								<div class="col-md-3 "><label><?= PAX_EMAIL ?></label></div>
								<div class="col-md-9">
									{{maskEmail master.MPaxEmail}}
								</div>
							</div>
*/
							if($_SESSION['AuthUserID'] == 1958 or $_SESSION['AuthUserID'] == 1957){?>
								<div class="row">
									<div class="col-md-3 "><label><?= PICKUP_DATE ?></label></div>
									<div class="col-md-9">
										<input type="text" name="PickupDate" class="w75 datepicker"
										value="{{details.PickupDate}}"
										<?= READ_ONLY_FLD ?>>
									</div>
								</div>

								<div class="row">
									<div class="col-md-3 "><label><?= PICKUP_TIME ?></label></div>
									<div class="col-md-9">
										<input type="text" name="PickupTime" class="w75 timepicker"
										value="{{details.PickupTime}}"
										<?= READ_ONLY_FLD ?>>
									</div>
								</div>
							<?}else{?>
								<div class="row">
									<div class="col-md-3 "><label><?= PICKUP_DATE ?></label></div>
									<div class="col-md-9">
										{{details.PickupDate}}
									</div>
								</div>

								<div class="row">
									<div class="col-md-3 "><label><?= PICKUP_TIME ?></label></div>
									<div class="col-md-9">
										{{details.PickupTime}}
									</div>
								</div>
							<?}?>
							<div class="row">
								<div class="col-md-3 "><label><?= FLIGHT_NO ?></label></div>
								<div class="col-md-9">
									<input type="text" name="FlightNo" class="w50"
									 value="{{details.FlightNo}}"
									<?= READ_ONLY_FLD ?>>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3 "><label><?= FLIGHT_TIME ?></label></div>
								<div class="col-md-9">
									<input type="text" name="FlightTime" class="w50 timepicker"
									 value="{{details.FlightTime}}"
									<?= READ_ONLY_FLD ?>>
								</div>
							</div>
							<? if ($contractFile=='inter') { ?>
							{{#compare details.PlaceType "==" 1}}
							<div class="row">
								<div class="col-md-3 "><label>Sub Pickup Time</label></div>
								<div class="col-md-9">
									<input type="text" name="SubPickupTime" class="w50 timepicker"
									 value="{{details.FlightTime}}"
									<?= READ_ONLY_FLD ?>>
									<input type="hidden" name="SubPickupDate" value="{{details.PickupDate}}">								
								</div>
							</div>		
							{{/compare}}		
							<? } ?>	
							<div class="row">
								<div class="col-md-3 "><label><?= PICKUP_NAME ?></label></div>
								<div class="col-md-9">
									<span class="l">{{details.PickupName}}</span>
									<input type="hidden" name="PickupType" value="{{details.PlaceType}}" disabled>									
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= PICKUP_ADDRESS ?></label></div>
								<div class="col-md-9">
									{{details.PickupAddress}}
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= DROPOFF_NAME ?></label></div>
								<div class="col-md-9">
									<span class="l">{{details.DropName}}</span>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= DROPOFF_ADDRESS ?></label></div>
								<div class="col-md-9">
									{{details.DropAddress}}
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= NOTES ?></label></div>
								<div class="col-md-9">
									<br>
									<small>{{details.PickupNotes}}</small>
								</div>
							</div>

							{{#if oeServices}}
								<br>
								<div class="row">
									<div class="col-md-3 "><label><?= EXTRAS ?></label></div>
									<div class="col-md-9">
										{{#each oeServices}}
											{{ServiceName}} x {{Qty}}
											<br>
										{{/each}}
									</div>
								</div>
							{{/if}}
						</div>


					{{!-- right side --}}

						<div class="col-md-6">
							<div class="row">
								<div class="col-md-3 "><label><?= ORDER_KEY ?></label></div>
								<div class="col-md-9">
									{{master.MOrderKey}}-{{details.OrderID}}
								</div>
							</div>

							<div class="row">

								<div class="col-md-3 "><label>
									<!-- #INC-373 - vozač ne treba da vidi konačan iznos -->
									{{#compare details.PaymentMethod "!=" 4}}
										<?= CASH ?>
									{{/compare}}

									{{#compare details.PaymentMethod "==" 4}}
										<?= DRIVERS_PRICE ?>
									{{/compare}}
								
								</label></div>
								<div class="col-md-9">
									<!-- #INC-373 - vozač ne treba da vidi konačan iznos -->
									{{#compare details.PaymentMethod "!=" 4}}
										{{details.PayLater}}
									{{/compare}}

									{{#compare details.PaymentMethod "==" 4}}
										{{details.DriversPrice}}
									{{/compare}}
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= PAYMENT_METHOD ?></label></div>
								<div class="col-md-9 ">
								  	{{paymentMethodText details.PaymentMethod}}
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= DRIVER_STATUS ?></label></div>
								<div class="col-md-9 driver" id="newDriverConfirm">
									<span class="{{driverConfStyle details.DriverConfStatus}}">
									{{driverConfText details.DriverConfStatus}} 
									</span>
									{{details.DriverConfDate}} {{details.DriverConfTime}}
								</div>
							</div>


							<div class="row">
								<div class="col-md-3 "><label><?= DRIVER_PAYMENT ?></label></div>
								<div class="col-md-9 ">
								  	{{driverPaymentText details.DriverPayment}}
								</div>
							</div>
							<div class="row">
								<div class="col-md-3 "><label><?= DRIVER_PAID_AMOUNT ?></label></div>
								<div class="col-md-9">
									<input type="text" name="DriverPaymentAmt" class="w25"
									 value="{{details.DriverPaymentAmt}}"
									<?= READ_ONLY_FLD ?>>
								</div>
							</div>
							
							<!--dok se ne popravi unos u bazu 
							{{#compare details.PaymentMethod "==" 2}}								
							<div class="row" style='border:1px solid #eee; background-color:#F9ECC9'>
								<div class="col-md-2 "><label>Driver <?= INVOICE ?></label><br>	  
									{{details.DriverInvoiceNumber}}
								</div>	
								<div class="col-md-2" ><label><?= INVOICE ?> Date</label><br>	  							
									{{details.DriverInvoiceDateO}}   
								</div>			 											
								<div class="col-md-2" ><label><?= INVOICE ?> Total</label><br>	  	     			 			
									{{details.DriverGrandTotalO}} EUR    
								</div>										
								<div class="col-md-2" ><label>Due Date</label><br>	     			 			
									{{details.DriverDueDateO}}
								</div>										
								<div class="col-md-2 "><label><?= PAYMENT_STATUS ?></label><br>	  
									{{details.DriverPaymentStatusO}}
								</div>
							</div>	
							{{/compare}}	
							!-->							
							
							<div class="row">
								<div class="col-md-3 "><label><?= MESSAGE ?></label></div>
								<div class="col-md-9">
									{{details.DriverNotes}}
								</div>
							</div>
							
							{{#compare details.DriverConfStatus "<=" 1}}
								
								<div class="row" id="confirmDecline{{details.DetailsID}}">
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
													id="SubDriverName" placeholder="Please put DRIVERS NAME or OPERATOR (do not put YOUR COMPANY name)" value="" onfocus="if (this.value=='Please put DRIVERS NAME or OPERATOR (do not put YOUR COMPANY name)') this.value='';">
												</div>
											</div>
											<div class="row">
												<div class="col-md-2"><label><?= DRIVER_TEL ?></label></div>
												<div class="col-md-8">
													<input class="form-control" type="text" 
													id="SubDriverTel" placeholder='International format (e.g +33...)' value="" onfocus="if (this.value=='Please put phone number in international format (e.g +33...)') this.value='';">
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
														<!---<option value="cr">Choose reason</option>													
														<option value="Availability">Availability</option>
														<option value="Price">Price</option>!--->														
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
												<span class='red'>&nbsp Please, CHECK this transfer details before confirming transfer request!</span> 
												<br>
												<br>
												<button class="btn btn-success" type="submit"
												onclick="confirmTransfer('{{details.DetailsID}}','{{details.DriverID}}','{{master.MOrderKey}}')">
													<i class="fa fa-check l"></i> <?= CONFIRM ?>
												</button>
												<!-- novi blok !-->
												<button id='decline1' class="btn btn-danger" type="submit" 
												onclick="declineTransfer1()">
													<i class="fa fa-remove l"></i> <?= DECLINE ?>
												</button>
												
												<button id='decline2' class="btn btn-danger" type="submit" style="display:none; "
												onclick="declineTransfer2('{{details.DetailsID}}','{{details.DriverID}}','{{master.MOrderKey}}')" >
													<i class="fa fa-remove l"></i> <?= DECLINE ?>
												</button>											
												<!-- kraj bloka !-->
												</div>		

											</div>			
										</form>
									</div>
								</div>
							{{/compare}}
							<? if ($contractFile=='inter') { ?>
								<div class="row">
									<large style='float:right' class="bold"><input class='check' onchange="dataChecked('{{details.DetailsID}}')" id="checkdata" type="checkbox" name="checkeddata" value="{{details.CustomerID}}" 
										{{#compare details.CustomerID "==" 1}} checked {{/compare}} ><?= DATA_CHECKED ?>  
									</large>									
								</div>	
							<? } ?>	
						</div> {{!-- col --}}
					</div> {{!-- row --}}
				</div> {{!-- tab-pane tab_1 --}}
				
				
			</div> {{!-- tab-content --}}
	    </div> {{!-- nav tabs custom end --}}
	</div> {{!-- box-body --}}
	
	{{!-- Statuses and messages --}}
	{{#compare details.DriverConfStatus ">" 1}}
	<div class="box-footer">
    	<button class="btn btn-default" onclick="return completedTransfer('{{details.DetailsID}}','');" 	{{#compare details.TransferStatus "==" 3}}disabled{{/compare}}	>		
    		<i class="fa fa-check-circle l"></i> <?= MARK_COMPLETED ?>
    	</button>
		<button class="hidden btn btn-default" onclick="$('#noShow').show('slow');">
			<i class="fa fa-minus-square l"></i> <?= MARK_NOSHOW ?> / <?= MARK_DRIVER_ERROR ?>
		</button>

    	<div class="row hidden">
			
			<div id="noShow" class="col-md-12" style="display:none">
				<br><?= DETAIL_DESCRIPTION ?>:<br>
				<textarea name="FinalNote" id="FinalNote" rows="5">{{details.FinalNote}}</textarea>
		
				<button class="btn btn-primary" 
				onclick="changeDriverConfStatus('{{details.DetailsID}}', '5');$('#btnSave').click();">
				
					<i class="fa fa-minus-square l"></i> <?= MARK_NOSHOW ?>
				
				</button>
   	
				<button class="btn btn-danger" 
				onclick="changeDriverConfStatus('{{details.DetailsID}}', '6');$('#btnSave').click();">
				
					<i class="fa fa-taxi l"></i> <?= MARK_DRIVER_ERROR ?>
				
				</button>
			</div>
		</div>
	</div>
	{{/compare}}
	

	<input type="hidden" name="DetailsID" id="DetailsID" value="{{details.DetailsID}}">
	<input type="hidden" name="DriverID" id="DriverID" value="{{details.DriverID}}">
	<input type="hidden" name="DriverName" id="DriverName" value="{{details.DriverName}}">
	<input type="hidden" name="DriverTel" id="DriverTel" value="{{details.DriverTel}}">	
	<input type="hidden" name="DriverConfTime" id="DriverConfTime" value="{{details.DriverConfTime}}">
	<input type="hidden" name="DriverConfDate" id="DriverConfDate" value="{{details.DriverConfDate}}">
	<input type="hidden" name="DriverConfStatus" id="DriverConfStatus" value="{{details.DriverConfStatus}}">

</form>

	<script>
		
		// uklanja ikonu Saved - statusMessage sa ekrana
		$("form").change(function(){
			$("#statusMessage").html('');
		});

		function dataChecked(detailsid) {
			if($("#checkdata").is(':checked')) var chk=1; // checked
			else var chk=0; // checked
				
			var url = window.root + '/cms/p/modules/transfers/dataChecked.php'+
				"?code=" + detailsid + "&checked=" + chk;
				
			$.ajax({
				type: 'POST',
				url: url,
				async: true,
				//contentType: "application/json",
				//dataType: 'jsonp',
				success: function(data) {
				}
			});		
		}

		function confirmTransfer(detailsid, driverid, orderkey) {
			
			// mesto + u telefonu
			var tel = $("#SubDriverTel").val() ;
			var n = tel.indexOf('+');
			
			if($("#SubDriverName").val() == '' || $("#SubDriverTel").val() == '') {
				alert('Enter Driver name and Telephone number!');
				return false;
			}
			
			// da li je ispravan format?
			if (n != 0) {
				alert ('Enter Phone number in right format starting with country code (+___)');
				return false;
			}	

			if($("#PickupPoint").val() == '') {
				alert('Enter Pickup point!');
				return false;
			}
			
			var url = window.root + '/cms/p/modules/transfers/confirmDecline.DriverN.php'+
				"?code=" + detailsid +
				"&control="+orderkey +
				"&id="+ driverid +
				"&SubDriverName="+ $("#SubDriverName").val() +
				"&SubDriverTel="+ $("#SubDriverTel").val() +
				"&PickupPoint="+ $("#PickupPoint").val() +
				"&Confirm=Confirmed";
	
			$.ajax({
				type: 'POST',
				url: url,
				async: true,
				//contentType: "application/json",
				//dataType: 'jsonp',
				success: function(data) {
					$("#confirmDecline"+detailsid).hide('slow');
					editSave('{{details.DetailsID}}', <?= $inList ?>);
					$.toaster('Transfer Confirmed', 'Done', 'success blue-2');
				}
			});
			
			return false;				
			
		}
		
		// prosirivanje forme sa decline poljima
		function declineTransfer1(detailsid, driverid, orderkey) {
			
			$("#decline1").hide();
			$("#decline2").show();
			//$("#drr").show(500);		
			$("#dm").show(500);			// privremeno, posle izbrisati
		}	
		$('#dmta').attr("placeholder","Your reason is:");	// privremeno, posle izbrisati
		$('#DeclineReason').change(function(){ 
			var rn = $('#DeclineReason').val(); 
			if (rn=='Price') $('#dmta').attr("placeholder","Your price is:");
			if (rn=='Availability') $('#dmta').attr("placeholder","Your time is:");
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
			var url = window.root + '/cms/p/modules/transfers/confirmDecline.DriverN.php'+
				"?code=" + detailsid +
				"&control="+orderkey +
				"&id="+ driverid +
				"&DeclineReason="+ declinereason +				
				"&DeclineMessage="+ declinemessage +		
				"&Confirm=Declined";
			//alert (url);
			//console.log(url); 
			$.ajax({
				type: 'POST',
				url: url,
				async: true,
				//contentType: "application/json",
				//dataType: 'jsonp',
				success: function(data) {
					// sadrzaj mail-a
					$("#confirmDecline"+detailsid).hide('slow');
					editSave('{{details.DetailsID}}', <?= $inList ?>);
					$.toaster('Transfer Declined', 'Done', 'success red');
				}
			})
			return false;
		}				
	</script>    
</script>

