<style>
.selectable {
	margin: 0;
}
.selectable:hover {
	background: #3c8dbc;
	color: white;
	cursor: pointer;
}
.blockedit {	
	pointer-events:none;		
}
</style>

<script type="text/x-handlebars-template" id="transferTemplate">

	<form id="transferEditForm{{details.DetailsID}}" class="form box box-solid" onsubmit="return false;">

		<input type="hidden" name="UserName" id="UserName" value="<?= $_SESSION['UserName']?>">
		<input type="hidden" name="AuthUserID" id="AuthUserID" value="<?= $_SESSION['AuthUserID']?>">
		<input type="hidden" id="OrderID" name="OrderID"   value="{{details.OrderID}}">
		<input type="hidden" id="UserLevelID" name="UserLevelID"   value="{{details.UserLevelID}}">
		
		
		<div class="box-header">
			<div class="box-title">
				<h3><?= EDIT.B.TRANSFER ?>  {{details.OrderID}}-{{details.TNo}}  [{{details.PaxName}}]</h3>
			</div>
			<div class="box-tools pull-right">
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

							<div class="col-md-4">						
								<div class="row">
									<div class="col-md-3 "><label><?= ID ?></label></div>
									<div class="col-md-9">
										<strong>{{details.OrderID}}-{{details.TNo}}</strong> {{displayTransferStatusText details.TransferStatus}}

										{{#each details.RelatedTransfers}}
											<i class="fa fa-exchange"></i>
											<a href="index.php?p=editActiveTransfer&rec_no={{RelatedTransfer}}"
											class="badge blue text-black">{{RelatedTransferText}}</a>
										{{/each}}
									</div>
								</div>
								<input type="hidden" id='agentimage' value='{{userName details.UserID "Image"}}'/>
								<div class="row">
									<div class="col-md-3 "><label><?= BOOKED_BY?></label></div>
									<div class="col-md-9">
										<img id='agentimage2' src='' onerror="this.style.display = 'none';"><strong>{{userName details.UserID "AuthUserCompany"}}</strong>
										({{details.UserID}})
									</div>
								</div>
								
								<div class="row" id='ob' style='display:none'>
									<div class="col-md-3 "><label>Other bookings</label></div>
									<div class="col-md-9" id='otherTransfers'></div>									
								</div>		 
								
								{{#compare master.MConfirmFile "!=" ''}}
								<div class="row">
									<div class="col-md-3 "><label>Agent Reference</label></div>
									<div class="col-md-9">
										<strong>{{master.MConfirmFile}}</strong> 
									</div>
									
								</div>
								{{/compare}}

								<div class="row">
									<div class="col-md-3 "><label><?= PRICE ?></label></div>
									<div class="col-md-9">
										{{details.DetailPrice}}
										(+ <span>{{details.ExtraCharge}}</span> Extras)
										{{#compare details.Discount ">" 0}}
											[incl.-<span>{{details.Discount}}</span>% Coupon]
										{{/compare}}
									</div>
								</div>
								
								<div class="row">
									<div class="col-md-3 "><label>Pax Name</label></div>
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

								<div class="row">
									<div class="col-md-3 "><label><?= PAX_EMAIL ?></label></div>
									<div class="col-md-9">
										{{master.MPaxEmail}}
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
									<div class="col-md-3 "><label><?= PICKUP_DATE ?></label></div>
									<div class="col-md-9">
										{{details.PickupDate}}
									</div>
								</div>
								<div class="row">
									<div class="col-md-3 "><label><?= PICKUP_NAME ?></label></div>
									<div class="col-md-9">
										<span class="l">{{details.PickupName}}</span>
									</div>
								</div>								
								<div class="row">
									<div class="col-md-3 "><label><?= DROPOFF_NAME ?></label></div>
									<div class="col-md-9">
										<span class="l">{{details.DropName}}</span>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3 "><label>Staff Note</label></div>
									<div class="col-md-9">
		                                <div id="staffnote">
											<small>{{details.StaffNote}}</small>
										</div>
									</div>
								</div>								
							</div>


		                {{!-- right side --}}

							<div class="col-md-4">
								<div class="row">
									<input type="hidden" id="OrderKey" value="{{master.MOrderKey}}"/>
									<div class="col-md-3 "><label><?= ORDER_KEY ?></label></div>
									<div class="col-md-9">
										{{master.MOrderKey}}-{{details.OrderID}}
									</div>
								</div>
								{{#compare details.ProvisionAmount ">" 0}}
								<div class="row">
									<div class="col-md-3 "><label><?= PROVISION ?></label></div>
									<div class="col-md-9 ">
										{{details.ProvisionAmount}}
									</div>
								</div>
								{{/compare}}
								<div class="row">
									<div class="col-md-3 "><label><?= PAYMENT_METHOD ?></label></div>
									<div class="col-md-9 ">
										{{details.PaymentMethodName}}
									</div>
								</div>
								{{#compare details.PayLater ">" 0}}
								<div class="row">
									<div class="col-md-3 "><label><?= CASH ?></label></div>
									<div class="col-md-9">
										{{details.PayLater}} 
									</div>
								</div>	
								{{/compare}}	
								{{#compare details.PayNow ">" 0}}								
								<div class="row">
									<div class="col-md-3 "><label><?= PAID_ONLINE ?></label></div>
									<div class="col-md-9">
										{{details.PayNow}} {{master.MCardNumber}}
									</div>
								</div>														
								{{/compare}}	
								{{#compare details.InvoiceAmount ">" 0}}								
								<div class="row">
									<div class="col-md-3 "><label>Bank transfer</label></div>
									<div class="col-md-9">
										{{details.InvoiceAmount}}
									</div>
								</div>	
								{{/compare}}									
								<div class="row">
									<div class="col-md-3 "><label><?= PAYMENT_STATUS ?></label></div>
									<div class="col-md-9">{{details.PaymentStatusO}}</div>
								</div>	
								
								<div class="row">
									<div class="col-md-3 "><label><?= DRIVER_NAME ?></label></div>
									<div class="col-md-6 driver" id="newDriverName">
										{{details.DriverName}}
									</div>
								</div>
															
								<div class="row">
									<div class="col-md-3 "><label><?= DRIVER_STATUS ?></label></div>
									<div class="col-md-9 driver" id="newDriverConfirm">
										<span class="{{driverConfStyle details.DriverConfStatus}}">
										{{driverConfText details.DriverConfStatus}}
										</span>
										{{#compare details.DriverConfStatus "==" 2}}
										{{details.DriverConfDate}} {{details.DriverConfTime}}
										{{/compare}}
									</div>
								</div>

								<div class="row">
									<div class="col-md-3 "><label><?= DRIVERS_PRICE ?></label></div>
									<div class="col-md-9">
										{{details.DriversPrice}}
										(+ <span>{{details.DriverExtraCharge}}</span> Extras)
									</div>
								</div>								
								<div class="row">
									<div class="col-md-3 "><label><?= DRIVER_PAID_AMOUNT ?></label></div>
									<div class="col-md-9">
										{{#compare details.DriverPaymentAmt ">" 0}}{{details.DriverPaymentAmt}}{{/compare}}{{#compare details.DriverPaymentAmt "==" 0}}{{details.DriversPrice}}{{/compare}}
									</div>
								</div>		
								{{#compare details.PayNow ">" 0}}									
								<div class="row">
									<div class="col-md-3 "><label>Voutcher</label></div>
									<div class="col-md-9" id="Voutcher">
									{{#compare details.Voutcher "!==" ""}}	
										{{details.VoutcherText}}<br>
										<a target='_blank' href='{{details.VoutcherPDFfile}}'>{{details.VoutcherKey}}</a> ({{details.VoutcherValue}} EUR) <br>
										<a target='_blank' href='https://jamtransfer.com/cms/requestVResponse.php?key={{details.VoutcherKey}}&cd=1'>Confirm link</a><br>
										<a target='_blank' href='https://jamtransfer.com/cms/requestVResponse.php?key={{details.VoutcherKey}}&cd=2'>Decline link</a>
									{{/compare}}
									{{#compare details.Voutcher "===" ""}}	
										<input type="text" name="VoutcherValue" id="VoutcherValue" placeholder="Value" class="w25" value="{{master.MPayNow}}"> 
										<button class="btn btn-primary" id="RequestVoutcher">Send Request</button>	
									{{/compare}}		
									</div>
								</div>	
								{{/compare}}
								
							</div> {{!-- col --}}
							{{!-- right side --}}
							<div class="col-md-4">
								<div class="row">
									<div class="col-md-3 "><label>Document value (EUR)</label></div>
									<div class="col-md-9">
									{{details.DocumentValue}} 
									</div>
								</div>									
							</div>	
							<div class="col-md-4">
								<div class="row">
									<div class="col-md-3 "><label>Document currency</label></div>
									<div class="col-md-9">
									{{details.DocumentCurrency}} 
									</div>
								</div>									
							</div>								
							<div class="col-md-4">
								<div class="row">
									<div class="col-md-3 "><label>Service type</label></div>
									<div class="col-md-9">
									{{details.ServiceType}}
									</div>
								</div>									
							</div>
							<div class="col-md-4">
								<div class="row">
									<div class="col-md-3 "><label>Transfer area</label></div>
									<div class="col-md-9">
									{{details.TransferArea}}
									</div>
								</div>									
							</div>
							<div class="col-md-4">
								<div class="row">
									<div class="col-md-3 "><label>Document recipient</label></div>
									<div class="col-md-9">
									{{details.TypeDocumentRecepient}}  {{#compare details.TypeDocumentRecepient "==" "Pravno lice"}} - {{details.OriginDocumentRecepient}} - {{details.DocumentRecepient}} {{/compare}}
									</div>
								</div>									
							</div>								
							<div class="col-md-4">
								<div class="row">
									<div class="col-md-3 "><label>VAT document status</label></div>
									<div class="col-md-9">
									{{details.VatDocumentStatus}}
									</div>
								</div>									
							</div>							
						</div> {{!-- row --}}
						<div class="row">
							<div class="col-md-12" >
								<div class="col-md-2">
									<label>Type</label>
								</div>
								<div class="col-md-2">
									<label>Code</label>
								</div>							
								<div class="col-md-2">
									<label>Date</label>
								</div>	
								{{#each details.RelatedTransfers}}
								<div class="col-md-2">
									<label>One Way</label>
								</div>								
								{{/each}}
														
								<div class="col-md-2">
									<label>Issue</label>
								</div>	
							</div>	
							{{#each details.Documents}}
							<div class="col-md-12" >
								<div class="col-md-2">
									{{DocumentTypeName}}					
								</div>
								<div class="col-md-2">
									{{DocumentCode}}	
								</div>							
								<div class="col-md-2">
									{{DocumentDate}}
								</div>	
								{{#each details.RelatedTransfers}}
								<div class="col-md-2">
									<input type="checkbox" id="OneWay" name="OneWay" value='' >
								</div>								
								{{/each}}		
								<div class="col-md-2">
									{{IssueDate}}
								</div>	
								<div class="col-md-2">
									<a target='_blank' href='/cms/pdfdocument/{{DocumentCode}}-{{../details.OrderID}}.pdf'>PDF</a>
								</div>										
							</div>								

							{{/each}}
							<div class="col-md-12" >
								<div class="col-md-2">
									{{documentTypeSelect details.DocumentType}}					
								</div>
								<div class="col-md-2">
									<input type="text" name="DocumentCode" id="DocumentCode" class="w75" >

								</div>							
								<div class="col-md-2">
									<input type="text" name="DocumentDate" id="DocumentDate" class="w75 datepicker" > 
								</div>	
								{{#each details.RelatedTransfers}}
								<div class="col-md-2">
									<input type="checkbox" id="OneWay" name="OneWay" value='' >
								</div>								
								{{/each}}		
								<div class="col-md-2">
									<button class="btn btn-primary"id="CreateDocument">Create</button>						
								</div>									

							</div>								
						</div>		
					</div> {{!-- tab-pane tab_1 --}}

					<div class="tab-pane" id="tab_2{{details.DetailsID}}">
								{{#if orderLog}}
									<ul class="timeline">

										{{#each orderLog}}
						<div class="row">
							<div class="col-sm-12">
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
					</div>{{!-- tab-pane tab_3 --}}
				</div>	
			</div> {{!-- tab-content --}}
		</div> {{!-- nav tabs custom end --}}


		<input type="hidden" name="DetailsID" id="DetailsID" value="{{details.DetailsID}}">
		<input type="hidden" name="DriverID" id="DriverID" value="{{details.DriverID}}">
		<input type="hidden" name="AgentID" id="AgentID" value="{{details.AgentID}}">		
		<input type="hidden" name="DriverName" id="DriverName" value="{{details.DriverName}}">
		<input type="hidden" name="DriverTel" id="DriverTel" value="{{details.DriverTel}}">
		<input type="hidden" name="DriverEmail" id="DriverEmail" value="{{details.DriverEmail}}">
		<input type="hidden" name="DriverConfTime" id="DriverConfTime" value="{{details.DriverConfTime}}">
		<input type="hidden" name="DriverConfDate" id="DriverConfDate" value="{{details.DriverConfDate}}">
		<input type="hidden" name="DriverConfStatus" id="DriverConfStatus" value="{{details.DriverConfStatus}}">
		<!--<input type="hidden" name="VehicleType" id="VehicleType" value="{{details.VehicleType}}">!-->
		<?
		    //TODO
		    // dodati SVA polja vezana za SubDrivere, tako da se kod promjene vozaca mogu resetirati
		    // inace ta polja ostanu, pa bi moglo bit problema
		    // resetiranje napraviti u cms.jquery.js func applyChangeDriver()
		
		?>
	</form>
 
	<script> 
	var vv=$('#VoutcherValue').val();
	$('#VoutcherValue').val((vv*0.85).toFixed(2));
	
	var agentimage=$('#agentimage').val();
	if (agentimage !='' && agentimage !='null') {
		agentimage='img/'+agentimage;
		$('#agentimage2').attr('src',agentimage);
	}	
		

	
	// uklanja ikonu Saved - statusMessage sa ekrana
	$("form").change(function(){
		$("#statusMessage").html('');
	});


	$("#RequestVoutcher").click(function(){
		var OrderKey=$('#OrderKey').val();	
		var VoutcherValue=$('#VoutcherValue').val();
		var OrderID=$('#OrderID').val();	
		
		var param="OrderKey="+OrderKey+"&OrderID="+OrderID+"&VoutcherValue="+VoutcherValue;
		var url = window.root + '/cms/a/'+"requestVoutcher.php";
		console.log(url+'?'+param);		
		//ajax za kreiranje sloga u tabeli
		$.ajax({
			type: 'POST',
			url: url,
			data: param,
			async: false,
			success: function(data) {
				$('#Voutcher').empty();
				$('#Voutcher').html(data);	
			}
		});			
		
	});

	$("#CreateDocument").click(function(){
		var DetailsID=$('#DetailsID').val();	
		var OrderID=$('#OrderID').val();	
		var DocumentType=$('#DocumentType').val();
		var DocumentCode=$('#DocumentCode').val();
		var DocumentDate=$('#DocumentDate').val();	
		if(typeof $('#OneWay').attr('name') != "undefined"){
			var OneWay=$('#OneWay').prop('checked');
		}
		else var OneWay=false;
		var pass=1;
		if (DocumentType==0) {
			alert ("Choose Document Type");
			pass=0;
		}		
		if (!DocumentCode) {
			alert ("Fill Document Code");
			pass=0;
		}	
		if (!DocumentDate) {
			alert ("Fill Document Date");
			pass=0;
		}
		if (pass==1) {
			var param="DetailsID="+DetailsID+"&OrderID="+OrderID+"&DocumentType="+DocumentType+"&DocumentCode="+DocumentCode+"&DocumentDate="+DocumentDate+"&OneWay="+OneWay;
			var url = window.root + '/cms/a/'+"createDocument.php";
			console.log(url+'?'+param);		
			//ajax za kreiranje sloga u tabeli
			$.ajax({
				type: 'POST',
				url: url,
				data: param,
				async: false,
				success: function(data) {
					var newData = $("#transferEditForm"+DetailsID).serializeObject();
					refreshData(DetailsID, newData);
					$(".editFrame").hide('slow');
				}
			});			
		}	
		
	});
		
	</script>
</script>

