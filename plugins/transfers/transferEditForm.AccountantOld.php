<script type="text/x-handlebars-template" id="transferTemplate">

<form id="transferEditForm{{details.DetailsID}}" class="form box box-solid" onsubmit="return false;">

	<input type="hidden" name="UserName" value="<?= $_SESSION['UserName']?>">
	<input type="hidden" name="AuthUserID" value="<?= $_SESSION['AuthUserID']?>">

	<div class="box-header">
		<div class="box-title">
			<h3><?= EDIT.B.TRANSFER ?>  {{details.OrderID}}-{{details.TNo}}  [{{details.PaxName}}]</h3>
		</div>
		<div class="box-tools pull-right">
			{{#compare details.DriverConfStatus ">" 0}}
				<?= RESEND_VOUCHER ?>:
				<button class="btn btn-primary"
					onclick="return sendUpdateEmail('{{details.DriverEmail}}','','','','','driver','{{details.DetailsID}}',this);">
					<?= TO_DRIVER ?>
					<div></div>
				</button>
				<button class="btn btn-primary"
					onclick="return sendUpdateEmail('{{master.MPaxEmail}}','','','','','pax','{{details.DetailsID}}',this);">
					<?= TO_PAX ?>
				<div></div>
				</button>&nbsp;&nbsp;&nbsp;
			{{/compare}}
			
			<? if ($inList=='true') { ?>
				<button class="btn " title="<?= CLOSE ?>" 
				onclick="return editClose('{{details.DetailsID}}');">
				<i class="fa fa-chevron-up l""></i>
				</button>
			<? } ?>
			
			<button class="btn btn-info" title="<?= SAVE ?>" 
			onclick="return editSave('{{details.DetailsID}}');">
			<i class="fa fa-save l"></i>
			</button>
			
			<a href="printTransfer.php?OrderID={{details.OrderID}}" class="btn btn-danger" title="<?= PRINT_CONFIRMATION ?>" target="_blank">
			<i class="fa fa-print l"></i>
			</a>
            
            <a href="printSingleTransfer.php?DetailsID={{details.DetailsID}}" class="btn btn-warning" title="Print single transfer" target="_blank">
			<i class="fa fa-print l"></i>
			</a>
<!--						
			<button class="btn btn-danger" title="<?= PRINT_CONFIRMATION ?>" 
			onclick="return editPrint('{{details.DetailsID}}');">
			<i class="fa fa-print l"></i>
			</button>
-->			
		</div>
	</div>

	<div class="box-body">
		<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1{{details.DetailsID}}" data-toggle="tab"><?= TRANSFER ?></a></li>
           <!-- <li><a href="#tab_2{{details.DetailsID}}" data-toggle="tab"><?= ORDER_LOG ?></a></li> -->
            </ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_1{{details.DetailsID}}">		
					<div class="row">
						<div class="col-md-6"> 
							<div class="row">
								<div class="col-md-3 "><label><?= ID ?></label></div>
								<div class="col-md-9">
									  <strong>{{details.OrderID}}-{{details.TNo}}</strong> {{displayTransferStatusText details.TransferStatus}}
									  
									  {{#each details.RelatedTransfers}}
									  	<i class="fa fa-exchange"></i> 
									  	<a href="index.php?p=editActiveTransfer&rec_no={{RelatedTransfer}}"
									  	class="badge blue text-black">
									  	{{RelatedTransferText}}</a>
									   {{/each}}
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= BOOKED_BY?></label></div>
								<div class="col-md-9">
									  <strong>{{userName details.UserID "AuthUserCompany"}}</strong> ({{details.UserID}})
								</div>
							</div>
							<!--
							<div class="row">
								<div class="col-md-3 "><label><?= STATUS ?></label></div>
								<div class="col-md-9">
									{{transferStatusSelect details.TransferStatus}}
								</div>
							</div>
							-->

							<div class="row">
								<div class="col-md-3 "><label><?= PRICE ?></label></div>
								<div class="col-md-9">
									<input type="text"  name="DetailPrice" class="w25" value="{{details.DetailPrice}}">
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= PAX ?></label></div>
								<div class="col-md-9">
									<input type="text"  name="PaxNo" class="w25" value="{{details.PaxNo}}"
									<?= READ_ONLY_FLD ?> readonly>
								</div>
							</div>

								<div class="row">
									<div class="col-md-3 "><label><?= PAX_FIRST_NAME ?></label></div>
									<div class="col-md-9">
										<input id="PassengerName" name="MPaxFirstName" type="text"  class="w75"
										value="{{master.MPaxFirstName}}"
										<?= READ_ONLY_FLD ?>>
									</div>
								</div>

								<div class="row">
									<div class="col-md-3 "><label><?= PAX_LAST_NAME ?></label></div>
									<div class="col-md-9">
										<input id="PassengerName" name="MPaxLastName" type="text"  class="w75"
										value="{{master.MPaxLastName}}"
										<?= READ_ONLY_FLD ?>>
									</div>
								</div>

							<div class="row">
								<div class="col-md-3 "><label><?= PAX_EMAIL ?></label></div>
								<div class="col-md-9">
									<input id="PassengerEmail" name="MPaxEmail" type="text"  class="w50"
									 value="{{master.MPaxEmail}}"
									<?= READ_ONLY_FLD ?> readonly>
									<a href="mailto:{{master.MPaxEmail}}" class="btn" title="Send E-mail">
										<i class="fa fa-envelope l"></i>
									</a>
								</div>
							</div>

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

							<div class="row">
								<div class="col-md-3 "><label><?= FLIGHT_NO ?></label></div>
								<div class="col-md-9">
									<input type="text" name="FlightNo" class="w75"
									 value="{{details.FlightNo}}"
									<?= READ_ONLY_FLD ?> readonly>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3 "><label><?= FLIGHT_TIME ?></label></div>
								<div class="col-md-9">
									{{details.FlightTime}}
								</div>
							</div>							
							
							
							<div class="row">
								<div class="col-md-3 "><label><?= PICKUP_NAME ?></label></div>
								<div class="col-md-9">
									<span class="l">{{details.PickupName}}</span>
									
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= PICKUP_ADDRESS ?></label></div>
								<div class="col-md-9">
									<input type="text" name="PickupAddress" class="w75"
									value="{{details.PickupAddress}}"
									<?= READ_ONLY_FLD ?> readonly>
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
									<input type="text" name="DropAddress" class="w75" value="{{details.DropAddress}}"
									<?= READ_ONLY_FLD ?> readonly>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= NOTES ?></label></div>
								<div class="col-md-9">
									<br>
									<small>{{details.PickupNotes}}</small>
								</div>
							</div>

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
								<div class="col-md-3 "><label><?= PAID_ONLINE ?></label></div>
								<div class="col-md-9">
									{{details.PayNow}}
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= CASH ?></label></div>
								<div class="col-md-9">
									{{details.PayLater}}
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= PAYMENT_METHOD ?></label></div>
								<div class="col-md-9 ">
								  	{{paymentMethodText details.PaymentMethod}}
									{{#compare details.PaymentMethod "==" 4}}
										[{{details.InvoiceAmount}} <?= CURRENCY ?>]
									{{/compare}}
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= DRIVER_NAME ?></label></div>
								<div class="col-md-9 driver" id="newDriverName">
									{{details.DriverName}}
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= DRIVER_TEL ?></label></div>
								<div class="col-md-9 driver" id="newDriverTel">
									{{details.DriverTel}}
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= DRIVER_EMAIL ?></label></div>
								<div class="col-md-9 driver" id="newDriverEmail">
									{{details.DriverEmail}}
								</div>
								<input type="hidden" id="sendEmailTo">
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
								<div class="col-md-3 "><label><?= PAYMENT_STATUS ?></label></div>
								<div class="col-md-9 ">
								  	{{paymentStatusSelect details.PaymentStatus}}
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= DRIVER_PAYMENT ?></label></div>
								<div class="col-md-9 ">
								  	{{driverPaymentSelect details.DriverPayment}}
								</div>
							</div>
							<div class="row">
								<div class="col-md-3 "><label><?= DRIVER_PAID_AMOUNT ?></label></div>
								<div class="col-md-9">
									<input type="text" name="DriverPaymentAmt" class="w25"
									 value="{{#compare details.DriverPaymentAmt ">" 0}}{{details.DriverPaymentAmt}}{{/compare}}{{#compare details.DriverPaymentAmt "==" 0}}{{details.DriversPrice}}{{/compare}}"
									<?= READ_ONLY_FLD ?>>
								</div>
							</div>
							
							
						</div> {{!-- col --}}
					</div> {{!-- row --}}
				</div> {{!-- tab-pane tab_1 --}}
				
				<div class="tab-pane" id="tab_2{{details.DetailsID}}">
			
					<div class="row">
						<div class="col-sm-12">
							{{#if orderLog}}
								<ul class="timeline">

									{{#each orderLog}}

										<li class="time-label">
											<span class="bg-light-blue">
												{{DateAdded}}
											</span>
										</li>

										<li>
											<i class="{{Icon}}"></i>
											<div class="timeline-item">
												<span class="time">
													<i class="fa fa-clock-o"></i> {{TimeAdded}}
												</span>

												<span class="timeline-header">
													{{Title}}
												</span>

												<div class="timeline-body">
													{{{Description}}}
												</div>
											</div>
										</li>
									{{/each}}

								</ul>
							{{else}}
								<i class="fa fa-exclamation-circle"></i> <?= NO_DATA ?>
							{{/if}}
						</div>
					</div>
				</div>{{!-- tab-pane tab_2 --}}
				
			</div> {{!-- tab-content --}}
	    </div> {{!-- nav tabs custom end --}}
	</div> {{!-- box-body --}}
	
	{{!-- Statuses and messages --}}
	<div class="box-footer">
		<span id="statusMessage" class="text-info xl"></span>
    	<button class="btn btn-default" onclick="return deleteTransfer({{details.DetailsID}});">
    		<i class="fa fa-trash-o l"></i> <?= DELETE_TRANSFER ?>
    	</button>
    	<button class="btn btn-default" onclick="return cancelTransfer({{details.DetailsID}});">
    		<i class="fa fa-times-circle l"></i> <?= CANCEL_TRANSFER ?>
    	</button>
    	<button class="btn btn-default" onclick="return activateTransfer({{details.DetailsID}});">
    		<i class="fa fa-undo l"></i> <?= MARK_ACTIVE ?>
    	</button>
    	<button class="btn btn-default" onclick="return completedTransfer({{details.DetailsID}});">
    		<i class="fa fa-check-circle l"></i> <?= MARK_COMPLETED ?>
    	</button>

		{{#compare details.DriverConfStatus ">" 1}}
			<button class="btn btn-default" onclick="return completedTransfer('{{details.DetailsID}}','');">
				<i class="fa fa-check-circle l"></i> <?= MARK_COMPLETED ?>
			</button>
			<button class="btn btn-default" onclick="$('#noShow').show('slow');">
				<i class="fa fa-minus-square l"></i> <?= MARK_NOSHOW ?> / <?= MARK_DRIVER_ERROR ?>
			</button>

			<div class="row">
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
		{{/compare}}
	</div>

	<input type="hidden" name="DetailsID" id="DetailsID" value="{{details.DetailsID}}">
	<input type="hidden" name="DriverID" id="DriverID" value="{{details.DriverID}}">
	<input type="hidden" name="DriverName" id="DriverName" value="{{details.DriverName}}">
	<input type="hidden" name="DriverTel" id="DriverTel" value="{{details.DriverTel}}">	
	<input type="hidden" name="DriverEmail" id="DriverEmail" value="{{details.DriverEmail}}">	
	<input type="hidden" name="DriverConfTime" id="DriverConfTime" value="{{details.DriverConfTime}}">
	<input type="hidden" name="DriverConfDate" id="DriverConfDate" value="{{details.DriverConfDate}}">
	<input type="hidden" name="DriverConfStatus" id="DriverConfStatus" value="{{details.DriverConfStatus}}">

</form>

	<script>
		//bootstrap WYSIHTML5 - text editor
		$(".textarea").wysihtml5({
				"font-styles": false, //Font styling, e.g. h1, h2, etc. Default true
				"emphasis": true, //Italics, bold, etc. Default true
				"lists": false, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
				"html": false, //Button which allows you to edit the generated HTML. Default false
				"link": false, //Button to insert a link. Default true
				"image": false, //Button to insert an image. Default true,
				"color": false //Button to change color of font 
				
		});
		
		// uklanja ikonu Saved - statusMessage sa ekrana
		$("form").change(function(){
			$("#statusMessage").html('');
		});

/*
		function applyChangeDriver(selectElement) {
			alert('Old driver and New driver will be informed of this change!');
			var newDriverEmail = $(selectElement).find(':selected').data('email');
			var newDriverTel   = $(selectElement).find(':selected').data('tel');
			var newDriverName  = $(selectElement).find(':selected').data('realname');
			var newDriverID    = $(selectElement).val();
			
			$("#newDriverEmail").text(newDriverEmail);
			$("#newDriverTel").text(newDriverTel);
			$("#sendEmailTo").val(newDriverEmail);
			
			$("#DriverName").val(newDriverName);
			$("#DriverTel").val(newDriverTel);
			$("#DriverEmail").val(newDriverEmail);
			$("#DriverID").val(newDriverID);
			
			// reset confirmation values
			$("#DriverConfStatus").val('1');
			$("#DriverConfDate").val('');
			$("#DriverConfTime").val('');

		}
*/
	</script>    
</script>

