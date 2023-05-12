<?= $newID ?>
<script type="text/x-handlebars-template" id="ItemEditTemplate">

	<form id="ItemEditForm{{details.DetailsID}}" class="form box box-info" method="post" onsubmit="return false;">
				
		<div class="box-header box-header-edit">
			<div class="box-tools pull-right">
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
				<button class="btn " title="<?= CLOSE ?>"
				onclick="return editCloseItem('{{details.DetailsID}}');">
					<i class="fa fa-chevron-up l""></i>
				</button>
				<button id="save" class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
				onclick="return editSaveItem('{{details.DetailsID}}');">
				<i class="fa fa-save"></i>
				</button>
			</div>
		</div>

		<div class="box-body box-body-edit">
			<div class="nav-tabs-custom nav-tabs-custom-edit">
				{{#compare tab "==" "order"}}
				<ul class="nav nav-tabs dorder">
					<li class="active"><a href="#tab_1{{details.DetailsID}}" data-toggle="tab"><?= TRANSFER ?></a></li>
					<li><a href="#tab_2{{details.DetailsID}}" data-toggle="tab"><?= ORDER_LOG ?></a></li>
				</ul>
				{{/compare}}
				<div class="tab-content tab-content-edit">
					<div class="tab-pane active" id="tab_1{{details.DetailsID}}">
						{{#compare tab "==" "order"}}
						<div class="row dorder">
							<div class="col-md-3 "><label><?= ID ?></label></div>
							<div class="col-md-9">
								<strong>{{details.OrderID}}-{{details.TNo}}</strong> {{transferStatusSelect details.TransferStatus}}
								<i class="fa fa-exchange"></i>
								{{#if details.RelatedTransfers.RelatedTransferText includeZero=true}}
									<a href="orders/detail/{{details.RelatedTransfers.RelatedTransfer}}"
										class="badge blue text-black">
										{{details.RelatedTransfers.RelatedTransferText}}
									</a>
								{{else}}		
									<button id="saveR" class="badge blue text-black" title="Add Return Transfer" 
									onclick="return editSaveItem('{{details.DetailsID}}',1);">Add Return Transfer
									</button>
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
						{{/compare}}
						{{#compare tab "==" "payment"}}
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
								<div class="row">
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
								<div class="row">
									<div class="col-md-3 "><label><?= PAID_ONLINE ?></label></div>
									<div class="col-md-9">
										<input type="text" name="PayNow" id="PayNow" class="w25"
										value="{{details.PayNow}}"> {{master.MCardNumber}}
									</div>
								</div>	
								<div class="row">
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
						{{/compare}}
						{{#compare tab "==" "transfer"}}						
						<div class="row dtransfer">
							<div class="col-md-3 "><label><?= VEHICLE ?> <?= PAX ?>/<?= TYPE ?>/Number</label></div>
							<div class="col-md-3">
								<i class="fa fa-person"></i><input type="text"  name="PaxNo" class="w25" value="{{details.PaxNo}}">
							</div>
							<div class="col-md-4">
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
							x
								<input type="text" name="VehiclesNo" class="w75" value="{{details.VehiclesNo}}">
							</div>									
						</div>
						<div class="row dtransfer">
							<div class="col-md-3 "><label><?= PICKUP_DATE ?> and <?= PICKUP_TIME ?></label></div>
							<div class="col-md-3">
								<input type="text" name="PickupDate" class="w75 datepicker" value="{{details.PickupDate}}">
							</div>
							<div class="col-md-3">
								<input type="text" name="PickupTime" class="w75 timepicker" value="{{details.PickupTime}}">
							</div>
						</div>
						<div class="row dtransfer">
							<div class="col-md-3 "><label><?= PICKUP_NAME ?> and <?= PICKUP_ADDRESS ?></label></div>
							<div class="col-md-3">
								<input type="text" name="PickupName" id="PickupName" value="{{details.PickupName}}">
								<div id="selectFrom_optionsPickup"  style="max-height:15em;overflow:auto"></div>
							</div>							
							<div class="col-md-6">
								<textarea name="PickupAddress" cols="40" rows="4"
									style="width:100%">{{details.PickupAddress}}</textarea>
							</div>
						</div>
						<div class="row dtransfer">
							<div class="col-md-3 "><label><?= ROUTE ?> <?= TO ?></label></div>
							<div class="col-md-6">
								<select name="Route" id="Route">
									<option value="-1">No route</option>
								</select>
							</div>
						</div>	
						<div class="row dtransfer">
							<div class="col-md-3 "><label><?= DROPOFF_NAME ?> and <?= DROPOFF_ADDRESS ?></label></div>
							<div class="col-md-3">
								<input type="text" name="DropName" id="DropName" value="{{details.DropName}}">
								<div id="selectFrom_optionsDrop"  style="max-height:15em;overflow:auto"></div>
							</div>
							<div class="col-md-6">
								<textarea name="DropAddress" cols="40" rows="4"
									style="width:100%">{{details.DropAddress}}</textarea>								
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
											<!--ako novi drajver nema ekstras koji je izabran u bukingu!-->
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
											<input type="number" class="w25" name="Qty[{{ID}}]" id="Qty[{{ID}}]" value="{{Qty}}" style="width:100% !important;">
										</div>
									</div>
								{{/each}}
							</div>
						</div>						
						{{/compare}}
						{{#compare tab "==" "pdriver"}}						
						<div class="row dpdriver">
							<div class="col-md-3 "><label><?= DRIVER_NAME ?></label></div>
							<div class="col-md-9 driver" id="newDriverName">	
								{{driverSelect details.DriverID details.RouteID details.VehicleType}}
							</div>
						</div>	
						<div class="row dpdriver">
							<div class="col-md-4">
								<div class="row">
									<div class="col-md-3 "><label><?= STATUS ?></label></div>
									<div class="col-md-9">
										{{driverConfStatusSelect details.DriverConfStatus "DriverConfStatus"}}
										{{#compare details.DriverConfStatus "==" 2}}
										{{details.DriverConfDate}} {{details.DriverConfTime}}
										{{/compare}}								
									</div>
								</div>	
								<div class="row">
									<div class="col-md-3 "><label><?= DRIVER_TEL ?></label></div>
									<div class="col-md-9">
										<input type="text" id="DriverTel" name="DriverTel" class="w25" value="{{details.DriverTel}}">							
									</div>
								</div>
								<div class="row">
									<div class="col-md-3 "><label><?= DRIVER_EMAIL ?></label></div>
									<div class="col-md-9">
										<input type="text" id="DriverEmail" name="DriverEmail" class="w25" value="{{details.DriverEmail}}">															
									</div>
								</div>
								<div class="row">
									<div class="col-md-3 "><label><?= DRIVERS_PRICE ?></label></div>
									<div class="col-md-9">
										<input type="text" id="DriversPrice" name="DriversPrice" class="w25" value="{{details.DriversPrice}}">
									</div>
								</div>
								<div class="row">
									<div class="col-md-3 "><label>Partner's <?= EXTRAS ?></label></div>
									<div class="col-md-9">
										<input type="text" id="DriverExtraCharge" name="DriverExtraCharge" class="w25" value="{{details.DriverExtraCharge}}">
									</div>
								</div>
								<div class="row">
									<div class="col-md-3 "><label><?= DRIVER_PAID_AMOUNT ?></label></div>
									<div class="col-md-9">
										<input type="text" id="DriverPaymentAmt" name="DriverPaymentAmt" class="w25"
										value="{{#compare details.DriverPaymentAmt ">" 0}}{{details.DriverPaymentAmt}}{{/compare}}{{#compare details.DriverPaymentAmt "==" 0}}{{details.DriversPrice}}{{/compare}}"
										 readonly>
									</div>
								</div>	
								<div class="row">
									<div class="col-md-12 "><label><?= MESSAGE ?></label></div>
								</div>	
								<div class="row">									
									<div class="col-md-12">
										<div id="summernote">
											<textarea class="textarea" name="DriverNotes" id="DriverNotes" cols="40" rows="4"
											style="width:100%">{{details.DriverNotes}}</textarea>
										</div>
										<button class="btn btn-primary"
										onclick="return sendEmailToDriver('{{details.OrderID}}','{{details.TNo}}');">
											<?= SEND_EMAIL_TO_DRIVER ?>
											<div id="sendMessageResponse"></div>
										</button>										
									</div>
								</div>								
							</div>
							<div class="col-md-4">
								{{#compare details.PaymentMethod "==" 2}}					
								<div class="row">
									<div class="col-md-3 "><label>Partner <?= INVOICE ?></label></div>
									<div class="col-md-9">{{details.DriverInvoiceNumberO}}</div>	
								</div>
								<div class="row">
									<div class="col-md-3 "><label><?= INVOICE ?> Date</label></div>
									<div class="col-md-9">{{details.DriverInvoiceDateO}}  </div>	
								</div>								
								<div class="row">
									<div class="col-md-3 "><label><?= INVOICE ?> Total</label></div>
									<div class="col-md-9">{{details.DriverGrandTotalO}} EUR    </div>	
								</div>									
								<div class="row">
									<div class="col-md-3 "><label>Due Date</label></div>
									<div class="col-md-9">{{details.DriverDueDateO}}</div>	
								</div>			 											
								<div class="row">
									<div class="col-md-3 "><label><?= PAYMENT_STATUS ?></label></div>
									<div class="col-md-9">{{details.DriverPaymentStatusO}}</div>	
								</div>	
								{{/compare}}	
							</div>
							{{#compare details.DriverConfStatus ">" "1"}}
							<div class="col-md-4">
								<div class="row">
									<a target="_blank" href='schedule/{{details.PickupDate}}'>Schedule for {{details.PickupDate}}</a>
								</div>
								<div class="row"><label>SubDriver</label></div>
								<div class="row">
									<div class="col-md-9">{{subdriverSelect details.SubDriver details.DriverID 'SubDriver'}}  </div>	
									<div class="col-md-3"><a id="SubDriverMob" href=""></a></div>	
								</div>	
								{{#compare details.SubDriver "!==" "0"}}
								<div class="row">
									<div class="col-md-9">{{subdriverSelect details.SubDriver2 details.DriverID 'SubDriver2'}}  </div>	
									<div class="col-md-3"><a id="SubDriver2Mob" href=""></a></div>	
								</div>	
								{{#compare details.SubDriver2 "!==" "0"}}
								<div class="row">
									<div class="col-md-9">{{subdriverSelect details.SubDriver3 details.DriverID 'SubDriver3'}}  </div>	
									<div class="col-md-3"><a id="SubDriver3Mob" href=""></a></div>	
								</div>	
								{{/compare}}
								{{/compare}}
								<div class="row">
									<div class="col-md-12 "><label>Message for driver</label></div>
								</div>	
								<div class="row">								
									<div class="col-md-12">
										<textarea class="textarea" name="SubDriverNote" id="SubDriverNote" cols="40" rows="4"
										style="width:100%">{{details.SubDriverNote}}</textarea>
									</div>
								</div>	
								{{#compare details.SubFinalNote '!==' ''}}		
								<div class="row">
									<div class="col-md-12 "><label>Message from driver</label></div>
								</div>	
								<div class="row">
									<div class="col-md-12">{{details.SubFinalNote}}</div>
								</div>
								{{/compare}}										
								{{#compare details.CashIn '>' 0}}		
								<div class="row">
									<div class="col-md-6 "><label>Received cash</label></div>
									<div class="col-md-6">
										{{details.CashIn}}
									</div>
								</div>		
								{{/compare}}		
							</div>
							{{/compare}}		
						</div>	
						{{/compare}}
						{{#compare tab "==" "agent"}}						
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
								<input name="MConfirmFile" id="MConfirmFile" value="{{master.MConfirmFile}}"/> 
							</div>
						</div>
						{{/compare}}
						<div class="row dagent">
							<div class="col-md-3 "><label><?= PROVISION ?></label></div>
							<div class="col-md-9 ">
								<input name="ProvisionAmount" id="ProvisionAmount" value="{{details.ProvisionAmount}}"/> 
							</div>
						</div>	
						{{/compare}}
						{{#compare tab "==" "passenger"}}												
						{{#compare details.UserLevelID "!=" '2'}}
						<div class="row dpassenger">
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
						{{/compare}}						
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
								value="{{master.MPaxEmail}}">
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
						{{/compare}}
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
		<input type="hidden" name="RouteID" id="RouteID" value="{{details.RouteID}}" >
		<input type="hidden" name="sendEmailTo" id="sendEmailTo" value="{{details.DriverEmail}}">
		
	</form>
	<? if ($isNew) { ?>
		<script>
		$('document').ready(function() {
			$("#save").trigger("click");
		});		
		</script>
	<? } else  { ?>	
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
			if ($('#DriverConfStatus').val() != 3) {
				$('#SubDriver').prop( "disabled", true );
				$('#SubDriver2').prop( "disabled", true );
				$('#SubDriver3').prop( "disabled", true );
			}			
		}
		// promena telefona i email-a nakon promene drivera
		$('#DriverID').change(function(){
			$('#DriverTel').val($('#DriverID :selected').attr('data-tel'));
			$('#DriverEmail').val($('#DriverID :selected').attr('data-email'));
		})			
		// promena mobilnog nakon promene subdrivera
		function changesubdriver (i) {
			$('#SubDriver'+i+'Mob').attr('href','tel:'+($('#SubDriver'+i+' :selected').attr('data-tel')));
			$('#SubDriver'+i+'Mob').text($('#SubDriver'+i+' :selected').attr('data-tel'));
		}		
		changesubdriver ('');		
		changesubdriver ('2');		
		changesubdriver ('3');		
		$('#SubDriver').change(function(){changesubdriver ('');})	
		$('#SubDriver2').change(function(){changesubdriver ('2');})	
		$('#SubDriver3').change(function(){changesubdriver ('3');})	
		// promena lokacija		
		$('#PickupName,#DropName').on('click keyup', function(event) {
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
								var fid=$(this).attr('id');
								$("#selectFrom_options"+loc).hide("slow");
								$.ajax({
									url:  './api/getToPlacesEdge.php',
									type: 'GET',
									dataType: 'jsonp',
									data: {
										fid : fid
									},
									error: function() {
										//callback();
									},
									success: function(res) {
										$.each(res, function(index, element) {
											console.log(element.RouteName)
											$("#Route").append(
												'<option data-toid="'+element.ToID+'" value="'+element.ID+'">'+element.ToPlace+'</option>'
											)	
										});				
										console.log (res);
									}
								})		
								
							});						
						}						
					}
				})	
			}
		})	
		// proemena rute
		$('#Route').change(function() {
			
			var toName = $(this).find("option:selected").text();	
			var toID = $(this).find("option:selected").attr('data-toid');	
			var rID = $(this).find("option:selected").val();
			$('#DropName').val(toName);
			$('#DropID').val(toID);
			$('#RouteID').val(rID);
		})	
		// promena ekstrasa
		$('.ServiceID').change(function() {
			var driverprice = $(this).find('option:selected').attr('data-driverprice');
			$(this).parent().parent().find('.driverprice').val(driverprice);			
			var price = $(this).find('option:selected').attr('data-price');
			$(this).parent().parent().find('.price').val(price);
		})	
		// resend voucher
		$('#ChangeTransferReason').hide();
		$('#resendVoucher').click(function() {
			$("#lrv").show(300);
			$("#ChangeTransferReason").show(300);
			$("#resendVoucher").hide();
		})	
		$('#ChangeTransferReason').click(function() {
			$('#todriver').show(300);
			$('#topax').show(300);		
		})			
	</script>
	<? } ?>
</script>

