    <body>
    <style>
        input, select { width: 200px; }
        #RequiredFrom, #RequiredTo { visibility: hidden; padding-left: 4px; color: red; }
        .formLabel { width: 100px; display: inline-block; }
		.row .pad4px .clock-timepicker input{
			width: 100% !important;
		}
		.row .pad4px input{
			width: 100% !important;
			border: 1px solid #ddd;
		}
		.row .pad4px [class*="col-"]{
			font-size: 13px !important;
			font-family: 'Open Sans', sans-serif !important;
			-webkit-font-smoothing: antialiased !important;
			color: #333;
		}
		.row .pad4px [class*="col-"] .l{
			font-size: 1.5em;
		}
		.grey{
			box-shadow:unset !important;
		}
		.grey.lighten-2-edit{
			background: #f5f5f5 !important;
		}
		.btn.red.pull-right.l,.btn.xgreen.l.center,.btn.xblue.l{
			color: white;
		}
    </style>

    <div> {* FROM *}
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

{* SMARTY 1: *}
	{/if}
    <div class="grey lighten-2 lighten-2-edit" style="font-size:13px;">
	{$Year}-{$Month}-01-{$Year}-{$Month}-{$daysInMonth}
	{if $ShowHidden} ({$brojSkrivenihTransfera} / {$brojTransfera})
    	{else} ({$brojTransfera} transfers)
	{/if}
	
	<br><br><button class="btn btn-default" onclick="$('.noPrint').toggle('slow');return false;">Show / Hide transfer details</button>
    <form action="" method="POST"> {* MAIN FORM*}
    {* Container start LISTA *}
    <div class="container-fluid white pad4px">
	

	{section name=ind loop=$rows}
{* ======================================================================================================== *}
{* {if $rows[ind].odk gt 0} *}
{* {if true} *}
			{* {if $rows[ind].odk eq 0}  {$rows[ind].slobodanDan eq 1} {else} {$rows[ind].slobodanDan eq 0}{/if} *}
{* SMARTY 2: *}
{* PODACI O TRANSFERU *}
		<div class="row pad4px {$rows[ind].colorClass} noPrint" style="border-top: 1px solid #ccc">
			<div class="col-md-1">
				{$icon}<br>
				{$rows[ind].dayToLang}<br>
				<strong class="l">{$rows[ind].dateFrom}</strong>
			</div>
			<div class="col-md-2">
				<span class="l">
					{* <span class="xblue-text">{$rows[ind].PickupDate} - {$rows[ind].SubPickupTime}</span> *}
					{$rows[ind].SubPickupTime}
					{if $rows[ind].expectedArrival neq ''} ETA: {$rows[ind].expectedArrival}{/if}
					
					{if $rows[ind].minutes > 90} <i class="fa fa-pause s"></i>{$rows[ind].emptyTimeH} : {$rows[ind].emptyTimeM}{/if}
					<br>
				</span>
				{$rows[ind].MOrderKey} - {$rows[ind].MOrderID} - {$rows[ind].TNo}<br>
				{$rows[ind].PaxName}<br>
				{$rows[ind].MPaxTel}
			</div>

			<div class="col-md-2">
				{$rows[ind].PickupName}<br>
				{$rows[ind].PickupAddress}<br>

				<i class="fa fa-car"></i> {$rows[ind].SubVehicleName}
				{if $sd2 neq ''} <br><i class="fa fa-car"></i> {$rows[ind].SubVehicleNameTwo}{/if}
				{if $sd3 neq ''} <br><i class="fa fa-car"></i> {$rows[ind].SubVehicleNameThree}{/if}
			</div>

			<div class="col-md-2">
				{$rows[ind].DropName}<br>
				{$rows[ind].DropAddress}<br>
			</div>

			<div class="col-md-2">
				{$rows[ind].AuthUserRealName}<br>

				Cash: {$rows[ind].PayLater} EUR<br>
				Online: {$rows[ind].PayNow} EUR<br>
				Invoice: {$rows[ind].InvoiceAmount} EUR

			</div>

			<div class="col-md-2">
				{if $rows[ind].SubDriver2 neq ''}
					{$rows[ind].AuthUserRealName2}
					<br>
				{/if}
				{if $rows[ind].SubDriver3 neq ''}
					{$rows[ind].AuthUserRealName3}
					<br>
				{/if}
				<p>Note: {$rows[ind].SubDriverNote}</p>
			</div>

			<div class="col-md-1">
				<input type="hidden" name="Detail_{$rows[ind].DetailsID}" id="Det_{$rows[ind].DetailsID}" value="{$rows[ind].Expired}">

				<input type="checkbox" id="Detail_{$rows[ind].DetailsID}"
				{if $rows[ind].Expired} checked="checked"{/if}
				onchange="toggleCheck('$rows[\'ind\'].DetailsID')" >

			</div>
		</div>			
		
			<input type="hidden" name="DateFrom[]" value="{$rows[ind].dateFrom}">
			<input type="hidden" name="WeekNumber[]" value="{$rows[ind].weekNo}">

			{$rows[ind].color1 = 'grey lighten-2'}
			{$rows[ind].color2 = 'grey lighten-1'}
{* ========================================================================= *}
{* SMARTY 3: *}
{* Slobodan dan: *}
			
			{if is_bool($rows[ind].slobodanDan)}
				
				{$rows[ind].color1 = 'xorange lighten-3 xblack-text'}
				{$rows[ind].color2 = 'xorange lighten-2 xblack-text'}
				<div class="row pad4px {$rows[ind].color1}">
					<div class="col-md-1">
						<strong>{$rows[ind].dateFrom}</strong><br>
						{$rows[ind].dayToLang}
						{if $rows[ind].praznik} <br><span class="red">HOLIDAY</span>{/if}
					</div>            
					<div class="col-md-1"><strong>FREE</strong></div>
					<div class="col-md-10">
						<input class="w100 xblack-text" type="text" name="Description[]" value="{$rows[ind].Description}">
					</div>
				</div>
				{else}
					<input type="hidden" name="Description[]">
			{/if}
			{* ========================================================================== *}

			{if $rows[ind].dateFrom|strtotime|date_format:"%w" == '0' } {$rows[ind].nedilja = '1'} {else} {$rows[ind].nedilja = 0}{/if}
			<input type="hidden" id="Nedjelja1_{$rows[ind].dayOfYear}" value="{$rows[ind].nedilja}">
			<input type="hidden" id="Nedjelja2_{$rows[ind].dayOfYear}" value="{$rows[ind].nedilja}">
				
			{if $rows[ind].praznik} {$rows[ind].praznik = '1'} {else} {$rows[ind].praznik = 0}{/if}
			<input type="hidden" id="Praznik1_{$rows[ind].dayOfYear}" value="{$rows[ind].praznik}">
			<input type="hidden" id="Praznik2_{$rows[ind].dayOfYear}" value="{$rows[ind].praznik}">


			<div class="row pad4px {$rows[ind].color1}" id="RONDE_1_{$rows[ind].dayOfYear}" xstyle="display:none">
				<div class="col-md-1">
					<strong>{$rows[ind].dateFrom}</strong><br>
					{$rows[ind].dayToLang}
					{if $rows[ind].praznik} <br><span class="red">HOLIDAY</span>{/if}
				</div>
				<div class="col-md-1">
					RONDE 1<br>
					<button class="btn" style="background:transparent !important" title="Show-Hide RONDE 2"
					onclick="$('#RONDE_2_{$rows[ind].dayOfYear}').toggle('slow');return false;"><i class="fa fa-sort"></i></button>
				</div>
				<div class="col-md-1">
					Debut:<br>
					<input class="timepicker w100" id="startTime_1_{$rows[ind].dayOfYear}" name="startTime_1[]" value="{$rows[ind].startTime_1}"
					onchange="timeDifference('1_{$rows[ind].dayOfYear}', 'startTime_', 'endTime_', 'ukRedovno_','{$rows[ind].weekNo}');">					
				</div>

				<div class="col-md-1">
					Fin:<br>
					<input class="timepicker w100" id="endTime_1_{$rows[ind].dayOfYear}" name="endTime_1[]" value="{$rows[ind].endTime_1}"
					onchange="timeDifference('1_{$rows[ind].dayOfYear}', 'startTime_', 'endTime_', 'ukRedovno_','{$rows[ind].weekNo}');">
				</div>

				<div class="col-md-1">
					Pause debut:<br>
					<input class="timepicker w100"  id="pauzaStart_1_{$rows[ind].dayOfYear}" name="pauzaStart_1[]" value="{$rows[ind].pauzaStart_1}"
					onchange="timeDifference('1_{$rows[ind].dayOfYear}', 'pauzaStart_', 'pauzaEnd_', 'ukPauza_','{$rows[ind].weekNo}');">
				</div>

				<div class="col-md-1">
					Pause fin:<br>
					<input class="timepicker w100"  id="pauzaEnd_1_{$rows[ind].dayOfYear}" name="pauzaEnd_1[]" value="{$rows[ind].pauzaEnd_1}"
					onchange="timeDifference('1_{$rows[ind].dayOfYear}', 'pauzaStart_', 'pauzaEnd_', 'ukPauza_','{$rows[ind].weekNo}');">
				</div>

				<div class="col-md-1">
					TOT. H. REGULIERES:<br>
					<input class="w100 ukRedovno{$rows[ind].weekNo}" id="ukRedovno_1_{$rows[ind].dayOfYear}" name="ukRedovno_1[]" value="{$rows[ind].ukRedovno_1}" 
					onchange="timeTotal('1_{$rows[ind].dayOfYear}','{$rows[ind].weekNo}')" readonly>
				</div>

				<div class="col-md-1">
					TOTAL PAUSE:<br>
					<input class="w100 ukPauza{$rows[ind].weekNo}" id="ukPauza_1_{$rows[ind].dayOfYear}" name="ukPauza_1[]" value="{$rows[ind].ukPauza_1}" 
					onchange="timeTotal('1_{$rows[ind].dayOfYear}','{$rows[ind].weekNo}')" readonly>
				</div>

				<div class="col-md-1">
					TOT.H. DE NUIT:<br>
					<input class="timepicker w100 ukNoc{$rows[ind].weekNo}"  id="ukNoc_1_{$rows[ind].dayOfYear}" name="ukNoc_1[]" value="{$rows[ind].ukNoc_1}" 
					onchange="timeTotal('1_{$rows[ind].dayOfYear}','{$rows[ind].weekNo}')">
				</div>

				<div class="col-md-1">
					TOTAL DIMANCHE:<br>
					<input class="timepicker w100 ukNedjelja{$rows[ind].weekNo}"  id="ukNedjelja_1_{$rows[ind].dayOfYear}" name="ukNedjelja_1[]" value="{$rows[ind].ukNedjelja_1}" 
					onchange="timeTotal('1_{$rows[ind].dayOfYear}','{$rows[ind].weekNo}')">
				</div>

				<div class="col-md-1">
					TOTAL JOURS Feries:<br>
					<input class="timepicker w100 ukPraznik{$rows[ind].weekNo}"  id="ukPraznik_1_{$rows[ind].dayOfYear}" name="ukPraznik_1[]" value="{$rows[ind].ukPraznik_1}" 
					onchange="timeTotal('1_{$rows[ind].dayOfYear}','{$rows[ind].weekNo}')">
				</div>

				<div class="col-md-1">
					TOTAL:<br>
					<input class="w100 ukupnoDan{$rows[ind].weekNo}" id="ukupno_1_{$rows[ind].dayOfYear}" name="ukupno_1[]" value="{$rows[ind].ukupno_1}" readonly>
				</div>

			</div>
{* ========================================================================= *}
{* SMARTY 4: *}
		
			<div class="row pad4px {$rows[ind].color2} {$rows[ind].hideShift2}" id="RONDE_2_{$rows[ind].dayOfYear}" {$rows[ind].initialDisplay}>
			<div class="col-md-1">
				<strong>{$rows[ind].dateFrom}</strong><br>
				{$rows[ind].dayToLang}
				{if $rows[ind].praznik} <br><span class="red">HOLIDAY</span>{/if}
			</div>
			<div class="col-md-1">
				RONDE 2
			</div>
			<div class="col-md-1">
				Debut:<br>
				<input class="timepicker w100" id="startTime_2_{$rows[ind].dayOfYear}" name="startTime_2[]" value="{$rows[ind].startTime_2}"
				onchange="timeDifference('2_{$rows[ind].dayOfYear}', 'startTime_', 'endTime_', 'ukRedovno_','{$rows[ind].weekNo}');">
			</div>

			<div class="col-md-1">
				Fin:<br>
				<input class="timepicker w100" id="endTime_2_{$rows[ind].dayOfYear}" name="endTime_2[]" value="{$rows[ind].endTime_2}"
				onchange="timeDifference('2_{$rows[ind].dayOfYear}', 'startTime_', 'endTime_', 'ukRedovno_','{$rows[ind].weekNo}');">
			</div>

			<div class="col-md-1">
				Pause debut:<br>
				<input class="timepicker w100"  id="pauzaStart_2_{$rows[ind].dayOfYear}" name="pauzaStart_2[]" value="{$rows[ind].pauzaStart_2}"
				onchange="timeDifference('2_{$rows[ind].dayOfYear}', 'pauzaStart_', 'pauzaEnd_', 'ukPauza_','{$rows[ind].weekNo}');">
			</div>

			<div class="col-md-1">
				Pause fin:<br>
				<input class="timepicker w100"  id="pauzaEnd_2_{$rows[ind].dayOfYear}" name="pauzaEnd_2[]" value="{$rows[ind].pauzaEnd_2}"
				onchange="timeDifference('2_{$rows[ind].dayOfYear}', 'pauzaStart_', 'pauzaEnd_', 'ukPauza_','{$rows[ind].weekNo}');">
			</div>

			<div class="col-md-1">
				TOT. H. REGULIERES:<br>
				<input class="w100 ukRedovno{$rows[ind].weekNo}" id="ukRedovno_2_{$rows[ind].dayOfYear}" name="ukRedovno_2[]" value="{$rows[ind].ukRedovno_2}" 
				onchange="timeTotal('2_{$rows[ind].dayOfYear}','{$rows[ind].weekNo}')" readonly>
			</div>

			<div class="col-md-1">
				TOTAL PAUSE:<br>
				<input class="w100 ukPauza{$rows[ind].weekNo}" id="ukPauza_2_{$rows[ind].dayOfYear}" name="ukPauza_2[]" value="{$rows[ind].ukPauza_2}"
				onchange="timeTotal('2_{$rows[ind].dayOfYear}','{$rows[ind].weekNo}')" readonly>
			</div>

			<div class="col-md-1">
				TOT.H. DE NUIT:<br>
				<input class="timepicker w100 ukNoc{$rows[ind].weekNo}"  id="ukNoc_2_{$rows[ind].dayOfYear}" name="ukNoc_2[]" value="{$rows[ind].ukNoc_2}"
				onchange="timeTotal('2_{$rows[ind].dayOfYear}','{$rows[ind].weekNo}')">
			</div>

			<div class="col-md-1">
				TOTAL DIMANCHE:<br>
				<input class="timepicker w100 ukNedjelja{$rows[ind].weekNo}"  id="ukNedjelja_2_{$rows[ind].dayOfYear}" name="ukNedjelja_2[]" value="{$rows[ind].ukNedjelja_2}"
				onchange="timeTotal('2_{$rows[ind].dayOfYear}','{$rows[ind].weekNo}')">
			</div>

			<div class="col-md-1">
				TOTAL JOURS Feries:<br>
				<input class="timepicker w100 ukPraznik{$rows[ind].weekNo}"  id="ukPraznik_2_{$rows[ind].dayOfYear}" name="ukPraznik_2[]" value="{$rows[ind].ukPraznik_2}"
				onchange="timeTotal('2_{$rows[ind].dayOfYear}','{$rows[ind].weekNo}')">
			</div>

			<div class="col-md-1">
				TOTAL:<br>
				<input class="w100 ukupnoDan{$rows[ind].weekNo}" id="ukupno_2_{$rows[ind].dayOfYear}" name="ukupno_2[]" value="{$rows[ind].ukupno_2}" readonly>
			</div>

		</div>
{* {else} *}
	{* nema transfera, slobodan dan *}
{* ========================================================================= *}
{* SMARTY 5: *}
			{* <input type="hidden" name="DateFrom[]" value="{$rows[ind].dateFrom}">
			<input type="hidden" name="WeekNumber[]" value="{$rows[ind].weekNo}">	
	
			<div class="row pad4px red">
				<div class="col-md-1 blue">
					{$rows[ind].dateFrom}<br>
					dayToLang( date('l', strtotime($dateFrom)) )
					{$rows[ind].dateFrom|strtotime|date_format:"%w"}
				</div>
				<div class="col-md-1">
					Debut:<br>
					<input type="text"  class="timepicker w100"  id="startTime_1_{$rows[ind].dayOfYear}" name="startTime_1[]" value="{$rows[ind].startTime_1}">
				</div>
				<div class="col-md-1">
					Fin:<br>
					<input type="test"  class="timepicker w100" id="endTime_1_{$rows[ind].dayOfYear}" name="endTime_1[]" value="{$rows[ind].endTime_1}">
				</div>
				<div class="col-md-6">
					<br>
					<input class="w100 xblack-text" type="text" name="Description[]" value="{$rows[ind].Description}">
					

					<input type="hidden"  id="pauzaStart_1_{$rows[ind].dayOfYear}" name="pauzaStart_1[]" value="{$rows[ind].pauzaStart_1}">
					<input type="hidden"  id="pauzaEnd_1_{$rows[ind].dayOfYear}" name="pauzaEnd_1[]" value="{$rows[ind].pauzaEnd_1}">
					<input type="hidden" class="ukRedovno{$rows[ind].weekNo}" id="ukRedovno_1_{$rows[ind].dayOfYear}" name="ukRedovno_1[]" value="{$rows[ind].ukRedovno_1}">
					<input type="hidden" class="ukPauza{$rows[ind].weekNo}" id="ukPauza_1_{$rows[ind].dayOfYear}" name="ukPauza_1[]" value="{$rows[ind].ukPauza_1}">
					<input type="hidden" class="ukNoc{$rows[ind].weekNo}"  id="ukNoc_1_{$rows[ind].dayOfYear}" name="ukNoc_1[]" value="{$rows[ind].ukNoc_1}">
					<input type="hidden" class="ukNedjelja{$rows[ind].weekNo}"  id="ukNedjelja_1_{$rows[ind].dayOfYear}" name="ukNedjelja_1[]" value="{$rows[ind].ukNedjelja_1}">
					<input type="hidden" class="ukPraznik{$rows[ind].weekNo}"  id="ukPraznik_1_{$rows[ind].dayOfYear}" name="ukPraznik_1[]" value="{$rows[ind].ukPraznik_1}">
					<input type="hidden" class="ukupnoDan{$rows[ind].weekNo}" id="ukupno_1_{$rows[ind].dayOfYear}" name="ukupno_1[]" value="{$rows[ind].ukupno_2 }">
					<input type="hidden"  id="startTime_2_{$rows[ind].dayOfYear}" name="startTime_2[]" value="{$rows[ind].startTime_2}">
					<input type="hidden"  id="endTime_2_{$rows[ind].dayOfYear}" name="endTime_2[]" value="{$rows[ind].endTime_2}">
					<input type="hidden"  id="pauzaStart_2_{$rows[ind].dayOfYear}" name="pauzaStart_2[]" value="{$rows[ind].pauzaStart_2}">
					<input type="hidden"  id="pauzaEnd_2_{$rows[ind].dayOfYear}" name="pauzaEnd_2[]" value="{$rows[ind].pauzaEnd_2}">
					<input type="hidden" class="ukRedovno{$rows[ind].weekNo}" id="ukRedovno_2_{$rows[ind].dayOfYear}" name="ukRedovno_2[]" value="{$rows[ind].ukRedovno_2}">
					<input type="hidden" class="ukPauza{$rows[ind].weekNo}" id="ukPauza_2_{$rows[ind].dayOfYear}" name="ukPauza_2[]" value="{$rows[ind].ukPauza_2}">
					<input type="hidden" class="ukNoc{$rows[ind].weekNo}"  id="ukNoc_2_{$rows[ind].dayOfYear}" name="ukNoc_2[]" value="{$rows[ind].ukNoc_2}">
					<input type="hidden" class="ukNedjelja{$rows[ind].weekNo}"  id="ukNedjelja_2_{$rows[ind].dayOfYear}" name="ukNedjelja_2[]" value="{$rows[ind].ukNedjelja_2}">
					<input type="hidden" class="ukPraznik{$rows[ind].weekNo}"  id="ukPraznik_2_{$rows[ind].dayOfYear}" name="ukPraznik_2[]" value="{$rows[ind].ukPraznik_2}">
					<input type="hidden" class="ukupnoDan{$rows[ind].weekNo}" id="ukupno_2_{$rows[ind].dayOfYear}" name="ukupno_2[]" value="{$rows[ind].ukupno_2}">
					
				</div>
			</div> *}
{* {/if} End of if(count($odk)) gt 0 *}

			
			{if $rows[ind].dateFrom|strtotime|date_format:"%w" eq '0' ||  $rows[ind].day eq $rows[ind].daysInMonth}
{* ========================================================================= *}
{* SMARTY 6: *}
				<input type="hidden" name="AfterDate[]" value="{$rows[ind].dateFrom}">
				<div class="row pink lighten-4 pad4px">

					<div class="col-md-6 l">TJEDAN {$rows[ind].dateFrom|strtotime|date_format:"%W"}</div>
					<div class="col-md-1">
						TOT.H.REGULIERES:<br>
						<input class="w100 ukRedovno_w" id="ukRedovno_w{$rows[ind].weekNo}" name="ukRedovno_w[]" 
						value="{$rows[ind].ukRedovno}" readonly>
					</div>

					<div class="col-md-1">
						TOTAL PAUSE:<br>
						<input class="w100 ukPauza_w" id="ukPauza_w{$rows[ind].weekNo}" name="ukPauza_w[]"
						value="{$rows[ind].ukPauza}" readonly>
					</div>

					<div class="col-md-1">
						TOT.H. DE NUIT:<br>
						<input class="w100 ukNoc_w"  id="ukNoc_w{$rows[ind].weekNo}" name="ukNoc_w[]"
						value="{$rows[ind].ukNoc}" readonly>
					</div>

					<div class="col-md-1">
						TOTAL DIMANCHE:<br>
						<input class="w100 ukNedjelja_w"  id="ukNedjelja_w{$rows[ind].weekNo}" name="ukNedjelja_w[]"
						value="{$rows[ind].ukNedjelja}" readonly>
					</div>

					<div class="col-md-1">
						TOTAL JOURS Feries:<br>
						<input class="w100 ukPraznik_w"  id="ukPraznik_w{$rows[ind].weekNo}" name="ukPraznik_w[]"
						value="{$rows[ind].ukPraznik}" readonly>
					</div>

					<div class="col-md-1">
						TOTAL:<br>
						<input class="w100 ukupno_w" id="ukupno_w{$rows[ind].weekNo}" name="ukupno_w[]"
						value="{$rows[ind].ukupno}" readonly>
					</div>

				</div>
			{/if} {* end if Sunday *} 


		{$rows[ind].content}
	{/section}
{* ========================================================================= *}
{* get previous working hours summary *}
{* SMARTY 7: *}
    <div class="row xgreen lighten-3 pad4px">
        <div class="col-md-6 l">MJESEC {$dateFrom|strtotime|date_format:"%m"}</div>
        <div class="col-md-1">
            TOT. H. REGULIERES:<br>
            <input class="w100" id="ukRedovno_M" name="ukRedovno_M" value="{$ukRedovno}" readonly>
        </div>

        <div class="col-md-1">
            TOTAL PAUSE:<br>
            <input class="w100" id="ukPauza_M" name="ukPauza_M" value="{$ukPauza}" readonly>
        </div>

        <div class="col-md-1">
            TOT.H. DE NUIT:<br>
            <input class="w100 "  id="ukNoc_M" name="ukNoc_M" value="{$ukNoc}" readonly>
        </div>

        <div class="col-md-1">
            TOTAL DIMANCHE:<br>
            <input class="w100"  id="ukNedjelja_M" name="ukNedjelja_M" value="{$ukNedjelja}" readonly>
        </div>

        <div class="col-md-1">
            TOTAL JOURS Feries:<br>
            <input class="w100"  id="ukPraznik_M" name="ukPraznik_M" value="{$ukPraznik}" readonly>
        </div>

        <div class="col-md-1">
            TOTAL:<br>
            <input class="w100 ukupno_M" id="ukupno_M" name="ukupno_M" value="{$ukupno}" readonly>
        </div>
    </div>   
    
    <!-- SPREMI ZA KASNIJE -->
    <input type="hidden" name="Month" value="{$Month}">
    <input type="hidden" name="Year" value="{$Year}">
    <input type="hidden" name="SubDriverID" value="{$SubDriverID}">
    
