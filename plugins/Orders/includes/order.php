
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
                onclick="return editSaveItem('{{details.DetailsID}}',1);"><?= ADD_RETURN_TRANSFER ?>
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
        <div class="col-md-3 "><label><?= STAFF_NOTE ?></label></div>
        <div class="col-md-9">
            <div id="staffnote">
                <textarea class="textarea" name="StaffNote" id="StaffNotes" cols="40" rows="4"
                style="width:100%">{{details.StaffNote}}</textarea>
            </div>
        </div>
    </div>
    <div class="row dorder">
        <div class="col-md-3 "><label><?= FINAL_NOTE ?></label></div>
        <div class="col-md-9">
            <div id="finalnote">
                <textarea class="textarea" name="FinalNote" id="FinalNotes" cols="40" rows="4"
                style="width:100%">{{details.FinalNote}}</textarea>
            </div>
        </div>
    </div>	
{{/compare}}