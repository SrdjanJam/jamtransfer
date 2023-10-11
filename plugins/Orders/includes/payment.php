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
            <div class="col-md-3 "><label><?= DRIVER_S ?> <?= EXTRAS ?></label></div>
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
            <div class="col-md-3 "><label><?= DISCOUNT ?></label></div>
            <div class="col-md-9">
                <input type="text" id="Discount" name="Discount"  value="{{details.Discount}}"> %
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 "><label><?= COMMISSION ?></label></div>
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
            <div class="col-md-3 "><label><?= DUE_DATE ?></label></div>
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