<form name="exchangeRate" method="post" action="">
    <div class="container">
        <div class="box box-info pad1em shadowLight">

            <div class="row">
                <div class="col-md-3">{$EUR_TO_RSD}</div>
                <div class="col-md-3">
                    <input type="text" name="exchangeRate" value="{$tecaj}"> RSD
                </div>		
                <div class="col-md-6">
                    <button name="setRate" type="submit" class="btn btn-primary " value="1">{$SET_NEW_RATE}</button>
                </div>	
            </div>
            
            {$message}

        </div>
    </div>
</form>
