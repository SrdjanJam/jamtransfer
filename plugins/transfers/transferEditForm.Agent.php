<script type="text/x-handlebars-template" id="transferTemplate">

<form id="transferEditForm{{details.DetailsID}}" class="form box box-solid" onsubmit="return false;">

	<input type="hidden" name="UserName" value="<?= $_SESSION['UserName']?>">
	<input type="hidden" name="AuthUserID" value="<?= $_SESSION['AuthUserID']?>">

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

<? /* staro stanje Čet 07 Lip 2018 14:35:21 
			<a href="printTransfer.php?OrderID={{details.OrderID}}" class="btn btn-danger" 
			title="<?= PRINT_CONFIRMATION ?>" target="_blank">
			<i class="fa fa-print l"></i>
			</a>
*/?>
			<a href="printTransferAgent.php?OrderID={{details.OrderID}}" class="btn btn-danger hidden" 
			title="<?= PRINT_CONFIRMATION ?>" target="_blank">
			<i class="fa fa-print l"></i>
			</a>


	
			<a class="btn btn-success" title="<?= PRINT_VOUCHER ?>" 
			href="index.php?p=printAgentVoucher&OrderID={{master.MOrderID}}<? if (in_array($_SESSION['AuthUserID'],$show_price_agent)) {?>&showPrices=1<? }?>" target="_blank">
			<i class="fa fa-user l"></i>
			</a>
	
			<? $josko_array=array(2828,2831);
				if (in_array($_SESSION['AuthUserID'], $josko_array)) {?>			
				<a href="driver/putni_nalog.php?id={{details.DetailsID}}" class="btn" title="Download" target="_blank">
				<i class="fa fa-download l"></i>
				</a>
			<? } ?>		
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
									  
									  {{#each details.RelatedTransfers}}
									  	<i class="fa fa-exchange"></i> 
									  	<a href="index.php?p=editActiveTransfer&rec_no={{RelatedTransfer}}"
									  	class="badge blue text-black">
									  	{{RelatedTransferText}}</a>
									   {{/each}}
								</div>
							</div>
							<div class="row">
								<div class="col-md-3 "><label><?= STATUS ?></label></div>
								<div class="col-md-9">
									{{transferStatusText details.TransferStatus}}
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= PRICE ?></label></div>
								<div  class="col-md-9">
									<span id='pr'>{{details.DetailPrice}}</span> (+ <span id='ex'>{{details.ExtraCharge}}</span> Extras)
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= PAX ?></label></div>
								<div class="col-md-9">
									{{details.PaxNo}}
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= PAX_NAME ?></label></div>
								<div class="col-md-9">
									{{master.MPaxFirstName}} {{master.MPaxLastName}}
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= PAX_EMAIL ?></label></div>
								<div class="col-md-9">
									{{master.MPaxEmail}}
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
								<div class="col-md-3 "><label><?= PAYMENT_METHOD ?></label></div>
								<div class="col-md-9 ">
								  	{{paymentMethodText details.PaymentMethod}}
								</div>
							</div>


							<div class="row">
								<div class="col-md-3 "><label>Payment value</label></div>
								<div id='ia' class="col-md-9">
									{{#compare details.PayNow ">" 0}}{{details.PayNow}}{{/compare}}	
									{{#compare details.PayLater ">" 0}}  
										{{details.PayLater}} <?= $_SESSION['Currency2'] ?>
										<? if($_SESSION['Currency2']=='HRK') {?>	
											/ {{details.PayLaterEUR}} EUR			
										<? }?>										
									{{/compare}}	
									{{#compare details.InvoiceAmount ">" 0}}{{details.InvoiceAmount}}{{/compare}}	
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= PROVISION ?></label></div>
								<div id='pa' class="col-md-9">
									{{details.ProvisionAmount}}
								</div>
							</div>
														
							<div class="row">
								<div class="col-md-3 "><label><?= STATUS ?></label></div>
								<div class="col-md-9 driver" id="newDriverConfirm">
									<span class="{{driverConfStyle details.DriverConfStatus}}">
									{{driverConfText details.DriverConfStatus}} 
									</span>
								</div>
							</div>

							

							
						</div> {{!-- col --}}
					</div> {{!-- row --}}
				</div> {{!-- tab-pane tab_1 --}}
				
				
			</div> {{!-- tab-content --}}
	    </div> {{!-- nav tabs custom end --}}
	</div> {{!-- box-body --}}
	
	{{!-- Statuses and messages --}}
	<div class="box-footer">
		<span id="statusMessage" class="text-info xl"></span>
	</div>
	
	
	<input type="hidden" name="DriverID" id="DriverID" value="{{details.DriverID}}">
	<input type="hidden" name="DriverName" id="DriverName" value="{{details.DriverName}}">
	<input type="hidden" name="DriverTel" id="DriverTel" value="{{details.DriverTel}}">	
	<input type="hidden" name="DriverConfTime" id="DriverConfTime" value="{{details.DriverConfTime}}">
	<input type="hidden" name="DriverConfDate" id="DriverConfDate" value="{{details.DriverConfDate}}">
	<input type="hidden" name="DriverConfStatus" id="DriverConfStatus" value="{{details.DriverConfStatus}}">
	<input type="hidden" name="ExchFaktor" id="ExchFaktor" value="<?=$_SESSION['ExchFaktor'] ?>">

</form>

	<script>
		/*$( document ).ready(function() {
			var ef = $("#ExchFaktor").val();
			$('#pr').text(($('#pr').text()*ef).toFixed(2));
			$('#ex').text(($('#ex').text()*ef).toFixed(2));			
			$('#ia').text(($('#ia').text()*ef).toFixed(2));
			$('#pa').text(($('#pa').text()*ef).toFixed(2));
			
		});*/		
		// uklanja ikonu Saved - statusMessage sa ekrana
		$("form").change(function(){
			$("#statusMessage").html('');
		});

	</script>    
</script>


