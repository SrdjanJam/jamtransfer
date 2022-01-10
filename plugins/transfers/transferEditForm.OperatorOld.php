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
						
			<a class="btn btn-success" title="<?= PRINT_VOUCHER ?>" 
			href="index.php?p=printVoucherOperator&OrderID={{master.MOrderID}}" target="_blank">
			<i class="fa fa-user l"></i>
			</a>
	
		
		</div>
	</div>

	<div class="box-body">
		<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1{{details.DetailsID}}" data-toggle="tab"><?= TRANSFER ?></a></li>
                <li><a href="#tab_2{{details.DetailsID}}" data-toggle="tab"><?= ORDER_LOG ?></a></li>
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
									<img src='img/{{userName details.UserID "Image"}}' onerror="this.style.display = 'none';">  <strong>{{userName details.UserID "AuthUserCompany"}}</strong> ({{details.UserID}})
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
									<input type="text"  name="DetailPrice" class="w25" value="{{details.DetailPrice}}"
									<?= READ_ONLY_FLD ?>>
									(+ {{details.ExtraCharge}} Extras)
									
									{{#compare details.Discount ">" 0}}
										[-{{details.Discount}}% Coupon]
									{{/compare}}
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= PAX ?></label></div>
								<div class="col-md-9">
									<input type="text"  name="PaxNo" class="w25" value="{{details.PaxNo}}"
									<?= READ_ONLY_FLD ?>>
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
								<div class="col-md-3 "><label><?= PAX_TEL ?></label></div>
								<div class="col-md-9">
									<input id="MPaxTel" name="MPaxTel" type="text"  class="w75"
									 value="{{master.MPaxTel}}"
									<?= READ_ONLY_FLD ?>>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= PAX_EMAIL ?></label></div>
								<div class="col-md-9">
									<input id="PassengerEmail" name="MPaxEmail" type="text"  class="w50"
									 value="{{master.MPaxEmail}}"
									<?= READ_ONLY_FLD ?>>
									<a href="mailto:{{master.MPaxEmail}}" class="btn" title="Send E-mail">
										<i class="fa fa-envelope l"></i>
									</a>
								</div>
							</div>

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

							<div class="row">
								<div class="col-md-3 "><label><?= FLIGHT_NO ?></label></div>
								<div class="col-md-9">
									<input type="text" name="FlightNo" class="w75"
									 value="{{details.FlightNo}}"
									<?= READ_ONLY_FLD ?>>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3 "><label><?= FLIGHT_TIME ?></label></div>
								<div class="col-md-9">
									<input type="text" name="FlightTime" class="w75 timepicker"
									 value="{{details.FlightTime}}"
									<?= READ_ONLY_FLD ?>>
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
									<?= READ_ONLY_FLD ?>>
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
									<?= READ_ONLY_FLD ?>>
								</div>
							</div>

							<!---15.03.2019. Dejan trazio da se otkljuca za sve operatere !-->
							
								<div class="row">
									<div class="col-md-3 "><label><?= NOTES ?></label></div>
									<div class="col-md-9">
										<br>
										<input type="text" name="PickupNotes" class="w75" value="{{details.PickupNotes}}">
									</div>
								</div>
								
							<!--- verzija zakljucana
								<div class="row">
									<div class="col-md-3 "><label><?= NOTES ?></label></div>
									<div class="col-md-9">
										<br>
										<small>{{details.PickupNotes}}</small>
									</div>
								</div>
							!--->

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
								<div class="col-md-3 "><label><?= PAID_ONLINE ?></label></div>
								<div class="col-md-9">
									<input type="text" name="PayNow" class="w75"
									 value="{{details.PayNow}}"
									<?= READ_ONLY_FLD ?>>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= CASH ?></label></div>
								<div class="col-md-9">
									<input type="text" name="PayLater" class="w75"
									 value="{{details.PayLater}}"
									<?= READ_ONLY_FLD ?>>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= PAYMENT_METHOD ?></label></div>
								<div class="col-md-9 ">
								  	{{paymentMethodSelect details.PaymentMethod}}
									{{#compare details.PaymentMethod "==" 4}}
										[{{details.InvoiceAmount}} <?= CURRENCY ?>]
									{{/compare}}
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= DRIVER_NAME ?></label></div>
								<div class="col-md-6 driver" id="newDriverName">
									{{driverSelect details.DriverID details.RouteID}}
								</div>
								<div class="col-md-3">
									<button class="btn btn-primary" data-toggle="modal" data-target="#routeDriversModal">
									<i class="fa fa-search"></i></button>
								</div>
							</div>

							<div class="modal fade" id="routeDriversModal">
								<div class="modal-dialog" style="width:800px">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title">Drivers for route {{details.RouteID}}</h4>
										</div>
										<div class="modal-body" style="padding:10px">
											<strong>
											<div class="col-md-5">Driver Company</div>
											<div class="col-md-1">Pax</div>
											<div class="col-md-2 right">Base</div>
											<div class="col-md-2 right">FinalPrice</div>
											<div class="col-md-2 right">Neto</div>
											</strong><br>
											{{listDriversByRoute details.RouteID details.PickupDate details.PickupTime}}
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-primary col-md-12" data-dismiss="modal">Close</button>
										</div>
									</div>
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
								<input type="hidden" id="sendEmailTo" value="{{details.DriverEmail}}">
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
								<div class="col-md-3 "><label><?= DRIVERS_PRICE ?></label></div>
								<div class="col-md-9">
									<input type="text" name="DriversPrice" class="w25"
									 value="{{details.DriversPrice}}"
									<?= READ_ONLY_FLD ?>>
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
							<div class="row">
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


		{{#compare details.DriverConfStatus ">" 0}}
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

		<? /* botuni za onemoguciti/omoguciti slanje JamTransfer ankete za ovaj transfer
			- ako je vec anketa poslana, ovih botuna nema */ ?>
		{{#compare master.MSendEmail "==" 0}}
			<button class="btn btn-default" onclick="toggleSurvey('{{master.MOrderID}}', false, this)">
				<i class="fa fa-list-alt"></i> Disable Survey
			</button>
		{{/compare}}
		{{#compare master.MSendEmail "==" 2}}
			<button class="btn btn-default" onclick="toggleSurvey('{{master.MOrderID}}', true, this)">
				<i class="fa fa-list-alt"></i> Enable Survey
			</button>
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
		// uklanja ikonu Saved - statusMessage sa ekrana
		$("form").change(function(){
			$("#statusMessage").html('');
		});
	</script>    
</script>

