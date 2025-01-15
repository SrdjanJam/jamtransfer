    <body>
    <style>
        input, select { width: 200px; }
        #RequiredFrom, #RequiredTo { visibility: hidden; padding-left: 4px; color: red; }
        .formLabel { width: 100px; display: inline-block; }
    </style>
	{if isset($smarty.request.submit)}
		<div class="grey lighten-2" style="font-size:13px;">
		<br><div class="center"><h1>Liste de transfert de chauffeur</h1><h3>{$subdriver.AuthUserRealName}</h3>
		{$smarty.request.Year}-{$smarty.request.Month}-01-{$smarty.request.Year}-{$smarty.request.Month}-{$daysInMonth}

	
	
	{else}
    <div class="">
        <form action="" method="post" onsubmit="return validate()">
            <input type="hidden" name="DriverID" value="{$DriverID}">
            <div class="row">
                <div class="formLabel">{$MONTH}:</div>
				<select name="Month" class="form-control">
					{html_options values=$months_val  output=$months_out}
				</select>
            </div>
            <div class="row">
                <div class="formLabel">{$YEAR}:</div>
				<select name="Year" class="form-control">
					{html_options values=$years_val  output=$years_out}
				</select>
            </div>

            <div class="row">
                <div class="formLabel">{$DRIVER}:</div>
				<select name="SubDriverID" class="form-control">
					{html_options values=$drivers_val  output=$drivers_out}
				</select>	
            </div>
            <div class="row">
                <div class="formLabel">Show Hidden:</div><input type="checkbox" name="ShowHidden">
                <br><br>
                <input type="hidden" name="SortSubDriver" id="SortSubDriver" value="0">
                <input type="submit" class="btn btn-primary" name="submit"
                value="{$SHOW_TRANSFERS}" style="margin-left: 105px">
            </div>
        </form>
    </div>
	{/if}






	