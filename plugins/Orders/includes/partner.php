{{#compare tab "==" "pdriver"}}						
    <div class="row dpdriver">
        <div class="col-md-3 "><label><?= DRIVER_NAME ?></label></div>
        <div class="col-md-5 driver" id="newDriverName">	
            {{driverSelect details.DriverID details.RouteID details.VehicleType}}
        </div>
        <div class="col-md-3 ">
            <!--<input type="text" name="VehicleType" id="VehicleType" value="{{details.VehicleType}}" >!-->
            {{vehicleTypeSelect details.VehicleType "VehicleType" "VehicleType"}}						
        </div>	
        <div class="col-md-1 searchdrivers">
            <!-- Call the modal: ------------------------------ -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#routeDriversModal">
                <i class="fa fa-search"></i>
            </button>
			<span class="btn btn-primary"><a target='_blank' href='driverReOrder/{{details.OrderID}}/{{details.TNo}}'>
				<i class="fa fa-balance-scale" aria-hidden="true"></i>
			</a></span>
			{{#compare details.RelatedTransfers "!=" ""}}	
			{{#compare details.TNo "==" 1}}	
			<span class="btn btn-primary"><a target='_blank' href='driverReOrder/{{details.OrderID}}/{{details.TNo}}/1'>
				<i class="fa fa-balance-scale" aria-hidden="true">R</i>
			</a></span>									

			{{/compare}}
			{{/compare}}			
        </div>								
    </div>	
    
    <!-- Modal content: --------------------------------------- -->
    <div class="modal fade"  id="routeDriversModal">
        <div class="modal-dialog" style="width: fit-content;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title"><?=PRICES_FOR_ROUTE;?> {{details.RouteID}}</h4>
                </div>
                <div class="modal-body" style="padding:10px">
                    <strong>
                    <div class="col-md-3"><?=DRIVER_COMPANY;?></div>
                    <div class="col-md-1"><?=TYPE;?></div>
                    <div class="col-md-1 right"><?=NETO;?></div>												
                    <div class="col-md-1 right"><?=ADDS;?></div>
                    <div class="col-md-1 right"><?=PROVISION;?> (%)</div>
                    <div class="col-md-2 right"><?=FINAL_PRICE;?></div>
                    <div class="col-md-1 right"><?=PROVISION;?>2 (%)</div>
                    <div class="col-md-2 right"><?=FINAL_PRICE;?>2</div>
                    </strong><br>
                    {{listDriversByRoute details.RouteID details.PickupDate details.PickupTime details.VehicleType details.AgentID}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary col-md-12 modalbutton" data-dismiss="modal"><?=CLOSE;?></button>
                </div>
            </div>
        </div>
    </div>
    <!-- ---------------------------------------------------------- -->
            
    <div class="row dpdriver">
        <div class="col-md-3">

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
			<input type="hidden" id="DetailPriceX" name="DetailPriceX" class="w25">

            <!--<div class="row">
                <div class="col-md-3 "><label><?= PARTNER_S ?> <?= EXTRAS ?></label></div>
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
            </div>!-->
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
        </div> <!-- /.col-md-3 -->

        <div class="col-md-5">
			{{#compare details.DriverConfStatus "==" 1}}
			<div class="row">
				<div class="col-md-3 "><label>Confirmation link</label></div>
				<div class="col-md-6 driver" id="confirlmLink">
					<a href='https://<?= $_SERVER['SERVER_NAME'] ?>/cms/dc.php?
						code={{details.DetailsID}}
						&control={{master.MOrderKey}}
						&id={{details.DriverID}}'
					>{{details.OrderID}}-{{details.TNo}}</a>
				</div>								
				<div class="col-md-3 driver" id="whatsapp">
					<a target="_blank" href="https://wa.me/{{details.ContactMobWhtsApp}}/?text={{details.MessageWhtsApp}}"
					><i class="fa fa-whatsapp fa-lg" aria-hidden="true"></i></a>
				</div>
			</div>	
			{{/compare}}	
            {{#compare details.PaymentMethod "==" 2}}					
            <div class="row">
                <div class="col-md-3 "><label><?= PARTNER ?> <?= INVOICE ?></label></div>
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
                <div class="col-md-3 "><label><?= DUE_DATE ?></label></div>
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
            <? if (isset($_SESSION['UseDriverID'])) {?>
            <div class="row">
                <div class="col-md-12"><a target="_blank" href='schedule/{{details.PickupDate}}'><?= SCHEDULE_FOR ?> {{details.PickupDate}}</a></div>
            </div>
            <? } ?>
            <div class="row">
                <div class="col-md-12"><label><?= SUB_DRIVER ?></label></div>
            </div>
            <div class="row">
                <div class="col-md-8">{{subdriverSelect details.SubDriver details.DriverID 'SubDriver'}}  </div>	
                <div class="col-md-4"><a id="SubDriverMob" href=""></a></div>	
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
                <div class="col-md-12 "><label><?= MESSAGE_FOR_DRIVER ?></label></div>
            </div>	
            <div class="row">								
                <div class="col-md-12">
                    <textarea class="textarea" name="SubDriverNote" id="SubDriverNote" cols="40" rows="4"
                    style="width:100%">{{details.SubDriverNote}}</textarea>
                </div>
            </div>	
            {{#compare details.SubFinalNote '!==' ''}}		
            <div class="row">
                <div class="col-md-12 "><label><?= MESSAGE_FROM_DRIVER ?></label></div>
            </div>	
            <div class="row">
                <div class="col-md-12">{{details.SubFinalNote}}</div>
            </div>
            {{/compare}}										
            {{#compare details.CashIn '>' 0}}		
            <div class="row">
                <div class="col-md-6 "><label><?= RECEIVED_CASH ?></label></div>
                <div class="col-md-6">
                    {{details.CashIn}}
                </div>
            </div>		
            {{/compare}}		
        </div>
        {{/compare}}

    </div>	<!-- /.row .dpdriver -->
    
{{/compare}} <!-- /pdiver -->