<div class="container white">
   	
{if isset({$smarty.request.StartDate}) and isset({$smarty.request.EndDate}) and $smarty.request.StartDate gt 0 and $smarty.request.EndDate gt 0}
	
	<table class="table table-striped" style="font-size:0.8em">
	
	{section name=index loop=$transfers}

		<tr>
			<td>
				{counter}
			</td>

			<td style="vertical-align:top;white-space: nowrap;">
				<b>{$transfers[index].OrderID} - {$transfers[index].TNo}</b>
        	</td>

			<td style="vertical-align:top;white-space: nowrap;">
				<b>{$transfers[index].PaxName}</b> <br/>
				Pax:{$transfers[index].PaxNo}
				VT:{$transfers[index].VehicleType}<br>
				Date:{$transfers[index].PickupDate}
			</td>

			<td>
				<b>{$transfers[index].PickupName}<br>{$transfers[index].DropName}</b><br/>
				Driver: {$drivers[index]}
			</td>

			<td style="vertical-align:top;white-space: nowrap;">
			
			{* Resiti number_format u smarty *}
				{* echo ' Cash: ' . number_format($o->PayLater,2) . ' EUR<br/>';
				echo ' Driver: ' . number_format(($o->DriversPrice + $o->DriverExtraCharge) ,2) . ' EUR<br/>';
				echo ' Balance: ' .number_format($balanceShow,2) . ' EUR'; *}

				Cash:{$transfers[index].PayLater|number_format:2}EUR<br/>
				Driver:{$driverPrices[index]|number_format:2}EUR<br/>
				Balance:{$balanceShow[index]|number_format:2}EUR

			</td>
		</tr>
		
	{/section}

	</table>

	<br/>Total transfers: $i
    Total Cash:{$totCash|number_format:2},
    Total Driver:{$totNetto|number_format:2}
    Total Balance: <strong>{$balance|number_format:2} EUR </strong>
    <br><br><strong>* Important Note:</strong>
    <br> negative balance means that JamTransfer owes this amount to Driver
    <br> positive Balance means that Driver owes this amount to JamTransfer

	
	
	<div align="left">

		<a href="{$root_home}driversTransfers/{$smarty.request.StartDate}/{$smarty.request.EndDate}/{$smarty.request.includePaymentMethod}" class="btn btn-primary">&larr; Back to Drivers List</a>
			<br/>
			{* Ako bude bilo potrebno *}
			{* <input type="submit" class="btn btn-primary" value=" &larr; Back to Drivers List" name="reset" /> *}
	
		{if $smarty.request.driverid > 0}
			<a class="btn btn-danger l" style="color:white !important;float:right;" id="CreateInvoice" href="{$root_home}driversTransfers/invoice/{$smarty.request.driverid}/{$smarty.request.StartDate}/{$smarty.request.EndDate}/{$smarty.request.includePaymentMethod}">
			<i class="fa fa-cogs"></i> Create Invoice</a> &nbsp;&nbsp;
			<br/><br/>
		{/if}

		<br/><br/>

	</div> {*End of left*}
	
	<hr><h4>Exported to CSV!</h4>

	<small>
		<a href="DriverBalance" class="btn btn-default"><i class="fa fa-download"></i> Download CSV</a>
		You can download CSV file here (or Right-Click->Save)
		<b>File format:</b> UTF-8, semi-colon (;) delimited
	</small>	
	


	{/if}

</div> {* / .container white *}
	
