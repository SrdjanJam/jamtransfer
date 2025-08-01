<div class="row">	
	<div class="box-header">
		<div class="box-tools pull-right">
			{if $ordersD[pom].DriverConfStatus gt 0}
				<button type="button" class="btn btn-primary rv-modal"  
					data-detailsid="{$ordersD[pom].DetailsID}"  
					data-toggle="modal" data-target="#rvModal{$ordersD[pom].DetailsID}">
					{$RESEND_VOUCHER}
				</button>
							<div class="modal fade"  id="rvModal{$ordersD[pom].DetailsID}">
								<div class="modal-dialog" style="width: fit-content;">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title">{$RESEND_VOUCHER} {$ordersD[pom].OrderID} - {$ordersD[pom].TNo}</h4>
										</div>
										<div class="rv"></div>
										<div class="modal-body row" style="padding:10px">
											<div class="col-md-12">
												<label class="" id='lrv{$ordersD[pom].DetailsID}'>{$RESEND_VOUCHER} Reason</label>
											</div>
											<div class="col-md-12">
												{html_options id="rv{$ordersD[pom].DetailsID}" class="form-control" name=ChangeTransferReason options=$ChangeTransferReason}					
											</div>
											<div class="col-md-6">
												<button id='todriver' class="btn btn-primary"
												onclick="return sendUpdateEmail('{$ordersD[pom].DriverEmail}','','','','','driver',' {$ordersD[pom].DetailsID}',this);">
													{$TO_DRIVER}
												</button>
												<button id='topax' class="btn btn-primary"
												onclick="return sendUpdateEmail('{$ordersD[pom].Master.MPaxEmail}','','','','','pax',' {$ordersD[pom].DetailsID}',this);">
													{$TO_PAX}
												</button>
											</div>	
										</div>
										
										<div class="modal-footer">
											<button type="button" class="btn btn-primary col-md-12 modalbutton" data-dismiss="modal">{$CLOSE}</button>
										</div>
									</div>
								</div>
							</div>	
			{/if}
			<button class="btn btn-success save" data-id="{$ordersD[pom].DetailsID}" title="{$SAVE}">
				<i class="fa fa-save l"></i>
			</button>
			<a href="plugins/Orders/printTransfer.php?OrderID= {$ordersD[pom].OrderID}" class="btn btn-info" title="{$PRINT_CONFIRMATION}" target="_blank">
				<i class="fa fa-print l"></i>
			</a>
		</div>
	</div>
