{{#compare tab "==" "transfer"}}						
    <div class="row dtransfer">
        <div class="col-md-3 "><label><?= VEHICLE ?> <?= PAX ?>/<?= TYPE ?>/<?= NUMBER ?></label></div>
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
        <div class="col-md-3 "><label><?= PICKUP_DATE ?> <?= AND_ ?> <?= PICKUP_TIME ?></label></div>
        <div class="col-md-3">
            <input type="text" name="PickupDate" class="w75 datepicker" value="{{details.PickupDate}}">
        </div>
        <div class="col-md-3">
            <input type="text" name="PickupTime" class="w75 timepicker" value="{{details.PickupTime}}">
        </div>
    </div>
    <div class="row dtransfer">
        <div class="col-md-3 "><label><?= PICKUP_NAME ?> <?= AND_ ?> <?= PICKUP_ADDRESS ?></label></div>
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
                <option value="-1"><?= NO_ROUTE ?></option>
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
    <input type="hidden" id="DriversPrice" name="DriversPrice"  value="{{details.DriversPrice}}">
{{/compare}}