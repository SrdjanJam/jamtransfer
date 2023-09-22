{{#compare tab "==" "passenger"}}												
    {{#compare details.UserLevelID "!=" '2'}}
    <div class="row dpassenger">
        <div class="col-md-3 "><label><?= OTHER_BOOKINGS ?></label></div>
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