</div>	
	<div class="box-body"><form id="form{$ordersD[pom].DetailsID}">
		<input type="hidden" name="UserName" id="UserName" value="{$smarty.session.UserName}">
		<input type="hidden" name="AuthUserID" id="AuthUserID" value="{$smarty.session.AuthUserID}">
		<input type="hidden" id="OrderID" name="OrderID"   value=" {$ordersD[pom].OrderID}">
		<input type="hidden" id="DetailsID" name="DetailsID"   value=" {$ordersD[pom].DetailsID}">
		<input type="hidden" id="UserLevelID" name="UserLevelID"   value=" {$ordersD[pom].UserLevelID}">	
	
		<div class="row">
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-3 "><label>{$ID}</label></div>
					<div class="col-md-3">
						<strong> {$ordersD[pom].OrderID}- {$ordersD[pom].TNo}</strong> 
					</div>	
					<div class="col-md-6">
						{html_options class="form-control" name=TransferStatus options=$StatusDescription selected=$ordersD[pom].TransferStatus}					
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 "><label>{$BOOKED_BY}</label></div>
					<div class="col-md-3">
						{html_options name=UserLevelID options=$authLevels selected=$ordersD[pom].UserLevelID class="form-control LevelID"}
					</div>	
					<div class="col-md-3">	
						<select name="UserID" value="{$ordersD[pom].UserID}" class="form-control UserID">
							<option value="-1" data-levelid="-1">Choose user</option>
							{section name=ind loop=$users} 
								<option value="{$users[ind].UserID}" data-levelid="{$users[ind].LevelID}"
								{if $users[ind].UserID eq $ordersD[pom].UserID}SELECTED{/if}
								>{$users[ind].UserName}</option>
							{/section}
						</select>						
					</div>
				</div>					
				<div class="row">
					<div class="col-md-3 "><label>Booked for</label></div>
					<div class="col-md-3">
						{html_options name=AgentLevelID options=$authLevels class="form-control LevelID"}
					</div>	
					<div class="col-md-3">	
						<select name="AgentID" value="{$ordersD[pom].AgentID}" class="form-control UserID">
							<option value="-1" data-levelid="-1">Choose user</option>
							{section name=ind loop=$users} 
								<option value="{$users[ind].UserID}" data-levelid="{$users[ind].LevelID}"
								{if $users[ind].UserID eq $ordersD[pom].AgentID}SELECTED{/if}
								>{$users[ind].UserName}</option>
							{/section}
						</select>						
					</div>
					<div class="col-md-3">	
						{if $ordersD[pom].Image ne ""}
							<img src='i/agents/{$ordersD[pom].Image}'>	 
						{/if}
					</div>
				</div>	
				{if $ordersD[pom].UserLevelID eq '2'}
				<div class="row">
					<div class="col-md-3 "><label>Agent Reference</label></div>
					<div class="col-md-9">
						<input type="text" name="MConfirmFile" id="MConfirmFile" value=" {$ordersD[pom].Master.MConfirmFile}"/>
					</div>
				</div>
				{/if}	
				<div class="row">
					<div class="col-md-3 "><label>{$PRICE}</label></div>
					<div class="col-md-9">
						<input type="text" id="DetailPrice" name="DetailPrice" class="w25" value=" {$ordersD[pom].DetailPrice|number_format:2:".":","}"
						{$READ_ONLY_FLD}>
						{*<input type="hidden" id="ExtraCharge" name="ExtraCharge"  value="{$ordersD[pom].ExtraCharge}">*}
						(+ <span id="ExtraChargeShow"> {$ordersD[pom].ExtraCharge}</span> Extras)
						<input type="hidden" id="Discount" name="Discount"  value=" {$ordersD[pom].Discount}">
						{if $ordersD[pom].Discount gt 0}
							[incl.-<span> {$ordersD[pom].Discount}</span>% Coupon]
						{/if}
					</div>
				</div>	
				<div class="row">
					<div class="col-md-3 "><label>{$PAX}</label></div>
					<div class="col-md-9">
						<input type="text"  name="PaxNo" class="w25" value=" {$ordersD[pom].PaxNo}">
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 "><label>{$VEHICLETYPEID}</label></div>
					<div class="col-md-9">
						{if $ordersD[pom].VehicleClass lt 10}
							<i class="fa fa-car"></i>
						{/if}
						{if $ordersD[pom].VehicleClass gt 9}
							{if $ordersD[pom].VehicleClass lt 20}
								<i class="fa fa-car indigo-text"></i>
							{/if}
						{/if}
						{if $ordersD[pom].VehicleClass gt 19}
							<i class="fa fa-car purple-text"></i>
						{/if}
						{if $ordersD[pom].VehiclesAll|count gt 0}{$ordersD[pom].VehicleType}
							<select name="VehicleType" value="{$ordersD[pom].VehicleType}">
								{section name=ind2 loop=$ordersD[pom].VehiclesAll} 
									<option value="{$ordersD[pom].VehiclesAll[ind2].VehicleTypeID}"
									{if $ordersD[pom].VehiclesAll[ind2].VehicleTypeID eq $ordersD[pom].VehicleType}SELECTED{/if}
									>{$ordersD[pom].VehiclesAll[ind2].VehicleName}</option>
								{/section}
							</select>
						{else}
							{$ordersD[pom].VehicleTypeName}
						{/if}
						x 
						<input id="VehiclesNo" name="VehiclesNo" type="number"  value="{$ordersD[pom].VehiclesNo}">
					</div>									
				</div>				
				<div class="row">
					<div class="col-md-3 "><label>{$PAX_FIRST_NAME}</label></div>
					<div class="col-md-9">
						<input id="PassengerName" name="MPaxFirstName" type="text"  class="w75"
						value=" {$ordersD[pom].Master.MPaxFirstName}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3 "><label>{$PAX_LAST_NAME}</label></div>
					<div class="col-md-9">
						<input id="PassengerName" name="MPaxLastName" type="text"  class="w75"
						value=" {$ordersD[pom].Master.MPaxLastName}">
					</div>
				</div>				
				<div class="row">
					<div class="col-md-3 "><label>{$PAX_TEL}</label></div>
					<div class="col-md-9">
						<input id="MPaxTel" name="MPaxTel" type="text"  class="w75"
						value=" {$ordersD[pom].Master.MPaxTel}">
						<a href="tel: {$ordersD[pom].Master.MPaxTel}">Call</a>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 "><label>{$PAX_EMAIL}</label></div>
					<div class="col-md-9">
						<input id="PassengerEmail" name="MPaxEmail" type="text"  class="w50"
						value=" {$ordersD[pom].Master.MPaxEmail}">
						<a href="mailto: {$ordersD[pom].Master.MPaxEmail}" class="btn" title="Send E-mail">
							<i class="fa fa-envelope l"></i>
						</a>
					</div>
				</div>	
				<div class="row">
					<div class="col-md-3 "><label>{$PICKUP_DATE}</label></div>
					<div class="col-md-9">
						<input type="text" name="PickupDate" class="w75 datepicker"
						value=" {$ordersD[pom].PickupDate}">
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 "><label>{$PICKUP_TIME}</label></div>
					<div class="col-md-9">
						<input type="text" name="PickupTime" class="w75 timepicker"
						value="{$ordersD[pom].PickupTime}">
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 "><label>{$FLIGHT_NO}</label></div>
					<div class="col-md-9">
						<input type="text" name="FlightNo" class="w75"
						value="{$ordersD[pom].FlightNo}">
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 "><label>{$FLIGHT_TIME}</label></div>
					<div class="col-md-2">
						<input type="text" name="FlightTime" class="w75 timepicker"
						value="{$ordersD[pom].FlightTime}">
					</div>		
				</div>
				<div class="row">
					<div class="col-md-3 "><label>{$PICKUP_NAME}</label></div>
					<div class="col-md-9">
						<span class="l"> {$ordersD[pom].PickupName}</span>
					</div>
				</div>								
				<div class="row">
					<div class="col-md-3 "><label>{$PICKUP_ADDRESS}</label></div>
					<div class="col-md-9">
						<input type="text" name="PickupAddress" class="w75"
						value=" {$ordersD[pom].PickupAddress}">
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 "><label>{$DROPOFF_NAME}</label></div>
					<div class="col-md-9">
						<span class="l"> {$ordersD[pom].DropName}</span>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 "><label>{$DROPOFF_ADDRESS}</label></div>
					<div class="col-md-9">
						<input type="text" name="DropAddress" class="w75" value=" {$ordersD[pom].DropAddress}">
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 "><label>{$NOTES}</label></div>
					<div class="col-md-9">
						<input type="text" name="PickupNotes" class="w75" value=" {$ordersD[pom].PickupNotes}">
					</div>
				</div>		
				<button class="btn-block row" type="button" data-toggle="collapse" data-target="#collapseExtras{$ordersD[pom].DetailsID}" aria-expanded="false" aria-controls="collapseExtras">
					<div class="col-md-3 "><label>{$EXTRAS}</label></div>
					<div class="col-md-9">
						<input type="text" class="ExtraCharge" name="ExtraCharge" value="{$ordersD[pom].ExtraCharge}" readonly></span> €	
					</div>				
				</button>
				<div class="collapse" id="collapseExtras{$ordersD[pom].DetailsID}">
					<div class="card card-body">
						{section name=pom2 loop=$ordersD[pom].ExtrasArr}
						<div class="row extrasrow">
							<div class="col-md-6">
								<select name="ExtrasID[]" value="{$ordersD[pom].ExtrasArr[pom2].ServiceID}" class="form-control ExtrasID">
									<option value="-1">Choose extras</option>
									{section name=pom3 loop=$ordersD[pom].ExtrasAllArr} 
										<option value="{$ordersD[pom].ExtrasAllArr[pom3].ID}"
										{if $ordersD[pom].ExtrasAllArr[pom3].ID eq $ordersD[pom].ExtrasArr[pom2].ServiceID}SELECTED{/if}
										>{$ordersD[pom].ExtrasAllArr[pom3].ServiceEN}</option>
									{/section}
								</select>
							</div>
							<div class="col-md-2">
								<input type="text" data-id="{$ordersD[pom].DetailsID}" name="ExtrasPrice[]" class="form-control ExtrasPrice" value="{$ordersD[pom].ExtrasArr[pom2].Price}">
							</div>	
							<div class="col-md-1">	
								x 
							</div>	
							<div class="col-md-2">		
								<input type="number" data-id="{$ordersD[pom].DetailsID}" name="ExtrasQty[]" class="form-control ExtrasQty" value="{$ordersD[pom].ExtrasArr[pom2].Qty}">
							</div>
						</div>
						{/section}
						<div class="row extrasrow">
							<div class="col-md-6">
								<select name="ExtrasID[]" value="{$ordersD[pom].ExtrasArr[pom2].ServiceID}" class="form-control ExtrasID newExtras">
									<option value="-1">Choose extras</option>
									{section name=pom3 loop=$ordersD[pom].ExtrasAllArr} 
										<option data-price="{$ordersD[pom].ExtrasAllArr[pom3].Price}" value="{$ordersD[pom].ExtrasAllArr[pom3].ID}">{$ordersD[pom].ExtrasAllArr[pom3].ServiceEN}</option>
									{/section}
								</select>
							</div>
							<div class="col-md-2">
								<input type="text" data-id="{$ordersD[pom].DetailsID}" name="ExtrasPrice[]" class="form-control ExtrasPrice hidden" value="0.00">
							</div>	
							<div class="col-md-1 multiple hidden">	
								x 
							</div>	
							<div class="col-md-2">		
								<input type="number" data-id="{$ordersD[pom].DetailsID}" name="ExtrasQty[]" class="form-control ExtrasQty hidden" value="0">
							</div>
						</div>						
					</div>
				</div>	
				
				<div class="box-footer">
					{*<span id="statusMessage" class="text-info xl"></span>
					<button title="This delete permanently this transfer and all its data." class="btn btn-default" onclick="return deleteTransfer({$ordersD[pom].DetailsID});">
						<i class="fa fa-trash-o l"></i> {$DELETE_TRANSFER}
					</button>
					<button class="btn btn-default" onclick="return cancelTransfer({$ordersD[pom].DetailsID});">
						<i class="fa fa-times-circle l"></i> {$CANCEL_TRANSFER}
					</button>
					<button class="btn btn-default" onclick="return activateTransfer({$ordersD[pom].DetailsID});">
						<i class="fa fa-undo l"></i> {$MARK_ACTIVE}
					</button>
					{if $ordersD[pom].DriverConfStatus gt 0}
						<button class="btn btn-default" onclick="return completedTransfer('{$ordersD[pom].DetailsID}','');">
							<i class="fa fa-check-circle l"></i> {$MARK_COMPLETED}
						</button>
						<button class="btn btn-default" onclick="$('#noShow').show('slow');">
							<i class="fa fa-minus-square l"></i> {$MARK_NOSHOW} / {$MARK_ERROR}
						</button>
						<div class="row">
							<div id="noShow" class="col-md-12" style="display:none">
								<br>{$DETAIL_DESCRIPTION}:<br>
								<textarea name="FinalNote" id="FinalNote" rows="5">{$ordersD[pom].FinalNote}</textarea>
								<button class="btn btn-primary"
									onclick="changeDriverConfStatus('{$ordersD[pom].DetailsID}', '5');$('#btnSave').click();">
									<i class="fa fa-minus-square l"></i> {$MARK_NOSHOW}
								</button>
								<button class="btn btn-danger"
									onclick="changeDriverConfStatus('{$ordersD[pom].DetailsID}', '6');$('#btnSave').click();">
									<i class="fa fa-taxi l"></i> {$MARK_DRIVER_ERROR}
								</button>
								<button class="btn btn-danger"
									onclick="changeDriverConfStatus('{$ordersD[pom].DetailsID}', '8');$('#btnSave').click();">
									<i class="fa fa-tasks l"></i> {$MARK_OPERATOR_ERROR}
								</button>
								<button class="btn btn-danger"
									onclick="changeDriverConfStatus('{$ordersD[pom].DetailsID}', '9');$('#btnSave').click();">
									<i class="fa fa-road l"></i> {$MARK_DISPATCHER_ERROR}
								</button>	
								<button class="btn btn-danger"
									onclick="changeDriverConfStatus('{$ordersD[pom].DetailsID}', '10');$('#btnSave').click();">
									<i class="fa fa-globe l"></i> {$MARK_AGENT_ERROR}
								</button>	
								<button class="btn btn-danger"
									onclick="changeDriverConfStatus('{$ordersD[pom].DetailsID}', '11');$('#btnSave').click();">
									<i class="fa fa-snowflake-o l"></i> {$MARK_FORCE_MAJEURE}
								</button>		
								<button class="btn btn-danger"
									onclick="changeDriverConfStatus('{$ordersD[pom].DetailsID}', '12');$('#btnSave').click();">
									<i class="fa fa-question-circle l"></i> {$MARK_PENDING}
								</button>							
							</div>
						</div>
					{/if}
					{if $ordersD[pom].Master.MSendEmail eq 0}
						<button class="btn btn-default" onclick="toggleSurvey('{$ordersD[pom].Master.MOrderID}', false, this)">
							<i class="fa fa-list-alt"></i> Disable Survey
						</button>
					{/if}*}
					{if $ordersD[pom].Master.MSendEmail eq 2}
						<button class="btn btn-default" onclick="toggleSurvey('{$ordersD[pom].Master.MOrderID}', true, this)">
							<i class="fa fa-list-alt"></i> Enable Survey
						</button>
					{/if}
				</div>
			</div>	
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-3 "><label>Logs</label></div>
					<div class="col-md-9">
						<button type="button" class="btn btn-primary logs-modal"  
							data-detailsid="{$ordersD[pom].DetailsID}"  
							data-toggle="modal" data-target="#logsModal{$ordersD[pom].DetailsID}">
							<i class="fa fa-search"></i>
						</button>
					</div>	
				</div>
				<div class="modal fade"  id="logsModal{$ordersD[pom].DetailsID}">
					<div class="modal-dialog" style="width: fit-content;">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h4 class="modal-title">Logs for order {$ordersD[pom].OrderID} - {$ordersD[pom].TNo}</h4>
							</div>
							<div class="logs"></div>
							<div class="modal-body row" style="padding:10px">
							</div>
							
							<div class="modal-footer">
								<button type="button" class="btn btn-primary col-md-12 modalbutton" data-dismiss="modal">{$CLOSE}</button>
							</div>
						</div>
					</div>
				</div>			
				<div class="row">
					<div class="col-md-3 "><label>{$ORDER_KEY}</label></div>
					<div class="col-md-9">
						 {$ordersD[pom].Master.MOrderKey}- {$ordersD[pom].OrderID}
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 "><label>{$PROVISION}</label></div>
					<div class="col-md-9 ">
						<input type="text" name="ProvisionAmount" id="ProvisionAmount" class="w25"
						value="{$ordersD[pom].ProvisionAmount}" >
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 "><label>{$PAYMENT_METHOD}</label></div>
					<div class="col-md-9 ">
						{html_options name=PaymentMethod options=$PaymentMethod selected=$ordersD[pom].PaymentMethod}
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 "><label>{$CASH}</label></div>
					<div class="col-md-9">
						{if !($ordersD[pom].PaymentMethod eq 2 or $ordersD[pom].PaymentMethod eq 3)}
							<button type="button" class="extra"><i class="fa fa-plus" aria-hidden="true"></i></button>
						{/if}	
						<input type="text" name="PayLater" id="PayLater" class="w25 
							{if !($ordersD[pom].PaymentMethod eq 2 or $ordersD[pom].PaymentMethod eq 3)}hidden{/if}"
						value=" {$ordersD[pom].PayLater}" 
						>
					</div>
				</div>					
				<div class="row">
					<div class="col-md-3 "><label>{$PAID_ONLINE}</label></div>
					<div class="col-md-9">
						{if !($ordersD[pom].PaymentMethod eq 1 or $ordersD[pom].PaymentMethod eq 3)}
							<button type="button" class="extra"><i class="fa fa-plus" aria-hidden="true"></i></button>
						{/if}						
						<input type="text" name="PayNow" id="PayNow" class="w25 
							{if !($ordersD[pom].PaymentMethod eq 1 or $ordersD[pom].PaymentMethod eq 3)}hidden{/if}"
						value=" {$ordersD[pom].PayNow}"> 
						<input type="text" name="MCardNumber" id="MCardNumber" class="w25
							{if !($ordersD[pom].PaymentMethod eq 1 or $ordersD[pom].PaymentMethod eq 3)}hidden{/if}"
						value=" {$ordersD[pom].Master.MCardNumber}">										
					</div>
				</div>														
				<div class="row">
					<div class="col-md-3 "><label>{$PAYMENT_FOR} (Invoice)</label></div>
					<div class="col-md-9">
						{if !($ordersD[pom].PaymentMethod eq 4 or $ordersD[pom].PaymentMethod eq 6)}
							<button type="button" class="extra"><i class="fa fa-plus" aria-hidden="true"></i></button>
						{/if}					
						<input type="text" name="InvoiceAmount" id="InvoiceAmount" class="w25
							{if !($ordersD[pom].PaymentMethod eq 4 or $ordersD[pom].PaymentMethod eq 6)}hidden{/if}"
						value=" {$ordersD[pom].InvoiceAmount}"> 
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 "><label>{$TERMINAL} Filter</label></div>	
					<div class="col-md-6 "><button data-id="{$ordersD[pom].TerminalID}" type="button" class="form-control terminalfilter">{$ordersD[pom].TerminalName}</button></div>	
					<div class="col-md-3 "><button type="button" class="form-control terminalfilterundo" disabled><i class="fa fa-undo" aria-hidden="true"></i></button></div>	
				</div>				
				<div class="row">
					<div class="col-md-3 "><label>{$DRIVER_NAME}</label></div>
					<div class="col-md-8" ">
						{*<input type="text" name="DriverName" id="DriverName{$ordersD[pom].DetailsID}" value="{$ordersD[pom].DriverName} {$users[{$ordersD[pom].DriverID}].AuthRealName}">*}
						
						<select name="DriverID" id="DriverID{$ordersD[pom].DetailsID}"  value="{$ordersD[pom].DriverID}">
							{section name=ind3 loop=$drivers} 
								<option value="{$drivers[ind3].UserID}"
								{if $drivers[ind3].UserID eq $ordersD[pom].DriverID}SELECTED{/if}
								>{$drivers[ind3].CountryUserName}</option>
							{/section}
						</select>
					</div>	
					<div class="col-md-1">
						{*<input type="hidden" name="DriverID" id="DriverID{$ordersD[pom].DetailsID}" value="{$ordersD[pom].DriverID}">*}
						<button type="button" class="btn btn-primary drivers-modal" 
							data-detailsid="{$ordersD[pom].DetailsID}"  
							data-routeid="{$ordersD[pom].RouteID}"  
							data-pickupdate="{$ordersD[pom].PickupDate}"  
							data-pickuptime="{$ordersD[pom].PickupTime}"  
							data-agentid="{$ordersD[pom].AgentID}"  
							data-toggle="modal" data-target="#routeDriversModal{$ordersD[pom].DetailsID}">
							<i class="fa fa-search"></i>
						</button>
						{if $ordersD[pom].DriverConfStatus eq 0}
							<a class="btn btn-primary" target='_blank' href='driverReOrder/{$ordersD[pom].OrderID}/{$ordersD[pom].TNo}'>
								<i class="fa fa-balance-scale"></i>
							</a>
							{if $ordersD[pom].DetailPrice ne $ordersD[pom].Master.MTransferPrice}
							<a class="btn btn-primary"target='_blank' href='driverReOrder/{$ordersD[pom].OrderID}/{$ordersD[pom].TNo}/1'>
								<i class="fa fa-balance-scale">R</i>
							</a>	
							{/if}
						{/if}
					</div>	
				</div>
				<div class="modal fade"  id="routeDriversModal{$ordersD[pom].DetailsID}">
					<div class="modal-dialog" style="width: fit-content;">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h4 class="modal-title">{$PRICES_FOR_ROUTE} {$ordersD[pom].RouteID}</h4>
							</div>
							<div class="modal-body row" style="padding:10px">
								<strong>
								<div class="col-md-3">{$DRIVER_COMPANY}</div>
								<div class="col-md-1">{$TYPE}</div>
								<div class="col-md-1 right">{$NETO}</div>												
								<div class="col-md-1 right">{$ADDS}</div>
								<div class="col-md-1 right">{$PROVISION} (%)</div>
								<div class="col-md-2 right">{$FINAL_PRICE}</div>
								{*<div class="col-md-1 right">{$PROVISION}2 (%)</div>
								<div class="col-md-2 right">{$FINAL_PRICE}2</div>*}
								</strong><br>
							</div>
								<div class="driverByRoute"></div>
							
							<div class="modal-footer">
								<button type="button" class="btn btn-primary col-md-12 modalbutton" data-dismiss="modal">{$CLOSE}</button>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 "><label>{$DRIVER_TEL}</label></div>
					<div class="col-md-9">
						 <input type="text" name="DriverTel" id="DriverTel{$ordersD[pom].DetailsID}" value="{$ordersD[pom].DriverTel}"/>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 "><label>{$DRIVER_EMAIL}</label></div>
					<div class="col-md-9">
						 <input type="text" name="DriverEmail" id="DriverEmail{$ordersD[pom].DetailsID}" value="{$ordersD[pom].DriverEmail}"/>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3"><label>{$DRIVER_STATUS}</label></div>
					<div class="col-md-3 driver" id="DriverConfStatus{$ordersD[pom].DetailsID}">
						{html_options class="form-control DriverConfStatus" name=DriverConfStatus options=$DriverConfStatus selected=$ordersD[pom].DriverConfStatus}					
					</div>
					<div class="col-md-6">		
						<span class="{$driverConfClass[{$ordersD[pom].DriverConfStatus}]}">
							{$DriverConfStatus[{$ordersD[pom].DriverConfStatus}]}
						</span>
						{if $ordersD[pom].DriverConfStatus eq 2}
							{$ordersD[pom].DriverConfDate}  {$ordersD[pom].DriverConfTime}
						{/if}
					</div>					
				</div>
				<div class="finalnote row {if $ordersD[pom].DriverConfStatus lt 5}hidden{/if}">
					<div class="col-md-3 "><label>{$FINAL_NOTE}</label></div>
					<div class="col-md-9">
						<div id="summernote">
							<textarea class="textarea" name="FinalNotes"  cols="40" rows="4"
							style="width:100%">{$ordersD[pom].FinalNotes}</textarea>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 "><label>Confirmation link</label></div>
					<div class="col-md-6" id="confirlmLink{$ordersD[pom].DetailsID}">
						<a href='https://wis.jamtransfer.com/dc.php?
							code= {$ordersD[pom].DetailsID}
							&control= {$ordersD[pom].Master.MOrderKey}
							&id={$ordersD[pom].DriverID}'
						> {$ordersD[pom].OrderID}- {$ordersD[pom].TNo}</a>
					</div>								
				</div>					
				<div class="row">
					<div class="col-md-3 "><label>{$DRIVERS_PRICE}</label></div>
					<div class="col-md-9">
						<input type="text" id="DriversPrice" name="DriversPrice" class="w25" value=" {$ordersD[pom].DriversPrice}">
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 "><label>Driver {$EXTRAS}</label></div>
					<div class="col-md-9">
						<input type="text" id="DriverExtraCharge" name="DriverExtraCharge" class="w25" value=" {$ordersD[pom].DriverExtraCharge}">
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 "><label>{$DRIVER_PAID_AMOUNT}</label></div>
					<div class="col-md-9">
						<input type="text" id="DriverPaymentAmt" name="DriverPaymentAmt" class="w25"
						value="{if $ordersD[pom].DriverPaymentAmt gt 0} {$ordersD[pom].DriverPaymentAmt}{/if}{if $ordersD[pom].DriverPaymentAmt eq 0} {$ordersD[pom].DriversPrice}{/if}"
						 readonly>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 "><label>{$SUBDRIVERS}</label></div>
					<div class="col-md-9">
						{$ordersD[pom].Subdriver} {$ordersD[pom].SubdriverMob} {$ordersD[pom].Subdriver2} {$ordersD[pom].Subdriver2Mob} 				
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3 "><label>{$MESSAGE}</label></div>
					<div class="col-md-9">
						<div id="summernote">
							<textarea class="textarea" name="DriverNotes" id="DriverNotes" cols="40" rows="4"
							style="width:100%">{$ordersD[pom].DriverNotes}</textarea>
						</div>
						{*<button class="btn btn-primary"
						onclick="return sendEmailToDriver('{$ordersD[pom].OrderID}',' {$ordersD[pom].TNo}');">
							{$SEND_EMAIL_TO_DRIVER}
							<div id="sendMessageResponse"></div>
						</button>*}
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 "><label>Staff Note</label></div>
					<div class="col-md-9">
						<div id="staffnote">
							<textarea class="textarea" name="StaffNote" id="StaffNotes" cols="40" rows="4"
							style="width:100%">{$ordersD[pom].StaffNote}</textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form></div>