<!-- 23.07.2018 - Mandic zatrazio na dnu da se ispise broj transfera, te ukupno novac zaradjen, na isti nacin kao na timetable-u - Dodao Leo! -->
	<div class="row alert alert-success" style="margin-left:-15px;padding:25px 0px">
		<div class="col-md-4"></div>
		<div class="col-md-4"></div>
		<div class="col-md-2" style="font-size:20px;color:black">
			
				{if $ShowHidden}
					TRANSFERS. : {$brojSkrivenihTransfera} / {$brojTransfera}
				 {else}
					TRANSFERS. : {$brojTransfera}
				{/if}
			
		</div>		
		<div class="col-md-2" style="font-size:20px;color:black">
			TOTAL_VALUE: {$totalValue|number_format:2:".":","} EUR</br>
			Total Cash: {$totalCashIn|number_format:2:".":","} EUR
		</div>
	</div>

    
    {* href promijenjen, kao user saljemo DriverID umjesto $_REQUEST['user'] *}
    <br><br>
    
    <div class="row">
	
		<div class="col-md-12">
		
			<a class="btn xblue l" href="https://www.jamtransfer.com/cms/index.php?p=slct">Back</a>&nbsp;&nbsp;
			
			<a class="btn xgreen l center" href="https://www.jamtransfer.com/cms/index.php?p=monthlyReport&DriverID='.$DriverID.
			'&SubDriverID='.$SubDriverID.'&Month='.$Month.'&Year='.$Year.'">Print Report</a>&nbsp;&nbsp;

			<a class="btn xgreen l center xwhite-text" target="blank" href="https://www.jamtransfer.com/cms/index.php?p=transfersReport&DriverID='.$DriverID.
			'&SubDriverID='.$SubDriverID.'&Month='.$Month.'&Year='.$Year.'&submit=yes">Transfers List</a>
			
			<button class="btn red pull-right l" type="submit" name="Save" value="Save">Save</button>
		
		</div>
	
	</div> {* End of .row *}
	
	<br><br><br>

    </div> {* End of container-fluid white pad4px *}
	
	</form>

		{* {$show_data} *}
	</div> {* End of grey lighten-2 *}
{/if}	





	