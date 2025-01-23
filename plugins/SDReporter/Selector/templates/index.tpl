    <body>
    <style>
        input, select { width: 200px; }
        #RequiredFrom, #RequiredTo { visibility: hidden; padding-left: 4px; color: red; }
        .formLabel { width: 100px; display: inline-block; }
    </style>

    <div>
        <form action="" method="post" onsubmit="return validate()">
			<input type="hidden" name="SortSubDriver" id="SortSubDriver" value="0">
            <input type="hidden" name="DriverID" value="{$DriverID}">
			<div class="row">
				<div class="col-md-2">
					<div class="formLabel">{$MONTHS}:</div>
					<select name="Month">
						<option value="0">---</option>
						{section name=ind loop=$months}
							{$months[ind]}
						{/section}
					</select>
				</div>
				<div class="col-md-2">
					<div class="formLabel">{$YEAR}:</div>
					<select name="Year">
						<option value="0">---</option>
						{section name=ind loop=$years}
							{$years[ind]}
						{/section}
					</select>
				</div>
				<div class="col-md-2">
					<div class="formLabel">{$DRIVER}:</div>
					<select name="SubDriverID" id="SubDriverID">
						<option value="0"> --- </option>
						{section name=ind loop=$drivers}
							{$drivers[ind]}
						{/section}
					</select>
				</div>
				<div class="col-md-2">
					<div class="formLabel">Show Hidden:</div><input type="checkbox" name="ShowHidden">
				</div>
				<div class="col-md-2">	
					<input type="submit" class="btn btn-primary" name="submit"
					value="{$SHOW_TRANSFERS}" style="margin-left: 105px">
				</div>
            </div>
        </form>
    </div>

{if isset($smarty.request.submit) or isset($smarty.request.save)}
	{if isset($smarty.request.save)}

	{/if}
    <div class="grey lighten-2" style="font-size:13px;">
	
		{$show_data}
	</div>	
{/if}	





	