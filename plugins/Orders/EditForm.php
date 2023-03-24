<script type="text/x-handlebars-template" id="ItemEditTemplate">
	<form id="ItemEditForm{{details.DetailsID}}" class="form box box-info" method="post" onsubmit="return false;">
				
		<div class="box-header box-header-edit">
			<div class="box-tools pull-right">
				
				<button class="btn " title="<?= CLOSE ?>"
				onclick="return editCloseItem('{{details.DetailsID}}');">
					<i class="fa fa-chevron-up l""></i>
				</button>
				<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
				onclick="return editSaveItem('{{details.DetailsID}}');">
				<i class="fa fa-save"></i>
				</button>
			</div>
		</div>

		<div class="box-body box-body-edit">
			<div class="nav-tabs-custom nav-tabs-custom-edit">
				<ul class="nav nav-tabs dorder">
					<li class="active"><a href="#tab_1{{details.DetailsID}}" data-toggle="tab"><?= TRANSFER ?></a></li>
					<li><a href="#tab_2{{details.DetailsID}}" data-toggle="tab"><?= ORDER_LOG ?></a></li>
				</ul>
				<div class="tab-content tab-content-edit">

					<div class="tab-pane active" id="tab_1{{details.DetailsID}}">
						<div class="row dorder">
							<div class="col-md-3 "><label><?= ID ?></label></div>
							<div class="col-md-9">
								<strong>{{details.OrderID}}-{{details.TNo}}</strong> {{transferStatusSelect details.TransferStatus}}
								{{#if details.RelatedTransfers.RelatedTransferText includeZero=true}}
									<i class="fa fa-exchange"></i>
									<a href="orders/detail/{{details.RelatedTransfers.RelatedTransfer}}"
										class="badge blue text-black">
										{{details.RelatedTransfers.RelatedTransferText}}
									</a>
								{{/if}}
							</div>
						</div>
						<div class="row dorder">
							<div class="col-md-3 "><label><?= ORDER_KEY ?></label></div>
							<div class="col-md-9">
								{{master.MOrderKey}}-{{details.OrderID}}
							</div>
						</div>
						<div class="row dorder">
							<div class="col-md-3 "><label>Staff Note</label></div>
							<div class="col-md-9">
								<div id="staffnote">
									<textarea class="textarea" name="StaffNote" id="StaffNotes" cols="40" rows="4"
									style="width:100%">{{details.StaffNote}}</textarea>
								</div>
							</div>
						</div>
						<div class="row dorder">
							<div class="col-md-3 "><label>Final Note</label></div>
							<div class="col-md-9">
								<div id="finalnote">
									<textarea class="textarea" name="FinalNote" id="FinalNotes" cols="40" rows="4"
									style="width:100%">{{details.FinalNote}}</textarea>
								</div>
							</div>
						</div>	
						
						<div class="row dpayment">
							<div class="col-md-4 ">
								<div class="row">
									<div class="col-md-3 "><label><?= PRICE ?></label></div>
									<div class="col-md-9">
										<input type="text" id="DetailPrice" name="DetailPrice" class="w25" value="{{details.DetailPrice}}">
									</div>
								</div>	
								<div class="row">						
									<div class="col-md-3 "><label>Driver`s <?= EXTRAS ?></label></div>
									<div class="col-md-9">
										<input type="text" id="DriverExtraCharge" name="DriverExtraCharge"  value="{{details.DriverExtraCharge}}">
									</div>
								</div>									
								<div class="row">						
									<div class="col-md-3 "><label><?= EXTRAS ?></label></div>
									<div class="col-md-9">
										<input type="text" id="ExtraCharge" name="ExtraCharge"  value="{{details.ExtraCharge}}">
									</div>
								</div>	
								<div class="row">							
									<div class="col-md-3 "><label>Discount</label></div>
									<div class="col-md-9">
										<input type="text" id="Discount" name="Discount"  value="{{details.Discount}}"> %
									</div>
								</div>
								<div class="row">
									<div class="col-md-3 "><label>Provision</label></div>
									<div class="col-md-9 ">
										<input type="text" name="ProvisionAmount" id="ProvisionAmount" class="w25"
										value="{{details.ProvisionAmount}}" > <?= CURRENCY ?>
									</div>
								</div>
							</div>
							<div class="col-md-4 ">
								<div class="row dpayment">
									<div class="col-md-3 "><label><?= PAYMENT_METHOD ?></label></div>
									<div class="col-md-9 ">
										{{paymentMethodSelect details.PaymentMethod}}
									</div>
								</div>
								<div class="row dpayment">
									<div class="col-md-3 "><label><?= CASH ?></label></div>
									<div class="col-md-6">
										<input type="text" name="PayLater" id="PayLater" class="w25"
										value="{{details.PayLater}}"
										>
									</div>
								</div>	
								<div class="row dpayment">
									<div class="col-md-3 "><label><?= PAID_ONLINE ?></label></div>
									<div class="col-md-9">
										<input type="text" name="PayNow" id="PayNow" class="w25"
										value="{{details.PayNow}}"> {{master.MCardNumber}}
									</div>
								</div>	
								<div class="row dpayment">
									<div class="col-md-3 "><label><?= PAYMENT_FOR ?> (Invoice)</label></div>
									<div class="col-md-9">
										<input type="text" name="InvoiceAmount" id="InvoiceAmount" class="w25"
										value="{{details.InvoiceAmount}}"
										> 
									</div>
								</div>
							</div>	
							<div class="col-md-4 ">
								{{#compare details.PaymentMethod ">" 3}}		
								<div class="row">
									<div class="col-md-3 "><label><?= INVOICE ?></label></div>
									<div class="col-md-9">{{details.InvoiceNumberO}}</div>
								</div>								
								<div class="row">
									<div class="col-md-3 "><label><?= INVOICE ?> Date</label></div>
									<div class="col-md-9">{{details.InvoiceDateO}}</div>
								</div>	
								<div class="row">
									<div class="col-md-3 "><label><?= INVOICE ?> Total</label></div>
									<div class="col-md-9">{{details.GrandTotalO}} <?= CURRENCY ?> </div>
								</div>	
								<div class="row">
									<div class="col-md-3 "><label>Due Date</label></div>
									<div class="col-md-9">{{details.DueDateO}}</div>
								</div>								
								<div class="row">
									<div class="col-md-3 "><label><?= PAYMENT_STATUS ?></label></div>
									<div class="col-md-9">{{details.PaymentStatusO}}</div>
								</div>	
								{{/compare}} 						
							</div>
						</div>	
						
						<div class="row dtransfer">
							<div class="col-md-3 "><label><?= PAX ?></label></div>
							<div class="col-md-9">
								<input type="text"  name="PaxNo" class="w25" value="{{details.PaxNo}}">
							</div>
						</div>						
						<div class="row dtransfer">
							<div class="col-md-3 "><label>Vehicle Type</label></div>
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
								{{#compare details.VehiclesNo ">" 1}}
									x{{details.VehiclesNo}}
								{{/compare}}
							{{vehicleTypeSelect details.VehicleType "VehicleType" "VehicleType"}}
							</div>									
						</div>
						<div class="row dtransfer">
							<div class="col-md-3 "><label>Vehicle No.</label></div>
							<div class="col-md-9">
								<input type="text" name="PickupDate" class="w75 datepicker"value="{{details.VehiclesNo}}">
							</div>									
						</div>
						<div class="row dtransfer">
							<div class="col-md-3 "><label><?= PICKUP_DATE ?></label></div>
							<div class="col-md-9">
								<input type="text" name="PickupDate" class="w75 datepicker"value="{{details.PickupDate}}">
							</div>
						</div>
						<div class="row dtransfer">
							<div class="col-md-3 "><label><?= PICKUP_TIME ?></label></div>
							<div class="col-md-9">
								<input type="text" name="PickupTime" class="w75 timepicker"
								value="{{details.PickupTime}}"
								>
							</div>
						</div>
						<div class="row dtransfer">
							<div class="col-md-3 "><label><?= PICKUP_NAME ?></label></div>
							<div class="col-md-9">
								<input type="text" name="PickupName" id="PickupName" value="{{details.PickupName}}">
								<div id="selectFrom_optionsPickup"  style="max-height:15em;overflow:auto"></div>
							</div>							
						</div>								
						<div class="row dtransfer">
							<div class="col-md-3 "><label><?= PICKUP_ADDRESS ?></label></div>
							<div class="col-md-9">
								<textarea name="PickupAddress">{{details.PickupAddress}}</textarea>
							</div>
						</div>
						<div class="row dtransfer">
							<div class="col-md-3 "><label><?= DROPOFF_NAME ?></label></div>
							<div class="col-md-9">
								<input type="text" name="DropName" id="DropName" value="{{details.DropName}}">
								<div id="selectFrom_optionsDrop"  style="max-height:15em;overflow:auto"></div>
							</div>
						</div>
						<div class="row dtransfer">
							<div class="col-md-3 "><label><?= DROPOFF_ADDRESS ?></label></div>
							<div class="col-md-9">
								<textarea name="DropAddress">{{details.DropAddress}}</textarea>								
							</div>
						</div>	
						<div class="row dtransfer">
							<div class="col-md-3 "><label><?= EXTRAS ?></label></div>
							<div class="col-md-9">
								<div class="row">
									<div class="col-md-6">
										Service Name
									</div>										
									<div class="col-md-2">
										Drivers Price
									</div>										
									<div class="col-md-2">
										Price
									</div>										
									<div class="col-md-2">
										Quantity
									</div>
								</div>							
								{{#each oeServices}}
									<div class="row">
										<div class="col-md-6">
											{{#compare ChangeDriverConflict "==" 1}}
												<span style="color:red">{{ServiceName}}</span>
											{{/compare}}
											{{extrasSelect ServiceID ID ID ../details.DriverID}}
										</div>										
										<div class="col-md-2">
											<input type="text" class="w25 DriverPrice" name="DriverPrice[{{ID}}]" id="DriverPrice[{{ID}}]" value="{{DriverPrice}}">
										</div>										
										<div class="col-md-2">
											<input type="text" class="w25 Price" name="Price[{{ID}}]" id="Price[{{ID}}]" value="{{Price}}">
										</div>										
										<div class="col-md-2">
											<input type="number" class="w25" name="Qty[{{ID}}]" id="Qty[{{ID}}]" value="{{Qty}}">
										</div>
									</div>
								{{/each}}
							</div>
						</div>						

						<div class="row dpdriver">
							<div class="col-md-3 "><label><?= STATUS ?></label></div>
							<div class="col-md-9">
								{{driverConfStatusSelect details.DriverConfStatus "DriverConfStatus"}}
								{{#compare details.DriverConfStatus "==" 2}}
								{{details.DriverConfDate}} {{details.DriverConfTime}}
								{{/compare}}								
							</div>
						</div>						
						<div class="row dpdriver">
							<div class="col-md-3 "><label><?= DRIVER_NAME ?></label></div>
							<div class="col-md-6 driver" id="newDriverName">								
								{{driverSelect details.DriverID details.RouteID details.VehicleType}}
							</div>
						</div>
						<div class="row dpdriver">
							<div class="col-md-3 "><label><?= DRIVER_TEL ?></label></div>
							<div class="col-md-9">
								<input type="text" id="DriverTel" name="DriverTel" class="w25" value="{{details.DriverTel}}">							
							</div>
						</div>
						<div class="row dpdriver">
							<div class="col-md-3 "><label><?= DRIVER_EMAIL ?></label></div>
							<div class="col-md-9">
								<input type="text" id="DriverEmail" name="DriverEmail" class="w25" value="{{details.DriverEmail}}">															
							</div>
						</div>
						<div class="row dpdriver">
							<div class="col-md-3 "><label><?= DRIVERS_PRICE ?></label></div>
							<div class="col-md-9">
								<input type="text" id="DriversPrice" name="DriversPrice" class="w25" value="{{details.DriversPrice}}">
							</div>
						</div>
						<div class="row dpdriver">
							<div class="col-md-3 "><label>Driver <?= EXTRAS ?></label></div>
							<div class="col-md-9">
								<input type="text" id="DriverExtraCharge" name="DriverExtraCharge" class="w25" value="{{details.DriverExtraCharge}}">
							</div>
						</div>
						<div class="row dpdriver">
							<div class="col-md-3 "><label><?= DRIVER_PAID_AMOUNT ?></label></div>
							<div class="col-md-9">
								<input type="text" id="DriverPaymentAmt" name="DriverPaymentAmt" class="w25"
								value="{{#compare details.DriverPaymentAmt ">" 0}}{{details.DriverPaymentAmt}}{{/compare}}{{#compare details.DriverPaymentAmt "==" 0}}{{details.DriversPrice}}{{/compare}}"
								 readonly>
							</div>
						</div>								
						{{#compare details.PaymentMethod "==" 2}}					
						<div class="row dpdriver">
							<div class="col-md-3 "><label>Driver <?= INVOICE ?></label></div>
							<div class="col-md-9">{{details.DriverInvoiceNumberO}}</div>	
						</div>
						<div class="row dpdriver">
							<div class="col-md-3 "><label><?= INVOICE ?> Date</label></div>
							<div class="col-md-9">{{details.DriverInvoiceDateO}}  </div>	
						</div>								
						<div class="row dpdriver">
							<div class="col-md-3 "><label><?= INVOICE ?> Total</label></div>
							<div class="col-md-9">{{details.DriverGrandTotalO}} EUR    </div>	
						</div>									
						<div class="row dpdriver">
							<div class="col-md-3 "><label>Due Date</label></div>
							<div class="col-md-9">{{details.DriverDueDateO}}</div>	
						</div>			 											
						<div class="row dpdriver">
							<div class="col-md-3 "><label><?= PAYMENT_STATUS ?></label></div>
							<div class="col-md-9">{{details.DriverPaymentStatusO}}</div>	
						</div>	
						{{/compare}}	
						<div class="row dpdriver">
							<div class="col-md-3 "><label><?= MESSAGE ?></label></div>
							<div class="col-md-9">
								<div id="summernote">
									<textarea class="textarea" name="DriverNotes" id="DriverNotes" cols="40" rows="4"
									style="width:100%">{{{details.DriverNotes}}}</textarea>
								</div>
								<br>
								<button class="btn btn-primary"
								onclick="return sendEmailToDriver('{{details.OrderID}}','{{details.TNo}}');">
									<?= SEND_EMAIL_TO_DRIVER ?>
									<div id="sendMessageResponse"></div>
								</button>
								<br><br>
							</div>
						</div>
						{{#compare details.SubDriver "!=" 0}}	
						<div class="row dpdriver">
							<div class="col-md-3 "><label><?= SUBDRIVER ?></label></div>
							<div class="col-md-9">{{userName details.SubDriver "AuthUserRealName"}}  </div>	
						</div>	
						{{/compare}}

						<div class="row dagent">
							<div class="col-md-3 "><label><?= BOOKED_BY?></label></div>
							<div class="col-md-9">
								<strong>{{userName details.UserID "AuthUserCompany"}}</strong>
								({{details.UserID}})
								<input style="display:none" type="text" id="UserID" name="UserID" class="w25" value="{{details.UserID}}" />	
							</div>
						</div>
						{{#compare master.MConfirmFile "!=" ''}}
						<div class="row dagent">
							<div class="col-md-3 "><label>Agent Reference</label></div>
							<div class="col-md-9">
								<strong>{{master.MConfirmFile}}</strong> 
							</div>
						</div>
						{{/compare}}
						<div class="row dagent">
							<div class="col-md-3 "><label><?= PROVISION ?></label></div>
							<div class="col-md-9 ">
								{{details.ProvisionAmount}} <?= CURRENCY ?>
							</div>
						</div>	
						
						<div class="row dpassenger" id='ob' style='display:none'>
							<div class="col-md-3 "><label>Other bookings</label></div>
							<div class="col-md-9" id='otherTransfers'>
								{{#each details.otherTransfers}}
									<a href="orders/detail/{{OtherTransferID}}"
										class="badge blue text-black">
										{{OtherTransferText}}
									</a>
								{{/each}}	
							</div>									
						</div>		 
						<div class="row dpassenger">
							<div class="col-md-3 "><label><?= PAX_FIRST_NAME ?></label></div>
							<div class="col-md-9">
								<input id="PassengerName" name="MPaxFirstName" type="text"  class="w75"
								value="{{master.MPaxFirstName}}"
								>
							</div>
						</div>
						<div class="row dpassenger">
							<div class="col-md-3 "><label><?= PAX_LAST_NAME ?></label></div>
							<div class="col-md-9">
								<input id="PassengerName" name="MPaxLastName" type="text"  class="w75"
								value="{{master.MPaxLastName}}"
								>
							</div>
						</div>
						<div class="row dpassenger">
							<div class="col-md-3 "><label><?= PAX_TEL ?></label></div>
							<div class="col-md-9">
								<input id="MPaxTel" name="MPaxTel" type="text"  class="w75"
								value="{{master.MPaxTel}}" <?/*{{master.CountryPhonePrefix}}*/?>
								>
							</div>
						</div>
						<div class="row dpassenger">
							<div class="col-md-3 "><label><?= PAX_EMAIL ?></label></div>
							<div class="col-md-9">
								<input id="PassengerEmail" name="MPaxEmail" type="text"  class="w50"
								value="{{master.MPaxEmail}}"
								>
								<a href="mailto:{{master.MPaxEmail}}" class="btn" title="Send E-mail">
									<i class="fa fa-envelope l"></i>
								</a>
							</div>
						</div>
						<div class="row dpassenger">
							<div class="col-md-3 "><label><?= FLIGHT_NO ?></label></div>
							<div class="col-md-9">
								<input type="text" name="FlightNo" class="w75"
								value="{{details.FlightNo}}"
								>
							</div>
						</div>
						<div class="row dpassenger">
							<div class="col-md-3 "><label><?= FLIGHT_TIME ?></label></div>
							<div class="col-md-9">
								<input type="text" name="FlightTime" class="w75 timepicker"
								value="{{details.FlightTime}}"
								>
							</div>
						</div>
						<div class="row dpassenger">
							<div class="col-md-3 "><label><?= NOTES ?></label></div>
							<div class="col-md-9">
								<br>
								<small>{{details.PickupNotes}}</small>
							</div>
						</div>
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


		<input type="hidden" name="DetailsID" id="DetailsID" value="{{details.DetailsID}}">
		<input type="hidden" name="AgentID" id="AgentID" value="{{details.AgentID}}">		
		<input type="hidden" name="DriverName" id="DriverName" value="{{details.DriverName}}">
		<input type="hidden" name="DriverTel" id="DriverTel" value="{{details.DriverTel}}">
		<input type="hidden" name="DriverEmail" id="DriverEmail" value="{{details.DriverEmail}}">
		<input type="hidden" name="DriverConfTime" id="DriverConfTime" value="{{details.DriverConfTime}}">
		<input type="hidden" name="DriverConfDate" id="DriverConfDate" value="{{details.DriverConfDate}}">
		<input type="hidden" name="UserName" id="UserName" value="<?= $_SESSION['UserName']?>">
		<input type="hidden" name="AuthUserID" id="AuthUserID" value="<?= $_SESSION['AuthUserID']?>">
		<input type="hidden" name="OrderID" id="OrderID"   value="{{details.OrderID}}">
		<input type="hidden" name="UserLevelID" id="UserLevelID"  value="{{details.UserLevelID}}">
		<input type="hidden" name="PickupType" id="PickupType" value="{{details.PlaceType}}" >
		<input type="hidden" name="PickupID" id="PickupID" value="{{details.PickupID}}" >
		<input type="hidden" name="DropID" id="DropID" value="{{details.DropID}}" >
		<input type="hidden" name="sendEmailTo" id="sendEmailTo" value="{{details.DriverEmail}}">
		
	</form>
	<script>
		//sistem za blokiranje promena u odnosu na statuse
		DriverConfStatusRelated();
		$('#DriverConfStatus').change(function(){
			DriverConfStatusRelated();
		})	
		function DriverConfStatusRelated() {
			if ($('#DriverConfStatus').val() > 1) {
				$('#DriverID').prop( "disabled", true );
				$('#DriverPrice').prop( "disabled", true );
			}	
			else {
				$('#DriverID').prop( "disabled", false );
				$('#DriverPrice').prop( "disabled", false );				
			}	
		}
		// promena telefona i email-a nakon promene drivera
		$('#DriverID').change(function(){
			$('#DriverTel').val($('#DriverID :selected').attr('data-tel'));
			$('#DriverEmail').val($('#DriverID :selected').attr('data-email'));
		})		
		$('#PickupName, #DropName').on('click keyup', function(event) {
			var clicked_id='#'+$(this).attr('id');
			var loc=$(this).attr('id').replace("Name", "");
			var html = '';
			query = $(clicked_id).val();
			if (query.length > 2) {
				$.ajax({
					url:  './api/getFromPlacesEdgeN.php',
					type: 'GET',
					dataType: 'jsonp',
					data: {
						qry : query
					},
					error: function() {
						//callback();
					},
					success: function(res) {
						if(res.length > 0) {
							$.each( res, function( index, item ){
								html +='<button class="PickupName" id="'+ item.ID +
									'" data-name="'+item.Place+'">'+
									item.Place +
									'</button><br>';
							});
							// data received
							$("#selectFrom_options"+loc).show("slow");
							$("#selectFrom_options"+loc).html(html);

							// option selected
							$(".PickupName").click(function(){
								$(clicked_id).val($(this).attr('data-name'));
								$("#"+loc+"ID").val($(this).attr('id'));
								$("#selectFrom_options"+loc).hide("slow");
							});
						}						
					}
				})	
			}
		})	
		$('.ServiceID').change(function() {
			var driverprice = $(this).find('option:selected').attr('data-driverprice');
			$(this).parent().parent().find('.driverprice').val(driverprice);			
			var price = $(this).find('option:selected').attr('data-price');
			$(this).parent().parent().find('.price').val(price);
		})	
		
	</script>

</script>

