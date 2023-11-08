{{#compare tab "==" "transfer"}}
    
    <div class="row dtransfer">

        <div class="col-md-3">

            <!-- Vehicle Pax, Type, Number: -->
            <div class="row dtransfer">
                <div class="col-md-12"><label><?= VEHICLE ?> <?= PAX ?>/<?= TYPE ?>/<?= NUMBER ?></label></div>
            </div>
            <div class="row dtransfer">
            
                <div class="col-md-12">
                    <i class="fa fa-person"></i><input type="text"  name="PaxNo" class="w25" value="{{details.PaxNo}}">
                </div>
                <br><br>

                <div class="col-md-9">
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
                </div>
                
                <!-- <div class="row"> -->
                <div class="col-md-12">
                    <div class="col-md-1">x</div>
                    <div class="col-md-4">
                        <input type="text" name="VehiclesNo" class="w75 w75-edit" value="{{details.VehiclesNo}}" style="width: -webkit-fill-available;">
                    </div>
                </div>

            </div>
            <br>
            
            <!-- Pickup_date, Pickup_time: -->
            <div class="row dtransfer">
                <div class="col-md-12"><label><?= PICKUP_DATE ?> <?= AND_ ?> <?= PICKUP_TIME ?></label></div>
            </div>
            <div class="row dtransfer">
                <div class="col-md-5">
                    <input type="text" name="PickupDate" class="w75 datepicker" value="{{details.PickupDate}}">
                </div>
            </div>
            <div class="row dtransfer">
                <div class="col-md-5">
                    <input type="text" name="PickupTime" class="w75 timepicker timepicker-edit" value="{{details.PickupTime}}">
                </div>
            </div>

        </div>
        <br>


        <div class="col-md-9 col-md-9-border" style="border-left:1px dashed black;">

            <!-- Pickup_name, Pickup_address: -->
            <div class="row dtransfer">
                <div class="col-md-5"><label><?= PICKUP_NAME ?> <?= AND_ ?> <?= PICKUP_ADDRESS ?></label></div>
            </div>
            <div class="row dtransfer">
                <div class="col-md-3">
                    <input type="text" name="PickupName" id="PickupName" value="{{details.PickupName}}">
                    <div id="selectFrom_optionsPickup"  style="max-height:15em;overflow:auto"></div>
                </div>							
                <div class="col-md-9">
                    <textarea name="PickupAddress" class="textarea-edit" cols="40" rows="1"
                        style="width:100%">{{details.PickupAddress}}</textarea>
                </div>
            </div>

            <!-- Route to: -->
            <div class="row dtransfer">
                <div class="col-md-3 "><label><?= ROUTE ?> <?= TO ?></label></div>
            </div>
            <div class="row dtransfer">
                <div class="col-md-3">
                    <select name="Route" id="Route">
                        <option value="-1"><?= NO_ROUTE ?></option>
                    </select>
                </div>
            </div>
            <br>

            <!-- Dropoff_name, Dropoff_address: -->
            <div class="row dtransfer">
                <div class="col-md-5 "><label><?= DROPOFF_NAME ?> and <?= DROPOFF_ADDRESS ?></label></div>
            </div>
            <div class="row dtransfer">
                <div class="col-md-3">
                    <input type="text" name="DropName" id="DropName" value="{{details.DropName}}">
                    <div id="selectFrom_optionsDrop"  style="max-height:15em;overflow:auto"></div>
                </div>
                <div class="col-md-9">
                    <textarea name="DropAddress" class="textarea-edit" cols="40" rows="1"
                        style="width:100%">{{details.DropAddress}}</textarea>								
                </div>
            </div>

        </div>

    </div>

    <input type="hidden" id="DriversPrice" name="DriversPrice"  value="{{details.DriversPrice}}">
{{/compare}}