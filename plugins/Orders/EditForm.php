<script type="text/x-handlebars-template" id="ItemEditTemplate">

	<form id="ItemEditForm{{details.DetailsID}}" class="form box box-solid" onsubmit="return false;">

		<input type="hidden" name="UserName" id="UserName" value="<?= $_SESSION['UserName']?>">
		<input type="hidden" name="AuthUserID" id="AuthUserID" value="<?= $_SESSION['AuthUserID']?>">
		<input type="hidden" id="OrderID" name="OrderID"   value="{{details.OrderID}}">
		<input type="hidden" id="UserLevelID" name="UserLevelID"   value="{{details.UserLevelID}}">
		
		
		<div class="box-header box-header-edit">
			<div class="box-tools pull-right">
				<span id="statusMessage" class="text-info xl"></span>
				{{#compare master.MSendEmail "==" 0}}
					<button class="btn btn-default dorder dpassenger" onclick="toggleSurvey('{{master.MOrderID}}', false, this)">
						<i class="fa fa-list-alt"></i> Disable Survey
					</button>
				{{/compare}}
				{{#compare master.MSendEmail "==" 2}}
					<button class="btn btn-default dorder" onclick="toggleSurvey('{{master.MOrderID}}', true, this)">
						<i class="fa fa-list-alt"></i> Enable Survey
					</button>
				{{/compare}}	
				{{#compare details.DriverConfStatus ">" 0}}
					<button class="btn btn-default dorder dpdriver" onclick="return completedTransfer('{{details.DetailsID}}','');">
						<i class="fa fa-check-circle l"></i> <?= MARK_COMPLETED ?>
					</button>
				{{/compare}}
				{{#compare details.DriverConfStatus ">" 0}}
					<button id='resendVoucher' class="btn btn-primary"><?= RESEND_VOUCHER ?></button>
					<label id='lrv' style='display:none'><?= RESEND_VOUCHER ?> Reason</label>	
					{{changeTransferReasonSelect details.ChangeTransferReason}}
					<button id='todriver' class="btn btn-primary" style='display:none'
					onclick="return sendUpdateEmail('{{details.DriverEmail}}','','','','','driver','{{details.DetailsID}}',this);">
						<?= TO_DRIVER ?>
						<div></div>
					</button>
					<button id='topax' class="btn btn-primary" style='display:none'
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

				<button class="btn btn-info" id="buttonsave" title="<?= SAVE ?>"
				onclick="return editSave('{{details.DetailsID}}');">
					<i class="fa fa-save l"></i>
				</button>

				<a href="printTransfer.php?OrderID={{details.OrderID}}" class="btn btn-danger" title="<?= PRINT_CONFIRMATION ?>" target="_blank">
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
								<strong>{{details.OrderID}}-{{details.TNo}}</strong> {{displayTransferStatusText details.TransferStatus}}
								{{#if details.RelatedTransfers.RelatedTransferText includeZero=true}}
									<i class="fa fa-exchange"></i>
									<a href="orders/detail/{{details.RelatedTransfers.RelatedTransfer}}"
									class="badge blue text-black">
										{{details.RelatedTransfers.RelatedTransferText}}</a>
								{{/if}}
							</div>
						</div>

						<input type="hidden" id='agentimage' value='{{userName details.UserID "Image"}}'/>
						<div class="row dagent">
							<div class="col-md-3 "><label><?= BOOKED_BY?></label></div>
							<div class="col-md-9">
								<img id='agentimage2' src='' onerror="this.style.display = 'none';"><strong>{{userName details.UserID "AuthUserCompany"}}</strong>
								({{details.UserID}})
								<input style="display:none" type="text" id="UserID" name="UserID" class="w25" value="{{details.UserID}}" />	
							</div>
						</div>
						
						<div class="row dpassenger" id='ob' style='display:none'>
							<div class="col-md-3 "><label>Other bookings</label></div>
							<div class="col-md-9" id='otherTransfers'></div>									
						</div>		 
						
						{{#compare master.MConfirmFile "!=" ''}}
						<div class="row dagent">
							<div class="col-md-3 "><label>Agent Reference</label></div>
							<div class="col-md-9">
								<strong>{{master.MConfirmFile}}</strong> 
							</div>
							
						</div>
						{{/compare}}
						<div class="row dorder">
							<div class="col-md-3 "><label><?= STATUS ?></label></div>
							<div class="col-md-9">
								{{transferStatusSelect details.TransferStatus}}
							</div>
						</div>

						<div class="row dpdriver">
							<div class="col-md-3 "><label><?= STATUS ?></label></div>
							<div class="col-md-9">
								{{driverConfStatusSelect details.DriverConfStatus}}
								
								{{#compare details.DriverConfStatus "==" 2}}
								{{details.DriverConfDate}} {{details.DriverConfTime}}
								{{/compare}}								
								
							</div>
						</div>
						
						<div class="row dpayment">
							<div class="col-md-3 "><label><?= PRICE ?></label></div>
							<div class="col-md-9">
								<input type="text" id="DetailPrice" name="DetailPrice" class="w25" value="{{details.DetailPrice}}"
								<?= READ_ONLY_FLD ?>>
								<input type="hidden" id="ExtraCharge" name="ExtraCharge"  value="{{details.ExtraCharge}}">
								(+ <span id="ExtraChargeShow">{{details.ExtraCharge}}</span> Extras)
								<input type="hidden" id="Discount" name="Discount"  value="{{details.Discount}}">
								{{#compare details.Discount ">" 0}}
									[incl.-<span>{{details.Discount}}</span>% Coupon]
								{{/compare}}
							</div>
						</div>
						
						<div id='cpr' style='display:none' class="row dprice">
							<div class="col-md-3 "><label>Change price reason</label></div>
							<div class="col-md-9">
								<textarea class="textarea" name="ChangePriceReason" id="ChangePriceReason" cols="40" rows="4"
								style="width:100%"></textarea>
							</div> 
						</div>																			

						<div class="row dtransfer">
							<div class="col-md-3 "><label><?= PAX ?></label></div>
							<div class="col-md-9">
								<input type="text"  name="PaxNo" class="w25" value="{{details.PaxNo}}"
								<?= READ_ONLY_FLD ?>>
							</div>
						</div>

						<div class="row dtransfer">
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
							<!--br> {{vehicleTypeSelect details.VehicleTypeName}} -->
								<button id='changeVehicleType' class="btn btn-primary">Change</button>
								<input style="display:none" type="text" id="VehicleType" name="VehicleType" class="w25" value="{{details.VehicleType}}" />		
							</div>									
						</div>

						<div class="row dpassenger">
							<div class="col-md-3 "><label><?= PAX_FIRST_NAME ?></label></div>
							<div class="col-md-9">
								<input id="PassengerName" name="MPaxFirstName" type="text"  class="w75"
								value="{{master.MPaxFirstName}}"
								<?= READ_ONLY_FLD ?>>
							</div>
						</div>

						<div class="row dpassenger">
							<div class="col-md-3 "><label><?= PAX_LAST_NAME ?></label></div>
							<div class="col-md-9">
								<input id="PassengerName" name="MPaxLastName" type="text"  class="w75"
								value="{{master.MPaxLastName}}"
								<?= READ_ONLY_FLD ?>>
							</div>
						</div>

						<div class="row dpassenger">
							<div class="col-md-3 "><label><?= PAX_TEL ?></label></div>
							<div class="col-md-9">
								<input id="MPaxTel" name="MPaxTel" type="text"  class="w75"
								value="{{master.MPaxTel}}" <?/*{{master.CountryPhonePrefix}}*/?>
								<?= READ_ONLY_FLD ?>>
							</div>
						</div>

						<div class="row dpassenger">
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

						<div class="row dtransfer">
							<div class="col-md-3 "><label><?= PICKUP_DATE ?></label></div>
							<div class="col-md-9">
								<input type="text" name="PickupDate" class="w75 datepicker"
								value="{{details.PickupDate}}"
								<?= READ_ONLY_FLD ?>>
							</div>
						</div>

						<div class="row dtransfer">
							<div class="col-md-3 "><label><?= PICKUP_TIME ?></label></div>
							<div class="col-md-9">
								<input type="text" name="PickupTime" class="w75 timepicker"
								value="{{details.PickupTime}}"
								<?= READ_ONLY_FLD ?>>
							</div>
						</div>

						<div class="row dpassenger">
							<div class="col-md-3 "><label><?= FLIGHT_NO ?></label></div>
							<div class="col-md-9">
								<input type="text" name="FlightNo" class="w75"
								value="{{details.FlightNo}}"
								<?= READ_ONLY_FLD ?>>
							</div>
						</div>
						<div class="row dpassenger">
							<div class="col-md-3 "><label><?= FLIGHT_TIME ?></label></div>
							<div class="col-md-9">
								<input type="text" name="FlightTime" class="w75 timepicker"
								value="{{details.FlightTime}}"
								<?= READ_ONLY_FLD ?>>
							</div>
						</div>

						<div class="row dtransfer">
							<div class="col-md-3 "><label><?= PICKUP_NAME ?></label></div>
							<div class="col-md-9">
								<span class="l">{{details.PickupName}}</span>
							</div>
							<input type="hidden" name="PickupType" value="{{details.PlaceType}}" disabled>
						</div>								
						

						<div class="row dtransfer">
							<div class="col-md-3 "><label><?= PICKUP_ADDRESS ?></label></div>
							<div class="col-md-9">
								<input type="text" name="PickupAddress" class="w75"
								value="{{details.PickupAddress}}"
								<?= READ_ONLY_FLD ?>>
							</div>
						</div>


						<div class="row dtransfer">
							<div class="col-md-3 "><label><?= DROPOFF_NAME ?></label></div>
							<div class="col-md-9">
								<span class="l">{{details.DropName}}</span>
							</div>
						</div>
						
						<div class="row dtransfer">
							<div class="col-md-3 "><label><?= DROPOFF_ADDRESS ?></label></div>
							<div class="col-md-9">
								<input type="text" name="DropAddress" class="w75" value="{{details.DropAddress}}"
								<?= READ_ONLY_FLD ?>>
							</div>
						</div>
						
						<? #05.09.2018. Dejanu potrebno otkljucano pickup notes polje uvijek (Dejan user ID = 875) 05.07.2019. otkljucano i Aleksandru Tiringeru
						

						if(($_SESSION['AuthUserID'] == 875) || ($_SESSION['AuthUserID'] == 1108)){?>
						
							<div class="row">
								<div class="col-md-3 "><label><?= NOTES ?></label></div>
								<div class="col-md-9">
									<br>
									<input type="text" name="PickupNotes" class="w75" value="{{details.PickupNotes}}">
								</div>
							</div>
						<?} else {?>
							<div class="row dpassenger">
								<div class="col-md-3 "><label><?= NOTES ?></label></div>
								<div class="col-md-9">
									<br>
									<small>{{details.PickupNotes}}</small>
								</div>
							</div>
						<?}?>

						<div class="row dtransfer">
							<div class="col-md-3 "><label><?= EXTRAS ?></label><br>
								<button id="bttextrasshow" class="btn btn-primary">Change Extras</button>								
								<button style='display:none;' id="bttextrashide" class="btn btn-primary">Show Extras</button>
							</div>
							<div class="col-md-9">
								<div class="col-md-12" id='changeextras' style='margin-left:-50px'></div>
								<div class="col-md-12">
									<div class="col-md-9">
										<label>Total price for extra services</label>
									</div>
									<div class="col-md-3">
										<span class='extrascharge'>{{details.ExtraCharge}}</span> €
									</div>			
								</div>	
							</div>
						</div>

						<div class="row dagent dorder">
							<div class="col-md-3 "><label><?= ORDER_KEY ?></label></div>
							<div class="col-md-9">
								{{master.MOrderKey}}-{{details.OrderID}}
							</div>
						</div>

						<div class="row dagent dpayment">
							<div class="col-md-3 "><label><?= PROVISION ?></label></div>
							<div class="col-md-9 ">
								<input type="text" name="ProvisionAmount" id="ProvisionAmount" class="w25"
								value="{{details.ProvisionAmount}}" > <?= CURRENCY ?>
							</div>
						</div>
						
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
								<?= READ_ONLY_FLD ?>>
							</div>
							<div class="col-md-3">									
								<button id='extraCash' class="btn btn-primary">Extra Cash</button>
							</div>	
						</div>	
						
						<div class="row dpayment">
							<div class="col-md-3 "><label><?= PAID_ONLINE ?></label></div>
							<div class="col-md-9">
								<input type="text" name="PayNow" id="PayNow" class="w25"
								value="{{details.PayNow}}"
								<?= READ_ONLY_FLD ?>> {{master.MCardNumber}}
							</div>
						</div>														
					
						<!--
						<div class="row" style='border:1px solid #eee; background-color:#F9ECC9'>
							<div class="col-md-2 "><label><?= INVOICE ?></label><br>	  
								{{details.InvoiceNumber}}
							</div>	
							<div class="col-md-2" ><label><?= INVOICE ?> Date</label><br>	  							
								{{details.InvoiceDateO}}   
							</div>			 											
							<div class="col-md-2" ><label><?= INVOICE ?> Total</label><br>	  	     			 			
								{{details.GrandTotalO}} <?= CURRENCY ?>   
							</div>										
							<div class="col-md-2" ><label>Due Date</label><br>	     			 			
								{{details.DueDateO}}
							</div>										
							<div class="col-md-2 "><label><?= PAYMENT_STATUS ?></label><br>	  
								{{details.PaymentStatusO}}
							</div>
						</div>	
						!-->

						<div class="row dpayment">
							<div class="col-md-3 "><label><?= PAYMENT_FOR ?> (Invoice)</label></div>
							<div class="col-md-9">
								<input type="text" name="InvoiceAmount" id="InvoiceAmount" class="w25"
								value="{{details.InvoiceAmount}}"
								<?= READ_ONLY_FLD ?>> 
							</div>
						</div>
						{{#compare details.PaymentMethod ">" 3}}		
						<div class="row dpayment">
							<div class="col-md-3 "><label><?= INVOICE ?></label></div>
							<div class="col-md-9">{{details.InvoiceNumberO}}</div>
						</div>								
						<div class="row dpayment">
							<div class="col-md-3 "><label><?= INVOICE ?> Date</label></div>
							<div class="col-md-9">{{details.InvoiceDateO}}</div>
						</div>	
						<div class="row dpayment">
							<div class="col-md-3 "><label><?= INVOICE ?> Total</label></div>
							<div class="col-md-9">{{details.GrandTotalO}} <?= CURRENCY ?> </div>
						</div>	
						<div class="row dpayment">
							<div class="col-md-3 "><label>Due Date</label></div>
							<div class="col-md-9">{{details.DueDateO}}</div>
						</div>								
						<div class="row dpayment">
							<div class="col-md-3 "><label><?= PAYMENT_STATUS ?></label></div>
							<div class="col-md-9">{{details.PaymentStatusO}}</div>
						</div>	
						{{/compare}} 
						
						<div class="row dpdriver">
							<div class="col-md-3 "><label><?= DRIVER_NAME ?></label></div>
							<div class="col-md-6 driver" id="newDriverName">
								{{driverSelect details.DriverID details.RouteID}}
							</div>
							<div class="col-md-1">
								<button class="btn btn-primary" data-toggle="modal" data-target="#routeDriversModal">
								<i class="fa fa-search"></i></button>
							</div>
							<div class="col-md-1">
								<a class='balance btn-primary' href='driverReOrder/{{details.OrderID}}/{{details.TNo}}' target="_blank">
								<i class="fa fa-balance-scale"></i></a>
							</div>	
							{{#compare details.RelatedTransfers "!=" ""}}	
							{{#compare details.TNo "==" 1}}	
							<div class="col-md-1">
								<a class='balance btn-primary' href='driverReOrder/{{details.OrderID}}/{{details.TNo}}/1' target="_blank">
								<i class="fa fa-balance-scale">R</i></a>
							</div>	
							{{/compare}}
							{{/compare}}
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

						<div class="row dpdriver">
							<div class="col-md-3 "><label><?= DRIVER_TEL ?></label></div>
							<div class="col-md-9 driver" id="newDriverTel">
								{{details.DriverTel}}
							</div>
						</div>

						<div class="row dpdriver">
							<div class="col-md-3 "><label><?= DRIVER_EMAIL ?></label></div>
							<div class="col-md-9 driver" id="newDriverEmail">
								{{details.DriverEmail}}
							</div>
							<input type="hidden" id="sendEmailTo" value="{{details.DriverEmail}}">
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
								<?= READ_ONLY_FLD ?> readonly>
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
						
						<div class="row dorder">
							<div class="col-md-3 "><label>Staff Note</label></div>
							<div class="col-md-9">
								<div id="staffnote">
									<textarea class="textarea" name="StaffNote" id="StaffNotes" cols="40" rows="4"
									style="width:100%">{{{details.StaffNote}}}</textarea>
								</div>
							</div>
						</div>

						<div class="row dorder">
							<div class="col-md-3 "><label>Final Note</label></div>
							<div class="col-md-9">
								<div id="finalnote">
									<textarea class="textarea" name="FinalNote" id="FinalNotes" cols="40" rows="4"
									style="width:100%">{{{details.details.FinalNote}}}</textarea>
								</div>
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
		<input type="hidden" name="DriverID" id="DriverID" value="{{details.DriverID}}">
		<input type="hidden" name="AgentID" id="AgentID" value="{{details.AgentID}}">		
		<input type="hidden" name="DriverName" id="DriverName" value="{{details.DriverName}}">
		<input type="hidden" name="DriverTel" id="DriverTel" value="{{details.DriverTel}}">
		<input type="hidden" name="DriverEmail" id="DriverEmail" value="{{details.DriverEmail}}">
		<input type="hidden" name="DriverConfTime" id="DriverConfTime" value="{{details.DriverConfTime}}">
		<input type="hidden" name="DriverConfDate" id="DriverConfDate" value="{{details.DriverConfDate}}">
		<input type="hidden" name="DriverConfStatus" id="DriverConfStatus" value="{{details.DriverConfStatus}}">

	</form>


</script>

